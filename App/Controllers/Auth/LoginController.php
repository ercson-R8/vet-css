<?php

namespace App\Controllers\Auth;

use \Core\View;
use App\Models\DB;
/**
 * LoginController auth controller
 *
 * PHP version 5.4
 */
class LoginController extends \Core\Controller
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
        // echo "before====";
        // $sessionData = Session::getInstance();

       
        // // session_start();
        // print_r($_SESSION);

        // if( isset($_SESSION['user_id']) ){
        //     header("Location: /home/landing");
        // }

    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {
        // Make sure an admin user is logged in for example
        //echo "after";

    }

 
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        //echo 'User admin index';

        View::renderTemplate('Auth/login.twig.html');
    }


    /*
     * Authenticate check user credentials 
     *
     * @param 	 
     *          
     * @return	void
     */

    public function authenticateAction (){
  
        $sessionData = Session::getInstance();
        $db = DB::getInstance();
        $db->select(
            array('user.email', 'user.password', 'user.rights', 'user.first_name', 'user.last_name'),
            array('user'),
            array(
                ['user.email',    '=', $_POST['email'] ]
            )
        );
        $user = ($db->getResults());
        // print_r($user);
        // print_r("\n".$_POST['password']."\n");
        if($db->count() > 0 && password_verify(($_POST['password']), htmlspecialchars( $user[0]->password)) ){
            print_r("\nYou are logged in.."."\n");
            $sessionData->email = $user[0]->email;
            $sessionData->firstName = $user[0]->first_name;
            $sessionData->lastName = $user[0]->last_name;
            $sessionData->password = $user[0]->password;
            $sessionData->rights = $user[0]->rights;

            $sessionData->inSession = true;
            print_r($user[0]);
            print_r($user[0]->email);
            print_r($user[0]->password);
            header("Location: /home/index");

        }else{
            // echo "\nELSE here..";
            View::renderTemplate('Auth/login.twig.html', [
                                            
                'errorMessage' => '<span>&nbsp;</span><div class="alert alert-danger alert-dismissable">
                                   
                                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                   Please verify your email and password.
                                  </div>' 
                ]);

        }

    }

}
