<?php

require_once('DBO.php');

class Product extends DBO
{
	protected $product_id;
	
	function __construct($product_id)
	{
		$this->product_id = $product_id;
		$this->table_name = 'products';
		$this->pkey_name = 'product_id';
		
		parent::__construct($product_id);	 
	}
	
	static public function getActive($assoc = false)
	{
		$data = dibi::select('product_id,product_name')->from('products')->where('product_active=1')->orderBy('product_name ASC');
		
		if ($assoc)
		{
			return $data->fetchPairs('product_id', 'product_name');
		}
		else
		{
			return $data;
		}
	}
	
	static public function getActiveWithPrices($assoc = false)
	{
		$data = dibi::select('product_id,CONCAT(product_name,\' ($\',FORMAT(product_price, 2),\')\') AS product_name')->from('products')->where('product_active=1')->orderBy('product_name ASC');
		
		if ($assoc)
		{
			return $data->fetchPairs('product_id', 'product_name');
		}
		else
		{
			return $data;
		}
	}
	
	static public function getPrices($assoc = false)
	{
		$data = dibi::select('product_id,product_price')->from('products')->where('product_active=1')->orderBy('product_id ASC');
		
		if ($assoc)
		{
			return $data->fetchPairs('product_id', 'product_price');
		}
		else
		{
			return $data;
		}
	}
	
	function toString()
	{
		return $this->product_name;
	}
}