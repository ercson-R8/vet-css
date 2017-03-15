<?php

namespace App\Controllers\Resource;

use \Core\View;
use App\Controllers\Auth\Session;
use App\Models\DB;
/**
 * Home controller
 *
 * PHP version 5.4
 */
class ResourceController extends \Core\Controller{


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


    public function addTraineeGroupAction(){
        $sessionData = Session::getInstance();
        if ($sessionData->inSession) {
            $db = DB::getInstance();
            $db->query('SELECT * FROM trainee_group');
            $traineeGroupTable = ($db->getResults());
            // $db->query('SELECT * FROM posts');

            $x = 1;
            $db->select(
                array(  'subject_class.id',
                        'trainee_group.name', 
                        'trainee_group.level', 
                        'trainee_group.section', 
                        'subject.name', 
                        'subject.code',
                        'instructor.first_name',
                        'instructor.last_name',
                        'room.name'),
                array('subject_class', 'trainee_group', 'subject', 'instructor', 'room'),
                array(
                    ['subject_class.id', '=', 2], 
                    ['trainee_group.id', '=', '2'],
                    ['subject.id', '=', '3'], 
                    ['instructor.id', '=', '3'],
                    ['room.id', '=', '1']
                    )
                );

            // print_r("<pre>");
            // print_r($db->getResults());
            $timeslots = $db->getResults();
            
            View::renderTemplate ('Resources/addTraineeGroupForm.twig.html', [
                                        'traineeGroupTable' => $traineeGroupTable,
                                        'timeslots' => $timeslots,
                                        'title' => 'Add New Trainee Group',
                                        'tableHeadings' => ['Name', 'Level', 'Section', 'Description']

                                    ]);


        
        }else {

            View::renderTemplate('Auth/login.twig.html');

        }

    }

    public function createNewTraineeGroupAction(){
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        // if ($sessionData->inSession) {

            $traineeGroup = $_POST["traineeGroup"] ? $_POST["traineeGroup"] : null;
            $level = $_POST["level"] ? $_POST["level"] : null;
            $section = $_POST["section"] ? $_POST["section"] : null;
            $description = $_POST["description"];

            $db->select(
                    array('*'),
                    array('trainee_group'),
                    array(
                        ['trainee_group.name',    '=', $_POST['traineeGroup'] ],
                        ['trainee_group.level',    '=', $_POST['level'] ],
                        ['trainee_group.section',    '=', $_POST['section'] ],
                    )
                );

    
            // it alread exist
            if($db->count() > 0){
                
                // retrieve the data from the table
                $db->query('SELECT * FROM trainee_group');
                $traineeGroupTable = ($db->getResults());
                
                // render the page 
                View::renderTemplate ('Resources/addTraineeGroupForm.twig.html', [
                                        'status' => '<div class="alert alert-danger alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <h4 class="text-center">Trainee Group already exist!</h4>
                                                    </div>',
                                        'title' => 'Add New Trainee Group',
                                        'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                        'traineeGroupTable' => $traineeGroupTable
                                    ]);

            }else { // process the data

                //create digest of the form submission:

                $messageIdent = md5($_POST['traineeGroup'] . $_POST['level'] . $_POST['section'] . $_POST['description']);

                //and check it against the stored value: $sessionData->email

                $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';

                if($messageIdent!=$sessionMessageIdent){//if its different:          
                        //save the session var:
                        $sessionData->messageIdent = $messageIdent;
                        
                        // save the data 
                        $db->insert('trainee_group', 
                                    array(  'name' => $traineeGroup,
                                            'level' =>  $level,
                                            'section' => $section,
                                            'remarks' => $description
                                    ));

                        $db->query('SELECT * FROM trainee_group');
                        $traineeGroupTable = ($db->getResults());
                        
                        View::renderTemplate ('Resources/addTraineeGroupForm.twig.html', [
                                                'status' => '<div class="alert alert-success alert-dismissable">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <h4 class="text-center">A new Trainee Group has been added!</h4>
                                                            </div>',
                                                'title' => 'Add New Trainee Group',
                                                'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                                'traineeGroupTable' => $traineeGroupTable
                                            ]);

                } else {
                    //you've sent this already!
                    $db->query('SELECT * FROM trainee_group');
                    $traineeGroupTable = ($db->getResults());
                    View::renderTemplate ('Resources/addTraineeGroupForm.twig.html', [
                                                'status' => '<div class="alert alert-danger alert-dismissable">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <h4 class="text-center">Previous data already save.</h4>
                                                            </div>',
                                                'title' => 'Add New Trainee Group',
                                                'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                                'traineeGroupTable' => $traineeGroupTable
                                            ]);
                    
                }
            }
            
        // }else { // have not logged in yet
        //     View::renderTemplate('Auth/login.twig.html');

        // }

    }
 

    /*
     * addCourse - action will provide the controller mechanism to display a form with the list
     * list of already store course from the database. 
     *
     * @param		none
     * @return      none	 	
     */
    public function addCourseAction (){
        $sessionData = Session::getInstance();
        if ($sessionData->inSession) {
            $db = DB::getInstance();
            $db->query('SELECT * FROM subject');
            $subject = ($db->getResults());
            // $db->query('SELECT * FROM posts');

            
            View::renderTemplate ('Resources/addCourseForm.twig.html', [
                                        'traineeGroupTable' => $subject,
                                        'title' => 'Add New Course',
                                        'tableHeadings' => ['Name', 'Code', 'Req. Period', 'Description']

                                    ]);


        
        }else {

            View::renderTemplate('Auth/login.twig.html');

        }
        
    }


    /*
     * createNewCourse action - providex mechanism to the controller to display a view and a 
     * form to add a new course.  
     *
     * @param		none
     * @return	 	none
     */
    public function createNewCourse (){
      
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        if ($sessionData->inSession) {
            



            $db->query('SELECT * FROM subject');
            $subject = ($db->getResults());
            $name = $_POST["name"];
            $code = $_POST["code"];
            $required_period = $_POST["required_period"];
            $description = $_POST["description"];
            // check first if code already exist
            $db->select(
                    array('*'),
                    array('subject'),
                    array(
                       
                        ['subject.code',    '=', $_POST['code'] ],
                    )
                );
            
             // it alread exist
            if($db->count() > 0){
                // print_r("<pre> count: ".$db->count());
                $db->query('SELECT * FROM subject');
                $subject = ($db->getResults());

                View::renderTemplate ('Resources/addCourseForm.twig.html', [
                                        'status' => '<div class="alert alert-danger alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <h4 class="text-center">Course already exist!</h4>
                                                    </div>',
                                        'title' => 'Add New Course',
                                        'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                        'traineeGroupTable' => $subject
                                    ]);

            }else{
                 //create digest of the form submission:

                $messageIdent = md5($_POST['name'] . $_POST['code'] . $_POST['required_period']);

                //and check it against the stored value: $sessionData->email

                $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';

                if($messageIdent!=$sessionMessageIdent){//if its different:
                    //save the session var:
                    $sessionData->messageIdent = $messageIdent;
                    // save the data 
                    $db->insert('subject', 
                            array(  'name' => $name,
                                    'code' =>  $code,
                                    'required_period' => $required_period,
                                    'description' => $description

                            ));
                    unset($_POST);
                    $db->query('SELECT * FROM subject');
                    $subject = ($db->getResults());

                    View::renderTemplate ('Resources/addCourseForm.twig.html', [
                                            'status' => '<div class="alert alert-success alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">Course save!</h4>
                                                        </div>',
                                            'title' => 'Add New Course',
                                            'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                            'traineeGroupTable' => $subject
                                        ]);
                
                }else{
                    //you've sent this already!
                    $db->query('SELECT * FROM subject');
                    $subject = ($db->getResults());

                    View::renderTemplate ('Resources/addCourseForm.twig.html', [
                                            'status' => '<div class="alert alert-danger alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">Previous data already save.</h4>
                                                        </div>',
                                            'title' => 'Add New Course',
                                            'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                            'traineeGroupTable' => $subject
                                        ]);
                }
                
            }
            

            



            
        }else {
            header("Location: /home/logout");

        }
    }


    /*
     * addInstructor - action will provide the controller mechanism to display a form with the list
     * list of already store course from the database. 
     *
     * @param		none
     * @return      none	 	
     */
    public function addInstructorAction (){
        $sessionData = Session::getInstance();
        if ($sessionData->inSession) {
            $db = DB::getInstance();
            $db->query('SELECT * FROM instructor');
            $instructor = ($db->getResults());
            View::renderTemplate ('Resources/addInstructorForm.twig.html', [
                                        'traineeGroupTable' => $instructor,
                                        'title' => 'Add A New Instructor',
                                        'tableHeadings' => ['First name', 'Last name', 'ID Number' ,'Note']

                                    ]);
        }else {

            header("Location: /home/logout");

        }
        
    }

        /*
     * addCourse - action will provide the controller mechanism to display a form with the list
     * list of already store course from the database. 
     *
     * @param		none
     * @return      none	 	
     */
    public function createNewInstructor(){
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        if ($sessionData->inSession) {
            $db->query('SELECT * FROM instructor');

            $instructor = ($db->getResults());
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $id_number = $_POST["id_number"];
            $note = $_POST["note"];


            // check first if code already exist
            $db->select(
                    array('*'),
                    array('instructor'),
                    array( // WHERE
                        ['instructor.id_number',    '=', $_POST['id_number'] ],
                    )
                );
            
             // it alread exist
            if($db->count() > 0){
                // print_r("<pre> count: ".$db->count());
                $db->query('SELECT * FROM instructor');
                $subject = ($db->getResults());

                View::renderTemplate ('Resources/addInstructorForm.twig.html', [
                                        'status' => '<div class="alert alert-danger alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <h4 class="text-center">Instructor already exist!</h4>
                                                    </div>',
                                        'title' => 'Add New Instructor',
                                        'tableHeadings' => ['Name', 'Level', 'ID Number', 'Note'],
                                        'traineeGroupTable' => $subject
                                    ]);

            }else{
                 //create digest of the form submission:

                $messageIdent = md5($_POST['first_name'] . $_POST['last_name'] . $_POST['id_number'] . $_POST['note']);

                //and check it against the stored value: $sessionData->email

                $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';

                if($messageIdent!=$sessionMessageIdent){//if its different:
                    //save the session var:
                    $sessionData->messageIdent = $messageIdent;
                    // save the data 
                    $db->insert('instructor', 
                            array(  'first_name' => $first_name,
                                    'last_name' =>  $last_name,
                                    'id_number' => $id_number,
                                    'note' => $note

                            ));
                    unset($_POST);
                    $db->query('SELECT * FROM instructor');
                    $instructor = ($db->getResults());

                    View::renderTemplate ('Resources/addInstructorForm.twig.html', [
                                            'status' => '<div class="alert alert-success alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">Instructor save!</h4>
                                                        </div>',
                                            'title' => 'Add New Instructor',
                                            'tableHeadings' => ['Name', 'Level', 'Section', 'Note'],
                                            'traineeGroupTable' => $instructor
                                        ]);
                
                }else{
                    //you've sent this already!
                    $db->query('SELECT * FROM instructor');
                    $instructor = ($db->getResults());

                    View::renderTemplate ('Resources/addInstructorForm.twig.html', [
                                            'status' => '<div class="alert alert-danger alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">Previous data already save.</h4>
                                                        </div>',
                                            'title' => 'Add New Instructor',
                                            'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                            'traineeGroupTable' => $instructor
                                        ]);
                }
                
            }
            

            



            
        }else {
            header("Location: /home/logout");

        }
    }

    

    /*
     * addRoom - action will provide the controller mechanism to display a form with the list
     * list of already store room from the database. 
     *
     * @param		none
     * @return      none	 	
     */
    public function addRoomAction (){
        $sessionData = Session::getInstance();
        if ($sessionData->inSession) {
            $db = DB::getInstance();
            // SELECT room.name, room_type.name as 'category', room.location FROM room, room_type WHERE room.type = room_type.id
            // $db->query('SELECT * FROM room, room_type');
            $db->select(
                    array('room.name', 'room_type.name', 'room.location'),
                    array('room', 'room_type'),
                    array( // WHERE
                        ['room.type',    '=', 'room_type.id' ],
                    )
                );
            $room = ($db->getResults());
            print_r("<pre>");
            print_r($room);
            // View::renderTemplate ('Resources/addRoomForm.twig.html', [
            //                             'traineeGroupTable' => $room,
            //                             'title' => 'Add A New Room',
            //                             'tableHeadings' => ['Name', 'Type', 'Location' ,'Description']
            //                         ]);
        }else {

            header("Location: /home/logout");

        }
        
    }











}

