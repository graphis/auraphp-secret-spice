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
		// routes
		parent::__construct();
		// parent::__construct(APPPATH . 'configuration/routes.php');
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
	 * @param Closure $callback Closure Callback to be executed
	 * @return void
	 */
	public function render_view()
	{
		// setup views in Core.php
		$this->register_views();

		// set data // demo // call model here instead
		$this->view->setData(array('name' => 'Auraphp-secret-spice -- data from application.php'));

		// check for ajax request
		if ( $this->is_pjax() )
		{
			// this is an ajax request so set partial view based on slug
			$this->view->setView( $this->slug );
		} else {
			// regular http request // partial view based on slug
			$this->view->setView( $this->slug  );
			$this->view->setLayout( 'layout' );
		}

		echo $this->view->__invoke();
	}

	/**
	 * Assing data to views
	 * @param Closure $callback Closure Callback to be executed
	 * @return void
	 */
	public function dynamic_view()
	{
		// get the data from the database
//		$table = Lazer::table('pages')->where('slug', '=', $this->slug)->find();

		$items = array();

		$items['name'] = 'Auraphp-secret-spice -- data from application.php';

//		foreach($table as $row)
//		{
			$items['id']    = $this->slug . '__id';
			$items['slug']  = $this->slug . '___ dynamic data here based on slug hey';
			$items['title'] = $this->slug . '__title';
			$items['body']  = $this->slug . '__ body';
//		}

		// setup views in Core.php
		$this->register_views();

		// assign the data to the view
		$this->view->setData(array(
		    'items' => $items
		));

		// check for ajax request
		if ( $this->is_pjax() )
		{
			// ajax request // set only partial
			$this->view->setView( 'content' );
		} else {
			// regular http request // set partial and layout
			$this->view->setView( 'content'  );
			$this->view->setLayout( 'layout' );
		}

		//
		echo $this->view->__invoke();
	}

	/**
	 * Run the application:
	 * Check routes an execute the dispatch process
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
		 * 01 if no route exists then 404 error
		 * 02 if request is ajax // not used currently as 03 else does not get executed
		 * use only if processing ajax requests requires other logic as normal requests
		 * 03 else process params and get the slug based on the route segment
		 * 01 if there is no route, make an error 404 for this case
		 */
		
		if (!$this->route) {
			// $this->setup_views();
			echo 'no route !';
			$this->debug->page($this->path);
			$this->error('404');
			exit();
		}
		// 02 if request is pjax // currenty handled in render_view function
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
				$this->render_view();
			} else {
				$this->dynamic_view(); // render views with data from db
			}
		}
		//
		$this->finish();
	}

	//
	public function __destruct(){}

}



// eof Application.php
