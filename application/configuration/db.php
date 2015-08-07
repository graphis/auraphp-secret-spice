<?php defined('SYSPATH') or die('No direct script access.');
// old vs new arrays
// http://php.net/manual/en/language.types.array.php



// views
return [
    'database' => [

        'path' => 'views',					// in application / views /

		'layout' => 'layout.php',			// main layout file
		'error'  => 'error.php',			// main layout file

	        1 => [					// partial views
            	'id'  => 1,
				'slug'    => 'zsele',
				'title'  => 'Zsele',
				'body'  => 'zsele zsele zsele'
				],

	        2 => [					// partial views
            	'id'  => 2,
				'slug'    => '974',
				'title'  => '974',
				'body'  => '974 974 974'
				],

	        3 => [					// partial views
            	'id'  => 3,
				'slug'    => 'index',
				'title'  => 'index',
				'body'  => 'index index index'
				]

		

	] //database
]; //return






