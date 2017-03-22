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
            $room_fixed,
            $roomType,          // object of RoomType class
            $preferredStart,
            $preferredEnd,
            $preferredNumberOfDays;
    private $isRoomFixed = false;
    // private $subjectObject,
    //         $traineeGroupObject,
    //         $instructorObject,
    //         $roomTypeObject,
    //         $roomObject;

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
                                    $room_fixed = null,
                                    $preferredStart = null,
                                    $preferredEnd = null,
                                    $preferredNumberOfDays = null){

        // $this->subjectObject = new Subject();
        // $this->traineeGroupObject = new TraineeGroup();
        // $this->instructorObject = new Instructor();
        // $this->roomTypeObject = new Roomtype();
        // $this->roomObject = new Room();
        
        $this->id = $id; 
        $this->timeTableID =$timeTableID;
        $this->subject = $subject;
        $this->traineeGroup = $traineeGroup;
        $this->instructor = $instructor;
        $this->room = $room;
        $this->roomType = $roomType;
        $this->room_fixed = $room_fixed;
        $this->preferredStart = $preferredStart;
        $this->preferredEnd = $preferredEnd;
        $this->preferredNumberOfDays = $preferredNumberOfDays; 


    }

    public function __clone() {
        // $this->subjectObject = clone $this->subjectObject;
        // $this->traineeGroupObject = clone $this->traineeGroupObject;
        // $this->instructorObject = clone $this->instructorObject;
        // $this->roomTypeObject = clone $this->roomTypeObject;
        // $this->roomObject = clone $this->roomObject;
    
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
     * setRoom method 
     *
     * @param		
     * @return	 	
     */
    public function setRoom ($room){
        
        return $this->room = $room;
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
     * getRoomType method 
     *
     * @param		
     * @return	 	
     */
    public function getRoomType (){

        return $this->roomType;
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