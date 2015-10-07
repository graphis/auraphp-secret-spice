<?php
/**
 *
 * This file is part of my_application.
 *
 * application/bootstrap.php is responsible to load application routes and classes, 
 * then handle all to application/classes/micro.class
 *
 * @package Auraphp-secret-spice
 * @version	1.1
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * @copyright 2015 Zsolt Sándor
 *
 */

namespace Application;



use Application\Helper\Debug;
use Application\Helper\Arr;
use Application\Constants;

// page controllers
use Application\Page\Error;
use Application\Page\StaticPage;
use Application\Page\DynamicPage;




/**
 *
 * A microframework wrapper for Aura.Router
 * Using aura.view, and aura.autoload
 *
 */
class Application extends Core
{

	/**
	 * Create the application
	 * with the help of the Core
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Add callback for before routing dispatches
	 */
	public function before(){}

	/**
	 * Add callback for after routing dispatches
	 */
	public function after(){}

	/**
	 * Add callback for when routing dispatching is finsihed
	 */
	public function finish(){}

	/**
	 * Render aura.view partials based on slug
	 */
	public function render_static()
	{
		// hands of to static page controller
		$staticpage = new StaticPage($this->slug);
	}

	/**
	 * Assing data to views
	 */
	public function render_dynamic()
	{
		// hands of to dynamic page controller
		$staticpage = new DynamicPage($this->slug);
	}


	public function render_view()
	{
//		echo $this->view->__invoke();
	}

	/**
	 * Run the application:
	 * Application route logic
	 *
	 * @return void
	 */
	public function run()
	{
		// get the incoming request URL path
		$this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		// $this->path = rtrim($path, '/');

		// get the route based on the url and server
		$this->route = $this->router->match($this->path, $_SERVER);

		// 404 error
		if (!$this->route) {
			$error = new Error('404', $this->path);
		}

		// 02 if request is pjax // currenty handled in render_static function
		// if($this->is_pjax()){}
		// 03 check for routes
		// if ($this->route) {
		else {
			// there is a route, now get the params
			$params = $this->route->params;
			// does the route indicate an action?
			if (isset($this->route->params['pjaxpages'])) {
				// take the static page directly from the route and trim the trailing slash from the parameter
				$this->slug = ltrim ( $this->route->params['pjaxpages'], '/' );
			}
			/*
			 * default slug if none is set
			 * root path, since we can not map / to a view
			 */
			if (empty($this->slug ) OR $this->slug === '') {
				$this->slug = 'index';
			}
			/*
			 * static page is set, call render view, which includes the static view, 
			 * othervise get the data from the db
			 */
			if (isset($this->route->params['static_pages'])) {
				$this->render_static();
			} else {
				$this->render_dynamic(); // render views with data from db
			}
		}
		//
		$this->finish();
	}

	//
	public function __destruct(){}

}



// eof Application.php
