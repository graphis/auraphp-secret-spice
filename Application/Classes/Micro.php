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
use Aura\Router\RouterFactory;
use Aura\View\View;



// application thingies
use Application\Helper\Arr;
use Application\Helper\Console;



//
use Underscore\Underscore;



/**
 *
 * @package Aura.Micro
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 * A microframework wrapper for Aura.Router based off of the Silex api
 *
 */
class Micro
{

	/**
	 * Routes file path
	 */
	 const ROUTERMAP = 'configuration/routes.php';



	/**
	 * Checks if pjax is set
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
	// 
	public function debug($data)
	{
		echo '<br/>';
		echo '<pre><code>';
		print_r($data);
		echo '</code></pre>';
		echo '<br/>';
	}


	/**
	 * Create a Micro framework application
	 *
	 * @uses Aura\Router\RouterFactory;
	 */
	public function __construct()
	{
		// echo '_____________________________' . __FUNCTION__ . '<br/>';

		$this->before();

		// initiate router
		$this->router_factory = new RouterFactory;
		$this->router = $this->router_factory->newInstance();

		// get the routes
		$this->getRoutes();

		// $this->after();
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
			// echo 'the required file '.$file.' was not found';
			// Fall back on some sensible defaults.
			// $router->add(null, '/');
			// $router->add(null, '/{controller}');
			// $router->add(null, '/{controller}/{action}');
			// $router->add(null, '/{controller}/{action}/{id}');
		}

	}



	/**
	 * Add callback for before routing dispatches
	 * @param Closure $callback Closure Callback to be executed
	 * @return void
	 */
	public function before()
	{
		// echo '_____________________________' . __LINE__ . '<br/>';

		$test = new \Application\Helper\Arr;

		// application / configuration
		// get view files and paths
		$zorro = include APPPATH . 'configuration/views.php';

//		$this->debug($zorro);
		$value = Arr::path($zorro, 'views.partials.layout');
//		$this->debug($value);

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
		$console = new Console;
		$console->debug('$xml->data');


	//	$underscore = new Underscore();


		$underscore = Underscore::from([1,2,3,4,5])
		            // convert array format
		        ->map(function($num) { return ['number' => $num];})
		            // filter out odd elements
		        ->filter(function($item) { return ($item['number'] % 2) == 0;})
		            // vardump elements
		        ->invoke(function($item) { var_dump($item);})
		            // changed my mind, I only want numbers
		        ->pick('number')
		            // add numbers to 1000
		        ->reduce(
					function($sum, $num){
						$sum += $num;
						return $sum;
					},
					1000)
		            // take result
		        ->value();
		            // 1006





					$underscore = Underscore::from([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31])->value();
					$console->debug($underscore);

//					$underscore = Underscore::from([1,2,3,4,5])->pick('number')->value();

					$range = Underscore::range(9, 27, 2)->toArray();
					$console->debug($range);

			        $count = Underscore::from($this->getDummy())->count();
					$console->debug($count);



			        $value = Underscore::from($this->getDummy())->value();
					$console->debug($value);


					///////////////////////

//			        $buffer = '';
//			       $zzz = Underscore::from($this->getDummy())
//			            ->invoke(
//			                function ($value, $key) use (&$buffer) {
//			                    $buffer .= sprintf('%s:%s|', $key, $value);
//			                }
//			            );
//			        $this->assertSame('name:dummy|foo:bar|baz:qux|', $buffer);
//					$console->debug($zzz);




			        $value = Underscore::from($this->getDummy())
			            ->map(
			                function ($value, $key) use (&$buffer) {
			                    return sprintf('%s:%s', $key, $value);
			                }
			            )->toArray();
			     //   $this->assertSame(
			     //       array('name' => 'name:dummy', 'foo' => 'foo:bar', 'baz' => 'baz:qux'),
			      //      $value
			     //   );
					$console->debug($value);

$console->debug('____________________');

					// testpick
			        $value = Underscore::from(array(  $this->getDummy() ))
			            ->pick('foo')
			            ->toArray();
			     //   $this->assertSame(array('bar', 'bar', 'bar'), $value);
					
					$console->debug($value);
					

		echo '_____________________________' . __FUNCTION__ . '<br/>';
	}


	//////// underscore functions
    /**
     * @inheritDoc
     */
    protected function getDummy()
    {
        $dummy = array(
            'name' => 'dummy',
            'foo'  => 'bar',
            'baz'  => 'qux',
        );
        return $dummy;
    }
    protected function getDummy2()
    {
        $dummy = array(
            'name' => 'dummy',
            'foo'  => 'bar',
            'baz'  => 'qux',
        );
        return $dummy;
    }
	
	
	


	/**
	 * Add callback for when routing dispatching is finsihed
	 * @param Closure $callback Closure Callback to be executed
	 * @return void
	 */
	public function render_view($static)
	{
		// echo '_____________________________' . __FUNCTION__ . '<br/>';

		/////////////////// view
		// initiate views
		$view_factory = new \Aura\View\ViewFactory;
		$view = $view_factory->newInstance();

		// the "main" template
		$layout_registry = $view->getLayoutRegistry();
		$layout_registry->set('layout', APPPATH . 'views/layout.php');

		// the "sub" template		
		$view_registry = $view->getViewRegistry();
		$view_registry->set('browse', APPPATH . 'views/_browse.php');
		$view_registry->set('trex',  APPPATH . 'views/_trex.php');
		$view_registry->set('kong',  APPPATH . 'views/_kong.php');

		// set data
		$view->setData(array('name' => 'Aura -- data from micro.php'));

		// echo $this->staticpage;
		// if request is ajax -- pjax
		if ( $this->is_pjax() )
		{
//			$this->debug('pjax true');
			$view->setView( $static );
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
			$view->setView( $static );
			$view->setLayout( 'layout' );
		}

		//
		echo $view->__invoke();
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
		$messages = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Nope, not here.', 'Huh?');
		$title = $messages[array_rand($messages)];
		echo $title . ' Sorry, page is not there -- '. $code;
		// exit();
	}



	/**
	 * Run the application:
	 * Check routes an execute the dispatch process
	 *
	 * @return void
	 */
	public function run($path = null, $request = null)
	{
		// echo '_____________________________' . __FUNCTION__ . '<br/>';

		// get the incoming request URL path
		$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		// $path = rtrim($path, '/');

		// get the route based on the url and server
		$route = $this->router->match($path, $_SERVER);


		// if there is no route, make an error 404 for this case
		if (!$route) {
			echo 'no route !!';
			$this->debug($path);
			$this->error('404');
			exit();
		}

		// if request is pjax // currenty handled in render_view function
		if ( $this->is_pjax() )
		{

		} 










		// way 2
		//
//		try {
			// check for routes
			if ($route) {

				// there is a root, now get the params
				$params = $route->params;

				// does the route indicate an action?
				if (isset($route->params['pjaxpages'])) {
					
					// take the static page directly from the route
					// but we must trim the trailing slash from the parameter // why is that?
					$staticpage =  ltrim ( $route->params['pjaxpages'], '/' );

					// $staticpage = $params['pjaxpages'];
					// unset($params['pages']);

				} else {
					// use a default action class
					$staticpage = 'browse';
				}

//				$this->debug($params);
					// echo '<br/> zzz route -- from micro class<br/>';

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
	
		$this->render_view($staticpage);


		// finish
		$this->finish();

	}
}



// eof Micro.php
