<?php
namespace App\Controllers\Timetable;

class MeetingTime {
    /* 
     |--------------------------------------------------------------------------
     | MeetingTime
     |--------------------------------------------------------------------------
     | 
     | This class will hold the timeslots of all the subject in a timetable.  
     | id   SC_ID       timeslot
     | 0    1           0
     | 1    1           1 
     | 
     */

    private $id=null;
    private $subjectClass=null;
    private $timeslot = null;
    private $roomID = null;
    /*
     * ___construct method 
     *
     * @param		
     * @return	 	
     */
    public function __construct ($id=null, $subjectClass=null, $timeslot=null, $roomID = null){
        $this->id = $id;
        $this->subjectClass = $subjectClass;
        $this->timeslot = $timeslot;
        $this->roomID = $roomID;
        
    }


    /*
     * setTimeslot method 
     *
     * @param		
     * @return	 	
     */
    public function setTimeslot ($timeslot){
        $this->timeslot = $timeslot;
    }



    /*
     * getID method 
     *
     * @param		
     * @return	 	
     */
    public function getID (){
        
        return $this->id;
    }


    /*
     * getSubjectClass method 
     *
     * @param		
     * @return	 	
     */
    public function getSubjectClass (){
        
        return $this->subjectClass;
    }

    /*
     * getTimeslot method 
     *
     * @param		
     * @return	 	
     */
    public function getTimeslot (){
        
        return $this->timeslot;
    }

    /*
     * getRoomID method 
     *
     * @param		
     * @return	 	
     */
    public function getRoomID (){
        return $this->roomID;
    }






} 