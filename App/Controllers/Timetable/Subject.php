<?php
namespace App\Controllers\Timetable;


class Subject {
/* 
 |--------------------------------------------------------------------------
 | Subject
 |--------------------------------------------------------------------------
 | 
 | This class provides a template to access data contained in the  
 | trainee_group table. 
 | 
 | This class will be used by the Timetable class. 
 | 
 */

    private $subjectID = null;
    private $subjectCode = null;
    private $subjectName = null;
    private $requiredPeriod = null;
    private $description = null;
    
    /*
     * __constructor  method 
     *
     * @param		
     * @return	    none; 	
     */
    public function __construct ($subjectID = null, $subjectCode = null, $subjectName = null,
                                    $requiredPeriod = null, $description = null){
        $this->subjectID = $subjectID;
        $this->subjectCode = $subjectCode; 
        $this->subjectName = $subjectName;
        $this->requiredPeriod = $requiredPeriod;
        $this->description  = $description;

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
        return $this->subjectID;
    }

    /*
     * getCode
     */
    public function getCode (){
        
        return $this->subjectCode;
        
    }

    /*
     * getName
     */
    public function getName (){
        
        return $this->subjectName;
        
    }

    /*
     * getrequiredPeriod
     */
    public function getRequiredPeriod (){
        
        return $this->requiredPeriod ;
        
    }

    /*
     * getRemarks
     */
    public function getRemarks (){
        
        return $this->SubjectRemarks;
        
    }

    /*
     * GetInformation
     */
    public function getInfo (){
        
        return [$this->subjectID, 
                $this->subjectCode, 
                $this->subjectName,
                $this->description
        ];
    }


}