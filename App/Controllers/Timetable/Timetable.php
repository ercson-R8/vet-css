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
                    // echo "<br/>room_id specified: {$baseSubjectClass[$i]["room_id"]} ";
                    $room = $this->getRoom($baseSubjectClass[$i]["room_id"]);
                    $isRoomFixed = true;
                }else{
                    $room = $this->getRandomRoom($baseSubjectClass[$i]["room_type_id"]);
                    $isRoomFixed = false;
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
     * createMeetingTime method 
     *
     * @param		
     * @return	 	
     */
    public function createMeetingTime ($id, $subjectClass){
        // return new MeetingTime( $id, 
        //                         $subjectClassID,
        //                         $this->getTimeslot($subjectClass][0]);


        // );



        echo "<br/>Meeting ID: {$id}";print_r("");
        echo "<br/>subjectClass ID: ";print_r($subjectClass->getID());
         echo "<br/>subjectClass ID: ";($this->getTimeslot($subjectClass));
        //echo "<br/>Meeting ID: {id}";print_r();
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
            // print_r("\n\ttimeslots:".$timetable[$i]->getTimeslot().
            //         "\tscID ".$timetable[$i]->getSubjectClass()->getID(). 
            //         "\troomID: " .$timetable[$i]->getSubjectClass()->getRoom()->getID().
            //         "\tmtID: " .$timetable[$i]->getID()
            //         );
            // fetch timeslot that is associated with a subjectClassID
            array_push($timeslots, $timetable[$i]->getTimeslot());
            
        }
        // print_r("\nsizeof(timeslots): ".sizeof($timeslots)."\n");

        // remove duplicate timeslot from the list of timeslot that is associated with a subjectClassID
        $timeslots = (array_unique($timeslots)); 

        foreach($timeslots as $timeslot){
            // print_r("\mtID:".$timeslot->getID()." ");
            
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
            echo "\t";

            // print_r("\ntimeslot:".$timeslot." "); 
            // print_r("\tsubjectClass: ");
            // print_r(sizeof($subjectClassID)-sizeof(array_unique($subjectClassID)));
            // print_r("\t\troom: ");
            // print_r(sizeof($roomID)-sizeof(array_unique($roomID)));
            // print_r("\t\ttraineeGroupID: ");
            // print_r(sizeof($traineeGroupID)-sizeof(array_unique($traineeGroupID)));
            // print_r("\tinstructorID: ");
            // print_r(sizeof($instructorID)-sizeof(array_unique($instructorID)));
            // print_r("\tsubjectID: ");
            // print_r(sizeof($subjectID)-sizeof(array_unique($subjectID)));
            
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
        // $timetableA =  clone $parentA;
        // $timetableB =  clone $parentB;
        $child = [];

        $timeslotsA = [];
        $timeslotsB = [];

        $timetableSize = sizeof($parentA);

        for($i=0; $i < ($timetableSize); $i++){
             print_r("\n------------------------------------------------\ntimetableA mtID: ".$parentA[$i]->getID(). 
                    "\tscID: ".$parentA[$i]->getSubjectClass()->getID(). 
                    "\t\tts: ".$parentA[$i]->getTimeslot()
                    );
             print_r("\ntimetableB mtID: ".$parentB[$i]->getID(). 
                    "\tscID: ".$parentB[$i]->getSubjectClass()->getID(). 
                    "\t\tts: ".$parentB[$i]->getTimeslot()
                    );
            $timeslotsA[$parentA[$i]->getSubjectClass()->getID()][] = $parentA[$i]->getTimeslot();
            $timeslotsB[$parentB[$i]->getSubjectClass()->getID()][]= $parentB[$i]->getTimeslot();

        }

        print_r("\nTimeslotsA: ");
        print_r($timeslotsA);
        print_r("\nTimeslotsB: ");
        print_r($timeslotsB);

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

        print_r("\nchild: ");
        print_r($timeslotsC);


        foreach($timeslotsC as $key => $values){
            print_r("\nkey: ".$key);
            foreach($values as $key => $timeslot )
                print_r(" ,".$timeslot);
        }

        
        // choose base timeslots for the child;
        // $child = ($luckyPick) ?   $parentB :  $parentA;
        if($luckyPick){
            foreach($parentB as $key => $value){
                $child[] = clone $value;
            }
        }else{
            foreach($parentA as $key => $value){
                $child[] = clone $value;
            }
        }

       
        print_r("\nLUCKPICK: ".$luckyPick);
        // insert the $timetableC timeslots into the child
        for($i=0; $i < ($timetableSize); $i++){
            print_r("\n------------------------------------------------\nchild mtID: ".$child[$i]->getID(). 
                    "\tscID: ".$child[$i]->getSubjectClass()->getID(). 
                    "\t\tts: ".$child[$i]->getTimeslot()
                    );
            print_r($timeslotsC[$child[$i]->getSubjectClass()->getID()]);
            $timeslot_pop = array_pop($timeslotsC[$child[$i]->getSubjectClass()->getID()]);
            print_r($timeslot_pop);
            $child[$i]->setTimeslot($timeslot_pop);
        }

        for($i=0; $i < ($timetableSize); $i++){
            print_r("\n------------------------------------------------\nparentA mtID: ".$parentA[$i]->getID(). 
                    "\tscID: ".$parentA[$i]->getSubjectClass()->getID(). 
                    "\t\tts: ".$parentA[$i]->getTimeslot()
                    );

        }
        // $child[0]->setTimeslot(111);
        // $child[1]->setTimeslot(222);

        for($i=0; $i < ($timetableSize); $i++){
            print_r("\n------------------------------------------------\nchild mtID: ".$child[$i]->getID(). 
                    "\tscID: ".$child[$i]->getSubjectClass()->getID(). 
                    "\t\tts: ".$child[$i]->getTimeslot()
                    );

        }

        for($i=0; $i < ($timetableSize); $i++){
            print_r("\n------------------------------------------------\nparentB mtID: ".$parentB[$i]->getID(). 
                    "\tscID: ".$parentB[$i]->getSubjectClass()->getID(). 
                    "\t\tts: ".$parentB[$i]->getTimeslot()
                    );

        }

        // $child[2]->setTimeslot(000);
        // $child[3]->setTimeslot(555);

        for($i=0; $i < ($timetableSize); $i++){
             print_r("\n------------------------------------------------\nparentA mtID: ".$parentA[$i]->getID(). 
                    "\tscID: ".$parentA[$i]->getSubjectClass()->getID(). 
                    "\t\tts: ".$parentA[$i]->getTimeslot()
                    );

            print_r("\nchild   mtID: ".$child[$i]->getID(). 
                    "\tscID: ".$child[$i]->getSubjectClass()->getID(). 
                    "\t\tts: ".$child[$i]->getTimeslot()
                    );
             print_r("\nparentB mtID: ".$parentB[$i]->getID(). 
                    "\tscID: ".$parentB[$i]->getSubjectClass()->getID(). 
                    "\t\tts: ".$parentB[$i]->getTimeslot()
                    );
            
            // $timeslotsA[$timetableA[$i]->getSubjectClass()->getID()][] = $timetableA[$i]->getTimeslot();
            // $timeslotsB[$timetableB[$i]->getSubjectClass()->getID()][]= $timetableB[$i]->getTimeslot();

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
        $mutant = $child;
        
        
        
        for($i=0; $i < sizeof($child); $i++){
            $rand = (rand(0,100)/100);
            print_r("\nrand: ".$rand."\t".TimetableConfig::MUTATION_RATE." MUTATION_RATE");
            if ( $rand < TimetableConfig::MUTATION_RATE){
                print_r("\n\n"."child"."\t");
                print_r("".$mutant[$i]->getTimeslot()."\t");

                print_r(" "."getRoomType"."\t");
                print_r($mutant[$i]->getSubjectClass()->getRoomType()->getID());

                print_r(" "."getRoom"." ");
                print_r($mutant[$i]->getSubjectClass()->getRoom()->getID());

                $roomTypeID = $mutant[$i]->getSubjectClass()->getRoomType()->getID(); 
                $randomRoom = $this->getRandomRoom($roomTypeID); 

                $mutant[$i]->getSubjectClass()->setRoom($randomRoom); 
                  
                print_r(" "."randomRoom"." ");
                print_r($mutant[$i]->getSubjectClass()->getRoom()->getID());
            }
            
        }
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
        for($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++){
                print_r("\n\n=======================timetable: ".$timetable."======================================\n");
                $subjectClassSets[$timetable] = $this->createSubjectClass($baseSubjectClass);
                $population[$timetable] = $this->createTimetable($subjectClassSets[$timetable]);
                $timetableFitness[$timetable] = $this->calcFitness($population[$timetable]);
                print_r("\n<h3>TOTAL CONFLICTS: ".$timetableFitness[$timetable]." </h3>");
                if(($timetableFitness[$timetable] == 0)){
                    $fitTimetableFound = true;
                    break;
                }
        }

        /* error checking for the length of the population index $timetable. 
           no fit timetable is found, the lenght of the population is equal to 
           ($timetable-1)
        */ 
        if (!$fitTimetableFound){
            $timetable--;
        }

        print_r("\nSize timetableFitness: ".sizeof($timetableFitness)."\n");print_r($timetableFitness);
        
        $uniqueFitnessValues = array_unique ($timetableFitness);
        
        asort($uniqueFitnessValues);
        
        print_r("\nSize uniqueFitnessValues:  ".sizeof($uniqueFitnessValues)."\n");print_r($uniqueFitnessValues);
        // if 100% just pop the last one
        
        array_pop($uniqueFitnessValues);
        // else, retain the n%. smaller selection pool. 

        print_r("\nSize POP uniqueFitnessValues:  ".sizeof($uniqueFitnessValues)."\n");print_r($uniqueFitnessValues);

        // find the min/max fitness values from the assoc timetableFitness
        $fitnessHighest = [array_search(min($timetableFitness), $timetableFitness) => min($timetableFitness)];
        $fitnessLowest = [array_search(max($timetableFitness), $timetableFitness) => max($timetableFitness)];
        print_r($fitnessHighest);
        print_r($fitnessLowest);

        // draw()
        //  # Step 1: Selection 

        //    # Create an empty mating pool (an empty ArrayList)
        $matingPool = []; // just the index of timetable, conserver memory, increase efficiency. 
        $selectionPool = [];
        /*
            Size timetableFitness: 5
            Array
            (
                [0] => 12
                [1] => 14
                [2] => 9
                [3] => 15
                [4] => 3
            )

            Size uniqueFitnessValues:  5
            Array
            (
                [4] => 3
                [2] => 9
                [0] => 12
                [1] => 14
                [3] => 15
            )

            Size POP uniqueFitnessValues:  4
            Array
            (
                [4] => 3
                [2] => 9
                [0] => 12
                [1] => 14
            )
            Array fitnessHighest
            (
                [4] => 3
            )
            Array fitnessLowest
            (
                [3] => 15
            )

            x= 0 key: 4 matingPoolFrequency: 25
            x= 1 key: 2 matingPoolFrequency: 10
            x= 2 key: 0 matingPoolFrequency: 8
            x= 3 key: 1 matingPoolFrequency: 7
            Size matingPool :  50

        */

        //    # For every member of the population, evaluate its fitness based on some criteria / function, 
        //      and add it to the mating pool in a manner consistant with its fitness, i.e. the more fit it 
        //      is the more times it appears in the mating pool, in order to be more likely picked for reproduction.
        $x = 0;
        $totalFitnessValues = 0;
        foreach($uniqueFitnessValues as $key => $fitnessValue){
            $matingPoolFrequency = round( (1 / ($fitnessValue+1)* 100));
            print_r("\nx= ".$x." key: ".$key." matingPoolFrequency: ".$matingPoolFrequency);
            $totalFitnessValues += $matingPoolFrequency;
            $x++;
        }
        print_r("\nSize matingPool :  ".($totalFitnessValues)."\n"); //print_r($matingPool);
       
        print_r("\n*********************** :  ");
        
        foreach($uniqueFitnessValues as $key => $fitnessValue){
            $x =   (round( (1 / ($fitnessValue+1)* 100)));

            // normalize the fitnessValue / totalFitnessValues then * 100 then round it up. 
            $matingPoolFrequency = round(((round( (1 / ($fitnessValue+1)* 100))) / $totalFitnessValues) * 100);
            print_r("\n\t totalFitnessValues ".$totalFitnessValues." ");
            print_r("\t matingPoolFrequency ".$matingPoolFrequency." ");
            print_r("\t\t x ".$x ." ");
            print_r("\t key".$key." ");
            print_r("\t fitnessValue".$fitnessValue."\n");
            
            for($i=0; $i < $matingPoolFrequency; $i++){
                $matingPool [] = $key;
            }

            $selectionPool[$key] = $population[$key];

        }
        print_r("\nSize matingPool :  ".sizeof($matingPool)."\n");//print_r($matingPool);
         print_r("\nSize selectionPool :  ".sizeof($selectionPool)."\n");//print_r($selectionPool);



        // //  # Step 2: Reproduction Create a new empty population
        $population = [];
        print_r("\nElistim: ".TimetableConfig::ELITISM);
        // elitism, ensure top fit timetable/s are kept
        /*
            $i = 1;
            foreach $selectionPool as $key => $value {
                $population[] = $value;
                if ($i == elites){
                    break;
                }
                $i++; 
            }

        */
        $i = 0;
        foreach($selectionPool as $key=>$value){
            $populatio[$i] = $value;
            if ($i >= TimetableConfig::ELITISM - 1 ){
                break;
            }
            $i++;
        }
       
        /*
                Size matingPool :  17
                Array
                (
                    [0] => 1
                    [1] => 1
                    [2] => 1
                    [3] => 1
                    [4] => 1
                    [5] => 1
                    [6] => 1
                    [7] => 1
                    [8] => 1
                    [9] => 1
                    [10] => 2
                    [11] => 2
                    [12] => 2
                    [13] => 2
                    [14] => 2
                    [15] => 2
                    [16] => 2
                )
        */
        //    # Fill the new population by executing the following steps:
        //       1. Pick two "parent" objects from the mating pool.
        //       2. Crossover -- create a "child" object by mating these two parents.
        for($i=0; $i < sizeof($selectionPool); $i++){  

            $parentA = $matingPool[rand(0, sizeof($matingPool)-1)]; // from this index, it returns the value corresponding to 
            $parentB = $matingPool[rand(0, sizeof($matingPool)-1)]; // the index($key) from the selection pool. 
            
            print_r("\n".$i." parentA ".$parentA." ");
            print_r("\tparentA ".$parentB." ");
            print_r("\t Max pool size: ");
            $x=(sizeof($matingPool));
            print_r($x);
        }
        $child = $this->crossover($selectionPool[$parentA], $selectionPool[$parentB]);
        print_r("\n********************************************************************************************* :  ");
        for($i=0; $i < sizeof($child); $i++){
             print_r("\n------------------------------------------------\nselectionPoolA mtID: ".$selectionPool[$parentA][$i]->getID(). 
                    "\tscID: ".$selectionPool[$parentA][$i]->getSubjectClass()->getID(). 
                    "\t\tts: ".$selectionPool[$parentA][$i]->getTimeslot()
                    );

            print_r("\nchild          mtID: ".$child[$i]->getID(). 
                    "\tscID: ".$child[$i]->getSubjectClass()->getID(). 
                    "\t\tts: ".$child[$i]->getTimeslot()
                    );
             print_r("\nselectionPoolB mtID: ".$selectionPool[$parentB][$i]->getID(). 
                    "\tscID: ".$selectionPool[$parentB][$i]->getSubjectClass()->getID(). 
                    "\t\tts: ".$selectionPool[$parentB][$i]->getTimeslot()
                    );
            
            // $timeslotsA[$timetableA[$i]->getSubjectClass()->getID()][] = $timetableA[$i]->getTimeslot();
            // $timeslotsB[$timetableB[$i]->getSubjectClass()->getID()][]= $timetableB[$i]->getTimeslot();

        }
        // // print_r($child);
        // for ($i=0; $i < sizeof($child); $i++){

        //     // print_r("\n"."parentA"."\t");
        //     // print_r($selectionPool[$parentA][$i]->getTimeslot()."\t");

        //     // print_r(" "."child"."\t");
        //     // print_r("".$child[$i]->getTimeslot()."\t");
            

        //     // print_r(" "."parentB"."\t");
        //     // print_r("".$selectionPool[$parentB][$i]->getTimeslot()."\t");
        // }
        
        // print_r("\n---------".$parentA."-------------\n");
        // print_r($selectionPool[$parentA]);



        //       3. Mutation -- mutate the child's DNA based on a given probability.
        // $child = $this->mutate($child);

        //       4. Add the child object to the new population.
        // $population [] = $child;
        //    # Replace the old population with the new population
        //  
        //   # Rinse and repeat

        // }      
        // how to mutate
        // $roomTypeID = $subjectClass[0][1]->getRoomType()->getroomTypeID();  
        // $room = $this->getRandomRoom($roomTypeID);
        // $subjectClass[0][1]->setRoom($room);
        // $room = $this->getRandomRoom($roomTypeID);
        // $subjectClass[0][2]->setRoom($room);

        // print_r("\n\n=======================================================");
        // for ($j=0; $j < sizeof($subjectClass[0]); $j++){
        //     print_r("\n[0,{$j}]: getID: ".$subjectClass[0][$j]->getID());           
        //     print_r("\t\troomType: ".$subjectClass[0][$j]->getRoomType()->getRoomTypeID());
        //     print_r("\t\tRoom: ".$subjectClass[0][$j]->getRoom()->getName());
        // }
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

