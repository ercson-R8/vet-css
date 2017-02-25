<?php
namespace App\Controllers\Timetable;


class RoomType {
/* 
 |--------------------------------------------------------------------------
 | RoomType
 |--------------------------------------------------------------------------
 | 
 | This class provides a template to access data contained in the  
 | room_type table. 
 | 
 | This class will be used by the Timetable class. 
 | 
 */

    private $roomTypeID = null;
    private $roomTypeName = null;
    private $roomTypeDescription = null;
    
    /*
     * __constructor  method 
     *
     * @param		
     * @return	    none; 	
     */
    public function __construct ($roomTypeID = null, $roomTypeName = null, $roomTypeDescription = null){
        $this->roomTypeID = $roomTypeID;
        $this->roomTypeName = $roomTypeName;
        $this->roomTypeDescription  = $roomTypeDescription;

    }

    /**
     * getRoomTypeID method 
     *
     * @param		none
     * @return	 	int     this ID
     */
    public function getRoomTypeID (){
        return $this->roomTypeID;
    }

    /*
     * getRoomTypeName
     */
    public function getRoomTypeName (){
        
        return $this->roomTypeName;
        
    }


    /*
     * getRoomTypeDescription
     */
    public function getRoomTypeDescription (){
        
        return $this->roomTypeDescription;
        
    }

    /*
     * GetRoomTypeInformation
     */
    public function getRoomTypeInfo (){
        
        return [$this->roomTypeID, 
                $this->roomTypeName, 
                $this->roomTypeDescription
        ];
    }


}