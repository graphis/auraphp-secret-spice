<?php
/**
 *
 * responsible for setting enviroment paths and for calling application/bootstrap.php
 *
 * @author  Zsolt Sándor <zsolt.sandor@gmx.com>
 * @license https://opensource.org/licenses/MIT
 * @version 1.0
 */

/*
# htaccess
RewriteEngine On
RewriteRule ^$ index.php [QSA]
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php/$1 [QSA,L]
*/

/**
 * Set the PHP error reporting level. If you set this in php.ini, you remove this.
 * Dev: E_ALL | E_STRICT
 * Production: E_ALL ^ E_NOTICE
 * PHP >= 5.3  E_ALL & ~E_DEPRECATED
 */
error_reporting(E_ALL | E_STRICT);

/**
 * Get the start time and memory for use later
 */
define('APP_START_TIME', microtime(TRUE));
define('APP_START_MEM', memory_get_usage());

/**
 * Profile
 */
define('APP_PROFILE', TRUE);

/**
 * If accessed outside of environment don't run...
 */
define('APP', TRUE);

/**
 * Relative path to the application directory.
 */
$application = '../application';

/**
 * Relative path to the framework core. For hideing ugly vendor path
 */
$system = '../system';

/**
 * Application document root
 */
// Set the full path to the DOCROOT
define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

/**
 * Make the application relative to the DOCROOT, for symlink'd index.php
 */
if ( ! is_dir($application) AND is_dir(DOCROOT.$application))
{
	$application = DOCROOT.$application;
}

/**
 * Make the system relative to the doctoot, for symlink'd index.php
 */
if ( ! is_dir($system) AND is_dir(DOCROOT.$system))
{
	$system = DOCROOT.$system;
}

/**
 * Define the absolute paths for configured directories
 */
define('APPPATH', realpath($application).DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system).DIRECTORY_SEPARATOR);

// Clean up the configuration vars
unset($application, $system);



// Kickstart
// $loader = require SYSPATH.'vendor/autoload.php';
require SYSPATH.'vendor/autoload.php';

// load classes also from application/Classes
// $loader->add('Application\\', APPPATH.'classes');


// Start the Application
require APPPATH.'bootstrap.php';



/**
 * Profile
 */
if(defined('APP_PROFILE'))
{
	echo '<hr/>';
	print_r('time     : '.round(microtime(true)-APP_START_TIME, 4).'<br/>');
	print_r('mem      : '.round((memory_get_usage()-APP_START_MEM)/1024/1024, 4).'<br/>');
	print_r('mem peak : '.round((memory_get_peak_usage()-APP_START_MEM)/1024/1024, 4).'<br/>');
}



// eof
