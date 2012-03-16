<?php

require_once('DBO.php');

class ServiceUser extends DBO
{
	function __construct()
	{		
		$this->table_name = 'services';
		$this->pkey_name = 'service_id';
		
		parent::__construct($product_id);	 
	}
	
	static public function getActive()
	{
		$data = dibi::select('service_id,uid,service_price')->from('services_users')->where('active=1')->orderBy('service_id,uid ASC');
		
		return $data;
	}
}