<?php


function distributeBlockPeriods($_subjectId = "", $_totalPeriodsPerWeek = 20, $_numberDaysPerWeek=5, $_numberPeriodsPerDay = 2){
    /**
    * test file for GA components
    * alloting number of periods to corresponding number of days per week. 
    * $numberPeriodsPerDay <= $totalPeriodsPerWeek
    * ($numberDaysPerWeek * $numberPeriodsPerDay) >= $totalPeriodsPerWeek
    */
    echo "===========<br/><br/>Testing possibilities for <b>$_subjectId</b><br/>";
    echo "Total number of periods: <b>$_totalPeriodsPerWeek</b><br/>";
    echo "Preferred number of days/week: <b>$_numberDaysPerWeek</b> <br/>";
    echo "Preferred number of periods/day: <b>$_numberPeriodsPerDay</b><br/>";

    if (($_numberDaysPerWeek * $_numberPeriodsPerDay) < $_totalPeriodsPerWeek) {

        echo "<b> NOT POSSIBLE </b>to schedule  <br/><br/>";
        return false;
    }else {
        $totalPeriodsPerWeek = $_totalPeriodsPerWeek;
        $numberDaysPerWeek = $_numberDaysPerWeek;
        $numberPeriodsPerDay = $_numberPeriodsPerDay;
        $remainingPeriods = $totalPeriodsPerWeek;
        $remainingDays = $numberDaysPerWeek;
        $blockPeriod = $numberPeriodsPerDay;
        $dist = [];
        $done = false;

        while (!($done)){
            //echo "rPeriod:$remainingPeriods | rDays:$remainingDays | bPeriod:$blockPeriod |";
            //echo   htmlspecialchars(print_r($dist) ) . " <br/>";
            //echo "------------------------------------------------------------<br/>";
            
            // this is for the last part in allocating block period
            if ( ($remainingPeriods <= $blockPeriod) ){

                if ($remainingDays > 0){
                    // check if the remaining periods can be divided evenly 
                    // on the remaining days. result should be not less than 1
                    // and the remainder should be equal to zero;
                    $isPossibleToDistribute = $remainingPeriods / $remainingDays;
                    if ( fmod($isPossibleToDistribute, 1) == 0   ) { // ($isPossibleToDistribute >= 1)
                        //echo "$isPossibleToDistribute possible <br/>";
                        $blockPeriod = $isPossibleToDistribute; 
                        // distribute the remaining periods to the remaining days
                        for ($i = 0; $i < $remainingDays; $i++){
                            array_push($dist, $blockPeriod);
                        }
                        $done = true;
                        break;
                    }else{ 
                        echo "$isPossibleToDistribute NOT POSSIBLE<br/>";
                        $done = true;
                        $dist = [];
                        break;
                    }
                }else { // since this is the last day, push the remaining periods
                    array_push($dist, $remainingPeriods);
                    $done = true;
                    break;
                }
            }
            array_push($dist, $blockPeriod);
            $remainingDays -= 1;
            $remainingPeriods -= $blockPeriod;
        }

        //echo "<br/><br/>" . (print_r($dist)) . "<br/><br/>";
        shuffle ($dist);
        foreach ($dist as $key => $value){
            $k = $key + 1;
            echo "Day$k : <b>$value </b>| ";
        }
        echo"<br/>";
    }
    return true;
}

$_subjectId = "My Subject Code" . rand(1001, 2000);
distributeBlockPeriods($_subjectId, 15, 4, 4);

for ($i = 0; $i < 50; $i++){
    $totalPeriodsPerWeek = rand(2, 20);
    $numberDaysPerWeek = rand(1, 5);
    $numberPeriodsPerDay = rand(1, 4);;
    $_subjectId = "No. ".$i. " Subject Code" . rand(1001, 2000);
    distributeBlockPeriods($_subjectId, $totalPeriodsPerWeek, $numberDaysPerWeek, $numberPeriodsPerDay);

}

// test new branch