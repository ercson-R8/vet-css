<?php


namespace App\Controllers;

// use \Core\View;
// use App\Models\DB;
use App\Controllers\Timetable\TestTimetable as TClass;
use App\Controllers\Timetable\TestTimetable2 as TClass2;
use App\Controllers\Timetable\Timetable;
use App\Models\DB;


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
        $u = new Timetable();
        $v = new Timetable();
        $w = new Timetable();

        $t->indexAction();
        $u->indexAction();
        $v->indexAction();
        $w->indexAction();
        $w->indexAction();
        // TClass::indexAction();
    }



    public function cloneAction(){


        echo "<pre>";
        
        // $a = new TClass(1, 5);
        // $b = new TClass(10, 15);

        // $x = new TClass2(500, 1000, $a);

        // print_r("\nAAAAAAAAAAAAAAAAAa:\n");
        // print_r($a);
        
        // print_r("\nBBBBBBBBBBBBBBBBb:\n");
        // print_r($b);
        // print_r("\nXxxxxxxxxxxxxxx:\n");
        // print_r($x);

        for($i=0; $i < 3; $i++){
            $setA[]= new TClass ($i+1, $i+11);
        }

        $setX = [];
        for($i=0; $i < 3; $i++){
            $setX [] = new TClass2($i*150, $i*200,clone $setA[$i]);
        }

        
        print_r("\nsetX------------\n");
        print_r($setX);


        print_r("\nsetA------------\n");
        print_r($setA);

        $cloneX = clone ($setX[2]);
        // $cloneX = unserialize(serialize($setX[2]));
        // $cloneX = clone ($setX[0]);
        $setA[2]->setXY(8, 8);
        print_r("\n------cloneX---------\ncloneX = clone (setX[2]);\nsetA[2]->setXY(8, 8);\n");
        print_r ($cloneX);

        print_r("\nsetX------------\n");
        print_r($setX);


        print_r("\nsetA------------\n");
        print_r($setA);

        // $cloneX = unserialize(serialize($setX[2]));
        // // $cloneX = clone ($setX[0]);
        // $setA[2]->setXY(8, 8);
        // print_r("\ncloneX------------\n");
        // print_r ($cloneX);

        // print_r("\nsetA------------\n");
        // print_r($setA[2]);


        



        // $cloneX1 = unserialize(serialize($cloneX));
        // $setA[2]->setXY(8, 8);
        // $cloneX->getTC()->setXY(69, 88);


        // print_r("\ncloneX1------------\n");
        // print_r ($cloneX1);



        print_r("\n\n\n\n\n=======================================\n");
        //         $setObj1 = [];
        // $setObj1[] = $a;
        // $setObj1[] = $b;
        
        // print_r($setObj1);
        // // $setObj2 = clone $setObj1[0];
        // // $setObj2 = clone $setObj1[1];


        // // for ($x=0; $x < sizeof($setObj1);$x++){
        // //     $setObj2[] = clone $setObj1[$x];
        // // }

        // foreach($setObj1 as $key => $value){
        //     $setObj2[] = clone $value;
        // }

        // $a->setX(100);
        // $setObj1[1]->setY (5000);
        // print_r("\na->setX(100)=================\n");
        
        // print_r("setObj1: "); print_r($setObj1);
        
        // print_r("setObj2: ");print_r($setObj2);


    }


        public function testAction(){
        // echo "testing from controller test<br/>";
        $a = null;
        if (isset ($a)){
            echo "isset a";
        }else{
            echo "!isset a";
        }


        for ($i=0; $i < 5; $i++){
            $a[] = [$i, $i*5];
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



    public function testDBAction(){
        $db = DB::getInstance();
        // $db->query("SELECT * FROM trainee_group WHERE id = {$ID}");
        $id = "1";
        echo "<pre>";
        $db->query("SELECT * FROM room ");
        foreach ($db->getResults() as $result){
            print_r($result);
        }

 



    }

}