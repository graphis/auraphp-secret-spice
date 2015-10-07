<?php
/**
 *
 * This file is part of my_application.
 * application/bootstrap.php is responsible to load application routes and classes, 
 * then handle all to application/classes/micro.class
 *
 * @package my_application
 * @version	1.1
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * @copyright 2015 Zsolt Sándor
 *
 */

namespace Application\Page;

/**
 * error page
 */
class Error extends \Application\Core
{

	/**
	 * construct
	 * @param
	 * @return void
	 */
	public function __construct($code, $path)
	{
		// get the routes
		// echo 'error _____ ';
		http_response_code($code);
		$messages = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Huh?');
		$title = $messages[array_rand($messages)];
		echo $title . ' Sorry, the page <strong>' . $path . '</strong> was not found -- '. $code;
	}

}