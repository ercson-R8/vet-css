<?php
namespace App;

class TimetableConfig {
    /* 
     |--------------------------------------------------------------------------
     | TimetableConfig
     |--------------------------------------------------------------------------
     | 
     | This class contains the settings use to build a timetable.  
     | 
     | 
     | 
     | 
     */

     /**  
     * Total periods per day
     * @var int
     */
    const TOTAL_PERIODS = 8;

     /**  
     * Total number of training days per week
     * @var int 
     */
    const TOTAL_DAYS = 5;
    
     /**  
     * Total number of training days per week
     * @var int 
     */
    const TOTAL_TIME_SLOTS = TimetableConfig::TOTAL_PERIODS * TimetableConfig::TOTAL_DAYS;  


    /**  
     * The number of timetables in a population
     * @var int 
     */
    const POP_SIZE = 500;


    /**  
     * Total number of generation 
     * @var int 
     */
    const MAX_GEN = 5000;


    /**  
     * The rate of mutation for a child timetable.
     * @var float 
     */
    const MUTATION_RATE = 0.01;

    /**  
     * The rate of crossover for a set of timetables. 
     * @var float 
     */
    const CROSSOVER_RATE = 0.90;

    /**  
     * The number of elites to be kept in the population. 
     * @var int 
     */
    const ELITISM = 5; 

    /**  
     * The number of generations with stagnant individual 
     * @var int 
     */
    const MAX_STAGNANT = 500; 


}


