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
    
    /*
     * __constructor  method 
     *
     * @param		
     * @return	    none; 	
     */
    public function __construct ($traineeGroupID = null, $traineeGroupName = null, $traineeGroupSection = null,
                                    $traineeGroupLevel = null, $traineeGroupRemarks = null){

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

    /*
     * getTraineeGroupName method 
     *
     * @param 	 none
     * @return	 $traineeGroupName
     */
    public function getTraineeGroupName (){
        
        return $this->traineeGroupName;
        
    }

    /*
     * getTraineeGroupSection method 
     *
     * @param 	 none
     * @return	 $getTraineeGroupSection
     */
    public function getTraineeGroupSection (){
        
        return $this->traineeGroupSection;
        
    }

    /*
     * getTraineeGroupLevel method 
     *
     * @param 	 none
     * @return	 $traineeGroupLevel
     */
    public function getTraineeGroupLevel (){
        
        return $this->traineeGroupLevel ;
        
    }

    /*
     * getTraineeGroupRemarks method 
     *
     * @param 	 none
     * @return	 $traineeGroupRemarks
     */
    public function getTraineeGroupRemarks (){
        
        return $this->traineeGroupRemarks;
        
    }

    /*
     * GetTraineeGroupInformation method 
     *
     * @param 	
     * @return	asso array getTraineeGroupInformation
     */
    public function getTraineeGroupInfo (){
        
        return [$this->traineeGroupID, $this->traineeGroupName,
                $this->traineeGroupSection,
                $this->traineeGroupRemarks, $this->traineeGroupLevel
        ];
    }


}