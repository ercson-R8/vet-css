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
        // the 'create'' functions will return an array of objects 

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
        // array_search(value,array,strict)

        $SubjectClass = [];
        for ($i = 0; $i < sizeof($preferences); $i++){

            // search the array (subjectID, traineeGroupID, teacherID) 
            // and match the key to the array of objects (subjects,traineeGroups,teachers )
            // to get the appropriate object
            if ($roomID[$i]== ""){
                // echo "<br>room not specified<br/>";
                $roomID[$i] = null;
            }
            $SubjectClass[$i] = new SubjectClasses ($i,
                                $subjects[array_search($subjectID[$i], $sb,true) ],
                                $traineeGroups[array_search($traineeGroupID[$i],$tg,true)],
                                $teachers[array_search($teacherID[$i],$tr,true)],
                                $roomID[$i],
                                $preferences [$i]
                                );
        }
        if (DEBUG_INFO) echo print_r($SubjectClass);
        return $SubjectClass;

    }
    

//createObjects();
/* dump 
Array
(
    [0] => Rooms Object
        (
            [roomID:Rooms:private] => 401
            [roomName:Rooms:private] => Room 1
            [roomType:Rooms:private] => Classroom
            [roomLocation:Rooms:private] => Bldg 1

        )

    [1] => Rooms Object
        (
            [roomID:Rooms:private] => 402
            [roomName:Rooms:private] => Room 2
            [roomType:Rooms:private] => Classroom
            [roomLocation:Rooms:private] => Bldg 2

        )

    [2] => Rooms Object
        (
            [roomID:Rooms:private] => 403
            [roomName:Rooms:private] => ComLab 1
            [roomType:Rooms:private] => ComputerLab
            [roomLocation:Rooms:private] => Bldg 1

        )

    [3] => Rooms Object
        (
            [roomID:Rooms:private] => 404
            [roomName:Rooms:private] => ComLab 2
            [roomType:Rooms:private] => ComputerLab
            [roomLocation:Rooms:private] => Bldg 1

        )

)
10Array
(
    [0] => Subjects Object
        (
            [subjectID:Subjects:private] => 101
            [subjectCode:Subjects:private] => MATH101
            [subjectName:Subjects:private] => Basic Math
            [subjectRequiredPeriod:Subjects:private] => 2
            [subjectDescription:Subjects:private] => Basic Math

        )

    [1] => Subjects Object
        (
            [subjectID:Subjects:private] => 102
            [subjectCode:Subjects:private] => PolSci101
            [subjectName:Subjects:private] => PolSci
            [subjectRequiredPeriod:Subjects:private] => 2
            [subjectDescription:Subjects:private] => Political Science

        )

    [2] => Subjects Object
        (
            [subjectID:Subjects:private] => 103
            [subjectCode:Subjects:private] => ENGL101
            [subjectName:Subjects:private] => Basic English
            [subjectRequiredPeriod:Subjects:private] => 4
            [subjectDescription:Subjects:private] => Basic English

        )

)
1Array
(
    [0] => TraineeGroups Object
        (
            [traineeGroupID:TraineeGroups:private] => 201
            [traineeGroupName:TraineeGroups:private] => Electronics
            [traineeGroupRemarks:TraineeGroups:private] => Group A
            [traineeGroupLevel:TraineeGroups:private] => 1

        )

    [1] => TraineeGroups Object
        (
            [traineeGroupID:TraineeGroups:private] => 202
            [traineeGroupName:TraineeGroups:private] => Mechtronics
            [traineeGroupRemarks:TraineeGroups:private] => Group A
            [traineeGroupLevel:TraineeGroups:private] => 1

        )

)
1Array
(
    [0] => Teachers Object
        (
            [teacherID:Teachers:private] => 301
            [teacherName:Teachers:private] => John
            [teacherDescription:Teachers:private] => Math teacher

        )

    [1] => Teachers Object
        (
            [teacherID:Teachers:private] => 302
            [teacherName:Teachers:private] => Paul
            [teacherDescription:Teachers:private] => PolSci teacher

        )

    [2] => Teachers Object
        (
            [teacherID:Teachers:private] => 303
            [teacherName:Teachers:private] => James
            [teacherDescription:Teachers:private] => English teacher

        )

    [3] => Teachers Object
        (
            [teacherID:Teachers:private] => 304
            [teacherName:Teachers:private] => Peter
            [teacherDescription:Teachers:private] => Bio teacher

        )

)
1Array
(
    [0] => Rooms Object
        (
            [roomID:Rooms:private] => 401
            [roomName:Rooms:private] => Room 1
            [roomType:Rooms:private] => Classroom
            [roomLocation:Rooms:private] => Bldg 1

        )

    [1] => Rooms Object
        (
            [roomID:Rooms:private] => 402
            [roomName:Rooms:private] => Room 2
            [roomType:Rooms:private] => Classroom
            [roomLocation:Rooms:private] => Bldg 2

        )

    [2] => Rooms Object
        (
            [roomID:Rooms:private] => 403
            [roomName:Rooms:private] => ComLab 1
            [roomType:Rooms:private] => ComputerLab
            [roomLocation:Rooms:private] => Bldg 1

        )

    [3] => Rooms Object
        (
            [roomID:Rooms:private] => 404
            [roomName:Rooms:private] => ComLab 2
            [roomType:Rooms:private] => ComputerLab
            [roomLocation:Rooms:private] => Bldg 1

        )

)
1Array
(
    [0] => Preferences Object
        (
            [preferencesID:Preferences:private] => 0
            [preferenceRoomType:Preferences:private] => Classroom
            [preferencePreferredStartPeriod:Preferences:private] => 1
            [preferencePreferredEndPeriod:Preferences:private] => 5
            [preferencePreferredNumberDays:Preferences:private] => 1
            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

        )

    [1] => Preferences Object
        (
            [preferencesID:Preferences:private] => 1
            [preferenceRoomType:Preferences:private] => Classroom
            [preferencePreferredStartPeriod:Preferences:private] => 1
            [preferencePreferredEndPeriod:Preferences:private] => 5
            [preferencePreferredNumberDays:Preferences:private] => 1
            [preferencePreferredNumberPeriodsDay:Preferences:private] => 4

        )

    [2] => Preferences Object
        (
            [preferencesID:Preferences:private] => 2
            [preferenceRoomType:Preferences:private] => Classroom
            [preferencePreferredStartPeriod:Preferences:private] => 1
            [preferencePreferredEndPeriod:Preferences:private] => 5
            [preferencePreferredNumberDays:Preferences:private] => 1
            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

        )

    [3] => Preferences Object
        (
            [preferencesID:Preferences:private] => 3
            [preferenceRoomType:Preferences:private] => Classroom
            [preferencePreferredStartPeriod:Preferences:private] => 1
            [preferencePreferredEndPeriod:Preferences:private] => 5
            [preferencePreferredNumberDays:Preferences:private] => 2
            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

        )

    [4] => Preferences Object
        (
            [preferencesID:Preferences:private] => 4
            [preferenceRoomType:Preferences:private] => Classroom
            [preferencePreferredStartPeriod:Preferences:private] => 1
            [preferencePreferredEndPeriod:Preferences:private] => 5
            [preferencePreferredNumberDays:Preferences:private] => 1
            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

        )

    [5] => Preferences Object
        (
            [preferencesID:Preferences:private] => 5
            [preferenceRoomType:Preferences:private] => ComputerLab
            [preferencePreferredStartPeriod:Preferences:private] => 1
            [preferencePreferredEndPeriod:Preferences:private] => 5
            [preferencePreferredNumberDays:Preferences:private] => 1
            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

        )

)
1===========

Testing possibilities for Subject :Basic Math
===========

Class ID : 0
Total required number of periods: 2
Preferred number of days/week: 1 
Preferred number of periods/day: 2

Day1 : 2  
===========

Testing possibilities for Subject :Basic English
===========

Class ID : 1
Total required number of periods: 4
Preferred number of days/week: 1 
Preferred number of periods/day: 4

Day1 : 4  
===========

Testing possibilities for Subject :PolSci
===========

Class ID : 2
Total required number of periods: 2
Preferred number of days/week: 1 
Preferred number of periods/day: 2

Day1 : 2  
===========

Testing possibilities for Subject :Basic English
===========

Class ID : 3
Total required number of periods: 4
Preferred number of days/week: 2 
Preferred number of periods/day: 2

Day1 : 2  Day2 : 2  
===========

Testing possibilities for Subject :Basic Math
===========

Class ID : 4
Total required number of periods: 2
Preferred number of days/week: 1 
Preferred number of periods/day: 2

Day1 : 2  
===========

Testing possibilities for Subject :PolSci
===========

Class ID : 5
Total required number of periods: 2
Preferred number of days/week: 1 
Preferred number of periods/day: 2

Day1 : 2  
Array
(
    [0] => SubjectClasses Object
        (
            [subjectClassID:SubjectClasses:private] => 0
            [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                (
                    [subjectID:Subjects:private] => 101
                    [subjectCode:Subjects:private] => MATH101
                    [subjectName:Subjects:private] => Basic Math
                    [subjectRequiredPeriod:Subjects:private] => 2
                    [subjectDescription:Subjects:private] => Basic Math

                )

            [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                (
                    [traineeGroupID:TraineeGroups:private] => 201
                    [traineeGroupName:TraineeGroups:private] => Electronics
                    [traineeGroupRemarks:TraineeGroups:private] => Group A
                    [traineeGroupLevel:TraineeGroups:private] => 1

                )

            [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                (
                    [teacherID:Teachers:private] => 301
                    [teacherName:Teachers:private] => John
                    [teacherDescription:Teachers:private] => Math teacher

                )

            [subjectClassRoomID:SubjectClasses:private] => 404
            [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                (
                    [preferencesID:Preferences:private] => 0
                    [preferenceRoomType:Preferences:private] => Classroom
                    [preferencePreferredStartPeriod:Preferences:private] => 1
                    [preferencePreferredEndPeriod:Preferences:private] => 5
                    [preferencePreferredNumberDays:Preferences:private] => 1
                    [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                )

            [subjectClassDistributionBlock:SubjectClasses:private] => Array
                (
                    [0] => 2
                )

            [isPossibleToDistribute:SubjectClasses:private] => 1
        )

    [1] => SubjectClasses Object
        (
            [subjectClassID:SubjectClasses:private] => 1
            [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                (
                    [subjectID:Subjects:private] => 103
                    [subjectCode:Subjects:private] => ENGL101
                    [subjectName:Subjects:private] => Basic English
                    [subjectRequiredPeriod:Subjects:private] => 4
                    [subjectDescription:Subjects:private] => Basic English

                )

            [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                (
                    [traineeGroupID:TraineeGroups:private] => 201
                    [traineeGroupName:TraineeGroups:private] => Electronics
                    [traineeGroupRemarks:TraineeGroups:private] => Group A
                    [traineeGroupLevel:TraineeGroups:private] => 1

                )

            [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                (
                    [teacherID:Teachers:private] => 303
                    [teacherName:Teachers:private] => James
                    [teacherDescription:Teachers:private] => English teacher

                )

            [subjectClassRoomID:SubjectClasses:private] => 
            [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                (
                    [preferencesID:Preferences:private] => 1
                    [preferenceRoomType:Preferences:private] => Classroom
                    [preferencePreferredStartPeriod:Preferences:private] => 1
                    [preferencePreferredEndPeriod:Preferences:private] => 5
                    [preferencePreferredNumberDays:Preferences:private] => 1
                    [preferencePreferredNumberPeriodsDay:Preferences:private] => 4

                )

            [subjectClassDistributionBlock:SubjectClasses:private] => Array
                (
                    [0] => 4
                )

            [isPossibleToDistribute:SubjectClasses:private] => 1
        )

    [2] => SubjectClasses Object
        (
            [subjectClassID:SubjectClasses:private] => 2
            [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                (
                    [subjectID:Subjects:private] => 102
                    [subjectCode:Subjects:private] => PolSci101
                    [subjectName:Subjects:private] => PolSci
                    [subjectRequiredPeriod:Subjects:private] => 2
                    [subjectDescription:Subjects:private] => Political Science

                )

            [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                (
                    [traineeGroupID:TraineeGroups:private] => 201
                    [traineeGroupName:TraineeGroups:private] => Electronics
                    [traineeGroupRemarks:TraineeGroups:private] => Group A
                    [traineeGroupLevel:TraineeGroups:private] => 1

                )

            [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                (
                    [teacherID:Teachers:private] => 302
                    [teacherName:Teachers:private] => Paul
                    [teacherDescription:Teachers:private] => PolSci teacher

                )

            [subjectClassRoomID:SubjectClasses:private] => 
            [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                (
                    [preferencesID:Preferences:private] => 2
                    [preferenceRoomType:Preferences:private] => Classroom
                    [preferencePreferredStartPeriod:Preferences:private] => 1
                    [preferencePreferredEndPeriod:Preferences:private] => 5
                    [preferencePreferredNumberDays:Preferences:private] => 1
                    [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                )

            [subjectClassDistributionBlock:SubjectClasses:private] => Array
                (
                    [0] => 2
                )

            [isPossibleToDistribute:SubjectClasses:private] => 1
        )

    [3] => SubjectClasses Object
        (
            [subjectClassID:SubjectClasses:private] => 3
            [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                (
                    [subjectID:Subjects:private] => 103
                    [subjectCode:Subjects:private] => ENGL101
                    [subjectName:Subjects:private] => Basic English
                    [subjectRequiredPeriod:Subjects:private] => 4
                    [subjectDescription:Subjects:private] => Basic English

                )

            [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                (
                    [traineeGroupID:TraineeGroups:private] => 202
                    [traineeGroupName:TraineeGroups:private] => Mechtronics
                    [traineeGroupRemarks:TraineeGroups:private] => Group A
                    [traineeGroupLevel:TraineeGroups:private] => 1

                )

            [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                (
                    [teacherID:Teachers:private] => 303
                    [teacherName:Teachers:private] => James
                    [teacherDescription:Teachers:private] => English teacher

                )

            [subjectClassRoomID:SubjectClasses:private] => 
            [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                (
                    [preferencesID:Preferences:private] => 3
                    [preferenceRoomType:Preferences:private] => Classroom
                    [preferencePreferredStartPeriod:Preferences:private] => 1
                    [preferencePreferredEndPeriod:Preferences:private] => 5
                    [preferencePreferredNumberDays:Preferences:private] => 2
                    [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                )

            [subjectClassDistributionBlock:SubjectClasses:private] => Array
                (
                    [0] => 2
                    [1] => 2
                )

            [isPossibleToDistribute:SubjectClasses:private] => 1
        )

    [4] => SubjectClasses Object
        (
            [subjectClassID:SubjectClasses:private] => 4
            [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                (
                    [subjectID:Subjects:private] => 101
                    [subjectCode:Subjects:private] => MATH101
                    [subjectName:Subjects:private] => Basic Math
                    [subjectRequiredPeriod:Subjects:private] => 2
                    [subjectDescription:Subjects:private] => Basic Math

                )

            [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                (
                    [traineeGroupID:TraineeGroups:private] => 202
                    [traineeGroupName:TraineeGroups:private] => Mechtronics
                    [traineeGroupRemarks:TraineeGroups:private] => Group A
                    [traineeGroupLevel:TraineeGroups:private] => 1

                )

            [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                (
                    [teacherID:Teachers:private] => 301
                    [teacherName:Teachers:private] => John
                    [teacherDescription:Teachers:private] => Math teacher

                )

            [subjectClassRoomID:SubjectClasses:private] => 
            [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                (
                    [preferencesID:Preferences:private] => 4
                    [preferenceRoomType:Preferences:private] => Classroom
                    [preferencePreferredStartPeriod:Preferences:private] => 1
                    [preferencePreferredEndPeriod:Preferences:private] => 5
                    [preferencePreferredNumberDays:Preferences:private] => 1
                    [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                )

            [subjectClassDistributionBlock:SubjectClasses:private] => Array
                (
                    [0] => 2
                )

            [isPossibleToDistribute:SubjectClasses:private] => 1
        )

    [5] => SubjectClasses Object
        (
            [subjectClassID:SubjectClasses:private] => 5
            [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                (
                    [subjectID:Subjects:private] => 102
                    [subjectCode:Subjects:private] => PolSci101
                    [subjectName:Subjects:private] => PolSci
                    [subjectRequiredPeriod:Subjects:private] => 2
                    [subjectDescription:Subjects:private] => Political Science

                )

            [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                (
                    [traineeGroupID:TraineeGroups:private] => 202
                    [traineeGroupName:TraineeGroups:private] => Mechtronics
                    [traineeGroupRemarks:TraineeGroups:private] => Group A
                    [traineeGroupLevel:TraineeGroups:private] => 1

                )

            [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                (
                    [teacherID:Teachers:private] => 302
                    [teacherName:Teachers:private] => Paul
                    [teacherDescription:Teachers:private] => PolSci teacher

                )

            [subjectClassRoomID:SubjectClasses:private] => 
            [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                (
                    [preferencesID:Preferences:private] => 5
                    [preferenceRoomType:Preferences:private] => ComputerLab
                    [preferencePreferredStartPeriod:Preferences:private] => 1
                    [preferencePreferredEndPeriod:Preferences:private] => 5
                    [preferencePreferredNumberDays:Preferences:private] => 1
                    [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                )

            [subjectClassDistributionBlock:SubjectClasses:private] => Array
                (
                    [0] => 2
                )

            [isPossibleToDistribute:SubjectClasses:private] => 1
        )

)
1
======================== <<0>> =======================================
Subject:	Basic Math
Req. Period:	2
Group:		Electronics
Teacher:	John
Pref. Rm type:	Classroom
Pref. duration:	1 day/s
Room selected:  ComLab 2
Dist block:	
[day] => [no. of per]
 Array
(
    [0] => 2
)


day: 0 no. of period/s: 2
testing start period: 11
===Day number => +1====: 
Array
(
    [0] => 2
)
==========
11 * 12 * 
======================== <<1>> =======================================
Subject:	Basic English
Req. Period:	4
Group:		Electronics
Teacher:	James
Pref. Rm type:	Classroom
Pref. duration:	1 day/s
Room selected:  Room 1
Dist block:	
[day] => [no. of per]
 Array
(
    [0] => 4
)


day: 0 no. of period/s: 4
testing start period: 2
testing start period: 0
===Day number => +1====: 
Array
(
    [0] => 0
)
==========
0 * 1 * 2 * 3 * 
======================== <<2>> =======================================
Subject:	PolSci
Req. Period:	2
Group:		Electronics
Teacher:	Paul
Pref. Rm type:	Classroom
Pref. duration:	1 day/s
Room selected:  Room 2
Dist block:	
[day] => [no. of per]
 Array
(
    [0] => 2
)


day: 0 no. of period/s: 2
testing start period: 0
===Day number => +1====: 
Array
(
    [0] => 0
)
==========
0 * 1 * 
======================== <<3>> =======================================
Subject:	Basic English
Req. Period:	4
Group:		Mechtronics
Teacher:	James
Pref. Rm type:	Classroom
Pref. duration:	2 day/s
Room selected:  Room 2
Dist block:	
[day] => [no. of per]
 Array
(
    [0] => 2
    [1] => 2
)


day: 0 no. of period/s: 2
testing start period: 4
testing start period: 7

day: 1 no. of period/s: 2
testing start period: 4
testing start period: 10
===Day number => +1====: 
Array
(
    [0] => 1
    [1] => 2
)
==========
7 * 8 * 10 * 11 * 
======================== <<4>> =======================================
Subject:	Basic Math
Req. Period:	2
Group:		Mechtronics
Teacher:	John
Pref. Rm type:	Classroom
Pref. duration:	1 day/s
Room selected:  Room 1
Dist block:	
[day] => [no. of per]
 Array
(
    [0] => 2
)


day: 0 no. of period/s: 2
testing start period: 10
===Day number => +1====: 
Array
(
    [0] => 2
)
==========
10 * 11 * 
======================== <<5>> =======================================
Subject:	PolSci
Req. Period:	2
Group:		Mechtronics
Teacher:	Paul
Pref. Rm type:	ComputerLab
Pref. duration:	1 day/s
Room selected:  ComLab 2
Dist block:	
[day] => [no. of per]
 Array
(
    [0] => 2
)


day: 0 no. of period/s: 2
testing start period: 10
===Day number => +1====: 
Array
(
    [0] => 2
)
==========
10 * 11 * 
Schedule array: Array
(
    [0] => Array
        (
            [0] => 1
            [1] => 2
        )

    [1] => Array
        (
            [0] => 1
            [1] => 2
        )

    [2] => Array
        (
            [0] => 1
        )

    [3] => Array
        (
            [0] => 1
        )

    [4] => 
    [5] => 
    [6] => 
    [7] => Array
        (
            [0] => 3
        )

    [8] => Array
        (
            [0] => 3
        )

    [9] => 
    [10] => Array
        (
            [0] => 3
            [1] => 4
            [2] => 5
        )

    [11] => Array
        (
            [0] => 0
            [1] => 3
            [2] => 4
            [3] => 5
        )

    [12] => Array
        (
            [0] => 0
        )

    [13] => 
    [14] => 
)
Array
(
    [0] => Array
        (
            [0] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 2
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 1
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 401
                                            [roomName:Rooms:private] => Room 1
                                            [roomType:Rooms:private] => Classroom
                                            [roomLocation:Rooms:private] => Bldg 1

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 1
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 4

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 4
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 0
                        )

                    [1] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 6
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 2
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 102
                                            [subjectCode:Subjects:private] => PolSci101
                                            [subjectName:Subjects:private] => PolSci
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Political Science

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 302
                                            [teacherName:Teachers:private] => Paul
                                            [teacherDescription:Teachers:private] => PolSci teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 402
                                            [roomName:Rooms:private] => Room 2
                                            [roomType:Rooms:private] => Classroom
                                            [roomLocation:Rooms:private] => Bldg 2

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 2
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 0
                        )

                )

            [1] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 3
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 1
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 401
                                            [roomName:Rooms:private] => Room 1
                                            [roomType:Rooms:private] => Classroom
                                            [roomLocation:Rooms:private] => Bldg 1

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 1
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 4

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 4
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 1
                        )

                    [1] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 7
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 2
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 102
                                            [subjectCode:Subjects:private] => PolSci101
                                            [subjectName:Subjects:private] => PolSci
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Political Science

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 302
                                            [teacherName:Teachers:private] => Paul
                                            [teacherDescription:Teachers:private] => PolSci teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 402
                                            [roomName:Rooms:private] => Room 2
                                            [roomType:Rooms:private] => Classroom
                                            [roomLocation:Rooms:private] => Bldg 2

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 2
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 1
                        )

                )

            [2] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 4
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 1
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 401
                                            [roomName:Rooms:private] => Room 1
                                            [roomType:Rooms:private] => Classroom
                                            [roomLocation:Rooms:private] => Bldg 1

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 1
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 4

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 4
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 2
                        )

                )

            [3] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 5
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 1
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 401
                                            [roomName:Rooms:private] => Room 1
                                            [roomType:Rooms:private] => Classroom
                                            [roomLocation:Rooms:private] => Bldg 1

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 1
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 4

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 4
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 3
                        )

                )

            [4] => 
            [5] => 
            [6] => 
            [7] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 8
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 3
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 402
                                            [roomName:Rooms:private] => Room 2
                                            [roomType:Rooms:private] => Classroom
                                            [roomLocation:Rooms:private] => Bldg 2

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 3
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 2
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                            [1] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 7
                        )

                )

            [8] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 9
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 3
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 402
                                            [roomName:Rooms:private] => Room 2
                                            [roomType:Rooms:private] => Classroom
                                            [roomLocation:Rooms:private] => Bldg 2

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 3
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 2
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                            [1] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 8
                        )

                )

            [9] => 
            [10] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 10
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 3
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 402
                                            [roomName:Rooms:private] => Room 2
                                            [roomType:Rooms:private] => Classroom
                                            [roomLocation:Rooms:private] => Bldg 2

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 3
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 2
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                            [1] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 10
                        )

                    [1] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 12
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 4
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 101
                                            [subjectCode:Subjects:private] => MATH101
                                            [subjectName:Subjects:private] => Basic Math
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Basic Math

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 301
                                            [teacherName:Teachers:private] => John
                                            [teacherDescription:Teachers:private] => Math teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 401
                                            [roomName:Rooms:private] => Room 1
                                            [roomType:Rooms:private] => Classroom
                                            [roomLocation:Rooms:private] => Bldg 1

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 4
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 10
                        )

                    [2] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 14
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 5
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 102
                                            [subjectCode:Subjects:private] => PolSci101
                                            [subjectName:Subjects:private] => PolSci
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Political Science

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 302
                                            [teacherName:Teachers:private] => Paul
                                            [teacherDescription:Teachers:private] => PolSci teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 404
                                            [roomName:Rooms:private] => ComLab 2
                                            [roomType:Rooms:private] => ComputerLab
                                            [roomLocation:Rooms:private] => Bldg 1

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 5
                                            [preferenceRoomType:Preferences:private] => ComputerLab
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 10
                        )

                )

            [11] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 0
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 0
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 101
                                            [subjectCode:Subjects:private] => MATH101
                                            [subjectName:Subjects:private] => Basic Math
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Basic Math

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 301
                                            [teacherName:Teachers:private] => John
                                            [teacherDescription:Teachers:private] => Math teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 404
                                            [roomName:Rooms:private] => ComLab 2
                                            [roomType:Rooms:private] => ComputerLab
                                            [roomLocation:Rooms:private] => Bldg 1

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 0
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 11
                        )

                    [1] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 11
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 3
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 402
                                            [roomName:Rooms:private] => Room 2
                                            [roomType:Rooms:private] => Classroom
                                            [roomLocation:Rooms:private] => Bldg 2

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 3
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 2
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                            [1] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 11
                        )

                    [2] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 13
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 4
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 101
                                            [subjectCode:Subjects:private] => MATH101
                                            [subjectName:Subjects:private] => Basic Math
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Basic Math

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 301
                                            [teacherName:Teachers:private] => John
                                            [teacherDescription:Teachers:private] => Math teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 401
                                            [roomName:Rooms:private] => Room 1
                                            [roomType:Rooms:private] => Classroom
                                            [roomLocation:Rooms:private] => Bldg 1

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 4
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 11
                        )

                    [3] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 15
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 5
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 102
                                            [subjectCode:Subjects:private] => PolSci101
                                            [subjectName:Subjects:private] => PolSci
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Political Science

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 302
                                            [teacherName:Teachers:private] => Paul
                                            [teacherDescription:Teachers:private] => PolSci teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 404
                                            [roomName:Rooms:private] => ComLab 2
                                            [roomType:Rooms:private] => ComputerLab
                                            [roomLocation:Rooms:private] => Bldg 1

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 5
                                            [preferenceRoomType:Preferences:private] => ComputerLab
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 11
                        )

                )

            [12] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 1
                            [scheduleTimetableID:Schedules:private] => 0
                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 0
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 101
                                            [subjectCode:Subjects:private] => MATH101
                                            [subjectName:Subjects:private] => Basic Math
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Basic Math

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 301
                                            [teacherName:Teachers:private] => John
                                            [teacherDescription:Teachers:private] => Math teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => Rooms Object
                                        (
                                            [roomID:Rooms:private] => 404
                                            [roomName:Rooms:private] => ComLab 2
                                            [roomType:Rooms:private] => ComputerLab
                                            [roomLocation:Rooms:private] => Bldg 1

                                        )

                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 0
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 12
                        )

                )

            [13] => 
            [14] => 
        )

)
Array
(
    [0] => Rooms Object
        (
            [roomID:Rooms:private] => 401
            [roomName:Rooms:private] => Room 1
            [roomType:Rooms:private] => Classroom
            [roomLocation:Rooms:private] => Bldg 1

        )

    [1] => Rooms Object
        (
            [roomID:Rooms:private] => 402
            [roomName:Rooms:private] => Room 2
            [roomType:Rooms:private] => Classroom
            [roomLocation:Rooms:private] => Bldg 2

        )

    [2] => Rooms Object
        (
            [roomID:Rooms:private] => 403
            [roomName:Rooms:private] => ComLab 1
            [roomType:Rooms:private] => ComputerLab
            [roomLocation:Rooms:private] => Bldg 1

        )

    [3] => Rooms Object
        (
            [roomID:Rooms:private] => 404
            [roomName:Rooms:private] => ComLab 2
            [roomType:Rooms:private] => ComputerLab
            [roomLocation:Rooms:private] => Bldg 1

        )

)
11Array
(
    [0] => Subjects Object
        (
            [subjectID:Subjects:private] => 101
            [subjectCode:Subjects:private] => MATH101
            [subjectName:Subjects:private] => Basic Math
            [subjectRequiredPeriod:Subjects:private] => 2
            [subjectDescription:Subjects:private] => Basic Math

        )

    [1] => Subjects Object
        (
            [subjectID:Subjects:private] => 102
            [subjectCode:Subjects:private] => PolSci101
            [subjectName:Subjects:private] => PolSci
            [subjectRequiredPeriod:Subjects:private] => 2
            [subjectDescription:Subjects:private] => Political Science

        )

    [2] => Subjects Object
        (
            [subjectID:Subjects:private] => 103
            [subjectCode:Subjects:private] => ENGL101
            [subjectName:Subjects:private] => Basic English
            [subjectRequiredPeriod:Subjects:private] => 4
            [subjectDescription:Subjects:private] => Basic English

        )

)
1Array
(
    [0] => TraineeGroups Object
        (
            [traineeGroupID:TraineeGroups:private] => 201
            [traineeGroupName:TraineeGroups:private] => Electronics
            [traineeGroupRemarks:TraineeGroups:private] => Group A
            [traineeGroupLevel:TraineeGroups:private] => 1

        )

    [1] => TraineeGroups Object
        (
            [traineeGroupID:TraineeGroups:private] => 202
            [traineeGroupName:TraineeGroups:private] => Mechtronics
            [traineeGroupRemarks:TraineeGroups:private] => Group A
            [traineeGroupLevel:TraineeGroups:private] => 1

        )

)
1Array
(
    [0] => Teachers Object
        (
            [teacherID:Teachers:private] => 301
            [teacherName:Teachers:private] => John
            [teacherDescription:Teachers:private] => Math teacher

        )

    [1] => Teachers Object
        (
            [teacherID:Teachers:private] => 302
            [teacherName:Teachers:private] => Paul
            [teacherDescription:Teachers:private] => PolSci teacher

        )

    [2] => Teachers Object
        (
            [teacherID:Teachers:private] => 303
            [teacherName:Teachers:private] => James
            [teacherDescription:Teachers:private] => English teacher

        )

    [3] => Teachers Object
        (
            [teacherID:Teachers:private] => 304
            [teacherName:Teachers:private] => Peter
            [teacherDescription:Teachers:private] => Bio teacher

        )

)
1Array
(
    [0] => Rooms Object
        (
            [roomID:Rooms:private] => 401
            [roomName:Rooms:private] => Room 1
            [roomType:Rooms:private] => Classroom
            [roomLocation:Rooms:private] => Bldg 1

        )

    [1] => Rooms Object
        (
            [roomID:Rooms:private] => 402
            [roomName:Rooms:private] => Room 2
            [roomType:Rooms:private] => Classroom
            [roomLocation:Rooms:private] => Bldg 2

        )

    [2] => Rooms Object
        (
            [roomID:Rooms:private] => 403
            [roomName:Rooms:private] => ComLab 1
            [roomType:Rooms:private] => ComputerLab
            [roomLocation:Rooms:private] => Bldg 1

        )

    [3] => Rooms Object
        (
            [roomID:Rooms:private] => 404
            [roomName:Rooms:private] => ComLab 2
            [roomType:Rooms:private] => ComputerLab
            [roomLocation:Rooms:private] => Bldg 1

        )

)
1Array
(
    [0] => Preferences Object
        (
            [preferencesID:Preferences:private] => 0
            [preferenceRoomType:Preferences:private] => Classroom
            [preferencePreferredStartPeriod:Preferences:private] => 1
            [preferencePreferredEndPeriod:Preferences:private] => 5
            [preferencePreferredNumberDays:Preferences:private] => 1
            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

        )

    [1] => Preferences Object
        (
            [preferencesID:Preferences:private] => 1
            [preferenceRoomType:Preferences:private] => Classroom
            [preferencePreferredStartPeriod:Preferences:private] => 1
            [preferencePreferredEndPeriod:Preferences:private] => 5
            [preferencePreferredNumberDays:Preferences:private] => 1
            [preferencePreferredNumberPeriodsDay:Preferences:private] => 4

        )

    [2] => Preferences Object
        (
            [preferencesID:Preferences:private] => 2
            [preferenceRoomType:Preferences:private] => Classroom
            [preferencePreferredStartPeriod:Preferences:private] => 1
            [preferencePreferredEndPeriod:Preferences:private] => 5
            [preferencePreferredNumberDays:Preferences:private] => 1
            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

        )

    [3] => Preferences Object
        (
            [preferencesID:Preferences:private] => 3
            [preferenceRoomType:Preferences:private] => Classroom
            [preferencePreferredStartPeriod:Preferences:private] => 1
            [preferencePreferredEndPeriod:Preferences:private] => 5
            [preferencePreferredNumberDays:Preferences:private] => 2
            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

        )

    [4] => Preferences Object
        (
            [preferencesID:Preferences:private] => 4
            [preferenceRoomType:Preferences:private] => Classroom
            [preferencePreferredStartPeriod:Preferences:private] => 1
            [preferencePreferredEndPeriod:Preferences:private] => 5
            [preferencePreferredNumberDays:Preferences:private] => 1
            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

        )

    [5] => Preferences Object
        (
            [preferencesID:Preferences:private] => 5
            [preferenceRoomType:Preferences:private] => ComputerLab
            [preferencePreferredStartPeriod:Preferences:private] => 1
            [preferencePreferredEndPeriod:Preferences:private] => 5
            [preferencePreferredNumberDays:Preferences:private] => 1
            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

        )

)
1===========

Testing possibilities for Subject :Basic Math
===========

Class ID : 0
Total required number of periods: 2
Preferred number of days/week: 1 
Preferred number of periods/day: 2

Day1 : 2  
===========

Testing possibilities for Subject :Basic English
===========

Class ID : 1
Total required number of periods: 4
Preferred number of days/week: 1 
Preferred number of periods/day: 4

Day1 : 4  
===========

Testing possibilities for Subject :PolSci
===========

Class ID : 2
Total required number of periods: 2
Preferred number of days/week: 1 
Preferred number of periods/day: 2

Day1 : 2  
===========

Testing possibilities for Subject :Basic English
===========

Class ID : 3
Total required number of periods: 4
Preferred number of days/week: 2 
Preferred number of periods/day: 2

Day1 : 2  Day2 : 2  
===========

Testing possibilities for Subject :Basic Math
===========

Class ID : 4
Total required number of periods: 2
Preferred number of days/week: 1 
Preferred number of periods/day: 2

Day1 : 2  
===========

Testing possibilities for Subject :PolSci
===========

Class ID : 5
Total required number of periods: 2
Preferred number of days/week: 1 
Preferred number of periods/day: 2

Day1 : 2  
Array
(
    [0] => SubjectClasses Object
        (
            [subjectClassID:SubjectClasses:private] => 0
            [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                (
                    [subjectID:Subjects:private] => 101
                    [subjectCode:Subjects:private] => MATH101
                    [subjectName:Subjects:private] => Basic Math
                    [subjectRequiredPeriod:Subjects:private] => 2
                    [subjectDescription:Subjects:private] => Basic Math

                )

            [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                (
                    [traineeGroupID:TraineeGroups:private] => 201
                    [traineeGroupName:TraineeGroups:private] => Electronics
                    [traineeGroupRemarks:TraineeGroups:private] => Group A
                    [traineeGroupLevel:TraineeGroups:private] => 1

                )

            [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                (
                    [teacherID:Teachers:private] => 301
                    [teacherName:Teachers:private] => John
                    [teacherDescription:Teachers:private] => Math teacher

                )

            [subjectClassRoomID:SubjectClasses:private] => 404
            [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                (
                    [preferencesID:Preferences:private] => 0
                    [preferenceRoomType:Preferences:private] => Classroom
                    [preferencePreferredStartPeriod:Preferences:private] => 1
                    [preferencePreferredEndPeriod:Preferences:private] => 5
                    [preferencePreferredNumberDays:Preferences:private] => 1
                    [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                )

            [subjectClassDistributionBlock:SubjectClasses:private] => Array
                (
                    [0] => 2
                )

            [isPossibleToDistribute:SubjectClasses:private] => 1
        )

    [1] => SubjectClasses Object
        (
            [subjectClassID:SubjectClasses:private] => 1
            [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                (
                    [subjectID:Subjects:private] => 103
                    [subjectCode:Subjects:private] => ENGL101
                    [subjectName:Subjects:private] => Basic English
                    [subjectRequiredPeriod:Subjects:private] => 4
                    [subjectDescription:Subjects:private] => Basic English

                )

            [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                (
                    [traineeGroupID:TraineeGroups:private] => 201
                    [traineeGroupName:TraineeGroups:private] => Electronics
                    [traineeGroupRemarks:TraineeGroups:private] => Group A
                    [traineeGroupLevel:TraineeGroups:private] => 1

                )

            [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                (
                    [teacherID:Teachers:private] => 303
                    [teacherName:Teachers:private] => James
                    [teacherDescription:Teachers:private] => English teacher

                )

            [subjectClassRoomID:SubjectClasses:private] => 
            [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                (
                    [preferencesID:Preferences:private] => 1
                    [preferenceRoomType:Preferences:private] => Classroom
                    [preferencePreferredStartPeriod:Preferences:private] => 1
                    [preferencePreferredEndPeriod:Preferences:private] => 5
                    [preferencePreferredNumberDays:Preferences:private] => 1
                    [preferencePreferredNumberPeriodsDay:Preferences:private] => 4

                )

            [subjectClassDistributionBlock:SubjectClasses:private] => Array
                (
                    [0] => 4
                )

            [isPossibleToDistribute:SubjectClasses:private] => 1
        )

    [2] => SubjectClasses Object
        (
            [subjectClassID:SubjectClasses:private] => 2
            [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                (
                    [subjectID:Subjects:private] => 102
                    [subjectCode:Subjects:private] => PolSci101
                    [subjectName:Subjects:private] => PolSci
                    [subjectRequiredPeriod:Subjects:private] => 2
                    [subjectDescription:Subjects:private] => Political Science

                )

            [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                (
                    [traineeGroupID:TraineeGroups:private] => 201
                    [traineeGroupName:TraineeGroups:private] => Electronics
                    [traineeGroupRemarks:TraineeGroups:private] => Group A
                    [traineeGroupLevel:TraineeGroups:private] => 1

                )

            [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                (
                    [teacherID:Teachers:private] => 302
                    [teacherName:Teachers:private] => Paul
                    [teacherDescription:Teachers:private] => PolSci teacher

                )

            [subjectClassRoomID:SubjectClasses:private] => 
            [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                (
                    [preferencesID:Preferences:private] => 2
                    [preferenceRoomType:Preferences:private] => Classroom
                    [preferencePreferredStartPeriod:Preferences:private] => 1
                    [preferencePreferredEndPeriod:Preferences:private] => 5
                    [preferencePreferredNumberDays:Preferences:private] => 1
                    [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                )

            [subjectClassDistributionBlock:SubjectClasses:private] => Array
                (
                    [0] => 2
                )

            [isPossibleToDistribute:SubjectClasses:private] => 1
        )

    [3] => SubjectClasses Object
        (
            [subjectClassID:SubjectClasses:private] => 3
            [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                (
                    [subjectID:Subjects:private] => 103
                    [subjectCode:Subjects:private] => ENGL101
                    [subjectName:Subjects:private] => Basic English
                    [subjectRequiredPeriod:Subjects:private] => 4
                    [subjectDescription:Subjects:private] => Basic English

                )

            [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                (
                    [traineeGroupID:TraineeGroups:private] => 202
                    [traineeGroupName:TraineeGroups:private] => Mechtronics
                    [traineeGroupRemarks:TraineeGroups:private] => Group A
                    [traineeGroupLevel:TraineeGroups:private] => 1

                )

            [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                (
                    [teacherID:Teachers:private] => 303
                    [teacherName:Teachers:private] => James
                    [teacherDescription:Teachers:private] => English teacher

                )

            [subjectClassRoomID:SubjectClasses:private] => 
            [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                (
                    [preferencesID:Preferences:private] => 3
                    [preferenceRoomType:Preferences:private] => Classroom
                    [preferencePreferredStartPeriod:Preferences:private] => 1
                    [preferencePreferredEndPeriod:Preferences:private] => 5
                    [preferencePreferredNumberDays:Preferences:private] => 2
                    [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                )

            [subjectClassDistributionBlock:SubjectClasses:private] => Array
                (
                    [0] => 2
                    [1] => 2
                )

            [isPossibleToDistribute:SubjectClasses:private] => 1
        )

    [4] => SubjectClasses Object
        (
            [subjectClassID:SubjectClasses:private] => 4
            [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                (
                    [subjectID:Subjects:private] => 101
                    [subjectCode:Subjects:private] => MATH101
                    [subjectName:Subjects:private] => Basic Math
                    [subjectRequiredPeriod:Subjects:private] => 2
                    [subjectDescription:Subjects:private] => Basic Math

                )

            [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                (
                    [traineeGroupID:TraineeGroups:private] => 202
                    [traineeGroupName:TraineeGroups:private] => Mechtronics
                    [traineeGroupRemarks:TraineeGroups:private] => Group A
                    [traineeGroupLevel:TraineeGroups:private] => 1

                )

            [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                (
                    [teacherID:Teachers:private] => 301
                    [teacherName:Teachers:private] => John
                    [teacherDescription:Teachers:private] => Math teacher

                )

            [subjectClassRoomID:SubjectClasses:private] => 
            [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                (
                    [preferencesID:Preferences:private] => 4
                    [preferenceRoomType:Preferences:private] => Classroom
                    [preferencePreferredStartPeriod:Preferences:private] => 1
                    [preferencePreferredEndPeriod:Preferences:private] => 5
                    [preferencePreferredNumberDays:Preferences:private] => 1
                    [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                )

            [subjectClassDistributionBlock:SubjectClasses:private] => Array
                (
                    [0] => 2
                )

            [isPossibleToDistribute:SubjectClasses:private] => 1
        )

    [5] => SubjectClasses Object
        (
            [subjectClassID:SubjectClasses:private] => 5
            [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                (
                    [subjectID:Subjects:private] => 102
                    [subjectCode:Subjects:private] => PolSci101
                    [subjectName:Subjects:private] => PolSci
                    [subjectRequiredPeriod:Subjects:private] => 2
                    [subjectDescription:Subjects:private] => Political Science

                )

            [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                (
                    [traineeGroupID:TraineeGroups:private] => 202
                    [traineeGroupName:TraineeGroups:private] => Mechtronics
                    [traineeGroupRemarks:TraineeGroups:private] => Group A
                    [traineeGroupLevel:TraineeGroups:private] => 1

                )

            [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                (
                    [teacherID:Teachers:private] => 302
                    [teacherName:Teachers:private] => Paul
                    [teacherDescription:Teachers:private] => PolSci teacher

                )

            [subjectClassRoomID:SubjectClasses:private] => 
            [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                (
                    [preferencesID:Preferences:private] => 5
                    [preferenceRoomType:Preferences:private] => ComputerLab
                    [preferencePreferredStartPeriod:Preferences:private] => 1
                    [preferencePreferredEndPeriod:Preferences:private] => 5
                    [preferencePreferredNumberDays:Preferences:private] => 1
                    [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                )

            [subjectClassDistributionBlock:SubjectClasses:private] => Array
                (
                    [0] => 2
                )

            [isPossibleToDistribute:SubjectClasses:private] => 1
        )

)
1
======================== <<0>> =======================================
Subject:	Basic Math
Req. Period:	2
Group:		Electronics
Teacher:	John
Pref. Rm type:	Classroom
Pref. duration:	1 day/s
Room selected:  ComLab 2
Dist block:	
[day] => [no. of per]
 Array
(
    [0] => 2
)


day: 0 no. of period/s: 2
testing start period: 0
===Day number => +1====: 
Array
(
    [0] => 0
)
==========
0 * 1 * 
======================== <<1>> =======================================
Subject:	Basic English
Req. Period:	4
Group:		Electronics
Teacher:	James
Pref. Rm type:	Classroom
Pref. duration:	1 day/s
Room selected:  Room 1
Dist block:	
[day] => [no. of per]
 Array
(
    [0] => 4
)


day: 0 no. of period/s: 4
testing start period: 13
testing start period: 9
testing start period: 10
===Day number => +1====: 
Array
(
    [0] => 2
)
==========
10 * 11 * 12 * 13 * 
======================== <<2>> =======================================
Subject:	PolSci
Req. Period:	2
Group:		Electronics
Teacher:	Paul
Pref. Rm type:	Classroom
Pref. duration:	1 day/s
Room selected:  Room 2
Dist block:	
[day] => [no. of per]
 Array
(
    [0] => 2
)


day: 0 no. of period/s: 2
testing start period: 13
===Day number => +1====: 
Array
(
    [0] => 2
)
==========
13 * 14 * 
======================== <<3>> =======================================
Subject:	Basic English
Req. Period:	4
Group:		Mechtronics
Teacher:	James
Pref. Rm type:	Classroom
Pref. duration:	2 day/s
Room selected:  Room 1
Dist block:	
[day] => [no. of per]
 Array
(
    [0] => 2
    [1] => 2
)


day: 0 no. of period/s: 2
testing start period: 5

day: 1 no. of period/s: 2
testing start period: 2
===Day number => +1====: 
Array
(
    [0] => 1
    [1] => 0
)
==========
5 * 6 * 2 * 3 * 
======================== <<4>> =======================================
Subject:	Basic Math
Req. Period:	2
Group:		Mechtronics
Teacher:	John
Pref. Rm type:	Classroom
Pref. duration:	1 day/s
Room selected:  Room 2
Dist block:	
[day] => [no. of per]
 Array
(
    [0] => 2
)


day: 0 no. of period/s: 2
testing start period: 14
testing start period: 14
testing start period: 12
===Day number => +1====: 
Array
(
    [0] => 2
)
==========
12 * 13 * 
======================== <<5>> =======================================
Subject:	PolSci
Req. Period:	2
Group:		Mechtronics
Teacher:	Paul
Pref. Rm type:	ComputerLab
Pref. duration:	1 day/s
Room selected:  ComLab 1
Dist block:	
[day] => [no. of per]
 Array
(
    [0] => 2
)


day: 0 no. of period/s: 2
testing start period: 5
===Day number => +1====: 
Array
(
    [0] => 1
)
==========
5 * 6 * 
Schedule array: Array
(
    [0] => Array
        (
            [0] => 0
        )

    [1] => Array
        (
            [0] => 0
        )

    [2] => Array
        (
            [0] => 3
        )

    [3] => Array
        (
            [0] => 3
        )

    [4] => 
    [5] => Array
        (
            [0] => 3
            [1] => 5
        )

    [6] => Array
        (
            [0] => 3
            [1] => 5
        )

    [7] => 
    [8] => 
    [9] => 
    [10] => Array
        (
            [0] => 1
        )

    [11] => Array
        (
            [0] => 1
        )

    [12] => Array
        (
            [0] => 1
            [1] => 4
        )

    [13] => Array
        (
            [0] => 1
            [1] => 2
            [2] => 4
        )

    [14] => Array
        (
            [0] => 2
        )

)


*/