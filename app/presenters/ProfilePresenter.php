<?php

class ProfilePresenter extends ListingPresenter
{
	protected $newUserUsername = false;
	protected $editingID = null;
	protected $editingUser = null;
	
	protected $searchText = null;	
	
	const FIELD_TEXT = 'text';
	const FIELD_SELECT = 'select';
	const FIELD_TEXTAREA = 'textarea';
	const FIELD_PASSWORD = 'password';
	
	const DEFAULT_NOTES = 'Click to add notes.';
	
	const REGEXP_USERNAME = '/^[a-z0-9 ,\-\.\']+$/i';
	
	const MAX_TRANSACTIONS = 5;
	
	function __construct()
	{
		$this->sortableColumns = array('name', 'phone_number', 'last_transaction_date');
		$this->defaultOrder = 'name ASC';
		
		parent::__construct();
	}
	
	function getProfileFields()
	{
		$stylists = Users::getList('uid,name', Users::TYPE_STYLIST)->orderBy('name ASC')->fetchPairs('uid', 'name');
		$stylists_cut = FormUtils::prependEmpty('Select cut stylist', $stylists);
		$stylists_color = FormUtils::prependEmpty('Select color stylist', $stylists);
		
		$fields = array(
			'type' => array('User type', self::FIELD_SELECT, 'client', null, array('administrator' => 'Administrator', 'client' => 'Client', 'stylist' => 'Stylist', 'receptionist' => 'Receptionist', 'assistant' => 'Assistant')),
			'name' => array('Name', self::FIELD_TEXT, 'Enter client name', array(Form::REGEXP, 'Name is required and cannot contain special characters.', self::REGEXP_USERNAME)),
			'notes' => array('Notes', self::FIELD_TEXTAREA, 'Click to enter notes for this user.'),
			'phone_primary_number' => array('Phone number', self::FIELD_TEXT, '123-3456-7890', array(Form::REGEXP, 'Primary phone number must be in format 123-3456-7890.', '/^[0-9]{3}\-?[0-9]{3}\-?[0-9]{4}$/', false)),
			'phone_primary_type' => array('Phone type', self::FIELD_SELECT, 'home', null, array('home' => 'Home', 'mobile' => 'Mobile', 'work' => 'Work')),
			'phone_secondary_number' => array('Phone number', self::FIELD_TEXT, '123-3456-7890', array(Form::REGEXP, 'Scondary phone number must be in format 123-3456-7890.', '/^[0-9]{3}\-?[0-9]{3}\-?[0-9]{4}$/', false)),
			'phone_secondary_type' => array('Phone type', self::FIELD_SELECT, 'home', null, array('home' => 'Home', 'mobile' => 'Mobile', 'work' => 'Work')),
			'email' => array('Email', self::FIELD_TEXT, 'email@email.com', array(Form::EMAIL, 'Valid email address is required.', '', false)),
			//'password' => array('Password', self::FIELD_PASSWORD, null),
			'bdd' => array('Birth date day', self::FIELD_TEXT, 'dd', array(Form::NUMERIC, 'Day is a number 1 to 31.', '', false)),
			'bdm' => array('Birth date month', self::FIELD_TEXT, 'mm', array(Form::NUMERIC, 'Month is a number 1 to 12.', '', false)),
			'bdy' => array('Birth date year', self::FIELD_TEXT, 'yyyy', array(Form::NUMERIC, 'Year is a four digit number.', '', false)),
			'address_street' => array('Address street', self::FIELD_TEXT, 'street address', array(Form::REGEXP, 'Please do not use special characters in the address.', '/^[a-z0-9 ,\-\.\']*$/i')),
			'address_apartment' => array('Address apartment', self::FIELD_TEXT, 'apt. no', array(Form::REGEXP, 'Please do not use special characters in the apartment number.', '/^[#a-z0-9 ,\-\.\']*$/i')),
			'address_city' => array('Address city', self::FIELD_TEXT, 'city', array(Form::REGEXP, 'Please do not use special characters in the city name.', '/^[a-z0-9 ,\-\.\']*$/i')),
			'address_zip' => array('Address zip',self::FIELD_TEXT, 'zip', array(Form::REGEXP, 'Use only numbers and + in the ZIP code.', '/^[0-9 \+]+$/i', false)),
			'address_state' => array('Address state', self::FIELD_TEXT, 'XX', array(Form::REGEXP, 'Please use two letter code for the state.', '/^[a-z]{2}$/i', false)),
			'gender' => array('Gender', self::FIELD_SELECT, 'female', null, array('male' => 'Male', 'female' => 'Female')),
			'referral' => array('Referral', self::FIELD_TEXT, '', array(Form::REGEXP, 'Referral cannot contain special characters.', '/^[a-z0-9 ,\-\.\'#]*$/i')),
		
			//stylists associated with an user
			'stylist_cut' => array('Cut Stylist', self::FIELD_SELECT, false, null, $stylists_cut),
			'stylist_color' => array('Color Stylist', self::FIELD_SELECT, false, null, $stylists_color)
		);
		
		return $fields;
	}
	
	function getEditingUser()
	{
		if ($this->editingUser === null)
		{
			$this->editingUser = new SalonClient($this->editingID);
		}
		
		return $this->editingUser;
	}
	
	/**
	 * Adds the field to the form.
	 * 
	 * @param Form $form
	 * @param string $type
	 * @param array $info
	 * @return Form
	 */
	function addToForm(Form $form, $name, $info)
	{
		//type
		switch($info[1])
		{
			case self::FIELD_TEXT:						
				$field = $form->addText($name, $info[0]);
				break;
			case self::FIELD_TEXTAREA:
				$field = $form->addTextArea($name, $info[0]);
				break;
			case self::FIELD_SELECT:
				$field = $form->addSelect($name, $info[0], $info[4]);
				break;
			case self::FIELD_PASSWORD:
				$field = $form->addPassword($name, $info[0]);
				break;
			default: throw Exception('');
		}
		
		//validation
		if (isset($info[3]) && $info[3] != null)
		{
			//if this is false, means that this field does not have to be filled
			//so precede the rule with a condition
			if (isset($info[3][3]) && $info[3][3] === false)
			{
				$field->addCondition(Form::FILLED)
						->addRule($info[3][0], $info[3][1], isset($info[3][2]) ? $info[3][2] : null);						
			}
			else
			{
				$field->addRule($info[3][0], $info[3][1], isset($info[3][2]) ? $info[3][2] : null);
			}
		}
					
		//default value
		if ($info[2] !== null)
		{
			$field->setValue($info[2]);
		}
	}
	
	function createComponentUserForm()
	{	
		$form = new AppForm(NULL, 'UserForm');
		
		$fields = $this->getProfileFields();
		
		foreach($fields as $name => $info)
		{
			$this->addToForm($form, $name, $info);
		}
		
		if ($this->editingID !== null)
		{
			$data = $this->getEditingUser()->getInstanceData();
			
			if ($data['birthdate'] != '1969-12-31')
			{			
				$birthdate = getdate(strtotime($data['birthdate']));
				$data['bdd'] = $birthdate['mday'];
				$data['bdm'] = $birthdate['mon'];
				$data['bdy'] = $birthdate['year'];
			}
			else
			{
				$data['bdd'] = '';
				$data['bdm'] = '';
				$data['bdy'] = '';
			}
						
			$form->setDefaults($data);
		}
		else
		{
			//initialize the username, if set. Otherwise its the field's default.
			if ($this->newUserUsername !== false)
			{
				$form['name']->setValue($this->newUserUsername);
			}
		}
		
		//initialize notes area
		if ($form['notes']->getValue() == '')
		{
			$form['notes']->setValue(self::DEFAULT_NOTES);
		}
		
		$form->addProtection('Please submit this form again (security token has expired).');

		if ($this->editingID !== null)
		{
			$form->onSubmit[] = array($this, 'editUserSubmitted');
		}
		else
		{
			$form->onSubmit[] = array($this, 'addUserSubmitted');
		}
		
		return $form;
	}
	
	function actionList()
	{
		$users = Users::getList('uid,name,phone_number', false, false, ($this->pageSize * $page), $this->pageSize);
		$res = array();
		
		foreach($users as $user)
		{
			$user->last_transaction_date = '1/1/2003';
			$res[] = $user;			 
		}
		
		$this->template->users = $res;
		$this->template->searching = false;
	}
	
	function actionEdit($id, $saved = 0)
	{
		$this->editingID = $id;
		$this->template->uid = $this->editingID;
		$this->template->euser = $this->getEditingUser();
		
		$this->template->saved = $saved; 
		
		$this->template->transactions = Transaction::getListByUser('transaction_void,transaction_id,transaction_total AS price,transaction_created_date AS date',
														false,
														$this->editingID,
														array('transaction_created_date', 'DESC'),
														0,
														self::MAX_TRANSACTIONS
														);
														
		$fields = $this->getProfileFields();
		
		$field_defaults = array();
		
		$this->template->field_defaults = array();
		
		foreach($fields as $name => $info)
		{
			if ($info[1] == self::FIELD_TEXT)
			{
				$this->template->field_defaults[$name] = $info[2];	
			}
		}
	}
	
	function actionSearch($search = '', $page = 0, $order = '')
	{	
		$this->setView('list');
		
		$this->parseOrder($order);
		
		$this->searchText = preg_replace('/[^a-z0-9 ,\-]/i', '', $search);
		
		$users = Users::getList(
			'uid,name,CONCAT_WS(", ", phone_primary_number,phone_secondary_number) AS phone_number, last_transaction_date',
			false,			
			empty($search) ? false : $search,
			array($this->orderBy, $this->orderDir),
			($this->pageSize * $page),
			$this->pageSize
		);
		
		$res = array();
		
		foreach($users as $user)
		{
			
			$res[] = $user;			 
		}
		
		$max_page = ceil(Users::$total / $this->pageSize);
		
		$this->template->page = $page;
		$this->template->page_prev = ($page > 0) ? $page - 1 : 0;
		$this->template->max_page = $max_page;
		$this->template->page_next = ($page < $max_page - 1) ? $page + 1 : $max_page - 1;
		
		$this->template->order_column = $this->orderBy;
		$this->template->order = $this->createOrderString($this->orderBy, $this->orderDir, true);
		
		$this->template->page_size = $this->pageSize;
		$this->template->users = $users;
		$this->template->searching = true;
		$this->template->search = $search;		
		$this->template->num_results = Users::$total;		
	}
	
	function actionAddUser($username)
	{		
		if (preg_match(self::REGEXP_USERNAME, $username))
		{
			$this->newUserUsername = $username;
		}
		
		$fields = $this->getProfileFields();
		
		$field_defaults = array();
		
		$this->template->field_defaults = array();
		
		foreach($fields as $name => $info)
		{
			if ($info[1] == self::FIELD_TEXT)
			{
				$this->template->field_defaults[$name] = $info[2];	
			}
		}
	}
	
	function addUserSubmitted(Form $form)
	{
		$db_data = $this->processData($form->getValues());
		
		if ($db_data['type'] != 'client' && !$this->permissions->isAdministrator())
		{
			throw new Exception('User is not an administrator.');
		}
				
		$user = new SalonClient();
		$uid = $user->insert($db_data);
		
		$this->redirect('edit', array('id' => $uid, 'saved' => 1));
	}
	
	function editUserSubmitted(Form $form)
	{
		$db_data = $this->processData($form->getValues());
		
		if ($db_data['type'] != 'client' && !$this->permissions->isAdministrator())
		{
			throw new Exception('User is not an administrator.');
		}
		
		$user = new SalonClient($this->editingID);
		$user->update($this->editingID, $db_data);
		
		$this->redirect('edit', array('id' => $this->editingID,  'saved' => 1));
	}
	
	function processData($formdata)
	{
		$db_data = $formdata;
		$db_data['birthdate'] = date('Y-m-d', mktime(0, 0, 0, (int)$db_data['bdm'], (int)$db_data['bdd'], (int)$db_data['bdy']));
		
		if ($db_data['notes'] == self::DEFAULT_NOTES)
		{
			$db_data['notes'] = '';
		}
				
		return $db_data;
	}
}