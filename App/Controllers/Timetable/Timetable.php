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

        // get all the timeslot for this getSubject
        // timeslots are based on the required perion and preferred number of days
        // timeslots are distribute in ref to the number of days. 

        foreach($subjectClassSet as $key => $subjectClass){

            $timeslot = $this->getTimeslot($subjectClass);

            for($j=0; $j < sizeof($timeslot); $j++){

                // create a MeetingTime object for each timeslot. 
                $timetable [] = new MeetingTime ($mt_id, $subjectClass, $timeslot[$j]);
                $mt_id++;
            }

        }
        usort($timetable, function($a, $b){
            // return ((int)$a->getSubjectClassID() > (int)$b->getSubjectClassID());

            return ((int)$a->getTimeslot() > (int)$b->getTimeslot());

            // if ((int)$a->getTimeslot() == (int)$b->getTimeslot()) return 0;
            // return (int)$a->getTimeslot() < (int)$b->getTimeslot() ? -1 : 1;

        });
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
        // echo "<br>";
        
        // echo "<br/>Subject ID:\t"; print_r($subjectClass->getID());


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

        // echo "<br/>==================<br/>count: ".count($distBlock)." ";
        // print_r($distBlock);
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
        // echo"days selected: ";
        // print_r($day);
        // echo"timeslots: ";
        // print_r($timeslot);
        return $timeslot;
    }

    /*
     * calcFitness method 
     *
     * @param		array       of meetingTime object 
     * @return	 	array       the number of conflicts and the fitness value.        
     */
    public function calcFitness ($timetable){
        // print_r($subjectClass);
        $timeslots = [];
        $totalConflicts = 0;

        for($i=0; $i < sizeof($timetable); $i++){
            array_push($timeslots, $timetable[$i]->getTimeslot());
        }
        $timeslots = (array_unique($timeslots));

        
        foreach($timeslots as $timeslot){
            print_r("\ntimeslot:".$timeslot." ");
            $subjectClassID =[];
            $roomID = [];
            $traineeGroupID = [];
            $instructorID = [];
            $subjectID = [];

            for($i=0; $i < sizeof($timetable); $i++){
                if($timeslot == $timetable[$i]->getTimeslot()){
                    // print_r (" ". $timetable[$i]->getTimeslot());
                    $subjectClassID[] = $timetable[$i]->getSubjectClass()->getID();
                    $roomID[] = $timetable[$i]->getSubjectClass()->getRoom()->getID();
                    $traineeGroupID[] = $timetable[$i]->getSubjectClass()->getTraineeGroup()->getID();
                    $instructorID[] = $timetable[$i]->getSubjectClass()->getInstructor()->getID();
                    $subjectID[]= $timetable[$i]->getSubjectClass()->getSubject()->getID();
                }
            }
            echo "\t";

            // print_r($subjectClass);
            print_r("subjectClass: ");
            print_r(sizeof($subjectClassID)-sizeof(array_unique($subjectClassID)));
            print_r(" room: ");
            print_r(sizeof($roomID)-sizeof(array_unique($roomID)));
            print_r(" traineeGroupID: ");
            print_r(sizeof($traineeGroupID)-sizeof(array_unique($traineeGroupID)));
            print_r(" instructorID: ");
            print_r(sizeof($instructorID)-sizeof(array_unique($instructorID)));
            print_r(" subjectID: ");
            print_r(sizeof($subjectID)-sizeof(array_unique($subjectID)));
            $totalConflicts +=  (sizeof($subjectClassID)-sizeof(array_unique($subjectClassID))) +
                                (sizeof($roomID)-sizeof(array_unique($roomID))) +
                                (sizeof($traineeGroupID)-sizeof(array_unique($traineeGroupID))) + 
                                (sizeof($instructorID)-sizeof(array_unique($instructorID))) + 
                                (sizeof($subjectID)-sizeof(array_unique($subjectID))) 
                                ;
                        
        }


        // print_r("\n\nmeeting \tsubject \tTimeslot \tRoom \tTrainee \tInstructor \tSubject");
        // print_r("\ntime \t\tClassID \tts \t\tID \tGroup \t\tID \t\tID CODE");
        // print_r("\n**** \t\t**** \t\t**** \t\t**** ");
        // for($i=0; $i < sizeof($timetable); $i++){
        //     // array_push($timeslots,  [   ["Timeslot" =>$timetable[$i]->getTimeslot()],
        //     //                             ["SubjectClassID" =>$timetable[$i]->getSubjectClass()->getID()],
        //     //                             ["RoomID" =>$timetable[$i]->getSubjectClass()->getRoom()->getID()]
                                            
        //     //                         ]);
            

        //     // }
        //     if (0){
        //         print_r("<br/>{$i} ".$timetable[$i]->getID());
        //         print_r("\t\t". $timetable[$i]->getSubjectClass()->getID());
        //         print_r("\t\t". $timetable[$i]->getTimeslot());
        //         print_r("\t\t". $timetable[$i]->getSubjectClass()->getRoom()->getID());
        //         print_r("\t".   $timetable[$i]->getSubjectClass()->getTraineeGroup()->getID());
        //         print_r("\t\t". $timetable[$i]->getSubjectClass()->getInstructor()->getID());
        //         print_r("\t\t". $timetable[$i]->getSubjectClass()->getSubject()->getID());
        //         print_r("\t".   $timetable[$i]->getSubjectClass()->getSubject()->getCode());
        //     }
        // }

        return $totalConflicts;

        //return ; // fitness value = 1 / (total conflicts + 1)
    }

    public function indexAction (){
        echo"Timetable Class<pre>";
        $timetableID = 1;
        $population = [];
        $subjectClassSets = [];

        // base subjectClass is created once, to fetch data from mySQL tables
        // an N subjectClasses will be created from the base with 
        // random rooms if the property isRoomFixed = false. 
  
        $baseSubjectClass = $this->fetchBaseSubjectClass($timetableID); 
        // print_r("\nbase SC:\n");
        // print_r($baseSubjectClass);

        // create an N size subjectClass sets. 
        // for($i=0; $i < TimetableConfig::POP_SIZE; $i++){
        //     $subjectClassSets[] = $this->createSubjectClass($baseSubjectClass);
        //     $population[] = $this->createTimetable($subjectClassSets[$i]);
        //     print_r("\n<h3>TOTAL CONFLICTS: ".$this->calcFitness($population[$i])." </h3>");
        // }

        $i = 0;
        $lowest = 20;
        $lowest_i = 0;
        while(true){
            $subjectClassSets[] = $this->createSubjectClass($baseSubjectClass);
            $population[] = $this->createTimetable($subjectClassSets[$i]);
            
            $x = $this->calcFitness($population[$i]);
            print_r("\nx ".$x.":".$lowest." lowest");
            print_r("\n<h3>{$i} | TOTAL CONFLICTS: ".$x." </h3>".($x/($x+1)));
            if ($x < $lowest ){
                $lowest = $x;
                $lowest_i = $i;
            }
            if ($i > 50 or $lowest == 0){
                break;
            }
            $i++;
        }

        print_r("\n<h3>{$lowest_i} | TOTAL CONFLICTS: ".$lowest." </h3>".($lowest/($lowest+1)));
        $x = $lowest_i;

        // foreach($subjectClassSets as $key => $subjectClassSet){ 
        //     print_r("\n===============================================================================================");
        //     foreach($subjectClassSet as $ID => $subjectClass ){
        //         // print_r($subjectClass);
        //         print_r("\n[{$key},{$ID}]: getID: ".$subjectClass->getID());           
        //         print_r("\t\troomType: ".$subjectClass->getRoomType()->getRoomTypeID());
        //         print_r("\t\tRoomID: ".$subjectClass->getRoom()->getID());
        //         print_r("\t\tRoom: ".$subjectClass->getRoom()->getName());
            
        //     }
            

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

        // $this->calcFitness($population[3], $subjectClassSet[3]);
        // $this->calcFitness($population[3]);
        
        // print_r("\nsize: ".sizeof($population[0]));

        print_r("\n\nmeeting \tsubject \tTimeslot \tRoom \tTrainee \tInstructor \tSubject");
        print_r("\ntime \t\tClassID \tts \t\tID \tGroup \t\tID \t\tID CODE");
        print_r("\n**** \t\t**** \t\t**** \t\t**** ");
        for($i=0; $i < sizeof($population[$x]); $i++){
            print_r("<br/>".$population[$x][$i]->getID());
            print_r("\t\t".$population[$x][$i]->getSubjectClass()->getID());
            print_r("\t\t".$population[$x][$i]->getTimeslot());
            print_r("\t\t".$population[$x][$i]->getSubjectClass()->getRoom()->getID());
            // print_r("\t\t".$subjectClassSets[3][$population[3][$i]->getSubjectClass()->getID()]->getRoom()->getID());
            
            print_r("\t".   $subjectClassSets[3][$population[$x][$i]->getSubjectClass()->getID()]->getTraineeGroup()->getID());
            print_r("\t\t". $subjectClassSets[3][$population[$x][$i]->getSubjectClass()->getID()]->getInstructor()->getID());
            print_r("\t\t". $subjectClassSets[3][$population[$x][$i]->getSubjectClass()->getID()]->getSubject()->getID());
            print_r("\t".   $subjectClassSets[3][$population[$x][$i]->getSubjectClass()->getID()]->getSubject()->getCode());
        }
  

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




   // public function CreateTimetable($subjectClasses){
    //     $timetable = []; // subjectClass-timeslot
    //     // echo "SubjectID \t TGroup \t\t Subj Name \t\t Inst \t\t Room<br>";
    //     foreach ($subjectClasses as $subjectClass){
    //         // echo "<br/>\t"; print_r($subjectClass->getID());
    //         // echo "\t"; print_r($subjectClass->getTraineeGroup()->getTraineeGroupName());
    //         // echo "\t\t"; print_r($subjectClass->getSubject()->getSubjectName());
    //         // echo "\t\t"; print_r($subjectClass->getInstructor()->getFirst_name());
    //         // echo "\t\t"; print_r($subjectClass->getRoom()->getRoomName());
    //         // echo " <br> ";
    //         // echo "<br/>required period: ";print_r($subjectClass->getSubject()->getRequiredPeriod());
    //         // echo "<br/>getPreferredNumberOfDays: ";print_r($subjectClass->getPreferredNumberOfDays());


    //         // distribute the required period/s with the preferred number of day/s
    //         // returns an array. $distBlock = [ [day]=>[no. of periods] ] 
    //         //     Array
    //         // (
    //         //     [0] => 2
    //         //     [1] => 1
    //         //     [2] => 1
    //         // )
        
    //         $distBlock = $this->getDistBlock($subjectClass->getSubject()->getRequiredPeriod(),
    //                                             $subjectClass->getPreferredNumberOfDays() 
    //                                         );

     
    //         echo "<br/>==================>>>count: ".count($distBlock)." ";
    //         print_r($distBlock);
    //         // $this->getSlot($distBlock);
    //         //print_r($this->getSlot($distBlock));
            
    //         $done = false;
    //         while (!$done){
    //             $day = [];
    //             for($i=0; $i < count($distBlock); $i++ ){
    //                 // echo "<br/>no of periods: ".$distBlock[$i];


    //                 $timeslot = $this->getSlot($distBlock[$i], 
    //                                             $subjectClass->getPreferredStart(),
    //                                             $subjectClass->getPreferredEnd()
    //                                             );

    //                 for($j=0; $j<sizeof($timeslot); $j++){
    //                     // array_push($timetable,[[$subjectClass][$timeslot[$j]]);
    //                     $timetable[] = [$subjectClass, $timeslot[$j]];
    //                 }
    //             // if ((count(array_unique($day)) === count($distBlock)))
    //             }
    //         }
            

    //     }
    //     // echo"timetable now: ";
    //     return $timetable;
    // }