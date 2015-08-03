<?php
/**
 *
 * This file is part of my_application.
 * application/bootstrap.php is responsible to load application routes and classes, 
 * then handle all to application/classes/micro.class
 *
 * @package my_application
 * @version	1.7
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * @copyright  2015 Zsolt Sándor
 *
 */

namespace Application\Helper;




class Console
{

	function consoleX($data){
		echo " console.log(".json_encode($data).")";
	}
	
	/**
	 * Simple helper to debug to the console
	 * 
	 * @param  Array, Object, String $data
	 * @return String
	 */
	function consolem( $data ) {
		
		$output = '';
		
		if ( is_array( $data ) ) {
			$output .= "<script>console.warn( ' PHP > Array > ' ); console.log( '" . implode( ',', $data) . "' );</script>";
		} else if ( is_object( $data ) ) {
			$data    = var_export( $data, TRUE );
			$data    = explode( "\n", $data );
			foreach( $data as $line ) {
				if ( trim( $line ) ) {
					$line    = addslashes( $line );
					$output .= "console.log( '{$line}' );";
				}
			}
			$output = "<script>console.warn( ' PHP > Object > ' ); $output</script>";
		} else {
			$output .= "<script>console.log( ' PHP > {$data}' );</script>";
		}
		
		echo $output;
	}
	
	


	/**
	 * Send debug code to the Javascript console
	 */ 
	function debug($data) {
	    if(is_array($data) || is_object($data))
		{
			echo("<script>console.log(' PHP > ".json_encode($data)."');</script>");
		} else {
			echo("<script>console.log(' PHP > ".$data."');</script>");
		}
	}
	
	
	
	
	
}



// eof Micro.php
