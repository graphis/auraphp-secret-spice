<?php

namespace Application;



/**
 * Exception class
 */
class Exception
{

	function __construct($message) {
		
		$this->message = $message;
		echo '<hr/>runtime exception ___ ' . $this->message . '<hr/>';
		
	}

}