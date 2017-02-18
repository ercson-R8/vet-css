<?php
namespace App;

class TimetableConfig {
    /* 
     |--------------------------------------------------------------------------
     | TimetableConfig
     |--------------------------------------------------------------------------
     | 
     | This class contains the settings used to build a timetable.  
     | 
     | 
     | 
     | 
     */

     /**  
     * Total periods per day
     * @var int
     */
    const TOTAL_PERIODS = 5;

     /**  
     * Total number of training days per week
     * @var int 
     */
    const TOTAL_DAYS = 3;
    
     /**  
     * Total number of training days per week
     * @var int 
     */
    const TOTAL_TIME_SLOTS = TimetableConfig::TOTAL_PERIODS * TimetableConfig::TOTAL_DAYS - 1;  


    /**  
     * The number of timetables in a population
     * @var int 
     */
    const POP_SIZE = 20;



    /**  
     * Total number of generation 
     * @var int 
     */
    const MAX_GEN = 50;


    /**  
     * The rate of mutation for a child timetable.
     * @var float 
     */
    const MUTATION_RATE = 0.5;   


}


