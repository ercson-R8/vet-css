<?php 

namespace App\Controllers\Timetable;

// use \Core\View;
use App\Models\DB;
use App\TimetableConfig;
use App\Controllers\Timetable\TraineeGroup;
use App\Controllers\Timetable\SubjectClass;


class Timetable {
/* 
 |--------------------------------------------------------------------------
 | TimeTable   
 |--------------------------------------------------------------------------
 | 
 | desc 
 | 
 | 
 | 
 | 
 */


    /*
     * fetchBaseSubjectClass method creates a timetable object containing an array of 
     * SubjectClass/es arranged in array with time slot. 
     * [ [mt_id] [sbj] [time slot] ]
     *
     * @param		int         timetable id, from the table 'timetable'
     * @return	 	array       SubjectClasses objects; 
     */
    public function fetchBaseSubjectClass ($timeTableID){
        
        $subjectClassSet = [];
        $db = DB::getInstance();
        $db->query("SELECT * FROM subject_class WHERE subject_class.timetable_id = {$timeTableID}");
        // print_r($db->getResults());
        if ($db->count()){
            $i=0;
            foreach($db->getResults() as $subjectClass){
                // print_r($subjectClass->id);
                // print_r(array_keys($subjectClass));
                $subjectClassSet[] =[
                    "id" => $subjectClass->id,
                    "timetable_id" => $subjectClass->timetable_id,
                    "subject_id" => $subjectClass->subject_id,
                    "trainee_group_id" => $subjectClass->trainee_group_id,
                    "instructor_id" => $subjectClass->instructor_id,
                    "room_id" => $subjectClass->room_id,
                    "room_type_id" => $subjectClass->room_type_id,
                    "meeting_time_id_TBDropped" => $subjectClass->meeting_time_id_TBDropped,
                    "preferred_start_period" => $subjectClass->preferred_start_period,
                    "preferred_end_period" => $subjectClass->preferred_end_period,
                    "preferred_number_days" => $subjectClass->preferred_number_days,
                ];    
            }
            return $subjectClassSet;
        }

        
    }
    /*
     * createSubjectClass method creates a set of subject class belonging to a specific
     * timetable.  
     *
     * @param		object      stdClass object, raw data from fetchBaseSubjectClass. 
     * @return	 	array       SubjectClass object; 
         [0] => stdClass Object
        (
            [id] => 1
            [timetable_id] => 1
            [subject_id] => 1
            [trainee_group_id] => 1
            [instructor_id] => 4
            [room_id] => 3
            [room_type_id] => 2
            [meeting_time_id_TBDropped] => 
            [preferred_start_period] => 4
            [preferred_end_period] => 5
            [preferred_number_days] => 1
        )
     */
    public function createSubjectClass ($baseSubjectClass){
        // print_r("\nSizeof base: ".sizeof($baseSubjectClass));
        $subjectClass = [];

            for($i=0; $i < sizeof($baseSubjectClass); $i++){
                // print_r("basesubjectID: ".$baseSubjectClass[$i]["id"]);
                if ($baseSubjectClass[$i]["room_id"]){ // room_id is provided, cannot be changed. 
                    // echo "<br/>room_id specified: {$baseSubjectClass[$i]["room_id"]} scID: {$baseSubjectClass[$i]["id"]}";
                    $room = $this->getRoom($baseSubjectClass[$i]["room_id"]);
                    $isRoomFixed = true;
                }else{
                    $room = $this->getRandomRoom($baseSubjectClass[$i]["room_type_id"]);
                    $isRoomFixed = false;
                    // echo "<br/>room_id specified: {$baseSubjectClass[$i]["room_id"]} scID: {$baseSubjectClass[$i]["id"]}";
                    
                }
                $subjectClass[$baseSubjectClass[$i]["id"]] =  new SubjectClass (
                                            $baseSubjectClass[$i]["id"],
                                            $baseSubjectClass[$i]["timetable_id"],
                                            $this->getSubject($baseSubjectClass[$i]["subject_id"]),
                                            $this->getTraineeGroup($baseSubjectClass[$i]["trainee_group_id"]), 
                                            $this->getInstructor($baseSubjectClass[$i]["instructor_id"]), 
                                            $this->getRoomType($baseSubjectClass[$i]["room_type_id"]), 
                                            $room,
                                            $baseSubjectClass[$i]["preferred_start_period"],
                                            $baseSubjectClass[$i]["preferred_end_period"],
                                            $baseSubjectClass[$i]["preferred_number_days"]);
                $subjectClass[$baseSubjectClass[$i]["id"]]->setRoomFixed($isRoomFixed);
            }
            // print_r($subjectClass);
        return $subjectClass;
    }


    /*
     * CreateTimetable method 
     *
     * @param		
     * @return	 	
     */
    public function createTimetable ($subjectClassSet){
        $timetable = [];
        $mt_id = 0;

        // get all the timeslot for this subjectClass
        // timeslots are based on the required period and preferred number of days
        // timeslots are distributed in ref to the number of days. 

        foreach($subjectClassSet as $key => $subjectClass){

            $timeslot = $this->getTimeslot($subjectClass);
            for($j=0; $j < sizeof($timeslot); $j++){

                // create a MeetingTime object for each timeslot. 
                $timetable [] = new MeetingTime ($mt_id, $subjectClass, $timeslot[$j]);
                $mt_id++;
            }

        }
        // usort($timetable, function($a, $b){
        //     // return ((int)$a->getSubjectClassID() > (int)$b->getSubjectClassID());

        //     return ((int)$a->getTimeslot() > (int)$b->getTimeslot());

        //     // if ((int)$a->getTimeslot() == (int)$b->getTimeslot()) return 0;
        //     // return (int)$a->getTimeslot() < (int)$b->getTimeslot() ? -1 : 1;

        // });
        // print_r("\n=========================");
        // print_r($timetable);
        return $timetable;
    }

    /*
     * getTimeslot provides a random timeslot for a given subjectClass. 
     * This will call getDistBlock() method based on the subject's 
     * required period and the preferred number of days then provides a
     * random timeslot/s that should all fall in one same day. 
     *
     * @param		object      subjectClass 
     * @return	 	array       timeslots for this subject class for 1 meeting (day)
     */
    public function getTimeslot ($subjectClass){
        $timeslot = []; // subjectClass-timeslot
        // distribute the required period/s with the preferred number of day/s
        // returns an array. $distBlock = [ [day]=>[no. of periods] ] 
        //     Array
        // (
        //     [0] => 2
        //     [1] => 1
        //     [2] => 1
        // )

        $distBlock = $this->getDistBlock(   $subjectClass->getSubject()->getRequiredPeriod(),
                                            $subjectClass->getPreferredNumberOfDays() 
                                        );

        $day = [];
        for($i=0; $i < count($distBlock); $i++ ){
                $sameDay = true;
                while ($sameDay){
                    $temp_slot = $this->getRandomSlot(
                                                $distBlock[$i],
                                                $subjectClass->getPreferredStart(),
                                                $subjectClass->getPreferredEnd() 
                                        );
                    $daySelected = ((int) (($temp_slot[0])/TimetableConfig::TOTAL_PERIODS) );
                    if (!in_array($daySelected, $day)){

                        $day[]= $daySelected;

                        for($j=0; $j < count($temp_slot); $j++){

                            $timeslot[] =  $temp_slot[$j];
                        }
                        
                        $sameDay = false;
                    }
                }
        }

        return $timeslot;
    }

    /*
     * calcFitness method 
     *
     * @param		array       of meetingTime object 
     * @return	 	array       the number of conflicts and the fitness value.        
     */
    public function calcFitness ($timetable){
        $timeslots = [];
        $totalConflicts = 0;

        for($i=0; $i < sizeof($timetable); $i++){

            // fetch timeslot that is associated with a subjectClassID
            array_push($timeslots, $timetable[$i]->getTimeslot());
            
        }

        // remove duplicate timeslot from the list of timeslot that is associated with a subjectClassID
        $timeslots = (array_unique($timeslots)); 

        foreach($timeslots as $timeslot){
            
            $subjectClassID =[];
            $roomID = [];
            $traineeGroupID = [];
            $instructorID = [];
            $subjectID = [];

            for($i=0; $i < sizeof($timetable); $i++){
                
                // gather all IDs belonging to this timeslot. 
                if($timeslot == $timetable[$i]->getTimeslot()){
                    $subjectClassID[] = $timetable[$i]->getSubjectClass()->getID();
                    $roomID[] = $timetable[$i]->getSubjectClass()->getRoom()->getID();
                    $traineeGroupID[] = $timetable[$i]->getSubjectClass()->getTraineeGroup()->getID();
                    $instructorID[] = $timetable[$i]->getSubjectClass()->getInstructor()->getID();
                    $subjectID[]= $timetable[$i]->getSubjectClass()->getSubject()->getID();
                }
            }
            
            // the difference between size of the arrayID and the number of UNIQUE items in that
            // array is 0 then there is no conflict.  
            $totalConflicts +=  (sizeof($subjectClassID)-sizeof(array_unique($subjectClassID))) +
                                (sizeof($roomID)-sizeof(array_unique($roomID))) +
                                (sizeof($traineeGroupID)-sizeof(array_unique($traineeGroupID))) + 
                                (sizeof($instructorID)-sizeof(array_unique($instructorID))) + 
                                (sizeof($subjectID)-sizeof(array_unique($subjectID))
                                ); 
                                
                        
        }

        return $totalConflicts;

        //return ; // fitness value = 1 / (total conflicts + 1)
    }


    /*
     * crossover method 
     *
     * @param		
     * @return	 	
     */
    public function crossover ($parentA, $parentB){

        $child = [];

        $timeslotsA = [];
        $timeslotsB = [];

        $timetableSize = sizeof($parentA);

        for($i=0; $i < ($timetableSize); $i++){
            $timeslotsA[$parentA[$i]->getSubjectClass()->getID()][] = $parentA[$i]->getTimeslot();
            $timeslotsB[$parentB[$i]->getSubjectClass()->getID()][]= $parentB[$i]->getTimeslot();

        }


        // choose base timeslots for the child;
        $timeslotsC = (rand(0,1)) ?  $timeslotsA :  $timeslotsB;

        // crossver the timeslot set in $timeslotsA and $timeslotsB into 
        // the child timetable. 
        $luckyPick = rand(0,1);
        foreach($timeslotsA as $key => $value){
            if($luckyPick){
                $timeslotsC[$key] = $value;
            }
        }
        foreach($timeslotsB as $key => $value){
            if(rand(0,1)){
                $timeslotsC[$key] = $value;
            }
        }


        if($luckyPick){
            foreach($parentB as $key => $value){
                $child[] = clone $value;
            }
        }else{
            foreach($parentA as $key => $value){
                $child[] = clone $value;
            }
        }

       

        // insert the $timetableC timeslots into the child
        for($i=0; $i < ($timetableSize); $i++){
            $timeslot_shift = array_shift($timeslotsC[$child[$i]->getSubjectClass()->getID()]);
            $child[$i]->setTimeslot($timeslot_shift);
        }

        return $child;
    }

    /*
     * mutate method 
     *
     * @param		
     * @return	 	
     */
    public function mutate ($child){
        $mutant = [];
        for($j=0; $j <sizeof($child); $j++){
            $mutant[$j] = clone $child[$j];
        }

        $processedSubjectClassID = [];
        for($i=0; $i < sizeof($child); $i++){
            $rand = (rand(0,100)/100);
            if ( $rand < TimetableConfig::MUTATION_RATE){
                $subjectClassID = $mutant[$i]->getSubjectClass()->getID();

                if (!array_search($subjectClassID, $processedSubjectClassID)){
                    $processedSubjectClassID[] = $subjectClassID;
                    $isFixed = $mutant[$i]->getSubjectClass()->isRoomFixed();
                    if($isFixed){
                        
                        // print_r("\nisFixed YES: ".$isFixed." ");

                    }else{
                        $roomTypeID = $mutant[$i]->getSubjectClass()->getRoomType()->getID(); 
                        $randomRoom = $this->getRandomRoom($roomTypeID);
                        $mutant[$i]->getSubjectClass()->setRoom($randomRoom);
                    }
                    
                }

            }
            
        }

        
        $child = null;
        return $mutant;
    }

    public function indexAction (){
        //place this before any script you want to calculate time
        $time_start = microtime(true); 
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        $startMemory = memory_get_usage();
        echo"Timetable Class<pre>";


        $timetableID = 1;  // will be replaced by the actual database table id later
        $population = [];
        $timetableFitness = [];
        $subjectClassSets = [];
        $fitnessHighest = null;
        $fitnessLowest = null;
        $fitTimetableFound = false;
        // base subjectClass is created once, to fetch data from mySQL tables
        // an N subjectClasses will be created from the base with 
        // random rooms if the property isRoomFixed = false. 
  
        $baseSubjectClass = $this->fetchBaseSubjectClass($timetableID); 
  
        // setup()
        //  # Step 1: The Population 
        //    # Create an empty population (an array or ArrayList)
        //    # Fill it with DNA encoded objects (pick random values to start)
        print_r("\nGenerating base timetable:");
        for($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++){
                fmod($timetable+1, 50) ? print_r("") : print_r("\n");
                print_r("".$timetable."|");
                $subjectClassSets[$timetable] = $this->createSubjectClass($baseSubjectClass);
                $population[$timetable] = $this->createTimetable($subjectClassSets[$timetable]);

        }

        /* error checking for the length of the population index $timetable. 
           no fit timetable is found, the lenght of the population is equal to 
           ($timetable-1)
        */ 
        if (!$fitTimetableFound){
            $timetable--;
            
        }

        



        /*
            while no fitTimetableFound {
                1. evaluate fitness of timetables (population)
                    
                2. Process fitness values. 
                    2.0 eliminate the least fit timetable.
                    2.1 Find the best timetable so far
                    2.2 Find the total fitness values 
                    2.3 Normalize each fitness values: (fitnessVale/TotalFitness) * 100
                3. Prepare matingPool indexes and the selection Pool
                    3.1 Populate the matingPool
                    3.2 Populate the selectionPool
                4. ELITISM find the elite/s 
                    4.1 
                    4.2 Save the top N timetables
                    4.3 Add the best timetable so far to population[i] 
                     
                4. SELECTION parentA and parentB.
                5. CROSSOVER parentA and parentB. 
                6. MUTATE child
                7. Add to the population //starting @ pop[i]  

            }

        */

        $generation = 0;
        while((!$fitTimetableFound) and ($generation < TimetableConfig::MAX_GEN)){
            $matingPool = []; // just the index of timetable, conserver memory, increase efficiency. 
            $selectionPool = [];
            $totalFitnessValues = 0;
            $parentA = 0;
            $parentA = 0;
            print_r("\n<h2>=======================generation: ".$generation."======================================</h2>");
            
            
            
            
            
            // 1. evaluate fitness of timetables (population)
            for($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++){
                
                $timetableFitness[$timetable] = $this->calcFitness($population[$timetable]);


                if(($timetableFitness[$timetable] == 0 )){
                    $fitTimetableFound = true;
                    print_r("\n<h1>FOUND!!! CONFLICTS: ".$timetableFitness[$timetable]." </h1>");
                    // display pop. 
                    
                    $tempTable = $population[$timetable];
                    for($i=0; $i < sizeof($tempTable); $i++){
                        
                        print_r("\nmtID:    ".$tempTable[$i]->getID(). 
                                "\tscID: ".$tempTable[$i]->getSubjectClass()->getID(). 
                                "\t\tts: ".$tempTable[$i]->getTimeslot(). 
                                "\t\trmID: ".$tempTable[$i]->getSubjectClass()->getRoom()->getID().
                                "\t\ttgID: ".$tempTable[$i]->getSubjectClass()->getTraineeGroup()->getID(). 
                                "\t\tinID: ".$tempTable[$i]->getSubjectClass()->getInstructor()->getID()
                                );
                    }
                   
                     $tempTable = null;
                    print_r("\n".""."\n");
                    echo memory_get_usage() - $startMemory, ' bytes';
                    var_dump( ini_get('memory_limit') );
                    var_dump(memory_get_usage() );
                    
                    $time_end = microtime(true);

                    //dividing with 60 will give the execution time in minutes other wise seconds
                    $execution_time = ($time_end - $time_start);

                    //execution time of the script
                    echo '<b>Total Execution Time:</b> '.$execution_time.'sec';
                    exit();
                }
            }

            /* if there were no fit timetable found, restart from scratch
             * generation a new population
             *
             */

            if(!$fitTimetableFound){
                $timetableID = 1;  // will be replaced by the actual database table id later
                $population = [];
                $timetableFitness = [];
                $subjectClassSets = [];
                $fitnessHighest = null;
                $fitnessLowest = null;
                $fitTimetableFound = false;
                print_r("\nGenerating timetable:");
                for($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++){
                    fmod($timetable, 25) ? print_r("") : print_r("\n");
                    print_r($timetable.", ");
                    $subjectClassSets[$timetable] = $this->createSubjectClass($baseSubjectClass);
                    $population[$timetable] = $this->createTimetable($subjectClassSets[$timetable]);
                    $timetableFitness[$timetable] = $this->calcFitness($population[$timetable]);
                }
            }


            // 2. Process fitness values. 
            
            $uniqueFitnessValues = array_unique ($timetableFitness);
            
            asort($uniqueFitnessValues);
            
            
            
            // 2.0 eliminate the least fit timetable.
            array_pop($uniqueFitnessValues); // remove the least fit from selection pool
            print_r("\nuniqueFitnessValues: ");
            foreach($uniqueFitnessValues as $key => $value){
                print_r("[".$key."]=><b>".$value."</b> ");
            }



            // find the min/max fitness values from the assoc timetableFitness
            
            // 2.1 Find the best timetable so far
            $fitnessHighest = [array_search(min($timetableFitness), $timetableFitness) => min($timetableFitness)];
            $fitnessLowest = [array_search(max($timetableFitness), $timetableFitness) => max($timetableFitness)];
            // print_r("\nfitnessHighest CONFLICTS: \t<b>".$uniqueFitnessValues[$fitnessHighest]."</b>");
            // print_r("\nfitnessLowest CONFLICTS: \t<b>".$uniqueFitnessValues[$fitnessLowest]."</b>");


            // 2.2 Find the total fitness values
            foreach($uniqueFitnessValues as $key => $fitnessValue){
                $matingPoolFrequency = round( (1 / ($fitnessValue+1)* 100));
                $totalFitnessValues += $matingPoolFrequency;
            }

            // 2.3 Normalize each fitness values: (fitnessVale/TotalFitness) * 100
            foreach($uniqueFitnessValues as $key => $fitnessValue){
                $x =   (round( (1 / ($fitnessValue+1)* 100)));

                // 2.3 Normalize each fitness values: (fitnessVale/TotalFitness) * 100 
                $matingPoolFrequency = round(((round( (1 / ($fitnessValue+1)* 100))) / $totalFitnessValues) * 100);
                              
                // 3. prepare matingPool indexes
                // 3.1 Populate the matingPool
                
                for($i=0; $i < $matingPoolFrequency; $i++){
                    $matingPool [] = $key;
                }

                // 3.2 Populate the selectionPool
                // the first key in this pool is the fittest so far 
                $selectionPool[$key] = $population[$key];

            }


            // // display pop. 
            // print_r("\nsizeof(population): ".sizeof($population)."\n");
            // for($j=0; $j <sizeof($population); $j++){
            //     print_r("\nOrigPop: ".$j." **************************** :  ");
            //     $tempTable = $population[$j];
            //     for($i=0; $i < sizeof($tempTable); $i++){
            //         print_r("\nmtID:    ".$tempTable[$i]->getID(). 
            //                 "\tscID: ".$tempTable[$i]->getSubjectClass()->getID(). 
            //                 "\t\tts: ".$tempTable[$i]->getTimeslot(). 
            //                 "\t\trmID: ".$tempTable[$i]->getSubjectClass()->getRoom()->getID().
            //                 "\t\ttgID: ".$tempTable[$i]->getSubjectClass()->getTraineeGroup()->getID(). 
            //                 "\t\tinID: ".$tempTable[$i]->getSubjectClass()->getInstructor()->getID()
            //                 );
            //     }
            // }
            //  $tempTable = null;

            $n=0;
            // ELITISM find the elite/s 
            // 4.2 save the top n timetables
            foreach($selectionPool as $key=>$value){
                // 4.3 Add the best timetable so far to population[i]

                // $population[$n] =  $value;
                for($j=0; $j <sizeof($value); $j++){
                    $population[$n][$j] = clone $value[$j];

                }
                if ($n >= TimetableConfig::ELITISM - 1 ){
                    break;
                }
                $n++;
            }
            // print_r("\nBefore step 4 SELECTION. n last val: ".$n."\n");

            

            // // display pop. 
            // print_r("\nsizeof(population): ".sizeof($population)."\n\n");
            // for($j=0; $j <sizeof($population); $j++){
            //     print_r("\nELITISM: ".$j." ********************** :  ");
            //     $tempTable = $population[$j];
            //     for($i=0; $i < sizeof($tempTable); $i++){
            //         print_r("\nmtID:    ".$tempTable[$i]->getID(). 
            //                 "\tscID: ".$tempTable[$i]->getSubjectClass()->getID(). 
            //                 "\t\tts: ".$tempTable[$i]->getTimeslot(). 
            //                 "\t\trmID: ".$tempTable[$i]->getSubjectClass()->getRoom()->getID().
            //                 "\t\ttgID: ".$tempTable[$i]->getSubjectClass()->getTraineeGroup()->getID(). 
            //                 "\t\tinID: ".$tempTable[$i]->getSubjectClass()->getInstructor()->getID()
            //                 );

            //     }
            // }

            print_r("\n(population): ".sizeof($population)."");
            for($timetable=TimetableConfig::ELITISM; $timetable < TimetableConfig::POP_SIZE; $timetable++){
                   
               
                // 4. SELECTION parentA and parentB.
                $parentA = $matingPool[rand(0, sizeof($matingPool)-1)]; // from this index, it returns the value corresponding to 
                $parentB = $matingPool[rand(0, sizeof($matingPool)-1)]; // the index($key) from the selection pool.
                
                // print_r($matingPool);
                // print_r($selectionPool);
                // print_r("\nselectionPool: ".sizeof($selectionPool)."");
                // print_r("\tselection pool index: [");
                // foreach($selectionPool as $key => $value){
                //     print_r($key.", ");
                // }
                // print_r("]\t(matingPool): ".sizeof($matingPool)."");
                
                // print_r("\tparentA index: ".$parentA." ");//print_r("value: ".$matingPool[$parentA]." ");
                // print_r("\tparentB index: ".$parentB." ");//print_r("value: ".$matingPool[$parentB]." ");

                // print_r("\n\ntimetable=>".$timetable." \n\n");
                // print_r("\n\nCROSSOVER parentA and parentB. \nSizeof/var_dump child: "." ");

                // 5. CROSSOVER parentA and parentB. 
                $child = null;
                $child = $this->crossover($selectionPool[$parentA], $selectionPool[$parentB]);
                

                // print_r(sizeof($child));
                // print_r("\nsizeof(population): ".sizeof($population)."\n");
                // print_r("\n*CROSSOVER parents********************* :  ");
                // for($i=0; $i < sizeof($child); $i++){
                //         print_r("\n------------------------------------------------\nselectionPoolA mtID: ".$selectionPool[$parentA][$i]->getID(). 
                //             "\tscID: ".$selectionPool[$parentA][$i]->getSubjectClass()->getID(). 
                //             "\t\tts: ".$selectionPool[$parentA][$i]->getTimeslot()
                //             );

                //     print_r("\nchild          mtID: ".$child[$i]->getID(). 
                //             "\tscID: ".$child[$i]->getSubjectClass()->getID(). 
                //             "\t\tts: ".$child[$i]->getTimeslot()
                //             );
                //         print_r("\nselectionPoolB mtID: ".$selectionPool[$parentB][$i]->getID(). 
                //             "\tscID: ".$selectionPool[$parentB][$i]->getSubjectClass()->getID(). 
                //             "\t\tts: ".$selectionPool[$parentB][$i]->getTimeslot()
                //             );
                // }





                // for($j=0; $j <sizeof($population[4]); $j++){

                //     // print_r($population[2][$j]);
                //     $population[4][$j] = clone $selectionPool[$parentA][$j];

                // }
                // for($j=0; $j <sizeof($population[5]); $j++){

                //     // print_r($population[2][$j]);
                //     $population[5][$j] = clone $selectionPool[$parentB][$j];

                // }





                // // display pop. 
                // print_r("\nsizeof(population): ".sizeof($population)."\n\n");
                // for($j=0; $j <sizeof($population); $j++){
                //     print_r("\nMOD CROSSOVER parents, pop timetable: ".$j." ************************ :  ");
                    
                //     $tempTable = $population[$j];
                //     for($i=0; $i < sizeof($tempTable); $i++){
                //         print_r("\nmtID:    ".$tempTable[$i]->getID(). 
                //                 "\tscID: ".$tempTable[$i]->getSubjectClass()->getID(). 
                //                 "\t\tts: ".$tempTable[$i]->getTimeslot(). 
                //                 "\t\trmID: ".$tempTable[$i]->getSubjectClass()->getRoom()->getID().
                //                 "\t\ttgID: ".$tempTable[$i]->getSubjectClass()->getTraineeGroup()->getID(). 
                //                 "\t\tinID: ".$tempTable[$i]->getSubjectClass()->getInstructor()->getID()
                //                 );
                //     }
                // }
                // $tempTable = null;






                // print_r("\nBEFORE MUTATE child timetable: ".$j." ************************ :  ");
                // for($i=0; $i < sizeof($child); $i++){
                //         print_r("\nmtID:    ".$child[$i]->getID(). 
                //                 "\tscID: ".$child[$i]->getSubjectClass()->getID(). 
                //                 "\t\tts: ".$child[$i]->getTimeslot(). 
                //                 "\t\trmID: ".$child[$i]->getSubjectClass()->getRoom()->getID().
                //                 "\t\ttgID: ".$child[$i]->getSubjectClass()->getTraineeGroup()->getID(). 
                //                 "\t\tinID: ".$child[$i]->getSubjectClass()->getInstructor()->getID()
                //                 );

                //     }



                    
                // 6. MUTATE child 
                for($j=0; $j <sizeof($child); $j++){
                    $clone[$j] = clone $child[$j];

                }
                $child = null;
                $child = $this->mutate($clone);
                

                // print_r("\nAFTER MUTATE child timetable: ".$j." ************************ :  ");
                // for($i=0; $i < sizeof($child); $i++){
                //         print_r("\nmtID:    ".$child[$i]->getID(). 
                //                 "\tscID: ".$child[$i]->getSubjectClass()->getID(). 
                //                 "\t\tts: ".$child[$i]->getTimeslot(). 
                //                 "\t\trmID: ".$child[$i]->getSubjectClass()->getRoom()->getID().
                //                 "\t\ttgID: ".$child[$i]->getSubjectClass()->getTraineeGroup()->getID(). 
                //                 "\t\tinID: ".$child[$i]->getSubjectClass()->getInstructor()->getID()
                //                 );

                // }

                // print_r("\nAFTER MUTATE clone timetable: ".$j." ************************ :  ");
                // for($i=0; $i < sizeof($clone); $i++){
                //         print_r("\nmtID:    ".$clone[$i]->getID(). 
                //                 "\tscID: ".$clone[$i]->getSubjectClass()->getID(). 
                //                 "\t\tts: ".$clone[$i]->getTimeslot(). 
                //                 "\t\trmID: ".$clone[$i]->getSubjectClass()->getRoom()->getID().
                //                 "\t\ttgID: ".$clone[$i]->getSubjectClass()->getTraineeGroup()->getID(). 
                //                 "\t\tinID: ".$clone[$i]->getSubjectClass()->getInstructor()->getID()
                //                 );

                // }

                // 7. Add to the population //starting @ pop[i]
                for($j=0; $j <sizeof($population[$timetable]); $j++){
                    $population[$timetable][$j] = clone $child[$j];

                }




                // // display pop. 
                // print_r("\nsizeof(population): ".sizeof($population)."\n\n");
                // for($j=0; $j <sizeof($population); $j++){
                //     print_r("\nW/ MUTATED child pop: ".$j." ************************ :  ");
                    
                //     $tempTable = $population[$j];
                //     for($i=0; $i < sizeof($tempTable); $i++){
                //         print_r("\nmtID:    ".$tempTable[$i]->getID(). 
                //                 "\tscID: ".$tempTable[$i]->getSubjectClass()->getID(). 
                //                 "\t\tts: ".$tempTable[$i]->getTimeslot(). 
                //                 "\t\trmID: ".$tempTable[$i]->getSubjectClass()->getRoom()->getID().
                //                 "\t\ttgID: ".$tempTable[$i]->getSubjectClass()->getTraineeGroup()->getID(). 
                //                 "\t\tinID: ".$tempTable[$i]->getSubjectClass()->getInstructor()->getID()
                //                 );

                //     }
                // }
                
                
                
                // // 7. Add to the population //starting @ pop[i]
                // $population[$timetable] = $child; // array of MeetingTime object 
                // print_r("\nstarting sizeof(population: ".sizeof($population)."\n");
                // $timetableFitness[$timetable] = $this->calcFitness($population[$timetable]); // fitness value 
                // print_r("timetableFitness: "."\n ");
                // print_r($timetableFitness);


                // if(($timetableFitness[$timetable] == 0)){
                //     $fitTimetableFound = true;
                //     // jump to pass the Timetable to TimetableView to display it 
                //     print_r("\n\n=======================timetable: ".$timetable."======================================\n");
                //     print_r("\n<h1>FOUND!!! CONFLICTS: ".$timetableFitness[$timetable]." Generation: ".$generation."</h1>");
                //     break;
                // }
            }
 








            $generation++;
        }



        print_r("\n".""."\n");
        echo memory_get_usage() - $startMemory, ' bytes';
        var_dump( ini_get('memory_limit') );
        var_dump(memory_get_usage() );
        
        $time_end = microtime(true);

        //dividing with 60 will give the execution time in minutes other wise seconds
        $execution_time = ($time_end - $time_start);

        //execution time of the script
        echo '<b>Total Execution Time:</b> '.$execution_time.'sec';
    }



    /* 
     |--------------------------------------------------------------------------
     | name
     |--------------------------------------------------------------------------
     | 
     | desc 
     | 
     | 
     | 
     | 
     */


    public function displayTimetable($timetable){
        echo "<br/><br/>\tSC-ID \tTimeslot \t TGroup \t Subj Name-Inst \t Room<br>";
        for ($i=0; $i<sizeof($timetable); $i++){
            echo "<br/> {$i} "; 
            
            print_r ("\t".$timetable[$i][0]->getID());
            print_r ("\t ".$timetable[$i][1]);
            print_r ("\t".$timetable[$i][0]->getTraineeGroup()->getTraineeGroupName());
            print_r ("\t".$timetable[$i][0]->getSubject()->getSubjectCode()." - ".
                            $timetable[$i][0]->getInstructor()->getFirst_name()
                    );
            print_r ("\t\t\t".$timetable[$i][0]->getRoom()->getName());
            
            echo "";
        }
    }

    
    /*
     * getDistBlock method 
     *
     * @param		number of periods per day, number of days per week
     * @return	 	array of size DAY, with number of periods per day
     *               Array
     *                   (
     *                       [0] => 2
     *                       [1] => 1
     *                       [2] => 1
     *                   )
     */

    public function getDistBlock($requiredNumberOfPeriods, $preferredNumberOfDays){

        $total = 0;
        $block = [];
        for ($i = 0; $i < ($preferredNumberOfDays - 1); $i++){
            $period = (int)( $requiredNumberOfPeriods / $preferredNumberOfDays);
            array_push($block, $period);
            $total += $period;
        }
        array_push($block, ($requiredNumberOfPeriods-$total));
        shuffle($block); // randomize distribution block 
        return $block;
    }

    public function getRandomSlot($numberOfPeriods, $preferred_start_period, $preferred_end_period){
        // subject-classes are taught in "d" number days with "p" number of periods per day
        // this loop is "per" distribution block
        // count: 3 Array
        // (
        //     [0] => 2
        //     [1] => 1
        //     [2] => 1
        // )
        
        $s = $preferred_start_period;
        $e = $preferred_end_period;
        // echo "<br/><br/><h3>periods between {$s}-{$e}</h3>";
        
        $period_start = (($preferred_start_period==null) ? 0 : $preferred_start_period-1);
        $period_end = (($preferred_end_period==null) ? TimetableConfig::TOTAL_PERIODS : $preferred_end_period-1);
        
        $done = false;
        while (!$done){
            $timeslot = [];
            $day = [];  
            $initSlot = mt_rand(0, TimetableConfig::TOTAL_TIME_SLOTS-1);
            // echo "\ninitSlot: {$initSlot}<br/>";
            for ($j=0; $j < $numberOfPeriods; $j++){
                // echo "\tj={$j} "; print_r($initSlot+$j);
                array_push($timeslot, $initSlot+$j);

                // echo "\tday: ";print_r( (int) (($initSlot+$j)/TimetableConfig::TOTAL_PERIODS) );

                // push the timeslot in $day array 
                array_push($day, ((int) (($initSlot+$j)/TimetableConfig::TOTAL_PERIODS) ));
            
            }
            // all timeslot belongs to the same day
            if ((count(array_unique($day)) === 1)){

                // if the selected starting period is from the preferred start onward
                if( ( fmod($timeslot[0],TimetableConfig::TOTAL_PERIODS) >= $period_start) && 
                    

                    // and the selected ending period is on or before the preferred ending period
                    (fmod($timeslot[sizeof($day)-1],TimetableConfig::TOTAL_PERIODS) <= $period_end)){

                    // then the slot selected is a match; 
                    $done = true;
                    $s = (fmod($timeslot[0],TimetableConfig::TOTAL_PERIODS))+1;
                    $e = (fmod($timeslot[sizeof($day)-1],TimetableConfig::TOTAL_PERIODS))+1;
                    // echo "\nstart: ".$s;
                    
                    // echo "\t end: ".$e;
                    
                    // echo "<br/>";
                }
                
            }
        }
        // echo "<br/>timeslot: ";print_r($timeslot);
        // echo "<br/><br/>";
        return $timeslot;
    }

    public function getTraineeGroup($ID){
        if($ID){
            $db = DB::getInstance();
            $db->query("SELECT * FROM trainee_group WHERE id = {$ID}");
            // echo "<br/>Result count: {$db->count()}<br/>";
            if ($db->count()){
                    // echo "<br/><br/>";print_r ($db->getResults()[0]);
                    // echo "<br/><br/>";print_r ($db->first()->name);
                    return new TraineeGroup(
                        $db->first()->id,
                        $db->first()->name,
                        $db->first()->section,
                        $db->first()->level,
                        $db->first()->remarks
                    );
            }
        }else{
            return null;
        }
        
    }

    public function getSubject($ID){
        if($ID){
            $db = DB::getInstance();
            $db->query("SELECT * FROM subject WHERE id = {$ID}");
            if ($db->count()){
                    return new Subject(
                        $db->first()->id,
                        $db->first()->code,
                        $db->first()->name,
                        $db->first()->required_period,
                        $db->first()->description
                    );
            }
        }else{
            return null;
        }
        
    }

    public function getRoom($ID){

        if ($ID){
            $db = DB::getInstance();
            $db->query("SELECT * FROM room WHERE id = {$ID}");
            // echo "<br/>getRoom Result count: {$db->count()}<br/>";
            if ($db->count()){
                    return new Room(
                        $db->first()->id,
                        $db->first()->name,
                        $db->first()->type,
                        $db->first()->location,
                        $db->first()->description
                    );
            }
        }else{
            // return null;
        }        
    }

    public function getRandomRoom($roomType){

        if ($roomType){
            $db = DB::getInstance();
            $db->query("SELECT * FROM room WHERE type = {$roomType}");

            // echo "<br/>getRandomRoom Result count: {$db->count()}<br/>";
            if ($db->count()){
                    $randomRoom = rand(0, $db->count()-1);
                    // echo "<br/>room ID chosen-------------:";print_r ($db->getResults()[$randomRoom]->id);
                    return new Room(
                            $db->getResults()[$randomRoom]->id,
                            $db->getResults()[$randomRoom]->name,
                            $db->getResults()[$randomRoom]->type,
                            $db->getResults()[$randomRoom]->location,
                            $db->getResults()[$randomRoom]->description
                    );
            }else{
                return null;
            }
        }        
    }


    public function getRoomType($ID){

        if ($ID){
            $db = DB::getInstance();
            $db->query("SELECT * FROM room_type WHERE id = {$ID}");
            // echo "<br/>getRoom Result count: {$db->count()}<br/>";
            if ($db->count()){
                    return new RoomType(
                        $db->first()->id,
                        $db->first()->name,
                        $db->first()->description
                    );
            }
        }else{
            return null;
        }        
    }

    public function getInstructor($ID){

        if ($ID){
            $db = DB::getInstance();
            $db->query("SELECT * FROM instructor WHERE id = {$ID}");
            // echo "<br/>getRoom Result count: {$db->count()}<br/>";
            if ($db->count()){
                    return new Instructor(
                        $db->first()->id,
                        $db->first()->first_name,
                        $db->first()->last_name,
                        $db->first()->remark
                    );
            }
        }else{
            return null;
        }        
    }
}
// class end 

