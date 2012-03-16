<?php

require_once('DBO.php');

class Service extends DBO
{
	protected $product_id;
	
	function __construct($service_id)
	{
		$this->product_id = $service_id;
		$this->table_name = 'services';
		$this->pkey_name = 'service_id';
		
		parent::__construct($service_id);	 
	}
	
	static public function getActive($assoc = false)
	{
		$data = dibi::select('service_id,service_name')->from('services')->where('service_active=1')->orderBy('service_name ASC');
		
		if ($assoc)
		{
			return $data->fetchPairs('service_id', 'service_name');
		}
		else
		{
			return $data;
		}
	}
	
	function toString()
	{
		return $this->service_name;
	}
}