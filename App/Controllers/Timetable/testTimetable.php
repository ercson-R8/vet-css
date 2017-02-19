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
        $timeTable = [];
        foreach ($subjectClasses as $subjectClass){
            echo "<br/>required period: ";print_r($subjectClass->getSubject()->getRequiredPeriod());
            echo "<br/>getPreferredNumberOfDays: ";print_r($subjectClass->getPreferredNumberOfDays());
            $distBlock = $this->getDistBlock($subjectClass->getSubject()->getRequiredPeriod(),
                                $subjectClass->getPreferredNumberOfDays() 
            );
            for($i=0; $i < count($distBlock); $i++ ){
                
            }
        }

    }

   
    public function indexAction (){
        echo"<pre>";
        $x = $this->CreateSubjectClasses(1);
        
        for($i=0; $i < count($x); $i++){
            // echo"{$i}===<br/> ";print_r($x[$i]->getRoom());
            
        }
        echo"===<br/> ";print_r($x);

        $requiredNumberOfPeriods = 5;
        $preferredNumberOfDays = 4;
        echo "<br/>requiredNumberOfPeriods: {$requiredNumberOfPeriods} preferredNumberOfDays: {$preferredNumberOfDays}";
        echo "<br/>dist block: ";print_r($this->getDistBlock($requiredNumberOfPeriods, $preferredNumberOfDays));

        $this->CreateTimetable($x);
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




