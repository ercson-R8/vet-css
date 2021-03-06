<?php
namespace App\Controllers\Timetable;


class Instructor {
/* 
 |--------------------------------------------------------------------------
 | Instructor
 |--------------------------------------------------------------------------
 | 
 | This class provides a template to access data contained in the  
 | instructor table. 
 | 
 | This class will be used by the Timetable class. 
 | 
 */

    private $ID = null;
    private $first_name = null;
    private $last_name = null;
    private $remark = null;
    
    /*
     * __constructor  method 
     *
     * @param		
     * @return	    none; 	
     */
    public function __construct ($ID = null, $first_name = null,
                                    $last_name = null, $remark = null){
        $this->ID = $ID;
        // id 5 is designated for canteen 
        $this->first_name = ($ID == 5 ? null : $first_name);
        $this->last_name = ($ID == 5 ? null : $last_name);
        $this->remark  = $remark;

    }

    public function __clone() {
        // $this->subjectClassObject = clone $this->subjectClassObject;
    }

    /**
     * getID method 
     *
     * @param		none
     * @return	 	int     this ID
     */
    public function getID (){
        return $this->ID;
    }

    /*
     * getfirst_name
     */
    public function getFirst_name (){
        
        return $this->first_name;
        
    }

    /*
     * getlast_name
     */
    public function getLast_name (){
        
        return $this->last_name;
        
    }

    /*
     * getinstructorRemarks
     */
    public function getinstructorRemarks (){
        
        return $this->instructorRemarks;
        
    }

    /*
     * GetinstructorInformation
     */
    public function getinstructorInfo (){
        
        return [$this->ID, 
                $this->first_name,
                $this->last_name,
                $this->remark
        ];
    }


}