<?php
/**
 *
 * This file is part of my_application.
 * application/bootstrap.php is responsible to load application routes and classes, then handle all to application/classes/micro.class
 *
 * @package my_application
 * @version    1.7
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * @copyright  2015 Zsolt Sándor
 *
 */

namespace Application;

use Aura\Router\RouterFactory;



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
    const ROUTES = APPPATH . 'routes.php';

    /**
     * Callback after routing and error handling
     */
    const CALLBACK_FINISH = 'finish';


    /**
     * Aura\Router\Map collection of routes
     */
    protected $map;

    /**
     * Callbacks for route execution
     */
    protected $callbacks = array(
        'before' => array(),
        'after' => array(),
        'finish' => array(),
        'error' => array(),
    );

  /**
   * Parameters to look for in function calls
   */
  protected $params = array();



    /**
     * Create a Micro framework application
     *
     * @uses Aura\Router\RouterFactory;
     */
     public function __construct()
     {
       echo '__construct<br/>';
       $this->before();

       //
       $this->router_factory = new RouterFactory;
       $this->router = $this->router_factory->newInstance();

       // get the routes
       $this->getRoutes();
       $this->after();
     }



     public function debug($data)
     {
       echo '<br/>';

       echo '<pre><code>';
       print_r($data);
       echo '</code></pre>';

       echo '<br/>';
     }



    /**
     * build routes
     *
     * @return Aura\Router\Map
     */
    public function getRoutes()
    {
      echo 'getRoutes<br/>';

      // Routes are defined in app / routes.php
      // $file = APPPATH . 'routes.php';

      if (file_exists(self::ROUTES)) {
        // Let the app specify it's own routes.
        include_once(self::ROUTES);
      } else {
        //	echo 'the required file '.$file.' was not found';
        // Fall back on some sensible defaults.
        // $router->add(null, '/');
        // $router->add(null, '/{controller}');
        // $router->add(null, '/{controller}/{action}');
        // $router->add(null, '/{controller}/{action}/{id}');
      }
      //	return include_once( '../application/'.$file);
    }



    // get required file
    public function get_Resource_File($file)
    {
      if (file_exists($file)) {
        include_once($file);
      } else {
        //	echo 'the required file '.$file.' was not found';
      }
      //	return include_once( '../application/'.$file);
    }

    /**
     * Add callback for before routing dispatches
     * @param Closure $callback Closure Callback to be executed
     * @return void
     */
    public function before()
    {
        echo 'before<br/>';
    }

    /**
     * Add callback for after routing dispatches
     * @param Closure $callback Closure Callback to be executed
     * @return void
     */
    public function after()
    {
      echo 'after<br/>';
    }

    /**
     * Add callback for when routing dispatching is finsihed
     * @param Closure $callback Closure Callback to be executed
     * @return void
     */
    public function finish()
    {
      echo 'finish<br/>';
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
      $messages = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Nope, not here.', 'Huh?');
      $title = $messages[array_rand($messages)];
      echo $title . ' Sorry, page is not there -- '. $code;
      exit();
    }




    /**
     * Apply callbacks that have been stacked
     *
     * $type   The type of callback to be applyed
     * $params Various additional parameters to be passed to the callbacks
     */
    protected function applyCallbacks()
    {
        $type = func_get_arg(0);
        $params = array_slice(func_get_args(), 1);

        foreach ($this->callbacks[$type] as $callback) {
            call_user_func_array($callback, $params);
        }
    }





    /**
     * Run the application:
     * Check routes an execute the dispatch process
     *
     * @return void
     */
    public function run($path = null, $request = null)
    {
      echo 'run<br/>';

        // get the incoming request URL path
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // $path = rtrim($path, '/');

// way 1        // get the route based on the url and server
        $route = $this->router->match($url, $_SERVER);

        if (!$route) {
          echo 'no route !!';
        } elseif ( isset($route->params['pages']) ) {
          echo ' route  ok if isset !!';
        }







// way 2
        //
        try {
          // check for routes
          if ($route) {

              // there is a root, now get the params
              $params = $route->params;

              // does the route indicate an action?
              if (isset($route->params['action'])) {
                // echo '111111111' . $route->params['pages'];
                  // take the action class directly from the route
                  $staticpage = $params['pages'];
                  echo $staticpage;
                  // unset($params['pages']);

                //  $action_class = $route->params['action'];
              } else {
                echo '2222222222';
                  // use a default action class
                  // $action_class = 'IndexAction';
              }

              // get the action value // test
              // $action = $params['whatewer-is-the-action-name'];
              // unset($params['action']);

              $this->debug($params);
              // echo '<br/> zzz route -- from micro class<br/>';
          } else {
              $this->debug($url);
              $this->error('404');
          }

        } catch(\Exception $e) {
            print_r($e);
        }




        //
        $this->finish();

    }
}



// eof Micro.php
