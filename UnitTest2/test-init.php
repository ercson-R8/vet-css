<?php

require "init-classes.php";
$timetable  = new Timetables(1, 2016, 1, "blah",0);
    print_r ($timetable); 


    $obj            = createObjects();
    $subject        = $obj[0];
    $traineeGroup   = $obj[1];
    $teacher        = $obj[2];
    $room           = $obj[3];
    $preference     = $obj[4];
    $subjectClass   = $obj[5];