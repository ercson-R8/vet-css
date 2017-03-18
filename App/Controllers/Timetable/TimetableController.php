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
            

            $timetable = ($db->getResults());
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
                // save the data 
                $db->insert('timetable', 
                        array(  'year_start' => $year_start,
                                'year_end' =>  $year_end,
                                'term' => $term,
                                'remarks' => $remarks

                        ));

                unset($_POST);
                

                $lastInsertId = $db->getlastInsertId();
                $sessionData->currentTimetable = $lastInsertId;
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
            print_r($timetable);
            $tableTitle = 'List of classes for AY '.$timetable[0]->year_start.'-'.$timetable[0]->year_end.' Term'.$timetable[0]->term;
            $tableSubTitle = '('.$timetable[0]->remarks.')';
            View::renderTemplate ('Timetables/addSubjectClassForm.twig.html', [
                                        'subjectClass' => $subject_class,
                                        'title' => 'Add a Class '.$sessionData->currentTimetable,
                                        'firstName' => $sessionData->firstName,
                                        'tableTitle' => $tableTitle,
                                        'tableSubTitle' => $tableSubTitle,
                                        'tableHeadings' => ['timetable_id', 'subject_id', 'trainee_group_id' ,'instructor_id']
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
        if ($sessionData->inSession) {
            

            $timetable = ($db->getResults());
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
                // save the data 
                $db->insert('timetable', 
                            array(  'year_start' => $year_start,
                                    'year_end' =>  $year_end,
                                    'term' => $term,
                                    'remarks' => $remarks

                            ));

                unset($_POST);

                header("Location: /Timetable/TimetableController/addSubjectClass");

                 
                
            
            }else{
                //you've sent this already!
                

                $this->addSubjectClassAction();


            }
                        
        }else {
            header("Location: /home/logout");

        }
    }





}

