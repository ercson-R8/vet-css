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

    private $ID = null;
    private $name = null;
    private $type = null;
    private $location = null;
    private $description = null;
    
    /*
     * __constructor  method 
     *
     * @param		
     * @return	    none; 	
     */
    public function __construct ($ID = null, $name = null, $type = null,
                                    $location = null, $description = null){
        $this->ID = $ID;
        // room 4 is designated canteen
        $this->name = ($ID == 4 ? null : $name); 
        $this->type = $type;
        $this->location = $location;
        $this->description  = $description;

    }

    /**
     * getID method 
     *
     * @param		none
     * @return	 	int     this ID
     */
    public function getID (){
        return $this->ID;
    }

    /*
     * getname
     */
    public function getName (){
        
        return $this->name;
        
    }

    /*
     * gettype
     */
    public function getType (){
        
        return $this->type;
        
    }

    /*
     * getdescription
     */
    public function getDescription (){
        
        return $this->description ;
        
    }



    /*
     * GetroomInformation
     */
    public function getRoomInfo (){
        
        return [$this->ID, 
                $this->name, 
                $this->type,
                $this->description
        ];
    }


}