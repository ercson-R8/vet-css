<?php

require "init-classes.php";


// ---------------------------
// main code
function createTimetable($timetableID){
    $timetable  = new Timetables($timetableID, 2016, 1, "test table",0);
    $rooms = createRooms();
    if (DEBUG_INFO)print_r ($timetable); 
    // foreach ($rooms as $room){
    //     var_dump ($room->GetRoomType());
    // } 
    $subjectClass = createObjects();

    
    for ($i = 0 ; $i < sizeof($subjectClass) ; $i++){
        echo "<br/>=================================================================<br/>";
        var_dump($subjectClass[$i]->GetSubjectClassSubjectID()->GetSubjectName()  );
        //var_dump($subjectClass[$i]->GetSubjectClassDistributionBlock());
        echo "<br>Preferred room type: ";
        var_dump($subjectClass[$i]->GetSubjectClassPreferenceID()->GetPreferenceRoomType());
        echo "<br>";

        $roomSeleted = false;
        while (!$roomSeleted){
            //echo "Random room type ".( $rooms[2]->GetRoomType() )."<br/>";
            
            // select a random room, rooms array index
            $roomNumber = (mt_rand(0, sizeof($rooms)-1)) ;
            if ( $rooms[$roomNumber]->GetRoomType() === $subjectClass[$i]->GetSubjectClassPreferenceID()->GetPreferenceRoomType() ){
                echo "winner is: ".$rooms[$roomNumber]->GetRoomName();
                $roomSeleted = true;

            } 
                        
            
        }

        //per distBlock( this version uses 1x block or 1 day) w/ 2-3periods{
        $distBlock = $subjectClass[$i]->GetSubjectClassDistributionBlock();
        // echo "<br/>Distribution block<br/>";
        // var_dump ($distBlock);


        // subject-classes are taught in "d" number days with "n" number of periods per day
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
                $numPeriod = ($distBlock[$j]);
                // 	check if random period x to x+NumOfPeriods-1 are all on the same day
                for ($k = $classStartingPeriod; $k < ($classStartingPeriod + $numPeriod); $k++ ){
                    
                    $day[] = ( (int) ($k/TOTAL_PERIODS) );
                    
                }

                $classEndingPeriod = $k-1; // -1 because of the for loop
                                
                if (count(array_unique($day)) == 1){
                    // 	same day, break the loop
                    $sameDay = true;
                    if (1)echo "[ Day:$day[0] Period: $classStartingPeriod - $classEndingPeriod]<br/>";
                }
            }

        }

        




        

    }

}


createTimetable (1);
