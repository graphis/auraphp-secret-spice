<?php
/**
 *
 * This file is part of my_application.
 * application/bootstrap.php is responsible to load application routes and classes, 
 * then handle all to application/classes/micro.class
 *
 * @package my_application
 * @version	1.7
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * @copyright 2015 Zsolt Sándor
 *
 */

namespace Application;


// vendor classes
use Aura\Router\RouterFactory;
use Aura\View\View;

// Application utils
use Application\Helper\Arr;
// use Application\Helper\Debug;



/**
 *
 * @package Auraphp-secret-spice
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 * A microframework wrapper for Aura.Router based off of the Silex api
 *
 */
class Core
{


	const ROUTERMAP = 'configuration/routes.php';


	public function __construct()
	{

		// initiate router
		$this->router_factory = new RouterFactory;
		$this->router = $this->router_factory->newInstance();

		// get the routes
		$this->getRoutes();

	}



	/**
	 * get routes
	 *
	 * @return Aura\Router\Map
	 */
	public function getRoutes()
	{
		// echo '_____________________________' . __FUNCTION__ . '<br/>';

		// Routes are defined in application/config/routes.php
		if (file_exists(APPPATH . self::ROUTERMAP)) {
			// Let the app specify it's own routes.
			include_once(APPPATH . self::ROUTERMAP);
		} else {

			// Fall back on some sensible defaults.
			// /
			$this->router->add(null, '/');
		}

	}



	/**
	 * setting up views and registering them
	 */
	public function setup_views()
	{
	
		/////////////////// view
		// initiate views
		$view_factory = new \Aura\View\ViewFactory;
		$this->view = $view_factory->newInstance();

		// the "main" template
		$layout_registry = $this->view->getLayoutRegistry();
		$view_registry = $this->view->getViewRegistry();

		// config file
		$views = include APPPATH . 'configuration/views.php';

		if (is_array($views))
		{
			// 00
			// vars
			$folder   = Arr::path($views, 'views.path');
			$layout   = Arr::path($views, 'views.layout');
			$partials = Arr::path($views, 'views.partials');

			// 01 
			// main template
			$layout_registry->set('layout', APPPATH . $folder . DIRECTORY_SEPARATOR . $layout);

			// 02
			// sub templates
			foreach ($partials as $key => $value)
		    {
				$view_registry->set( $key,  APPPATH . $folder . DIRECTORY_SEPARATOR . $value );
			}
		}
		// OK
	
	}



	/**
	 * route not found -- 404 error
	 * @param Closure $callback Closure Callback to be executed
	 * @return void
	 */
	public function error($code)
	{
		// echo '_____________________________' . __FUNCTION__ . '<br/>';

		// handle to a function
		// no route found --- error 404
		http_response_code($code);
		$messages = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Huh?');
		$title = $messages[array_rand($messages)];
		echo $this->path;
		echo $title . ' Sorry, page is not there -- '. $code;
		// exit();
	}



	/**
	 * Checks if pjax is setting
	 * @param Closure $callback Closure Callback to be executed
	 * @return void
	 */
	function is_pjax()
	{
		// echo '_____________________________' . __FUNCTION__ . '<br/>';

		// if( isset( $_SERVER['HTTP_X_PJAX'] ) && strtolower( $_SERVER['HTTP_X_PJAX'] ) == 'true' ) {
		if(isset($_SERVER['HTTP_X_PJAX']) && $_SERVER['HTTP_X_PJAX'] == 'true')
		{
			return TRUE;
		}
		return FALSE;
	}




}