<?php

require "Teachers.php";
require "Rooms.php";


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
// echo "<br/> ".print_r($room1->GetRoomType());