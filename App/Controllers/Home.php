<?php

namespace App\Controllers;

use \Core\View;
use App\Controllers\Auth\Session;
use App\TimetableConfig;
use App\Models\DB;


/**
 * Home controller
 *
 * PHP version 5.4
 */
class Home extends \Core\Controller
{
    private $conflicts = [];
    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        $sessionData = Session::getInstance();
        if (!$sessionData->inSession) {
            header("Location: /auth/LoginController/index");
            exit;
        }
          
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {
        //echo " (after)";
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction(){
        $sessionData = Session::getInstance();
        // session was processed by the before Method above; 

        $db = DB::getInstance();
        // fetch timetable info 
        $db->select(
            array('*'),
            array('timetable'),
            array(['timetable.current', '=', '1'])
        );
        $timetable = ($db->getResults());
        if($db->count() > 0){
            $sessionData->currentTimetable = $timetable[0]->id;
        }else{
            // need to redirect ... wip
            header("Location: /Timetable/TimetableController/addTimetable");
            exit;
            
        }
        
        $tableTitle = 'List of classes for AY '.$timetable[0]->year_start.'-'.$timetable[0]->year_end.' Term '.$timetable[0]->term;
        $tableSubTitle = ''.$timetable[0]->remarks.' '.$timetable[0]->created;

        // fetch meeting info; 
        $db->select(
            array('*'),
            array('meeting'),
            array(['meeting.timetable_id', '=', $sessionData->currentTimetable])
        );


        $meeting = ($db->getResults());
        

        // if there exist a generated timetable for this current timetable; 
        // fetch the data and pass it to the view index.twig.html; 
        if ($db->count()){
            $timestamp = $meeting[0]->timestamp;

            // setup the periods and their corresponding time slots; 
            if(true) {
                $time_slots = [];
                
                // will contain all the periods with their corresponding time slots; 
                $time_col = [];
                
                // 8:00 - 8:50 , 8:50 - 9:40 etc... 
                $period = $this->generatePeriods(TimetableConfig::TOTAL_PERIODS);

                // 0 to 4 
                $numDays = TimetableConfig::TOTAL_DAYS;

                $totalTimeSlot = TimetableConfig::TOTAL_TIME_SLOTS;

                // get all the timeslots
                for ($i=0; $i < $totalTimeSlot; $i++) { 
                    $time_slots[]=$i;
                }

                // group time slots according to the day they fall into; 
                for ($i=0; $i <sizeof ($period); $i++) { 
                    for ($j=0; $j < $totalTimeSlot; $j++) {
                        if (($j==$i) or (fmod($j-$i, TimetableConfig::TOTAL_PERIODS))== 0 ){
                            $shift = array_shift($time_slots);
                            $time_col[$period[$i]][] = $j;
                        }
                    }
                }
            }
        
            // fetch the data from the database;
            $db = DB::getInstance();
            $db->select(
                    array(  
                            'trainee_group.name as \'trainee_group\'',
                            'subject.name as \'subject\'',
                            'subject.code as \'code\'',
                            'concat (instructor.first_name,\' \', instructor.last_name) as\'instructor\'', 
                            'room.name as \'room\'',
                            'meeting.time_slot'

                    ),
                    array('meeting
                                INNER JOIN trainee_group
                                    ON meeting.trainee_group_id = trainee_group.id
                                INNER JOIN subject
                                    ON meeting.subject_id = subject.id
                                INNER JOIN instructor
                                    ON meeting.instructor_id = instructor.id
                                INNER JOIN room
                                    on meeting.room_id = room.id' 
                    ),
                    array(
                        ['meeting.timetable_id', '=', $sessionData->currentTimetable]
                        // ,['instructor.first_name', 'LIKE', '%Fat%']
                    )
                );
            $meeting = ($db->getResults());

            
            

            usort($meeting, function($a, $b) { return $a->time_slot - $b->time_slot; });
            // print_r("\n<pre>"."\n");
            // print_r($meeting);
           
            // print_r($time_col);
            // exit;
                
            View::renderTemplate ('Home/index.twig.html', [
                                        'firstName'     => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'lastName'      => $sessionData->lastName,
                                        'tableTitle'    => $tableTitle,
                                        'tableSubTitle' => $tableSubTitle,
                                        'meetings'       => $meeting,
                                        'time_col'      => $time_col,
                                        'timestamp'     => $timestamp
                                    ]);


        
        
        }else { // there is no generated timetable for this current one;
            View::renderTemplate ('Home/index.twig.html', [
                                        'firstName'     => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'lastName'      => $sessionData->lastName,
                                        'tableTitle'    => 'No timetable generated yet!<br/> Generate using the Timetable menu above.',
                                        'tableSubTitle' => '',
                                        'meeting'       => []
                                    ]);
        }
                                          
    }


    /*
     * generatePeriods method 
     *
     * @param		
     * @return	 	
     */
    public function generatePeriods ($numPeriods){
        $hour = 8;          // starting period; 
        $minute = 0;
        $running_time = 0;
        $periods = [];

        for ($i=0; $i < $numPeriods; $i++) { 
            if (($running_time + 50) < 60){
                $min = ($minute == 0) ? '00' : $minute ;
                $from = ($hour.":". $min. " - ");
                if (($minute+50) <= 60){
                    $minute += 50;
                }else{
                    $minute = $minute+50 - 60;
                    $hour++;
                }
                $running_time += $minute;
                $min = ($minute == 0) ? '00' : $minute ;
                $to = ($hour.":". $min);
                $periods [] = ($from . $to);
            }else{
                
               
                // print_r("\n".$hour.":". $minute);
                $min = ($minute == 0) ? '00' : $minute ;
                $from = ($hour.":". $min. " - ");

                $minute = ($running_time + 50) - 60;
                $running_time = 0;
                $hour++;
                // print_r("\t-\t<b>".$hour."</b>:". $minute);
                $min = ($minute == 0) ? '00' : $minute ;
                $to = ($hour.":". $min);
                $periods [] = ($from . $to);

            }
        }

        return $periods;
    }

    /*
     * filterTimetable method 
     *
     * @param		
     * @return	 	
     */
    public function filterTimetable (){


        $sessionData = Session::getInstance();
        // session was processed by the before Method above; 

        $db = DB::getInstance();
        
        // fetch timetable info 
        $db->select(
            array('*'),
            array('timetable'),
            array(['timetable.current', '=', '1'])
        );
        $timetable = ($db->getResults());
        if($db->count() > 0){
            $sessionData->currentTimetable = $timetable[0]->id;
        }else{
            // need to redirect ... wip
            header("Location: /Timetable/TimetableController/addTimetable");
            exit;
            
        }
        
        $tableTitle = 'List of classes for AY '.$timetable[0]->year_start.'-'.$timetable[0]->year_end.' Term '.$timetable[0]->term;
        $tableSubTitle = ''.$timetable[0]->remarks.' '.$timetable[0]->created;

        // fetch meeting info; 
        $db->select(
            array('*'),
            array('meeting'),
            array(['meeting.timetable_id', '=', $sessionData->currentTimetable])
        );


        $meeting = ($db->getResults());
        

        // if there exist a generated timetable for this current timetable; 
        // fetch the data and pass it to the view index.twig.html; 
        if ($db->count()){
            $timestamp = $meeting[0]->timestamp;

            // setup the periods and their corresponding time slots; 
            if(true) {
                $time_slots = [];
                
                // will contain all the periods with their corresponding time slots; 
                $time_col = [];
                
                // 8:00 - 8:50 , 8:50 - 9:40 etc... 
                $period = $this->generatePeriods(TimetableConfig::TOTAL_PERIODS);

                // 0 to 4 
                $numDays = TimetableConfig::TOTAL_DAYS;

                $totalTimeSlot = TimetableConfig::TOTAL_TIME_SLOTS;

                // get all the timeslots
                for ($i=0; $i < $totalTimeSlot; $i++) { 
                    $time_slots[]=$i;
                }

                // group time slots according to the day they fall into; 
                for ($i=0; $i <sizeof ($period); $i++) { 
                    for ($j=0; $j < $totalTimeSlot; $j++) {
                        if (($j==$i) or (fmod($j-$i, TimetableConfig::TOTAL_PERIODS))== 0 ){
                            $shift = array_shift($time_slots);
                            $time_col[$period[$i]][] = $j;
                        }
                    }
                }
            }
            
            // Process filter request
            $filter = $_POST;

            if ( $filter['filter'] == 'trainee'){
                $filter = ['trainee_group.name', 'LIKE', '%'.$filter['filter_data'].'%'] ;

            }elseif ($filter['filter'] == 'instructor') {
                $filter = ['concat (instructor.first_name,\' \', instructor.last_name)', 'LIKE', '%'.$filter['filter_data'].'%'] ;

            }else {
                $filter = ['room.name', 'LIKE', '%'.$filter['filter_data'].'%'] ;
            }

            // fetch the data from the database;
            
            $db->select(
                array(  
                        'trainee_group.name as \'trainee_group\'',
                        'subject.name as \'subject\'',
                        'subject.code as \'code\'',
                        'concat (instructor.first_name,\' \', instructor.last_name) as\'instructor\'', 
                        'room.name as \'room\'',
                        'meeting.time_slot'

                ),
                array('meeting
                            INNER JOIN trainee_group
                                ON meeting.trainee_group_id = trainee_group.id
                            INNER JOIN subject
                                ON meeting.subject_id = subject.id
                            INNER JOIN instructor
                                ON meeting.instructor_id = instructor.id
                            INNER JOIN room
                                on meeting.room_id = room.id' 
                ),
                array(
                    ['meeting.timetable_id', '=', $sessionData->currentTimetable], $filter
                )
            );
            
            
            $meeting = ($db->getResults());

            
            

            usort($meeting, function($a, $b) { return $a->time_slot - $b->time_slot; });
            // print_r("\n<pre>"."\n");
            // print_r($meeting);
            
            // print_r($time_col);
            // exit;
                
            View::renderTemplate ('Home/index.twig.html', [
                                        'accessRight'   => $sessionData->rights,
                                        'firstName'     => $sessionData->firstName,
                                        'lastName'      => $sessionData->lastName,
                                        'tableTitle'    => $tableTitle,
                                        'tableSubTitle' => $tableSubTitle,
                                        'meetings'       => $meeting,
                                        'time_col'      => $time_col,
                                        'timestamp'     => $timestamp
                                    ]);


        
        
        }else { // there is no generated timetable for this current one;
            View::renderTemplate ('Home/index.twig.html', [
                                        'accessRight'   => $sessionData->rights,
                                        'firstName'     => $sessionData->firstName,
                                        'lastName'      => $sessionData->lastName,
                                        'tableTitle'    => 'No timetable generated yet!<br/> Generate using the Timetable menu above.',
                                        'tableSubTitle' => '',
                                        'meeting'       => []
                                    ]);
        }




    }


    /*
     * recheckTimetable method 
     *
     * @param		
     * @return	 	
     */
    public function recheckTimetable (){
        $sessionData = Session::getInstance();
        // session was processed by the before Method above; 

        $db = DB::getInstance();
        // fetch timetable info 
        
        $buttonClicked = (key($_POST));

        // insert the newData to the meeting TABLE 
        if ($sessionData->inSession) {
            // view timetable button was clicked
            if ($buttonClicked === 'view'){

                header("Location: /home");
                exit;
            }
        }


        // ------------------------------------
        // fetch meeting info; 
        $db->select(
            array('*'),
            array('meeting'),
            array(['meeting.timetable_id', '=', $sessionData->currentTimetable])
        );


        $meeting = ($db->getResults());
        

        // if there exist a generated timetable for this current timetable; 
        // fetch the data and pass it to the view index.twig.html; 

        if ($db->count()){
            $timestamp = $meeting[0]->timestamp;
            // fetch the data from the database; ts subject_id trainee_group_id instructor_id rm

            $db->select(
                    array(  
                            'meeting.id',
                            'meeting.room_id',
                            'meeting.subject_id',
                            'trainee_group_id',
                            'meeting.instructor_id',
                            'meeting.room_id',
                            'meeting.time_slot'

                    ),
                    array('meeting
                                INNER JOIN trainee_group
                                    ON meeting.trainee_group_id = trainee_group.id
                                INNER JOIN subject
                                    ON meeting.subject_id = subject.id
                                INNER JOIN instructor
                                    ON meeting.instructor_id = instructor.id
                                INNER JOIN room
                                    on meeting.room_id = room.id' 
                    ),
                    array(
                        ['meeting.timetable_id', '=', $sessionData->currentTimetable]
                        // ,['instructor.first_name', 'LIKE', '%Fat%']
                    )
                );
            $meeting = ($db->getResults());

            // $timetable [] = ["mt_id"=>$mt_id, "sc"=>$subjectClass, "ts"=>$slot, "rm"=> $room ];
            foreach ($meeting as $key => $value) {

                $timetable [] = [   "mt_id"=>$value->id, "ts"=>$value->time_slot, "rm"=> $value->room_id,
                                    "sc" => [   "subject_id"        => $value->subject_id, 
                                                "trainee_group_id"  => $value->trainee_group_id,
                                                "instructor_id"     => $value->instructor_id
                                    ]
                    ];
            }

            $fitnessValue = $this->calcFitness ($timetable);;
            
            // conflict at timeslot number;

            $conflicts = null;

            foreach ($this->conflicts as $key => $value) {

                $conflicts .= $value. '.';

            }

            // add the fitness value / number of conflicts for the currently gerenrated table;
            
            $remarks = '('.$fitnessValue.')'.'Conflict/s ['.$conflicts.']';
            
            $db->query('UPDATE  timetable SET timetable.remarks = \''.$remarks.'\' WHERE   timetable.current = 1');
            
            header("Location: modifyGeneratedTimetable");
            
            exit;
                


        
        
        }else { // there is no generated timetable for this current one;
            
            View::renderTemplate ('Home/index.twig.html', [
                                        'firstName'     => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'lastName'      => $sessionData->lastName,
                                        'tableTitle'    => 'No timetable generated yet!<br/> Generate using the Timetable menu above.',
                                        'tableSubTitle' => '',
                                        'meeting'       => []
                                    ]);
             exit;
        }
       
        
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

            // fetch timeslot that is associated with a 
            
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


    public function modifyGeneratedTimetable(){
        

        $sessionData = Session::getInstance();
        // session was processed by the before Method above; 

        $db = DB::getInstance();
        // fetch timetable info 

        
        $db->select(
            array('*'),
            array('timetable'),
            array(['timetable.current', '=', '1'])
        );
        $timetable = ($db->getResults());
        if($db->count() > 0){
            $sessionData->currentTimetable = $timetable[0]->id;
        }else{
            // need to redirect ... wip
            header("Location: /Timetable/TimetableController/addTimetable");
            exit;
            
        }


        
        $tableTitle = 'List of classes for Timetable No.'.$timetable[0]->id .' ('.$timetable[0]->year_start.'-'.$timetable[0]->year_end.' / '.$timetable[0]->term.')';
        $tableSubTitle = ''.$timetable[0]->remarks.' '.$timetable[0]->created;

        // fetch meeting info; 
        $db->select(
            array('*'),
            array('meeting'),
            array(['meeting.timetable_id', '=', $sessionData->currentTimetable])
        );


        $meeting = ($db->getResults());
        

        // if there exist a generated timetable for this current timetable; 
        // fetch the data and pass it to the view index.twig.html; 
        if ($db->count()){
            $timestamp = $meeting[0]->timestamp;

            // setup the periods and their corresponding time slots; 
            if(true) {
                $time_slots = [];
                
                // will contain all the periods with their corresponding time slots; 
                $time_col = [];
                
                // 8:00 - 8:50 , 8:50 - 9:40 etc... 
                $period = $this->generatePeriods(TimetableConfig::TOTAL_PERIODS);

                // 0 to 4 
                $numDays = TimetableConfig::TOTAL_DAYS;

                $totalTimeSlot = TimetableConfig::TOTAL_TIME_SLOTS;

                // get all the timeslots
                for ($i=0; $i < $totalTimeSlot; $i++) { 
                    $time_slots[]=$i;
                }

                // group time slots according to the day they fall into; 
                for ($i=0; $i <sizeof ($period); $i++) { 
                    for ($j=0; $j < $totalTimeSlot; $j++) {
                        if (($j==$i) or (fmod($j-$i, TimetableConfig::TOTAL_PERIODS))== 0 ){
                            $shift = array_shift($time_slots);
                            $time_col[$period[$i]][] = $j;
                        }
                    }
                }
            }
        
            // fetch the data from the database;
            $db = DB::getInstance();
            $db->select(
                    array(  
                            'trainee_group.name as \'trainee_group\'',
                            'subject.name as \'subject\'',
                            'subject.code as \'code\'',
                            'concat (instructor.first_name,\' \', instructor.last_name) as\'instructor\'', 
                            'room.name as \'room\'',
                            'meeting.time_slot',
                            'meeting.id'

                    ),
                    array('meeting
                                INNER JOIN trainee_group
                                    ON meeting.trainee_group_id = trainee_group.id
                                INNER JOIN subject
                                    ON meeting.subject_id = subject.id
                                INNER JOIN instructor
                                    ON meeting.instructor_id = instructor.id
                                INNER JOIN room
                                    on meeting.room_id = room.id' 
                    ),
                    array(
                        ['meeting.timetable_id', '=', $sessionData->currentTimetable]
                    )
                );
            $meetings = ($db->getResults());


         View::renderTemplate ('/Home/modifyGeneratedTimetableForm.twig.html', [
                                    'firstName'     => $sessionData->firstName,
                                    'accessRight'   => $sessionData->rights,
                                    'tableTitle'    => $tableTitle,
                                    'tableSubTitle' => $tableSubTitle,
                                    'meetings'      => $meetings,
                                    'title'         => 'Modify Generated Timetable',
                                    'tableHeadings' => ['Group', 'Course', 'Instructor', 'Timeslot', 'Room']

                                ]);
        }else { // there is no generated timetable for this current one;
            View::renderTemplate ('Home/index.twig.html', [
                                        'firstName'     => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'lastName'      => $sessionData->lastName,
                                        'tableTitle'    => 'No timetable generated yet!<br/> Generate using the Timetable menu above.',
                                        'tableSubTitle' => '',
                                        'meeting'       => []
                                    ]);
        }
    }


    /*
     * updateGeneratedTimetable method 
     *
     * @param		
     * @return	 	
     */
    public function updateGeneratedTimetable (){
        // echo "<pre>";
        // print_r($_POST);
        // exit;
        
        $sessionData = Session::getInstance();
        $db = DB::getInstance();

        /*
            Array
                (
                    [timeslot] => 1
                    [room_type] => Workshop-RAC
                    [room_type_id] => 5
                    [room_id] => 
                    [meeting_id] => mt_id_3
                )

        */
        $timeslot       = $_POST["timeslot"];
        $room_type_id   = $_POST["room_type_id"];
        $room_id        = $_POST["room_id"];
        $id             = $_POST["meeting_id"];

        // UPDATE `meeting` SET time_slot = 1 ,room_id = 10
        // WHERE id = 1


        if (!($room_id) == ""){
            $db->update ('meeting', 
                            array( 
                                    ['time_slot',   '=', $timeslot],
                                    ['room_id',     '=', $room_id]
                                ),
                            array(['id','=', $id])
            );

        }else{
            $db->update ('meeting', 
                            array( 
                                    ['time_slot',   '=', $timeslot]
                                ),
                            array(['id','=', $id])
            );

        }
        header("Location: modifyGeneratedTimetable");
        exit;
    }

    /*
     * ajaxFetchTimeslotAvailable method 
     *
     * @param		
     * @return	 	
     */
    public function ajaxFetchTimeslotAvailable (){
        // echo "<pre>";
       
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        $meetingId = $_POST['keyword'];

        // fetch details for this meetingID
        // SELECT * FROM `meeting` WHERE meeting.id = 16978
        $db->query("SELECT * FROM meeting WHERE meeting.id = {$meetingId}");
        $currentMeetingID = $db->getResults();

        /*
                    $currentMeetingID[0]->time_slot
                    Array
                        (
                            [0] => stdClass Object
                                (
                                    [id] => 16976
                                    [timetable_id] => 18
                                    [subject_class_id] => 3763
                                    [trainee_group_id] => 4
                                    [subject_id] => 3
                                    [instructor_id] => 63
                                    [time_slot] => 38
                                    [room_id] => 2
                                    [timestamp] => 2017-04-21 12:04:21
                                )

                        )

        */

        // fetch meeting info; 
        $db->select(
            array('*'),
            array('meeting'),
            array(['meeting.timetable_id', '=', $sessionData->currentTimetable])
        );


        $meeting = ($db->getResults());
        

        // if there exist a generated timetable for this current timetable; 
        // fetch the data and pass it to the view index.twig.html; 

        if ($db->count()){
            $timestamp = $meeting[0]->timestamp;

            // fetch the data from the database; ts subject_id trainee_group_id instructor_id rm

            $db->select(
                    array(  
                            'meeting.id',
                            'meeting.room_id',
                            'meeting.subject_id',
                            'trainee_group_id',
                            'meeting.instructor_id',
                            'meeting.room_id',
                            'meeting.time_slot'

                    ),
                    array('meeting
                                INNER JOIN trainee_group
                                    ON meeting.trainee_group_id = trainee_group.id
                                INNER JOIN subject
                                    ON meeting.subject_id = subject.id
                                INNER JOIN instructor
                                    ON meeting.instructor_id = instructor.id
                                INNER JOIN room
                                    on meeting.room_id = room.id' 
                    ),
                    array(
                        ['meeting.timetable_id', '=', $sessionData->currentTimetable]
                    )
                );
            $meeting = ($db->getResults());

            // $timetable [] = ["mt_id"=>$mt_id, "sc"=>$subjectClass, "ts"=>$slot, "rm"=> $room ];
            foreach ($meeting as $key => $value) {

                $timetable [] = [   "mt_id"=>$value->id, "ts"=>$value->time_slot, "rm"=> $value->room_id,
                                    "sc" => [   "subject_id"        => $value->subject_id, 
                                                "trainee_group_id"  => $value->trainee_group_id,
                                                "instructor_id"     => $value->instructor_id
                                    ]
                    ];
            }


            // collect all timeslots used

            $timeslots = [];

            for ($i=0; $i < sizeof($timetable); $i++) {

                // fetch timeslot that is associated with a 
                
                array_push($timeslots, $timetable[$i]["ts"]);

            }
            // remove duplicate timeslot from the list of timeslot that is associated with a subjectClassID

            
            
            
            $timeslots = (array_unique($timeslots));
            sort($timeslots);
            // print_r($timeslots);
            // exit;
            // find available timeslots
            
            $fullyAvailableTimeslots = [];
            $partiallyAvailableTimeslots = [];
            
            foreach ($timeslots as $timeslot) {
                
                
                $subjectClassID =[];
                $roomID = [];
                $traineeGroupID = [];
                $instructorID = [];

                for ($i=0; $i < sizeof($timetable); $i++) {
                    
                    // gather all IDs belonging to this timeslot. 
                    if ($timeslot == $timetable[$i]["ts"]) {

                        $roomID[]           = $timetable[$i]['rm'];
                        $traineeGroupID[]   = $timetable[$i]["sc"]["trainee_group_id"];
                        $instructorID[]     = $timetable[$i]["sc"]["instructor_id"];
                    }
                }

                // if on this timeslot, the instructor and the trainee_group is NOT found
                // then this timeslot is not available 


                if (! in_array($currentMeetingID[0]->trainee_group_id,    $traineeGroupID) && 
                    ! in_array($currentMeetingID[0]->instructor_id,       $instructorID) ){

                        // print_r("\nMatch here!"."\n");

                        if ( ! in_array($currentMeetingID[0]->room_id,    $roomID) ){
                            $fullyAvailableTimeslots[]      = $timeslot;
                        }else{

                            $partiallyAvailableTimeslots[]  = $timeslot;
                        }

                }else{
                    // print_r("\nno Match!"." ");
                }

                
            }

            // check for vacant timeslots
            for ($i=0; $i < TimetableConfig::TOTAL_TIME_SLOTS; $i++) { 
                if (!(in_array($i, $timeslots) )) {
                    $fullyAvailableTimeslots[] = $i;
                }
            }


            

            sort($fullyAvailableTimeslots);
            sort($partiallyAvailableTimeslots);
            echo '<div class="text-success">Fully available: <b> ';
            foreach ($fullyAvailableTimeslots as $key => $value) {
                echo $value.", ";
            }
            echo '</b></div>';
            echo '<div class="text-danger">Room change needed: ';

            foreach ($partiallyAvailableTimeslots as $key => $value) {
                echo $value.", ";
            }
            exit;
                


        
        
        }else { // there is no generated timetable for this current one;
            
            View::renderTemplate ('Home/index.twig.html', [
                                        'firstName'     => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'lastName'      => $sessionData->lastName,
                                        'tableTitle'    => 'No timetable generated yet!<br/> Generate using the Timetable menu above.',
                                        'tableSubTitle' => '',
                                        'meeting'       => []
                                    ]);
             exit;
        }


        header("Location: modifyGeneratedTimetable");
        exit;
    }

    /*
     * printOptions method 
     *
     * @param		
     * @return	 	
     */
    public function printTimetableOptionsAction (){
        $sessionData = Session::getInstance();
        View::renderTemplate ('Home/printTimetableForm.twig.html', [
                                        'firstName'     => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'lastName'      => $sessionData->lastName,
                                        'title'         => 'Print'
                                    ]);
    }


    /*
     * logoutAction method 
     *
     * @param 	
     * @return	 
     */
    public function logoutAction (){
                
        $sessionData = Session::getInstance();
        $sessionData->destroy();
        header("Location: /auth/LoginController/index");
        exit;
    }





    public function demoAction(){
        $people = array("Peter", "Joe", "Glenn", "Cleveland");
        print_r($people);
        if (!in_array("Glenn", $people))
        {
        echo "Match found";
        }
        else
        {
        echo "Match not found";
        }

        // View::renderTemplate ('Home/demo.twig.html');

    }

    /** 
     * Show some data 
     * used during debugging...; 
     * @return void
     */
    public function showAction()
    {   
        $db = DB::getInstance();
        // $db->query("SELECT * FROM trainee_group WHERE id = {$ID}");
        // $id = "1";
        // // echo "<pre>";
        $db->query("SELECT * FROM room ");
        // foreach ($db->getResults() as $result){
        //     print_r($result);
        // }

        $x = $db->getResults();
        $data = "here is the dadddta";
        
        header('Content-Type: application/json');
        echo json_encode($data);

        /*
        SELECT instructor.id, concat(instructor.first_name,' ',instructor.last_name) as fullName 
        FROM instructor
        WHERE concat(instructor.first_name,' ',instructor.last_name) like '%ton%'

        */
        $db = DB::getInstance();
            $keyword = "'%"."a"."%'";
            $fields = "id, concat(instructor.first_name,' ',instructor.last_name) AS fullName";
            $where = "concat(instructor.first_name,' ',instructor.last_name) ";
            print_r("\n".$fields."\n");

            print_r("\n".''."\n");
            $db->query("SELECT {$fields} FROM instructor WHERE {$where} LIKE {$keyword} ORDER BY instructor.first_name LIMIT 0,10");
             print_r($db->count());
             $results = $db->getResults();

            //  print_r($results);
             foreach ($results as $result){
                 print_r("\n".$result->fullName."\n");
             }
        
    } 


    public function testAction(){

        // $data = "here is the data";
        
        // header('Content-Type: application/json');
        // echo json_encode($data);
        // print_r($this->route_params);
        echo "<pre>";
        $time_slots = [];
        $numPeriods = 3;
        $numDays = 5;
        $totalTimeSlot = $numPeriods * $numDays;
        for ($i=0; $i < $totalTimeSlot; $i++) { 
            
            $time_slots[]=$i;
        }
        print_r($time_slots);

        $row = [];
        $current = 0;
        for ($i=0; $i < $numPeriods; $i++) { 

            for ($j=0; $j < $totalTimeSlot; $j++) {
                if (($j==$i) or (fmod($j-$i, $numPeriods))== 0 ){
                    $shift = array_shift($time_slots);
                    // print_r("\nj: ".$j." i: ".$i." mod: ".fmod($j-$i, $numPeriods)."shift: ".$shift);
                    $row[$i][] = $j;
                }
            }
        }
        print_r($row);

        for ($i=0; $i < sizeof($row); $i++) { 
            print_r("\n".$i." ");
            for ($j=0; $j < sizeof($row[$i]); $j++) { 
                print_r("\t".$row[$i][$j]."");
            }
        }

        print_r("\n=================="."\n\n");

        $hour = 8;
        $minute = 0;
        $running_time = 0;
        $periods = [];
        for ($i=0; $i < 10; $i++) { 
            if (($running_time + 50) < 60){
                $min = ($minute == 0) ? '00' : $minute ;
                $from = ($hour.":". $min. " - ");
                if (($minute+50) <= 60){
                    $minute += 50;
                }else{
                    $minute = $minute+50 - 60;
                    $hour++;
                }
                $running_time += $minute;
                $min = ($minute == 0) ? '00' : $minute ;
                $to = ($hour.":". $min);
                $periods [] = ($from . $to);
            }else{
                
               
                // print_r("\n".$hour.":". $minute);
                $min = ($minute == 0) ? '00' : $minute ;
                $from = ($hour.":". $min. " - ");

                $minute = ($running_time + 50) - 60;
                $running_time = 0;
                $hour++;
                // print_r("\t-\t<b>".$hour."</b>:". $minute);
                $min = ($minute == 0) ? '00' : $minute ;
                $to = ($hour.":". $min);
                $periods [] = ($from . $to);

            }
        }

        print_r($periods);




        // View::renderTemplate('Home/test.twig.html',
        //                     ['params'=> $this->param]);
    }


}
