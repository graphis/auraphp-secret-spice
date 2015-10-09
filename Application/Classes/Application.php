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
 * @copyright Protected by copyright and my army of lawyers!
 *
 */

namespace Application;



use Application\Toolbox\Debug;
use Application\Toolbox\Arr;
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
	 * Version.
	 *
	 * @var string
	 */
	const VERSION = '1.1';

	/**
	 * Create the application
	 * with the help of the Core
	 */
	public function __construct()
	{
		$this->debug = new Debug();
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
		echo $this->slug;
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

		/*
		 * if no valid route was found, then throw an 404 error
		 * if route was found continue // else
		 */
		if (!$this->route) {
			$error = new Error('404', $this->path);
		} else {
			// there is a route, now get the params
			$params = $this->route->params;


			// $this->route->setRedirect( '/index' );
			//////////////////////////////////
			$this->router->add('wild_post', '/post/{id}')
			    ->setWildcard('other');

			$link = $this->router->generate('page', array(
		    'static_pages' => 'index',
			    'other' => array(
			        'foo',
			        'bar',
			        'baz',
			    )
			)); // "/post/88/foo/bar/baz"
			
			// $this->router->redirect($link);
			print_r($link);

			//////////////////////////////////	




			// page controllers practically

			// case 01 ----- dynamic page
			if (isset($this->route->params['pjaxpages'])) {
				// take the static page directly from the route and trim the trailing slash from the parameter
				$this->slug = ltrim ( $this->route->params['pjaxpages'], '/' );

				$this->render_dynamic(); // render views with data from db
			}

			// case 02 ----- static page
			if (isset($this->route->params['static_pages'])) {

				// take the static page directly from the route and trim the trailing slash from the parameter
				$this->slug = ltrim ( $this->route->params['static_pages'], '/' );

				// only for default slug
				if (empty($this->slug ) OR $this->slug === '') {
					$this->slug = 'indexp';
				}

				$this->render_static();
			}





		}
		//
		$this->finish();
	}

	//
	public function __destruct(){}

}



// eof Application.php
