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



    private $preferencesPreferredStartPeriod; 
    private $preferencesPreferredEndPeriod; 
    private $preferencesPreferredNumberDays; 
    private $preferencesPreferredNumberPeriodsDay;
    private $preferencesDistributionBlock;

    private $isPossibleToDistribute = false;



    /**
     * Constructor method 
     *
     * @param   $preferencesPreferredStartPeriod     int: for special group with irregular schedule
     *          $preferencesPreferredEndPeriod       int: for special group with irregular schedule
     *          $preferencesPreferredNumberDays      int: teacher's preferrence;
     *          $preferencesDistributionBlock        array: how periods be distributed in "n" days;
     * @return  none;
     */

    public function __construct ($preferencesID = null, $preferencesSubjectID = null ,$preferencesTraineeGroupID = null, 
                                $preferencesTeacherID = null, $preferencesRoomID = null, $preferencesPreferredStartPeriod = null, 
                                $preferencesPreferredEndPeriod = null, $preferencesPreferredNumberDays = null,
                                $preferencesPreferredNumberPeriodsDay = null, $preferencesDistributionBlock = null){

        $this->preferencesID = $preferencesID;
        $this->preferencesSubjectID = $preferencesSubjectID;
        $this->preferencesTraineeGroupID = $preferencesTraineeGroupID;
        $this->preferencesTeacherID = $preferencesTeacherID;

        $this->preferencesRoomID = $preferencesRoomID;
        $this->preferencesPreferredStartPeriod = $preferencesPreferredStartPeriod;
        $this->preferencesPreferredEndPeriod = $preferencesPreferredEndPeriod;

        $this->preferencesPreferredNumberDays = $preferencesPreferredNumberDays;
        $this->preferencesPreferredNumberPeriodsDay = $preferencesPreferredNumberPeriodsDay;;
        $this->preferencesDistributionBlock = $preferencesDistributionBlock;
        $this->isPossibleToDistribute = $this->DistributeBlockPeriods();


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

    /**
     * SetPreferencesSubjectID method 
     *
     * @param 	$preferencesSubjectID
     * @return	 
     */
    public function SetPreferencesSubjectID ($preferencesSubjectID){
        
        $this->preferencesSubjectID = $preferencesSubjectID ;
    }

    /**
     * SetPreferencesTraineeGroupID method 
     *
     * @param 	$preferencesTraineeGroupID
     * @return	 
     */
    public function SetPreferencesTraineeGroupID ($preferencesTraineeGroupID){
        
        $this->preferencesTraineeGroupID = $preferencesTraineeGroupID ;
    }

    /**
     * SetPreferencesTeacherID method 
     *
     * @param 	$preferencesTeacherID
     * @return	 
     */
    public function SetPreferencesTeacherID ($preferencesTeacherID){
        
        $this->preferencesTeacherID = $preferencesTeacherID ;
    }

    /**
     * SetPreferencesRoomID method 
     *
     * @param 	$preferencesRoomID
     * @return	 
     */
    public function SetPreferencesRoomID ($preferencesRoomID){
        
        $this->preferencesRoomID = $preferencesRoomID ;
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
     * GetPreferencesSubjectID method 
     *
     * @param 	
     * @return	 $preferencesSubjectID
     */
    public function GetPreferencesSubjectID (){
        
        return $this->preferencesSubjectID ;
    }

    /**
     * GetPreferencesTraineeGroupID method 
     *
     * @param 	
     * @return	 $preferencesTraineeGroupID
     */
    public function GetPreferencesTraineeGroupID (){
        
        return $this->preferencesTraineeGroupID;
    }

    /**
     * GetPreferencesTeacherID method 
     *
     * @param 	
     * @return	 $preferencesTeacherID
     */
    public function GetPreferencesTeacherID (){
        
        return $this->preferencesTeacherID;
    }

    /**
     * GetPreferencesRoomID method 
     *
     * @param 	
     * @return	 $preferencesRoomID
     */
    public function GetPreferencesRoomID (){
        
        return $this->preferencesRoomID ;
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
     * GetIsPossibleToDistribute method 
     *
     * @param 	
     * @return	 $isPossibleToDistribute
     */
    public function GetIsPossibleToDistribute (){
        
        return $this->isPossibleToDistribute ;
    }

    private function DistributeBlockPeriods(){
        /**
        * 
        * alloting number of periods to corresponding number of days per week. 
        * $numberPeriodsPerDay <= $totalPeriodsPerWeek
        * ($numberDaysPerWeek * $numberPeriodsPerDay) >= $totalPeriodsPerWeek
        */                   
        $_subjectId = $this->GetPreferencesSubjectID()->GetSubjectID();
        $_totalPeriodsPerWeek = $this->GetPreferencesSubjectID()->GetSubjectRequiredPeriod();
        $_numberDaysPerWeek=$this->GetPreferencesPreferredNumberDays();
        $_numberPeriodsPerDay = $this->GetPreferencesPreferredNumberPeriodsDay();
        echo "===========<br/><br/>Testing possibilities for <b>$_subjectId</b><br/>";
        echo "Total number of periods: <b>$_totalPeriodsPerWeek</b><br/>";
        echo "Preferred number of days/week: <b>$_numberDaysPerWeek</b> <br/>";
        echo "Preferred number of periods/day: <b>$_numberPeriodsPerDay</b><br/>";
        
        if (($_numberDaysPerWeek * $_numberPeriodsPerDay) < $_totalPeriodsPerWeek) {

            echo "<b> NOT POSSIBLE </b>to schedule  <br/><br/>";
            return false;
        }else {
            $totalPeriodsPerWeek = $_totalPeriodsPerWeek;
            $numberDaysPerWeek = $_numberDaysPerWeek;
            $numberPeriodsPerDay = $_numberPeriodsPerDay;
            $remainingPeriods = $totalPeriodsPerWeek;
            $remainingDays = $numberDaysPerWeek;
            $blockPeriod = $numberPeriodsPerDay;
            $dist = [];
            $done = false;

            while (!($done)){                
                // this is for the last part in allocating block period
                if ( ($remainingPeriods <= $blockPeriod) ){

                    if ($remainingDays > 0){
                        // check if the remaining periods can be divided evenly 
                        // on the remaining days. result should be not less than 1
                        // and the remainder should be equal to zero;
                        $isPossibleToDistribute = $remainingPeriods / $remainingDays;
                        if ( fmod($isPossibleToDistribute, 1) == 0   ) { 
                            $blockPeriod = $isPossibleToDistribute; 
                            // distribute the remaining periods to the remaining days
                            for ($i = 0; $i < $remainingDays; $i++){
                                array_push($dist, $blockPeriod);
                            }
                            $done = true;
                            break;
                        }else{ 
                            echo "$isPossibleToDistribute NOT POSSIBLE<br/>";
                            $done = true;
                            $dist = [];
                            // break;
                            return false;
                        }
                    }else { // since this is the last day, push the remaining periods
                        array_push($dist, $remainingPeriods);
                        $done = true;
                        break;
                    }
                }
                array_push($dist, $blockPeriod);
                $remainingDays -= 1;
                $remainingPeriods -= $blockPeriod;
            }

            //echo "<br/><br/>" . (print_r($dist)) . "<br/><br/>";
            shuffle ($dist);
            foreach ($dist as $key => $value){
                $k = $key + 1;
                echo "Day$k : <b>$value </b>| ";
            }
            echo"<br/>";
        }
        $this->preferencesDistributionBlock = $dist;
        return true;
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
                $this->preferencesSubjectID,
                $this->preferencesTraineeGroupID,
                $this->preferencesTeacherID,
                $this->preferencesRoomID,

                $this->preferencesPreferredStartPeriod,
                $this->preferencesPreferredEndPeriod,
                $this->preferencesPreferredNumberDays,
                $this->preferencesDistributionBlock
                ];
    }

}


