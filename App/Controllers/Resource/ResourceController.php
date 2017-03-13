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

            
            // $db->select(
            //     array(  'subject_class.id',
            //             'trainee_group.name', 
            //             'trainee_group.level', 
            //             'trainee_group.section', 
            //             'subject.name', 
            //             'subject.code',
            //             'instructor.first_name',
            //             'instructor.last_name',
            //             'room.name'),
            //     array('subject_class', 'trainee_group', 'subject', 'instructor', 'room'),
            //     array(
            //         ['subject_class.id', '=', '3'], 
            //         ['trainee_group.id', '=', '1'],
            //         ['subject.id', '=', '3'], 
            //         ['instructor.id', '=', '3'],
            //         ['room.id', '=', '1']
            //         )
            //     );

            // print_r("<pre>");
            // print_r($db);

            
            View::renderTemplate ('Resources/addTraineeGroupForm.twig.html', [
                                        'traineeGroupTable' => $this->traineeGroupTable,
                                        'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],

                                    ]);


        
        }else {

            View::renderTemplate('Auth/login.twig.html');

        }

    }

    public function createTraineeGroupAction(){
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        if ($sessionData->inSession) {
            
            $db->select(
                array('*'),
                array('trainee_group'),
                array(
                    ['name','LIKE', '%' ]
                )
            );
            $this->traineeGroupTable = ($db->getResults());


                      

            $traineeGroup = $_POST["traineeGroup"] ? $_POST["traineeGroup"] : null;
            $level = $_POST["level"] ? $_POST["level"] : null;
            $section = $_POST["section"] ? $_POST["section"] : null;
            $description = $_POST["description"];
            
            // check if user supplied the required fields 
            if( $traineeGroup && $level && $section ){
                // save the data 


            } else {
                // if a required field is missing, render back the page 
                // with error message

                View::renderTemplate ('Resources/addTraineeGroupForm.twig.html', [
                                            'errorTraineeGroup' => '<div class="alert alert-danger alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                <code>Please verify email and password.</code>
                                                                </div>',
                                            'tableHeadings' => ['Name', 'Level', 'Section', 'Description'],
                                            'traineeGroupTable' => $this->traineeGroupTable
                                        ]);




            }


            


            // $db = DB::getInstance();
            // $db->select(
            //     array('*'),
            //     array('trainee_group'),
            //     array(
            //         ['name','LIKE', '%' ]
            //     )
            // );
            // $this->traineeGroupTable = ($db->getResults());

            
        }else {
            View::renderTemplate('Auth/login.twig.html');

        }

    }
 


}
