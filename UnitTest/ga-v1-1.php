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

echo "<br/>";


// print_r($preference);




$slot = [];
for($i = 0 ; $i < TOTAL_SLOTS; $i++){
    $slot[$i] = [];
}


$slot[0][] = $subjectClass[0];
// $slot[0][] = $subjectClass[1];
// print_r($slot);
// print_r($slot[0][0]->GetSubjectClassTraineeGroupID()->GetTraineeGroupName());

// print_r($slot[0][0]->GetSubjectClassDistributionBlock());
print_r($subjectClass[0]);

for ($i = 0; $i < sizeof($subjectClass); $i++){
    for($j = 0; $j <  sizeof($subjectClass[$i]->GetSubjectClassDistributionBlock()); $j++){
        print_r ($subjectClass[$i]->GetSubjectClassDistributionBlock()[$j]);
    }


}


























// if (true) echo print_r($traineeGroup);
// $arr = array(0 => array('id'=>1,'name'=>"cat 1"),
//              1 => array(array('id'=>3,'name'=>"cat 2")),
//              2 => array('id'=>2,'name'=>"cat 2")
// );
// $arrIt = new RecursiveIteratorIterator(new RecursiveArrayIterator($arr));

//  foreach ($arrIt as $sub) {
//     $subArray = $arrIt->getSubIterator();
//     if ($subArray['name'] === 'cat 1') {
//         $outputArray[] = iterator_to_array($subArray);
//     }
// }

// print_r($outputArray);