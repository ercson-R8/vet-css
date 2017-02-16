<?php

namespace App\Controllers\Auth;

use \Core\View;
use App\Models\Auth;

/**
 * RegisterController auth controller
 *
 * PHP version 5.4
 */
class RegisterController extends \Core\Controller
{

    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        // Make sure an admin user is logged in for example
        // return false;
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        //echo 'User admin index';
        
        View::renderTemplate('Auth/register.twig.html');
    }

    /*
     * registerAction method 
     *
     * @param 	
     * @return  void	 
     */
    public function registerAction (){
        
        $message = '';
        $email = ($_POST['email']);
        $password = ($_POST['password']);

        if( Auth::isEmailRegistered($email) > 0){
            $user_exist = true;
            $message = 'E-mail entered already registered.';

        }else{ // register the new user
            $message = Auth::registerNewUser($email, $password);
        }
        
        echo "$message";


    }


}
