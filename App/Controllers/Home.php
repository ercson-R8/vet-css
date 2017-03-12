<?php

namespace App\Controllers;

use \Core\View;
use App\Controllers\Auth\Session;
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

    public function testAction(){
        View::renderTemplate('Home/test.twig.html');
    }


}
