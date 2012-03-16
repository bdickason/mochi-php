<?php
class Formatting
{
	const DATE_CURRENT_YEAR = 'n/j';
 	const DATE_OTHER_YEAR =  'n/j/y';
	
	static function formatDate($date, $format = false)
	{
		if (empty($date))
		{
			return '';
		}
		
		$time = strtotime($date);
		$date_parts = getdate($time);
		
		if ($format === false)
		{
			if (Date('Y') == $date_parts['year'])
			{
				$format = self::DATE_CURRENT_YEAR;
			}
			else
			{
				$format = self::DATE_OTHER_YEAR;
			}
		}
		
		return date($format, $time);
	}
	
	/**
	 * Creates UTC timezone date from the date passed.
	 * The idea is to add the UTC timezone suffix to any date in order to pretend we're in UTC to the Javascript.
	 * 
	 * @param string $date
	 */
	static function dateToJS($date)
	{	
		//creates the date in the local timezone, so we can get the offset to UTC
		$dt = new DateTime($date);
		$offset = $dt->format('Z');
		
		//set the object's timezone to UTC
		
		$d = getdate(strtotime($date) + $offset);
		
		//set the new time (including offset)
		$dt->setTime($d['hours'], $d['minutes'], $d['seconds']);
		$dt->setDate($d['year'], $d['mon'], $d['mday']);
		
		$dt->setTimeZone(new DateTimeZone('UTC'));
		
		return $dt->format('r'); 
	}

	static function dateFromJS($date)
	{
		return $date;
	}
}
