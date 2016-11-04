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
    
    private $subjectClassID;
    private $subjectClassSubjectID;
    private $subjectClassTraineeGroupID;
    private $subjectClassTeacherID;
    private $subjectClassRoomID; 
    private $subjectClassPreferenceID;

    private $subjectClassDistributionBlock;

    private $isPossibleToDistribute = false;



    /**
     * Constructor method 
     *
     * @param   $subjectClassID                       int: subject class id number
     *          $subjectClassSubjectID                subjectClassSubjectID object: the subject of this subject_class
     *          $subjectClassTraineeGroupID           subjectClassTraineeGroupID object: the group who will attend this subject_class
     *          $subjectClassTeacherID                subjectClassTeacherID object: the teacher who will be teaching this subject_class
     *          $subjectClassRoomID                   subjectClassRoomID object: where this subject_class will be held
     *          $subjectClassPreferenceID             subjectClassPreferenceID object: the object that constains the preferences

     * @return  none;
     */

    public function __construct ($subjectClassID = null,  $subjectClassSubjectID = null ,$subjectClassTraineeGroupID = null, 
                                $subjectClassTeacherID = null, $subjectClassRoomID = null, $subjectClassPreferenceID = null){

        $this->subjectClassID = $subjectClassID;
        $this->subjectClassSubjectID = $subjectClassSubjectID;
        $this->subjectClassTraineeGroupID = $subjectClassTraineeGroupID;
        $this->subjectClassTeacherID = $subjectClassTeacherID;

        $this->subjectClassRoomID = $subjectClassRoomID;
        $this->subjectClassPreferenceID = $subjectClassPreferenceID;
        $this->isPossibleToDistribute = $this->DistributeBlockPeriods();


    }




    /**
     * SetSubjectClassID method 
     *
     * @param 	$subjectClassID
     * @return	 
     */
    public function SetSubjectClassID ($subjectClassID){
        
        $this->subjectClassID = $subjectClassID ;
    }

    /**
     * SetSubjectClassSubjectID method 
     *
     * @param 	$subjectClassSubjectID
     * @return	 
     */
    public function SetSubjectClassSubjectID ($subjectClassSubjectID){
        
        $this->subjectClassSubjectID = $subjectClassSubjectID ;
    }

    /**
     * SetSubjectClassTraineeGroupID method 
     *
     * @param 	$subjectClassTraineeGroupID
     * @return	 
     */
    public function SetSubjectClassTraineeGroupID ($subjectClassTraineeGroupID){
        
        $this->subjectClassTraineeGroupID = $subjectClassTraineeGroupID ;
    }

    /**
     * SetSubjectClassTeacherID method 
     *
     * @param 	$subjectClassTeacherID
     * @return	 
     */
    public function SetSubjectClassTeacherID ($subjectClassTeacherID){
        
        $this->subjectClassTeacherID = $subjectClassTeacherID ;
    }

    /**
     * SetSubjectClassRoomID method 
     *
     * @param 	$subjectClassRoomID
     * @return	 
     */
    public function SetSubjectClassRoomID ($subjectClassRoomID){
        
        $this->subjectClassRoomID = $subjectClassRoomID ;
    }


    // Getter methods

    /**
     * GetSubjectClassDistributionBlock method 
     *
     * @param 	
     * @return	 
     */
    public function GetSubjectClassDistributionBlock (){
        return $this->subjectClassDistributionBlock;
        return ;
    }


    /**
     * GetSubjectClassID method 
     *
     * @param 	
     * @return	 $subjectClassID
     */
    public function GetSubjectClassID (){
        
        return $this->subjectClassID ;
    }

    /**
     * GetSubjectClassSubjectID method 
     *
     * @param 	
     * @return	 $subjectClassSubjectID
     */
    public function GetSubjectClassSubjectID (){
        
        return $this->subjectClassSubjectID ;
    }

    /**
     * GetSubjectClassTraineeGroupID method 
     *
     * @param 	
     * @return	 $subjectClassTraineeGroupID
     */
    public function GetSubjectClassTraineeGroupID (){
        
        return $this->subjectClassTraineeGroupID;
    }

    /**
     * GetSubjectClassTeacherID method 
     *
     * @param 	
     * @return	 $subjectClassTeacherID
     */
    public function GetSubjectClassTeacherID (){
        
        return $this->subjectClassTeacherID;
    }

    /**
     * GetSubjectClassRoomID method 
     *
     * @param 	
     * @return	 $subjectClassRoomID
     */
    public function GetSubjectClassRoomID (){
        
        return $this->subjectClassRoomID ;
    }


    /**
     * GetSubjectClassPreferenceID method 
     *
     * @param 	
     * @return	 $subjectClassRoomID
     */
    public function GetSubjectClassPreferenceID (){
        
        return $this->subjectClassPreferenceID ;
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


        $_subjectId = $this->GetSubjectClassSubjectID()->GetSubjectID();
        $_subjectName = $this->GetSubjectClassSubjectID()->GetSubjectName();
        $_totalPeriodsPerWeek = $this->GetSubjectClassSubjectID()->GetSubjectRequiredPeriod();


        $_clID = $this->GetSubjectClassID();

        $_numberDaysPerWeek = $this->GetSubjectClassPreferenceID()->GetPreferencePreferredNumberDays();          
        $_numberPeriodsPerDay = $this->GetSubjectClassPreferenceID()->GetPreferencePreferredNumberPeriodsDay();
        if(DEBUG_INFO){
            echo "===========<br/><br/>Testing possibilities for Subject :<b>$_subjectName $_subjectId </b><br/>";
            echo "===========<br/><br/>Class ID : $_clID</b><br/>";
            echo "Total required number of periods: <b>$_totalPeriodsPerWeek</b><br/>";
            echo "Preferred number of days/week: <b>$_numberDaysPerWeek</b> <br/>";
            echo "Preferred number of periods/day: <b>$_numberPeriodsPerDay</b><br/>";
        }
            
        if (($_numberDaysPerWeek * $_numberPeriodsPerDay) < $_totalPeriodsPerWeek) {

            if(DEBUG_INFO)echo "<b> NOT POSSIBLE </b>to schedule  <br/><br/>";
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
                            if(DEBUG_INFO) echo "$isPossibleToDistribute NOT POSSIBLE<br/>";
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

            shuffle ($dist);
            foreach ($dist as $key => $value){
                $k = $key + 1;
                if(DEBUG_INFO)echo "Day$k : <b>$value </b>| ";
            }
            if(DEBUG_INFO)echo"<br/>";
        }
        $this->subjectClassDistributionBlock = $dist;
        return true;
    }


    /**
     * GetSubjectClassInformation method 
     *
     * @param 	none
     * @return	asso array SubjectClasses attributes
     */
    public function GetSubjectClassInformation(){

        return [
                $this->subjectClassID,
                $this->subjectClassSubjectID,
                $this->subjectClassTraineeGroupID,
                $this->subjectClassTeacherID,
                $this->subjectClassRoomID,
                $this->subjectClassDistributionBlock
                ];
    }

}


