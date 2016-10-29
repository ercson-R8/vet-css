<?php


/**
 * Schedules Model
 * 
 * This class defines attributes and methods required
 * to implement a chromosome (timetable). 
 * 
 * A SubjectClass can have one and only one schedule slot;
 * This class will be used by the Timetable object. 
 */

class Schedules{

    private $scheduleID;
    // private $timetableID;
    private $SchedulesSubjectClassID;
    private $scheduleSlot;
    // private $scheduleConflicts; 

    /**
     * Constructor method 
     *
     * @param   $scheduleID         int: schedule id number
     *          $timetableID        string: the timetable which this schedule belongs
     *          $SchedulesSubjectClassID     SubjectClasses object: descriptive name for the subject
     *          $scheduleSlot       int: the required number of periods per week
     *          $scheduleConflicts  int: number of slot in conflict
     * @return  none;
     */

    public function __construct ($scheduleID = null, $SchedulesSubjectClassID = null, $scheduleSlot = null){
        $this->scheduleID = $scheduleID;
        // $this->timetableID = $timetableID;
        $this->SchedulesSubjectClassID = $SchedulesSubjectClassID;
        $this->scheduleSlot = $scheduleSlot;
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
     * SetSchedulesSubjectClassID method 
     *
     * @param 	$SchedulesSubjectClassID
     * @return	 none;
     */
    public function SetSchedulesSubjectClassID ($SchedulesSubjectClassID){
        
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
     * GetSchedulesSubjectClassID method 
     *
     * @param 	none;
     * @return	 $SchedulesSubjectClassID
     */
    public function GetSchedulesSubjectClassID (){
        
        return $this->SchedulesSubjectClassID;
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
    public function GetSchedulesInformation(){

        return [$this->scheduleID, 
                $this->SchedulesSubjectClassID, 
                $this->scheduleSlot 
                ];
    }

}
