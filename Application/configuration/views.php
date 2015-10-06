<?php defined('SYSPATH') or die('No direct script access.');
// old vs new arrays http://php.net/manual/en/language.types.array.php

// views
return [
	'views' => [

		'path' => 'views',							// in application / views /

		'layout' => 'layout.php',					// main layout file
		'error'  => 'error.php',					// main layout file

		'partials' => [								// partial views
													// static views
			'index'  => 'partial/_index.php',
			'974'    => 'partial/_974.php',
			'zsele'  => 'partial/_zsele.php',
			'work'   => 'partial/_work.php',

			'content' => 'partial/____content.php'	// dynamic view for data from db

			]

		]
	];

// eof
