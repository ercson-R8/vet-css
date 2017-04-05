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
     * dummy method 
     *
     * @param		
     * @return	 	
     */
    public function dummy (){
        
        for ($i=0; $i < 100000; $i++) { 
            # code...
        }
        // echo "<h1>From dummy method</h1>";
    }
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
        
        // // print_r($db->getResults());
        if ($db->count()) {
            $i=0;
            foreach ($db->getResults() as $subjectClass) {
                // print_r("\nCopying tables..."."\n");
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
            // print_r("\nError here no class found on this time timetable"."\n");
            // print_r("\nSize of db->getResults() ".sizeof($db->getResults())."\n");
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
        // // print_r("\nAssigning rooms...."."\n");
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
    public function setInitTimeSlot($subjectClassSet){
        $timetable = [];
        $mt_id = 0;
        // get all the timeslot for this subjectClass
        // timeslots are based on the required period and preferred number of days
        // timeslots are distributed in ref to the number of days.

        foreach ($subjectClassSet as $key => $subjectClass) {
            // find a suitable timeslot for the current subjectCclass
            // // print_r("\nsetInitTimeSlot key: ".$key);
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

        // // print_r($timetable);

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
        // // print_r("\nStart getTimeslot"."\n");
        $distBlock = $this->getDistBlock(   $requiredPeriod, $preferredNumberOfDays);
        // // print_r($distBlock);
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
        // // print_r("\nEnd getTimeslot"."\n");
        // // print_r($timeslot);
        return $timeslot;
    }


    public function getDistBlock($requiredPeriod , $preferredNumberOfDays){
        $total = 0;
        $block = [];
        $modulo = fmod($requiredPeriod, $preferredNumberOfDays);
        // // print_r("\nRequiredPeriod: ".$requiredPeriod." ");
        // // print_r(" preferredNumberOfDays: ".$preferredNumberOfDays." ");
        // // print_r(" modulo: ".$modulo."\n");
        if ($modulo == 0){
            // // print_r("\nEqual to zero"."\n");
            for ($i=0; $i < ($preferredNumberOfDays); $i++) { 
                $period = (int)( $requiredPeriod  / ($preferredNumberOfDays));
                array_push($block, $period);
                $total += $period;
            }

        }else{
            
            // // print_r("\nNOT Equal to zero"."\n");
            
            for ($i=0; $i < ($preferredNumberOfDays); $i++) { 
                $period = (int) ( $requiredPeriod / ($preferredNumberOfDays));
                $total += $period;
                array_push($block, $period);
            }
            // // print_r("\nTOTAL: ".$total."\n");
            $excess = $requiredPeriod - $total;
            // // print_r("\nExcess: ".$excess."\n");
            // distribute the excess
            while($excess > 0){
                for ($i=0; $i < ($preferredNumberOfDays-1); $i++) { 
                    $total += 1;
                    $block[$i] += 1;
                    $excess--;
                    // // print_r("\nExcess ".$excess." Total: ".$total."\n");
                    if($excess == 0){
                        break;
                    }
                }
            }




            //array_push($block, ($requiredPeriod -$total));
            
        }
        
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
        // // print_r("\n\tgetRandomSlot numberOfPeriods: ".$numberOfPeriods." ");
        // // print_r(" getRandomSlot preferred_start_period: ".$preferred_start_period." ");
        // // print_r(" getRandomSlot preferred_end_period: ".$preferred_end_period." ");
        // $s = $preferred_start_period;
        // $e = $preferred_end_period;
        // // echo "<br/><br/><h3>periods between {$s}-{$e}</h3>";
        
        $period_start = (($preferred_start_period==null) ? 0 : $preferred_start_period-1);
        $period_end = (($preferred_end_period==null) ? TimetableConfig::TOTAL_PERIODS : $preferred_end_period-1);
        
        $done = false;
        while (!$done) {
            $timeslot = [];
            $day = [];
            $initSlot = mt_rand(0, TimetableConfig::TOTAL_TIME_SLOTS-1);
            // // print_r("\n\tgetRandomSlot initSlot: ".$initSlot."\n");
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
        // // echo "<br/>timeslot: ";// print_r($timeslot);
        // // echo "<br/><br/>";
        return $timeslot;
    }


    /*
     * calcFitness method 
     *
     * @param		array       of meetingTime object 
     * @return	 	array       the number of conflicts and the fitness value.        
     */
    public function calcFitness($timetable){
        $timeslots = [];
        $totalConflicts = 0;
        for ($i=0; $i < sizeof($timetable); $i++) {
            // fetch timeslot that is associated with a subjectClassID
            array_push($timeslots, $timetable[$i]["ts"]);
        }
        // // print_r($timetable);
        // remove duplicate timeslot from the list of timeslot that is associated with a subjectClassID
        $timeslots = (array_unique($timeslots));
        // // print_r($timeslots);

        foreach ($timeslots as $timeslot) {
            $subjectClassID =[];
            $roomID = [];
            $traineeGroupID = [];
            $instructorID = [];
            //$subjectID = [];

            for ($i=0; $i < sizeof($timetable); $i++) {
                // gather all IDs belonging to this timeslot.
                if ($timeslot == $timetable[$i]["ts"]) {
                    //$subjectID[]        = $timetable[$i]["sc"]["subject_id"];
                    if ($timetable[$i]["sc"]["subject_id"] === 1 ) {
                        # code...
                    } else {
                        $roomID[]           = $timetable[$i]["sc"]["room_id"];
                        $traineeGroupID[]   = $timetable[$i]["sc"]["trainee_group_id"];
                        $instructorID[]     = $timetable[$i]["sc"]["instructor_id"];
                        //$subjectID[]= $timetable[$i]["sc"]["id"];
                    }
                    
                   
                }
            }
            
            // the difference between size of the arrayID and the number of UNIQUE items in that
            // array is 0 then there is no conflict.
            $totalConflicts +=    (sizeof($roomID)          -sizeof(array_unique($roomID)))
                                + (sizeof($traineeGroupID)  -sizeof(array_unique($traineeGroupID)))
                                + (sizeof($instructorID)    -sizeof(array_unique($instructorID)))                                
                                ;
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

        $processedSubjectClassID = [];
        
        
        $chromoA = [];
        $chromoB = [];
        $child = [];

        foreach ($parentA as $key => $value) {
            $subjectClassID = $value['sc']['id'];
            if ( (array_search($subjectClassID, $processedSubjectClassID) === false)) {
                $processedSubjectClassID[] = $subjectClassID;
            }
        }

        // needs a copy as processedSubjectClassID will be shifted;
        $copyProcessedSubjectClassID = $processedSubjectClassID;

        $currentID = null;

        // copy the timeslots and rooms
        foreach ($parentA as $key => $value) {

            if (!($value['sc']['id'] == $currentID)){
                $currentID = array_shift($processedSubjectClassID);
            }
            if (($value['sc']['id'] == $currentID)){
                $chromoA['ts'][$currentID][] = $value['ts'];
                $chromoA['room_id'][$currentID][] = $value['sc']['room_id'];
            }
        }

        $processedSubjectClassID = $copyProcessedSubjectClassID ;

        $currentID = null;
        foreach ($parentB as $key => $value) {

            if (!($value['sc']['id'] == $currentID)){
                $currentID = array_shift($copyProcessedSubjectClassID);
            }
            if (($value['sc']['id'] == $currentID)){
                $chromoB['ts'][$currentID][] = $value['ts'];
                $chromoB['room_id'][$currentID][] = $value['sc']['room_id'];
            }
        }
        
        // // select a base parent;
        $luckypick = (mt_rand(0, 1));
        $baseParent = ($luckypick) ? $parentA : $parentB;
        
        // // print_r("\nBase parent :".$luckypick."\n");
        // crossover parentA & parentB
        $currentID = null;
        foreach ($baseParent as $key => $value) {

            if (!($value['sc']['id'] == $currentID)){
                $currentID = array_shift($processedSubjectClassID);
                $luckypick = ($luckypick) ? 0 : 1;
                $chosenParent =  ($luckypick)? $chromoA : $chromoB;
                // // print_r(" currentID ".$currentID." luckypick ".$luckypick."\n");
            }
            if (($value['sc']['id'] == $currentID)){ 
                $child[$key] = $value;
                $child[$key]['ts'] = array_shift($chosenParent['ts'][$value['sc']['id']]);
                $child[$key]['sc']['room_id'] = array_shift($chosenParent['room_id'][$value['sc']['id']]);
                // // print_r(" currentID ".$currentID." luckypick ".$luckypick."\n");
                // // print_r(" room_id ".$value['sc']['room_id']." ts ".$value['ts']."\n");
            }

        }

        // // print_r("\nchild"."\n");

        // // print_r($child);
        // exit;
        // // print_r("\nChromoA"."\n");

        // // print_r($chromoA);
        // // print_r("\nChromoB"."\n");
        // // print_r($chromoB);

        return $child;

    }

    /*
     * mutate method 
     *
     * @param		
     * @return	 	
     */
    public function mutate($childTimetable){
        $processedSubjectClassID = [];
        // $mutant = $childTimetable;
        $newTimetable = null;
        $mutant = null;
        $chromo = [];
        $child = [];

        foreach ($childTimetable as $key => $value) {
            $subjectClassID = $value['sc']['id'];
            if ( (array_search($subjectClassID, $processedSubjectClassID) === false)) {
                $processedSubjectClassID[] = $subjectClassID;
            }
        }

        // add classes to the newTimetable; 
        foreach ($this->baseSubjectClass as $key => $value) {
                $newTimetable[$key] = $value;
                $newTimetable[$key]["room_id"] = $this->assignRoom($newTimetable[$key]);
                
        }


        // assign timeslots to the newTimetable;
        $newTimetable = $this->setInitTimeSlot($newTimetable);
        // // print_r($newTimetable);

        $copyProcessedSubjectClassID = $processedSubjectClassID;

        $currentID = null;

        // copy the timeslots and rooms
        foreach ($childTimetable as $key => $value) {

            if (!($value['sc']['id'] == $currentID)){
                $currentID = array_shift($processedSubjectClassID);
            }
            if (($value['sc']['id'] == $currentID)){
                $originalChromo['ts'][$currentID][] = $value['ts'];
                $originalChromo['room_id'][$currentID][] = $value['sc']['room_id'];
            }
        }

        $processedSubjectClassID = $copyProcessedSubjectClassID ;

        $currentID = null;
        foreach ($newTimetable as $key => $value) {

            if (!($value['sc']['id'] == $currentID)){
                $currentID = array_shift($copyProcessedSubjectClassID);
            }
            if (($value['sc']['id'] == $currentID)){
                $mutatedChromo['ts'][$currentID][] = $value['ts'];
                $mutatedChromo['room_id'][$currentID][] = $value['sc']['room_id'];
            }
        }

        $currentID = null;

        $baseParent = $childTimetable;
        $applied = 0;
        $notApplied = 0;
        foreach ($baseParent as $key => $value) {

            if (!($value['sc']['id'] == $currentID)){
                $currentID = array_shift($processedSubjectClassID);
                $rand = (mt_rand(0, 100)/100);
                
                $luckypick =  ($rand < TimetableConfig::MUTATION_RATE);
                
                $chosenParent =   ($luckypick)  ? $mutatedChromo   : $originalChromo ;
                if (($luckypick)){
                    // // print_r("\nluckpick selected ".$luckypick." ");
                    $applied++;
                }else {
                    // // print_r("\nNOT luckpick selected ".$luckypick." ");
                    
                    $notApplied++;
                }
                // // print_r(" currentID ".$currentID." luckypick ".$luckypick."\n");
            }
            if (($value['sc']['id'] == $currentID)){ 
                $mutant[$key] = $value;
                $mutant[$key]['ts'] = array_shift($chosenParent['ts'][$value['sc']['id']]);
                $mutant[$key]['sc']['room_id'] = array_shift($chosenParent['room_id'][$value['sc']['id']]);
                // // print_r(" currentID ".$currentID." luckypick ".$luckypick."\n");
                // // print_r(" room_id ".$value['sc']['room_id']." ts ".$value['ts']."\n");
            }

        }
        // print_r("mutated:<b>".$applied."</b> of:<".($applied+$notApplied)."> ");
        return $mutant;
    }

    /*
     * dispTable method 
     *
     * @param		
     * @return	 	
     */
    public function dispTable ($timetable, $sort = false){
        // // print_r($timetable);
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

    public function GeneticAlgorithm()
    {
        
        $sessionData = Session::getInstance();

        //place this before any script you want to calculate time
        $time_start = microtime(true);
        ini_set('max_execution_time', 600); //300 seconds = 5 minutes
        $startMemory = memory_get_usage();

        $timetableID = $sessionData->currentTimetable;  // will be replaced by the actual database table id later
        // print_r("\nTimetable #: ".$timetableID."\n<pre>");


        $timetableFitness = [];
        $subjectClassSet = []; // contains base plus initial room assignment
        $fitnessHighest = null;
        $fitnessLowest = null;
        $fitTimetableFound = false;
         
        // base subjectClass is created once, to fetch data from mySQL tables
        // a POP_SIZE subjectClasses will be created from the base with
        // random rooms if the property roomFixed = null.
  
        $this->baseSubjectClass = $this->fetchBaseSubjectClass($timetableID);
        // print_r("\n<pre>Number of Classes: ".sizeof($this->baseSubjectClass)."\n");

        // setup()
        //  # Step 1: The Population
        //    # Fill it with DNA encoded objects (pick random values to start)
        for ($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++) { 
            foreach ($this->baseSubjectClass as $key => $value) {
                    $subjectClassSet[$timetable][$key] = $value;
                    $subjectClassSet[$timetable][$key]["room_id"] = $this->assignRoom($subjectClassSet[$timetable][$key]);
                    
            }
        }
        
        // // print_r($subjectClassSet);

        for ($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++) { 

            $this->population[$timetable] = $this->setInitTimeSlot($subjectClassSet[$timetable]);
            $timetableFitness[$timetable] = $this->calcFitness($this->population[$timetable]);
            
        }


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
            // print_r("\n<h2>======== generation: ".$generation." ===============</h2>");
            // print_r("\nSize of population: ".sizeof($this->population)."\n");
            // print_r("\nPopulation[0] ELITISM <b>". $this->calcFitness($this->population[0])."</b>");
            // print_r("\nPopulation[1] ELITISM <b>". $this->calcFitness($this->population[1])."</b>");
            // print_r("\nPopulation[3] ELITISM <b>". $this->calcFitness($this->population[3])."</b>");
            // print_r("\nPopulation[4] ELITISM <b>". $this->calcFitness($this->population[4])."</b>");
            //     1. evaluate fitness of timetables (population)
            for($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++){
                $timetableFitness[$timetable] = $this->calcFitness($this->population[$timetable]);
                
                if(($timetableFitness[$timetable] == 0 )){
                    $fitnessValue = $this->calcFitness($this->population[$timetable]);
                    // print_r("<h1>FOUND! CONFLICTS: ".$timetableFitness[$timetable]." </h1>");
                    // print_r("\nPopulation[0] ELITISM <b>". $this->calcFitness($this->population[0])."</b>");
                    // print_r("\nPopulation[1] ELITISM <b>". $this->calcFitness($this->population[1])."</b>");
                    // print_r("\nPopulation[".$timetable."] has fitness of ".  $fitnessValue."</b>");
                    $fitTimetableFound = true;

                    //$this->dispTable($this->population[$timetable], true);
                    
                    // print_r("\n".""."\n"); // echo memory_get_usage() - $startMemory, ' bytes';
                    // var_dump( ini_get('memory_limit') ); // var_dump(memory_get_usage() );
                    // $time_end = microtime(true);$execution_time = ($time_end - $time_start);
                    // echo '<b>Total Execution Time:</b> '.(round($execution_time,2)).' sec';
                    return ['timetable' => $this->population[$timetable] , 'fitnessValue' => $fitnessValue];
                }
            }

            // no fitTimetableFound, reset variables; 
            if(!$fitTimetableFound){
                $fitnessHighest = null;
                $fitnessLowest = null;
                $fitTimetableFound = false;
                $matingPool = []; // just use the index of the timetable, conserve memory, increase efficiency. 
                $selectionPool = [];
                $totalFitnessValues = 0;
                $parentA = 0;
                $parentA = 0;
                // print_r("\nstarting at: ".(TimetableConfig::ELITISM)."\n");
            }



            //     2. Process fitness values.             
            //         2.1 Find the best timetable so far
            $uniqueFitnessValues = $timetableFitness; //  array_unique ($timetableFitness); //  
            asort($uniqueFitnessValues);

            //        2.2 eliminate the least fit timetable.


            $fitnessHighest = [array_search(min($timetableFitness), $timetableFitness) => min($timetableFitness)];
            $fitnessLowest = [array_search(max($timetableFitness), $timetableFitness) => max($timetableFitness)];
            $timetableFitnessSize = sizeof ($uniqueFitnessValues);
            // print_r("\ntimetableFitness Total size: ".$timetableFitnessSize."\n");
            // print_r($fitnessHighest);
            // print_r($fitnessLowest);
            // print_r("\nFitnessValue=>"."Frequency\n");

            // 2.3 Normalize each fitness values

            foreach($uniqueFitnessValues as $key => $fitnessValue){
                // print_r("\n".$fitnessValue."\n");
                // 2.3 Normalize each fitness values: (fitnessVale/TotalFitness) * 100 
                $matingPoolFrequency =    round ((  ((1/(($fitnessValue)+1)* 100))  /  TimetableConfig::POP_SIZE ) * 100)           ;
                // if(fmod($key, 4) == 0 ){
                //     echo"\n";
                // }


                // if (1){ //($fitnessValue < 20 ){
                //     print_r("<b>[".$fitnessValue."]</b>=>".$matingPoolFrequency."");
                // }                
                // 3. prepare matingPool indexes
                // 3.1 Populate the matingPool
                
                for($i=0; $i < $matingPoolFrequency; $i++){
                    $matingPool [] = $key;
                }

                // 3.2 Populate the selectionPool
                // the first key in this pool is the fittest so far 
                $selectionPool[$key] = $this->population[$key];

            }
            $aveFit = round(array_sum($timetableFitness) / sizeof($timetableFitness) );
            
            // print_r("\nSelection Pool: ".(sizeof($selectionPool)).
            //         " Mating Pool: ".sizeof($matingPool).
            //         " Average fitness: ".$aveFit."\n");
            $n=0;
            // ELITISM, find the elite/s 
            // 4.2 save the top n timetables
            foreach($selectionPool as $key=>$value){
                // 4.3 Add the best timetable so far to population[i]
                
                $this->population[$n] = null;
                $this->population[$n] = $value;

                if ($n >= TimetableConfig::ELITISM-1){
                    break;
                }
                $n++;
            }
            // print_r("\nPopulation[0] AFTER ELITISM <b>". $this->calcFitness($this->population[0])."</b>");
            // print_r("\nPopulation[1] AFTER ELITISM <b>". $this->calcFitness($this->population[1])."</b>");
            //  print_r("\nPopulation[3] AFTER ELITISM <b>". $this->calcFitness($this->population[3])."</b>");
            //   print_r("\nPopulation[4] AFTER ELITISM <b>". $this->calcFitness($this->population[4])."</b>");
                     
            $crossRate = (int)(TimetableConfig::POP_SIZE * TimetableConfig::CROSSOVER_RATE ) ;
            
            // print_r("\nCROSS up to : =====> ".$crossRate."\n");
            
            for( $timetable=TimetableConfig::ELITISM; $timetable < $crossRate ; $timetable++ ){
                if(fmod($timetable+3, 5) == 0 ){
                    // echo"\n";
                } 
               
                // 4. SELECTION parentA and parentB.
                $parentA = $matingPool[rand(0, sizeof($matingPool)-1)]; // from this index, it returns the value corresponding to 
                $parentB = $matingPool[rand(0, sizeof($matingPool)-1)]; // the index($key) from the selection pool.
                

                // 5. CROSSOVER parentA and parentB. 
                $child = null;

                $child = $this->crossover($selectionPool[$parentA], $selectionPool[$parentB]);
                    
                // 6. MUTATE child 

                // $this->dispTable($child);
                $clone = $child;

                $child = [];
                $child = $this->mutate($clone);

                // 7. Add to the population //starting @ pop[i]
                $this->population[$timetable] = null;
                $this->population[$timetable] =  $child;


            }
            // print_r("\nPopulation[0] AFTER CROSS <b>". $this->calcFitness($this->population[0])."</b>");
            // print_r("\nPopulation[1] AFTER CROSS <b>". $this->calcFitness($this->population[1])."</b>");
            // print_r("\nPopulation[3] AFTER CROSS <b>". $this->calcFitness($this->population[3])."</b>");
            // print_r("\nPopulation[4] AFTER CROSS <b>". $this->calcFitness($this->population[4])."</b>");
            
            // $this->dispTable($this->population[0]);
 
        $generation++;
        }

        



        // print_r("\n".""."\n");
        // echo memory_get_usage() - $startMemory, ' bytes';
        // var_dump( ini_get('memory_limit') );
        // var_dump(memory_get_usage() );
        
        // $time_end = microtime(true);

        //dividing with 60 will give the execution time in minutes other wise seconds
        // $execution_time = ($time_end - $time_start);

        //execution time of the script
        // echo '<b>Total Execution Time:</b> '.(round($execution_time,2)).' sec';
        // print_r("\n".""."\n");

        // [0] is the elite
        // $this->dispTable($this->population[0], true);

        return ['timetable' => $this->population[0] , 'fitnessValue' => $this->calcFitness($this->population[0])];

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