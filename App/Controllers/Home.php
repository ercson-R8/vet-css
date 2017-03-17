<?php

namespace App\Controllers;

use \Core\View;
use App\Controllers\Auth\Session;
use App\Models\DB;

/**
 * Home controller
 *
 * PHP version 5.4
 */
class Home extends \Core\Controller
{

    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        $sessionData = Session::getInstance();

    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {
        //echo " (after)";
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction(){
        $sessionData = Session::getInstance();
        if ($sessionData->inSession) {
            View::renderTemplate ('Home/index.twig.html', [
                                        'firstName' => $sessionData->firstName,
                                        'lastName' => $sessionData->lastName,
                                        'pageHeading' => 'Current Timetable'
                                    ]);
        }else {
            View::renderTemplate('Auth/login.twig.html');

        }
                                            
    }

    public function demoAction(){
        View::renderTemplate ('Home/demo.twig.html');

    }


    /*
     * logoutAction method 
     *
     * @param 	
     * @return	 
     */
    public function logoutAction (){
                
        $sessionData = Session::getInstance();
        $sessionData->destroy();

        header("Location: /auth/LoginController/index");   

    }


/** 
     * Show some data
     *
     * @return void
     */
    public function showAction()
    {   
        $db = DB::getInstance();
        // $db->query("SELECT * FROM trainee_group WHERE id = {$ID}");
        // $id = "1";
        // // echo "<pre>";
        $db->query("SELECT * FROM room ");
        // foreach ($db->getResults() as $result){
        //     print_r($result);
        // }

        $x = $db->getResults();
        $data = "here is the dadddta";
        
        header('Content-Type: application/json');
        echo json_encode($data);
        
    } 



    /*
     * readTraineeGroup method 
     *
     * @param		
     * @return	 	
     */
    public function readTraineeGroup(){

        if(!empty($_POST["keyword"])) {
            $db = DB::getInstance();
            $keyword = "'".$_POST["keyword"]."%'";
          
            $db->query("SELECT * FROM trainee_group WHERE trainee_group.name LIKE {$keyword} ORDER BY trainee_group.name LIMIT 0,10");
            //  print_r($db->count());
            if ($db->count()){
                ?>
                    <ul id="traineeGroup-list" class="list-unstyled">
                    <?php
                        foreach ($db->getResults() as $result){
                        ?>
                        <li onClick="selectCountry('<?php echo $result->name ?>');"><?php echo $result->name; ?></li>
                        <?php } ?>
                    </ul>
                <?php
            }            
        }

    }


    public function testAction(){

        // $data = "here is the data";
        
        // header('Content-Type: application/json');
        // echo json_encode($data);
 
        View::renderTemplate('Home/test.twig.html');
    }


}
