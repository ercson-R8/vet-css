<?php


/**
 * Preferences Model
 * 
 * This class defines attributes and methods required
 * to implement a chromosome (timetable). 
 * 
 * A Preferences can have one and only one schedule slot;
 * This class will be used by the Schedules class. 
 */

class Preferences{


    private $preferencesID;
    private $traineeGroupID;
    private $subjectID;
    private $teacherID;
    private $preferenceRoomType;
    private $preferencePreferredStartPeriod; 
    private $preferencePreferredEndPeriod; 
    private $preferencePreferredNumberDays; 
    private $preferencePreferredNumberPeriodsDay;




    /**
     * Constructor method 
     *
     * @param   $preferencesID                       int: id 
     *          $preferencesPreferredStartPeriod     int: for special group with irregular schedule
     *          $traineeGroupID
     *          $subjectID;
     *          $teacherID;
     *          $preferenceRoomType
     *          $preferencesPreferredEndPeriod       int: for special group with irregular schedule
     *          $preferencesPreferredNumberDays      int: teacher's preferrence;
     *          $preferencesDistributionBlock        array: how periods be distributed in "n" days;
     * @return  none;
     */

    public function __construct (   $preferencesID = null,
                                    $subjectID = null,
                                    $traineeGroupID = null,
                                    $teacherID = null,
                                    $preferenceRoomType = null,
                                    $preferencePreferredStartPeriod = null, 
                                    $preferencePreferredEndPeriod = null, 
                                    $preferencePreferredNumberDays = null,
                                    $preferencePreferredNumberPeriodsDay = null){
        
        $this->preferencesID = $preferencesID ;
        $this->traineeGroupID = $traineeGroupID ;
        $this->subjectID = $subjectID ;
        $this->teacherID = $teacherID ;
        $this->preferenceRoomType = $preferenceRoomType ;

        $this->preferencePreferredStartPeriod = $preferencePreferredStartPeriod;
        $this->preferencePreferredEndPeriod = $preferencePreferredEndPeriod;

        $this->preferencePreferredNumberDays = $preferencePreferredNumberDays;
        $this->preferencePreferredNumberPeriodsDay = $preferencePreferredNumberPeriodsDay;



    }

    /**
     * SetPreferencesID method 
     *
     * @param 	$preferencesID
     * @return	 
     */
    public function SetPreferenceID ($preferencesID){
        
        $this->preferencesID = $preferencesID ;
    }





    // Getter methods


    /**
     * GetPreferencesID method 
     *
     * @param 	
     * @return	 $preferencesID
     */
    public function GetPreferenceID (){
        
        return $this->preferencesID ;
    }

//-------------------
    /**
     * GetPreferencesTraineeGroupID method 
     *
     * @param 	
     * @return	 $preferencesID
     */
    public function GetPreferenceTraineeGroupID (){
        
        return $this->traineeGroupID ;
    }

    /**
     * GetPreferencesSubjectID method 
     *
     * @param 	
     * @return	 $preferencesID
     */
    public function GetPreferenceSubjectID (){
        
        return $this->subjectID ;
    }

    /**
     * GetPreferencesTeacherID method 
     *
     * @param 	
     * @return	 $preferencesID
     */
    public function GetPreferenceTeacherID (){
        
        return $this->teacherID ;
    }

    /**
     * GetPreferencesPreferenceRoomType method 
     *
     * @param 	
     * @return	 $preferencesID
     */
    public function GetPreferencePreferenceRoomType (){
        
        return $this->preferenceRoomType ;
    }


//------------------

    /**
     * GetPreferencesPreferredStartPeriod method 
     *
     * @param 	
     * @return	 $preferencesPreferredStartPeriod
     */
    public function GetPreferencePreferredStartPeriod (){
        
        return $this->preferencePreferredStartPeriod;
    }


    /**
     * GetPreferencesPreferredEndPeriod method 
     *
     * @param 	
     * @return	 $preferencesPreferredEndPeriod
     */
    public function GetPreferencePreferredEndPeriod (){
        
        return $this->preferencePreferredEndPeriod;
    }

    /**
     * GetPreferencesPreferredNumberDays method 
     *
     * @param 	
     * @return	 $preferencesPreferredNumberDays
     */
    public function GetPreferencePreferredNumberDays (){
        
        return $this->preferencePreferredNumberDays;
    }


    /**
     * GetPreferencesPreferredNumberPeriodsDay method 
     *
     * @param 	
     * @return	 $preferencesPreferredNumberPeriodsDay
     */
    public function GetPreferencePreferredNumberPeriodsDay (){
        
        return $this->preferencePreferredNumberPeriodsDay ;
    }



 

    /**
     * GetPreferencesInformation method 
     *
     * @param 	none
     * @return	asso array Preferences attributes
     */
    public function GetPreferencesInformation(){

        return [
                $this->preferencesID,
                $this->preferencesPreferredStartPeriod,
                $this->preferencesPreferredEndPeriod,
                $this->preferencesPreferredNumberDays,
                $this->preferencesPreferredNumberPeriodsDay
                ];
    }

}


