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
     * getroomTypeID method 
     *
     * @param		none
     * @return	 	int     this ID
     */
    public function getroomTypeID (){
        return $this->roomTypeID;
    }

    /*
     * getroomTypeName
     */
    public function getroomTypeName (){
        
        return $this->roomTypeName;
        
    }

    /*
     * getroomTypeType
     */
    public function getroomTypeType (){
        
        return $this->roomTypeType;
        
    }

    /*
     * getroomTypeDescription
     */
    public function getroomTypeDescription (){
        
        return $this->roomTypeDescription;
        
    }

    /*
     * GetroomTypeInformation
     */
    public function getroomTypeInfo (){
        
        return [$this->roomTypeID, 
                $this->roomTypeName, 
                $this->roomTypeDescription
        ];
    }


}