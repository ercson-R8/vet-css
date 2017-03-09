<?php 

namespace App\Controllers\Timetable;

use App\Controllers\Timetable\TestTimetable as TClass;
// use \Core\View;
use App\Models\DB;
use App\TimetableConfig;
use App\Controllers\Timetable\TraineeGroup;
use App\Controllers\Timetable\SubjectClass;


class TestTimetable2 {
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

 private $x, $y, $tc = null;

 public function __construct($x = null, $y = null, $tc = null){
    $this->x = $x;
    $this->y = $y;
    $this->tc = $tc;
 }


public function getTC(){
    return $this->tc;

} 

public function getX(){
    return $this->x;

}

public function getY(){
    return $this->y;
    
}

public function setX($x){
    $this->x = $x;

}

public function setY($y){
    $this->y = $y;
    
}


}// class end 
