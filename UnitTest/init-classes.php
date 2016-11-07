<?php
    echo "<pre>";
        require "Subjects.php";
        require "traineeGroups.php";
        require "teachers.php";
        require "Preferences.php";
        require "Rooms.php";
        require "Schedules.php";
        require "Timetables.php";
        require "SubjectClasses.php";
        define("DEBUG_INFO", false);
        define("TOTAL_SLOTS", 10);          // per week
        define("TOTAL_PERIODS", 5);         // per day
        define("TOTAL_DAYS", 2);            // number of days per week
        define("POP_SIZE", 5);             // population size to be generated
        define("MAX_GEN", 2);               // max number of generations 



    // *********************************************************************
    function createSubjects(){   // Fetch Subjects

        $fileSubjects = file('../csv/Subjects.csv');
        $line = 0; // exclude the header. set to 1 to include headers
        foreach ($fileSubjects as $subject){
            // fetch all the data including the worksheet header;
            if($line > 0 ){
                list ($subjectID[],	$subjectCode[], $subjectName[],
                    $subjectRequiredPeriod[], $subjectDescription[] ) = explode(',' , $subject);
            }
            $line += 1;
        }
        $subject = [];
        for ( $i=0; $i < $line-1; $i++){
        $subject[$i] = new Subjects     ($subjectID[$i],             //subjectID
                                        $subjectCode[$i],           //subjectCode
                                        $subjectName[$i],           //SubjectName
                                        $subjectRequiredPeriod[$i], //subjectRequiredPeriod
                                        $subjectDescription[$i] );
        }
        if (DEBUG_INFO) echo print_r($subject);
        return $subject;
    }

    
    // *********************************************************************
    function createTraineeGroups(){   // Fetch Trainee groups

        $fileTrainees = file('../csv/traineeGroups.csv');
        $line = 0; // exclude the header. set to 1 to include headers
        foreach ($fileTrainees as $trainee){
            // fetch all the data including the worksheet header;
            if($line > 0 ){
                list ($traineeGroupID[],	
                    $traineeGroupName[],
                    $traineeGroupRemarks[],
                    $traineeGroupLevel[] ) = explode(',' , $trainee);
            }
            $line += 1;
        }
        $traineeGroup = [];
        for ( $i=0; $i < $line-1; $i++){
            $traineeGroup[$i] = new TraineeGroups (  $traineeGroupID[$i],             //subjectID
                                                $traineeGroupName[$i],           //subjectCode
                                                $traineeGroupRemarks[$i],           //SubjectName
                                                $traineeGroupLevel[$i] );

        }

        if (DEBUG_INFO) echo print_r($traineeGroup);
        return $traineeGroup;
    }

    
    // *********************************************************************
    function createTeachers(){   // Fetch Teachers
        
        $fileTeachers = file('../csv/teachers.csv');
        $line = 0; // exclude the header. set to 1 to include headers
        foreach ($fileTeachers as $teacher){
            // fetch all the data including the worksheet header;
            if($line > 0 ){
                list ($teacherID[],	$teacherName[], $teacherDescription[] ) = explode(',' , $teacher);
            }
            $line += 1;
        }
        $teacher = [];
        for ( $i=0; $i < $line-1; $i++){
            $teacher[$i] = new Teachers (   $teacherID[$i], $teacherName[$i], $teacherDescription[$i] );
        }
        if (DEBUG_INFO) echo print_r($teacher);
        return $teacher;
    }


    // *********************************************************************
    function createRooms(){   // Fetch Rooms
        
        $fileRooms = file('../csv/Rooms.csv');
        $line = 0; // exclude the header. set to 1 to include headers
        foreach ($fileRooms as $room){
            // fetch all the data including the worksheet header;
            if($line > 0 ){
                list ($roomID[], $roomName[], $roomType[], $roomLocation[]  ) = explode(',' , $room);
            }
            $line += 1;
        }
        $room = [];
        for ( $i=0; $i < $line-1; $i++){
            $room[$i] = new Rooms ( $roomID[$i], $roomName[$i], $roomType[$i], $roomLocation[$i]  );
        }
        if (DEBUG_INFO) echo print_r($room);
        return $room;
    }



    // *********************************************************************
    function createPreferences(){   // Fetch Preferences 
        
        $filePreferences = file('../csv/Preferences.csv');
        $line = 0; // exclude the header. set to 1 to include headers
        foreach ($filePreferences as $preference){
            // fetch all the data including the worksheet header;
            if($line > 0 ){
                list ($preferenceID[], $subjectID[], $traineeGroupID[], $teacherID[], 
                        $preferenceRoomType[], $preferencesPreferredStartPeriod[],
                        $preferencesPreferredEndPeriod[], $preferencesPreferredNumberDays[],
                         $preferencesPreferredNumberPeriodsDay[] ) = explode(',' , $preference);
            }
            $line += 1;
        }
        $preference = [];
        for ( $i=0; $i < $line-1; $i++){
            $preference[$i] = new Preferences ( $preferenceID[$i],  $subjectID[$i], $traineeGroupID[$i], $teacherID[$i], 
                                                $preferenceRoomType[$i], $preferencesPreferredStartPeriod[$i],
                                                $preferencesPreferredEndPeriod[$i], $preferencesPreferredNumberDays[$i],
                                                $preferencesPreferredNumberPeriodsDay[$i]);
        }
        if (DEBUG_INFO) echo print_r($preference);
        return $preference;

    }

    function getObjectID( $obj, $getter ){
        
        for ($j=0; $j < sizeof($obj); $j++){
            $localObj [] = $obj[$j]->$getter();
        }
        return $localObj;
    }


     // *********************************************************************
    function createObjects(){       // create objects required by timetable
        // initial objects


        $subject = createSubjects();
        $traineeGroup = createTraineeGroups();
        $teacher = createTeachers();
        $room = createRooms();
        $preference = createPreferences ();

        
        // get corresponding ID of objects 
        $tg = getObjectID ($traineeGroup, 'GetTraineeGroupID');
        $sb = getObjectID ($subject, 'GetSubjectID' );
        $tr = getObjectID ($teacher, 'GetTeacherID');


        // compose subject classess based on the above objects;
        for ($i = 0; $i < sizeof($preference); $i++){
                $subjectClass[$i] = new SubjectClasses ($i,
                                    $subject[array_search($preference[$i]->GetPreferenceSubjectID(),$sb,true) ],
                                    $traineeGroup[array_search($preference[$i]->GetPreferenceTraineeGroupID(),$tg,true)],
                                    $teacher[array_search($preference[$i]->GetPreferenceTeacherID(),$tr,true)],
                                    null,
                                    $preference [$i]
                                    );
        }


        return [$subject, $traineeGroup, $teacher, $room, $preference, $subjectClass];

    }




