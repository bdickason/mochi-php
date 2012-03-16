<?php

require_once('AuthenticatedPresenter.php');

class QuickSearchEnabledPresenter extends AuthenticatedPresenter
{
	protected $searchText;
	
	function createComponentSearchForm()
	{
		$form = new AppForm;
		
		$form->addText('q', 'Search');
		
		$form->onSubmit[] = array($this, 'onSearchSubmit');
		
		return $form;
	}
	
	function createComponentCheckoutSearchForm()
	{
		$form = new AppForm;
		
		$form->addText('q', 'Type user name');
		
		$form->onSubmit[] = array($this, 'onCheckoutSearchSubmit');
		
		return $form;
	}
	
	function onCheckoutSearchSubmit($form)
	{
		$values = $form->getValues();
		
		$this->redirect('Profile:search', array('search' => $values['q']));		
	}
	
	function onSearchSubmit($form)
	{
		$values = $form->getValues();
		
		if (preg_match('/^[#0-9]/', $values['q']))
		{
			$this->redirect('Checkout:search', array('search' => $values['q']));
		}
		else
		{
			$this->redirect('Profile:search', array('search' => $values['q']));
		}
	}
}