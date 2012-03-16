<?php

require_once('QuickSearchEnabledPresenter.php');

class ReportsPresenter extends QuickSearchEnabledPresenter
{
	protected $stylist_id = false;
	
	//used in DB queries
	protected $date_start = false;
	protected $date_end = false;
	
	//used in the form
	protected $date = false;
	
	protected $submitted = false;
	
	function __construct()
	{
		$this->date_start = BillingUtils::getWeekStart();
		$this->date_end = BillingUtils::getWeekEnd();
		$this->date = $this->date_start;
	}
	
	function onFilterSubmit($form)
	{
		$this->submitted = true;

		$data = $form->getValues();
		
		$this->stylist_id = empty($data['stylist']) ? false : $data['stylist'];
		$this->date = $data['date'];
		$this->date_start = BillingUtils::getWeekStart($data['date'], true);
		$this->date_end = BillingUtils::getWeekEnd($data['date'], true);

		
		$payroll = TransactionEntryReports::getPayrollData($this->stylist_id, $this->date_start, $this->date_end)->fetchAll();
		
		$results = array();
		$totals = array('service' => 0, 'retail' => 0, 'total' => 0);
		
		foreach($payroll as $row)
		{
			if (!isset($results[$row['uid']]))
			{
				$results[$row['uid']] = array('service' => 0, 'retail' => 0, 'total' => 0);
				$user = new Users($row['uid']);
				$results[$row['uid']]['name'] = $user->name; 
			}
						
			switch($row['type'])
			{
				case 'product':
					$results[$row['uid']]['retail'] += $row['sum']; 
					$totals['retail'] += $row['sum']; 
					break;
				case 'service':
					$results[$row['uid']]['service'] += $row['sum'];
					$totals['service'] += $row['sum'];
					break;
			}
			
			$results[$row['uid']]['total'] += $row['sum'];
			$totals['total'] += $row['sum'];
		}
		
		if (!empty($this->stylist_id))
		{
			$transres = TransactionEntryReports::getPersonTransactionData($this->stylist_id, $this->date_start, $this->date_end)->fetchAll();
			
			$trans = array();
			
			foreach($transres as $row)
			{
				$entry['code'] = $row->code;
				$entry['client_name'] = $row->client_name;
				$entry['date'] = $row->date;
				
				switch($row->type)
				{
					case 'service':
						$s = new Service($row->service_id);
						$entry['item_name'] = $s->service_name;
						$entry['amount'] = $row->price;
						break;
					case 'product':
						$p = new Product($row->service_id);
						$entry['item_name'] = $p->product_name;
						$entry['amount'] = $row->price;
						break;
				}
				
				$trans[] =  $entry;
			}
			
			$this->template->transactions = $trans;
			$this->template->showing_transactions = true;
		}
		else
		{
			$this->template->showing_transactions = false;
		}
		
		$this->template->results = $results;
		$this->template->totals = $totals;
		
		$this->template->start_date = $this->date_start;
		$this->template->end_date = $this->date_end;
	}
	
	function onDailyFilterSubmit($form)
	{
		$this->submitted = true;

		$data = $form->getValues();		
		$this->date = $data['date'];
	}
	
	function populateDailyReports()
	{
		$this->date_start = date('Y-m-d 00:00:00', strtotime($this->date));
		$this->date_end = date('Y-m-d 23:59:59', strtotime($this->date));
		
		$results = array();
		$total_revenue = 0;
		$total_tax = 0;

		$types = array(TransactionEntryReports::ENTRY_TYPE_PRODUCT, TransactionEntryReports::ENTRY_TYPE_SERVICE);
		foreach($types as $entry_type)
		{
			$results[$entry_type]['total'] = 0;
			$results[$entry_type]['tax'] = 0;
			$results[$entry_type]['entries'] = array();
			
			$entries = TransactionEntryReports::getPreTaxDataGrouped($entry_type, $this->date_start, $this->date_end);			
			foreach($entries as $entry)
			{
				$results[$entry_type]['entries'][] = array(
					'name' => TransactionEntryReports::getName($entry_type, $entry['service_id']),
					'count' => $entry['count'],
					'sum' => $entry['sum'] 
				);
				
				$results[$entry_type]['total'] += $entry['sum'];				
				$total_revenue += $entry['sum'];
			}
			
			$results[$entry_type]['tax'] = BillingUtils::getTax(TransactionEntry::getTaxRatio($entry_type), $results[$entry_type]['total']);			
			$total_tax += $results[$entry_type]['tax'];
		}
		
		$payment_types = TransactionReports::getPaymentTypesReport($this->date_start, $this->date_end);
		$payment_type_names = BillingUtils::getPaymentTypes();
		
		$results['payment_types']['total'] = 0;
		$results['payment_types']['entries'] = array();
		
		foreach($payment_types as $type)
		{
			$results['payment_types']['entries'][] = array(
				'sum' => $type['sum'],
				'count' => $type['count'],
				'name' => $payment_type_names[$type['payment_type']]
			);
			
			$results['payment_types']['total'] += $type['sum'];
		}
		
		$this->template->results = $results;
		$this->template->total_revenue = $total_revenue; 
		$this->template->total_tax = $total_tax; 
		
		$this->template->start_date = $this->date_start;
		$this->template->end_date = $this->date_end;
	}
	
	function onRetailFilterSubmit($form)
	{
		$this->submitted = true;

		$data = $form->getValues();
		$this->date = $data['date'];
		$this->date_start = BillingUtils::getWeekStart($data['date'], true);
		$this->date_end = BillingUtils::getWeekEnd($data['date'], true);
	}
	
	function populateRetailReports()
	{
		// Aggregate amounts
		$total_retail_revenue = 0;
		$total_tax = 0;
		
		$results = array();
		$results['name'] = "";
		$results['count'] = 0;
		$results['totalcount'] = 0; // How many total prodcuts sold
		$results['sum'] = 0;
		$results['total'] = 0; // Total revenue
		$results['tax'] = 0;

		// Get Brand Aggregate
		$results['entries'] = array();
		$entries = TransactionEntryReports::getRetailTransactionDataGrouped(false, $this->date_start, $this->date_end);			

		foreach($entries as $entry)
		{
			$results['entries'][] = array(
				'name' => $entry['product_brand'],
				'count' => $entry['product_brand_count'],
				'sum' => $entry['product_brand_price'] 
			);

			$results['totalcount'] += $entry['product_brand_count'];
			$results['total'] += $entry['product_brand_price'];				
			$total_retail_revenue += $entry['product_brand_price'];
		}

		// Get individual Retail Sales
		$individual_results['entries'] = array();
		$individual_entries = TransactionEntryReports::getRetailTransactionData(false, $this->date_start, $this->date_end);
		
		foreach($individual_entries as $entry)
		{
			$individual_results['entries'][] = array(
				'name' => $entry['product_name'],
				'count' => $entry['product_count'],
				'amount' => $entry['product_sumprice']
			);		
		}

		$total_tax = BillingUtils::getTax(TransactionEntry::getTaxRatio(TransactionEntry::ENTRY_TYPE_PRODUCT), $results['total']);			



		$this->template->results = $results;
		$this->template->individual_results = $individual_results;
		$this->template->total_revenue = $total_retail_revenue; 
		$this->template->total_tax = $total_tax;
		
		$this->template->start_date = $this->date_start;
		$this->template->end_date = $this->date_end;

		
	}
	
	function populateMerchantReports()
	{
		
		$this->date_start = date('Y-m-d 00:00:00', strtotime($this->date));
		$this->date_end = date('Y-m-d 23:59:59', strtotime($this->date));
			
		$results = array();
		$results['payment_type'] = "";
		$results['sum'] = 0;
		$results['totalcount'] = 0; // How many total transactions

		// Get Payment Type aggregate
		$payment_types = TransactionReports::getPaymentTypesReport($this->date_start, $this->date_end);	
		$payment_type_names = BillingUtils::getPaymentTypes();

		$results['payment_types']['total'] = 0;
		$results['payment_types']['totalcount'] = 0;
		$results['payment_types']['entries'] = array();
		


		$payment_transactions = TransactionReports::getMerchantTransactionData(false, $this->date_start, $this->date_end);
	
		
		foreach($payment_types as $type)
		{
			$results['payment_types']['entries'][$type['payment_type']] = array(
				'sum' => $type['sum'],
				'count' => $type['count'],
				'name' => $payment_type_names[$type['payment_type']],
				'payment_type' => $type['payment_type'],
				'transactions' => array()
			);			
						
			$results['payment_types']['totalcount'] += $type['count'];
			$results['payment_types']['total'] += $type['sum'];
		}
		
		foreach($payment_transactions as $transaction)
		{	
			// Match transaction types
				$results['payment_types']['entries'][$transaction['payment_type']]['transactions'][] = array(
						'sum' => $transaction['sum'],
						'payment_type' => $transaction['payment_type'],
						'date' => $transaction['date'],
						'name' => $transaction['name']
				);	
		}
		
		$this->template->results = $results;
		
		$this->template->start_date = $this->date_start;
		$this->template->end_date = $this->date_end;

		
	}
	
	function createComponentFilterForm()
	{
		$form = new AppForm;
		
		$users = Users::getList('uid,name', array(Users::TYPE_STYLIST, Users::TYPE_ASSISTANT, Users::TYPE_RECEPTIONIST))->orderBy('name ASC')->fetchPairs('uid', 'name');
		$stylists = FormUtils::prependEmpty('All stylists', $users); 
		
		$form->addSelect('stylist', 'Stylist')->setItems($stylists, true)->skipFirst()->setValue($this->stylist_id);
		$form->addText('date', 'Date')->setValue($this->date);
		
		$form->addSubmit('show', 'Show report');
				
		$form->onSubmit[] = array($this, 'onFilterSubmit');
		
		return $form;
		
		
	}
	
	function createComponentMerchantFilterForm()
	{
			$form = new AppForm;

			$form->addText('date', 'Date')->setValue($this->date);

			$form->addSubmit('show', 'Show report');

			$form->onSubmit[] = array($this, 'onMerchantFilterSubmit');

			return $form;
		
	}
	
	function createComponentRetailFilterForm()
	{
			$form = new AppForm;

			$form->addText('date', 'Date')->setValue($this->date);

			$form->addSubmit('show', 'Show report');

			$form->onSubmit[] = array($this, 'onRetailFilterSubmit');

			return $form;
		
	}
	
	function createComponentDailyFilterForm()
	{
		$form = new AppForm;
		
		$form->addText('date', 'Date')->setValue($this->date);
		
		$form->addSubmit('show', 'Show report');
				
		$form->onSubmit[] = array($this, 'onDailyFilterSubmit');
		
		return $form;
	}
	
	function renderPayrolls()
	{	
		$this->template->show_payroll = $this->submitted;
	}
	
	function renderDaily()
	{
		$this->template->show_report = true;
		$this->template->date = $this->date;
		
		$this->populateDailyReports();
	}
	
	function renderRetail()
	{
		$this->template->show_report = true;
		$this->template->date = $this->date;
		
		$this->populateRetailReports();
	}
	
	function renderMerchant()
	{
		$this->template->show_report = true;
		$this->template->date = $this->date;
		
		$this->populateMerchantReports();
	}

}