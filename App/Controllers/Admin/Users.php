<?php

namespace App\Controllers\Admin;

// use \Core\View;
use App\Controllers\Auth\Demo;
/**
 * User admin controller
 *
 * PHP version 5.4
 */
class Users extends \Core\Controller
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
        $d = new Demo();
        //echo 'User admin index';
        \Core\View::renderTemplate('Admin/index.twig.html');
        $d->indexAction();
        $r = new \Core\Router();
        print_r($r);

    }
}
