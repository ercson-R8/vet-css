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
    const TOTAL_TIME_SLOTS = TimetableConfig::TOTAL_PERIODS * TimetableConfig::TOTAL_DAYS;  


    /**  
     * The number of timetables in a population
     * @var int 
     */
    const POP_SIZE = 200;


    /**  
     * Total number of generation 
     * @var int 
     */
    const MAX_GEN = 1000;


    /**  
     * The rate of mutation for a child timetable.
     * @var float 
     */
    const MUTATION_RATE = 0.05;   

    /**  
     * The rate of mutation for a child timetable.
     * @var float 
     */
    const CROSSOVER_RATE = 0.80; // 100% 


}


