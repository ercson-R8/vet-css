<?php

/**
 * TraineeGroups Model
 * 
 * This class defines attributes and methods required
 * to implement a chromosome (timetable). 
 * 
 * This class will be used by the SubjectClasses object. 
 */

class TraineeGroups{

    private $traineeGroupID = null;
    private $traineeGroupName = null;
    private $traineeGroupRemarks = null;
    private $traineeGroupLevel = null;

    /**
     * __constructor method 
     *
     * @param 	
     * @return	none; 
     */
    public function __construct ($traineeGroupID = null, $traineeGroupName= null,
                                     $traineeGroupRemarks = null, $traineeGroupLevel = null){
        $this->traineeGroupID = $traineeGroupID;
        $this->traineeGroupName = $traineeGroupName;
        $this->traineeGroupRemarks = $traineeGroupRemarks;
        $this->traineeGroupLevel = $traineeGroupLevel;

    }

    /**
     * SetTraineeGroupID method 
     *
     * @param 	$traineeGroup
     * @return	none 
     */
    public function SetTraineeGroupID ($traineeGroupID){

            $this->traineeGroupID = $traineeGroupID ;
        
    }

    /**
     * SetTraineeGroupName method 
     *
     * @param 	 $traineeGroupName 
     * @return	 none
     */
    public function SetTraineeGroupName ($traineeGroupName){
        
        $this->traineeGroupName = $traineeGroupName ;
        
    }

    /**
     * SetTraineeGroupRemarks method 
     *
     * @param 	 $traineeGroupRemarks 
     * @return	 none
     */
    public function SetTraineeGroupRemarks ($traineeGroupRemarks){
        
        $this->traineeGroupRemarks = $traineeGroupRemarks ;
        
    }

    /**
     * SetTraineeGroupLevel method 
     *
     * @param 	 $traineeGroupLevel
     * @return	 none
     */
    public function SetTraineeGroupLevel ($traineeGroupLevel){
        
        $this->traineeGroupLevel = $traineeGroupLevel ;
        
    }


    /**
     * GetTraineeGroupID method 
     *
     * @param 	 none
     * @return	 $traineeGroup
     */
    public function GetTraineeGroupID ($traineeGroupID){
        
        return $this->traineeGroupID;
        
    }

    /**
     * GetTraineeGroupName method 
     *
     * @param 	 none
     * @return	 $traineeGroupName
     */
    public function GetTraineeGroupName ($traineeGroupName){
        
        return $this->traineeGroupName;
        
    }

    /**
     * GetTraineeGroupRemarks method 
     *
     * @param 	 none
     * @return	 $traineeGroupRemarks
     */
    public function GetTraineeGroupRemarks ($traineeGroupRemarks){
        
        return $this->traineeGroupRemarks;
        
    }


    /**
     * GetTraineeGroupLevel method 
     *
     * @param 	 none
     * @return	 $traineeGroupLevel
     */
    public function GetTraineeGroupLevel ($traineeGroupLevel){
        
        return $this->traineeGroupLevel ;
        
    }


    /**
     * GetTraineeGroupInformation method 
     *
     * @param 	
     * @return	asso array GetTraineeGroupInformation
     */
    public function GetTraineeGroupInformation (){
        
        return [$this->traineeGroupID, $this->traineeGroupName, 
                $this->traineeGroupRemarks, $this->traineeGroupLevel
        ];
    }


}