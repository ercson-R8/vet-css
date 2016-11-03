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


$slot[0][] = $subjectClass[0];
$slot[0][] = $subjectClass[1];
print_r($slot);
print_r($slot[0][0]->GetSubjectClassTraineeGroupID()->GetTraineeGroupName());

print_r($slot[0][0]->GetSubjectClassDistributionBlock());
print_r($subjectClass[0]);

for ($i = 0; $i < sizeof($subjectClass); $i++){
    for($j = 0; $j <  sizeof($subjectClass[$i]->GetSubjectClassDistributionBlock()); $j++){
        print_r ($subjectClass[$i]->GetSubjectClassDistributionBlock());
        
    }


}


   $array = array("banana","apple","orange","apple");
   
   print_r(array_search("apple", $array));





$a1=array("red","green","red","yellow");
$a2=array("red");

$result=array_intersect($a1,$a2);
print_r($result);

print_r(sizeof($result));


