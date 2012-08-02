<?php

class BillingUtils
{
	/**
	 * Tax ratio in percent.
	 *
	 * @var float
	 */
	const TAX_RATIO_SERVICES = 4.5;

	/**
	 * Tax ratio in percent.
	 *
	 * @var float
	 */
	const TAX_RATIO_PRODUCTS = 8.875;

	const PAYMENT_VISA = 'visa';
	const PAYMENT_AMEX = 'amex';
	const PAYMENT_MASTERCARD = 'mastercard';
	const PAYMENT_DISCOVER = 'discover';

	const PAYMENT_CHECK = 'check';

	const PAYMENT_CASH = 'cash';
	const PAYMENT_GIFT = 'gift';

	/**
	 * Formats the price passed for displaying.
	 *
	 * @param float $price
	 * @return float
	 */
	static public function formatPrice($price)
	{
		return number_format($price, 2, '.', ',');
	}

	/**
	 * Calculates the tax from the sum.
	 *
	 * @param float $sum
	 * @return float
	 */
	static public function getTax($ratio, $sum)
	{
		return $sum * ($ratio / 100);
	}

	/**
	 * Calculates the total with
	 *
	 * @param float $subtotal
	 * @return float total including the tax
	 */
	static public function getTotal($services_sum, $products_sum)
	{
		return $services_sum
					+ $products_sum
					+ self::getTax(self::TAX_RATIO_SERVICES, $services_sum)
					+ self::getTax(self::TAX_RATIO_PRODUCTS, $products_sum);
	}

	static public function getWeekStart($date = false, $db_format = false)
	{
		if ($date === false)
		{
			$date = Date('n/j/Y');
		}

		$time = strtotime($date);
		$info = getdate($time);

		$wday = $info['wday'];

		$sub = $wday == 0 ? 6 : $wday - 1;

		//create the date of first sunday before today, inclusive
		$start_time = mktime(0, 0, 0, $info['mon'], $info['mday'] - $sub, $info['year']);

		if ($db_format)
		{
			return Date('Y-m-d H:i:s', $start_time);
		}
		else
		{
			return Date('n/j/Y', $start_time);
		}

	}

	static public function getWeekEnd($date = false, $db_format = false)
	{
		if ($date === false)
		{
			$date = Date('n/j/Y');
		}

		$time = strtotime($date);
		$info = getdate($time);

		$wday = $info['wday'];

		$add = $wday == 0 ? 0 : 7 - $wday;

		//create the date of first sunday before today, inclusive
		$start_time = mktime(23, 59, 59, $info['mon'], $info['mday'] + $add, $info['year']);

		if ($db_format)
		{
			return Date('Y-m-d H:i:s', $start_time);
		}
		else
		{
			return Date('n/j/Y', $start_time);
		}

	}



	static public function getPaymentTypes()
	{
		return array(
			self::PAYMENT_VISA => 'Visa',
			self::PAYMENT_AMEX => 'American Express',
		    self::PAYMENT_DISCOVER => 'Discover',
			self::PAYMENT_MASTERCARD => 'MasterCard',
			self::PAYMENT_CHECK => 'Check',
			self::PAYMENT_CASH => 'Cash',
			self::PAYMENT_GIFT => 'Gift Card'
		);
	}
}