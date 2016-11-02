<?php

require "test-csv.php";
require "SubjectClasses.php";


function getObjectID( $obj, $getter ){
    
    for ($j=0; $j < sizeof($obj); $j++){
        $localObj [] = $obj[$j]->$getter();
    }
    return $localObj;
}

// sort trainee group by level
// the lowest level will be processed first as they would require fewer subjects
function cmp($a, $b)
{
    return strcmp($a->getTraineeGroupLevel(), $b->getTraineeGroupLevel());
}




// ---------------------------
// main code 

usort($traineeGroup, "cmp");


// echo "<br/><pre>the 1st key is: ".print_r($preference[1]->GetPreferenceTraineeGroupID());
echo "<br/>";

$tg = getObjectID ($traineeGroup, 'GetTraineeGroupID');
$sb = getObjectID ($subject, 'GetSubjectID' );
$tr = getObjectID ($teacher, 'GetTeacherID');
print_r($sb);
print_r($tg);
print_r($tr);
print_r($preference);
// echo array_search($preference[7]->GetPreferenceTraineeGroupID(),$tg,true);
// print_r($traineeGroup[0]);

// $subjectClass = [];

    // $subjectClass = new SubjectClasses (7,
    //     $subject[array_search($preference[7]->GetPreferenceTraineeGroupID(),$tg,true) ],
    //     $traineeGroup[array_search($preference[7]->GetPreferenceTraineeGroupID(),$sb,true)],
    //     $teacher[array_search($preference[7]->GetPreferenceTraineeGroupID(),$tr,true)],
    //     null,
    //     $preference [7]
    //     );

for ($i = 0; $i < sizeof($preference); $i++){
        $subjectClass[$i] = new SubjectClasses ($i,
                            $subject[array_search($preference[$i]->GetPreferenceSubjectID(),$sb,true) ],
                            $traineeGroup[array_search($preference[$i]->GetPreferenceTraineeGroupID(),$tg,true)],
                            $teacher[array_search($preference[$i]->GetPreferenceTeacherID(),$tr,true)],
                            null,
                            $preference [$i]
                            );
}



// $subjectClass[0]->SetSubjectClassRoomID($room[0]);

// print_r($subjectClass);     

// print_r($subjectClass[0]->GetSubjectClassRoomID()->GetRoomName() );











































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