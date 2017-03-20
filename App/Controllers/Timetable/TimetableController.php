<?php

namespace App\Controllers\Timetable;

use \Core\View;
use App\Controllers\Auth\Session;
use App\Models\DB;
/**
 * Home controller
 *
 * PHP version 5.4
 */
class TimetableController extends \Core\Controller{


    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        $sessionData = Session::getInstance();
        if (!$sessionData->inSession){
            header("Location: /home/logout");
        }
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {

    }


    

    

    /*
     * addTimetable - action will provide the controller mechanism to display a form with the list
     * list of already store room from the database. 
     *
     * @param		none
     * @return      none	 	
     */
    public function addTimetableAction (){
        $sessionData = Session::getInstance();
        if ($sessionData->inSession) {
            $db = DB::getInstance();
            $db->query('SELECT * FROM timetable');
            
            $timetable = ($db->getResults());
            // print_r($timetable);
            View::renderTemplate ('Timetables/addtimetableForm.twig.html', [
                                        'timetable' => $timetable,
                                        'title' => 'Add A Timetable',
                                        'firstName' => $sessionData->firstName,
                                        'tableHeadings' => ['Year Start', 'Year End', 'Term' ,'Description']
                                    ]);
        }else {

            header("Location: /home/logout");

        }
        
    }



    /*
     * createNewTimetable - action will provide the controller mechanism to display a form with the list
     * list of already store course from the database. 
     *
     * @param		none
     * @return      none	 	
     */
    public function createNewTimetable(){
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        
        if ($sessionData->inSession) {
            

            //$timetable = ($db->getResults());
            $year_start = $_POST["year_start"];
            $year_end = $_POST["year_end"];
            $term = $_POST["term"];
            $remarks = $_POST["remarks"];
            

            //create digest of the form submission:

            $messageIdent = md5($_POST['year_start'] . $_POST['year_end'] . $_POST['term']);

            $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';

            if($messageIdent!=$sessionMessageIdent){ //if its different:
                //save the session var: 
                $sessionData->messageIdent = $messageIdent;
                // UPDATE timetable
                // SET timetable.current = 0
                // WHERE timetable.current = 1
                $db = DB::getInstance();
                $db->query('UPDATE timetable SET timetable.current = 0  WHERE timetable.current = 1');
                // echo ("<pre>asdfadf <br/>");
                $timetable = ($db->getResults());
                // print_r($db->count());
                // save the data 
                $db->insert('timetable', 
                        array(  'year_start' => $year_start,
                                'year_end' =>  $year_end,
                                'term' => $term,
                                'remarks' => $remarks,
                                'current' => 1
                        ));

                unset($_POST);
                


                $lastInsertId = $db->getlastInsertId();
                $sessionData->currentTimetable = $lastInsertId;

                // print_r("\n".$sessionData->currentTimetable."\n");
                header("Location: /Timetable/TimetableController/addSubjectClass");

                // $this->addSubjectClassAction( $lastInsertId ); 
                
            
            }else{
                //you've sent this already!
                
                
               // $this->addSubjectClassAction();


            }
                        
        }else {
            header("Location: /home/logout");

        }
    }


    /*
     * addSubjectClass - action will provide the controller mechanism to display a form with the list
     * list of already store room from the database. 
     *
     * @param		none
     * @return      none	 	
     */
    public function addSubjectClassAction (){




        $sessionData = Session::getInstance();
        if ($sessionData->inSession) {
            $db = DB::getInstance();   

            $db->select(
                array('*'),
                array('subject_class'),
                array(['subject_class.timetable_id', '=', $sessionData->currentTimetable])
            );

            $subject_class = ($db->getResults());

            $db->select(
                array('*'),
                array('timetable'),
                array(['timetable.id', '=', $sessionData->currentTimetable])
            );
          
            $timetable = ($db->getResults());
            // print_r($timetable);
            $tableTitle = 'List of classes for AY '.$timetable[0]->year_start.'-'.$timetable[0]->year_end.' Term '.$timetable[0]->term;
            $tableSubTitle = '('.$timetable[0]->remarks.')';
            
            // print_r($subject_class);

            // print_r($timetable);
            View::renderTemplate ('Timetables/addSubjectClassForm.twig.html', [
                                        'subjectClass' => $subject_class,
                                        'title' => 'Add a Class '.$sessionData->currentTimetable,
                                        'firstName' => $sessionData->firstName,
                                        'tableTitle' => $tableTitle,
                                        'tableSubTitle' => $tableSubTitle,
                                        'tableHeadings' => ['Group', 'Subject', 'Instructor' ,'No. of Days', 'Start-End', 'Room']
                                    ]);

            }else {

                header("Location: /home/logout");

        }
        
    }


    /*
     * createSubjectClass method 
     *
     * @param		
     * @return	 	
     */
    public function createSubjectClass (){
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        echo ("<pre>");
        print_r($_POST);
        if ($sessionData->inSession) {
            /*
                    Array
                        (
                            [0] => stdClass Object
                                (
                                    [id] => 1
                                    [timetable_id] => 6
                                    [subject_id] => 1
                                    [trainee_group_id] => 2
                                    [instructor_id] => 1
                                    [room_id] => 19
                                    [room_type_id] => 1
                                    [meeting_time_id_TBDropped] => 
                                    [preferred_start_period] => 
                                    [preferred_end_period] => 
                                    [preferred_number_days] => 
                                )

                        )
            */

            $subject_id             = $_POST["subject_id"];
            $trainee_group_id       = $_POST["trainee_group_id"];
            $instructor_id          = $_POST["instructor_id"];
            $room_id                = $_POST["room_id"];
            $room_type_id           = $_POST["room_type_id"];
            $preferred_start_period = $_POST["preferred_start_period"];
            $preferred_end_period   = $_POST["preferred_end_period"];
            $preferred_number_days  = $_POST["preferred_number_days"];


            //create digest of the form submission:

            $messageIdent = md5($_POST['year_start'] . $_POST['year_end'] . $_POST['term']);

            $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';

            if($messageIdent!=$sessionMessageIdent){ //if its different:
                //save the session var: 
                $sessionData->messageIdent = $messageIdent;
                // save the data 
                // $db->insert('timetable', 
                //             array(  'year_start' => $year_start,
                //                     'year_end' =>  $year_end,
                //                     'term' => $term,
                //                     'remarks' => $remarks

                //             ));

                unset($_POST);

                // header("Location: /Timetable/TimetableController/addSubjectClass");

                 
                
            
            }else{
                //you've sent this already!
                

                $this->addSubjectClassAction();


            }
                        
        }else {
            header("Location: /home/logout");

        }
    }














    /*
     * ajaxFetchTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function ajaxFetchTraineeGroups(){

        if(!empty($_POST["keyword"])) {
            $db = DB::getInstance();
            $keyword = "'%".$_POST["keyword"]."%'";
          
            $db->query("SELECT * FROM trainee_group WHERE trainee_group.name LIKE {$keyword} ORDER BY trainee_group.name LIMIT 0,10");

            if ($db->count()){
                ?>
                    <ul id="ajaxFetch-list" class="list-unstyled">
                    <?php
                        foreach ($db->getResults() as $result){
                        ?>
                        <li onClick="selectOptionsTraineeGroup('<?php echo $result->name ?>');"><?php echo $result->name; ?></li>
                        <?php } ?>
                    </ul>
                <?php
            }            
        }
    }
    /*
     * ajaxFetchTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function ajaxFetchCourses(){

        if(!empty($_POST["keyword"])) {
            $db = DB::getInstance();
            $keyword = "'%".$_POST["keyword"]."%'";
          
            $db->query("SELECT * FROM subject WHERE subject.name LIKE {$keyword} ORDER BY subject.name LIMIT 0,10");
            //  print_r($db->count());
            if ($db->count()){
                ?>
                    <ul id="ajaxFetch-list" class="list-unstyled">
                    <?php
                        foreach ($db->getResults() as $result){
                        ?>
                        <li onClick="selectOptionsCourse('<?php echo $result->code ?>','<?php echo $result->name ?>');"><?php echo $result->name; ?></li>
                        <?php } ?>
                    </ul>
                <?php
            }            
        }

    }

    /*
     * ajaxFetchInstructors method 
     *
     * @param		
     * @return	 	
     */
    public function ajaxFetchInstructors(){

        if(!empty($_POST["keyword"])) {
            $db = DB::getInstance();
            $keyword = "'%".$_POST["keyword"]."%'";
            $fields = "id, concat(instructor.first_name,' ',instructor.last_name) AS fullName";
            $where = "concat(instructor.first_name,' ',instructor.last_name) ";
            $db->query("SELECT {$fields} FROM instructor WHERE {$where} LIKE {$keyword} ORDER BY instructor.first_name LIMIT 0,10");
             
            if ($db->count()){
                ?>
                    <ul id="ajaxFetch-list" class="list-unstyled">
                    <?php
                        foreach ($db->getResults() as $result){
                        ?>
                        <li onClick="selectOptionsInstructor('<?php echo $result->id ?>','<?php echo $result->fullName ?>');"><?php echo $result->fullName; ?></li>
                        <?php } ?>
                    </ul>
                <?php
            }            
        }

    }
    
    /*
     * ajaxFetchRoomTypes method 
     *
     * @param		
     * @return	 	
     */
    public function ajaxFetchRoomTypes(){

        if(!empty($_POST["keyword"])) {
            $db = DB::getInstance();
            $keyword = "'%".$_POST["keyword"]."%'";
            $db->query("SELECT * FROM room_type WHERE room_type.name LIKE {$keyword} ORDER BY room_type.name LIMIT 0,10");
             
            if ($db->count()){
                ?>
                    <ul id="ajaxFetch-list" class="list-unstyled">
                    <?php
                        foreach ($db->getResults() as $result){
                        ?>
                        
                        <li onClick="selectOptionsRoomType('<?php 
                                    // $roomTypeID = $result->id;
                                    // $db->query("SELECT * FROM room WHERE room.type = {$roomTypeID} ORDER BY room.name LIMIT 0,10");


                                    echo $result->id ?>','<?php echo $result->name; ?>');"><?php echo $result->name.' '.$result->id; ?>
                        </li>





                        <?php 
                        
                        
                        } ?>
                        
                    </ul>
                <?php
            }            
        }

    }
    /*
     * ajaxFetchRoom method 
     *
     * @param		
     * @return	 	
     */
    public function ajaxFetchRooms(){

        if(!empty($_POST["keyword"])) {
            $db = DB::getInstance();
           
            // will take the id pass through the URL 
            // $keyword = "'".$this->route_params['id']."'";
            $keyword = "'".$_POST["keyword"]."'";

            $db->query("SELECT * FROM room WHERE room.type LIKE {$keyword} ORDER BY room.name LIMIT 0,10");
            
            if ($db->count()){
                ?>
                    <ul id="ajaxFetch-list" class="list-unstyled">
                        <li onClick="selectOptionsRoom('', 'Any of this type')">Any of this type</li>
                    <?php 
                        foreach ($db->getResults() as $result){
                        ?>
                        
                        <li onClick="selectOptionsRoom('<?php 
                                    echo $result->id ?>','<?php echo $result->name ?>');"><?php echo $result->name; ?>
                        </li>
                        <?php 
                        } ?>
                        
                    </ul>
                <?php
            }            
        }

    }


        public function testAction(){

        // $data = "here is the data";
        
        // header('Content-Type: application/json');
        // echo json_encode($data);pack
        print_r("\n".'<pre>'."\n");

        print_r($this->route_params);
        print_r("\n".$this->route_params['id']."\n");
 
        // View::renderTemplate('Home/test.twig.html',
        //                     ['params'=> $this->param]);
    }





}

