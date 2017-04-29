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

    }


    public function addTraineeGroupAction(){
        $sessionData = Session::getInstance();
        if ($sessionData->inSession) {
            $db = DB::getInstance();
            $db->query('SELECT * FROM trainee_group');
            $traineeGroupTable = ($db->getResults());
            // $db->query('SELECT * FROM posts');

            
            $db->query("SELECT * FROM trainee_group ");
            // print_r("<pre>");
            // print_r($db->getResults());
            $trainee_group = $db->getResults();
            
            View::renderTemplate ('Resources/addTraineeGroupForm.twig.html', [
                                        'traineeGroupTable' => $traineeGroupTable,
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'trainee_group' => $trainee_group,
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
            // echo "<pre>";
            // print_r($_POST);
            // exit;

            /*
                Array
                    (
                        [traineeGroup] => ELC
                        [level] => 9
                        [section] => C
                        [description] => test
                        [submit] => 
                    )

            */
        $traineeGroup = $_POST["traineeGroup"] ? $_POST["traineeGroup"] : null;
        $level = $_POST["level"] ? $_POST["level"] : null;
        $section = $_POST["section"] ? $_POST["section"] : null;
        $description = $_POST["description"];

        $db->select(
                array('*'),
                array('trainee_group'),
                array(
                    ['trainee_group.name',    '=', $_POST['traineeGroup'].'-'.$_POST['level']. $_POST['section'] ],
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
                                    'firstName' => $sessionData->firstName,
                                    'accessRight'   => $sessionData->rights,
                                    'title' => 'Add New Trainee Group',
                                    'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                    'traineeGroupTable' => $traineeGroupTable
                                ]);

        }else { // process the data

            //create digest of the form submission:

            $messageIdent = md5($_POST['traineeGroup'] . $_POST['level'] . $_POST['section'] . $_POST['description']);

            //and check it against the stored value: $sessionData->email

            $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';

            if($messageIdent!=$sessionMessageIdent){//if it's different:          
                    //save the session var:
                    $sessionData->messageIdent = $messageIdent;
                    
                    // save the data 
                    $db->insert('trainee_group', 
                                array(  'name' => $traineeGroup.'-'.$level.$section,
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
                                            'firstName' => $sessionData->firstName,
                                            'accessRight'   => $sessionData->rights,
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
                                            'firstName' => $sessionData->firstName,
                                            'accessRight'   => $sessionData->rights,
                                            'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                            'traineeGroupTable' => $traineeGroupTable
                                        ]);
                
            }
        }

    }
 
    /*
     * editTraineeGroup method display form to edit detail
     *
     * @param		
     * @return	 	
     */
    public function editTraineeGroup (){
        $sessionData = Session::getInstance();
        // echo "<pre>parameter is : ";
        // print_r($this->route_params['id']);
        $sessionData->editID = $this->route_params['id'];
        
        header("Location: /Resource/ResourceController/redirectEditTraineeGroup");
        exit;

        
    }

    /*
     * redirectEditTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function redirectEditTraineeGroup (){
        $db = DB::getInstance();
        $sessionData = Session::getInstance();

        $db->query('SELECT * FROM trainee_group WHERE trainee_group.id = '.$sessionData->editID);
        
        $trainee_group = ($db->getResults());
        
        $traineeGroupName = explode('-', $trainee_group[0]->name)[0];
        
        $oldEntry = [   "group" => $traineeGroupName,
                        "id" => $trainee_group[0]->id,
                        "name" => $trainee_group[0]->name,
                        "section" => $trainee_group[0]->section,
                        "level" => $trainee_group[0]->level,
                        "remarks" => $trainee_group[0]->remarks
                     ];


        View::renderTemplate ('Resources/editTraineeGroupForm.twig.html', [
                                    'firstName'     => $sessionData->firstName,
                                    'trainee_group' => $trainee_group,
                                    'accessRight'   => $sessionData->rights,
                                    'oldEntry'      => $oldEntry,
                                    'title'         => 'Edit Trainee Group',
                                    'tableHeadings' => ['Name', 'Level', 'Section', 'Description']

                                ]);

    }

    /*
     * updateTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function updateTraineeGroup (){
        // echo "<pre>";
        // print_r($_POST);

        // exit;
        $sessionData = Session::getInstance();
        $db = DB::getInstance();

        $traineeGroup   = $_POST["traineeGroup"] ;
        $level          = $_POST["level"] ;
        $section        = $_POST["section"] ;
        $description    = $_POST["description"];
        $id             = $_POST["TraineeGroup_id"];
        /*
            Array
                (
                    [traineeGroup] => BUS
                    [level] => 2
                    [section] => A
                    [TraineeGroup_id] => 4
                    [description] => Term 2 Sales & Marketing Trainees
                    [submit] => 
                )

        */
        
        //create digest of the form submission:

        $messageIdent = md5($_POST['traineeGroup'] . $_POST['level'] . $_POST['section'] . $_POST['description']);
        
        //and check it against the stored value: $sessionData->email

        $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';
        if($messageIdent!=$sessionMessageIdent){//if it's different:          
                //save the session var:
                $sessionData->messageIdent = $messageIdent;
                
                // save the data

                $db->update ('trainee_group', 
                                array(  ['name' ,   '=', $traineeGroup.'-'.$level.$section],
                                        ['level',   '=', $level],
                                        ['section', '=', $section],
                                        ['remarks', '=', $description]
                                    ),
                                array(['id','=', $id])
                );


                $db->query('SELECT * FROM trainee_group WHERE trainee_group.id = '.$sessionData->editID);
                $trainee_group = ($db->getResults());
                $traineeGroupName = explode('-', $traineeGroup.'-'.$level.$section)[0];
                $oldEntry = [   "group"     => $traineeGroupName ,
                                "id"        => $trainee_group[0]->id,
                                "name"      => $trainee_group[0]->name,
                                "section"   => $trainee_group[0]->section,
                                "level"     => $trainee_group[0]->level,
                                "remarks"   => $trainee_group[0]->remarks
                            ];
                View::renderTemplate ('Resources/editTraineeGroupForm.twig.html', [
                                    'status' => '<div class="alert alert-success alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">Trainee Group has been updated!</h4>
                                                        </div>',
                                    'firstName'     => $sessionData->firstName,
                                    'trainee_group' => $trainee_group,
                                    'accessRight'   => $sessionData->rights,
                                    'oldEntry'      => $oldEntry,
                                    'title'         => 'Edit Trainee Group',
                                    'tableHeadings' => ['Name', 'Level', 'Section', 'Description']

                                ]);
                

        } else {
            //you've sent this already!

            $db->query('SELECT * FROM trainee_group WHERE trainee_group.id = '.$sessionData->editID);
            $trainee_group = ($db->getResults());
            $traineeGroupName = explode('-', $traineeGroup.'-'.$level.$section)[0];
            $oldEntry = [   "group"     => $traineeGroupName ,
                            "id"        => $trainee_group[0]->id,
                            "name"      => $trainee_group[0]->name,
                            "section"   => $trainee_group[0]->section,
                            "level"     => $trainee_group[0]->level,
                            "remarks"   => $trainee_group[0]->remarks
                        ];
            View::renderTemplate ('Resources/editTraineeGroupForm.twig.html', [
                                    'status' => '<div class="alert alert-danger alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">Trainee Group has already been updated!</h4>
                                                        </div>',
                                    'firstName'     => $sessionData->firstName,
                                    'trainee_group' => $trainee_group,
                                    'oldEntry'      => $oldEntry,
                                    'accessRight'   => $sessionData->rights,
                                    'title'         => 'Edit Trainee Group',
                                    'tableHeadings' => ['Name', 'Level', 'Section', 'Description']

                                ]);
            
        }

        

    }


    /*
     * deleteTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function deleteTraineeGroup (){
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        $traineeGroupName = $_POST["traineeGroupName"];

        //create digest of the form submission:
        $messageIdent = md5($_POST['traineeGroupName']);

        //and check it against the stored value: $sessionData->email

        $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';
        // echo "<pre>";
        // print_r($_POST);
        // exit ;
        if($messageIdent!=$sessionMessageIdent){//if its different:          
                //save the session var:
                $sessionData->messageIdent = $messageIdent;
                
                // delete the data; DELETE FROM `trainee_group` WHERE trainee_group.name = 'PFP-9A'
                $db->delete('trainee_group', 
                        array(
                            ['trainee_group.name', '=', $traineeGroupName]
                        )
                ); 
                
                // fetch the all remaining records 
                $db->query('SELECT * FROM trainee_group');
                $traineeGroupTable = ($db->getResults());
                
                View::renderTemplate ('Resources/addTraineeGroupForm.twig.html', [
                                        'status' => '<div class="alert alert-success alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <h4 class="text-center">Trainee Group has been deleted!</h4>
                                                    </div>',
                                        'title' => 'Add New Trainee Group',
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
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
                                                            <h4 class="text-center">Data already deleted.</h4>
                                                    </div>',
                                        'title' => 'Add New Trainee Group',
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                        'traineeGroupTable' => $traineeGroupTable
                                    ]);
            
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
                                        'subject' => $subject,
                                        'title' => 'Add New Course',
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
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
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                        'subject' => $subject
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
                                            'firstName' => $sessionData->firstName,
                                            'accessRight'   => $sessionData->rights,
                                            'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                            'subject' => $subject
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
                                            'firstName' => $sessionData->firstName,
                                            'accessRight'   => $sessionData->rights,
                                            'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                            'subject' => $subject
                                        ]);
                }
                
            }
            

            



            
        }else {
            header("Location: /home/logout");

        }
    }
    

    /*
     * editCourse method 
     *
     * @param		
     * @return	 	
     */
    public function editCourse (){
        
        $sessionData = Session::getInstance();
        // echo "<pre>parameter is : ";
        // print_r($this->route_params['id']);
        $sessionData->editID = $this->route_params['id'];
        
        header("Location: /Resource/ResourceController/redirectEditCourse");
        exit;
    }


    /*
     * redirectEditTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function redirectEditCourse (){
        $db = DB::getInstance();
        $sessionData = Session::getInstance();

        $db->query('SELECT * FROM subject WHERE subject.id = '.$sessionData->editID);
        
        $course = ($db->getResults());
        
        $oldEntry = [   "name"              => $course[0]->name,
                        "id"                => $course[0]->id,
                        "code"              => $course[0]->code,
                        "required_period"   => $course[0]->required_period,
                        "description"       => $course[0]->description
                     ];


        View::renderTemplate ('Resources/editCourseForm.twig.html', [
                                    'firstName'     => $sessionData->firstName,
                                    'course'        => $course,
                                    'oldEntry'      => $oldEntry,
                                    'accessRight'   => $sessionData->rights,
                                    'title'         => 'Edit Course',
                                    'tableHeadings' => ['Name', 'Code', 'Req. Period', 'Description']

                                ]);

    }

    /*
     * updateTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function updateCourse (){
        // echo "<pre>";
        // print_r($_POST);

        // exit;

        $sessionData = Session::getInstance();
        $db = DB::getInstance();

        $name               = $_POST["name"] ;
        $code               = $_POST["code"] ;
        $required_period    = $_POST["required_period"] ;
        $description        = $_POST["description"];
        $id                 = $_POST["course_id"];
        /*
            Array
                (
                    [traineeGroup] => BUS
                    [level] => 2
                    [section] => A
                    [TraineeGroup_id] => 4
                    [description] => Term 2 Sales & Marketing Trainees
                    [submit] => 
                )

        */
        
        //create digest of the form submission:

        $messageIdent = md5($_POST['name'] . $_POST['code'] . $_POST['required_period'] . $_POST['description']);
        
        //and check it against the stored value: $sessionData->email

        $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';
        if($messageIdent!=$sessionMessageIdent){//if it's different:          
                //save the session var:
                $sessionData->messageIdent = $messageIdent;
                
                // save the data

                $db->update ('subject', 
                                array(  ['name' ,           '=', $name],
                                        ['code',            '=', $code],
                                        ['required_period', '=', $required_period],
                                        ['description',     '=', $description]
                                    ),
                                array(['id','=', $id])
                );


                $db->query('SELECT * FROM subject WHERE subject.id = '.$sessionData->editID);
                $course = ($db->getResults());
        
                $oldEntry = [   "name"              => $course[0]->name,
                                "id"                => $course[0]->id,
                                "code"              => $course[0]->code,
                                "required_period"   => $course[0]->required_period,
                                "description"       => $course[0]->description
                            ];
                View::renderTemplate ('Resources/editCourseForm.twig.html', [
                                    'firstName'     => $sessionData->firstName,
                                    'course'        => $course,
                                    'accessRight'   => $sessionData->rights,
                                    'oldEntry'      => $oldEntry,
                                    'title'         => 'Edit Course',
                                    'tableHeadings' => ['Name', 'Code', 'Req. Period', 'Description']

                                ]);
                

        } else {
            //you've sent this already!

            $db->query('SELECT * FROM subject WHERE subject.id = '.$sessionData->editID);
            $course = ($db->getResults());
    
            $oldEntry = [   "name"              => $course[0]->name,
                            "id"                => $course[0]->id,
                            "code"              => $course[0]->code,
                            "required_period"   => $course[0]->required_period,
                            "description"       => $course[0]->description
                        ];
            View::renderTemplate ('Resources/editCourseForm.twig.html', [
                                    'status' => '<div class="alert alert-danger alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">Course has already been updated!</h4>
                                                        </div>',
                                    'firstName'     => $sessionData->firstName,
                                    'course'        => $course,
                                    'accessRight'   => $sessionData->rights,
                                    'oldEntry'      => $oldEntry,
                                    'title'         => 'Edit Course',
                                    'tableHeadings' => ['Name', 'Code', 'Req. Period', 'Description']
                            ]);
            
        }

        

    }


    /*
     * deleteCourse method 
     *
     * @param		
     * @return	 	
     */
    public function deleteCourse (){
        
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        $course = $_POST['course'];
        
        //create digest of the form submission:
        $messageIdent = md5($_POST['course']);

        //and check it against the stored value: $sessionData->email

        $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';

        if($messageIdent!=$sessionMessageIdent){//if its different:          
                //save the session var:
                $sessionData->messageIdent = $messageIdent;
                
                // delete the data; DELETE FROM subject WHERE subject.name = 'test'
                $db->delete('subject', 
                        array(
                            ['subject.name', '=', $course]
                        )
                ); 
                
                // fetch the all remaining records 
                $db->query('SELECT * FROM subject');
                $subject = ($db->getResults());
                
                View::renderTemplate ('Resources/addCourseForm.twig.html', [
                                        'status' => '<div class="alert alert-success alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <h4 class="text-center">Course has been deleted!</h4>
                                                    </div>',
                                        'title' => 'Add New Course',
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                        'subject' => $subject
                                    ]);

        } else {
            //you've sent this already!
            $db->query('SELECT * FROM subject');
            $subject = ($db->getResults());
            View::renderTemplate ('Resources/addCourseForm.twig.html', [
                                        'status' => '<div class="alert alert-danger alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <h4 class="text-center">Data already deleted.</h4>
                                                    </div>',
                                        'title' => 'Add New Course',
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                        'subject' => $subject
                                    ]);
            
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
            $instructors = ($db->getResults());
            View::renderTemplate ('Resources/addInstructorForm.twig.html', [
                                        'instructors' => $instructors,
                                        'title' => 'Add A New Instructor',
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'tableHeadings' => ['First name', 'Last name', 'ID Number' ,'Note']

                                    ]);
        }else {

            header("Location: /home/logout");

        }
        
    }

    /*
     * createNewInstructor - action will provide the controller mechanism to display a form with the list
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
                $instructors = ($db->getResults());

                View::renderTemplate ('Resources/addInstructorForm.twig.html', [
                                        'status' => '<div class="alert alert-danger alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <h4 class="text-center">Instructor already exist!</h4>
                                                    </div>',
                                        'title' => 'Add New Instructor',
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'tableHeadings' => ['Name', 'Level', 'ID Number', 'Note'],
                                        'instructors' => $instructors
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
                    $instructors = ($db->getResults());

                    View::renderTemplate ('Resources/addInstructorForm.twig.html', [
                                            'status' => '<div class="alert alert-success alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">Instructor save!</h4>
                                                        </div>',
                                            'title' => 'Add New Instructor',
                                            'firstName' => $sessionData->firstName,
                                            'accessRight'   => $sessionData->rights,
                                            'tableHeadings' => ['Name', 'Level', 'Section', 'Note'],
                                            'instructors' => $instructors
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
                                            'firstName' => $sessionData->firstName,
                                            'accessRight'   => $sessionData->rights,
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
     * deleteInstructor method 
     *
     * @param		
     * @return	 	
     */
    public function deleteInstructor (){

        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        $info = explode(" ", $_POST['instructor']);
        $instructorID = $info[0]; 
        
        //create digest of the form submission:
        $messageIdent = md5($_POST['instructor']);

        //and check it against the stored value: $sessionData->email

        $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';

        if($messageIdent!=$sessionMessageIdent){//if its different:          
                //save the session var:
                $sessionData->messageIdent = $messageIdent;
                
                // delete the data; DELETE FROM subject WHERE subject.name = 'test'
                $db->delete('instructor', 
                        array(
                            ['instructor.id', '=', $instructorID]
                        )
                ); 
                
                // fetch the all remaining records 
                $db->query('SELECT * FROM instructor');
                $instructors = ($db->getResults());
                
                View::renderTemplate ('Resources/addInstructorForm.twig.html', [
                                        'status' => '<div class="alert alert-success alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <h4 class="text-center">Instructor has been deleted!</h4>
                                                    </div>',
                                        'title' => 'Add New Instructor',
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'tableHeadings' => ['First name', 'Last name', 'ID Number' ,'Note'],
                                        'instructors' => $instructors
                                    ]);

        } else {
            //you've sent this already!
            $db->query('SELECT * FROM instructor');
            $instructors = ($db->getResults());
            View::renderTemplate ('Resources/addInstructorForm.twig.html', [
                                        'status' => '<div class="alert alert-danger alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <h4 class="text-center">Data already deleted.</h4>
                                                    </div>',
                                        'title' => 'Add New Instructor',
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'tableHeadings' => ['First name', 'Last name', 'ID Number' ,'Note'],
                                        'instructors' => $instructors
                                    ]);
            
        }
        
    }    

    /*
     * editInstructor method 
     *
     * @param		
     * @return	 	
     */
    public function editInstructor (){
        
        $sessionData = Session::getInstance();
        // echo "<pre>parameter is : ";
        // print_r($this->route_params['id']);
        // exit;
        $sessionData->editID = $this->route_params['id'];
        
        header("Location: /Resource/ResourceController/redirectEditInstructor");
        exit;
    }

    /*
     * redirectEditTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function redirectEditInstructor (){
        $db = DB::getInstance();
        $sessionData = Session::getInstance();

        $db->query('SELECT * FROM instructor WHERE instructor.id = '.$sessionData->editID);
               
        $instructor = ($db->getResults());

        $oldEntry = [   "id"            => $instructor[0]->id,
                        "id_number"     => $instructor[0]->id_number,
                        "first_name"    => $instructor[0]->first_name,
                        "last_name"     => $instructor[0]->last_name,
                        "note"          => $instructor[0]->note
                     ];


        View::renderTemplate ('Resources/editInstructorForm.twig.html', [
                                    'firstName'     => $sessionData->firstName,
                                    'instructor'    => $instructor,
                                    'oldEntry'      => $oldEntry,
                                    'accessRight'   => $sessionData->rights,
                                    'title'         => 'Edit Instructor',
                                    'tableHeadings' => ['Name', 'Level', 'ID Number', 'Note']

                                ]);

    }

    /*
     * updateTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function updateInstructor (){

        $sessionData = Session::getInstance();
        $db = DB::getInstance();

        $first_name = $_POST["first_name"] ;
        $last_name  = $_POST["last_name"] ;
        $id_number  = $_POST["id_number"] ;
        $note       = $_POST["note"];
        $id         = $_POST["id"];
        //create digest of the form submission:

        $messageIdent = md5($_POST['first_name'] . $_POST['last_name'] . $_POST['id_number'] . $_POST['note']);
        
        //and check it against the stored value: $sessionData->email

        $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';
        if($messageIdent!=$sessionMessageIdent){//if it's different:          
                //save the session var:
                $sessionData->messageIdent = $messageIdent;
                
                // save the data

                $db->update ('instructor', 
                                array(  ['first_name',  '=', $first_name],
                                        ['last_name',   '=', $last_name],
                                        ['id_number',   '=', $id_number],
                                        ['note',        '=', $note]
                                    ),
                                array(['id','=', $id])
                );


                $db->query('SELECT * FROM instructor WHERE instructor.id = '.$sessionData->editID);
                $instructor = ($db->getResults());
        
                $oldEntry = [   "first_name"    => $instructor[0]->first_name,
                                "last_name"     => $instructor[0]->last_name,
                                "id_number"     => $instructor[0]->id_number,
                                "note"          => $instructor[0]->note
                               
                            ];
                View::renderTemplate ('Resources/editInstructorForm.twig.html', [
                                    'firstName'     => $sessionData->firstName,
                                    'instructor'    => $instructor,
                                    'oldEntry'      => $oldEntry,
                                    'accessRight'   => $sessionData->rights,
                                    'title'         => 'Edit Instructor',
                                    'tableHeadings' => ['Name', 'Level', 'ID Number', 'Note']

                                ]);
                

        } else {
            //you've sent this already!

            $db->query('SELECT * FROM instructor WHERE instructor.id = '.$sessionData->editID);
            $instructor = ($db->getResults());

    
            $oldEntry = [ "id"            => $instructor[0]->id,
                            "id_number"     => $instructor[0]->id_number,
                            "first_name"    => $instructor[0]->first_name,
                            "last_name"     => $instructor[0]->last_name,
                            "note"          => $instructor[0]->note
                        ];
            View::renderTemplate ('Resources/editInstructorForm.twig.html', [
                                    'status' => '<div class="alert alert-danger alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">Instructor has already been updated!</h4>
                                                        </div>',
                                    'firstName'     => $sessionData->firstName,
                                    'instructor'    => $instructor,
                                    'oldEntry'      => $oldEntry,
                                    'accessRight'   => $sessionData->rights,
                                    'title'         => 'Edit Course',
                                    'tableHeadings' => ['Name', 'Level', 'ID Number', 'Note']

                                ]);
            
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
            $db->select(
                array(  'room.id', 
                        'room.name as \'RoomName\'', 
                        'room.type as \'RoomType\'', 
                        'room.location as \'RoomLoc\'', 
                        'room.description as \'RoomDesc\'',
                        'room_type.id as \'rtID\'', 
                        'room_type.name as \'rtName\'', 
                        'room_type.description as \'rtDesc\''),
                array('room INNER JOIN room_type ON room.type = room_type.id'),
                array(
                    ['room.type', 'like', '%']
                )
            );
            $rooms = ($db->getResults());

            View::renderTemplate ('Resources/addRoomForm.twig.html', [
                                        'rooms' => $rooms,
                                        'title' => 'Add A New Room',
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'tableHeadings' => ['Name', 'Type', 'Location' ,'Description']
                                    ]);
        }else {

            header("Location: /home/logout");

        }
        
    }

    /*
     * createNewRoom - action will provide the controller mechanism to display a form with the list
     * list of already store course from the database. 
     *
     * @param		none
     * @return      none	 	
     */
    public function createNewRoom(){
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        if ($sessionData->inSession) {
            $db->query('SELECT * FROM room');

            $room = ($db->getResults());
            $name = $_POST["name"];
            $type = $_POST["type"];
            $location = $_POST["location"];
            $description = $_POST["description"];


            // check first if code already exist
            $db->select(
                array('*'),
                array('room'),
                array(
                    ['room.name',    '=', $_POST['name'] ],
                    ['room.type',    '=', $_POST['type'] ],
                    ['room.location',    '=', $_POST['location'] ],
                )
            );

            
             // it already exist
            if($db->count() > 0){
                 $db->select(
                    array(      'room.id',
                                'room.name as \'RoomName\'', 
                                'room.type as \'RoomType\'', 
                                'room.location as \'RoomLoc\'', 
                                'room.description as \'RoomDesc\'',
                                'room_type.id as \'rtID\'', 
                                'room_type.name as \'rtName\'', 
                                'room_type.description as \'rtDesc\''),
                        array('room INNER JOIN room_type ON room.type = room_type.id'),
                        array(
                            ['room.type', 'like', '%']
                    )
                );
                $rooms = ($db->getResults());
                // echo "<pre>";
                //     print_r($rooms);
                //     exit;
                View::renderTemplate ('Resources/addRoomForm.twig.html', [
                                        'status' => '<div class="alert alert-danger alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <h4 class="text-center">Room already exist!</h4>
                                                    </div>',
                                        'title' => 'Add New Room',
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'tableHeadings' =>  ['Name', 'Type', 'Location' ,'Description'],
                                        'rooms' => $rooms
                                    ]);

            }else{
                 //create digest of the form submission:

                $messageIdent = md5($_POST['name'] . $_POST['type'] . $_POST['location']);

                //and check it against the stored value: $sessionData->email

                $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';

                if($messageIdent!=$sessionMessageIdent){//if its different:
                    //save the session var:
                    $sessionData->messageIdent = $messageIdent;
                    // save the data 
                    $db->insert('room', 
                            array(  'name' => $name,
                                    'type' =>  $type,
                                    'location' => $location,
                                    'description' => $description

                            ));
                    $lastInsertId = $db->getlastInsertId();
                    unset($_POST);
                    
                    $db->select(
                        array(      'room.id',
                                    'room.name as \'RoomName\'', 
                                    'room.type as \'RoomType\'', 
                                    'room.location as \'RoomLoc\'', 
                                    'room.description as \'RoomDesc\'',
                                    'room_type.id as \'rtID\'', 
                                    'room_type.name as \'rtName\'', 
                                    'room_type.description as \'rtDesc\''),
                            array('room INNER JOIN room_type ON room.type = room_type.id'),
                            array(
                                ['room.type', 'like', '%']
                        )
                    );
                    $rooms = ($db->getResults());
                   
                    View::renderTemplate ('Resources/addRoomForm.twig.html', [
                                            'status' => '<div class="alert alert-success alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">Room saved!</h4>
                                                        </div>',
                                            'rooms' => $rooms,
                                            'title' => 'Add New Room',
                                            'firstName' => $sessionData->firstName,
                                            'accessRight'   => $sessionData->rights,
                                            'tableHeadings' =>  ['Name', 'Type', 'Location' ,'Description']
                                            
                                        ]);

                
                }else{
                    //you've sent this already!
                    $db->select(
                        array(      'room.id',
                                    'room.name as \'RoomName\'', 
                                    'room.type as \'RoomType\'', 
                                    'room.location as \'RoomLoc\'', 
                                    'room.description as \'RoomDesc\'',
                                    'room_type.id as \'rtID\'', 
                                    'room_type.name as \'rtName\'', 
                                    'room_type.description as \'rtDesc\''),
                            array('room INNER JOIN room_type ON room.type = room_type.id'),
                            array(
                                ['room.type', 'like', '%']
                        )
                    );
                    $rooms = ($db->getResults());

                    
                    View::renderTemplate ('Resources/addRoomForm.twig.html', [
                                            'status' => '<div class="alert alert-danger alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <h4 class="text-center">Previous data already save.</h4>
                                                        </div>',
                                            'title' => 'Add New Room',
                                            'firstName' => $sessionData->firstName,
                                            'accessRight'   => $sessionData->rights,
                                            'tableHeadings' =>  ['Name', 'Type', 'Location' ,'Description'],
                                            'rooms' => $rooms
                                        ]);
                }
                
            }
                        
        }else {
            header("Location: /home/logout");

        }
    }

    /*
     * editInstructor method 
     *
     * @param		
     * @return	 	
     */
    public function editRoom (){
        
        $sessionData = Session::getInstance();
        $sessionData->editID = $this->route_params['id'];
        // echo "<pre>";
        // print_r($sessionData->editID);
        // exit;
        header("Location: /Resource/ResourceController/redirectEditRoom");
        exit;
    }

    /*
     * redirectEditRoom method 
     *
     * @param		
     * @return	 	
     */
    public function redirectEditRoom (){
        $db = DB::getInstance();
        $sessionData = Session::getInstance();

        $db->select(
            array(  'room.id', 
                    'room.name as \'RoomName\'', 
                    'room.type as \'RoomType\'', 
                    'room.location as \'RoomLoc\'', 
                    'room.description as \'RoomDesc\'',
                    'room_type.id as \'rtID\'', 
                    'room_type.name as \'rtName\'', 
                    'room_type.description as \'rtDesc\''),
            array('room INNER JOIN room_type ON room.type = room_type.id'),
            array(
                ['room.id', '=', $sessionData->editID]
            )
        );
        $room = ($db->getResults());

        $oldEntry = [   "id"        => $room[0]->id,
                        "RoomName"  => $room[0]->RoomName,
                        "RoomType"  => $room[0]->RoomType,
                        "RoomLoc"   => $room[0]->RoomLoc,
                        "RoomDesc"  => $room[0]->RoomDesc
                     ];
        
        View::renderTemplate ('Resources/editRoomForm.twig.html', [
                                    'firstName'     => $sessionData->firstName,
                                    'room'          => $room,
                                    'oldEntry'      => $oldEntry,
                                    'accessRight'   => $sessionData->rights,
                                    'title'         => 'Edit Room',
                                    'tableHeadings' => ['Name', 'Type', 'Location' ,'Description']

                                ]);

    }

    /*
     * updateRoom method 
     *
     * @param		
     * @return	 	
     */
    public function updateRoom (){

        $sessionData = Session::getInstance();
        $db = DB::getInstance();

        // echo "<pre>";
        // print_r($_POST);
        // exit;
        /*
                Array
                    (
                        [name] => ELX WRKSHOP 1
                        [type] => 6
                        [location] => Main Building
                        [id] => 8
                        [description] => Electronics workshop
                        [submit] => 
                    )
                

        */
        $name           = $_POST["name"] ;
        $type           = $_POST["type"] ;
        $location       = $_POST["location"] ;
        $description    = $_POST["description"];
        $id             = $_POST["id"];

        //create digest of the form submission:

        $messageIdent = md5($_POST['name'] . $_POST['type'] . $_POST['location'] . $_POST['description']);
        
        //and check it against the stored value: $sessionData->email

        $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';
        if($messageIdent!=$sessionMessageIdent){//if it's different:          
                //save the session var:
                $sessionData->messageIdent = $messageIdent;
                


                $db->update ('room', 
                                array(  ['name',  '=', $name],
                                        ['type',   '=', $type],
                                        ['location',   '=', $location],
                                        ['description',        '=', $description]
                                    ),
                                array(['id','=', $id])
                );


                 $db->select(
                    array(  'room.id', 
                            'room.name as \'RoomName\'', 
                            'room.type as \'RoomType\'', 
                            'room.location as \'RoomLoc\'', 
                            'room.description as \'RoomDesc\'',
                            'room_type.id as \'rtID\'', 
                            'room_type.name as \'rtName\'', 
                            'room_type.description as \'rtDesc\''),
                    array('room INNER JOIN room_type ON room.type = room_type.id'),
                    array(
                        ['room.id', '=', $sessionData->editID]
                    )
                );
                $room = ($db->getResults());

                $oldEntry = [   "id"        => $room[0]->id,
                                "RoomName"  => $room[0]->RoomName,
                                "RoomType"  => $room[0]->RoomType,
                                "RoomLoc"   => $room[0]->RoomLoc,
                                "RoomDesc"  => $room[0]->RoomDesc
                            ];
                View::renderTemplate ('Resources/editRoomForm.twig.html', [
                                    'firstName'     => $sessionData->firstName,
                                    'room'          => $room,
                                    'oldEntry'      => $oldEntry,
                                    'accessRight'   => $sessionData->rights,
                                    'title'         => 'Edit Room',
                                    'tableHeadings' => ['Name', 'Type', 'Location' ,'Description']

                                ]);
                

        } else {
            //you've sent this already!
                $db->select(
                    array(  'room.id', 
                            'room.name as \'RoomName\'', 
                            'room.type as \'RoomType\'', 
                            'room.location as \'RoomLoc\'', 
                            'room.description as \'RoomDesc\'',
                            'room_type.id as \'rtID\'', 
                            'room_type.name as \'rtName\'', 
                            'room_type.description as \'rtDesc\''),
                    array('room INNER JOIN room_type ON room.type = room_type.id'),
                    array(
                        ['room.id', '=', $sessionData->editID]
                    )
                );
                $room = ($db->getResults());

                $oldEntry = [   "id"        => $room[0]->id,
                                "RoomName"  => $room[0]->RoomName,
                                "RoomType"  => $room[0]->RoomType,
                                "RoomLoc"   => $room[0]->RoomLoc,
                                "RoomDesc"  => $room[0]->RoomDesc
                            ];
                View::renderTemplate ('Resources/editRoomForm.twig.html', [
                                        'status' => '<div class="alert alert-danger alert-dismissable">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <h4 class="text-center">Room has already been updated!</h4>
                                                            </div>',
                                        'firstName'     => $sessionData->firstName,
                                        'room'          => $room,
                                        'oldEntry'      => $oldEntry,
                                        'title'         => 'Edit Room',
                                        'tableHeadings' => ['Name', 'Type', 'Location' ,'Description']

                                    ]);
            
        }

        

    }


    /*
     * deleteRoom method 
     *
     * @param		
     * @return	 	
     */
    public function deleteRoom (){
        

        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        $info = explode(" ", $_POST['room']);
        $roomID = $info[0]; 
        
        //create digest of the form submission:
        $messageIdent = md5($_POST['room']);

        //and check it against the stored value: $sessionData->email

        $sessionMessageIdent = isset($sessionData->messageIdent) ? $sessionData->messageIdent: '';

        if($messageIdent!=$sessionMessageIdent){//if its different:          
                //save the session var:
                $sessionData->messageIdent = $messageIdent;
                
                // delete the data; DELETE FROM subject WHERE subject.name = 'test'
                $db->delete('room', 
                        array(
                            ['room.id', '=', $roomID]
                        )
                ); 
                
                // fetch the all remaining records 
                $db->select(
                    array(      'room.id',
                                'room.name as \'RoomName\'', 
                                'room.type as \'RoomType\'', 
                                'room.location as \'RoomLoc\'', 
                                'room.description as \'RoomDesc\'',
                                'room_type.id as \'rtID\'', 
                                'room_type.name as \'rtName\'', 
                                'room_type.description as \'rtDesc\''),
                        array('room INNER JOIN room_type ON room.type = room_type.id'),
                        array(
                            ['room.type', 'like', '%']
                    )
                );
                $rooms = ($db->getResults());
                
                View::renderTemplate ('Resources/addRoomForm.twig.html', [
                                        'status' => '<div class="alert alert-success alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <h4 class="text-center">Room has been deleted!</h4>
                                                    </div>',
                                        'title' => 'Add New Room',
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'tableHeadings' =>  ['Name', 'Type', 'Location' ,'Description'],
                                        'rooms' => $rooms
                                    ]);

        } else {
            //you've sent this already!
            $db->select(
                array(      'room.id',
                            'room.name as \'RoomName\'', 
                            'room.type as \'RoomType\'', 
                            'room.location as \'RoomLoc\'', 
                            'room.description as \'RoomDesc\'',
                            'room_type.id as \'rtID\'', 
                            'room_type.name as \'rtName\'', 
                            'room_type.description as \'rtDesc\''),
                    array('room INNER JOIN room_type ON room.type = room_type.id'),
                    array(
                        ['room.type', 'like', '%']
                )
            );
            $rooms = ($db->getResults());
            View::renderTemplate ('Resources/addRoomForm.twig.html', [
                                        'status' => '<div class="alert alert-danger alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <h4 class="text-center">Data already deleted.</h4>
                                                    </div>',
                                        'title' => 'Add New Room',
                                        'firstName' => $sessionData->firstName,
                                        'accessRight'   => $sessionData->rights,
                                        'tableHeadings' =>  ['Name', 'Type', 'Location' ,'Description'],
                                        'rooms' => $rooms
                                    ]);
            
        }
    }





}

