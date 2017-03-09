<?php 

namespace App\Controllers\Timetable;

// use \Core\View;
use App\Models\DB;
use App\TimetableConfig;
use App\Controllers\Timetable\TraineeGroup;
use App\Controllers\Timetable\SubjectClass;


class TestTimetable {
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

 private $x, $y = null;

 public function __construct($x = null, $y = null ){

    $this->x = $x;
    $this->y = $y;

 }

    //  public function __clone() {
    //  }

 public function setXY($x, $y){
     $this->x = $x;
    $this->y = $y;
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
