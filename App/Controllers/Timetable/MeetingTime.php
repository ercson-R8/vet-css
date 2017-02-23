<?php

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
    private $subjectClassID=null;
    private $timeslot = null;

    /*
     * ___construct method 
     *
     * @param		
     * @return	 	
     */
    public function ___construct ($id=null, $subjectClassID=null, $timeslot=[]){
        $this->id = $id;
        $this->subjectClassID = $subjectClassID;
        $this->timeslot = $timeslot;
        
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
     * getSubjectClassID method 
     *
     * @param		
     * @return	 	
     */
    public function getSubjectClassID (){
        
        return $this->subjectClassID;
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







} 