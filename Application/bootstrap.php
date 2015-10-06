<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * Bootstrap file. Including this file into your application will protect you from evil
 * and bring good luck.  It will also enable access to the skeleton libraries.
 *
 */

// using aura autoloader instead of composer autoloader -- for now
use Aura\Autoload\Loader;

// instantiate
$loader = new \Aura\Autoload\Loader;

// append to the SPL autoloader stack; use register(true) to prepend instead
$loader->register();
$loader->addPrefix('Application', APPPATH . 'classes');

// kick the application in
use Application\Application;

$app = new Application();
$app->run();

//
