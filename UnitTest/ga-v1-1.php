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
for ($i = 0 ; $i < TOTAL_SLOTS; $i++){
	
	$slot[$i] = [];
	
}


$firstPeriod = 0;
$lastPeriod = 9;


// per classID (0-7) per subject class
for ($i = 0; $i < sizeof($subjectClass); $i++){
	
	// 	$r = (mt_rand(1, sizeof($room)));
	
	// 	echo "<br/>room: ";
	// print_r($r);
	echo "<br/>";
	
	$subjectClass[$i]->SetSubjectClassRoomID( $room[(mt_rand(0, sizeof($room)-1))]    );
	
	//per distBlock( this version uses 1x block or 1 day) w/ 2-3periods{
		
		for ($j = 0; $j <  sizeof($subjectClass[$i]->GetSubjectClassDistributionBlock()); $j++){
			
			// number of period for this subject per day
			$numPeriod = ($subjectClass[$i]->GetSubjectClassDistributionBlock()[$j]);
			
			$sameDay = false;
			
			
			
			while (!$sameDay){
				
				// 				find random (0-9) strating period n
				$classStartingPeriod = mt_rand($firstPeriod, $lastPeriod-1);
				// 				start at period zero up to period 9
				
				$y = [];
				
				// 	check if random period n to n+NumOfPeriods are all on the same day
				for ($k = $classStartingPeriod; $k < ($classStartingPeriod + $numPeriod); $k++ ){
					
					$y[] = ( (int) ($k/5) );
					
				}
				
				// 				print_r(($y));
				
				if (count(array_unique($y)) == 1){
					// 					same day, break loop
					$sameDay = true;
					
					echo "<br/>=========classStartingPeriod: $classStartingPeriod<br/><br/> ";
					
				}
				
			}
			
			
			// 			per period, start random n period up n+numOfPeriod period
			for ($l=$classStartingPeriod; $l < $k; $l++){
				
				echo "<br> >> $l - ";
				
				$booked = false;
				
				// 				select a random room
				while (!$booked){
					
					if (sizeof($slot[$classStartingPeriod]) == 0 ){
						
						// print_r($slot[$classStartingPeriod]);
						
						$slot[$l] = $subjectClass[$i];
						
						echo "<br>";
						
						print_r($slot[$l]->GetSubjectClassInformation());
                        $booked = true;
						
					}
					else{
						
						
					}
					
					
					$booked = true;
					
					
				}
				
				
			}
			

		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// 	$array = array("banana","apple","orange","apple");
	
	// 	print_r(array_search("apple", $array));
	
	// 	$a1=array("red","green","red","yellow");
	
	// 	$a2=array("red");
	
	// 	$result=array_intersect($a1,$a2);
	
	// 	print_r($result);
	
	// 	print_r(sizeof($result));
	
	// 	echo "<br/>";
	
	// 	echo "period: ";
	
	// 	echo ((int) ((0%5)+1));
	// 	int(3)   
	// 	echo "<br/>";
	
	// 	echo "day: ";
	
	// 	echo((int) ((0/5)+1));
	// 	float(4)   