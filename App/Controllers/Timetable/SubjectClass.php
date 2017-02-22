<?php 
namespace App\Controllers\Timetable;

class SubjectClass {
    /* 
    |--------------------------------------------------------------------------
    | SubjectClass
    |--------------------------------------------------------------------------
    | 
    | This class provides a template to access data contained in the  
    | subject_class table. 
    | 
    | This class will be used by the Timetable class
    | 
    */

    private $id,
            $timeTableID, 
            $subject,         // object of Subject class
            $traineeGroup,    // object of TraineeGroup class
            $instructor,      // object of Instructor class
            $room,            // object of Room class
            $roomType,          // object of RoomType class
            // $meetingTime,
            $preferredStart,
            $preferredEnd,
            $preferredNumberOfDays;
    private $isRoomFixed = false;

    /*
     * ___construct method 
     *
     * @param		
     * @return	 	
     */
    public function __construct (  $id = null,
                                    $timeTableID = null,
                                    $subject = null,
                                    $traineeGroup = null,
                                    $instructor = null,
                                    $roomType = null,
                                    $room = null,
                                    // $meetingTime= null,
                                    $preferredStart = null,
                                    $preferredEnd = null,
                                    $preferredNumberOfDays = null){
        
        $this->id = $id; 
        $this->timeTableID =$timeTableID;
        $this->subject = $subject;
        $this->traineeGroup = $traineeGroup;
        $this->instructor = $instructor;
        $this->room = $room;
        $this->roomType = $roomType;
        // $this->meetingTime = $meetingTime;
        $this->preferredStart = $preferredStart;
        $this->preferredEnd = $preferredEnd;
        $this->preferredNumberOfDays = $preferredNumberOfDays; 


    }

    /*
     * setRoomFixed method 
     *
     * @param		
     * @return	 	
     */
    public function setRoomFixed ($fixed){
        if($fixed){
            $this->isRoomFixed = true;
        }else{
            $this->isRoomFixed = false;
        }
        return ;
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
     * getTimetableID method 
     *
     * @param		
     * @return	 	
     */
    public function getTimetableID (){
        
        return $this->timetableID ;
    }

    /*
     * getSubject method 
     *
     * @param		
     * @return	 	
     */
    public function getSubject (){
        return $this->subject;
    }
    
    /*
     * getTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function getTraineeGroup (){
        return $this->traineeGroup;
    }

    /*
     * getInstructor method 
     *
     * @param		
     * @return	 	
     */
    public function getInstructor (){
        return $this->instructor;
    }

    /*
     * getRoom method 
     *
     * @param		
     * @return	 	
     */
    public function getRoom (){

        return $this->room;
    }

    /*
     * getMeetingTime method 
     *
     * @param		
     * @return	 	array   the slot number/s for this class
     */
    public function getMeetingTime (){
        return explode(',' ,$this->meetingTime);
    }

    /*
     * getPreferredStart method 
     *
     * @param		
     * @return	 	
     */
    public function getPreferredStart (){
        return $this->preferredStart;
    }

    /*
     * getPreferredEnd method 
     *
     * @param		
     * @return	 	
     */
    public function getPreferredEnd (){
        return $this->preferredEnd;
        return ;
    }

    /*
     * getPreferredNumberOfDays method 
     *
     * @param		
     * @return	 	
     */
    public function getPreferredNumberOfDays (){
        return $this->preferredNumberOfDays;
        return ;
    }

    /*
     * isRoomFixed method 
     *
     * @param		
     * @return	 	true if unchangeable, otherwise false
     */
    public function isRoomFixed (){
        return $this->isRoomFixed;
    }


}