<?php defined('SYSPATH') or die('No direct script access.');
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
$this->router->add('root', '{index}')
 ->addTokens(array(
   'index' => '/|/index.php', //   /   OR   /index.php
 ));

// some sample routes to play with
$this->router->add('page', '{pages}')
 ->addTokens(array(
   'pages' => '/play|/dream', //   work OR play OR dream
));

 // pjax testing
$this->router->add('pjax', '{pjaxpages}')
 	->addTokens(array(
 		'pjaxpages' => '/zsele|/974|/zorro|/work', //   work OR play OR dream
 	));



 // catch all route
// $this->router->add('generic', '{/controller,action,id}')
//     ->setValues(array(
//         'controller' => 'index',
//         'action' => 'browse',
//         'id' => null,
//     ));
