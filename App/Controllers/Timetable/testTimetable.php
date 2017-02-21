<?php 

namespace App\Controllers\Timetable;

// use \Core\View;
use App\Models\DB;
use App\TimetableConfig;
use App\Controllers\Timetable\TraineeGroup;
use App\Controllers\Timetable\SubjectClass;


class TestTimetable {
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
     * CreateTimetable method creates a timetable object containing an array of 
     * SubjectClass/es arranged in array with time slot. 
     * [ [mt_id] [sbj] [time slot] ]
     *
     * @param		int         timetable id, from the table 'timetable'
     * @return	 	object      timetable object 
     */
    public function CreateSubjectClasses ($timeTableID){
        $i = 0;
        $subjectClass = [];
        $db = DB::getInstance();
        $db->query("SELECT * FROM subject_class WHERE subject_class.timetable_id = {$timeTableID}");
        if ($db->count()){

            foreach ($db->getResults() as $result){
                if ($result->room_id){
                    echo "<br/>room_id specified: {$result->room_id} ";//print_r ($result->room_id);
                    $room = $this->getRoom($result->room_id);
                    $fixedRoom = true;
                }else{
                    $room = $this->getRandomRoom($result->room_type_id);
                    $fixedRoom = false;
                }
                $subjectClass[$i] =  new SubjectClass (
                                            $result->id,
                                            $timeTableID,
                                            $this->getSubject($result->subject_id),
                                            $this->getTraineeGroup($result->trainee_group_id), 
                                            $this->getInstructor($result->instructor_id), 
                                            $this->getRoomType($result->room_type_id), 
                                            $room,//$this->getRoom($result->room_id),
                                            $result->preferred_start_period,
                                            $result->preferred_end_period,
                                            $result->preferred_number_days);
                $subjectClass[$i]->setRoomFixed($fixedRoom);
                // echo "<br/>required period: ";print_r($subjectClass[$i]->getSubject()->getRequiredPeriod());
                
                $i++;
            }
        }

        return $subjectClass;
    }


    public function CreateTimetable($subjectClasses){
        $timetable = []; // subjectClass-timeslot
        // echo "SubjectID \t TGroup \t\t Subj Name \t\t Inst \t\t Room<br>";
        foreach ($subjectClasses as $subjectClass){
            // echo "<br/>\t"; print_r($subjectClass->getID());
            // echo "\t"; print_r($subjectClass->getTraineeGroup()->getTraineeGroupName());
            // echo "\t\t"; print_r($subjectClass->getSubject()->getSubjectName());
            // echo "\t\t"; print_r($subjectClass->getInstructor()->getFirst_name());
            // echo "\t\t"; print_r($subjectClass->getRoom()->getRoomName());
            // echo " <br> ";
            // echo "<br/>required period: ";print_r($subjectClass->getSubject()->getRequiredPeriod());
            // echo "<br/>getPreferredNumberOfDays: ";print_r($subjectClass->getPreferredNumberOfDays());
            $distBlock = $this->getDistBlock($subjectClass->getSubject()->getRequiredPeriod(),
                                                $subjectClass->getPreferredNumberOfDays() 
            );
            // echo "<br/>count: ".count($distBlock)." ";
            // print_r($distBlock);
            // $this->getSlot($distBlock);
            //print_r($this->getSlot($distBlock));
            for($i=0; $i < count($distBlock); $i++ ){
                // echo "no of periods: ".$distBlock[$i];
                $timeslot = $this->getSlot($distBlock[$i]);

                tba: need to include the 2 parameters below. 
                                // $result->preferred_start_period,
                                // $result->preferred_end_period,
                tba: break/recess 

                for($j=0; $j<sizeof($timeslot); $j++){
                    // array_push($timetable,[[$subjectClass][$timeslot[$j]]);
                    $timetable[] = [$subjectClass, $timeslot[$j]];
                }
            }//break;

        }
        // echo"timetable now: ";
        return $timetable;
    }

   
    public function indexAction (){
        echo"<pre>";

            $initSlot = rand(0, TimetableConfig::TOTAL_TIME_SLOTS-1);
            echo "<br/>initSlot: {$initSlot}";
        // $a=array("a"=>1,"b"=>1,"c"=>1);
        // print_r(array_unique($a));



        $x = $this->CreateSubjectClasses(1);
        
        for($i=0; $i < count($x); $i++){
            // echo"{$i}===<br/> ";print_r($x[$i]->getRoom());
            
        }
        //echo"===<br/> ";print_r($x);
        echo"===<br/> ";echo"===<br/> ";

        $requiredNumberOfPeriods = 5;
        $preferredNumberOfDays = 4;
        // echo "<br/>requiredNumberOfPeriods: {$requiredNumberOfPeriods} preferredNumberOfDays: {$preferredNumberOfDays}";
        // echo "<br/>dist block: ";print_r($this->getDistBlock($requiredNumberOfPeriods, $preferredNumberOfDays));

        echo "\tSubjectID \t TGroup \t\t Subj Name \t\t Inst \t\t Room<br>";
            
        $timetable = $this->CreateTimetable($x);
        for ($i=0; $i<sizeof($timetable); $i++){
            echo "<br/> {$i} "; 
            print_r ("\t ".$timetable[$i][0]->getID());
            print_r ("\t\t ".$timetable[$i][0]->getTraineeGroup()->getTraineeGroupName());
            print_r ("\t\t ".$timetable[$i][0]->getSubject()->getSubjectName());
            print_r ("\t\t ".$timetable[$i][0]->getInstructor()->getFirst_name());
            print_r ("\t\t ".$timetable[$i][0]->getRoom()->getRoomName());
            print_r ("\t\t\t ".$timetable[$i][1]);
            echo " <br> ";
        }
    }




    public function getDistBlock($requiredNumberOfPeriods, $preferredNumberOfDays){
        $total = 0;
        $block = [];
        for ($i = 0; $i < ($preferredNumberOfDays - 1); $i++){
            $period = (int)( $requiredNumberOfPeriods / $preferredNumberOfDays);
            array_push($block, $period);
            $total += $period;
        }
        array_push($block, ($requiredNumberOfPeriods-$total));
        shuffle($block);
        return $block;
    }

    public function getSlot($numberOfPeriods){
        // subject-classes are taught in "d" number days with "p" number of periods per day
        // this loop is "per" distribution block
        // count: 3 Array
        // (
        //     [0] => 2
        //     [1] => 1
        //     [2] => 1
        // )
        // echo "<br/><br/>*******************************";
        // echo "<br/>TOTAL_TIME_SLOTS: ";print_r (TimetableConfig::TOTAL_TIME_SLOTS);
        // echo"<br/>numberOfPeriods= {$numberOfPeriods}<br/><br/>"; 
 
        $sameDay = false;
        while (!$sameDay){
            $timeslot = [];
            $day = [];  
            $initSlot = mt_rand(0, TimetableConfig::TOTAL_TIME_SLOTS-1);
            // echo "<br/>initSlot: {$initSlot}";
            for ($j=0; $j < $numberOfPeriods; $j++){
                // echo "<br/>j={$j} "; print_r($initSlot+$j);
                array_push($timeslot, $initSlot+$j);
                // echo "<br/>day: ";print_r( (int) (($initSlot+$j)/TimetableConfig::TOTAL_PERIODS) );
                array_push($day, ((int) (($initSlot+$j)/TimetableConfig::TOTAL_PERIODS) ));
            
            }
            $sameDay = ((count(array_unique($day)) === 1)); // all timeslot belongs to the same day
            // if ((count(array_unique($day)) === 1)){
            //     echo "<br/>true";
            // }else{
            //     echo "<br/>false";
            // } 
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
                    echo "<br/>room ID chosen-------------:";print_r ($db->getResults()[$randomRoom]->id);
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
}// class end 


/*
// echo "<pre>greetings from testTimetable index TOTAL_TIME_SLOTS: ";
        // echo TimeTableConfig::TOTAL_TIME_SLOTS;

        // $subjectClass = [];
        // $meetingTime = [];
        // // return true;
        // $timeTableID = 1;

        // $db = DB::getInstance();
        // // SELECT * FROM `subject_class` WHERE subject_class.timetable_id = 1
        // $db->query("SELECT * FROM subject_class WHERE subject_class.timetable_id = {$timeTableID}");
        // echo "<br/>Result count: {$db->count()}<br/>";
        // if ($db->count()){
        //     // print_r ( $db->getResults());
        //     // var_dump($db->first());
        //     foreach ($db->getResults() as $result){
        //          echo "<br/><br/>SUBJECT ID: {$result->id}";
        //         /*

        //         if !room 
        //            get a random room first based on room type 
        //         else 
        //             get the room based on the roomID 
        //             echo "<br/><br/>";print_r ();

        //         */

        //         if ($result->room_id){
        //             // echo "<br/>room_id specified: {$result->room_id} ";//print_r ($result->room_id);
        //             $room = $this->getRoom($result->room_id);
        //             $fixedRoom = true;
        //             //$result->setRoomFixed($result->room_id);
        //         }else{
        //             // echo "<br/>room_id not specified: {$result->room_id}";//print_r ($result->room_id);
        //             // echo "<br/>room_type_id specified: {$result->room_type_id}";
        //             // echo "<br/>getRandomRoom specified: ";print_r ($this->getRandomRoom($result->room_type_id));
        //             $room = $this->getRandomRoom($result->room_type_id);
        //             $fixedRoom = false;
        //         }
        //         // echo "id: {$result->meeting_time}<br/>";
        //         $subjectClass[$result->id] = 
        //         new SubjectClass (
        //                     $result->id,
        //                     $timeTableID,
        //                     $this->getSubject($result->subject_id),
        //                     $this->getTraineeGroup($result->trainee_group_id), 
        //                     $this->getInstructor($result->instructor_id), //$instructorID = null,
        //                     $this->getRoomType($result->room_type_id), //$roomType = null,
        //                     $this->getRoom($result->room_id), //$roomID = null,
        //                     $result->preferred_start_period, //$preferredStart = null,
        //                     $result->preferred_end_period, //$preferredEnd = null,
        //                     $result->preferred_number_days //$preferredNumberOfDays = null
        //         );
        //         $subjectClass[$result->id]->setRoomFixed($fixedRoom);

        //         // meeting time TBA

        //     }
        // }
        // // echo "<br/>";
        // // var_dump ($meetingTime[0]);
        // // $mt = explode(',' ,$meetingTime[0]);
        // // echo "<br/><br/>".count($mt);
        // // echo "<br/><br/>";var_dump ($mt);
        // echo "<br/><br/>";print_r ($subjectClass);
        // echo "<br/>isRoomFixed: <br/>";print_r ($subjectClass[1]->isRoomFixed());
        
        // // echo "<br/><br/>";print_r ($this->getTraineeGroup(2));




