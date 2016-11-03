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