<?php
namespace App\Controllers\Timetable;


class Room {
/* 
 |--------------------------------------------------------------------------
 | Room
 |--------------------------------------------------------------------------
 | 
 | This class provides a template to access data contained in the  
 | trainee_group table. 
 | 
 | This class will be used by the Timetable class. 
 | 
 */

    private $roomID = null;
    private $roomName = null;
    private $roomType = null;
    private $roomLocation = null;
    private $roomDescription = null;
    
    /*
     * __constructor  method 
     *
     * @param		
     * @return	    none; 	
     */
    public function __construct ($roomID = null, $roomName = null, $roomType = null,
                                    $roomLocation = null, $roomDescription = null){
        $this->roomID = $roomID;
        $this->roomName = $roomName; 
        $this->roomType = $roomType;
        $this->roomLocation = $roomLocation;
        $this->roomDescription  = $roomDescription;

    }

    /**
     * getroomID method 
     *
     * @param		none
     * @return	 	int     this ID
     */
    public function getroomID (){
        return $this->roomID;
    }

    /*
     * getroomName
     */
    public function getroomName (){
        
        return $this->roomName;
        
    }

    /*
     * getroomType
     */
    public function getroomType (){
        
        return $this->roomType;
        
    }

    /*
     * getroomDescription
     */
    public function getroomDescription (){
        
        return $this->roomDescription ;
        
    }

    /*
     * getroomRemarks
     */
    public function getRoomRemarks (){
        
        return $this->roomRemarks;
        
    }


    /*
     * GetroomInformation
     */
    public function getRoomInfo (){
        
        return [$this->roomID, 
                $this->roomName, 
                $this->roomType,
                $this->roomDescription
        ];
    }


}