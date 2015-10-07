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
$this->router->addValues(array(
		'pjaxpages' => 'index',
	));


// some sample routes to play with
$this->router->add('page', '{static_pages}')
	->addTokens(array(
		'static_pages' => '/work', //   work OR play OR dream
	));


// pjax
$this->router->add('pjax', '{pjaxpages}')
 	->addTokens(array(
 		'pjaxpages' => '/|/zsele|/974|/zorro' //   work OR play OR dream
	));
