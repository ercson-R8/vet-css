<?php

namespace App\Controllers\Auth;

// use \Core\View;
// use App\Models\Auth;
use App\Controllers\Test\Test;
/**
 * LoginController auth controller
 *
 * PHP version 5.4
 */
class Demo extends \Core\Controller
{
    public function __construct(){

    }
    
   public function indexAction(){
       $m = new Test;
    echo $m->Message();
    echo "hi from demo";
   }

}
