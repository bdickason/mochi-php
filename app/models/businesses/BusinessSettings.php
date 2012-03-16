<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Holds all business settings like opening hours, colors
 * of services etc.
 *
 * @author Smok
 */
class BusinessSettings {

	/**
	 * Returns opening hours for the current service.
	 * Returns two strings in the formst hh:mm (24 hour format)
	 *
	 * @return object { 'start' => '10:00', 'end' => '21:00' }
	 */
	function getOpeningHours()
	{
		$hours = new DObject();

		$hours->start = '8:00';
		$hours->end = '19:00';

		return $hours;
	}

	/**
	 * Returns the color mapping the business chose for its services.
	 */
	function getServiceColors()
	{
		$services = $this->getServices();
		$colors = array();

		$max_colors = 8;
		$color = 0;

		foreach($services as $id => $name)
		{
			$colors[$id] = ($color % $max_colors) + 1;
			$color++;
		}

		return $colors;
	}

	/**
	 * Gets all the services for this business, alphabetically sorted.
	 *
	 * @return array associative array ( id => name, ...)
	 */
	function getServices()
	{
		return Service::getActive(true);
	}

	/**
	 * Gets all the stylists for this business, alphabetically sorted.
	 *
	 * @return array associative array ( uid => name, ...)
	 */
	function getStylists()
	{
		return Users::getList('uid,name', Users::TYPE_STYLIST, false)->fetchPairs('uid','name');
	}
}
?>
