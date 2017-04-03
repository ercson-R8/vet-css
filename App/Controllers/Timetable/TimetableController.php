<?php

namespace App\Controllers\Timetable;

use \Core\View;
use App\Controllers\Auth\Session;
use App\Controllers;
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
    protected function before(){
        $sessionData = Session::getInstance();
        if (!$sessionData->inSession){
            header("Location: /home/logout");
            exit;
        }
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after(){
        // 
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
            exit;

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

                // reset the previous current timetable from 1 to 0
                $db = DB::getInstance();

                $db->query('UPDATE timetable SET timetable.current = 0  WHERE timetable.current = 1');

                $timetable = ($db->getResults());

                // save the data and this timetable to be the current  (1)
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
                exit;                
            
            }else{
                //you've sent this already!
                
                
                header("Location: /Timetable/TimetableController/addSubjectClass");
                exit;

            }
                        
        }else {
            header("Location: /home/logout");
            exit;

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
                    array(  'subject_class.id',
                            'trainee_group.name as \'trainee_group\'', 
                            'subject.name as \'subject\'',
                            'subject.code as \'code\'',
                            'subject.required_period as \'required_period\'',
                            'concat (instructor.first_name,\' \', instructor.last_name) as \'instructor\'', 
                            'room_type.name as \'room_type\'',
                            'room.name as \'room\'',
                            'subject_class.preferred_number_days as \'days\'', 
                            'subject_class.preferred_start_period as \'start\'', 
                            'subject_class.preferred_end_period as \'end\''
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
                                    ON subject_class.room_id = room.id' 
                    ),
                    array(
                        ['subject_class.timetable_id', '=', $sessionData->currentTimetable]
                    )
                );
            $subject_class = ($db->getResults());
            
            $x = $db->count();

            $db->select(
                array('*'),
                array('timetable'),
                array(['timetable.id', '=', $sessionData->currentTimetable])
            );
          
            $timetable = ($db->getResults());
            $tableTitle = 'List of classes for AY '.$timetable[0]->year_start.'-'.$timetable[0]->year_end.' Term '.$timetable[0]->term;
            $tableSubTitle = '('.$timetable[0]->remarks.') '.$timetable[0]->created;
            
            // print_r($subject_class);

            // print_r($timetable);
            View::renderTemplate ('Timetables/addSubjectClassForm.twig.html', [
                                        'subjectClass' => $subject_class,
                                        'title' => 'Add a Class '.$sessionData->currentTimetable, 
                                        'firstName' => $sessionData->firstName,
                                        'tableTitle' => $tableTitle,
                                        'tableSubTitle' => $tableSubTitle,
                                        'tableHeadings' => ['Group', 'Subject - Instructor' , 'Room' ,'No. of Days', 'Start - End']
                                    ]);

            }else {

                header("Location: /home/logout");
                exit;

        }
        
    }


    /*
     * createSubjectClass method 
     *
     * @param		
     * @return	 	
     */
    public function createNewSubjectClass (){
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        // echo ("<pre>");
        // print_r($_POST);
        if ($sessionData->inSession) {

            

            $subject_id             = $_POST["subject_id"];
            $trainee_group_id       = $_POST["trainee_group_id"];
            $instructor_id          = $_POST["instructor_id"];
            $room_type_id           = $_POST["room_type_id"] ;  
            $preferred_start_period = $_POST["preferred_start_period"];
            $preferred_end_period   = $_POST["preferred_end_period"];
            $preferred_number_days  = $_POST["preferred_number_days"];

            if ($_POST["room_id"]) { // room_id is specified

                $room_id = $_POST["room_id"];
                $room_id_final = $room_id;
                $room_fixed = 1;
            
            }else{ // any room can chosen later on. 
            
                $room_fixed = null;
            
                $room_id = 25; // this is free room, will be changed later based on room_type_id
            
            }

            //create digest of the form submission:

            $messageIdent = md5($_POST['subject_id']            . $_POST['trainee_group_id']    . $_POST['instructor_id'] . 
                                $_POST['room_id']               . $_POST['room_type_id']        . $_POST['preferred_start_period']. 
                                $_POST['preferred_end_period']  . $_POST['preferred_number_days']
                                );

            $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';

            if($messageIdent!=$sessionMessageIdent){ //if its different:
                //save the session var: 
                $sessionData->messageIdent = $messageIdent;
                // save the data 
                $db->insert('subject_class', 
                            array(  'timetable_id'          => $sessionData->currentTimetable,
                                    'subject_id'            => $subject_id,
                                    'instructor_id'         => $instructor_id,
                                    'trainee_group_id'      => $trainee_group_id,
                                    'room_id'               => $room_id,
                                    'room_fixed'            => $room_fixed,
                                    'room_type_id'          => $room_type_id ,
                                    'preferred_start_period'=> $preferred_start_period ,
                                    'preferred_end_period'  => $preferred_end_period ,
                                    'preferred_number_days' => $preferred_number_days
                            ));

                unset($_POST);

                header("Location: /Timetable/TimetableController/addSubjectClass");
                exit;

                 
                
            
            }else{
                //you've sent this already!
                
                header("Location: /Timetable/TimetableController/addSubjectClass");
                exit;


            }
                        
        }else {
            header("Location: /home/logout");
            exit;

        }
    }


    /*
     * editSubjectClass method 
     *
     * @param		
     * @return	 	
     */
    public function editSubjectClass (){
        
        $sessionData = Session::getInstance();
        // echo "<pre>parameter is : ";
        // print_r($this->route_params['id']);
        // exit;
        $sessionData->editID = $this->route_params['id'];
        
        header("Location: /Timetable/TimetableController/redirectEditSubjectClass");
        exit;
    }


    /*
     * redirectEditTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function redirectEditSubjectClass (){
        $db = DB::getInstance();
        $sessionData = Session::getInstance();
   

        $db->select(
                array(  'subject_class.id',
                        'subject_class.trainee_group_id',
                        'subject_class.instructor_id',
                        'subject_class.subject_id',
                        'subject_class.room_type_id',
                        'subject_class.room_id',
                        'trainee_group.name as \'trainee_group\'', 
                        'subject.name as \'subject\'',
                        'subject.code as \'code\'',
                        'subject.required_period as \'required_period\'',
                        'concat (instructor.first_name,\' \', instructor.last_name) as \'instructor\'',
                        'subject_class.instructor_id', 
                        'room_type.name as \'room_type\'',
                        

                        'room.name as \'room\'',
                        
                        'subject_class.preferred_number_days as \'days\'', 
                        'subject_class.preferred_start_period as \'start\'', 
                        'subject_class.preferred_end_period as \'end\''
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
                                ON subject_class.room_id = room.id' 
                ),
                array(
                    ['subject_class.id', '=', $sessionData->editID]
                )
            );
        $subject_class = ($db->getResults());

        $oldEntry = [   "id"                => $subject_class[0]->id,
                        "trainee_group_id"  => $subject_class[0]->trainee_group_id,
                        "subject_id"        => $subject_class[0]->subject_id,
                        "instructor_id"     => $subject_class[0]->instructor_id,
                        "room_type_id"      => $subject_class[0]->room_type_id,
                        "room_id"           => $subject_class[0]->room_id,
                        "trainee_group"     => $subject_class[0]->trainee_group,
                        "subject"           => $subject_class[0]->subject,
                        "code"              => $subject_class[0]->code,
                        "required_period"   => $subject_class[0]->required_period,
                        "instructor"        => $subject_class[0]->instructor,
                        "room_type"         => $subject_class[0]->room_type,
                        "room"              => $subject_class[0]->room,
                        "days"              => $subject_class[0]->days,
                        "start"             => $subject_class[0]->start,
                        "end"               => $subject_class[0]->end
                    ];

        $db->select(
            array('*'),
            array('timetable'),
            array(['timetable.id', '=', $sessionData->currentTimetable])
        );
        
        $timetable = ($db->getResults());
        $tableTitle = 'List of classes for AY '.$timetable[0]->year_start.'-'.$timetable[0]->year_end.' Term '.$timetable[0]->term;
        $tableSubTitle = '('.$timetable[0]->remarks.') '.$timetable[0]->created;

        View::renderTemplate ('Timetables/editSubjectClassForm.twig.html', [
                                    'subjectClass' => $subject_class,
                                    'title' => 'Update A Subject Class ', 
                                    'firstName' => $sessionData->firstName,
                                    'tableTitle' => $tableTitle,
                                    'tableSubTitle' => $tableSubTitle,
                                    'oldEntry'      => $oldEntry,
                                    'tableHeadings' => ['Group', 'Subject - Instructor' , 'Room' ,'No. of Days', 'Start - End']
                                ]);

    }

    /*
     * updateSubjectClass method 
     *
     * @param		
     * @return	 	
     */
    public function updateSubjectClass (){

        $sessionData = Session::getInstance();
        $db = DB::getInstance();


        $id                     = $_POST["subject_class_id"];
        $subject_id             = $_POST["subject_id"];
        $trainee_group_id       = $_POST["trainee_group_id"];
        $instructor_id          = $_POST["instructor_id"];
        $room_type_id           = $_POST["room_type_id"] ;  
        $preferred_start_period = $_POST["preferred_start_period"];
        $preferred_end_period   = $_POST["preferred_end_period"];
        $preferred_number_days  = $_POST["preferred_number_days"];
        if ($_POST["room_id"]) { // room_id is specified

                $room_id = $_POST["room_id"];
                $room_id_final = $room_id;
                $room_fixed = 1;
            
            }else{ // any room can chosen later on. 
            
                $room_fixed = null;
            
                $room_id = 25; // this is free room, will be changed later based on room_type_id
            
            }



        //create digest of the form submission:

        $messageIdent = md5($_POST['subject_id']            . $_POST['trainee_group_id']    . $_POST['instructor_id'] . 
                            $_POST['room_id']               . $_POST['room_type_id']        . $_POST['preferred_start_period']. 
                            $_POST['preferred_end_period']  . $_POST['preferred_number_days']
                            );
        
        //and check it against the stored value: $sessionData->email

        $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';
        if($messageIdent!=$sessionMessageIdent){//if it's different:          
                //save the session var:
                $sessionData->messageIdent = $messageIdent;
                
                // save the data

                $db->update ('subject_class', 
                                array(  ['subject_id' ,             '=', $subject_id],
                                        ['instructor_id' ,          '=', $instructor_id],
                                        ['trainee_group_id' ,       '=', $trainee_group_id],
                                        ['room_id' ,                '=', $room_id],
                                        ['room_fixed' ,             '=', $room_fixed],
                                        ['room_type_id' ,           '=', $room_type_id],
                                        ['preferred_start_period' , '=', $preferred_start_period],
                                        ['preferred_end_period' ,   '=', $preferred_end_period],
                                        ['preferred_number_days' ,  '=', $preferred_number_days],

                                    ),
                                array(['id','=', $id])
                );
                $db->select(
                    array(  'subject_class.id',
                            'subject_class.trainee_group_id',
                            'subject_class.instructor_id',
                            'subject_class.subject_id',
                            'subject_class.room_type_id',
                            'subject_class.room_id',
                            'trainee_group.name as \'trainee_group\'', 
                            'subject.name as \'subject\'',
                            'subject.code as \'code\'',
                            'subject.required_period as \'required_period\'',
                            'concat (instructor.first_name,\' \', instructor.last_name) as \'instructor\'',
                            'subject_class.instructor_id', 
                            'room_type.name as \'room_type\'',
                            'room.name as \'room\'',
                            
                            'subject_class.preferred_number_days as \'days\'', 
                            'subject_class.preferred_start_period as \'start\'', 
                            'subject_class.preferred_end_period as \'end\''
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
                                    ON subject_class.room_id = room.id' 
                    ),
                    array(
                        ['subject_class.id', '=', $sessionData->editID]
                    )
                );


                $subject_class = ($db->getResults());
                $oldEntry = [   "id"                => $subject_class[0]->id,
                                "trainee_group_id"  => $subject_class[0]->trainee_group_id,
                                "subject_id"        => $subject_class[0]->subject_id,
                                "room_type_id"      => $subject_class[0]->room_type_id,
                                "room_id"           => $subject_class[0]->room_id,
                                "trainee_group"     => $subject_class[0]->trainee_group,
                                "subject"           => $subject_class[0]->subject,
                                "code"              => $subject_class[0]->code,
                                "required_period"   => $subject_class[0]->required_period,
                                "instructor"        => $subject_class[0]->instructor,
                                "room_type"         => $subject_class[0]->room_type,
                                "room"              => $subject_class[0]->room,
                                "days"              => $subject_class[0]->days,
                                "start"             => $subject_class[0]->start,
                                "end"               => $subject_class[0]->end
                            ];

                $db->select(
                    array('*'),
                    array('timetable'),
                    array(['timetable.id', '=', $sessionData->currentTimetable])
                );
                
                $timetable = ($db->getResults());
                $tableTitle = 'List of classes for AY '.$timetable[0]->year_start.'-'.$timetable[0]->year_end.' Term '.$timetable[0]->term;
                $tableSubTitle = '('.$timetable[0]->remarks.') '.$timetable[0]->created;

                View::renderTemplate ('Timetables/editSubjectClassForm.twig.html', [
                                            'subjectClass' => $subject_class,
                                            'title' => 'Update A Subject Class ', 
                                            'firstName' => $sessionData->firstName,
                                            'tableTitle' => $tableTitle,
                                            'tableSubTitle' => $tableSubTitle,
                                            'oldEntry'      => $oldEntry,
                                            'tableHeadings' => ['Group', 'Subject - Instructor' , 'Room' ,'No. of Days', 'Start - End']
                                        ]);

                

        } else {
            //you've sent this already!
            $db->select(
                array(  'subject_class.id',
                        'subject_class.trainee_group_id',
                        'subject_class.instructor_id',
                        'subject_class.subject_id',
                        'subject_class.room_type_id',
                        'subject_class.room_id',
                        'trainee_group.name as \'trainee_group\'', 
                        'subject.name as \'subject\'',
                        'subject.code as \'code\'',
                        'subject.required_period as \'required_period\'',
                        'concat (instructor.first_name,\' \', instructor.last_name) as \'instructor\'',
                        'subject_class.instructor_id', 
                        'room_type.name as \'room_type\'',
                        

                        'room.name as \'room\'',
                        
                        'subject_class.preferred_number_days as \'days\'', 
                        'subject_class.preferred_start_period as \'start\'', 
                        'subject_class.preferred_end_period as \'end\''
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
                                ON subject_class.room_id = room.id' 
                ),
                array(
                    ['subject_class.id', '=', $sessionData->editID]
                )
            );


            $subject_class = ($db->getResults());
            $oldEntry = [   "id"                => $subject_class[0]->id,
                            "trainee_group_id"  => $subject_class[0]->trainee_group_id,
                            "subject_id"        => $subject_class[0]->subject_id,
                            "instructor_id"     => $subject_class[0]->instructor_id,
                            "room_type_id"      => $subject_class[0]->room_type_id,
                            "room_id"           => $subject_class[0]->room_id,
                            "trainee_group"     => $subject_class[0]->trainee_group,
                            "subject"           => $subject_class[0]->subject,
                            "code"              => $subject_class[0]->code,
                            "required_period"   => $subject_class[0]->required_period,
                            "instructor"        => $subject_class[0]->instructor,
                            "room_type"         => $subject_class[0]->room_type,
                            "room"              => $subject_class[0]->room,
                            "days"              => $subject_class[0]->days,
                            "start"             => $subject_class[0]->start,
                            "end"               => $subject_class[0]->end
                        ];

            $db->select(
                array('*'),
                array('timetable'),
                array(['timetable.id', '=', $sessionData->currentTimetable])
            );
            
            $timetable = ($db->getResults());
            $tableTitle = 'List of classes for AY '.$timetable[0]->year_start.'-'.$timetable[0]->year_end.' Term '.$timetable[0]->term;
            $tableSubTitle = '('.$timetable[0]->remarks.') '.$timetable[0]->created;

            View::renderTemplate ('Timetables/editSubjectClassForm.twig.html', [
                                        'status' => '<div class="alert alert-danger alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">Subject Class has already been updated!</h4>
                                                        </div>',
                                        'subjectClass' => $subject_class,
                                        'title' => 'Update A Subject Class ', 
                                        'firstName' => $sessionData->firstName,
                                        'tableTitle' => $tableTitle,
                                        'tableSubTitle' => $tableSubTitle,
                                        'oldEntry'      => $oldEntry,
                                        'tableHeadings' => ['Group', 'Subject - Instructor' , 'Room' ,'No. of Days', 'Start - End']
                                    ]);



            
        }

        

    }





    /*
     * manageTimetable method 
     *
     * @param		
     * @return	 	
     */
    public function setCurrentTimetable (){
        $sessionData = Session::getInstance();
        $db = DB::getInstance();

        $sessionData->currentTimetable = $this->route_params["id"];
        $db->query('UPDATE timetable SET timetable.current = 0  WHERE timetable.current = 1');
        $qry = 'UPDATE timetable SET timetable.current = 1  WHERE timetable.id = '.$sessionData->currentTimetable ;
        $db->query($qry);


        header("Location: /home/index");
        exit;
    }


    /*
     * editCurrentTimetable method 
     *
     * @param		
     * @return	 	
     */
    public function editCurrentTimetable (){
        $sessionData = Session::getInstance();
        $db = DB::getInstance();

        $sessionData->currentTimetable = $this->route_params["id"];
        $db->query('UPDATE timetable SET timetable.current = 0  WHERE timetable.current = 1');
        $qry = 'UPDATE timetable SET timetable.current = 1  WHERE timetable.id = '.$sessionData->currentTimetable ;
        $db->query($qry);
        header("Location: /Timetable/TimetableController/addSubjectClass");
        exit;
    }



    /*
     * deleteCurrentTimetable method 
     *
     * @param		
     * @return	 	
     */
    public function deleteCurrentTimetable (){
        $sessionData = Session::getInstance();
        $db = DB::getInstance();

        $sessionData->currentTimetable = $this->route_params["id"];
        //$db->query('UPDATE timetable SET timetable.current = 0  WHERE timetable.current = 1');
        //$qry = 'UPDATE timetable SET timetable.current = 1  WHERE timetable.id = '.$sessionData->currentTimetable ;
        $db->query($qry);
        header("Location: /Timetable/TimetableController/addSubjectClass");
        exit;
        
    }


    /*
     * generateNewTimetable method 
     *
     * @param		
     * @return	 	
     */
    public function generateNewTimetable (){
        $sessionData = Session::getInstance();
        $db = DB::getInstance();

        // echo "generateNewTimetable<pre>";

        $buttonClicked = (key($_POST));


        

        // insert the newData to the meeting TABLE 
        if ($sessionData->inSession) {
            // view timetable button was clicked
            if ($buttonClicked === 'view'){

                header("Location: /home");
                exit;

            
            }else { // generate new timetable button was clicked

                // check if this timetable does not have a generated timetable yet
                // this is done by querying the meeting table if the currenttimetable ID exist;
                
                $db->query("SELECT * FROM meeting WHERE meeting.timetable_id = {$sessionData->currentTimetable}");
                $meeting = $db->getResults();

                /*
                    if generated timetable already exist; 
                    copy record of timetable with the current timetableID 
                    and create a new entry in the timetable database table;
                    append timestamp in the description;

                    copy records in subject_class table; 
                    and create duplicates of those record;

                    else updated

                */
                if ($db->count()){ // generated timetable already exist
                    
                    // copy the timetable record
                    $db->query("SELECT * FROM timetable WHERE timetable.id = {$sessionData->currentTimetable}");
                    $currentTimetable = $db->getResults();
                    
                    // copy the subject_class record/s
                    $db->query("SELECT * FROM subject_class WHERE timetable_id = {$sessionData->currentTimetable}");
                    $currentSubjectClass = $db->getResults();
                    /*
                            currentTimetable stdClass Object
                                (
                                    [id] => 1
                                    [year_start] => 2020
                                    [year_end] => 2021
                                    [term] => 1
                                    [remarks] => test
                                    [created] => 2017-03-30 15:02:39
                                    [current] => 1
                                )
                                currentSubjectClass stdClass Object
                                (
                                    [id] => 1
                                    [timetable_id] => 1
                                    [subject_id] => 18
                                    [trainee_group_id] => 31
                                    [instructor_id] => 20
                                    [room_id] => 25
                                    [room_type_id] => 7
                                    [room_id_final] => 
                                    [room_fixed] => 
                                    [preferred_start_period] => 1
                                    [preferred_end_period] => 4
                                    [preferred_number_days] => 4
                                )
                                currentSubjectClass stdClass Object
                                (
                                    [id] => 3
                                    [timetable_id] => 1
                                    [subject_id] => 2
                                    [trainee_group_id] => 4

                                    [instructor_id] => 51
                                    [room_id] => 25
                                    [room_type_id] => 1
                                    [room_id_final] => 
                                    [room_fixed] =>

                                    [preferred_start_period] => 1
                                    [preferred_end_period] => 8
                                    [preferred_number_days] => 3
                                )


                    */

                    // unset the current timetable, set field current to 0;
                    $db->query('UPDATE timetable SET timetable.current = 0  WHERE timetable.current = 1');
                    
                    // copy the original row, making a duplicate data except for the ID and
                    // the remarks which will be updated on the succeeding lines. This will loop once only. 
                    foreach ( $currentTimetable as $result){
                        $db->insert('timetable', 
                                    array(  'year_start'    => $result->year_start,
                                            'year_end'      =>  $result->year_end,
                                            'term'          => $result->term,
                                            'remarks'       => $result->remarks,
                                            'current'       => 1
                                    ));

                    }
                    $lastInsertId = $db->getlastInsertId();
                    $sessionData->currentTimetable = $lastInsertId;

                    // copy the original row, making a duplicate data for each record
                    foreach ( $currentSubjectClass as $result){
                        $db->insert('subject_class', 
                                    array(  'timetable_id'          => $sessionData->currentTimetable,
                                            'subject_id'            => $result->subject_id,
                                            'trainee_group_id'      => $result->trainee_group_id,

                                            'instructor_id'         => $result->instructor_id,
                                            'room_id'               => $result->room_id,
                                            'room_type_id'          => $result->room_type_id,
                                            'room_id_final'         => $result->room_id_final,
                                            'room_fixed'            => $result->room_fixed,

                                            'preferred_start_period'=> $result->preferred_start_period,
                                            'preferred_end_period'  => $result->preferred_end_period,
                                            'preferred_number_days' => $result->preferred_number_days
                                    ));
                    }

                    // process the data and generate a new timetable; 
                    $t = new Timetable();
                    $result = $t->GeneticAlgorithm();
                    $timetable = $result['timetable'];

                    // render another view without the loading GIF
                    // and display some GA statistics
                    $fitnessValue = $result['fitnessValue'];

                    // fetch timetable_id, subject_class_id, time_slot etc. 
                    $newData = [];

                    // timetable_id	subject_class_id	trainee_group_id	subject_id	instructor_id	time_slot	room_id	timestamp
                    for($i=0; $i < sizeof($timetable); $i++){
                        $newData[] = [  'timetable_id'      =>$timetable[$i]["sc"]['timetable_id'], 
                                        'subject_class_id'  =>$timetable[$i]["sc"]["id"],
                                        'trainee_group_id'  =>$timetable[$i]["sc"]['trainee_group_id'],
                                        'subject_id'        =>$timetable[$i]["sc"]['subject_id'],
                                        'instructor_id'     =>$timetable[$i]["sc"]['instructor_id'],
                                        'room_id'           =>$timetable[$i]["sc"]["room_id"], 
                                        'time_slot'         =>$timetable[$i]["ts"] 
                                        ]; 
                    }

                    foreach ($newData as $key => $value) {
                        $db->insert('meeting', 
                                    array(  'timetable_id'      =>  $value['timetable_id'],
                                            'subject_class_id'  =>  $value['subject_class_id'],
                                            'trainee_group_id'  =>  $value['trainee_group_id'],
                                            'subject_id'        =>  $value['subject_id'],
                                            'instructor_id'     =>  $value['instructor_id'],
                                            'room_id'           =>  $value["room_id"], 
                                            'time_slot'         =>  $value["time_slot"]
                        ));
                    }

                    // add the fitness value / number of conflicts for the currently gerenrated table;
                    $db->query('UPDATE  timetable 
                                SET     timetable.remarks = concat(\'('.$fitnessValue.') CONFLICT/S @ \')  
                                WHERE   timetable.current = 1');
                }

                // this is a NEW timetable and no table has been generated yet
                else{ 
                    // process the data and generate a new timetable; 
                    $t = new Timetable();
                    $result = $t->GeneticAlgorithm();
                    $timetable = $result['timetable'];

                    // render another view without the loading GIF
                    // and display some GA statistics
                    $fitnessValue = $result['fitnessValue'];

                    // fetch timetable_id, subject_class_id, time_slot etc. 
                    $newData = [];

                    // timetable_id	subject_class_id	trainee_group_id	subject_id	instructor_id	time_slot	room_id	timestamp
                    for($i=0; $i < sizeof($timetable); $i++){
                        $newData[] = [  'timetable_id'      =>$timetable[$i]["sc"]['timetable_id'], 
                                        'subject_class_id'  =>$timetable[$i]["sc"]["id"],
                                        'trainee_group_id'  =>$timetable[$i]["sc"]['trainee_group_id'],
                                        'subject_id'        =>$timetable[$i]["sc"]['subject_id'],
                                        'instructor_id'     =>$timetable[$i]["sc"]['instructor_id'],
                                        'room_id'           =>$timetable[$i]["sc"]["room_id"], 
                                        'time_slot'         =>$timetable[$i]["ts"] 
                                        ]; 
                    }

                    foreach ($newData as $key => $value) {
                        $db->insert('meeting', 
                                    array(  'timetable_id'      =>  $value['timetable_id'],
                                            'subject_class_id'  =>  $value['subject_class_id'],
                                            'trainee_group_id'  =>  $value['trainee_group_id'],
                                            'subject_id'        =>  $value['subject_id'],
                                            'instructor_id'     =>  $value['instructor_id'],
                                            'room_id'           =>  $value["room_id"], 
                                            'time_slot'         =>  $value["time_slot"]
                        ));
                    }

                    // add the fitness value / number of conflicts for the currently gerenrated table;
                    $db->query('UPDATE  timetable 
                                SET     timetable.remarks = concat(remarks,\' This table has '.$fitnessValue.' CONFLICT(S).\')  
                                WHERE   timetable.current = 1');
                }

                header("Location: /home");
                exit;
            }
     
                        
        }else {
            header("Location: /home/logout");
            exit;

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
                        <li onClick="selectOptionsTraineeGroup('<?php echo $result->id ?>','<?php echo $result->name ?>');"><?php echo $result->name; ?></li>
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

            $fields = "id, concat(subject.code, '-',subject.name,' (',subject.required_period,')') AS 'fullSubjectName'";
            
            $where = "concat(subject.code, ' ',subject.name)";
            $db->query("SELECT {$fields} FROM subject WHERE {$where} LIKE {$keyword} ORDER BY subject.name LIMIT 0,10");

            // $db->query("SELECT * FROM subject WHERE subject.name LIKE {$keyword} ORDER BY subject.name LIMIT 0,10");
            //  print_r($db->count());
            if ($db->count()){
                ?>
                    <ul id="ajaxFetch-list" class="list-unstyled">
                    <?php
                        foreach ($db->getResults() as $result){
                        ?>
                        <li onClick="selectOptionsCourse('<?php echo $result->id ?>','<?php echo $result->fullSubjectName ?>');"><?php echo $result->fullSubjectName; ?></li>
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

                                    echo $result->id ?>','<?php echo $result->name; ?>');"><?php echo $result->name; ?>
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
                        <li onClick="selectOptionsRoom('<?php null; ?>', 'Any of this type')">Any of this type</li>
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

/*






*/