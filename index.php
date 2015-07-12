<?php
/**
 * 
 * This file is part of my_application. 
 * Setting up the configuration vars like in kohanaphp 
 * 
 * @package my_application
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 */

/**
 * The directory in which your application specific resources are located.
 *
 */
$application = '../application';

/**
 * The directory in which the framework resources are located.
 */
$system = '../auraphp';

/**
 * Set the PHP error reporting level. If you set this in php.ini, you remove this.
 * @link http://www.php.net/manual/errorfunc.configuration#ini.error-reporting
 *
 * Dev:			E_ALL | E_STRICT
 * Production:	E_ALL ^ E_NOTICE
 * PHP >= 5.3	E_ALL & ~E_DEPRECATED
 *
 * see further in hohanaphp index.php
 */
error_reporting(E_ALL | E_STRICT);

/**
 * End of standard configuration! Changing any of the code below should only be
 * attempted by those with a working knowledge of Kohana internals.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 */

// Set the full path to the docroot
define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

// Make the application relative to the docroot, for symlink'd index.php
if ( ! is_dir($application) AND is_dir(DOCROOT.$application))
	$application = DOCROOT.$application;

// Make the system relative to the docroot, for symlink'd index.php
if ( ! is_dir($system) AND is_dir(DOCROOT.$system))
	$system = DOCROOT.$system;

// Define the absolute paths for configured directories
define('APPPATH', realpath($application).DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system).DIRECTORY_SEPARATOR);

// Clean up the configuration vars
unset($application, $modules, $system);








// debug
echo DOCROOT . '<br/>';
echo APPPATH . '<br/>';
echo SYSPATH . '<br/>';
echo SYSPATH . "vendor/autoload.php" . '<br/>';



// Kickstart the framework
require SYSPATH . "vendor/autoload.php";

// Bootstrap the application
// require APPPATH.'bootstrap'.EXT;



// execute requests


// eof
