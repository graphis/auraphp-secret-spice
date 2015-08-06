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
 * @copyright  2015 Zsolt Sándor
 *
 */

namespace Application;

// vendor classes
// use Aura\Router\RouterFactory;
// use Aura\View\View;

// application thingies
// use Application\Helper\Arr;
use Application\Helper\Debug;




use Lazer\Classes\Database as Lazer; // example
define('LAZER_DATA_PATH', APPPATH .'database/'); //Path to folder with tables





/**
 *
 * @package Aura.Micro
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 * A microframework wrapper for Aura.Router based off of the Silex api
 *
 */
class Application extends \Application\Core
{



	/**
	 * Create an application
	 *
	 * @uses Aura\Router\RouterFactory;
	 */
	public function __construct()
	{
		// echo '_____________________________' . __FUNCTION__ . '<br/>';

		parent::__construct();

		// setting up debug stuff
		$this->debug = new Debug();
		$this->debug->console('hi from the debug class to console');
		$this->debug->page('hi from the debug class to page');

		// $this->before();

		// initiate router
//		$this->router_factory = new RouterFactory;
//		$this->router = $this->router_factory->newInstance();

		// get the routes
//		$this->getRoutes();

		// $this->after();
	}











	/**
	 * Add callback for before routing dispatches
	 * @param Closure $callback Closure Callback to be executed
	 * @return void
	 */
	public function before()
	{
		// echo '_____________________________' . __LINE__ . '<br/>';
	}

	/**
	 * Add callback for after routing dispatches
	 * @param Closure $callback Closure Callback to be executed
	 * @return void
	 */
	public function after()
	{
		// echo '_____________________________' . __FUNCTION__ . '<br/>';	}
	}

	/**
	 * Add callback for when routing dispatching is finsihed
	 * @param Closure $callback Closure Callback to be executed
	 * @return void
	 */
	public function finish()
	{
		echo '_____________________________' . __FUNCTION__ . '<br/>';
		echo '<pre>';
		

		
//		Lazer::create('pages', array(
//		    'id'    => 'integer',
//			'slug'    => 'string',
//		    'title' => 'string',
//			'body'  => 'string'
//		));

/*
		$row = Lazer::table('pages');
		$row->slug = 'zsele';
		$row->title = 'zsele ___title___';
		$row->body = 'zsele ___body___';
		$row->save();


		$row = Lazer::table('pages');
		$row->slug = '974';
		$row->title = '974 ___title___';
		$row->body = '974 ___body___';
		$row->save();

		$row = Lazer::table('pages');
		$row->slug = 'index';
		$row->title = 'index ___title___';
		$row->body = 'index ___body___';
		$row->save();

*/



//		$row = Lazer::table('pages');

		// Multiple select
//		$table = Lazer::table('pages')->findAll();
//		foreach($table as $row)
//		{
//			echo '<pre>';
		    // print_r($row);
//		    print_r($row->id . '<br/>');
//		    print_r($row->slug . '<br/>');
//			print_r($row->title . '<br/>');
//			print_r($row->body . '<br/>');
//			echo '</pre>';			
//		}

		// Single record select
		// $row = Lazer::table('pages')->find(1);
		// print_r($row);
		
		// echo $this->staticpage;
		$row = Lazer::table('pages')->where('slug', '=', $this->slug)->find();
		// echo $row->title;
		print_r($row);









//		$cars = array(
//		array("Volvo",22,18),
//		array("BMW",15,13),
//		array("Saab",5,2),
//		array("Land Rover",17,15)
//		);




		// views
//		$zzs = array(
//		    'views' => [

//		        'path' => 'views',					// in application / views /

//				'layout' => 'layout.php',			// main layout file

//			        'partials' => [					// partial views
//		            	'index'  => '_index.php',
//						'974'    => '_974.php',
//						'zsele'  => '_zsele.php'
//		        ]

//		    ]
//		);















		echo '</pre>_____________________________<br/>';
	}


	





	/**
	 * Add callback for when routing dispatching is finsihed
	 * @param Closure $callback Closure Callback to be executed
	 * @return void
	 */
	public function render_view()
	{
		// echo '_____________________________' . __FUNCTION__ . '<br/>';

		// setup views in Core.php
		$this->setup_views();

		// set data
		$this->view->setData(array('name' => 'Aura -- data from micro.php'));

		// echo $this->staticpage;
		// if request is ajax -- pjax
		if ( $this->is_pjax() )
		{
//			$this->debug('pjax true');
			$this->view->setView( $this->slug );
//			if (isset ($static)) {
//				$view->setView( $static );
//			} else {
//				$view->setView( 'browse' );
//			}

		} else {
//			if (isset ($static)) {
//				$view->setView( $static );
//			} else {
//				$view->setView( 'browse' );
//			}
			$this->view->setView( $this->slug  );
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
//	public function run($path = null, $request = null)
	public function run()
	{
		// echo '_____________________________' . __FUNCTION__ . '<br/>';

		// get the incoming request URL path
		$this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		// $this->path = rtrim($path, '/');

		// get the route based on the url and server
		$this->route = $this->router->match($this->path, $_SERVER);


		// if there is no route, make an error 404 for this case
		if (!$this->route) {
			echo 'no route !';
			$this->debug->page($this->path);
			$this->error('404');
			exit();
		}

		// if request is pjax // currenty handled in render_view function
		// if( $this->is_pjax() )
		// {
			
		// }










		// way 2
		//
//		try {
			// check for routes
			if ($this->route) {

				// there is a root, now get the params
				$params = $this->route->params;

				// does the route indicate an action?
				if (isset($this->route->params['pjaxpages'])) {
					
					// take the static page directly from the route
					// but we must trim the trailing slash from the parameter // why is that?
					$slug =  ltrim ( $this->route->params['pjaxpages'], '/' );

					// $staticpage = $params['pjaxpages'];
					// unset($params['pages']);

				} else {
					// use a default action class
					$slug = 'index';
				}

				$this->slug = $slug;

			// no route and pjax call
//			} elseif ($this->is_pjax()) {

//				echo '11121212121212121212121212<br/>';
//				$staticpage = $params['pages'];
//				echo $staticpage;
//				echo '2323232232323232323<br/>';

//			} else {

			}

	//	} catch(\Exception $e) {
	//		print_r($e);
	//	}



		/////////////////// view
	
		$this->render_view();


		// finish
		$this->finish();

	}
}



// eof Micro.php
