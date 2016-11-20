<?php
    echo "<pre>";
        define("DEBUG_INFO", true);
        define("TOTAL_SLOTS", 10);
    // *********************************************************************
    {   // Fetch Subjects
        require "Subjects.php";
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
    }
    // *********************************************************************
    {   // Fetch Trainee groups
        require "traineeGroups.php";
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
    }
    // *********************************************************************
    {   // Fetch Teachers
        require "teachers.php";
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
    }


    // *********************************************************************
        {   // Fetch Rooms
        require "Rooms.php";
        $fileRooms = file('../csv/version2/Rooms.csv');
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
    }



    // *********************************************************************
    {   // Preferences Rooms
        require "Preferences.php";
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






}


    // *********************************************************************
    {   // Schedules
        require "Schedules.php";
        $schedule = [];
        $schedule[0] = new Schedules ();
        

        if (DEBUG_INFO) echo print_r($schedule);






}



