<?php

require_once('QuickSearchEnabledPresenter.php');

class DefaultPresenter extends QuickSearchEnabledPresenter
{
	/*
	function createComponentSearchForm()
	{
		$form = new AppForm;
		
		$form->addText('q', 'Search');
		
		$form->onSubmit[] = array($this, 'onSearchSubmit');
		
		return $form;
	}
	
	function onSearchSubmit($form)
	{
		$values = $form->getValues();
		
		if (preg_match('/^#/', $values['q']))
		{
			$this->redirect('Checkout:search', array('search' => $values['q']));
		}
		else
		{
			$this->redirect('Profile:search', array('search' => $values['q']));
		}		
	}
	*/
}