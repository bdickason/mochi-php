<?php

class QuickSearchPresenter extends AuthenticatedPresenter
{
	const QS_LARGE = 1;
	const QS_NORMAL = 2;
	const QS_WIDE = 3;
	
	const MODE_USERS = 1;	
	const MODE_TRANSACTIONS = 2;
	
	const MIN_AUTOCOMPLETE_LENGTH = 2;
	
	protected $searchText = null;
	protected $listResults = null;
	
	protected $transSearchAllowed = true;
	
	protected $type = self::QS_LARGE;
	
	protected $mode = self::MODE_USERS;

	const RESULT_COUNT = 3;

	protected $result_limit = self::RESULT_COUNT;
	
	function actionQuickSearchHome($text)
	{
		$this->type = self::QS_LARGE;
		$this->quickSearch($text);
	}
	
	function actionQuickSearchUser($text)
	{
		$this->type = self::QS_NORMAL;
		$this->quickSearch($text);
	}
	
	function actionQuickSearchCheckout($text)
	{
		$this->type = self::QS_WIDE;
		$this->transSearchAllowed = false;
		$this->quickSearch($text);
	}

	function actionQuickSearchAppointment($text)
	{
		$this->type = self::QS_LARGE;
		$this->transSearchAllowed = false;
		$this->result_limit = 6;
		$this->quickSearch($text);
	}
	
	function quickSearch($text)
	{	
		$text = preg_replace('/[^#a-z0-9 ,\-]/i', '', $text);
		
		if ($this->transSearchAllowed && preg_match('/^[#0-9]/', $text))
		{
			$this->mode = self::MODE_TRANSACTIONS;
			$text = preg_replace('/^#/', '', $text);
		}
		
		//username search has a limit
		if (strlen($text) == 0 ||
			($this->mode == self::MODE_USERS && strlen($text) < self::MIN_AUTOCOMPLETE_LENGTH))
		{	
			return;
		}
		
		$this->searchText = $text;
		$this->template->search = $text;
		
		$this->getResults();				
	}
	
	function getResults()
	{
		$this->listResults = array();
		switch($this->mode)
		{
			case self::MODE_TRANSACTIONS:
				$res = Transaction::getList(
						'transaction_id,transaction_code,transaction_client_name,transaction_created_date',
						$this->searchText,
						array('transaction_code', 'ASC'), 0, self::RESULT_COUNT);

				$this->template->total = Transaction::$total;
				break;
			case self::MODE_USERS;
				$res = Users::getList(
							'uid,name,phone_primary_number',
							false,
							$this->searchText,
							array('name', 'ASC'),
							0, $this->result_limit);
				$this->template->total = Users::$total;
				break;
		}
				
		foreach($res as $entry)
		{
			$this->listResults[] = $entry;
		}
	}
	
	function renderQuickSearchHome()
	{	
		$this->renderQuickSearch();	
	}
	
	function renderQuickSearchUser()
	{	
		$this->renderQuickSearch();
	}
	
	function renderQuickSearchCheckout()
	{
		$this->renderQuickSearch();
	}

	function renderQuickSearchAppointment()
	{
		$this->payload->count = count($this->listResults);
		$this->template->results = array();
		$map = $this->renderUsers();
		$this->payload->map = $map;
		$this->payload->showall = false;
		$this->setView('quicksearch-appointment');
		$this->invalidateControl('appointmentresults');
	}
	
	function renderQuickSearch()
	{
		$this->payload->count = count($this->listResults);
		$this->selectView();
		
		
		$this->template->results = array();
		switch($this->mode)
		{
			case self::MODE_TRANSACTIONS:
				$map = $this->renderTransactions();
				break;
			case self::MODE_USERS:
				$map = $this->renderUsers();
				break;
		}
		
		$this->payload->map = $map;
		//add the "show all" element in the listing
		$this->payload->showall = true;
		
		if ($this->type == self::QS_WIDE)
		{
			$this->invalidateControl('wideresults');
		}
		else
		{
			$this->invalidateControl('results');	
		}
	}
	
	function renderUsers()
	{
		$map = array();
		foreach($this->listResults as $res)
		{
			$map[] = array('eid' => $res->uid, 'title' => $res->name, 'phone' => $res->phone_primary_number);
			
			$res->title_hl = preg_replace('/('.$this->searchText.')/i', '<strong>\\1</strong>', $res->name);
			$this->template->results[] = $res;
		}
		
		return $map;
	}
	
	function selectView()
	{
		switch($this->type)
		{
			case self::QS_LARGE:
				switch($this->mode)
				{
					case self::MODE_USERS:
						$this->setView('quicksearch');
						break;						
					case self::MODE_TRANSACTIONS:
						$this->setView('quicksearch-transactions');
						break;
				}
				break;
			case self::QS_NORMAL:
				switch($this->mode)
				{
					case self::MODE_USERS:
						$this->setView('quicksearch-small');
						break;
					case self::MODE_TRANSACTIONS:
						$this->setView('quicksearch-transactions-small');
						break;
				}
				break;
			case self::QS_WIDE:
				$this->setView('quicksearch-small-wide');
				break;							
		}
	}
	
	function renderTransactions()
	{		
		$map = array();
		foreach($this->listResults as $res)
		{
			$map[] = array('eid' => $res->transaction_id);
			
			$res->title_hl = preg_replace('/('.$this->searchText.')/i', '<strong>\\1</strong>', $res->transaction_code);
			$res->date = Formatting::formatDate($res->transaction_created_date);
			$this->template->results[] = $res;
		}
		
		return $map;
	}
}