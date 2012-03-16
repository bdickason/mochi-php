<?php

/**
 * Handles all Business related logic.
 *
 * @author Smok
 */
class BusinessHelper {
	protected $business	= null;
	static $cache = array();

    function __construct(Business $business)
	{
		$this->business = $business;
	}

	/**
	 *
	 * @return Business
	 */
	function getBusiness()
	{
		return $this->business;
	}

    /**
     * @return BusinessSettings
     */
    function getSettings()
    {
		if (!isset(self::$cache['settings']))
		{
			self::$cache['settings'] = new BusinessSettings($this);
		}

		return self::$cache['settings'];
    }

	/**
	 *
	 * @return BusinessClients
	 */
	function getClients()
	{
		if (!isset(self::$cache['clients']))
		{
			self::$cache['clients'] = new BusinessClients($this);
		}

		return self::$cache['clients'];
	}

	/**
	 *
	 * @return Appointments
	 */
	function getAppointments()
	{
		if (!isset(self::$cache['appointments']))
		{
			self::$cache['appointments'] = new Appointments($this);
		}

		return self::$cache['appointments'];
	}
}
