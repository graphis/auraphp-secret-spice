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

namespace Application\Page;

/**
 * DB page
 */
class DynamicPage extends \Application\Application
{

	/**
	 * construct
	 * @param
	 * @return void
	 */
	public function __construct($slug)
	{
		$this->slug = $slug;

		// get the data from the database
//		$table = Lazer::table('pages')->where('slug', '=', $this->slug)->find();

		$items = array();

		$items['name'] = 'Auraphp-secret-spice -- data from application.php';

//		foreach($table as $row)
//		{
			$items['id']    = $this->slug . '__ id';
			$items['slug']  = $this->slug . '__ dynamic data here based on slug hey';
			$items['title'] = $this->slug . '__ title';
			$items['body']  = $this->slug . '__ body';
//		}

		// setup views in Core.php
		$this->register_views();

		// assign the data to the view
		$this->view->setData(array(
		    'items' => $items
		));

		// check for ajax request
		if ( $this->is_pjax() )
		{
			// ajax request // set only partial
			$this->view->setView('content');
		} else {
			// regular http request // set partial and layout
			$this->view->setView('content');
			$this->view->setLayout('layout');
		}

		//
		echo $this->view->__invoke();

	}

}