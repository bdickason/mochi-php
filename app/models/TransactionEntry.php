<?php

require_once('DBO.php');

class TransactionEntry extends DBO
{
	const ENTRY_TYPE_SERVICE = 'service';
	const ENTRY_TYPE_PRODUCT = 'product';
	
	function __construct($transaction_entry_id = false)
	{
		$this->table_name = 'transactions_entries';
		$this->pkey_name = 'transaction_entry_id';
		
		parent::__construct($transaction_entry_id);			 
	}
	
	static public function getAll($transaction_id)
	{
		return dibi::select('*')->from('transactions_entries')->where('transaction_id=%i', $transaction_id)->orderBy('transaction_entry_date_added ASC');
	}
	
	static public function getList($fields)
	{
		return dibi::select($fields)->from('transactions_entries');
	}
	
	static public function getTaxRatio($entry_type)
	{
		switch($entry_type)
		{
			case self::ENTRY_TYPE_PRODUCT:
				return BillingUtils::TAX_RATIO_PRODUCTS;
				break;
			case self::ENTRY_TYPE_SERVICE:
				return BillingUtils::TAX_RATIO_SERVICES;
				break;
		}
	}
	
	static public function getName($entry_type, $id)
	{
		switch($entry_type)
		{
			case self::ENTRY_TYPE_PRODUCT:
				$p = new Product($id);
				return $p->toString();
				break;
			case self::ENTRY_TYPE_SERVICE:
				$s = new Service($id);
				return $s->toString();
				break;
		}
	}
}