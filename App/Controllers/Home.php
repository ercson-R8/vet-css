<?php

namespace App\Controllers;

use \Core\View;

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
        echo "(before) 1 ";
        // if (!session_start()){
		//     session_start();
	    // }

        // if( isset($_SESSION['user_id']) ){
        //     return true;
        // }
        // header("Location: /auth/LoginController/index");
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
    public function indexAction()
    {
        View::renderTemplate ('Home/index.twig.html');

        // View::renderTemplate('Auth/login.twig.php', [
        //     'name'    => 'Ericson',
        //     'colours' => ['red', 'green', 'blue']
        // ]);

    }



    /*
     * logoutAction method 
     *
     * @param 	
     * @return	 
     */
    public function logoutAction (){
                
        if (!session_start()){
		    session_start();
	    }

        session_unset();

        session_destroy();

        header("Location: /auth/LoginController/index");   

    }

    public function testAction(){
        View::renderTemplate('Home/test.twig.html');
    }


}
