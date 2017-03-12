<?php

namespace App\Controllers\Resource;

use \Core\View;
use App\Controllers\Auth\Session;
/**
 * Home controller
 *
 * PHP version 5.4
 */
class ResourceController extends \Core\Controller
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


    public function addTraineeGroupFormAction(){
        $sessionData = Session::getInstance();
        if ($sessionData->inSession) {
            
            View::renderTemplate ('Resources/addTraineeGroup.twig.html', [
                                        'firstName' => $sessionData->firstName,
                                        'lastName' => $sessionData->lastName,
                                        'pageHeading' => '&nbsp;'
                                    ]);
        }else {
            View::renderTemplate('Auth/login.twig.html');

        }

    }

    public function createTraineeGroupAction(){
        $sessionData = Session::getInstance();
        if ($sessionData->inSession) {

            //print_r($_POST);
            // Array ( [traineeGroup] => Electronics [level] => 1 [section] => A [description] => dfghdfghd dfghdfghdfgh [submit] => )
            // print_r("\n".$_POST["traineeGroup"]."\n");
            foreach ($_POST as $key => $value) {
                # code...
            }
            
            View::renderTemplate ('Resources/addTraineeGroup.twig.html', [
                                        'errorTraineeGroup' => '<div class="alert alert-danger alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <code>Please verify email and password.</code>
                                                            </div>'
                                    ]);
        }else {
            View::renderTemplate('Auth/login.twig.html');

        }

    }
 


}
