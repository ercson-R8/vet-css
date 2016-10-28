<?php


/**
 * Rooms Model
 * 
 * This class define attributes and methods required
 * to implement a chromosome (timetable). 
 * 
 * This class will be used by the SubjectClasses object. 
 */

class Rooms{

    private $roomID = null;
    private $roomName = null;
    private $roomType = null;
    private $roomLocation = null;

    /**
        * Constructor method 
        *
        * @param   $teacherID an interger ID number
        *          $teacherName string name of the teacher
        * @return  none;
        */
    public function __construct ($roomID = null, $roomName = null, $roomType = null, $roomLocation = null ){
        $this->roomID = $roomID;
        $this->roomName = $roomName;
        $this->roomType = $roomType;
        $this->roomLocation = $roomLocation;

    }

    /**
     * SetRoomID method 
     *
     * @param 	$roomID int room id
     * @return	none
     */
    public function SetRoomID ($roomID){
        $this->roomID = $roomID;
    }

    /**
     * SetRoomName method 
     * 
     * @param 	$roomName string name given to the room
     * @return	none
     */
    public function SetRoomName ($roomName){
        $this->roomName = $roomName;
    }

    /**
     * SetRoomType method 
     * 
     * @param 	$roomType string name given to the room
     * @return	none
     */
    public function SetRoomType ($roomType){
        $this->roomType = $roomType;
    }

    /**
     * SetRoomLocation method 
     * 
     * @param 	$roomType string name given to the room
     * @return	none
     */
    public function SetRoomLocation ($roomLocation){
        $this->roomLocation = $roomLocation;
    }

    /**
     * GetRoomID method 
     *
     * @param 	none
     * @return	$roomID int room id
     */
    public function GetRoomID (){
        return $this->roomID;
    }

    /**
     * GetRoomName method 
     *
     * @param 	$roomID int room id
     * @return	none
     */
    public function GetRoomName (){
        return $this->roomName;
    }

    /**
     * GetRoomType method 
     *
     * @param 	none
     * @return	$roomID int room id
     */
    public function GetRoomType (){
        return [$this->roomType];
    }

    /**
     * GetRoomLocation method 
     *
     * @param 	none
     * @return	$roomID int room id
     */
    public function GetRoomLocation(){
        return $this->roomLocation;
    }

    /**
     * GetRoomInformation method 
     *
     * @param 	none
     * @return	asso array room attributes
     */
    public function GetRoomInformation(){

        return [$this->roomID, 
                $this->roomName, 
                $this->roomType, 
                $this->roomLocation
                ];
    }


}