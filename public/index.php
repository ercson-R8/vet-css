<?php

/**
 * Front controller
 *
 * PHP version 5.4
 */

/**
 * Composer
 */
require '../vendor/autoload.php';


/**
 * Twig
 */
Twig_Autoloader::register();


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('/', ['controller' => 'Home', 'action' => 'index']);
$router->add('home', ['controller' => 'Home', 'action' => 'index']);
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->add('admin/{controller}/{action}',                 ['namespace' => 'Admin']);
$router->add('Auth/{controller}/{action}',                  ['namespace' => 'Auth']);

$router->add('Resource/{controller}/{action}',              ['namespace' => 'Resource']);
$router->add('Resource/{controller}/{id:\d+}/{action}',     ['namespace' => 'Resource']);

$router->add('Timetable/{controller}/{action}',             ['namespace' => 'Timetable']);
$router->add('Timetable/{controller}/{id:\d+}/{action}',    ['namespace' => 'Timetable']);

$router->add('User/{controller}/{action}',                  ['namespace' => 'User']);
$router->add('User/{controller}/{id:\d+}/{action}',         ['namespace' => 'User']);


$router->dispatch($_SERVER['QUERY_STRING']);

