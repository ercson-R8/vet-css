<?php

require "init-classes.php";


/**
* getRoom  
*
* @param 	object  $rooms,  conataining room info 
*           string  $preferenceRoomType, the room type
* @return   int     $roomNumber, the selected room number
*/
function getRoom($rooms , $preferenceRoomType){
    $roomSeleted = false;
    while (!$roomSeleted){

        // select a random room, rooms array index
        $roomNumber = (mt_rand(0, sizeof($rooms)-1)) ;
        if ( $rooms[$roomNumber]->GetRoomType() === $preferenceRoomType ){
            $roomSeleted = true;
        } // if

    } // while
    return $roomNumber;
}

/**
* getSlot  
*
* @param 	array   $distBlock, from class Preferences 
* @return   array   $slot, the selected slot per day for the subject
*/
function getSlot($distBlock){
    // subject-classes are taught in "d" number days with "n" number of periods per day
    // this loop is "per" distribution block
    $daysTaken = []; 
    for ($j = 0; $j <  sizeof($distBlock); $j++){
        

        // number of period for this subject per day
        $numPeriod = ($distBlock[$j]);
        echo "<br/>day: $j-> ".$numPeriod. "<br/>";

        $sameDay = false;	
        while (!$sameDay){
            
            // 	find random (0-9) strating period n
            $classStartingPeriod = mt_rand(0, TOTAL_SLOTS-1);
            echo "start period: ".$classStartingPeriod."<br/>";
            $day = [];
            //$numPeriod = ($distBlock[$j]);
            // 	check if random period x to x+NumOfPeriods-1 are all on the same day
            for ($k = $classStartingPeriod; $k < ($classStartingPeriod + $numPeriod); $k++ ){
                
                $day[] = ( (int) ($k/TOTAL_PERIODS) );
                
            }

            $classEndingPeriod = $k-1; // -1 because of the for loop
                            
            if (count(array_unique($day)) == 1){
                
                $currentDay = ( (int) ($classStartingPeriod / TOTAL_PERIODS) );

                if (in_array ($currentDay, $daysTaken)){
                    $sameDay = false;
                }else {
                    $daysTaken[] = $currentDay;
                    $slot[$j] = [$classStartingPeriod , $classEndingPeriod];
                    if (0)echo "[ Day:$day[0] Period: $classStartingPeriod - $classEndingPeriod]<br/>";
                    $sameDay = true;
                } // else 
            } // if 
        } // while
    } // for
    echo "===Days====: <br/>";
    print_r($daysTaken);
    echo "==========<br/>";
    return $slot;
}


// ---------------------------
// main code
function createTimetable($timetableID, $ay, $term, $desc){
    $timetable  = new Timetables($timetableID, $ay, $term, $desc, 0);
    $rooms = createRooms();
    if (DEBUG_INFO)print_r ($timetable); 
    // foreach ($rooms as $room){
    //     var_dump ($room->GetRoomType());
    // } 
    $subjectClass = createObjects();
    for ($i = 0 ; $i < TOTAL_SLOTS; $i++){
        $slot[$i] = null;        
    }
    $totalConflicts = 0;
    $schedID = 0;
    
    for ($i = 0 ; $i < sizeof($subjectClass) ; $i++){
        echo "<br/>=================================================================<br/>";
        print_r($subjectClass[$i]->GetSubjectClassSubjectID()->GetSubjectName()  );
        //var_dump($subjectClass[$i]->GetSubjectClassDistributionBlock());
        echo "<br>Preferred room type: ";
        print_r($subjectClass[$i]->GetSubjectClassPreferenceID()->GetPreferenceRoomType());
        echo "<br>";

        // we can also verify first if room was already specified, if not then get a room
        $roomNumber = getRoom($rooms, $subjectClass[$i]->GetSubjectClassPreferenceID()->GetPreferenceRoomType());
        echo "winner is: ".$rooms[$roomNumber]->GetRoomName();

        // we can also check if periods already supplied otherwise choose a random period
        $distBlock = $subjectClass[$i]->GetSubjectClassDistributionBlock();
        //echo "<br/>Distribution block<br/>"; var_dump ($distBlock);

        $subjectSlot = getSlot($distBlock);
        //print_r($subjectSlot);
        //echo "First period: ".$subjectSlot[0][0]." Last period: ".$subjectSlot[0][sizeof($subjectSlot[0])-1]."<br/>";
        
        // create a schedule for the current class per day.
        // $subjectSlot contains the number of days along with the number of periods per day
        for ($s = 0; $s < sizeof($subjectSlot); $s++){
            //print_r($subjectSlot[$s]);
            $firstPeriod = $subjectSlot[$s][0];
            $lastPeriod = $subjectSlot[$s][sizeof($subjectSlot[$s])-1];
            for ($p = 0; $p < ($lastPeriod - $firstPeriod)+1 ; $p++){
                print_r ($subjectSlot[$s][$p]." ");
                // check if the current slot is empty
                // if it is then reserve the slot 
                if (sizeof($slot[$s]) == 0 ){
                    //$schedule [ $schedID ]= new Schedules($schedID, $timetable, $subjectClass[$i],  $l);

                }else{ // slot is not empty 

                    
                }// else 


                $schedID += 1;
            } // for 

            
        }// for 










        
    } // for 

} // function


createTimetable (1, 2016, 1, "test table");
