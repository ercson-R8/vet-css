<?php
namespace App\Controllers\Timetable;


class TraineeGroup {
/* 
 |--------------------------------------------------------------------------
 | TraineeGroup
 |--------------------------------------------------------------------------
 | 
 | This class provides a template to access data contained in the  
 | trainee_group table. 
 | 
 | This class will be used by the Timetable class. 
 | 
 */

    private $traineeGroupID = null;
    private $traineeGroupName = null;
    private $traineeGroupSection = null;
    private $traineeGroupLevel = null;
    private $traineeGroupRemarks = null;
    
    /**
     * __constructor  method 
     *
     * @param		
     * @return	    none; 	
     */
    public function __constructor ($traineeGroupID = null, $traineeGroupName = null, $traineeGroupSection = null,
                                    $traineeGroupSection = null, $traineeGroupRemarks = null){

        $this->traineeGroupID = $traineeGroupID;
        $this->traineeGroupName = $traineeGroupName;
        $this->traineeGroupSection = $traineeGroupSection;
        $this->traineeGroupLevel = $traineeGroupLevel;
        $this->traineeGroupRemarks = $traineeGroupRemarks;

    }

    /**
     * getTraineeGroupID method 
     *
     * @param		none
     * @return	 	int     this ID
     */
    public function getTraineeGroupID (){
        return $this->traineeGroupID;
    }

    /**
     * GetTraineeGroupName method 
     *
     * @param 	 none
     * @return	 $traineeGroupName
     */
    public function GetTraineeGroupName (){
        
        return $this->traineeGroupName;
        
    }

    /**
     * GetTraineeGroupSection method 
     *
     * @param 	 none
     * @return	 $GetTraineeGroupSection
     */
    public function GetTraineeGroupSection (){
        
        return $this->traineeGroupSection;
        
    }

    /**
     * GetTraineeGroupLevel method 
     *
     * @param 	 none
     * @return	 $traineeGroupLevel
     */
    public function GetTraineeGroupLevel (){
        
        return $this->traineeGroupLevel ;
        
    }

    /**
     * GetTraineeGroupRemarks method 
     *
     * @param 	 none
     * @return	 $traineeGroupRemarks
     */
    public function GetTraineeGroupRemarks (){
        
        return $this->traineeGroupRemarks;
        
    }

    /**
     * GetTraineeGroupInformation method 
     *
     * @param 	
     * @return	asso array GetTraineeGroupInformation
     */
    public function GetTraineeGroupInformation (){
        
        return [$this->traineeGroupID, $this->traineeGroupName,
                $this->traineeGroupSection,
                $this->traineeGroupRemarks, $this->traineeGroupLevel
        ];
    }


}