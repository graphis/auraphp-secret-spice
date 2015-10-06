<?php

namespace Application;



/**
 *
 * Exception class
 *
 */
class Exception
{


	function __construct($message) {
		
		$this->message = $message;
		
	}

	function throw() {
		
		echo '<hr/>runtime exception ___ ' . $this->message . '<hr/>';
		
	}


}