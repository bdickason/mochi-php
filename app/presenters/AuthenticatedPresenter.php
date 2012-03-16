<?php

require_once('BasePresenter.php');

class AuthenticatedPresenter extends BasePresenter
{
	protected $permissions = null;
	
	protected $currentUserData = null;

	/**
	 * @var BusinessHelper
	 */
	protected $businessHelper = null;

	/**
	 * Initializes the "current business".
	 */
	protected function initBusiness()
	{
		//TODO: replace this code with real business identification
		$business = new Business();
		$this->businessHelper = new BusinessHelper($business);
	}

	protected function startup()
	{
		$user = Environment::getUser();
		
		if (!$user->isAuthenticated()) {
			$backlink = $this->getApplication()->storeRequest();
			$this->redirect('Auth:login', array('backlink' => $backlink));
		}
		
		$this->currentUserData = $user->getIdentity()->getData();		
		$this->permissions = new Permissions();
		$this->initBusiness();
		
		parent::startup();
	}
}