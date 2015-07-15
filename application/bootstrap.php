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


// instantiate
$loader = new \Aura\Autoload\Loader;

// append to the SPL autoloader stack; use register(true) to prepend instead
$loader->register();

$loader->addPrefix('Application', '../application/classes');

use Application\Micro;


// do
// $frontController = new Micro();
// $frontController->run('/', 'a');
// $frontController->run($path, $route);

// examine the debug information
// var_dump($loader->getDebug());

$app = new Micro();

$app->run();





///////// debug
echo DOCROOT . '<br/>';
echo APPPATH . '<br/>';
echo SYSPATH . '<br/>';
echo SYSPATH . "vendor/autoload.php" . '<br/>';
///////// debug







// eof bootstrap.php
