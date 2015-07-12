<?php defined('SYSPATH') or die('No direct script access.');



/**
 *
 * Application classes
 * 
 */
use Aura\Router\RouterFactory;
// use Aura\Autoload\Loader;

/**
 * Setting up Aura.Router
 *
 * @link http://
 */
$router_factory = new RouterFactory;
$router = $router_factory->newInstance();

/**
 * Setting up the Application routes
 *
 * @link http://
 */
// add a simple named route without params
// $router->add('home', '/');

// root
$router->add('root', '{index}')
	->addTokens(array(
		'index' => '/|/index.php', //   /   OR   /index.php
	));

// some sample routes to play with
$router->add('page', '{pages}')
	->addTokens(array(
		'pages' => '/work|/play|/dream', //   work OR play OR dream
	));

// pjax testing
$router->add('pjax', '{pjaxpages}')
	->addTokens(array(
		'pjaxpages' => '/kong|/trex|/zorro|/main', //   work OR play OR dream
	));




// routing by server values
//$router->addRoute('json_only', '/accept/json/{id}')
 //   ->addServer(array(
        // must be of quality *, 1.0, or 0.1-0.9
        // 'HTTP_ACCEPT' => 'application/json(;q=(\*|1\.0|[0\.[1-9]]))?'
   // ));
   $router->add('blog.archive', '/blog/archive{/year,month,day}') // http://clean:8888/blog/archive/2014/11/23
       ->addTokens(array(
           'year'  => '\d{4}',
           'month' => '\d{2}',
           'day'   => '\d{2}'
       ))
       ->addValues(array(
           'controller' => 'blog',
           'action' => 'archive',
           'year' => null,
           'month' => null,
           'day' => null,
       ));
// We can now add REST resource routes in a single call to attachResource():
$router->attachResource('blog', '/blog');
$router->setResourceCallable(function ($router) {
    $router->addPost('create', '/{id}');
    $router->addGet('read', '/{id}');
    $router->addPatch('update', '/{id}');
    $router->addDelete('delete', '/{id}');
});



/**
 *
 * Request path, with some cleanup
 * 
 */
// get the incoming request URL path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $path = rtrim($path, '/');

// get the route based on the path and server
$route = $router->match($path, $_SERVER);

// get the first of the best-available non-matched routes
$failure = $router->getFailedRoute();



/**
 *
 *  check if there is a route matching
 * 
 */
// If we matched a route, get it's values, otherwise, set defaults (404)
if ($route) {
	// yes we have a route
	// echo '<br/><hr/>   match >   ' . __LINE__ . '<br/>';	
	// echo 'matching route params <br/>';
	// var_dump($route->params);
	// require('pjaxtest/layout.php'); // for pjax 
} else {
	// no route found --- error 404
	http_response_code(404);
	echo "404 --------- No application route was found for that URL path.";
	exit();
}



/**
 *
 *  get the route params
 * 
 */
$params = $route->params;

if(isset($params['pjaxpages']))
{
	// extract the action callable from the params
	$action = $params['pjaxpages'];        ///////////////// unddefined index if route is not pjax
	unset($params['pjaxpages']);
} else {
	// If not
//	require('pjaxtest/main.php');
//	echo 'pjaxtest from index no';	
}






// for static pages
if (isset($action)) {
	// take the controller class directly from the route
//	require('pjaxtest' . $action . '.php');
	// echo 'pages';
	// $controller = $route->values["controller"];
} else {
	// require('pjaxtest/index.php');
}

























///////// debug
echo DOCROOT . '<br/>';
echo APPPATH . '<br/>';
echo SYSPATH . '<br/>';
echo SYSPATH . "vendor/autoload.php" . '<br/>';
///////// debug







// eof bootstrap.php
