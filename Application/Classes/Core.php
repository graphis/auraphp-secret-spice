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

namespace Application;

use Aura\Router\RouterFactory;
use Aura\View\View;
use Application\Toolbox\Arr;
use Application\Exception;


/**
 *
 * @package Auraphp-secret-spice
 * @license http://opensource.org/licenses/MIT MIT
 *
 * Core utils
 *
 */
class Core
{

	//
	const ROUTERMAP = 'configuration/routes.php';

	/**
	 * construct
	 * @param
	 * @return void
	 */
	public function __construct()
	{
		// get the routes
		$this->getRoutes();
	}

	/**
	 * get routes
	 *
	 * Routes are defined in application/config/routes.php
	 * @return Aura\Router\Map
	 */
	public function getRoutes()
	{
		// initiate router
		$this->router_factory = new RouterFactory();
		$this->router = $this->router_factory->newInstance();

		if (file_exists(APPPATH . self::ROUTERMAP)) {
			include_once(APPPATH . self::ROUTERMAP);
		} else {
			// Fall back on some sensible defaults.
			throw new Exception('No routes defined');
			$this->router->add(null, '/');
		}
		
		
		//
		// create a factory with a base path
//		$router_factory = new RouterFactory('/path/to/subdir');
		
		

	}

	/**
	 * setting up views and registering them
	 */
	public function register_views()
	{
		/////////////////// view
		// initiate views
		$view_factory = new \Aura\View\ViewFactory;
		$this->view = $view_factory->newInstance();

		// the "main" template
		$layout_registry = $this->view->getLayoutRegistry();
		$view_registry = $this->view->getViewRegistry();

		// views config file
		$views = include APPPATH . 'configuration/views.php';

		if (is_array($views))
		{
			// 00 vars
			$folder   = Arr::path($views, 'views.path');
			$layout   = Arr::path($views, 'views.layout');
			$error    = Arr::path($views, 'views.error');
			$partials = Arr::path($views, 'views.partials');

			// 01 main template
			$layout_registry->set('layout', APPPATH . $folder . DIRECTORY_SEPARATOR . $layout);

			// error template
			$layout_registry->set('error',  APPPATH . $folder . DIRECTORY_SEPARATOR . $error);

			// 02 sub templates
			foreach ($partials as $key => $value)
		    {
				$view_registry->set( $key,  APPPATH . $folder . DIRECTORY_SEPARATOR . $value );
				// echo $key,  APPPATH . $folder . DIRECTORY_SEPARATOR . $value . '<br/>' ;
			}
		}
	}

	/**
	 * route not found -- 404 error
	 * @param Closure $callback Closure Callback to be executed
	 * @return void
	 */
	public function error($code)
	{

		// handle to a function
		// no route found --- error 404
		http_response_code($code);
		$messages = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Huh?');
		$title = $messages[array_rand($messages)];
		echo $this->path;
		echo $title . ' Sorry, page is not there -- '. $code;

		// error template
		// $this->setup_views();
		// $this->view->setLayout( 'error' );
		// echo $this->view->__invoke();
		// exit('as');
	}

	/**
	 * Checks for ajax request
	 * @return bool
	 */
	public static function is_pjax()
	{
		// if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		if(isset($_SERVER['HTTP_X_PJAX']) && $_SERVER['HTTP_X_PJAX'] == 'true')
		{
			return TRUE;
		}
		return FALSE;
	}

}