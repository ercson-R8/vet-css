<?php


namespace App\Controllers;

// use \Core\View;
// use App\Models\DB;
use App\Controllers\Timetable\TestTimetable as TClass;
use App\Controllers\Timetable\Timetable;



class Test extends \Core\Controller {
/* 
 |--------------------------------------------------------------------------
 | TimeTable   
 |--------------------------------------------------------------------------
 | 
 | desc 
 | 
 | 
 | 
 | 
 */

    public function indexAction(){
        echo "testing from controller test....<br/>";
        $t = new Timetable();

        $t->indexAction();
        // TClass::indexAction();
    }



    public function cloneAction(){
        echo "<pre>";
        $a = new TClass(1, 5);
        $b = new TClass(10, 15);
        print_r($a);
        print_r($b);

        $setObj1 = [];
        $setObj1[] = $a;
        $setObj1[] = $b;
        
        print_r($setObj1);
        // $setObj2 = clone $setObj1[0];
        // $setObj2 = clone $setObj1[1];


        // for ($x=0; $x < sizeof($setObj1);$x++){
        //     $setObj2[] = clone $setObj1[$x];
        // }

        foreach($setObj1 as $key => $value){
            $setObj2[] = clone $value;
        }

        $a->setX(100);
        $setObj1[1]->setY (5000);
        print_r("\na->setX(100)=================\n");
        
        print_r("setObj1: "); print_r($setObj1);
        
        print_r("setObj2: ");print_r($setObj2);


    }


        public function testAction(){
        // echo "testing from controller test<br/>";
        $a = [];
        for ($i=0; $i < 10; $i++){
            $a[] = [$i, $i*10];
        }
        echo "<pre>";
        print_r($a);


        $var = 5;
        $ans = (($var==null) ? 'true' : 'false');
        echo "<br/>{$ans} fmod: "; 
        print_r(fmod(10, 4));

        echo "<br/>size: ";
        $array = array ("bye", "bye", "bye", "hello", "hello");
        print_r(sizeof(array_count_values($array)));


        $a=array("a"=>"red","b"=>"green","c"=>1);
        print_r($a);
    echo array_search(1,$a);

    echo "<br/>============================\n";
    // $startMemory = memory_get_usage();
    // $array = range(1, 100000);
    // echo memory_get_usage() - $startMemory, ' bytes<br/>';


    // $startMemory = memory_get_usage();
    // $array = new \SplFixedArray(1000000);
    // for ($i = 0; $i < 10000; ++$i) {
    //     $array[$i] = $i;
    // }
    // echo memory_get_usage() - $startMemory, ' bytes';


    $i = 8;
    $factor = round( (1 / ($i+1)* 100));

    print_r("\nFactor: ".$factor);
    echo "\n";
    $a = ["id" => 12, "age" => 55, "dist" => 5];
        
        asort( $a);
        print_r($a);
        print_r("\nsizeof a: ".sizeof($a));
        print_r("\n");
        print_r(array_pop($a));
       
        print_r("\n");

        print_r("\nrand: ".(rand(0,100)/100)."\n");
        for($i=0; $i < sizeof($a); $i++){
            // print_r($a[sizeof($a)]." ");
            // array_pop($a);
        }







        var_dump(memory_get_usage() );

        print_r("\n");
        $x =(int) 300 * 0.8;
        print_r("\nx=".$x."\n");



    }


    private function getSystemMemInfo() 
{       
    $data = explode("\n", file_get_contents("/proc/meminfo"));
    $meminfo = array();
    foreach ($data as $line) {
        list($key, $val) = explode(":", $line);
        $meminfo[$key] = trim($val);
    }
    return $meminfo;
}

}