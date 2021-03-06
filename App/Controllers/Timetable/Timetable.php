<?php

namespace App\Controllers\Timetable;

use \Core\View;
use App\Models\DB;
use App\TimetableConfig;
use App\Controllers\Auth\Session;

class Timetable{

    private $subjects, $traineeGroups, $rooms, $roomTypes, $instructors = null; 
    private $population = [];
    private $baseSubjectClass = null;
    private $conflicts = [];
    private $mutationRate = TimetableConfig::MUTATION_RATE;

    /*
     * dummy method 
     *
     * @param		
     * @return	 	
     */
    public function dummy (){
        echo "<pre>dummy";

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
        
        // print_r($db->getResults());
        if ($db->count()) {
            $i=0;
            foreach ($db->getResults() as $subjectClass) {
                // print_r("Copying record no: ".$i."\n");
                // this will collect each row of the selected table and store
                // all of it in an assoc array.
                $subjectClassSet[$subjectClass->id] =[
                    "id"                        => $subjectClass->id,
                    "timetable_id"              => $subjectClass->timetable_id,
                    "subject_id"                => $subjectClass->subject_id,
                    "trainee_group_id"          => $subjectClass->trainee_group_id,
                    "instructor_id"             => $subjectClass->instructor_id,
                    "room_id"                   => $subjectClass->room_id,
                    "room_type_id"              => $subjectClass->room_type_id,
                    "room_fixed"                => $subjectClass->room_fixed,
                    "preferred_start_period"    => $subjectClass->preferred_start_period,
                    "preferred_end_period"      => $subjectClass->preferred_end_period,
                    "preferred_number_days"     => $subjectClass->preferred_number_days
                ];
                $i++;
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
        if ($indi["room_fixed"]) { // room_id is provided, cannot be changed.
            
            $room = $this->getRoom($indi["room_id"])->getID();
            
        } else {
            
            $room = $this->getRandomRoom($indi["room_type_id"])->getID();
        }

        return $room;
    }

    /*
     * initPopulation method 
     *
     * @param		
     * @return	 	
     */
    public function initPopulation($subjectClassSet){
        
        $timetable = [];
        $mt_id = 0;

        // get all the timeslot for this subjectClass
        // timeslots are based on the required period and preferred number of days
        // timeslots are distributed in ref to the number of days.

        foreach ($subjectClassSet as $key => $subjectClass) {

            // find a suitable timeslot for the current subjectCclass
            // // print_r("\ninitPopulation key: ".$key);

            $requiredPeriods        = (int) $this->getSubject($subjectClass["subject_id"])->getRequiredPeriod();

            $preferredNumberOfDays  = (int) $subjectClass["preferred_number_days"] ;

            $preferredStart         = (int) $subjectClass["preferred_start_period"] ;

            $preferredEnd           = (int) $subjectClass["preferred_end_period"] ;

            $timeslot               = $this->getTimeslot(   $requiredPeriods, $preferredNumberOfDays,
                                                            $preferredStart, $preferredEnd);
            /*
                Array
                    (
                        [0] => Array
                            (
                                [0] => 38
                                [1] => 39
                            )

                        [1] => Array
                            (
                                [0] => 11
                                [1] => 12
                            )

                        [2] => Array
                            (
                                [0] => 3
                                [1] => 4
                            )
                    )

            */

            foreach ($timeslot as $day => $period) {

                $room = $this->assignRoom($subjectClass);

                 foreach($period as $key => $slot) {

                    // create a MeetingTime object for each timeslot. [room_final_id] => 
                    $timetable [] = ["mt_id"=>$mt_id, "sc"=>$subjectClass, "ts"=>$slot, "rm"=> $room ];

                    $mt_id++;
                }
            }
        }

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
        $distBlock = []; // subjectClass-distBlock

        // distribute the required period/s with the preferred number of day/s
        // returns an array. $distBlock = [ [day]=>[no. of periods] ]
        //     Array
        // (
        //     [0] => 2 means day 1 has 2 periods. could be assigned a room diff from others days
        //     [1] => 1 means day 1 has 1 periods
        //     [2] => 1 means day 1 has 1 periods
        // )

        $tempBlock = $this->getDistBlock(   $requiredPeriod, $preferredNumberOfDays);

        $day = [];

        for ($i=0; $i < count($tempBlock); $i++) {
            $sameDay = true;
            while ($sameDay) {
                $temp_slot = $this->getRandomSlot(
                                        $tempBlock[$i],
                                        $preferredStart, 
                                        $preferredEnd
                                );

                $daySelected = ((int) (($temp_slot[0])/TimetableConfig::TOTAL_PERIODS) );
                if (!in_array($daySelected, $day)) {
                    $day[]= $daySelected;
                    $distBlock[] =  $temp_slot;
                    $sameDay = false;
                }
            }
        }

        return $distBlock;
    }


    public function getDistBlock($requiredPeriod , $preferredNumberOfDays){
        $total = 0;
        $block = [];
        $modulo = fmod($requiredPeriod, $preferredNumberOfDays);

        if ($modulo == 0){

            for ($i=0; $i < ($preferredNumberOfDays); $i++) {

                $period = (int)( $requiredPeriod  / ($preferredNumberOfDays));

                array_push($block, $period);

                $total += $period;
            }

        }else{
            
            
            for ($i=0; $i < ($preferredNumberOfDays); $i++) { 
                $period = (int) ( $requiredPeriod / ($preferredNumberOfDays));
                $total += $period;
                array_push($block, $period);
            }
            $excess = $requiredPeriod - $total;

            // distribute the excess
            while($excess > 0){
                for ($i=0; $i < ($preferredNumberOfDays-1); $i++) { 

                    $total += 1;

                    $block[$i] += 1;

                    $excess--;

                    if($excess == 0){

                        break;
                    }
                }
            }
        }
        
        shuffle($block); // randomize distribution block
        return $block;
    }

    public function getRandomSlot($numberOfPeriods, $preferred_start_period, $preferred_end_period){

        // subject-classes are taught in "d" number days with "p" number of periods per day
        // this loop is "per" distribution block
        /*
                count: 3 Array
                (
                    [0] => 2
                    [1] => 1
                    [2] => 1
                )
        */
        $period_start = (($preferred_start_period==null) ? 0 : $preferred_start_period-1);

        $period_end = (($preferred_end_period==null) ? TimetableConfig::TOTAL_PERIODS : $preferred_end_period-1);
        
        $done = false;
        while (!$done) {

            $timeslot = [];
            $day = [];
            $initSlot = mt_rand(0, TimetableConfig::TOTAL_TIME_SLOTS-1);

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
    public function calcFitness($timetable){
        $this->conflicts = [];
        $timeslots = [];

        $totalConflicts = 0;

        for ($i=0; $i < sizeof($timetable); $i++) {

            // fetch timeslot that is associated with a subjectClassID
            array_push($timeslots, $timetable[$i]["ts"]);

        }

        // remove duplicate timeslot from the list of timeslot that is associated with a subjectClassID
        $timeslots = (array_unique($timeslots));


        foreach ($timeslots as $timeslot) {

            $subjectClassID =[];
            $roomID = [];

            $traineeGroupID = [];
            $instructorID = [];

            for ($i=0; $i < sizeof($timetable); $i++) {

                // gather all IDs belonging to this timeslot.
                if ($timeslot == $timetable[$i]["ts"]) {

                    if ($timetable[$i]["sc"]["subject_id"] == 1 ) {
                        // "study break\n";
                        $traineeGroupID[]   = $timetable[$i]["sc"]["trainee_group_id"];

                    } else {

                        $roomID[]           = $timetable[$i]['rm'];
                        $traineeGroupID[]   = $timetable[$i]["sc"]["trainee_group_id"];
                        $instructorID[]     = $timetable[$i]["sc"]["instructor_id"];
                    }                   
                }
            }
            
            // the difference between size of the arrayID and the number of UNIQUE items in that
            // array is 0 then there is no conflict.
            $currentConflicts   =    (sizeof($roomID)          -sizeof(array_unique($roomID)))
                                + (sizeof($traineeGroupID)  -sizeof(array_unique($traineeGroupID)))
                                + (sizeof($instructorID)    -sizeof(array_unique($instructorID)))                                
                                ;
            if ($currentConflicts){
                $this->conflicts[] = $timeslot;
            }
            $totalConflicts += $currentConflicts;
        }

        return $totalConflicts;
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
                $chromoA['rm'][$currentID][] = $value['rm'];
            }
        }


        /*
           $chromoA Array
                (
                    [ts] => Array
                        (
                            [158] => Array
                                (
                                    [0] => 0
                                    [1] => 1
                                    [2] => 28
                                    [3] => 29
                                    [4] => 38
                                    [5] => 39
                                    [6] => 20
                                    [7] => 21
                                    [8] => 9
                                    [9] => 10
                                )

                        )

                    [room_id] => Array
                        (
                            [158] => Array
                                (
                                    [0] => 11
                                    [1] => 11
                                    [2] => 10
                                    [3] => 10
                                    [4] => 11
                                    [5] => 11
                                    [6] => 10
                                    [7] => 10
                                    [8] => 11
                                    [9] => 11
                                )

                        )

                )



        */

        $processedSubjectClassID = $copyProcessedSubjectClassID ;

        $currentID = null;
        foreach ($parentB as $key => $value) {

            if (!($value['sc']['id'] == $currentID)){
                $currentID = array_shift($copyProcessedSubjectClassID);
            }
            if (($value['sc']['id'] == $currentID)){
                $chromoB['ts'][$currentID][] = $value['ts'];
                $chromoB['rm'][$currentID][] = $value['rm'];
            }
        }
 
        // // select a base parent;
        $luckypick = (mt_rand(0, 1));
        $baseParent = ($luckypick) ? $parentA : $parentB;
        // print_r("\nBase is : ".$luckypick."\n");
        // print_r($processedSubjectClassID);
        // crossover parentA & parentB
        $currentID = null;
        foreach ($baseParent as $key => $value) {

            if (!($value['sc']['id'] == $currentID)){

                $currentID = array_shift($processedSubjectClassID);

                $luckypick = (mt_rand(0, 1));
                
                $chosenParent =  ($luckypick) ? $chromoA : $chromoB;

            }
            if (($value['sc']['id'] == $currentID)){ 

                $child[$key] = $value;

                $child[$key]['ts'] = array_shift($chosenParent['ts'] [$value['sc']['id']]);

                $child[$key]['rm'] = array_shift($chosenParent['rm'] [$value['sc']['id']]);

            }

        }


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

                $subjectClassSet[$key] = $value;
        }

                
        // assign timeslots to the newTimetable;
        $newTimetable = $this->initPopulation($subjectClassSet);

        $copyProcessedSubjectClassID = $processedSubjectClassID;

        $currentID = null;

        // copy the timeslots and rooms
        foreach ($childTimetable as $key => $value) {

            if (!($value['sc']['id'] == $currentID)){
                $currentID = array_shift($processedSubjectClassID);
            }
            if (($value['sc']['id'] == $currentID)){
                $originalChromo['ts'][$currentID][] = $value['ts'];
                $originalChromo['rm'][$currentID][] = $value['rm'];
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
                $mutatedChromo['rm'][$currentID][] = $value['rm'];
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
                
                $luckypick =  ($rand < $this->mutationRate);
                
                $chosenParent =   ($luckypick)  ? $mutatedChromo   : $originalChromo ;
                if (($luckypick)){
                    // print_r("\nluckpick selected ".$luckypick." ");
                    $applied++;
                }else {
                    // print_r("\nNOT luckpick selected ".$luckypick." ");
                    
                    $notApplied++;
                }
                // print_r(" currentID ".$currentID." luckypick ".$luckypick."\n");
            }
            if (($value['sc']['id'] == $currentID)){ 

                $mutant[$key] = $value;

                $mutant[$key]['ts'] = array_shift($chosenParent['ts'] [$value['sc']['id']]);

                $mutant[$key]['rm'] = array_shift($chosenParent['rm'] [$value['sc']['id']]);

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

        $tempTable = $timetable;

        foreach ($tempTable as $key => $row) {

            $ts[$key] = $row['ts'];

        }

        if ($sort){

            array_multisort($ts,SORT_ASC, $tempTable );
        }
        

        for($i=0; $i < sizeof($tempTable); $i++){
                        
            print_r("\nmID:    ".$tempTable[$i]["mt_id"]. 
                    "\ttimeslot: ".$tempTable[$i]["ts"]. 
                    "\t\t(Class: ".$tempTable[$i]["sc"]["id"].
                    
                    " Grp: ".$tempTable[$i]["sc"]["trainee_group_id"]. 
                    ")\t(Sbj: ".$tempTable[$i]["sc"]["subject_id"].
                    " Inst: ".$tempTable[$i]["sc"]["instructor_id"].
                    ")\t["."id ".$tempTable[$i]["rm"]."-".
                            $this->getRoom($tempTable[$i]["rm"])->getName().
                    "]");
        }
        
    }

    public function GeneticAlgorithm()
    {
        
        $sessionData = Session::getInstance();

        //place this before any script you want to calculate time
        // $time_start = microtime(true);
        $startMemory = memory_get_usage();
        ini_set('max_execution_time', 3600); //300 seconds = 5 minutes
        ini_set('memory_limit', '256M');
        

       
        

        $timetableFitness = [];
        $subjectClassSet = []; // contains base plus initial room assignment
        $fitnessHighest = null;
        $fitnessLowest = null;
        $fitTimetableFound = false;
         
        // baseSubjectClass is created once, to fetch data from mySQL tables
        // a POP_SIZE subjectClasses will be created from the base with
        // random rooms if the property roomFixed = null.

        View::renderTemplate ('Timetables/generateTimetablePage.twig.html', [
                                        
                                        'title' => 'Generating Timetable '.$sessionData->currentTimetable, 
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights
                                        
                                    ]);
                                    

        $timetableID = $sessionData->currentTimetable;  // will be replaced by the actual database table id later
        

        $this->baseSubjectClass = $this->fetchBaseSubjectClass($timetableID);

       
        echo '<script language="javascript">
                document.getElementById("id_timetable").innerHTML="'.$timetableID.' ";
                document.getElementById("id_class_size").innerHTML="'.sizeof($this->baseSubjectClass).' ";
                document.getElementById("id_population_size").innerHTML="'.TimetableConfig::POP_SIZE.' ";
                document.getElementById("id_max_generation").innerHTML="'.TimetableConfig::MAX_GEN.' ";
            </script>';


        // setup()
        //  # Step 1: The Population
        //    # Fill it with DNA encoded objects (pick random values to start)
        for ($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++) { 
            foreach ($this->baseSubjectClass as $key => $value) {
                    $subjectClassSet[$timetable][$key] = $value;
            }
        }
         
        // print_r($subjectClassSet);
        for ($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++) { 

            $this->population[$timetable] = $this->initPopulation($subjectClassSet[$timetable]);
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
        $stagnantCounter = 0;
        $terminateCounter = 0;
        $currentFitnessValue = 100;
        $execution_time = 0;
        $time_start = time(); //microtime(true);

        $crossRate = (int)(TimetableConfig::POP_SIZE * TimetableConfig::CROSSOVER_RATE ) ;
        
        // Total processes, progress bar;
        $total = TimetableConfig::MAX_GEN;

        while((!$fitTimetableFound) and ($generation < TimetableConfig::MAX_GEN)){
            

            //     1. evaluate fitness of timetables (population)
            for($timetable=0; $timetable < TimetableConfig::POP_SIZE; $timetable++){
                
                $fitnessValue = $this->calcFitness($this->population[$timetable]);

                $timetableFitness[$timetable] =  $fitnessValue;
                
                if(($timetableFitness[$timetable] == 0 )){

                    // Send output to browser immediately
                    flush(); 
                    // This is for the buffer achieve the minimum size in order to flush data
                    echo str_repeat(' ',1024*64);

                    $resultSummary      = '<hr/><span class=\"fa fa-heart text-danger\"></span>'
                                          .' Zero Conflict Timetable Generated! <br/><br/>'
                                          .'Click <b><a href=\'/home\'>here to see the result</br> ';
                    
                    echo '<script language="javascript">
                            alert("Zero Conflict Timetable Generated Succesfully!");
                            document.getElementById("id_result").innerHTML      ="'.$resultSummary.'";
                            document.getElementById("id_fittest").innerHTML     ="'.$timetableFitness[$timetable].'";
                            
                        </script>';

                    // This is for the buffer achieve the minimum size in order to flush data
                    echo str_repeat(' ',1024*64);

                    $fitTimetableFound = true;
                    $conflicts = '';
       
                    $result = [ 'timetable'     => $this->population[$timetable] , 
                                'fitnessValue'  => $fitnessValue,
                                'conflicts'     => $conflicts
                                ];
                    return $result;

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
                $parentA = null;
                $parentB = null;
                
            }



            //     2. Process fitness values.             
            //         2.1 Find the best timetable so far
            $uniqueFitnessValues = $timetableFitness; //  array_unique ($timetableFitness); //  
            asort($uniqueFitnessValues);

            //        2.2 eliminate the least fit timetable.


            $fitnessHighest = [array_search(min($timetableFitness), $timetableFitness) => min($timetableFitness)];
            $fitnessLowest = [array_search(max($timetableFitness), $timetableFitness) => max($timetableFitness)];
            
            $normalizer = max($timetableFitness);

            $timetableFitnessSize = sizeof ($uniqueFitnessValues);
            // echo "<pre>";
            // print_r($uniqueFitnessValues);
            // print_r($normalizer);
            // print_r("\ntimetableFitnessSize ".$timetableFitnessSize."\n");
            // 2.3 Normalize each fitness values

            foreach($uniqueFitnessValues as $key => $fitnessValue){

                // 2.3 Normalize each fitness values: (fitnessVale/TotalFitness) * 100 
                $matingPoolFrequency =    round ((  ((1/(($fitnessValue) + 1 )* $normalizer))  /  max($timetableFitness)  ) * $normalizer);
                

                // 3. prepare matingPool indexes
                // 3.1 Populate the matingPool
                
                for($i=0; $i < $matingPoolFrequency; $i++){
                    $matingPool [] = $key;
                }

                // 3.2 Populate the selectionPool
                // the first key in this pool is the fittest so far 
                $selectionPool[$key] = $this->population[$key];

            }



            $populationZeroFitnessValue =  $uniqueFitnessValues[TimetableConfig::ELITISM-1];
            // $uniqueFitnessValues[TimetableConfig::ELITISM]; 
            // $this->calcFitness($timetableFitness[TimetableConfig::ELITISM]);
            
            $aveFit = round(array_sum($timetableFitness) / sizeof($timetableFitness) );
            if ( $populationZeroFitnessValue == $currentFitnessValue){
                $stagnantCounter++;

                if ($stagnantCounter == TimetableConfig::MAX_STAGNANT){
                    
                    //print_r("\nStagnantCounter @ ".$stagnantCounter."\n");

                    if($terminateCounter > 9){
                        break;
                    }
                    $this->mutationRate = $this->mutationRate + 0.01;
                    // $this->population[0] = $this->mutate($this->population[0]);
                    // $this->population[0] = $this->crossover($this->mutate($this->population[0]), $this->mutate($this->population[0]));
                    $stagnantCounter = 0;

                    $terminateCounter++;
                    
                    for ($timetable= 1; $timetable < TimetableConfig::POP_SIZE; $timetable++) { 

                        $this->population[$timetable] = $this->initPopulation($subjectClassSet[$timetable]);
                        
                        $timetableFitness[$timetable] = $this->calcFitness($this->population[$timetable]);
                    
                    }
                    $uniqueFitnessValues = $timetableFitness; //  array_unique ($timetableFitness); //  

                    asort($uniqueFitnessValues);

                    $timetableFitnessSize = sizeof ($uniqueFitnessValues);

                    $populationZeroFitnessValue =  $uniqueFitnessValues[TimetableConfig::ELITISM-1];
                    $aveFit = round(array_sum($timetableFitness) / sizeof($timetableFitness) );
                    echo '<br>id_elite '.$populationZeroFitnessValue;
                    echo '<br>id_average '.$aveFit; 

                    
                }

            }else{

                $stagnantCounter = 0;

                $currentFitnessValue = $populationZeroFitnessValue;

            }



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
           
            


            // Javascript for updating the progress bar and information
            $percent = intval($generation/$total * 100)."%";

            $time_end = time(); // microtime(true);
            
            $execution_time = ($time_end - $time_start); 
            
            echo '<script>
                    document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.';background-color:#2ECC71;\">&nbsp;</div>";

                    document.getElementById("id_generation").innerHTML  ="'.$generation.'";

                    document.getElementById("id_time").innerHTML        ="'. ($execution_time).'";
                    
                    document.getElementById("id_fittest").innerHTML     ="'.$uniqueFitnessValues[0].'";

                    document.getElementById("id_elite").innerHTML       ="'.$populationZeroFitnessValue.'";

                    document.getElementById("id_average").innerHTML     ="'.$aveFit.'";

                    document.getElementById("id_stagnant").innerHTML    ="'.$stagnantCounter.'"; 

                    document.getElementById("id_selection_size").innerHTML="'.($crossRate).'"; 

                    document.getElementById("id_mating_size").innerHTML     ="'.sizeof($matingPool).'"; 

                    document.getElementById("id_mutation").innerHTML        ="'.$this->mutationRate.' "; 
                    

                </script>';
            // This is for the buffer achieve the minimum size in order to flush data
                // echo str_repeat(' ',1024*64);


            // Send output to browser immediately
                flush();
            
            
            
            // print_r("\nCROSS up to : =====> ".$crossRate."\n".sizeof($matingPool));
            
            for( $timetable=TimetableConfig::ELITISM; $timetable < $crossRate ; $timetable++ ){
               
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
            
            // $this->dispTable($this->population[0]);
 
            $generation++;
        }


        // [0] is the elite
        
        
        $fitnessValue = $this->calcFitness($this->population[0]);

        $conflicts = null;
        foreach ($this->conflicts as $key => $value) {
            $conflicts .= $value. '.';
        }       

        // This is for the buffer achieve the minimum size in order to flush data
            echo str_repeat(' ',1024*64);


        // Send output to browser immediately
            flush(); 


        $resultSummary = "<hr>Processing done. Click <b><a href='/home'>here to see the result.";
        echo '<script language="javascript">
                
                document.getElementById("id_result").innerHTML="'.$resultSummary.' ";

                
            </script>';
        
        $result = [ 'timetable'     => $this->population[0] , 
                    'fitnessValue'  => $fitnessValue,
                    'conflicts'     => $conflicts
                    ];
        return $result;
         
    }
    



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
            if ($room->getType() === $roomType) {
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