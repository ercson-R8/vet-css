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
        return $this->traineeGroupID;
    }

    /*
     * getName method 
     *
     * @param 	 none
     * @return	 $traineeGroupName
     */
    public function getName (){
        
        return $this->traineeGroupName;
        
    }

    /*
     * getSection method 
     *
     * @param 	 none
     * @return	 $getSection
     */
    public function getSection (){
        
        return $this->traineeGroupSection;
        
    }

    /*
     * getLevel method 
     *
     * @param 	 none
     * @return	 $traineeGroupLevel
     */
    public function getLevel (){
        
        return $this->traineeGroupLevel ;
        
    }

    /*
     * getRemarks method 
     *
     * @param 	 none
     * @return	 $traineeGroupRemarks
     */
    public function getRemarks (){
        
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