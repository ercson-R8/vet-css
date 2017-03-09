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

    $requiredNumberOfPeriods = 7;

    $preferredNumberOfDays = 4;
    print_r("\nxxxxxxxxxxxxxxxxxxxxxxxxxxxx"."=================================================\n");
    print_r("\nDAYS: ".$preferredNumberOfDays."\nPeriods: ".$requiredNumberOfPeriods);
    $total = 0;
    $block = [];
    for ($i = 0; $i < ($preferredNumberOfDays - 1); $i++){
        $period = (int)( $requiredNumberOfPeriods / $preferredNumberOfDays);
        array_push($block, $period);
        $total += $period;
    }
    array_push($block, ($requiredNumberOfPeriods-$total));
    shuffle($block); // randomize distribution block 
    print_r("\nblock: "."\n");
    print_r($block);




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



    /*
     * sysInfoAction method 
     *
     * @param		
     * @return	 	
     */
    public function sysInfoAction (){
         //cpu stat
        $prevVal = shell_exec("cat /proc/stat");
        $prevArr = explode(' ',trim($prevVal));
        $prevTotal = $prevArr[2] + $prevArr[3] + $prevArr[4] + $prevArr[5];
        $prevIdle = $prevArr[5];
        usleep(0.15 * 1000000);
        $val = shell_exec("cat /proc/stat");
        $arr = explode(' ', trim($val));
        $total = $arr[2] + $arr[3] + $arr[4] + $arr[5];
        $idle = $arr[5];
        $intervalTotal = intval($total - $prevTotal);
        $stat['cpu'] =  intval(100 * (($intervalTotal - ($idle - $prevIdle)) / $intervalTotal));
        $cpu_result = shell_exec("cat /proc/cpuinfo | grep model\ name");
        $stat['cpu_model'] = strstr($cpu_result, "\n", true);
        $stat['cpu_model'] = str_replace("model name    : ", "", $stat['cpu_model']);
        //memory stat
        $stat['mem_percent'] = round(shell_exec("free | grep Mem | awk '{print $3/$2 * 100.0}'"), 2);
        $mem_result = shell_exec("cat /proc/meminfo | grep MemTotal");
        $stat['mem_total'] = round(preg_replace("#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result) / 1024 / 1024, 3);
        $mem_result = shell_exec("cat /proc/meminfo | grep MemFree");
        $stat['mem_free'] = round(preg_replace("#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result) / 1024 / 1024, 3);
        $stat['mem_used'] = $stat['mem_total'] - $stat['mem_free'];
        //hdd stat
        $stat['hdd_free'] = round(disk_free_space("/") / 1024 / 1024 / 1024, 2);
        $stat['hdd_total'] = round(disk_total_space("/") / 1024 / 1024/ 1024, 2);
        $stat['hdd_used'] = $stat['hdd_total'] - $stat['hdd_free'];
        $stat['hdd_percent'] = round(sprintf('%.2f',($stat['hdd_used'] / $stat['hdd_total']) * 100), 2);
        //network stat
        $stat['network_rx'] = round(trim(file_get_contents("/sys/class/net/eth0/statistics/rx_bytes")) / 1024/ 1024/ 1024, 2);
        $stat['network_tx'] = round(trim(file_get_contents("/sys/class/net/eth0/statistics/tx_bytes")) / 1024/ 1024/ 1024, 2);
        //output headers
        header('Content-type: text/json');
        header('Content-type: application/json');
        //output data by json
        echo    
        "{\"cpu\": " . $stat['cpu'] . ", \"cpu_model\": \"" . $stat['cpu_model'] . "\"" . //cpu stats
        ", \"mem_percent\": " . $stat['mem_percent'] . ", \"mem_total\":" . $stat['mem_total'] . ", \"mem_used\":" . $stat['mem_used'] . ", \"mem_free\":" . $stat['mem_free'] . //mem stats
        ", \"hdd_free\":" . $stat['hdd_free'] . ", \"hdd_total\":" . $stat['hdd_total'] . ", \"hdd_used\":" . $stat['hdd_used'] . ", \"hdd_percent\":" . $stat['hdd_percent'] . ", " . //hdd stats
        "\"network_rx\":" . $stat['network_rx'] . ", \"network_tx\":" . $stat['network_tx'] . //network stats
        "}";
        return ;
    }

}