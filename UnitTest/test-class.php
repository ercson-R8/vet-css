<?php

require "Teachers.php";
require "Rooms.php";
require "Subjects.php";
require "TraineeGroups.php";
require "Timetables.php";
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


$subject = [];
for ( $i=0; $i < 2; $i++){
    $subject[$i] = new Subjects ($i, $i+100, 
                                    "Subject ".$i, 20,
                                    "Subject Description" );
}

echo print_r($subject);


$traineeGroup = [];
for ( $i = 0; $i < 3; $i++){
    $traineeGroup[$i] = new TraineeGroups ($i, "Group No. ". $i+1, "Batch 2016-2017", 2);

}

echo print_r($traineeGroup);


$timetable = [];
for ($i = 0 ; $i < 3; $i++){
    $timetable[$i] = new Timetables($i, 2016, 1, "Sample timetable population");
}

echo print_r($timetable);