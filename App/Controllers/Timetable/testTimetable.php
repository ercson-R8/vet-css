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
        echo "greetings from testTimetable index";
        $tg = new TraineeGroup();
        // return true;





    }



}


