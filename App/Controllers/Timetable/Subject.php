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

    /**
     * getsubjectID method 
     *
     * @param		none
     * @return	 	int     this ID
     */
    public function getSubjectID (){
        return $this->subjectID;
    }

    /*
     * getsubjectCode
     */
    public function getSubjectCode (){
        
        return $this->subjectCode;
        
    }

    /*
     * getsubjectName
     */
    public function getSubjectName (){
        
        return $this->subjectName;
        
    }

    /*
     * getrequiredPeriod
     */
    public function getRequiredPeriod (){
        
        return $this->requiredPeriod ;
        
    }

    /*
     * getSubjectRemarks
     */
    public function getSubjectRemarks (){
        
        return $this->SubjectRemarks;
        
    }

    /*
     * GetSubjectInformation
     */
    public function getSubjectInfo (){
        
        return [$this->subjectID, 
                $this->subjectCode, 
                $this->subjectName,
                $this->description
        ];
    }


}