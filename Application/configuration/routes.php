<?php defined('SYSPATH') or die('No direct script access.');
/*
 *
 * define routes here
 *
 */

// defaults
$this->router->addTokens(array(
    'id' => '\d+',
));

$this->router->addValues(array(
    'pages' => null,
));

// practically a default value if this is not set from the url
// $this->router->addValues(array(
//    'pjaxpages' => 'browse',
// ));

// root route
//$this->router->add('root', '{index}')
// ->addTokens(array(
//   'index' => '/|/index.php', //   /   OR   /index.php
// ));

// some sample routes to play with
$this->router->add('page', '{static_pages}')
	->addTokens(array(
		'static_pages' => '/work', //   work OR play OR dream
	));

 // pjax testing
$this->router->add('pjax', '{pjaxpages}')
 	->addTokens(array(
 		'pjaxpages' => '/|/zsele|/974|/zorro' //   work OR play OR dream
 	));

// catch all route
/*
$this->router->add('generic', '{/controller,action,id}')
     ->setValues(array(
         'controller' => 'index',
         'action' => 'browse',
         'id' => null,
     ));
*/