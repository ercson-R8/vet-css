<?php
// test new branch
$slot = [
    1 => 
    [
        101 => [
            10 => [
                5 => 27
            ]
        ]
    ] 
       

];
echo "<pre>";
echo print_r( ($slot) );

$s = "4,2,3";
$str = explode(",",$s);

print_r($str);




class First{

    private $foreignObject;
    private $message;
    public function __construct($obj=null, $message){
        $this->foreignObject = $obj;
        $this->message = $message;
    }


    public function GetForeignObject(){
        return $this->foreignObject;
    }

    public function GetMessage(){
        return $this->message;
    }

}


class Second{

    private $foreignObject;
    private $message;
    public function __construct($obj, $message){
        $this->foreignObject = $obj;
        $this->message = $message;
    }


    public function GetForeignObject(){
        return $this->foreignObject;
    }

    public function GetMessage(){
        return $this->message;
    }

}


$fObj= new First(null, "hello from first");
$sObj = new Second ($fObj, "hello from second");

echo print_r($fObj);

echo "<br/><br/>";
echo print_r($sObj);

echo "<br/><br/>";
echo $sObj->GetForeignObject()->GetMessage();

$cars=array
    (
    "Volvo"=>array
    (
    "XC60",
    "XC90"
    ),
    "BMW"=>array
    (
    "X3",
    "X5"
    ),
    "Toyota"=>array
    (
    "Highlander"
    )
    );



$cars=array("Volvo","BMW","Toyota");
echo "<br/>Normal count: " . sizeof($cars)."<br>";
echo "Recursive count: " . sizeof($cars,1);
print_r($cars);

echo "unique: ";
print_r ( count(array_unique($cars)) );


echo "<br/><br/> ";
$zipcode = "1000";
$zipcodeInt = (int)$zipcode + 2000;
 
var_dump($zipcodeInt);

list($a[], $b[]) =  explode(',' , "asd, cvb");

$i = '0';
$y = '0';

 $x = intval($i.$y) + 1;
 echo $x;


echo "<br/><br/>";
define("TOTAL_SLOTS", 25);

$x =TOTAL_SLOTS + 100;

print_r($x);


for ($i=0; $i < 10; $i++){
    $d[$i] = $i*5;

}

echo "<br/>";
var_dump($d);

if (in_array(2, $d))
  {
  echo "Match found ".in_array(15, $d, true). "<br>";
  }
else
  {
  echo "Match not found ".in_array(2, $d, true). "<br>";;
  }


$n = null;
if ($n == null)
    echo "n is null";

echo null;