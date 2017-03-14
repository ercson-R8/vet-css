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

    private $traineeGroupTable = null;


    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        $sessionData = Session::getInstance();

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


    public function addTraineeGroupAction(){
        $sessionData = Session::getInstance();
        if ($sessionData->inSession) {
            $db = DB::getInstance();
            $db->query('SELECT * FROM trainee_group');
            $this->traineeGroupTable = ($db->getResults());
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
                    ['subject_class.id', '=', $x], 
                    ['trainee_group.id', '=', '1'],
                    ['subject.id', '=', $x], 
                    ['instructor.id', '=', '3'],
                    ['room.id', '=', '1']
                    )
                );

            // print_r("<pre>");
            // print_r($db->getResults());
            $timeslots = $db->getResults();
            
            View::renderTemplate ('Resources/addTraineeGroupForm.twig.html', [
                                        'traineeGroupTable' => $this->traineeGroupTable,
                                        'timeslots' => $timeslots,
                                        'tableHeadings' => ['Name', 'Level', 'Section', 'Description']

                                    ]);


        
        }else {

            View::renderTemplate('Auth/login.twig.html');

        }

    }

    public function createNewTraineeGroupAction(){
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        if ($sessionData->inSession) {
            
            $db->query('SELECT * FROM trainee_group');
            $this->traineeGroupTable = ($db->getResults());


                      

            $traineeGroup = $_POST["traineeGroup"] ? $_POST["traineeGroup"] : null;
            $level = $_POST["level"] ? $_POST["level"] : null;
            $section = $_POST["section"] ? $_POST["section"] : null;
            $description = $_POST["description"];

            // save the data 
            $db->insert('trainee_group', 
                        array(  'name' => $traineeGroup,
                                'level' =>  $level,
                                'section' => $section,
                                'remarks' => $description

                        ));





            View::renderTemplate ('Resources/addTraineeGroupForm.twig.html', [
                                    'status' => '<div class="alert alert-success alert-dismissable">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <h4 class="text-center">A new course has been added!</h4>
                                                </div>',
                                    'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                    'traineeGroupTable' => $this->traineeGroupTable
                                ]);



            
        }else {
            View::renderTemplate('Auth/login.twig.html');

        }

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

            // print_r($_POST);
                      

            $name = $_POST["name"];
            $code = $_POST["code"];
            $required_period = $_POST["required_period"];
            $description = $_POST["description"];
            // check first if code already exist
            /*
             code here... 
            */
            // save the data 
            $db->insert('subject', 
                        array(  'name' => $name,
                                'code' =>  $code,
                                'required_period' => $required_period,
                                'description' => $description

                        ));

            unset($_POST);



            View::renderTemplate ('Resources/addCourseForm.twig.html', [
                                    'status' => '<div class="alert alert-success alert-dismissable">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <h4 class="text-center">A new course has been added!</h4>
                                                </div>',
                                    'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                    'traineeGroupTable' => $subject
                                ]);



            
        }else {
            View::renderTemplate('Auth/login.twig.html');

        }
    }

}
/*
//create digest of the form submission:

    $messageIdent = md5($_POST['name'] . $_POST['email'] . $_POST['phone'] . $_POST['comment']);

//and check it against the stored value:

    $sessionMessageIdent = isset($_SESSION['messageIdent'])?$_SESSION['messageIdent']:'';

    if($messageIdent!=$sessionMessageIdent){//if its different:          
        //save the session var:
            $_SESSION['messageIdent'] = $messageIdent;
        //and...
            do_your_thang();
    } else {
        //you've sent this already!
    }

*/