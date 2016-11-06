<?php

require "init-classes.php";

// sort trainee group by level
// the lowest level will be processed first as they would require fewer subjects
function cmpTraineeGroup($a, $b){
	return strcmp($a->getTraineeGroupLevel(), $b->getTraineeGroupLevel());	
}

// sort schedule
function cmpSchedule($a, $b){
	return strcmp($a->GetScheduleSlot(), $b->GetScheduleSlot());	
}

// ---------------------------
// main code 
function createTimetables($timetableID){
    $timetable  = new Timetables($timetableID, 2016, 1, "test table",0);
    print_r ($timetable); 


    $obj            = createObjects();
    $subject        = $obj[0];
    $traineeGroup   = $obj[1];
    $teacher        = $obj[2];
    $room           = $obj[3];
    $preference     = $obj[4];
    $subjectClass   = $obj[5];

    usort($traineeGroup, "cmpTraineeGroup");
    $slot = [];
    // create time slots
    for ($i = 0 ; $i < TOTAL_SLOTS; $i++){
        $slot[$i] = null;        
    }
    $totalConflicts = 0;
    $firstPeriod = 0;
    $lastPeriod = 9;

    // per classID (0-7) per subject class
    for ($i = 0; $i < sizeof($subjectClass); $i++){
        $sC = $subjectClass[$i]->GetSubjectClassID();
        echo "<br/><br/><br/>-------------------------------------------<b>Subject Class ID: $sC </b>-------------------------------------------<br/>";

        // 	select a random room
        $subjectClass[$i]->SetSubjectClassRoomID( $room[(mt_rand(0, sizeof($room)-1))]    );
        
        //per distBlock( this version uses 1x block or 1 day) w/ 2-3periods{
        $distBlock = $subjectClass[$i]->GetSubjectClassDistributionBlock();
        
        for ($j = 0; $j <  sizeof($distBlock); $j++){
            
            // number of period for this subject per day
            $numPeriod = ($distBlock[$j]);
            
            $sameDay = false;		
            
            while (!$sameDay){
                
                // 	find random (0-9) strating period n
                $classStartingPeriod = mt_rand($firstPeriod, $lastPeriod);
                // 	start at period zero up to period 9
                
                $day = [];
                
                // 	check if random period n to n+NumOfPeriods are all on the same day
                for ($k = $classStartingPeriod; $k < ($classStartingPeriod + $numPeriod); $k++ ){
                    
                    $day[] = ( (int) ($k/TOTAL_PERIODS) );
                    
                }
                $classEndingPeriod = $k-1;
                                
                if (count(array_unique($day)) == 1){
                    // 	same day, break loop
                    $sameDay = true;
                    echo "[ Day:$day[0] Period: $classStartingPeriod - $classEndingPeriod]<br/>";
                }
            }
            
            // 	per period, start random n period up to $k (n+numOfPeriod) period
            for ($l=$classStartingPeriod; $l < $k; $l++){
                $schedID = intval( (string) ($i) . (string) ($j) . (string) ($l) );
                echo "<br>period: >> $l ";				
                     echo "<br>slot $l: ";
                    print_r( $slot[$l]);
                    echo "<br/>";


                // $l is the first period in the distBlock
                if (sizeof($slot[$l]) == 0 ){
                    // create a new schedule;
                    $schedule [ $schedID ]= new Schedules($schedID, $timetable, $subjectClass[$i],  $l);
                    echo "<br/>booked Schedule ID: ";print_r ($schedule [ $schedID ]->GetScheduleID()); echo "";
                    echo "<br/>booked @ Schedule Slot: ";print_r ($schedule [ $schedID ]->GetScheduleSlot()); echo "<br/>";
                    $slot[$l][] = $schedule[ $schedID]->GetScheduleID();
                    print_r( $slot[$l]);
                    echo "<br>--------------------------------------------------<br/>";
                }
                else{ // slot already constains subjectClass/es 
                    // echo "Non-empty slot $l: ";
                    // print_r( $slot[$l]);
                    

                    $schedule [ $schedID ]= new Schedules($schedID, $timetable, $subjectClass[$i],  $l);
                    $slot[$l][] = $schedule[ $schedID]->GetScheduleID();


                    $conflicts = [];
                    for($m = 0; $m < sizeof($slot[$l]); $m++){
                        echo"else: ";print_r( $slot[$l][$m]);echo "<br/>";
                        $tg = ($schedule [ $slot[$l][$m] ]->GetScheduleSubjectClassID()->
                                    GetSubjectClassTraineeGroupID()->GetTraineeGroupName()); 
                        $conflicts[] = $tg;
                        $tr = ($schedule [ $slot[$l][$m] ]->GetScheduleSubjectClassID()->
                                    GetSubjectClassTeacherID()->GetTeacherName()); 
                        $conflicts[] = $tr;
                        $rm =  ($schedule [ $slot[$l][$m] ]->GetScheduleSubjectClassID()->
                                    GetSubjectClassRoomID()->GetRoomName()); 
                        $conflicts[] = $rm;
                       
                        echo "<br/>";

                    }
                    print_r ($conflicts);
                    echo " unique: ";
                    print_r ( count(array_unique($conflicts)) );
                    echo " conflict size: ";
                    print_r (  sizeof($conflicts) );
                    echo " total conflicts: ";
                    print_r ( sizeof($conflicts) - count(array_unique($conflicts)) );
                    echo "<br>------<br/>";




                    $timetable->SetTimetableFitness($timetable->GetTimetableFitness() + ( sizeof($conflicts) - count(array_unique($conflicts)) ));
                    echo "<br/>Non-empty slot: ";print_r ($schedule [ $schedID ]->GetScheduleSlot());
                    echo " day: ".$day[0]." checking for room conflicts<br/> ";

                    print_r( $slot[$l]);

                    echo "<br/>booked Schedule ID: ";print_r ($schedule [ $schedID ]->GetScheduleID()); echo "<br/>";
                    echo "<br/>booked @ Schedule Slot: ";print_r ($schedule [ $schedID ]->GetScheduleSlot()); echo "<br/>";
                    echo "fitness: ".$timetable->GetTimetableFitness();
                    echo "<br>";
;
                }					
            }
            

        }
            
    }
    print_r( $slot);

    return $schedule;
} // end function createTimetables






// $schedule[0] = createTimetables (0);

// echo "<br/><br/>schedule: ";
// print_r(sizeof($schedule[0]));
// $i = 0;
// usort($schedule[0], "cmpSchedule");
// echo "<br>table fitness: ";
// print_r($schedule[0][5]->GetScheduleTimetableID()->GetTimetableFitness());





for($x = 0; $x < 100; $x++){
    $schedule[$x] = createTimetables ($x);
    usort($schedule[$x], "cmpSchedule");
    echo "<br>table #$x fitness: ";
    var_dump($schedule[$x][5]->GetScheduleTimetableID()->GetTimetableFitness());
    $tFitness[] = ($schedule[$x][5]->GetScheduleTimetableID()->GetTimetableFitness());
    echo "<br/";
}

sort($tFitness);
print_r($tFitness);



echo "<br/><br/>";

$i = 0;
echo "<br/>\ti \tGetScheduleID \tGetScheduleSlot\tGetSubjectClassID<br/>";
foreach ($schedule[1] as $key => $value){
    $day = (int) ($i / TOTAL_PERIODS);
    echo "<br/>\t$i";
    if (true){
        echo "\t ";print_r($value->GetScheduleID());
        echo "\t\t ";print_r($value->GetScheduleSlot());
        echo "\t\t\t ";print_r($value->GetScheduleSubjectClassID()->GetSubjectClassID());
        echo "<br/>";
    }else{
        echo " <br/>";
    }

    $i += 1;
}

echo "<br/><br/>";

echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"3px\" >";
echo "<tr> ";
echo "<th>Slot \t Day \t Period</th>"; echo "<th> Details</th>";
echo "</tr>";

// 2-day class schedule
for ($i = 0; $i < TOTAL_PERIODS * 2; $i++){
    $day = (int) ($i / TOTAL_PERIODS);
    $period = (int) ($i % TOTAL_PERIODS);
    echo "<tr>";
    echo "<td>($i) Day: $day Period: $period</td>";

    echo "<td> <table cellpadding=\"0\" cellspacing=\"0\" border=\"1px\">  ";
    
    foreach ($schedule[99] as $key => $value){
        
        if($value->GetScheduleSlot()== $i){
            echo "<tr> <col width=\"200\"><col width=\"200\"> ";
            if ($value->GetScheduleSubjectClassID()->GetSubjectClassRoomID()->GetRoomID() == 401){
                echo "<td style=\"text-align:center;\">";
                print_r($value->GetScheduleSlot()); 
                echo "<b> ";print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassSubjectID()->GetSubjectCode());
                echo " ClassID: ";
                print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassID());
                echo " </b><br/>";
                print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassTraineeGroupID()->GetTraineeGroupName());
                echo " ";
                print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassTraineeGroupID()->GetTraineeGroupID());
                echo "<br/> ";
                echo "Instructor: Mr. ";print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassTeacherID()->GetTeacherName());
                echo "<br/> ";
                echo "Room No.: ";
                        print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassRoomID()->GetRoomID());
               
                
                echo "</td>";
                echo "<td>";                
                   

                echo "</td>";
            }
            if ($value->GetScheduleSubjectClassID()->GetSubjectClassRoomID()->GetRoomID() == 402){
                echo "<td>";
                    

                echo "</td>";
                echo "<td style=\"text-align:center;\">";
                print_r($value->GetScheduleSlot()); 
                echo "<b> ";print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassSubjectID()->GetSubjectCode());
                echo " ClassID: ";
                print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassID());
                echo " </b><br/>";
                print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassTraineeGroupID()->GetTraineeGroupName());
                echo " ";
                print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassTraineeGroupID()->GetTraineeGroupID());
                echo "<br/> ";
                echo "Instructor: Mr. ";print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassTeacherID()->GetTeacherName());
                echo "<br/> ";
                echo "Room No.: ";
                print_r ($value->GetScheduleSubjectClassID()->GetSubjectClassRoomID()->GetRoomID());
               
                echo "</td>";
            }
            echo "</tr>";
        }else{ // no subject class assigned to this current slot;

        }
  
    }
    
    echo "</table> </td> ";
    echo "</tr>";


}
echo "</table>";

// print_r($schedule[0][0]->GetScheduleTimetable()->GetTimetableFitness());