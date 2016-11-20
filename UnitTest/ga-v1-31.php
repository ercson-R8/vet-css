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
function createTimetables(){
    $timetable  = new Timetables(1, 2016, 1, "blah",0);
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
                $classStartingPeriod = mt_rand($firstPeriod, $lastPeriod-1);
                // 	start at period zero up to period 9
                
                $y = [];
                
                // 	check if random period n to n+NumOfPeriods are all on the same day
                for ($k = $classStartingPeriod; $k < ($classStartingPeriod + $numPeriod); $k++ ){
                    
                    $y[] = ( (int) ($k/TOTAL_PERIODS) );
                    
                }
                $classEndingPeriod = $k-1;
                                
                if (count(array_unique($y)) == 1){
                    // 	same day, break loop
                    $sameDay = true;
                    echo "[ Day:$y[0] Period: $classStartingPeriod - $classEndingPeriod]<br/>";
                }
            }
            
            // 	per period, start random n period up to $k (n+numOfPeriod) period
            for ($l=$classStartingPeriod; $l < $k; $l++){
                $schedID = intval( (string) ($i) . (string) ($j) . (string) ($l) );
                echo "<br>period: >> $l ";				
                    
                // $l is the first period in the distBlock
                if (sizeof($slot[$l]) == 0 ){

                    // create a new schedule;
                    $schedule [ $schedID ]= new Schedules($schedID, $timetable, $subjectClass[$i],  $l);
                    echo "<br/>booked @ Schedule ID: ";print_r ($schedule [ $schedID ]->GetScheduleID()); echo "<br/>";
                    
                    $slot[$l][] = $schedule[ $schedID]->GetScheduleID();
                    
                }
                else{ // slot already constains subjectClass/es                     
                    $schedule [ $schedID ]= new Schedules($schedID, $timetable, $subjectClass[$i],  $l);
                    $slot[$l][] = $schedule[ $schedID]->GetScheduleID();
                    $timetable->SetTimetableFitness($timetable->GetTimetableFitness() + 1);
                    echo "<br/>Non-empty slot: ".$l." day: ".$y[0]." [+1 conflicts] ";
                    echo "<br/>booked @ Schedule ID: ";print_r ($schedule [ $schedID ]->GetScheduleID()); echo "<br/>";
                    echo "fitness: ".$timetable->GetTimetableFitness();
                    
                    $booked = true;
                }					
            }
            

        }
            
    }


    return $schedule;
} // end function createTimetables






$schedule[0] = createTimetables ();
echo "<br/><br/>schedule: ";
print_r(sizeof($schedule[0]));
$i = 0;
usort($schedule[0], "cmpSchedule");
echo "<br/><br/>";

$i = 0;
echo "<br/>\ti \tGetScheduleID \tGetScheduleSlot\tGetSubjectClassID<br/>";
foreach ($schedule[0] as $key => $value){
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

// echo "i = $i";
// print_r($schedule[0]);
echo "<br/><br/>";


echo "<table border=\"2px\">";
echo "<tr> ";
echo "<th>Slot \t Day \t Period</th>"; echo "<th>Room</th>";
echo "</tr>";

// 2-day class schedule
for ($i = 0; $i < TOTAL_PERIODS * 2; $i++){
    $day = (int) ($i / TOTAL_PERIODS);
    $period = (int) ($i % TOTAL_PERIODS);
    echo "<tr>";
    echo "<td>($i) Day: $day Period: $period</td>";

    echo "<td> <table  cellpadding=\"0\" border=\"1\"> ";
    
    foreach ($schedule[0] as $key => $value){
        
        if($value->GetScheduleSlot()== $i){
            echo "<tr>";
            if ($value->GetScheduleSubjectClassID()->GetSubjectClassRoomID()->GetRoomID() == 401){
                echo "<td>401";
                echo "</td>";
                echo "<td>";echo "</td>";
            }elseif ($value->GetScheduleSubjectClassID()->GetSubjectClassRoomID()->GetRoomID() == 402){
                echo "<td>";echo "</td>";
                echo "<td>402";
                echo "</td>";

            }else{
                // echo "<td>";echo "</td>";
            }
            echo "</tr>";
        }else{ // no subject class assigned to this current slot;
            // echo "<td>-";
            // echo "</td>";
        }

        
        
        
    }
    echo "</table> </td> ";
    echo "</tr>";

    

}
echo "</table>";