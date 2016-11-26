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
        define("TOTAL_PERIODS", 5);         // per day
        define("TOTAL_DAYS", 3);            // number of days per week
        define("TOTAL_SLOTS", TOTAL_PERIODS * TOTAL_DAYS );          // per week
        define("POP_SIZE", 5);             // population size to be generated
        define("MAX_GEN", 2);               // max number of generations 

        

    // *********************************************************************
    function createSubjects(){   // Fetch Subjects
        
        $fileSubjects = file('../csv/version2/Subjects.csv');
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

        $fileTrainees = file('../csv/version2/traineeGroups.csv');
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
        
        $fileTeachers = file('../csv/version2/teachers.csv');
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
        
        $fileRooms = file('../csv/version2/Rooms.csv');
        $line = 0; // exclude the header. set to 1 to include headers
        foreach ($fileRooms as $room){
            // fetch all the data including the worksheet header;
            if($line > 0 ){
                list ($roomID[], $roomName[], $roomType[], $roomLocation[]  ) = explode(',' , $room);
            }
            $line += 1;
        }
        $rooms = [];
        for ( $i=0; $i < $line-1; $i++){
            $rooms[$i] = new Rooms( $roomID[$i], $roomName[$i], $roomType[$i], $roomLocation[$i]  );
        }
        if (DEBUG_INFO) echo print_r($rooms);
        return $rooms;
    }


    // *********************************************************************
    function createPreferences(){   // Fetch Preferences 
        
        $filePreferences = file('../csv/version2/Preferences.csv');
        $line = 0; // exclude the header. set to 1 to include headers
        foreach ($filePreferences as $preference){
            // fetch all the data including the worksheet header;
            if($line > 0 ){
                list ($preferenceID[], $preferenceRoomType[], $preferencesPreferredStartPeriod[],
                        $preferencesPreferredEndPeriod[], $preferencesPreferredNumberDays[],
                         $preferencesPreferredNumberPeriodsDay[] ) = explode(',' , $preference);
            }
            $line += 1;
        }
        $preference = [];
        for ( $i=0; $i < $line-1; $i++){
            $preference[$i] = new Preferences ( $preferenceID[$i], $preferenceRoomType[$i], $preferencesPreferredStartPeriod[$i],
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
    function createSubjecClasses(){       // create objects required by timetable
        // initialize objects
        // the create functions will return an array of objects 

        $subjects = createSubjects();
        $traineeGroups = createTraineeGroups();
        $teachers = createTeachers();
        $rooms = createRooms();
        $preferences = createPreferences ();
        
        // get corresponding IDs of objects and store in a.array 
        $tg = getObjectID ($traineeGroups, 'GetTraineeGroupID');
        $sb = getObjectID ($subjects, 'GetSubjectID' );
        $tr = getObjectID ($teachers, 'GetTeacherID');


        // open csv file
        $fileSubjectClasses = file('../csv/version2/SubjectClasses.csv');
        $line = 0; // exclude the header. set to 1 to include headers
        foreach ($fileSubjectClasses as $SubjectClass){
            // fetch all the data including the worksheet header;
            if($line > 0 ){
                list ($subjectClassID[], $subjectID[], $traineeGroupID[],
                        $teacherID[], $roomID[], $preferenceID[] ) = explode(',' , $SubjectClass);
            }
            $line += 1;
        }

        // print_r ( array_search (  $subjectID[0], $sb, true   )     );
        // print_r ($subjects [array_search (  $subjectID[0], $sb, true   )]); 
        //echo "size of preferences ". (sizeof($preferences));

        // compose subject classess based on the above objects;
        //  array_search(value,array,strict)

        $SubjectClass = [];
        for ($i = 0; $i < sizeof($preferences); $i++){

            // search the array (subjectID, traineeGroupID, teacherID) 
            // and match the key to the array of objects (subjects,traineeGroups,teachers )
            // to get the appropriate object
            $SubjectClass[$i] = new SubjectClasses ($i,
                                $subjects[array_search($subjectID[$i], $sb,true) ],
                                $traineeGroups[array_search($traineeGroupID[$i],$tg,true)],
                                $teachers[array_search($teacherID[$i],$tr,true)],
                                null,
                                $preferences [$i]
                                );
        }
        if (DEBUG_INFO) echo print_r($SubjectClass);
        return $SubjectClass;

    }
    

//createObjects();