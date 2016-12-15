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
    // subject-classes are taught in "d" number days with "p" number of periods per day
    // this loop is "per" distribution block
    $daysTaken = []; 
    for ($d = 0; $d <  sizeof($distBlock); $d++){
        

        // number of period for this subject per day
        $numPeriod = ($distBlock[$d]);
        echo "<br/>day: $d no. of period/s: ".$numPeriod. "<br/>";

        $sameDay = false;	
        while (!$sameDay){
            
            // 	find random (0-9) strating period n
            $classStartingPeriod = mt_rand(0, TOTAL_SLOTS-1);
            echo "testing start period: ".$classStartingPeriod."<br/>";
            $day = [];
            //$numPeriod = ($distBlock[$j]);
            // 	check if random period x to x+NumOfPeriods-1 are all on the same day
            for ($p = $classStartingPeriod; $p < ($classStartingPeriod + $numPeriod); $p++ ){
                
                $day[] = ( (int) ($p/TOTAL_PERIODS) );
                
            }

            $classEndingPeriod = $p-1; // -1 because of the for loop
                            
            if (count(array_unique($day)) == 1){
                
                $currentDay = ( (int) ($classStartingPeriod / TOTAL_PERIODS) );

                if (in_array ($currentDay, $daysTaken)){
                    $sameDay = false;
                }else {
                    $daysTaken[] = $currentDay;
                    // $slot contains a.array of days with corr. start and end periods
                    $slot[$d] = [$classStartingPeriod , $classEndingPeriod];
                    if (0)echo "[ Day:$day[0] Period: $classStartingPeriod - $classEndingPeriod]<br/>";
                    $sameDay = true;
                } // else 
            } // if 
        } // while
    } // for
    echo "===Day number => +1====: <br/>";
    print_r($daysTaken);
    echo "==========<br/>";
    return $slot;
}


// ---------------------------
// main code
function createTimetable($timetableID, $ay, $term, $desc){
    //$timetable  = new Timetables($timetableID, $ay, $term, $desc, 0);
    $timetable = $timetableID;
    $rooms = createRooms();
    // creates an array of all the room IDs
    // will be used for search of room when a specific room was specified 
    // during the creation of time table 
    foreach ($rooms as $room){
        $roomID[]=$room->GetRoomID();
    }
    // print_r ($roomID);
    if (DEBUG_INFO)print_r ($timetable); 

    // 
    $subjectClass = createSubjecClasses();
    for ($i = 0 ; $i < TOTAL_SLOTS; $i++){
        $scheduleSlot[$i] = null;   
        $schedule[$i] = null;     
    }
    $totalConflicts = 0;
    $schedID = 0;
    
    for ($i = 0 ; $i < sizeof($subjectClass) ; $i++){
        if ($subjectClass[$i]->GetIsPossibleToDistribute ()){

             // verify first if room was already specified/booked, if not then get a room
             if ( $subjectClass[$i]->GetSubjectClassRoomID() == null ){
                $roomNumber = getRoom($rooms, $subjectClass[$i]->GetSubjectClassPreferenceID()->GetPreferenceRoomType());
                $subjectClass[$i]->SetSubjectClassRoomID ($rooms[$roomNumber]);
            
             }else{ // room was prebooked, get the ID specified and search the list of ID to get the room "key"
            
                 $roomNumber = $subjectClass[$i]->GetSubjectClassRoomID(); // contains the room ID int from csv
                 $subjectClass[$i]->SetSubjectClassRoomID ($rooms[array_search($roomNumber, $roomID,true)]);
             }
             

            if (1){
                echo "<br/>======================== <<".$subjectClass[$i]->GetSubjectClassID() .">> =======================================";
                echo"<br/>Subject:<b>\t";print_r($subjectClass[$i]->GetSubjectClassSubjectID()->GetSubjectName()  );
                echo"<br/>Req. Period:<b>\t";print_r($subjectClass[$i]->GetSubjectClassSubjectID()->GetSubjectRequiredPeriod()  );
                echo"</b><br/></b>Group:\t\t<b>";print_r($subjectClass[$i]->GetSubjectClassTraineeGroupID()->GetTraineeGroupName()  );
                echo"<br/></b>Teacher:\t<b>";print_r($subjectClass[$i]->GetSubjectClassTeacherID()->GetTeacherName()  );
                echo "<br></b>Pref. Rm type:\t<b>";print_r($subjectClass[$i]->GetSubjectClassPreferenceID()->GetPreferenceRoomType());
                echo "<br></b>Pref. duration:\t<b>";print_r($subjectClass[$i]->GetSubjectClassPreferenceID()->GetPreferencePreferredNumberDays());
                echo " day/s<br></b>";

                echo "Room selected:  ".$subjectClass[$i]->GetSubjectClassRoomID()->GetRoomName();
                echo "<br></b>Dist block:\t<br/>[day] => [no. of per]<b><br/> ";print_r($subjectClass[$i]->GetSubjectClassDistributionBlock());
                echo "<br></b>";
            }


            // we can also check (later) if periods already supplied otherwise choose a random period
            //$distBlock = $subjectClass[$i]->GetSubjectClassDistributionBlock();
            //echo "<br/>Distribution block<br/>"; var_dump ($distBlock);

            // subjectSlot is an associative array of d number of days with corresponding num of periods. 
            /* Array
                (
                    [0] => Array
                        (
                            [0] => 5
                            [1] => 6
                        )
                    [1] => Array
                        (
                            [0] => 3
                            [1] => 4
                        )
                )
                */
            $subjectSlot = getSlot($subjectClass[$i]->GetSubjectClassDistributionBlock());

            // print_r(($subjectSlot));
            // echo " day/s, First period: ".$subjectSlot[0][0]." Last period: ".$subjectSlot[0][sizeof($subjectSlot[0])-1]."<br/>";
            
            // create a schedule for the current class per day.
            // $subjectSlot contains the number of days along with the number of the periods per day
            for ($s = 0; $s < sizeof($subjectSlot); $s++){
                //print_r($subjectSlot[$s]);
                $firstPeriod = $subjectSlot[$s][0];
                $lastPeriod = $subjectSlot[$s][sizeof($subjectSlot[$s])-1];
                for ($p = $firstPeriod; $p < ($lastPeriod)+1 ; $p++){
                    print_r ($p." * ");
                    // check if the current slot is empty
                    // if it is then reserve the slot 
                    $schedule [$p][]= new Schedules($schedID, $timetable, $subjectClass[$i],  $p);
                    // echo("$p===>".$p."<br/>");
                    $scheduleSlot[$p][] = $subjectClass[$i]->GetSubjectClassID();
                    $schedID += 1;
                } // for 

                
            }// for

        }else {
            echo "<br/><br/><h3>Ooops!</h3>The subject ".$subjectClass[$i]->GetSubjectClassSubjectID()->GetSubjectName();
            echo " cannot be scheduled. <br/>The required number of periods ("
                    .$subjectClass[$i]->GetSubjectClassSubjectID()->GetSubjectRequiredPeriod()
                    .") cannot be spread over <br/>the preferred number of day/s ("
                    .$subjectClass[$i]->GetSubjectClassPreferenceID()->GetPreferencePreferredNumberDays()
                    .") with preferred number of periods per day of "
                    . $subjectClass[$i]->GetSubjectClassPreferenceID()->GetPreferencePreferredNumberPeriodsDay();
            echo "<br/>";
        } // else 
    } // for 
    print_r("<br/>Schedule array: ");
    print_r($scheduleSlot);
    // print_r($schedule);

    return $schedule;

} // function


$timetable[0] = createTimetable (0, 2016, 1, "test table");
print_r($timetable);