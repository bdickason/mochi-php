<?php

class CheckoutPresenter extends ListingPresenter
{
	protected $services = array();
	protected $products = array();

	protected $transaction_uid = false;
	protected $transaction_id = false;
	protected $transaction = null;

	protected $used_service_count = 0;
	protected $used_product_count = 0;

	protected $results = array();

	const TOTAL_SERVICE_COUNT = 20;
	const TOTAL_PRODUCT_COUNT = 50;

	protected $pageSize = 10;

	protected $page = false;

	function __construct()
	{
		$this->sortableColumns = array(
							'transaction_code',
							'transaction_created_date',
							'transaction_total',
							'transaction_stylists',
							'transaction_products',
							'transaction_client_name');

		$this->defaultOrder = 'transaction_created_date DESC';

		parent::__construct();
	}

	function actionFinalize($transaction_id)
	{
		$this->transaction_id = $transaction_id;
	}

	function actionVoid($transaction_id)
	{
		$this->transaction_id = $transaction_id;
	}

	function actionCancelTransaction($transaction_id)
	{
		$this->transaction_id = $transaction_id;
		$t = new Transaction($this->transaction_id);

		if ($t->transaction_finalized)
		{
			$t->void();

			$this->redirect('Checkout:search', array('search' => $transaction->transaction_code));
		}
		else
		{
			$t->delete();
			$this->redirect('Default:');
		}
	}

	function actionConfirm($transaction_id)
	{
		$this->transaction_id = $transaction_id;

		$t = new Transaction($this->transaction_id);
		$t->transaction_finalized = 1;
		$t->save();

		$u = new Users($t->transaction_uid);
		$u->last_transaction_date = Date('Y-m-d H:i:s');
		$u->save();

		$this->redirect('Checkout:receipt', array('transaction_id' => $this->transaction_id));
	}

	function actionReceipt($transaction_id)
	{
		$this->transaction_id = $transaction_id;
	}

	function actionReceiptPrint($transaction_id)
	{
		$this->transaction_id = $transaction_id;
	}

	function formatPrice($value)
	{
		return BillingUtils::formatPrice($value);
	}

	function actionSearch($search = null, $page = 0, $uid = null, $order = '')
	{
		$this->parseOrder($order);

		$this->page = (int)$page;

		$this->searchText = preg_replace('/[^0-9]/', '', $search);
		$this->transaction_uid = $uid;
	}

	function renderSearch()
	{
		if ($this->transaction_uid === null)
		{
			$transactions = Transaction::getList(
								'transaction_id',
								$this->searchText,
								array($this->orderBy, $this->orderDir),
								$this->page * $this->pageSize,
								$this->pageSize
							);
		}
		else
		{
			$transactions = Transaction::getListByUser('transaction_id',
														$this->searchText,
														$this->transaction_uid,
														array($this->orderBy, $this->orderDir),
														$this->page * $this->pageSize,
														$this->pageSize
														);
		}

		$this->template->results = array();
		$this->template->search = $this->searchText;
		$this->template->uid = $this->transaction_uid;


		if ($this->transaction_uid != null)
		{
			$client = new Users($this->transaction_uid);
			$this->template->client_name = $client->name;
		}

		$this->template->total_results = Transaction::$total;

		foreach($transactions as $transaction)
		{
			$t = new Transaction($transaction->transaction_id);
			$this->template->results[] = $t;
		}

		$this->template->order_column = $this->orderBy;
		$this->template->order = $this->createOrderString($this->orderBy, $this->orderDir, true);

		$max_page = ceil(Transaction::$total / $this->pageSize);

		$this->template->page = $this->page;
		$this->template->page_prev = ($this->page > 0) ? $this->page - 1 : 0;
		$this->template->max_page = $max_page;
		$this->template->page_next = ($this->page < $max_page - 1) ? $this->page + 1 : $max_page - 1;

		$this->template->page_size = $this->pageSize;
		$this->template->searching = true;
		$this->template->num_results = Transaction::$total;
	}

	function formatDate($date, $format = false)
	{
		return Formatting::formatDate($date, $format);
	}



	function renderStaticTransaction()
	{
		$transaction = new Transaction($this->transaction_id);
		$user = new Users($transaction->transaction_uid);

		$this->template->transaction_uid = $user->id;
		$this->template->client_name = $user->name;
		$this->template->transaction_id = $this->transaction_id;
		$this->template->transaction_void = $transaction->transaction_void;
		$this->template->transaction_type = $transaction->transaction_finalized ? 'finalized' : 'progress';

		$entries = TransactionEntry::getAll($this->transaction_id);

		$this->template->services = array();
		$this->template->products = array();

		$services_subtotal = 0;
		$products_subtotal = 0;

		foreach($entries as $entry)
		{
			$u = new Users($entry->transaction_entry_uid);

			switch($entry->transaction_entry_type)
			{
				case TransactionEntry::ENTRY_TYPE_SERVICE:
					$s = new Service($entry->transaction_entry_service_id);
					$si = new ServiceInstance();
					$si->service_name = $s->service_name;
					$si->stylist_name = $u->name;
					$si->price = $this->formatPrice($entry->transaction_entry_price_added);

					$services_subtotal += $entry->transaction_entry_price_added;

					$this->template->services[] = $si;
					break;
				case TransactionEntry::ENTRY_TYPE_PRODUCT:
					$p = new Product($entry->transaction_entry_service_id);
					$pi = new ProductInstance();
					$pi->product_name_raw = $p->product_name;
					$pi->product_list_price = $this->formatPrice($p->product_price);
					$pi->product_name = $p->product_name . ' ($' . $this->formatPrice($p->product_price) . ')';
					$pi->user_name = $u->name;
					$pi->price = $this->formatPrice($entry->transaction_entry_price_added);
					$pi->quantity = $entry->transaction_entry_quantity;

					$products_subtotal += $entry->transaction_entry_price_added;

					$this->template->products[] = $pi;
					break;
			}
		}

		$subtotal = $services_subtotal + $products_subtotal;
		$taxes = BillingUtils::getTax(BillingUtils::TAX_RATIO_PRODUCTS, $products_subtotal)
				 	+ BillingUtils::getTax(BillingUtils::TAX_RATIO_SERVICES, $services_subtotal);

		$grand_total = $subtotal + $taxes;

		$this->template->services_subtotal = $this->formatPrice($services_subtotal);
		$this->template->products_subtotal = $this->formatPrice($products_subtotal);

		$payment_types = BillingUtils::getPaymentTypes();

		$this->template->payment_type = $payment_types[$transaction->transaction_payment_type];

		$this->template->transaction_update_date = $transaction->transaction_created_date;
		$this->template->transaction_code = $transaction->transaction_code;

		$this->template->subtotal = $this->formatPrice($subtotal);
		$this->template->taxes = $this->formatPrice($taxes);
		$this->template->grand_total = $this->formatPrice($grand_total);
	}

	function renderVoid()
	{
		$this->setView('search');

		$t = new Transaction($this->transaction_id);
		if (!$t->loaded())
		{
			$this->payload->error = 'Transaction not found.';
			return;
		}
		else
		{
			$t->void();
		}

		$this->payload->voided = $t->transaction_void;
		$this->payload->error = '';
	}

	function renderFinalize()
	{
		$this->renderStaticTransaction();
	}

	function renderReceipt()
	{
		$this->renderStaticTransaction();
	}

	function renderReceiptPrint()
	{
		$this->setLayout('layout-print');
		$this->setView('receipt-print');
		$this->renderStaticTransaction();
	}

	function actionEditOrder($transaction_id)
	{

	}

	function actionOrder($uid = null, $transaction_id = null, $appointment_id = null)
	{
		if ($transaction_id !== null)
		{
			try {
				$this->transaction = new Transaction($transaction_id);
			} catch(DBONotFoundException $e)
			{
				$this->redirect('Default:');
			}
			$this->transaction_id = $transaction_id;
			$this->transaction_uid = $this->transaction->transaction_uid;
		}
		else
		{
			$this->transaction_uid = $uid;
		}

		//init the order via appointments
		if ($appointment_id	!== null)
		{
			//get the appointment
			$appointment = $this->businessHelper->getAppointments()->one($appointment_id);

			$this->transaction_uid = $appointment->appointment_client_uid;

			//get all appointments for the same user today
			$appointments = $this->businessHelper->getAppointments()->find(
						array(
								'date' => Date('Y-m-d', strtotime($appointment->appointment_start_date)),
								'client' => $appointment->appointment_client_uid,
								'active' => true,
								'objects' => true
						));


			foreach($appointments as $a)
			{
				$si = new ServiceInstance();
				$si->service_id = $a->appointment_service_id;
				$si->stylist_id = $a->appointment_stylist_uid;
				$si->price = 0;
				$this->services[] = $si;
				$this->used_service_count++;
			}
		}

		$i = 0;
		foreach(TransactionEntry::getAll($transaction_id)->where("transaction_entry_type='service'") as $entry)
		{
			$si = new ServiceInstance();
			$si->service_id = $entry->transaction_entry_service_id;
			$si->stylist_id = $entry->transaction_entry_uid;
			$si->price = $entry->transaction_entry_price_added;
			$this->services[] = $si;
			$i++;
			$this->used_service_count++;
		}

		for(; $i < self::TOTAL_SERVICE_COUNT; $i++)
		{
			$si = new ServiceInstance();
			$si->service_id = FormUtils::OPTION_EMPTY;
			$si->stylist_id = FormUtils::OPTION_EMPTY;
			$si->price = 0;
			$this->services[] = $si;
		}

		if ($this->used_service_count == 0)
		{
			$this->used_service_count++;
		}

		$i = 0;
		foreach(TransactionEntry::getAll($transaction_id)->where("transaction_entry_type='product'") as $entry)
		{
			$si = new ProductInstance();
			$si->product_id = $entry->transaction_entry_service_id;
			$si->uid = $entry->transaction_entry_uid;
			$si->price = $entry->transaction_entry_price_added;
			$si->quantity = $entry->transaction_entry_quantity;
			$this->products[] = $si;
			$i++;
			$this->used_product_count++;
		}

		for(; $i < self::TOTAL_PRODUCT_COUNT; $i++)
		{
			$si = new ProductInstance();
			$si->product_id = FormUtils::OPTION_EMPTY;
			$si->uid = FormUtils::OPTION_EMPTY;
			$si->price = 0;
			$si->quantity = 1;
			$this->products[] = $si;
		}

		if ($this->used_product_count == 0)
		{
			$this->used_product_count++;
		}
	}

	function buildServicePriceMap()
	{
		$prices = ServiceUser::getActive();
		$map = array();

		foreach($prices as $entry)
		{
			$map[$entry->service_id . '_' . $entry->uid] = $entry->service_price;
		}

		return $map;
	}

	function buildProductPriceMap()
	{
		$prices = Product::getPrices();
		$map = array();

		foreach($prices as $entry)
		{
			$map[$entry->product_id] = $entry->product_price;
		}

		return $map;
	}

	function createComponentSearchForm()
	{
		$form = new AppForm;

		$form->addText('q', 'Search')->setValue($this->searchText);

		$form->onSubmit[] = array($this, 'onSearchSubmit');

		return $form;
	}

	function createComponentTransactionForm()
	{
		$form = new AppForm;

		$form->addHidden('uid')->setValue($this->transaction_uid);
		$form->addHidden('tid')->setValue($this->transaction_id);

		$services = FormUtils::prependEmpty('Select service', Service::getActive(true));
		$stylists = FormUtils::prependEmpty('Select stylist', Users::getList('uid,name', Users::TYPE_STYLIST)->orderBy('name ASC')->fetchPairs('uid', 'name'));
		$users = FormUtils::prependEmpty('Select user', Users::getList('uid,name', array(Users::TYPE_STYLIST, Users::TYPE_RECEPTIONIST, Users::TYPE_ASSISTANT))->orderBy('name ASC')->fetchPairs('uid','name'));
		$products = FormUtils::prependEmpty('Select product', Product::getActiveWithPrices(true));

		$paymentTypes = BillingUtils::getPaymentTypes();

		//add the new empty service

		$service_index = 0;

		foreach($this->services as $service)
		{
			$service_index++;

			$form->addSelect('service' . $service_index, 'Service ' . $service_index)->setItems($services, true)->skipFirst()->setValue($service->service_id);
			$form->addSelect('stylist' . $service_index, 'Stylist ' . $service_index)->setItems($stylists, true)->skipFirst()->setValue($service->stylist_id);
			$form->addText('sprice' . $service_index, 'Price '. $service_index)->setValue($service->price);
		}

		$product_index = 0;

		$qty = range(1, 30);
		$qty = array_combine($qty, $qty);

		foreach($this->products as $product)
		{
			$product_index++;

			$form->addSelect('product' . $product_index, 'Service ' . $product_index)->setItems($products, true)->skipFirst()->setValue($product->product_id);
			$form->addSelect('pqty' . $product_index, 'QTY ' . $product_index)->setItems($qty, true)->setValue($product->quantity);
			$form->addSelect('user' . $product_index, 'Stylist ' . $product_index)->setItems($users, true)->skipFirst()->setValue($product->uid);
			$form->addText('pprice' . $product_index, 'Price '. $product_index)->setValue($product->price);
		}

		if ($this->transaction instanceof Transaction)
		{
			$payment_type = $this->transaction->transaction_payment_type;
		}
		else
		{
			$payment_type = false;
		}

		$form->addSelect('payment_type', 'Payment type')->setItems($paymentTypes)->setValue($payment_type);

		$form->onSubmit[] = array($this, 'transactionSubmitted');

		return $form;
	}

	function transactionSubmitted($form)
	{
		$data = $form->getValues();

		$this->transaction_uid = $data['uid'];
		$this->transaction_id = $data['tid'];

		$this->services = array();
		$this->products = array();

		for($i = 1; $i <= self::TOTAL_SERVICE_COUNT; $i++)
		{
			if ($data['service' . $i] != NULL && $data['stylist' . $i] != NULL)
			{
				$si = new ServiceInstance();
				$si->service_id = $data['service'.$i];
				$si->stylist_id = $data['stylist'.$i];
				$si->price = $data['sprice'.$i];

				$this->services[] = $si;
			}
		}

		for($i = 1; $i <= self::TOTAL_PRODUCT_COUNT; $i++)
		{
			if ($data['product' . $i] != NULL && $data['user'.$i] != NULL)
			{
				$pi = new ProductInstance();
				$pi->product_id = $data['product' . $i];
				$pi->uid = $data['user' . $i];
				$pi->price = $data['pprice' . $i];
				$pi->quantity = $data['pqty' . $i];

				$this->products[] = $pi;
			}
		}

		//editing a transaction?
		if ($this->transaction_id != null)
		{
			$this->transaction_id = Transaction::updateTransaction($this->transaction_id, $this->transaction_uid, $this->services, $this->products, $data['payment_type']);
		}
		else
		{
			$this->transaction_id = Transaction::createNewTransaction($this->transaction_uid, $this->services, $this->products, $data['payment_type']);
		}

		$this->redirect('Checkout:finalize', array('transaction_id' => $this->transaction_id));
	}

	function renderOrder()
	{
		$user = new Users($this->transaction_uid);
		$this->template->client_name = $user->name;

		$this->template->transaction_type = empty($this->transaction_id) ? 'new' : ($this->transaction->transaction_finalized ? 'finalized' : 'progress');
		$this->template->transaction_void = empty($this->transaction_id) ? '' : $this->transaction->transaction_void;
		$this->template->transaction_code = empty($this->transaction_id) ? '' : $this->transaction->transaction_code;

		$this->template->transaction_id = $this->transaction_id;

		$this->template->total_service_count = self::TOTAL_SERVICE_COUNT;
		$this->template->total_product_count = self::TOTAL_PRODUCT_COUNT;
		$this->template->used_service_count = $this->used_service_count;
		$this->template->used_product_count = $this->used_product_count;
		$this->template->service_price_map = $this->buildServicePriceMap();
		$this->template->product_price_map = $this->buildProductPriceMap();
		$this->template->tax_ratio_products = BillingUtils::TAX_RATIO_PRODUCTS;
		$this->template->tax_ratio_services = BillingUtils::TAX_RATIO_SERVICES;
	}
}