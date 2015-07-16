<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * This file is part of my_application.
 * application/bootstrap.php is responsible to load application routes and classes, then handle all to application/classes/micro.class
 *
 * @package my_application
 * @version    1.7
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * @copyright  2015 Zsolt Sándor
 *
 */



// aura autoloader
use Aura\Autoload\Loader;

// instantiate
$loader = new \Aura\Autoload\Loader;
// append to the SPL autoloader stack; use register(true) to prepend instead
$loader->register();
$loader->addPrefix('Application', '../application/classes');



// kick the application in
use Application\Micro;

$app = new Micro();
$app->run();



///////// debug
// echo DOCROOT . '<br/><br/><hr/>';
// echo APPPATH . '<br/>';
// echo SYSPATH . '<br/>';
// echo SYSPATH . "vendor/autoload.php" . '<br/>';
///////// debug



// eof bootstrap.php
