<?php

class DataEntity
{
	protected $id = null;
	protected $data = null;
	
	public function __construct()
	{
		$this->data = new stdclass();
	}
	
	public function getIdentifier()
	{
		return $this->id;	
	}
	
	public function setIdentifier($id)
	{
		$this->id = $id;
	}
	
	function __get($name)
	{
		//is there an explicit getter?
		if (method_exists($this, 'get' . $name))
		{
			return $this->{'get' . $name}($name);
		}
		
		//no, just try to do it
		if (isset($this->data->$name))
		{
			return $this->data->$name;
		}
		else
		{
			return null;
		}
	}
	
	function __set($name, $value)
	{
		//is there an explicit setter?
		if (method_exists($this, 'set' . $name))
		{
			return $this->{'set' . $name}($value);
		}
		
		return $this->data->$name = $value; 
	}
	
	/**
	 * Returns a stdClass object with the properties.
	 * Useful for json_encode.
	 * 
	 * @return stdClass
	 */
	public function getDataObject($js_date = false)
	{	
		return $this->data;
	}
}