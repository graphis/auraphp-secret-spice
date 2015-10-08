<?php defined('SYSPATH') or die('No direct script access.');
// old vs new arrays http://php.net/manual/en/language.types.array.php

// views
return [
	'views' => [

		'path' => 'templates',						// in application / templates /

		'layout' => '_layout.php',					// main layout file
		'error'  => 'error.php',					// main layout file

		'partials' => [								// partial views
													// static views
			'indexp'  => 'partial/_indexp.php',
			'974'    => 'partial/_974.php',
			'zsele'  => 'partial/_zsele.php',
			'work'   => 'partial/_work.php',
			'idiorm' => 'partial/_idiorm.php',

			'content' => 'partial/_______content.php'	// dynamic view for data from db

			]

		]
	];

// eof
