<?php
    echo "<pre>";
    // *********************************************************************
    {   // Fetch Subjects
        require "Subjects.php";
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
        echo print_r($subject);
    }
    // *********************************************************************
    {   // Fetch Trainee groups
        require "traineeGroups.php";
        $fileTrainees = file('../csv/trainees.csv');
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
        $trainee = [];
        for ( $i=0; $i < $line-1; $i++){
            $trainee[$i] = new TraineeGroups (  $traineeGroupID[$i],             //subjectID
                                                $traineeGroupName[$i],           //subjectCode
                                                $traineeGroupRemarks[$i],           //SubjectName
                                                $traineeGroupLevel[$i] );

        }

        echo print_r($trainee);
    }
    // *********************************************************************
    {   // Fetch Teachers
        require "teachers.php";
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
        echo print_r($teacher);
    }


    // *********************************************************************
        {   // Fetch Rooms
        require "Rooms.php";
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
        echo print_r($room);
    }



    // *********************************************************************
    {   // Fetch Rooms
        require "Preferences.php";
        $filePreferences = file('../csv/Preferences.csv');
        $line = 0; // exclude the header. set to 1 to include headers
        foreach ($filePreferences as $preference){
            // fetch all the data including the worksheet header;
            if($line > 0 ){
                list ($preference_ID[], $preferencesPreferredStartPeriod[],
                        $preferencesPreferredEndPeriod[], $preferencesPreferredNumberDays[],
                         $preferencesPreferredNumberPeriodsDay[] ) = explode(',' , $preference);
            }
            $line += 1;
        }
        $preference = [];
        for ( $i=0; $i < $line-1; $i++){
            $preference[$i] = new Preferences ( $preference_ID[$i], $preferencesPreferredStartPeriod[$i], 
                                                $preferencesPreferredEndPeriod[$i], $preferencesPreferredNumberDays[$i] ,
                                                 $preferencesPreferredNumberPeriodsDay[$i]);
        }
        echo print_r($preference);
}


