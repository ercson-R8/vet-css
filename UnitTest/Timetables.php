<?php


/**
 * Timetables Model 
 * 
 * This class defines a chromosome (timetable). 
 * 
 * An "n" number of chromosomes will be created in a population
 * where Genetic Algorithm will be applied. 
 */

class Timetables{

    private $timetableID;
    private $timetableAcademicYear;
    private $timetableTerm;
    private $timetableDescription;
    private $timetableFitness; // number of conflicts
    /**
     * Constructor method 
     *
     * @param   $timetableID int: timetable ID number
     *          $timetableAcademicYear year: current academic year
     *          $timetableTerm int: current academic year term
     *          $timetableDescription int: remarks for this term/timetable
     * @return  none;
     */

    public function __construct ($timetableID = null, $timetableAcademicYear = null, 
                                    $timetableTerm = null, $timetableDescription = null,
                                    $timetableFitness = 1){
        $this->timetableID = $timetableID;
        $this->timetableAcademicYear = $timetableAcademicYear;
        $this->timetableTerm = $timetableTerm;
        $this->timetableDescription = $timetableDescription;
        $this->timetableFitness = $timetableFitness ;
        echo "from object tt fitness: ".$this->timetableFitness. "<br/>";
    }

    /**
     * SetTimetableID method 
     *
     * @param 	$timetableID int: timetable ID number
     * @return	 none;
     */
    public function SetTimetableID ($timetableID){
        
        $this->timetableID = $timetableID;
    }

    /**
     * SetTimetableAcademicYear method 
     *
     * @param 	timetableAcademicYear string: current academic year
     * @return	 none;
     */
    public function SetTimetableAcademicYear ($timetableAcademicYear){
        
        $this->timetableAcademicYear = $timetableAcademicYear;
    }

    /**
     * SetTimetableTerm method 
     *
     * @param 	$timetableTerm string: current academic year term
     * @return	 none;
     */
    public function SetTimetableTerm ($timetableTerm){
        
        $this->timetableTerm = $timetableTerm;
    }

    /**
     * SetTimetableDescription method 
     *
     * @param 	$timetableDescription int: remarks for this term/timetable
     * @return	 none;
     */
    public function SetTimetableDescription ($timetableDescription){
        
        $this->timetableDescription = $timetableDescription;
    }

    /**
     * SetTimetableFitness method 
     *
     * @param 	$timetableFitness int: pertains to conflicts;
     * @return	 none;
     */
    public function SetTimetableFitness ($timetableFitness){
        
        $this->timetableFitness = $timetableFitness;
    }




    /**
     * GetTimetableID method 
     *
     * @param 	none
     * @return	 $timetableID int: timetable ID number
     */
    public function GetTimetableID (){
        
        return $this->timetableID ;
    }

    /**
     * GetTimetableAcademicYear method 
     *
     * @param 	none
     * @return	 $timetableAcademicYear string: current academic year
     */
    public function GetTimetableAcademicYear (){
        
        return $this->timetableAcademicYear ;
    }

    /**
     * GetTimetableTerm method 
     *
     * @param 	none
     * @return	 $timetableTerm int: current academic year term
     */
    public function GetTimetableTerm (){
        
        return $this->timetableTerm ;
    }

    /**
     * GetTimetable method 
     *
     * @param 	none
     * @return	 $timetableDescription int: remarks for this term/timetable
     */
    public function GetTimetableDescription (){
        
        return $this->timetableDescription ;
    }

    /**
     * GetTimetableFitness method 
     *
     * @param 	none
     * @return	 $timetableFitness int: pertains to conflicts;;
     */
    public function GetTimetableFitness (){
        return $this->timetableFitness;
    }

    /**
     * GetTimetableInformation method 
     *
     * @param 	
     * @return	 
     */
    public function GetTimetableInformation (){
        
        return [$this->timetableID,
                $this->timetableAcademicYear,
                $this->timetableTerm,
                $this->timetableDescription,
                $this->timetableFitness
        ];
    }


}