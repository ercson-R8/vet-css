<?php

namespace App\Controllers\Timetable;

use App\Models\DB;
use App\TimetableConfig;
use App\Controllers\Auth\Session;

class Timetable{

    private $subjects, $traineeGroups, $rooms, $roomTypes, $instructors = null;
    private $population = [];
    private $baseSubjectClass = null;

    /*
     * fetchBaseSubjectClass method fetches raw data from the database
     * returns an array representing the subject_class table.  
     *  
     *
     * @param		int         timetable id, from the table 'timetable'
     * @return	 	array       SubjectClasses objects; 
     */
    public function fetchBaseSubjectClass($timeTableID){
        
        $subjectClassSet = [];
        $db = DB::getInstance();
        $db->query("SELECT * FROM subject_class WHERE subject_class.timetable_id = {$timeTableID}");
        
        print_r($db->getResults());
        if ($db->count()) {
            $i=0;
            foreach ($db->getResults() as $subjectClass) {
                print_r("\nCopying tables..."."\n");
                // this will collect each row of the selected table and store
                // all of it in an assoc array.
                $subjectClassSet[$subjectClass->id] =[
                    "id" => $subjectClass->id,
                    "timetable_id" => $subjectClass->timetable_id,
                    "subject_id" => $subjectClass->subject_id,
                    "trainee_group_id" => $subjectClass->trainee_group_id,
                    "instructor_id" => $subjectClass->instructor_id,
                    "room_id" => $subjectClass->room_id,
                    "room_type_id" => $subjectClass->room_type_id,
                    "room_fixed" => $subjectClass->room_fixed,
                    "preferred_start_period" => $subjectClass->preferred_start_period,
                    "preferred_end_period" => $subjectClass->preferred_end_period,
                    "preferred_number_days" => $subjectClass->preferred_number_days,
                ];
            }
        }else{
            // todo 
            print_r("\nError here no class found on this time timetable"."\n");
            print_r("\nSize of db->getResults() ".sizeof($db->getResults())."\n");
            exit;
        }


        return $subjectClassSet;
    }
    /*
     * assignRoom method assign a room to an individual
     *
     * @param		array       individual
     * @return	 	int         roomID
     */
    public function assignRoom($indi){   

        // Get a room room_fixed is set to null
        print_r("\nAssigning rooms...."."\n");
        if ($indi["room_fixed"]) { // room_id is provided, cannot be changed.
            
            $room = $this->getRoom($indi["room_id"])->getID();
            
        } else {
            
            $room = $this->getRandomRoom($indi["room_type_id"])->getID();
        }

        return $room;
    }


    /*
     * setInitTimeSlot method 
     *
     * @param		
     * @return	 	
     */
    public function setInitTimeSlot($subjectClassSet)
    {
        $timetable = [];
        $mt_id = 0;
        // get all the timeslot for this subjectClass
        // timeslots are based on the required period and preferred number of days
        // timeslots are distributed in ref to the number of days.

        foreach ($subjectClassSet as $key => $subjectClass) {
            // find a suitable timeslot for the current subjectCclass
            print_r("\nsetInitTimeSlot key: ".$key);
            $requiredPeriods = (int) $this->getSubject($subjectClass["subject_id"])->getRequiredPeriod();
            $preferredNumberOfDays = (int) $subjectClass["preferred_number_days"] ;
            $preferredStart = (int) $subjectClass["preferred_start_period"] ;
            $preferredEnd = (int) $subjectClass["preferred_end_period"] ;

            $timeslot = $this->getTimeslot( $requiredPeriods, $preferredNumberOfDays,
                                            $preferredStart, $preferredEnd);

            for ($j=0; $j < sizeof($timeslot); $j++) {
                // create a MeetingTime object for each timeslot.
                $timetable [] = ["mt_id"=>$mt_id, "sc"=>$subjectClass, "ts"=>$timeslot[$j]];
                $mt_id++;
            }
        }

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
    public function getTimeslot($requiredPeriod, $preferredNumberOfDays, $preferredStart, $preferredEnd){
        $timeslot = []; // subjectClass-timeslot
        // distribute the required period/s with the preferred number of day/s
        // returns an array. $distBlock = [ [day]=>[no. of periods] ]
        //     Array
        // (
        //     [0] => 2
        //     [1] => 1
        //     [2] => 1
        // )
        print_r("\nStart getTimeslot"."\n");
        $distBlock = $this->getDistBlock(   $requiredPeriod, $preferredNumberOfDays);
        print_r($distBlock);
        $day = [];
        for ($i=0; $i < count($distBlock); $i++) {
            $sameDay = true;
            while ($sameDay) {
                $temp_slot = $this->getRandomSlot(
                                        $distBlock[$i],
                                        $preferredStart, 
                                        $preferredEnd
                                );

                $daySelected = ((int) (($temp_slot[0])/TimetableConfig::TOTAL_PERIODS) );
                if (!in_array($daySelected, $day)) {
                    $day[]= $daySelected;

                    for ($j=0; $j < count($temp_slot); $j++) {
                        $timeslot[] =  $temp_slot[$j];
                    }
                        
                    $sameDay = false;
                }
            }
        }
        print_r("\nEnd getTimeslot"."\n");
        print_r($timeslot);
        return $timeslot;
    }


    public function getDistBlock($requiredPeriod , $preferredNumberOfDays){
        $total = 0;
        $block = [];
        $adjustedNumberOfDays = ($preferredNumberOfDays < 3) ? $preferredNumberOfDays: $preferredNumberOfDays-1;
        print_r("\ngetDistBlock() requiredPeriod : ".$requiredPeriod." preferredNumberOfDays : ".$preferredNumberOfDays."\n");
        for ($i = 0; $i < ($preferredNumberOfDays  - 1); $i++) {
            
            $period = (int)( $requiredPeriod  / ($adjustedNumberOfDays));
            array_push($block, $period);
            $total += $period;
        }
        array_push($block, ($requiredPeriod -$total));
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
        // print_r("\n\tgetRandomSlot numberOfPeriods: ".$numberOfPeriods." ");
        // print_r(" getRandomSlot preferred_start_period: ".$preferred_start_period." ");
        // print_r(" getRandomSlot preferred_end_period: ".$preferred_end_period." ");
        // $s = $preferred_start_period;
        // $e = $preferred_end_period;
        // echo "<br/><br/><h3>periods between {$s}-{$e}</h3>";
        
        $period_start = (($preferred_start_period==null) ? 0 : $preferred_start_period-1);
        $period_end = (($preferred_end_period==null) ? TimetableConfig::TOTAL_PERIODS : $preferred_end_period-1);
        
        $done = false;
        while (!$done) {
            $timeslot = [];
            $day = [];
            $initSlot = mt_rand(0, TimetableConfig::TOTAL_TIME_SLOTS-1);
            print_r("\n\tgetRandomSlot initSlot: ".$initSlot."\n");
            for ($j=0; $j < $numberOfPeriods; $j++) {

                array_push($timeslot, $initSlot+$j);


                // push the timeslot in $day array
                array_push($day, ((int) (($initSlot+$j)/TimetableConfig::TOTAL_PERIODS) ));
            }

            // all timeslot belongs to the same day
            if ((count(array_unique($day)) === 1)) {

                // if the selected starting period is from the preferred start onward
                if (( fmod($timeslot[0], TimetableConfig::TOTAL_PERIODS) >= $period_start) &&
                    

                    // and the selected ending period is on or before the preferred ending period
                    (fmod($timeslot[sizeof($day)-1], TimetableConfig::TOTAL_PERIODS) <= $period_end)) {
                    // then the slot selected is a match;
                    $done = true;
                    // $s = (fmod($timeslot[0], TimetableConfig::TOTAL_PERIODS))+1;
                    // $e = (fmod($timeslot[sizeof($day)-1], TimetableConfig::TOTAL_PERIODS))+1;
                }
            }
        }
        echo "<br/>timeslot: ";print_r($timeslot);
        echo "<br/><br/>";
        return $timeslot;
    }


    /*
     * calcFitness method 
     *
     * @param		array       of meetingTime object 
     * @return	 	array       the number of conflicts and the fitness value.        
     */
    public function calcFitness($timetable)
    {
        $timeslots = [];
        $totalConflicts = 0;
        for ($i=0; $i < sizeof($timetable); $i++) {
            // fetch timeslot that is associated with a subjectClassID
            array_push($timeslots, $timetable[$i]["ts"]);
        }
        // print_r($timetable);
        // remove duplicate timeslot from the list of timeslot that is associated with a subjectClassID
        $timeslots = (array_unique($timeslots));
        // print_r($timeslots);

        foreach ($timeslots as $timeslot) {
            $subjectClassID =[];
            $roomID = [];
            $traineeGroupID = [];
            $instructorID = [];
            $subjectID = [];

            for ($i=0; $i < sizeof($timetable); $i++) {
                // gather all IDs belonging to this timeslot.
                if ($timeslot == $timetable[$i]["ts"]) {
                    $subjectClassID[] = $timetable[$i]["sc"]["subject_id"];
                    $roomID[] = $timetable[$i]["sc"]["room_id"];
                    $traineeGroupID[] = $timetable[$i]["sc"]["trainee_group_id"];
                    $instructorID[] = $timetable[$i]["sc"]["instructor_id"];
                    $subjectID[]= $timetable[$i]["sc"]["id"];
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
    public function crossover($parentA, $parentB){


        $child = [];
        $timeslotsA = []; 
        $timeslotsB = [];

        $timetableSize = sizeof($parentA);

        // fetch and store timeslots of parent A & B to arrays timeslotA and timeslotB
        foreach ($parentA as $key => $value) {
            $timeslotsA[$key] [] = $parentA[$key]['ts'];
        }
        foreach ($parentB as $key => $value) {
            $timeslotsB[$key] [] = $parentB[$key]['ts'];
        }

        // choose base timeslots for the child;
        if (rand(0, 1)) {
            // timeslotC will be based on timeslotsA
            // print_r(" timeslotsA\n");            
            $timeslotsC = $timeslotsA;

            // crossover the timeslot set in $timeslotsA into the timeslotsC.             
            foreach ($timeslotsB as $key => $value) {
                if (rand(0, 1)) {
                    // print_r(" B+");
                    $timeslotsC[$key] = $value;
                }else {
                    // print_r(" A+");
                }
            }
        }else{
            // timeslotC will be based on timeslotsB
            // print_r(" timeslotsB\n");
            $timeslotsC = $timeslotsB;

            // crossover the timeslot set in $timeslotsA into the timeslotsC. 
            foreach ($timeslotsA as $key => $value) {
                if (rand(0, 1)) {
                    // print_r(" A+");
                    $timeslotsC[$key] = $value;
                }else {
                    // print_r(" B+");
                }
            }
        }
        
        if (rand(0, 1)) {
            foreach ($parentB as $key => $value) {
                $child[] = $value;
            }
        } else {
            foreach ($parentA as $key => $value) {
                $child[] = $value;
            }
        }

        // print_r($timeslotsA);
        // print_r($timeslotsB);
        // print_r($timeslotsC);

        // print_r($parentA);
        // print_r($parentB);
        // print_r($child);
        

        // insert the $timetableC timeslots into the child
        
        for ($i=0; $i < ($timetableSize); $i++) {

            // $timeslot_shift = array_shift($timeslotsC[$child[$i]->getSubjectClass()->getID()]);

            $timeslot_shift = array_shift($timeslotsC[$i]);
            // print_r(" timeslot_shift: ".$timeslot_shift."");
            $child[$i]['ts'] = $timeslot_shift;
        }
        // print_r($child);
        return $child;
    }

    /*
     * mutate method 
     *
     * @param		
     * @return	 	
     */
    public function mutate($childTimetable){
        $notApplied = 0;
        $applied = 0;
        $mutant = [];
        $mutant =  $childTimetable;

        $processedSubjectClassID = [];

        for ($i=0; $i < sizeof($childTimetable); $i++) {
            $rand = (mt_rand(0, 100)/100);
            if ($rand < TimetableConfig::MUTATION_RATE) {
                $applied++;
                $subjectClassID = $mutant[$i]['sc']['id'];

                if (!array_search($subjectClassID, $processedSubjectClassID)) {

                    $processedSubjectClassID[] = $subjectClassID; // include this id in the already processed array 

                    $isFixed = $mutant[$i]['sc']['room_fixed'] ;  //->getSubjectClass()->isRoomFixed();

                    if ($isFixed) {
                        // print_r("\nisFixed YES: ".$isFixed." ");
                    } else {
                        $roomTypeID = $mutant[$i]['sc']['room_type_id'] ; //->getSubjectClass()->getRoomType()->getID();
                        $randomRoom = $this->getRandomRoom($roomTypeID);
                        $mutant[$i]['sc']['room_id'] ; //->getSubjectClass()->setRoom($randomRoom);
                    }
                }
            }
            else{
                $notApplied++;
            }
        }

        print_r("\nMUTATION \tapplied: ".$applied."x.\tNot applied: ".$notApplied."x");
        unset($childTimetable);
        return $mutant;
    }

    /*
     * dispTable method 
     *
     * @param		
     * @return	 	
     */
    public function dispTable ($timetable, $sort = false){
        // print_r($timetable);
        /*
            foreach ($data as $key => $row) {
                $distance[$key] = $row['distance'];
            }

            array_multisort($distance, SORT_ASC, $data);
        */
        $tempTable = $timetable;
        foreach ($tempTable as $key => $row) {
            $ts[$key] = $row['ts'];
        }
        if ($sort){
            array_multisort($ts,SORT_ASC, $tempTable );
        }
        

        // usort($timetable, function($a, $b) {
        //     return (int)$a['ts'] - (int)$b['ts'];
        // });
        for($i=0; $i < sizeof($tempTable); $i++){
                        
        print_r("\nmID:    ".$tempTable[$i]["mt_id"]. 
                "\ttimeslot: ".$tempTable[$i]["ts"]. 
                "\t\t(Class: ".$tempTable[$i]["sc"]["id"].
                
                " Grp: ".$tempTable[$i]["sc"]["trainee_group_id"]. 
                ")\t(Sbj: ".$tempTable[$i]["sc"]["subject_id"].
                " Inst: ".$tempTable[$i]["sc"]["instructor_id"].
                ")\t["."id ".$tempTable[$i]["sc"]["room_id"]."-".
                        $this->getRoom($tempTable[$i]["sc"]["room_id"])->getName().
                "]");
    }
        
    }

    public function indexAction()
    {
        
        $sessionData = Session::getInstance();

        //place this before any script you want to calculate time
        $time_start = microtime(true);
        ini_set('max_execution_time', 600); //300 seconds = 5 minutes
        $startMemory = memory_get_usage();

        echo"Hello form TimetableController.... <pre>";
        $timetableID = $sessionData->currentTimetable;  // will be replaced by the actual database table id later
        print_r("\n".$timetableID."\n");


        $timetableFitness = [];
        $subjectClassSet = []; // contains base plus initial room assignment
        $fitnessHighest = null;
        $fitnessLowest = null;
        $fitTimetableFound = false;
         
        // base subjectClass is created once, to fetch data from mySQL tables
        // a POP_SIZE subjectClasses will be created from the base with
        // random rooms if the property roomFixed = null.
  
        $baseSubjectClass = $this->fetchBaseSubjectClass($timetableID);
        print_r("\nSize of base: ".sizeof($baseSubjectClass)."\n");
        print_r($baseSubjectClass);


        // setup()
        //  # Step 1: The Population
        //    # Fill it with DNA encoded objects (pick random values to start)
        for ($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++) { 
            foreach ($baseSubjectClass as $key => $value) {
                    $subjectClassSet[$timetable][$key] = $value;
                    $subjectClassSet[$timetable][$key]["room_id"] = $this->assignRoom($subjectClassSet[$timetable][$key]);
                    
            }
        }
        ;
        
        // print_r($subjectClassSet);

        for ($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++) { 

            $this->population[$timetable] = $this->setInitTimeSlot($subjectClassSet[$timetable]);
            $timetableFitness[$timetable] = $this->calcFitness($this->population[$timetable]);
            
            // evaluate fitness of timetables (population)
            // though it may be highly unlikely to generate a fit timetable at this stage
            // still possibility is there. 
            if(($timetableFitness[$timetable] == 0 )){
                $fitTimetableFound = true;
                $this->dispTable($this->population[$timetable]);

                print_r("\n".""."\n"); echo memory_get_usage() - $startMemory, ' bytes'; var_dump( ini_get('memory_limit') );
                var_dump(memory_get_usage() ); $time_end = microtime(true); $execution_time = ($time_end - $time_start);
                echo '<b>Total Execution Time:</b> '.$execution_time.'sec';

                return $this->population[$timetable] ;
            }
        }



        // print_r($timetableFitness);
        
        // for ($i=0; $i < sizeof($this->population); $i++) { 
        //     // print_r("\n"."\n");
        //     // $this->dispTable($this->population[$i]);
        // }


        /*
            while no fitTimetableFound {
                1. evaluate fitness of timetables (population)
                    
                2. Process fitness values. 
                    2.1 Find the best timetable so far
                    2.2 eliminate the least fit timetable.
                    2.3 Normalize each fitness values: (fitnessVale/TotalFitness) * 100
                3. Prepare matingPool indexes and the selection Pool
                    3.1 Populate the matingPool
                    3.2 Populate the selectionPool
                4. ELITISM find the elite/s 
                    4.1 
                    4.2 Save the top N timetables
                    4.3 Add the best timetable so far to population[i] 
                     
                5. SELECTION parentA and parentB.
                6. CROSSOVER parentA and parentB. 
                7. MUTATE child
                8. Add to the population //starting @ pop[i]  

            }

        */
        
        // while no fitTimetableFound 
        $generation = 0;
        while((!$fitTimetableFound) and ($generation < TimetableConfig::MAX_GEN)){
            print_r("\n<h2>======== generation: ".$generation." ===============</h2>");
            //     1. evaluate fitness of timetables (population)
            for($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++){
                $timetableFitness[$timetable] = $this->calcFitness($this->population[$timetable]);
                if(($timetableFitness[$timetable] == 0 )){
                    print_r("<h1>FOUND! CONFLICTS: ".$timetableFitness[$timetable]." </h1>");

                    $fitTimetableFound = true;

                    $this->dispTable($this->population[$timetable], true);
                    
                    print_r("\n".""."\n"); echo memory_get_usage() - $startMemory, ' bytes';
                    var_dump( ini_get('memory_limit') ); var_dump(memory_get_usage() );
                    $time_end = microtime(true);$execution_time = ($time_end - $time_start);
                    echo '<b>Total Execution Time:</b> '.$execution_time.'sec';

                    return $this->population[$timetable] ;
                }
            }

            // no fitTimetableFound, initialize the each population's chromosome again with new genes
            if(!$fitTimetableFound){
                $fitnessHighest = null;
                $fitnessLowest = null;
                $fitTimetableFound = false;
                $matingPool = []; // just use the index of the timetable, conserve memory, increase efficiency. 
                $selectionPool = [];
                $totalFitnessValues = 0;
                $parentA = 0;
                $parentA = 0;
                print_r("\nstarting at: ".(TimetableConfig::ELITISM)."\n");
                for ($timetable=TimetableConfig::ELITISM; $timetable < TimetableConfig::POP_SIZE; $timetable++) { 
                    foreach ($baseSubjectClass as $key => $value) {
                            $subjectClassSet[$timetable][$key] = $value;
                            $subjectClassSet[$timetable][$key]["room_id"] = $this->assignRoom($subjectClassSet[$timetable][$key]);
                            
                    }
                    $this->population[$timetable] = $this->setInitTimeSlot($subjectClassSet[$timetable]);
                }
            }

            //     2. Process fitness values. 
            for($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++){
                $timetableFitness[$timetable] = $this->calcFitness($this->population[$timetable]);
                if(($timetableFitness[$timetable] == 0 )){
                    
                    print_r("<h1>FOUND! CONFLICTS: ".$timetableFitness[$timetable]." </h1>");

                    $fitTimetableFound = true;
                    $this->dispTable($this->population[$timetable], true);
                    
                    print_r("\n".""."\n"); echo memory_get_usage() - $startMemory, ' bytes';
                    var_dump( ini_get('memory_limit') ); var_dump(memory_get_usage() );
                    $time_end = microtime(true);$execution_time = ($time_end - $time_start);
                    echo '<b>Total Execution Time:</b> '.$execution_time.'sec';

                    return $this->population[$timetable] ;
                }
            }
            //         2.1 Find the best timetable so far
            $uniqueFitnessValues =  array_unique ($timetableFitness); //  $timetableFitness; // 
            asort($uniqueFitnessValues);

            //        2.2 eliminate the least fit timetable.
             array_pop($uniqueFitnessValues); // remove the least fit from selection pool

            $fitnessHighest = [array_search(min($timetableFitness), $timetableFitness) => min($timetableFitness)];
            $fitnessLowest = [array_search(max($timetableFitness), $timetableFitness) => max($timetableFitness)];

            // 2.3 Normalize each fitness values: (fitnessVale/TotalFitness) * 100
            foreach($uniqueFitnessValues as $key => $fitnessValue){

                // 2.3 Normalize each fitness values: (fitnessVale/TotalFitness) * 100 
                $matingPoolFrequency =    round ((  ((1/($fitnessValue+1)* 100))  /  TimetableConfig::POP_SIZE ) * 100)           ;
                
                print_r($matingPoolFrequency." ");              
                // 3. prepare matingPool indexes
                // 3.1 Populate the matingPool
                
                for($i=0; $i < $matingPoolFrequency; $i++){
                    $matingPool [] = $key;
                }

                // 3.2 Populate the selectionPool
                // the first key in this pool is the fittest so far 
                $selectionPool[$key] = $this->population[$key];

            }

            $n=0;
            // ELITISM, find the elite/s 
            // 4.2 save the top n timetables
            foreach($selectionPool as $key=>$value){
                // 4.3 Add the best timetable so far to population[i]
                
                $this->population[$n] = null;
                $this->population[$n] = $value;

                print_r("\n\nPopulation AFTER ELITISM [". $this->calcFitness($this->population[$n])."]\n");
                // $this->dispTable($this->population[$n]);

                if ($n >= TimetableConfig::ELITISM-1){
                    break;
                }
                $n++;
            }
                     
            $crossRate = (int)(TimetableConfig::POP_SIZE * TimetableConfig::CROSSOVER_RATE ) ;
            print_r("\nCROSS@..... ".$crossRate."\n");
            for( $timetable=TimetableConfig::ELITISM; $timetable < $crossRate ; $timetable++ ){
                   
               
                // 4. SELECTION parentA and parentB.
                $parentA = $matingPool[rand(0, sizeof($matingPool)-1)]; // from this index, it returns the value corresponding to 
                $parentB = $matingPool[rand(0, sizeof($matingPool)-1)]; // the index($key) from the selection pool.
                

                // 5. CROSSOVER parentA and parentB. 
                $child = null;
                print_r("\nDOING CROSS....."."\n");
                $child = $this->crossover($selectionPool[$parentA], $selectionPool[$parentB]);
                

                    
                // 6. MUTATE child 

                $clone = $child;

                $child = [];
                $child = $this->mutate($clone);
                
                // 7. Add to the population //starting @ pop[i]
                $this->population[$timetable] = null;
                $this->population[$timetable] =  $child;


            }
            print_r("\nPopulation AFTER ELITISM [". $this->calcFitness($this->population[0])."]\n");
            // $this->dispTable($this->population[0]);
 
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



    public function getTraineeGroup($ID)
    {
        // if data have been downloaded, return the data
        if (isset($this->traineeGroups)) {
            // find the tg based on the ID and return the object;
            return $this->traineeGroups[$ID];
        } else { // otherwise, fetch all the data from the table subject.
            $db = DB::getInstance();
            $db->query("SELECT * FROM trainee_group");
            for ($i=0; $i < $db->count(); $i++) {
                $traineeGroupID = $db->getResults()[$i]->id;
                $this->traineeGroups[$traineeGroupID] = new TraineeGroup(
                                                                $db->getResults()[$i]->id,
                                                                $db->getResults()[$i]->name,
                                                                $db->getResults()[$i]->section,
                                                                $db->getResults()[$i]->level,
                                                                $db->getResults()[$i]->remarks
                                                            );
            }
            // return the data
            return $this->traineeGroups[$ID];
        }
    }

    public function getSubject($ID)
    {
 
        if (isset($this->subjects)) {
            // find the tg based on the ID and return the object;
            return $this->subjects[$ID];
        } else {
            $db = DB::getInstance();
            $db->query("SELECT * FROM subject");
            for ($i=0; $i < $db->count(); $i++) {
                $subjectID = $db->getResults()[$i]->id;
                $this->subjects[$subjectID] = new Subject(
                                                            $db->getResults()[$i]->id,
                                                            $db->getResults()[$i]->code,
                                                            $db->getResults()[$i]->name,
                                                            $db->getResults()[$i]->required_period,
                                                            $db->getResults()[$i]->description
                                                        );
            }//for
            return $this->subjects[$ID];
        }//else
    }

    public function getRoom($ID =null)
    {

        
        if (isset($this->rooms)) {
            return $this->rooms[$ID];
        } else { // otherwise, fetch all the data from the table room.
            $db = DB::getInstance();
            $db->query("SELECT * FROM room");
            for ($i=0; $i < $db->count(); $i++) {
                $roomsID = $db->getResults()[$i]->id;
                $this->rooms[$roomsID] = new Room(
                                                    $db->getResults()[$i]->id,
                                                    $db->getResults()[$i]->name,
                                                    $db->getResults()[$i]->type,
                                                    $db->getResults()[$i]->location,
                                                    $db->getResults()[$i]->description
                                                );
            }
            // return the data
            return $this->rooms[$ID];
        }
    }

    private function getRandomRoom($roomType)
    {

        // initialize the room object just incase the 1st created class
        // was set to a random room

        if (!isset($this->rooms)) {
            $this->getRoom(1);
        }
            
        
        // for each room in rooms, search for the req room type
        // store the object/s in an assoc chosenRoom;
        $chosenRoom = [];

        foreach ($this->rooms as $room) {
            if ($room->getType() == $roomType) {
                $chosenRoom[]= $room;
            }
        }
        
        // randomly choose from 0 to sizeof(tempArray)-1;
        $randomRoom = rand(0, sizeof($chosenRoom)-1);
        // return the result.
        return $chosenRoom [$randomRoom];
    }


    public function getRoomType($ID)
    {
        
        // if data have been downloaded, return the data
        if (isset($this->roomTypes)) {
            // find the roomType based on the ID and return the object;
            return $this->roomTypes[$ID];
        } else { // otherwise, fetch all the data from the table roomType.
            $db = DB::getInstance();
            $db->query("SELECT * FROM room_type");
            for ($i=0; $i < $db->count(); $i++) {
                $roomTypesID = $db->getResults()[$i]->id;
                $this->roomTypes[$roomTypesID] = new RoomType(
                                                                $db->getResults()[$i]->id,
                                                                $db->getResults()[$i]->name,
                                                                $db->getResults()[$i]->description
                                                            );
            }
            // return the data
            return $this->roomTypes[$ID];
        }
    }

    public function getInstructor($ID)
    {

        // if data have been downloaded, return the data
        if (isset($this->instructors)) {
            // find the instructor based on the ID and return the object;
            return $this->instructors[$ID];
        } else { // otherwise, fetch all the data from the table instructor.
            $db = DB::getInstance();
            $db->query("SELECT * FROM instructor");
            for ($i=0; $i < $db->count(); $i++) {
                $instructorsID = $db->getResults()[$i]->id;
                $this->instructors[$instructorsID] = new Instructor(
                                                                $db->getResults()[$i]->id,
                                                                $db->getResults()[$i]->first_name,
                                                                $db->getResults()[$i]->last_name,
                                                                $db->getResults()[$i]->note
                                                            );
            }
            // return the data
            return $this->instructors[$ID];
        }
    }
}
// class end
/*
Size of base: 2
Array
(
    [72] => Array
        (
            [id] => 72
            [timetable_id] => 3
            [subject_id] => 33
            [trainee_group_id] => 10
            [instructor_id] => 19
            [room_id] => 25
            [room_type_id] => 10
            [room_fixed] => 
            [preferred_start_period] => 1
            [preferred_end_period] => 8
            [preferred_number_days] => 3
        )

    [73] => Array
        (
            [id] => 73
            [timetable_id] => 3
            [subject_id] => 32
            [trainee_group_id] => 4
            [instructor_id] => 25
            [room_id] => 1
            [room_type_id] => 1
            [room_fixed] => 1
            [preferred_start_period] => 1
            [preferred_end_period] => 8
            [preferred_number_days] => 1
        )

)
Array
(
    [0] => Array
        (
            [72] => Array
                (
                    [id] => 72
                    [timetable_id] => 3
                    [subject_id] => 33
                    [trainee_group_id] => 10
                    [instructor_id] => 19
                    [room_id] => 20
                    [room_type_id] => 10
                    [room_fixed] => 
                    [preferred_start_period] => 1
                    [preferred_end_period] => 8
                    [preferred_number_days] => 3
                )

            [73] => Array
                (
                    [id] => 73
                    [timetable_id] => 3
                    [subject_id] => 32
                    [trainee_group_id] => 4
                    [instructor_id] => 25
                    [room_id] => 1
                    [room_type_id] => 1
                    [room_fixed] => 1
                    [preferred_start_period] => 1
                    [preferred_end_period] => 8
                    [preferred_number_days] => 1
                )

        )

    [1] => Array
        (
            [72] => Array
                (
                    [id] => 72
                    [timetable_id] => 3
                    [subject_id] => 33
                    [trainee_group_id] => 10
                    [instructor_id] => 19
                    [room_id] => 17
                    [room_type_id] => 10
                    [room_fixed] => 
                    [preferred_start_period] => 1
                    [preferred_end_period] => 8
                    [preferred_number_days] => 3
                )

            [73] => Array
                (
                    [id] => 73
                    [timetable_id] => 3
                    [subject_id] => 32
                    [trainee_group_id] => 4
                    [instructor_id] => 25
                    [room_id] => 1
                    [room_type_id] => 1
                    [room_fixed] => 1
                    [preferred_start_period] => 1
                    [preferred_end_period] => 8
                    [preferred_number_days] => 1
                )

        )

    [2] => Array
        (
            [72] => Array
                (
                    [id] => 72
                    [timetable_id] => 3
                    [subject_id] => 33
                    [trainee_group_id] => 10
                    [instructor_id] => 19
                    [room_id] => 20
                    [room_type_id] => 10
                    [room_fixed] => 
                    [preferred_start_period] => 1
                    [preferred_end_period] => 8
                    [preferred_number_days] => 3
                )

            [73] => Array
                (
                    [id] => 73
                    [timetable_id] => 3
                    [subject_id] => 32
                    [trainee_group_id] => 4
                    [instructor_id] => 25
                    [room_id] => 1
                    [room_type_id] => 1
                    [room_fixed] => 1
                    [preferred_start_period] => 1
                    [preferred_end_period] => 8
                    [preferred_number_days] => 1
                )

        )

)






starting at: 1
Array population
(
    [0] => Array timetable
        (
            [0] => Array meeting time
                (
                    [mt_id] => 0
                    [sc] => Array
                        (
                            [id] => 72
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 10
                            [instructor_id] => 4
                            [room_id] => 23
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 6
                )

            [1] => Array
                (
                    [mt_id] => 1
                    [sc] => Array
                        (
                            [id] => 72
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 10
                            [instructor_id] => 4
                            [room_id] => 23
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 7
                )

            [2] => Array
                (
                    [mt_id] => 2
                    [sc] => Array
                        (
                            [id] => 72
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 10
                            [instructor_id] => 4
                            [room_id] => 23
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 4
                )

            [3] => Array
                (
                    [mt_id] => 3
                    [sc] => Array
                        (
                            [id] => 73
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 4
                            [instructor_id] => 4
                            [room_id] => 24
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 1
                )

            [4] => Array
                (
                    [mt_id] => 4
                    [sc] => Array
                        (
                            [id] => 73
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 4
                            [instructor_id] => 4
                            [room_id] => 24
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 4
                )

            [5] => Array
                (
                    [mt_id] => 5
                    [sc] => Array
                        (
                            [id] => 73
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 4
                            [instructor_id] => 4
                            [room_id] => 24
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 5
                )

        )

    [1] => Array
        (
            [0] => Array
                (
                    [mt_id] => 0
                    [sc] => Array
                        (
                            [id] => 72
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 10
                            [instructor_id] => 4
                            [room_id] => 23
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 2
                )

            [1] => Array
                (
                    [mt_id] => 1
                    [sc] => Array
                        (
                            [id] => 72
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 10
                            [instructor_id] => 4
                            [room_id] => 23
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 6
                )

            [2] => Array
                (
                    [mt_id] => 2
                    [sc] => Array
                        (
                            [id] => 72
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 10
                            [instructor_id] => 4
                            [room_id] => 23
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 7
                )

            [3] => Array
                (
                    [mt_id] => 3
                    [sc] => Array
                        (
                            [id] => 73
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 4
                            [instructor_id] => 4
                            [room_id] => 24
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 8
                )

            [4] => Array
                (
                    [mt_id] => 4
                    [sc] => Array
                        (
                            [id] => 73
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 4
                            [instructor_id] => 4
                            [room_id] => 24
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 4
                )

            [5] => Array
                (
                    [mt_id] => 5
                    [sc] => Array
                        (
                            [id] => 73
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 4
                            [instructor_id] => 4
                            [room_id] => 24
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 5
                )

        )

    [2] => Array
        (
            [0] => Array
                (
                    [mt_id] => 0
                    [sc] => Array
                        (
                            [id] => 72
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 10
                            [instructor_id] => 4
                            [room_id] => 24
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 9
                )

            [1] => Array
                (
                    [mt_id] => 1
                    [sc] => Array
                        (
                            [id] => 72
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 10
                            [instructor_id] => 4
                            [room_id] => 24
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 4
                )

            [2] => Array
                (
                    [mt_id] => 2
                    [sc] => Array
                        (
                            [id] => 72
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 10
                            [instructor_id] => 4
                            [room_id] => 24
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 5
                )

            [3] => Array
                (
                    [mt_id] => 3
                    [sc] => Array
                        (
                            [id] => 73
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 4
                            [instructor_id] => 4
                            [room_id] => 23
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 4
                )

            [4] => Array
                (
                    [mt_id] => 4
                    [sc] => Array
                        (
                            [id] => 73
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 4
                            [instructor_id] => 4
                            [room_id] => 23
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 5
                )

            [5] => Array
                (
                    [mt_id] => 5
                    [sc] => Array
                        (
                            [id] => 73
                            [timetable_id] => 3
                            [subject_id] => 55
                            [trainee_group_id] => 4
                            [instructor_id] => 4
                            [room_id] => 23
                            [room_type_id] => 2
                            [room_fixed] => 
                            [preferred_start_period] => 1
                            [preferred_end_period] => 8
                            [preferred_number_days] => 2
                        )

                    [ts] => 11
                )

        )

)

*/