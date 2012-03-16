<?php

require_once('DBO.php');

class Transaction extends DBO
{
	protected $services = array();
	protected $products = array();
	
	function __construct($transaction_id = false)
	{	
		$this->table_name = 'transactions';
		$this->pkey_name = 'transaction_id';
		
		parent::__construct($transaction_id);	 
	}
	
	protected function generateTransactionCode()
	{
		//generate "next transaction number for this month"
		$code = dibi::select('count(*)')
			->from($this->table_name)
			->fetchSingle();		
		
		$code++;
			
		while($this->findTransactionByCode($code) !== false)
		{
			$code++;
		}
		
		return $code;
	}
	
	protected function findTransactionByCode($code)
	{
		$id = dibi::select('count(*)')
			->from($this->table_name)
			->where('transaction_code=%s', $code)
			->fetchSingle();
			
		if (empty($id) || $id < 1)
		{
			return false;
		}
		else
		{
			return $id;
		}
	}
	
	public function __get($name)
	{
		switch($name)
		{
			case 'transaction_products':
				if (empty($this->instance['transaction_products']))
				{
					return '--';
				}
				else
				{
					return $this->instance['transaction_products'];
				}
				break;
			case 'transaction_stylists':
				if (empty($this->instance['transaction_stylists']))
				{
					return '--';
				}
				else
				{
					return $this->instance['transaction_stylists'];
				}
				break;
			default:
				return parent::__get($name);
		}
	}
	
	static public function updateTransaction($tid, $uid, $services, $products, $payment_type)
	{
		$data = Environment::getUser()->getIdentity()->getData();
		//copy the transaction, if something goes wrong, we dont lose the old transaction
		
		$t_old = new Transaction($tid);
		
		$t_new_id = Transaction::createNewTransaction($uid, $services, $products, $payment_type, $t_old);
		
		$t_new = new Transaction($t_new_id);
		//set updated
		$t_new->transaction_updated_uid = $data['uid'];		
		$t_new->save();
		
		$t_old->delete();
		
		return $t_new->id;
	}
	
	public function delete()
	{
		//delete all entries of this transaction
		$entries = TransactionEntry::getAll($this->transaction_id);
		foreach($entries as $entry)
		{
			$te = new TransactionEntry($entry->transaction_entry_id);
			$te->delete();
		}
		
		parent::delete();
	}
	
	public function void()
	{
		$data = Environment::getUser()->getIdentity()->getData();
		
		if ($this->transaction_void == 1)
		{
			$this->transaction_void = 0;
			$this->transaction_void_by_uid = null;
			$this->transaction_void_date = null;
		}
		else
		{
			$this->transaction_void = 1;
			$this->transaction_void_by_uid = $data['uid'];
			$this->transaction_void_date = Date('Y-m-d H:i:s');	
		}
		
		$this->save();
	}
	
	static public function createNewTransaction($uid, $services, $products, $payment_type, Transaction $init = null)
	{
		$data = Environment::getUser()->getIdentity()->getData();
		
		$t = new Transaction();
		
		//initialize by existing data?
		if ($init instanceof Transaction)
		{
			$t->transaction_uid = $init->transaction_uid;
			$t->transaction_author_uid = $init->transaction_author_uid;
			$t->transaction_created_date = $init->transaction_created_date;
			$t->transaction_updated_date = $init->transaction_updated_date;
			$t->transaction_paid = $init->transaction_paid;
			$t->transaction_finalized = $init->transaction_finalized;
			$t->transaction_void = $init->transaction_void;
			$t->transaction_void_by_uid = $init->transaction_void_by_uid;			
			$t->transaction_code = $init->transaction_code;			
		}
		else
		{
			$t->transaction_uid = $uid;
			$t->transaction_author_uid = $data['uid'];
			$t->transaction_created_date = date('Y-m-d H:i:s');
			$t->transaction_updated_date = $t->transaction_created_date;
			$t->transaction_paid = 0;
			$t->transaction_finalized = 0;
			$t->transaction_void = 0;			
		}
		
		$t->transaction_payment_type = $payment_type;
		
		$stylist_names = array();
		$product_names = array();
		
		$price = 0;
		
		if ($t->save())
		{
			foreach($services as $service)
			{
				$te = new TransactionEntry();
				$te->transaction_entry_type = TransactionEntry::ENTRY_TYPE_SERVICE;
				$te->transaction_id = $t->id;
				$te->transaction_entry_uid = $service->stylist_id;
				$te->transaction_entry_service_id = $service->service_id;
				$te->transaction_entry_price_added = $service->price;
				$te->transaction_entry_date_added = $t->transaction_created_date;
				
				$te->save();
				
				$price += $service->price;
				$services_sum += $service->price;
				
				$user = new Users($service->stylist_id);
				$stylist_names[] = $user->name;
			}
			
			foreach($products as $product)
			{
				$te = new TransactionEntry();
				$te->transaction_entry_type = TransactionEntry::ENTRY_TYPE_PRODUCT;
				$te->transaction_id = $t->id;
				$te->transaction_entry_uid = $product->uid;
				$te->transaction_entry_service_id = $product->product_id;
				$te->transaction_entry_price_added = $product->price;
				$te->transaction_entry_date_added = $t->transaction_created_date;
				$te->transaction_entry_quantity = $product->quantity;
				
				$te->save();
				
				$price += $product->price;
				$products_sum += $product->price;
				
				$product = new Product($product->product_id);
				$product_names[] = $product->product_name;
			}
		}
		
		$user = new Users($t->transaction_uid);
		
		$stylist_names = array_unique($stylist_names);

		//add tax
		$t->transaction_total = BillingUtils::getTotal($services_sum, $products_sum);
		$t->transaction_stylists = implode(', ', $stylist_names);
		$t->transaction_products = implode(', ', $product_names);
		$t->transaction_client_name = $user->name;
		$t->save(); 
		
		return $t->id;
	}
	
	public function save()
	{
		if (empty($this->transaction_code))
		{
			$this->transaction_code = $this->generateTransactionCode();
		}
		return parent::save();
	}
	
	static public function getList($fields, $search = false, $order = array('transaction_code', 'DESC'), $limit = false, $offset = false)
	{
		$data = dibi::select($fields)->from('transactions')->where('transaction_finalized=1');
				
		if ($search !== false && !empty($search))
		{
			$data = $data->where('transaction_code')->like('%s', $search.'%');
		}
		
		self::$total = count($data);
		
		if (is_array($order) && count($order) == 2 && $order[0] !== false && $order[1] !== false)
		{
			$data = $data->orderBy($order[0] . ' ' . $order[1]);
		}
		
		if ($limit !== false)
		{
			$data = $data->limit($limit . ',' . $offset);
		}
		
		return $data;
	}
	
	static public function getListByUser($fields, $search, $uid, $order = array('transaction_code', 'DESC'), $offset = false, $limit = false)
	{
		$data = dibi::select($fields)->from('transactions')->where('transaction_uid=%i', $uid)->where('transaction_finalized=1');
				
		if ($search !== false && !empty($search))
		{
			$data = $data->where('transaction_code')->like('%s', $search.'%');
		}
		
		self::$total = count($data);
		
		if (is_array($order) && count($order) == 2 && $order[0] !== false && $order[1] !== false)
		{
			$data = $data->orderBy($order[0] . ' ' . $order[1]);
		}
		
		if ($offset !== false)
		{
			$data = $data->limit($offset . ',' . $limit);
		}
		
		return $data;
	}
}