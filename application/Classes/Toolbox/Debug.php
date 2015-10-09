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



namespace Application\Toolbox;



/**
 *
 * Debug class
 * logs to console, or to the browser page
 *
 */
class Debug
{

	/**
	 * Send debug code to the Javascript console
	 */ 
	public function console($data) {
	    if(is_array($data) || is_object($data))
		{
			echo("<script>console.log(' PHP > ".json_encode($data)."');</script>");
		} else {
			echo("<script>console.log(' PHP > ".$data."');</script>");
		}
	}
	
	/**
	 * Send debug code to the browser page
	 */ 
	public function page($data)
	{
		echo '<br/>';
		echo '<pre><code>';
		print_r($data);
		echo '</code></pre>';
		echo '<br/>';
	}

}

//
