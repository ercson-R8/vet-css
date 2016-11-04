<?php


/**
 * Schedule Model
 * 
 * This class defines attributes and methods required
 * to implement a chromosome (timetable). 
 * 
 * A SubjectClass can have one and only one schedule slot;
 * This class will be used by the Timetable object. 
 */

class Schedules{

    private $scheduleID;
    private $scheduleTimetableID;
    private $scheduleSubjectClassID;
    private $scheduleSlot;
    // private $scheduleConflicts; 

    /**
     * Constructor method 
     *
     * @param   $scheduleID         int: schedule id number
     *          $timetableID        Object: the timetable which this schedule belongs to
     *          $SchedulesSubjectClassID     SubjectClasses object: descriptive name for the subject
     *          $scheduleSlot       int: the required number of periods per week
     *          $scheduleConflicts  int: number of slot in conflict
     * @return  none;
     */

    public function __construct ($scheduleID = null, $scheduleTimetableID = null, 
                                    $scheduleSubjectClassID = null, $scheduleSlot = null){
        $this->scheduleID = $scheduleID;
        $this->scheduleTimetableID = $scheduleTimetableID;
        $this->scheduleSubjectClassID = $scheduleSubjectClassID;
        $this->scheduleSlot = $scheduleSlot;
        // $this->scheduleConflicts = 0;

    }


    /**
     * SetScheduleID method 
     *
     * @param 	$subjectID int: subject id number
     * @return	 none;
     */
    public function SetScheduleID ($scheduleID){
        
        $this->scheduleID =  $scheduleID;
    }

    /**
     * SetScheduleTimetableID method 
     *
     * @param 	$timetableID int: timetable id number
     * @return	 none;
     */
    public function SetScheduleTimetableID ($scheduleTimetableID){
        
        $this->scheduleTimetableID =  $scheduleTimetableID;
    }

    /**
     * SetSchedulesSubjectClassID method 
     *
     * @param 	$SchedulesSubjectClassID
     * @return	 none;
     */
    public function SetScheduleSubjectClassID ($SchedulesSubjectClassID){
        
        $this->SchedulesSubjectClassID = $SchedulesSubjectClassID;
    }

    /**
     * SetScheduleSlot method 
     *
     * @param 	$scheduleSlot
     * @return	 none;
     */
    public function SetScheduleSlot ($scheduleSlot){
        
        $this->scheduleSlot = $scheduleSlot ;
    }




    // Getters
    /**
     * GetScheduleID method 
     *
     * @param 	none;
     * @return	 $scheduleID
     */
    public function GetScheduleID (){
        
        return $this->scheduleID;
    }

    /**
     * GetScheduleTimetable method 
     *
     * @param 	none;
     * @return	 $TimetableID
     */
    public function GetScheduleTimetable (){
        
        return $this->scheduleTimetableID;
    }

    /**
     * GetSchedulesSubjectClassID method 
     *
     * @param 	none;
     * @return	 $SchedulesSubjectClassID
     */
    public function GetScheduleSubjectClassID (){
        
        return $this->scheduleSubjectClassID;
    }


    /**
     * GetScheduleSlot method 
     *
     * @param 	none;
     * @return	 $scheduleSlot
     */
    public function GetScheduleSlot (){
        
        return $this->scheduleSlot;
    }


    /**
     * GetScheduleInformation method 
     *
     * @param 	none
     * @return	asso array Schedule attributes
     */
    public function GetScheduleInformation(){

        return [$this->scheduleID, 
                $this->timetableID,
                $this->ScheduleSubjectClassID, 
                $this->scheduleSlot 
                ];
    }

}
