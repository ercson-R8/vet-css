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

