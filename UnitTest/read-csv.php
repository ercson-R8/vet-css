<?php

    // $csvFile = file('test-schedule.csv');
// $file = fopen("test-schedule.csv","r");
// echo "<pre>";
// while(! feof($file))
//   {

//   $data =(fgetcsv($file));
//   print_r($data);
//   //list($name[],$address[],$status[]) = explode(',',$data);
//   }

// fclose($file);
// 
$lines =file('test-schedule.csv');

foreach($lines as $data)
{
list($id[],$address[],$status[]) = explode(',',$data);
}
echo "<pre>";
$data = [$id,$address,$status];
echo print_r($id);
var_dump($address);

var_dump($status);

$subjectID = $id;
$subjectAddress = $address;



$subject = [$subjectID, $subjectAddress];
print_r($subject);

