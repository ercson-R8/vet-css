<?php


/**
 * SubjectClasses Model
 * 
 * This class defines attributes and methods required
 * to implement a chromosome (timetable). 
 * 
 * A SubjectClass can have one and only one schedule slot;
 * This class will be used by the Schedules class. 
 */

class SubjectClasses{

    private $subjectClassesID;
    private $subjectClassesSubjectID;
    private $subjectClassesTraineeGroupID;
    private $subjectClassesTeacherID;
    private $subjectClassesRoomID; 

    private $subjectClassesPreferredStartPeriod; 
    private $subjectClassesPreferredEndPeriod; 
    private $subjectClassesPreferredNumberDays; 
    private $subjectClassesPreferredNumberPeriodsDay;
    private $subjectClassesDistributionBlock;

    private $isPossibleToDistribute = false;



    /**
     * Constructor method 
     *
     * @param   $subjectClassesID                       int: subject class id number
     *          $subjectClassesSubjectID                subjectClassesSubjectID object: the subject of this subject_class
     *          $subjectClassesTraineeGroupID           subjectClassesTraineeGroupID object: the group who will attend this subject_class
     *          $subjectClassesTeacherID                subjectClassesTeacherID object: the teacher who will be teaching this subject_class
     *          $subjectClassesRoomID                   subjectClassesRoomID object: where this subject_class will be held
     *          $subjectClassesPreferredStartPeriod     int: for special group with irregular schedule
     *          $subjectClassesPreferredEndPeriod       int: for special group with irregular schedule
     *          $subjectClassesPreferredNumberDays      int: teacher's preferrence;
     *          $subjectClassesDistributionBlock        array: how periods be distributed in "n" days;
     * @return  none;
     */

    public function __construct ($subjectClassesID = null, $subjectClassesSubjectID = null ,$subjectClassesTraineeGroupID = null, 
                                $subjectClassesTeacherID = null, $subjectClassesRoomID = null, $subjectClassesPreferredStartPeriod = null, 
                                $subjectClassesPreferredEndPeriod = null, $subjectClassesPreferredNumberDays = null,
                                $subjectClassesPreferredNumberPeriodsDay = null, $subjectClassesDistributionBlock = null){

        $this->subjectClassesID = $subjectClassesID;
        $this->subjectClassesSubjectID = $subjectClassesSubjectID;
        $this->subjectClassesTraineeGroupID = $subjectClassesTraineeGroupID;
        $this->subjectClassesTeacherID = $subjectClassesTeacherID;

        $this->subjectClassesRoomID = $subjectClassesRoomID;
        $this->subjectClassesPreferredStartPeriod = $subjectClassesPreferredStartPeriod;
        $this->subjectClassesPreferredEndPeriod = $subjectClassesPreferredEndPeriod;

        $this->subjectClassesPreferredNumberDays = $subjectClassesPreferredNumberDays;
        $this->subjectClassesPreferredNumberPeriodsDay = $subjectClassesPreferredNumberPeriodsDay;;
        $this->subjectClassesDistributionBlock = $subjectClassesDistributionBlock;
        $this->isPossibleToDistribute = $this->DistributeBlockPeriods();


    }

    /**
     * SetSubjectClassesID method 
     *
     * @param 	$subjectClassesID
     * @return	 
     */
    public function SetSubjectClassesID ($subjectClassesID){
        
        $this->subjectClassesID = $subjectClassesID ;
    }

    /**
     * SetSubjectClassesSubjectID method 
     *
     * @param 	$subjectClassesSubjectID
     * @return	 
     */
    public function SetSubjectClassesSubjectID ($subjectClassesSubjectID){
        
        $this->subjectClassesSubjectID = $subjectClassesSubjectID ;
    }

    /**
     * SetSubjectClassesTraineeGroupID method 
     *
     * @param 	$subjectClassesTraineeGroupID
     * @return	 
     */
    public function SetSubjectClassesTraineeGroupID ($subjectClassesTraineeGroupID){
        
        $this->subjectClassesTraineeGroupID = $subjectClassesTraineeGroupID ;
    }

    /**
     * SetSubjectClassesTeacherID method 
     *
     * @param 	$subjectClassesTeacherID
     * @return	 
     */
    public function SetSubjectClassesTeacherID ($subjectClassesTeacherID){
        
        $this->subjectClassesTeacherID = $subjectClassesTeacherID ;
    }

    /**
     * SetSubjectClassesRoomID method 
     *
     * @param 	$subjectClassesRoomID
     * @return	 
     */
    public function SetSubjectClassesRoomID ($subjectClassesRoomID){
        
        $this->subjectClassesRoomID = $subjectClassesRoomID ;
    }


    // Getter methods


    /**
     * GetSubjectClassesID method 
     *
     * @param 	
     * @return	 $subjectClassesID
     */
    public function GetSubjectClassesID (){
        
        return $this->subjectClassesID ;
    }

    /**
     * GetSubjectClassesSubjectID method 
     *
     * @param 	
     * @return	 $subjectClassesSubjectID
     */
    public function GetSubjectClassesSubjectID (){
        
        return $this->subjectClassesSubjectID ;
    }

    /**
     * GetSubjectClassesTraineeGroupID method 
     *
     * @param 	
     * @return	 $subjectClassesTraineeGroupID
     */
    public function GetSubjectClassesTraineeGroupID (){
        
        return $this->subjectClassesTraineeGroupID;
    }

    /**
     * GetSubjectClassesTeacherID method 
     *
     * @param 	
     * @return	 $subjectClassesTeacherID
     */
    public function GetSubjectClassesTeacherID (){
        
        return $this->subjectClassesTeacherID;
    }

    /**
     * GetSubjectClassesRoomID method 
     *
     * @param 	
     * @return	 $subjectClassesRoomID
     */
    public function GetSubjectClassesRoomID (){
        
        return $this->subjectClassesRoomID ;
    }


    /**
     * GetSubjectClassesPreferredStartPeriod method 
     *
     * @param 	
     * @return	 $subjectClassesPreferredStartPeriod
     */
    public function GetSubjectClassesPreferredStartPeriod (){
        
        return $this->subjectClassesPreferredStartPeriod;
    }


    /**
     * GetSubjectClassesPreferredEndPeriod method 
     *
     * @param 	
     * @return	 $subjectClassesPreferredEndPeriod
     */
    public function GetSubjectClassesPreferredEndPeriod (){
        
        return $this->subjectClassesPreferredEndPeriod;
    }

    /**
     * GetSubjectClassesPreferredNumberDays method 
     *
     * @param 	
     * @return	 $subjectClassesPreferredNumberDays
     */
    public function GetSubjectClassesPreferredNumberDays (){
        
        return $this->subjectClassesPreferredNumberDays;
    }


    /**
     * GetSubjectClassesPreferredNumberPeriodsDay method 
     *
     * @param 	
     * @return	 $subjectClassesPreferredNumberPeriodsDay
     */
    public function GetSubjectClassesPreferredNumberPeriodsDay (){
        
        return $this->subjectClassesPreferredNumberPeriodsDay ;
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
        $_subjectId = $this->GetSubjectClassesSubjectID()->GetSubjectID();
        $_totalPeriodsPerWeek = $this->GetSubjectClassesSubjectID()->GetSubjectRequiredPeriod();
        $_numberDaysPerWeek=$this->GetSubjectClassesPreferredNumberDays();
        $_numberPeriodsPerDay = $this->GetSubjectClassesPreferredNumberPeriodsDay();
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
        $this->subjectClassesDistributionBlock = $dist;
        return true;
    }


    /**
     * GetSubjectClassesInformation method 
     *
     * @param 	none
     * @return	asso array SubjectClasses attributes
     */
    public function GetSubjectClassesInformation(){

        return [
                $this->subjectClassesID,
                $this->subjectClassesSubjectID,
                $this->subjectClassesTraineeGroupID,
                $this->subjectClassesTeacherID,
                $this->subjectClassesRoomID,

                $this->subjectClassesPreferredStartPeriod,
                $this->subjectClassesPreferredEndPeriod,
                $this->subjectClassesPreferredNumberDays,
                $this->subjectClassesDistributionBlock
                ];
    }

}


