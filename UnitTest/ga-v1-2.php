<?php

require "init-classes.php";






// sort trainee group by level
// the lowest level will be processed first as they would require fewer subjects
function cmpTraineeGroup($a, $b){
	
	return strcmp($a->getTraineeGroupLevel(), $b->getTraineeGroupLevel());
	
}


// ---------------------------
// main code 

$timetable [0] = new Timetables(1, 2016, 1, "blah",0);
print_r ($timetable[0]); 


$obj            = createObjects();
$subject        = $obj[0];
$traineeGroup   = $obj[1];
$teacher        = $obj[2];
$room           = $obj[3];
$preference     = $obj[4];
$subjectClass   = $obj[5];

usort($traineeGroup, "cmpTraineeGroup");
$slot = [];
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
				// 				start at period zero up to period 9
				
				$y = [];
				
				// 	check if random period n to n+NumOfPeriods are all on the same day
				for ($k = $classStartingPeriod; $k < ($classStartingPeriod + $numPeriod); $k++ ){
					
					$y[] = ( (int) ($k/5) );
					
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
                    $schedule [ $schedID ]= new Schedules($schedID, $timetable[0], $subjectClass[$i],  $l);
                    echo "<br/>booked @ Schedule ID: ";print_r ($schedule [ $schedID ]->GetScheduleID()); echo "<br/>";
                    
                    $slot[$l][] = $schedule[ $schedID]->GetScheduleID();

                    $booked = true;
                    
                }
                else{ // slot already constains subjectClass/es                     
                    $schedule [ $schedID ]= new Schedules($schedID, $timetable[0], $subjectClass[$i],  $l);
                    $slot[$l][] = $schedule[ $schedID]->GetScheduleID();
                    $timetable[0]->SetTimetableFitness($timetable[0]->GetTimetableFitness() + 1);
                    echo "<br/>Non-empty slot: ".$l." day: ".$y[0]." [+1 conflicts] ";
                    echo "<br/>booked @ Schedule ID: ";print_r ($schedule [ $schedID ]->GetScheduleID()); echo "<br/>";
                    echo "fitness: ".$timetable[0]->GetTimetableFitness();
                    
                    $booked = true;
                }					
			}
			

		}
		
	}
	echo "<br/><br/><br/>Scheds & times..."."<br>";

    echo "<br/>sizeof(slot)";
    print_r(sizeof($slot));
    echo "<br/>sizeof(schedule)";
    print_r(sizeof($schedule));
    echo "<br/>************<br/>";

    // print_r(($slot));
    
    print_r($timetable[0]);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
