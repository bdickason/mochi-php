<?php

/**
 * Nette Framework
 *
 * Copyright (c) 2004, 2009 David Grudl (http://davidgrudl.com)
 *
 * This source file is subject to the "Nette license" that is bundled
 * with this package in the file license.txt.
 *
 * For more information please see http://nettephp.com
 *
 * @copyright  Copyright (c) 2004, 2009 David Grudl
 * @license    http://nettephp.com/license  Nette license
 * @link       http://nettephp.com
 * @category   Nette
 * @package    Nette\Application
 */



//require_once dirname(__FILE__) . '/../../Object.php';

//require_once dirname(__FILE__) . '/../../Application/IPresenterResponse.php';



/**
 * JSON response used for AJAX requests.
 *
 * @author     David Grudl
 * @copyright  Copyright (c) 2004, 2009 David Grudl
 * @package    Nette\Application
 */
class LinesResponse extends Object implements IPresenterResponse
{
	/** @var string */
	private $data;


	/**
	 * @param  string  $data
	 * 
	 **/
	public function __construct($data)
	{
		$this->data = $data;
	}



	/**
	 * @return string
	 */
	final public function getData()
	{
		return $this->data;
	}



	/**
	 * Sends response to output.
	 * @return void
	 */
	public function send()
	{
		echo $this->data;
	}

}
