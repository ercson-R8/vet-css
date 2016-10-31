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
    private $preferencesPreferredStartPeriod; 
    private $preferencesPreferredEndPeriod; 
    private $preferencesPreferredNumberDays; 
    private $preferencesPreferredNumberPeriodsDay;




    /**
     * Constructor method 
     *
     * @param   $preferencesID                       int: id 
     *          $preferencesPreferredStartPeriod     int: for special group with irregular schedule
     *          $preferencesPreferredEndPeriod       int: for special group with irregular schedule
     *          $preferencesPreferredNumberDays      int: teacher's preferrence;
     *          $preferencesDistributionBlock        array: how periods be distributed in "n" days;
     * @return  none;
     */

    public function __construct (   $preferencesID = null,
                                    $preferencesPreferredStartPeriod = null, 
                                    $preferencesPreferredEndPeriod = null, 
                                    $preferencesPreferredNumberDays = null,
                                    $preferencesPreferredNumberPeriodsDay = null){
        
        $this->preferencesID = $preferencesID ;
        $this->preferencesPreferredStartPeriod = $preferencesPreferredStartPeriod;
        $this->preferencesPreferredEndPeriod = $preferencesPreferredEndPeriod;

        $this->preferencesPreferredNumberDays = $preferencesPreferredNumberDays;
        $this->preferencesPreferredNumberPeriodsDay = $preferencesPreferredNumberPeriodsDay;



    }

    /**
     * SetPreferencesID method 
     *
     * @param 	$preferencesID
     * @return	 
     */
    public function SetPreferencesID ($preferencesID){
        
        $this->preferencesID = $preferencesID ;
    }



    // Getter methods


    /**
     * GetPreferencesID method 
     *
     * @param 	
     * @return	 $preferencesID
     */
    public function GetPreferencesID (){
        
        return $this->preferencesID ;
    }


    /**
     * GetPreferencesPreferredStartPeriod method 
     *
     * @param 	
     * @return	 $preferencesPreferredStartPeriod
     */
    public function GetPreferencesPreferredStartPeriod (){
        
        return $this->preferencesPreferredStartPeriod;
    }


    /**
     * GetPreferencesPreferredEndPeriod method 
     *
     * @param 	
     * @return	 $preferencesPreferredEndPeriod
     */
    public function GetPreferencesPreferredEndPeriod (){
        
        return $this->preferencesPreferredEndPeriod;
    }

    /**
     * GetPreferencesPreferredNumberDays method 
     *
     * @param 	
     * @return	 $preferencesPreferredNumberDays
     */
    public function GetPreferencesPreferredNumberDays (){
        
        return $this->preferencesPreferredNumberDays;
    }


    /**
     * GetPreferencesPreferredNumberPeriodsDay method 
     *
     * @param 	
     * @return	 $preferencesPreferredNumberPeriodsDay
     */
    public function GetPreferencesPreferredNumberPeriodsDay (){
        
        return $this->preferencesPreferredNumberPeriodsDay ;
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


