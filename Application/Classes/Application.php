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



use Application\Helper\Debug;
use Application\Helper\xml;
use Application\Helper\Arr;

use Lazer\Classes\Database as Lazer;



/**
 *
 * @package Auraphp-secret-spice
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 * A microframework wrapper for Aura.Router based off of the Silex api
 *
 */
class Application extends Core
{

	/**
	 * Create an application
	 *
	 * @uses Aura\Router\RouterFactory;
	 */
	public function __construct()
	{
		// echo '_____________________________' . __FUNCTION__ . '<br/>';
		define('LAZER_DATA_PATH', APPPATH .'database/'); //Path to folder with tables

		parent::__construct();

		// setting up debug stuff
		$this->debug = new Debug();
		
		// $this->before();
		// $this->debug->console('hi from the debug class to console');
		// $this->debug->page('hi from the debug class to page');

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
	public function finish()
	{
		echo '_ _____________________________' . __FUNCTION__ . '<pre><br/>';
		

		$xml = new xml( APPPATH . 'xml' . DIRECTORY_SEPARATOR . $this->slug . '.xml');


//		$this->debug->page( $xml->data );
//		$this->debug->page( $xml->data['page'] );


		// Flatten the array
		$xml_flattened = Arr::flatten($xml->data);

//		print_r($xml_flattened);

		$z_slug     = Arr::path($xml_flattened, 'slug');
		
		$z_title    = Arr::path($xml_flattened, 'title');

		$z_body     = Arr::path($xml_flattened, 'body');



		// Multiple select
//		foreach($xml->data['page'] as $row)
//		{
			echo 'page _ <br/>';
			echo ' _____________ <br/>';
		    print_r($z_slug);
			echo ' <br/>';
			print_r($z_title);
			echo '  <br/>';
			print_r($z_body);
			echo ' _____________ <br/>';


	
//		}

		// Single record select
//		$row = Lazer::table('pages')->find(1);
//		print_r($row);




		// var_dump($xml->data);



/*		
		Lazer::create('pages', array(
		    'id'    => 'integer',
			'slug'    => 'string',
		    'title' => 'string',
			'body'  => 'string'
		));
*/

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

/*
		$row = Lazer::table('pages');

		// Multiple select
		$table = Lazer::table('pages')->findAll();
		foreach($table as $row)
		{
			echo '<pre>';
		    print_r($row);
		    print_r($row->id . '<br/>');
		    print_r($row->slug . '<br/>');
			print_r($row->title . '<br/>');
			print_r($row->body . '<br/>');
			echo '</pre>';			
		}

		// Single record select
		$row = Lazer::table('pages')->find(1);
		print_r($row);
*/

		// echo $this->staticpage;
		$row = Lazer::table('pages')->where('slug', '=', $this->slug)->find();

		if ( $this->is_pjax() )
		{
			// echo $row->title;
			print_r($row);
		}



		echo '</pre>_____________________________ _<br/>';
	}

	/**
	 * Add callback for when routing dispatching is finsihed
	 * @param Closure $callback Closure Callback to be executed
	 * @return void
	 */
	public function render_view()
	{
		// setup views in Core.php
		$this->setup_views();

		// set data
		$this->view->setData(array('name' => 'Aura -- data from micro.php'));

		// check for ajax request
		if ( $this->is_pjax() )
		{
			// set partial view based on slug
			$this->view->setView( $this->slug );

		} else {

			// set partial view based on slug, and view layout
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
	public function run()
	{
		// get the incoming request URL path
		$this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		// $this->path = rtrim($path, '/');

		// get the route based on the url and server
		$this->route = $this->router->match($this->path, $_SERVER);



		// 01 if no route exists then 404 error
		// 02 if request is ajax // not used currently as 03 else does not get executed
		   // use only if processing ajax requests requires other logic as normal requests
		// 03 else process params and get the slug based on the route segment
		
		// 01 if there is no route, make an error 404 for this case
		if (!$this->route) {
			echo 'no route !';
			$this->debug->page($this->path);
			$this->error('404');
			exit();
		}

		// 02 if request is pjax // currenty handled in render_view function
//		if($this->is_pjax()){}

		// 03 check for routes
//		if ($this->route) {
		else {


			// there is a route, now get the params
			$params = $this->route->params;

			// does the route indicate an action?
			if (isset($this->route->params['pjaxpages'])) {

				// take the static page directly from the route and trim the trailing slash from the parameter
				$this->slug =  ltrim ( $this->route->params['pjaxpages'], '/' );

			// default slug if none is set
			// root path, since we can not map / to a view
//			} if ( $this->slug === ''  ) {
			} if (empty($this->slug) ) {
				$this->slug = 'index';
			} 
			//else {
			//	$this->slug = 'index';
			//}
		}

		//
		$this->render_view();

		//
		$this->finish();
	}


}



// eof Application.php
