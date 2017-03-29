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

        $sessionData->currentTimetable = $timetable[0]->id;

        
        $tableTitle = 'List of classes for AY '.$timetable[0]->year_start.'-'.$timetable[0]->year_end.' Term '.$timetable[0]->term;
        $tableSubTitle = '('.$timetable[0]->remarks.') '.$timetable[0]->created;

        // fetch meeting_time info; 
        $db->select(
            array('*'),
            array('meeting_time'),
            array(['meeting_time.timetable_id', '=', $sessionData->currentTimetable])
        );


        $meeting_time = ($db->getResults());
        

        // if there exist a generated timetable for this current timetable; 
        // fetch the data and pass it to the view index.twig.html; 
        if ($db->count()){
            $timestamp = $meeting_time[0]->timestamp;

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
                            'subject_class.id',
                            'trainee_group.name as \'trainee_group\'', 
                            'subject.name as \'subject\'',
                            'subject.code as \'code\'',
                            'subject.required_period as \'required_period\'',
                            'concat (instructor.first_name,\' \', instructor.last_name) as\'instructor\'', 
                            'room_type.name as \'room_type\'',
                            'room.name as \'room\'',
                            'subject_class.preferred_number_days as \'days\'', 
                            'subject_class.preferred_start_period as \'start\'', 
                            'subject_class.preferred_end_period as \'end\'',
                            'meeting_time.time_slot',
                            'meeting_time.subject_class_id',
                            'meeting_time.timetable_id'

                    ),
                    array('subject_class 
                            INNER JOIN trainee_group 
                                    ON subject_class.trainee_group_id = trainee_group.id 
                            INNER JOIN subject 
                                    ON subject_class.subject_id = subject.id 
                            INNER JOIN instructor 
                                    ON subject_class.instructor_id = instructor.id 
                            INNER JOIN room_type 
                                    ON subject_class.room_type_id = room_type.id
                            INNER JOIN room 
                                    ON subject_class.room_id = room.id
                            INNER JOIN meeting_time
                                    ON subject_class.id = meeting_time.subject_class_id' 
                    ),
                    array(
                        ['subject_class.timetable_id', '=', $sessionData->currentTimetable]
                        // ,['instructor.first_name', 'LIKE', '%Fat%']
                    )
                );
            $subject_class = ($db->getResults());

            
            

            usort($subject_class, function($a, $b) { return $a->time_slot - $b->time_slot; });
            // print_r("\n<pre>"."\n");
            // print_r($subject_class);
           
            // print_r($time_col);
            // exit;
                
            View::renderTemplate ('Home/index.twig.html', [
                                        'firstName'     => $sessionData->firstName,
                                        'lastName'      => $sessionData->lastName,
                                        'tableTitle'    => $tableTitle,
                                        'tableSubTitle' => $tableSubTitle,
                                        'meeting_time'  => $meeting_time,
                                        'time_col'      => $time_col,
                                        'subject_class' => $subject_class,
                                        'timestamp'     => $timestamp
                                    ]);


        
        
        }else { // there is no generated timetable for this current one;
            View::renderTemplate ('Home/index.twig.html', [
                                        'firstName'     => $sessionData->firstName,
                                        'lastName'      => $sessionData->lastName,
                                        'tableTitle'    => 'No timetable generated yet!<br/> Generate using the Timetable menu above.',
                                        'tableSubTitle' => '',
                                        'meeting_time'  => []
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


    public function demoAction(){
        View::renderTemplate ('Home/demo.twig.html');

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

    }

    /** 
     * Show some data
     *
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



    /*
     * readTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function readTraineeGroup(){

        if(!empty($_POST["keyword"])) {
            $db = DB::getInstance();
            $keyword = "'".$_POST["keyword"]."%'";
          
            $db->query("SELECT * FROM trainee_group WHERE trainee_group.name LIKE {$keyword} ORDER BY trainee_group.name LIMIT 0,10");
            //  print_r($db->count());
            if ($db->count()){
                ?>
                    <ul id="traineeGroup-list" class="list-unstyled">
                    <?php
                        foreach ($db->getResults() as $result){
                        ?>
                        <li onClick="selectCountry('<?php echo $result->name ?>');"><?php echo $result->name; ?></li>
                        <?php } ?>
                    </ul>
                <?php
            }            
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
