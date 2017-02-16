<?php


/**
 * Subjects Model
 * 
 * This class defines attributes and methods required
 * to implement a chromosome (timetable). 
 * 
 * This class will be used by the SubjectClasses object. 
 */

class Subjects{

    private $subjectID;
    private $subjectCode;
    private $subjectName;
    private $subjectRequiredPeriod;
    private $subjectDescription;

    /*
     * Constructor method 
     *
     * @param   $subjectID int: subject id number
     *          subjectCode string: the subject code
     *          $SubjectName string: descriptive name for the subject
     *          $subjectRequiredPeriod int: the required number of periods per week
     *          $subjectDescription string: subject description
     * @return  none;
     */

    public function __construct ($subjectID = null, $subjectCode = null, 
                                    $subjectName = null, $subjectRequiredPeriod = null,
                                    $subjectDescription = null ){
        $this->subjectID = $subjectID;
        $this->subjectCode = $subjectCode;
        $this->subjectName = $subjectName;
        $this->subjectRequiredPeriod = $subjectRequiredPeriod;
        $this->subjectDescription = $subjectDescription;
    }


    /**
     * SetSubjectID method 
     *
     * @param 	$subjectID int: subject id number
     * @return	none 
     */
    public function SetSubjectID ($subjectID){

        $this->subjectID = $subjectID;
        
    }

    /**
     * SetSubjectCode method 
     *
     * @param 	subjectCode string: the subject code
     * @return	none 
     */
    public function SetSubjectCode ($subjectCode){

        $this->subjectCode = $subjectCode;
    }

    /**
     * SetSubjectName method 
     *
     * @param 	$SubjectName string: descriptive name for the subject
     * @return	none
     */
    public function SetSubjectName ($subjectName){
        
        $this->subjectName = $subjectName;

    }

    /**
     * SetSubjectRequiredPeriod method 
     *
     * @param 	$subjectRequiredPeriod int: the required number of periods per week
     * @return	none
     */
    public function SetSubjectRequiredPeriod ($subjectRequiredPeriod){
        
        $this->subjectRequiredPeriod = $subjectRequiredPeriod;

    }

    /**
     * SetSubjectDescription method 
     *
     * @param 	$subjectDescription string: subject description
     * @return	none
     */
    public function SetSubjectDescription ($subjectDescription){
        
        $this->subjectDescription = $subjectDescription;

    }

    /*
     * GetSubjectID method 
     *
     * @param    none
     * @return	 $subjectID int: the subject id
     */
    public function GetSubjectID (){
        
        return $this->subjectID;
    }

    /*
     * GetSubjectCode method 
     *
     * @param 	 none
     * @return	 $subject string: subject code
     */
    public function GetSubjectCode (){
        
        return $this->subjectCode;
    }

    /*
     * GetSubjectName method 
     *
     * @param 	
     * @return	 $subjectName string: name of the subject
     */
    public function GetSubjectName (){
        
        return $this->subjectName;
    }

    /*
     * GetSubjectRequiredPeriod method 
     *
     * @param 	 none
     * @return	 $subjectRequiredPeriod int: require number of periods per week
     */
    public function GetSubjectRequiredPeriod (){
        
        return $this->subjectRequiredPeriod;
    }

    /*
     * GetSubjectDescription method 
     *
     * @param 	
     * @return	 $subject
     */
    public function GetSubjectDescription (){
        
        return $this->subjectDescription;
    }

    /*
     * GetSubjectInformation method 
     *
     * @param 	
     * @return	 
     */
    public function GetSubjectInformation (){
        
        return [$this->subjectID,
                $this->subjectCode,
                $this->subjectName,
                $this->subjectRequiredPeriod,
                $this->subjectDescription
        ];
    }


}