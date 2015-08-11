<?php defined('SYSPATH') or die('No direct script access.');
// old vs new arrays
// http://php.net/manual/en/language.types.array.php



// views
return [
    'views' => [

        'path' => 'views',					// in application / views /

		'layout' => 'layout.php',			// main layout file
		'error'  => 'error.php',			// main layout file

	        'partials' => [					// partial views

            	'index'  => 'partial/_index.php',	// static view
				'974'    => 'partial/_974.php',		// static view
				'zsele'  => 'partial/_zsele.php',	// static view
				'work'   => 'partial/_work.php',	// static view

				'content' => 'partial/____content.php' // used for content from database

        ]

    ]
];






