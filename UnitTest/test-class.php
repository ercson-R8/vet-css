<?php

require "Teachers.php";
require "Rooms.php";
require "Subjects.php";
require "TraineeGroups.php";
require "Timetables.php";
require "Schedules.php";
require "SubjectClasses.php";
require "Preferences.php";

$teacher1 = new Teachers (5, "Ada");
echo "First...";
echo $teacher1->GetTeacherID(). " ";
echo $teacher1->GetTeacherName();

$teacher2 = new Teachers;
echo "<br/>New teacher created: ";
$teacher2->SetTeacherID(10);
$teacher2->SetTeacherName("Lovelace");
echo "<pre> ";
echo print_r($teacher2->GetTeacherInformation());


$room1 = new Rooms(1, "Room 1", "ComLab", "Building 1");
echo "<pre>";
echo print_r($room1->GetRoomInformation());
echo "<br/> ";


$teacher = [];
for ($i = 0 ; $i < 3; $i++){
    $teacher[$i] = new Teachers($i+5000, "Teacher No.".$i);
}

$room = [];
for ($i = 0 ; $i < 3; $i++){
    $room[$i] = new Rooms($i+100, "Room No.".$i, "ComLAB", "Building ".$i);
}


$subject = [];
for ( $i=0; $i < 3; $i++){
    $subject[$i] = new Subjects (   $i,             //subjectID
                                    $i+100,         //subjectCode
                                    "Subject ".$i,  //SubjectName
                                    6+$i,             //subjectRequiredPeriod
                                    "Subject Description" );
}

echo print_r($subject);


$traineeGroup = [];
for ( $i = 0; $i < 3; $i++){
    $ys = $i + 2016;;
    $ye = $i + 2017;
    $batch = "Batch ". $ys. " - ". $ye;
    $traineeGroup[$i] = new TraineeGroups ($i, "Group No. ". $i+1, $batch, 2);

}

echo print_r($traineeGroup);


$timetable = [];
for ($i = 0 ; $i < 3; $i++){
    $timetable[$i] = new Timetables($i, 2016, 1, "Sample timetable population");
}

echo print_r($timetable);








$pref = [];
for ($i = 0 ; $i < 3; $i++){
    $pref[$i] = new Preferences ($i, // $preferencesID = null,
                                  1, //  $preferencesPreferredStartPeriod = null, 
                                  5, //  $preferencesPreferredEndPeriod = null, 
                                  3, //  $preferencesPreferredNumberDays = null,
                                  3  //  $preferencesPreferredNumberPeriodsDay = null
                                  );
    // print_r($pref[$i]->GetPreferencesInformation());
    
}
echo print_r($pref);


$subjectClass = [];
for ($i = 0; $i < 3; $i++){
    $subjectClass[$i] = new SubjectClasses(
                            $i,                         //subjectClassesID 
                            $subject[$i],               //subjectClassesSubjectID
                            $traineeGroup[$i],          //subjectClassesTraineeGroupID
                            $teacher[$i],                //subjectClassesTeacherID
                            $room[$i],         //subjectClassesRoomID 
                            $pref[$i],              //subjectClassesPreferredStartPeriod
                            8,              //subjectClassesPreferredEndPeriod
                            $i+4,              //subjectClassesPreferredNumberDays
                            2,              //subjectClassesPreferredNumberPeriodsDay 
                            null);

}
echo "<br/><br/><br/> ";
echo print_r($subjectClass);
echo "<br/><br/><br/> ";
if ( $subjectClass[0]->GetIsPossibleToDistribute() ){
    echo "Possible..";
}else{
    echo "NOT Possible..";
}
$schedule = [];
for ($i = 0; $i < 3; $i++){
    $schedule[$i] = new Schedules(  $i + 100, 
                                    $subjectClass[$i], 
                                    $i);
}
echo "<br/><br/><br/> =====<br/> ";
echo print_r($schedule);
$s = $schedule[1]->GetSchedulesInformation();
// echo print_r($s);