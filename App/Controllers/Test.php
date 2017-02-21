<?php


namespace App\Controllers;

// use \Core\View;
// use App\Models\DB;
use App\Controllers\Timetable\TestTimetable as TClass;



class Test extends \Core\Controller {
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

    public function indexAction(){
        // echo "testing from controller test<br/>";
        $t = new TClass();

        $t->indexAction();
        // TClass::indexAction();
    }


        public function testAction(){
        // echo "testing from controller test<br/>";
        $a = [];
        for ($i=0; $i < 10; $i++){
            $a[] = [$i, $i*10];
        }
        echo "<pre>";
        print_r($a);
    }

}