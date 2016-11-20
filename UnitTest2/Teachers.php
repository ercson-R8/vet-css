<?php

/**
 * Teacher Model
 * 
 * This class defines attributes and methods required
 * to implement a chromosome (timetable). 
 * 
 * This class will be used by the SubjectClasses object. 
 */

class Teachers{
        
        private $teacherID = null;
        private $teacherName = null;
        private $teacherDescription = null;


       /**
         * Constructor method 
         *
         * @param   $teacherID an interger ID number
         *          $teacherName string name of the teacher
         * @return  none;
         */
        public function __construct ( $teacherID = null, $teacherName = null, $teacherDescription = null ){
            $this->teacherName = $teacherName;
            $this->teacherID = $teacherID;
            $this->teacherDescription = $teacherDescription;
        }
        

        /**
         * SetTeacherID method 
         *
         * @param $teacherID an interger ID number
         * @return none;
         */
        public function SetTeacherID ($teacherID ){

            $this->teacherID = $teacherID;
        }

        /**
         * SetTeacherName method 
         *
         * @param $teacherName string name of the teacher
         * @return none;
         */
        public function SetTeacherName ($teacherName){

            $this->teacherName = $teacherName;
        }

        /**
         * SetTeacherDescription method 
         *
         * @param $teacherDescription string description of the teacher
         * @return none;
         */
        public function SetTeacherDescription ($teacherDescription){

            $this->teacherDescription = $teacherDescription;
        }
        /**
         * GetTeacherID method 
         *
         * @param none;
         * @return teacherID int teacher ID number
         */
        public function GetTeacherID (){

            return $this->teacherID;
        }

        /**
         * GetTeacherName method 
         *
         * @param none
         * @return teacherName string the name of the teacher
         */
        public function GetTeacherName (){
            
            return $this->teacherName;
        }

        /**
         * GetTeacherInformation method 
         *
         * @param none
         * @return asso array: teacher info
         */
        public function GetTeacherInformation (){
            
            return [$this->teacherID,
                    $this->teacherName,
                    $this->teacherDescription]
                    ;
        }
        

}