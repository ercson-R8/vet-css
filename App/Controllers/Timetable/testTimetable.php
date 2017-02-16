<?php 

namespace App\Controllers\Timetable;

use \Core\View;
use App\Models\DB;
use App\Controllers\Timetable\TraineeGroup;



class TestTimetable extends \Core\Controller {
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
 public function __construct(){

 }
    // /**
    // * indexAction method 
    // *
    // * @param		
    // * @return	 	
    // */
    
    
    public function indexAction (){
        echo "<pre> greetings from testTimetable index";
        $subjectClass = [];
        // return true;

        $db = DB::getInstance();
        // SELECT * FROM `subject_class` WHERE subject_class.timetable_id = 1
        $db->query('SELECT * FROM subject_class WHERE subject_class.timetable_id = 1');
        echo "<br/>Result count: {$db->count()}<br/>";
        if ($db->count()){
            print_r ( $db->getResults());
            // var_dump($db->first());

            foreach ($db->getResults() as $result){
                echo "id: {$result->timetable_id}<br/>";
                // $subjectClass += [[$result->id]];
            }
        }
        echo "<br/>subject class: <br/> ";
        var_dump ($subjectClass);
 


    }



}


