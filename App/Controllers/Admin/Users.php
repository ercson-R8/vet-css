<?php

namespace App\Controllers\Admin;

use \Core\View;

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
        //echo 'User admin index';
        View::renderTemplate('Admin/index.twig.html');
    }
}
