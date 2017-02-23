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
                    $isRoomFixed = true;
                }else{
                    $room = $this->getRandomRoom($result->room_type_id);
                    $isRoomFixed = false;
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
                $subjectClass[$i]->setRoomFixed($isRoomFixed);
                // echo "<br/>required period: ";print_r($subjectClass[$i]->getSubject()->getRequiredPeriod());
                
                $i++;
            }
        }

        return $subjectClass;
    }


    public function getTimeSlot($subjectClass){
        $timeslot = []; // subjectClass-timeslot
        echo "<br>";
        
        echo "<br/>Subject ID:\t"; print_r($subjectClass->getID());


            // distribute the required period/s with the preferred number of day/s
            // returns an array. $distBlock = [ [day]=>[no. of periods] ] 
            //     Array
            // (
            //     [0] => 2
            //     [1] => 1
            //     [2] => 1
            // )
        
        $distBlock = $this->getDistBlock($subjectClass->getSubject()->getRequiredPeriod(),
                                            $subjectClass->getPreferredNumberOfDays() 
                                        );

        echo "<br/>==================<br/>count: ".count($distBlock)." ";
        print_r($distBlock);
        $day = [];
        for($i=0; $i < count($distBlock); $i++ ){
                $sameDay = true;
                while ($sameDay){
                    $temp_slot = $this->getRandomSlot($distBlock[$i], 
                                                $subjectClass->getPreferredStart(),
                                                $subjectClass->getPreferredEnd()
                                                );
                    $daySelected = ((int) (($temp_slot[0])/TimetableConfig::TOTAL_PERIODS) );
                    if (!in_array($daySelected, $day)){
                        $day[]= $daySelected;
                    }

                }
        }
        // // $this->getSlot($distBlock);
        // //print_r($this->getSlot($distBlock));
        
        // $done = false;
        // while (!$done){
        //     $day = [];
        //     for($i=0; $i < count($distBlock); $i++ ){

        //         $temp_slot = $this->getSlot($distBlock[$i], 
        //                                     $subjectClass->getPreferredStart(),
        //                                     $subjectClass->getPreferredEnd()
        //                                     );

        //         for($j=0; $j<sizeof($temp_slot); $j++){
        //             // array_push($timetable,[[$subjectClass][$timeslot[$j]]);
        //             $timeslot[] = [$subjectClass, $temp_slot[$j]];
        //         }
        //     // if ((count(array_unique($day)) === count($distBlock)))
        //     }
        // }
        // // echo"timetable now: ";
        return $timeslot;
    }

   
    public function indexAction (){
        echo"<pre>";
        $timetableID = 1;
        $subjectClass = [];
        for($i=0; $i < TimetableConfig::POP_SIZE; $i++){
            $subjectClass[] = $this->CreateSubjectClasses($timetableID);
            
        }

        for($i=0; $i < sizeof($subjectClass); $i++){
            
        }

        // echo"===<br/> ";print_r($subjectClass[0]);

        $ts = $this->getTimeslot($subjectClass[0][0]);



        //echo"===<br/> ";print_r($x);
        // $timetable[0] = $this->CreateTimetable($x[0]);
        // $timetable[1] = $this->CreateTimetable($x[1]);
        // $this->displayTimetable($timetable[0]);
        // $this->displayTimetable($timetable[1]);

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
        // echo "<br/><br/>*******************************";
        // echo "<br/>TOTAL_TIME_SLOTS: ";print_r (TimetableConfig::TOTAL_TIME_SLOTS);
        // echo"<br/>numberOfPeriods= {$numberOfPeriods}<br/><br/>"; 
        
        // $ans = (($var==null) ? 'true' : 'false');
        
        $s = $preferred_start_period;
        $e = $preferred_end_period;
        echo "<br/><br/><h3>periods between {$s}-{$e}</h3>";
        
        $period_start = (($preferred_start_period==null) ? 0 : $preferred_start_period-1);
        $period_end = (($preferred_end_period==null) ? TimetableConfig::TOTAL_PERIODS : $preferred_end_period-1);
        
        $done = false;
        while (!$done){
            $timeslot = [];
            $day = [];  
            $initSlot = mt_rand(0, TimetableConfig::TOTAL_TIME_SLOTS-1);
            echo "initSlot: {$initSlot}<br/>";
            for ($j=0; $j < $numberOfPeriods; $j++){
                echo "<br/>j={$j} "; print_r($initSlot+$j);
                array_push($timeslot, $initSlot+$j);

                echo "<br/>day: ";print_r( (int) (($initSlot+$j)/TimetableConfig::TOTAL_PERIODS) );
                echo "<br/>";
                // push the timeslot in $day array 
                array_push($day, ((int) (($initSlot+$j)/TimetableConfig::TOTAL_PERIODS) ));
            
            }
            // all timeslot belongs to the same day
            if ((count(array_unique($day)) === 1)){
                // print_r($day);
                // if the selected starting period is from the preferred start onward
                if( ( fmod($timeslot[0],TimetableConfig::TOTAL_PERIODS) >= $period_start) && 
                    

                    // and the selected ending period is on or before the preferred ending period
                    (fmod($timeslot[sizeof($day)-1],TimetableConfig::TOTAL_PERIODS) <= $period_end)){

                    // then the slot selected is a match; 
                    $done = true;
                    $s = (fmod($timeslot[0],TimetableConfig::TOTAL_PERIODS))+1;
                    $e = (fmod($timeslot[sizeof($day)-1],TimetableConfig::TOTAL_PERIODS))+1;
                    echo "<br/>start: ".$s;
                    
                    echo " end: ".$e;
                    
                    // echo "<br/>";
                }
                
            }
        }
        echo "<br/>timeslot: ";print_r($timeslot);
        echo "<br/><br/>";
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