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

    private $instructorID = null;
    private $instructorCode = null;
    private $instructorName = null;
    private $remark = null;
    private $description = null;
    
    /*
     * __constructor  method 
     *
     * @param		
     * @return	    none; 	
     */
    public function __construct ($instructorID = null, $instructorCode = null, $instructorName = null,
                                    $requiredPeriod = null, $description = null){
        $this->instructorID = $instructorID;
        $this->instructorCode = $instructorCode; 
        $this->instructorName = $instructorName;
        $this->requiredPeriod = $requiredPeriod;
        $this->description  = $description;

    }

    /**
     * getinstructorID method 
     *
     * @param		none
     * @return	 	int     this ID
     */
    public function getinstructorID (){
        return $this->instructorID;
    }

    /*
     * getinstructorCode
     */
    public function getinstructorCode (){
        
        return $this->instructorCode;
        
    }

    /*
     * getinstructorName
     */
    public function getinstructorName (){
        
        return $this->instructorName;
        
    }

    /*
     * getrequiredPeriod
     */
    public function getRequiredPeriod (){
        
        return $this->requiredPeriod ;
        
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
        
        return [$this->instructorID, 
                $this->instructorCode, 
                $this->instructorName,
                $this->description
        ];
    }


}