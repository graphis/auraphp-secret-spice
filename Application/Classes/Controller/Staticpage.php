<?php
/**
 *
 * This file is part of my_application.
 * application/bootstrap.php is responsible to load application routes and classes, 
 * then handle all to application/classes/micro.class
 *
 * @package my_application
 * @version	1.1
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * @copyright 2015 Zsolt Sándor
 *
 */

namespace Application\Controller;

/**
 *
 * @package Auraphp-secret-spice
 * @license http://opensource.org/licenses/MIT MIT
 *
 * Core utils
 *
 */
class Staticpage extends \Application\Application
{

	/**
	 * construct
	 * @param
	 * @return void
	 */
	public function __construct($slug)
	{
		$this->slug = $slug;

		// setup views in Core.php
		$this->register_views();

		// set data // demo // call model here instead
		$this->view->setData(array('name' => 'Auraphp-secret-spice -- data from application.php'));

		// check for ajax request
		if ( $this->is_pjax() )
		{
			// this is an ajax request so set partial view based on slug
			$this->view->setView($this->slug);
		} else {
			// regular http request // partial view based on slug
			$this->view->setView($this->slug);
			$this->view->setLayout('layout');
		}

		echo $this->view->__invoke();
	}

}