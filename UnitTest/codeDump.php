<?php

require "init-classes.php";
require "SubjectClasses.php";

// sort trainee group by level
// the lowest level will be processed first as they would require fewer subjects
function cmp($a, $b)
{
    return strcmp($a->getTraineeGroupLevel(), $b->getTraineeGroupLevel());
}

// ---------------------------
// main code 

$obj            = createObjects();
$subject        = $obj[0];
$traineeGroup   = $obj[1];
$teacher        = $obj[2];
$room           = $obj[3];
$preference     = $obj[4];
$subjectClass   = $obj[5];

usort($traineeGroup, "cmp");

$slot = [];
for($i = 0 ; $i < TOTAL_SLOTS; $i++){
    $slot[$i] = [];
}

$firstPeriod = 0;
$lastPeriod = 9;
// $slot[0][] = $subjectClass[0];
// $slot[0][] = $subjectClass[1];
// print_r($slot);
// print_r($slot[0][0]->GetSubjectClassTraineeGroupID()->GetTraineeGroupName());

// print_r($slot[0][0]->GetSubjectClassDistributionBlock());
// print_r($subjectClass[0]);


// per classID (0-7) per subject class
for ($i = 0; $i < sizeof($subjectClass); $i++){ 
    //per distBlock( this version uses 1x block or 1 day) w/ 2-3periods{
    for($j = 0; $j <  sizeof($subjectClass[$i]->GetSubjectClassDistributionBlock()); $j++){
        // print_r ($subjectClass[$i]->GetSubjectClassDistributionBlock()[$j]);
        // number of period for this subject per day
        $numPeriod = ($subjectClass[$i]->GetSubjectClassDistributionBlock()[$j]);
        $sameDay = false;
        echo "<br/>=========<br/><br/> ";
        while (!$sameDay){
            // find random (0-9) strating period n
            $classStartingPeriod = mt_rand($firstPeriod, $lastPeriod-1); // start at period zero up to period 9
            $x = [];
            $y = [];
            // // check if random period n and n+ is on the same day
            $x[] = [$numPeriod, $classStartingPeriod];
            print_r ($x);
            for($k = $classStartingPeriod; $k < ($classStartingPeriod + $numPeriod); $k++ ){
                echo $k. "-";
                $y[] = ( (int) ($k/5) );
            }
            echo "<br/> days: ";
            print_r($y);
            print_r(count(array_unique($y)));
            if (count(array_unique($y)) == 1) 
                $sameDay = true;
            // if ( ( (int) ($min/5) ) ==  ((int) (($min+1)/5) ) ){
            //     echo "<br/> $min = ";
            //     print_r ( (int) ($min/5) );
            //     echo " <> ";
            //     print_r ((int) (($min+1)/5) );
                
            //     echo "<br/>";
            // }
            
        }

        // per period{ start random n period up n+1 period


    }
}


















==============================
    // *********************************************************************   
    function createSchedules(){   // Schedules
        
        
        $schedule = new Schedules ();
        

        if (true) echo print_r($schedule); echo"<br/>";

        return $schedule;
    }

    // *********************************************************************   
    function createTimetables(){   // Timetable
        
        $timetable = [];
        $timetable[] = new Timetables ();
        

        if (DEBUG_INFO) echo print_r($timetable); echo"<br/>";

        return $timetable;
    }














//    $array = array("banana","apple","orange","apple");
//    print_r(array_search("apple", $array));
//     $a1=array("red","green","red","yellow");
//     $a2=array("red");
//     $result=array_intersect($a1,$a2);
//     print_r($result);
//     print_r(sizeof($result));
// echo "<br/>";    
// echo "period: ";
// echo ((int) ((0%5)+1));   // int(3)   
// echo "<br/>";    
// echo "day: ";
// echo((int) ((0/5)+1));    // float(4)   


===============================================================

echo "<table border=\"1\">";
echo "<tr> ";
echo "<th>Slot - Day - Period</th>";
// echo "<th>Subject Group</th>";
echo "<th>Room 1</th>";
echo "<th>Room 2</th>";
echo "</tr>";
foreach($schedule[0] as $key => $value){


    

    // echo "<br><br><br>--------   --------<br>";
    $slot = $value->GetScheduleSlot();

    echo "<tr>";
    
    $day = (int) ( $value->GetScheduleSlot() / TOTAL_PERIODS) + 1 ;
    $period = ( $value->GetScheduleSlot()  % TOTAL_PERIODS ) + 1 ;
    
    // 1st col 
    echo "<td>Slot: $slot Day: $day Period: $period </td>";
    //print_r($key);



    
    if ($value->GetScheduleSubjectClassID()->GetSubjectClassRoomID()->GetRoomID() == 401){
        echo "<td style=\"text-align:center;\">";
        // print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassRoomID()->GetRoomName());
        // 2nd col 
        echo "<b> ";print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassSubjectID()->GetSubjectCode());
        echo " ClassID: ";
        print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassID());
        echo " </b><br/>";
        print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassTraineeGroupID()->GetTraineeGroupName());
        echo " ";
        print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassTraineeGroupID()->GetTraineeGroupID());
        echo "<br/> ";
        echo "Instructor: Mr. ";
        print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassTeacherID()->GetTeacherName());
        echo "<br/> ";
        echo " ";
        echo (" &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ");
        echo "</td> ";
    }else {
        echo "<td style=\"text-align:center;\">";
    }
    
    

    
    if ($value->GetScheduleSubjectClassID()->GetSubjectClassRoomID()->GetRoomID() == 402){
        echo "<td style=\"text-align:center; \" \"width=\"%0%\"\">";
        // print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassRoomID()->GetRoomName());
        // 2nd col 
        echo "<b> ";print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassSubjectID()->GetSubjectCode());
        echo " ClassID: ";
        print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassID());
        echo "</b> <br/>";
        print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassTraineeGroupID()->GetTraineeGroupName());
        echo " ";
        print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassTraineeGroupID()->GetTraineeGroupID());
        echo " <br/>";
        echo "Instructor: Mr. ";
        print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassTeacherID()->GetTeacherName());
        echo "<br/> ";
        echo (" &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ");
        echo "</td> ";    
    }else {
       echo "<td style=\"text-align:center;\">";
    }
    



    echo "</tr>";
    $i += 1;
}

echo "</table>";


===========================================

$schedule[0] = createTimetables ();
echo "<br/><br/>schedule: ";
print_r(sizeof($schedule[0]));
$i = 0;
usort($schedule[0], "cmpSchedule");
echo "<br/><br/>";
foreach ($schedule[0] as $key => $value){
    $day = (int) ($i / TOTAL_PERIODS);
    echo "<br/>$i \t ";
    if (true){
        echo " ";print_r($value->GetScheduleID());
        echo "\t ";print_r($value->GetScheduleSlot());
        echo "<br/>";
    }else{
        echo " <br/>";
    }

    $i += 1;
}

echo "i = $i";
// print_r($schedule[0]);