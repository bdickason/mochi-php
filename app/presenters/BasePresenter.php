<?php

abstract class BasePresenter extends Presenter
{
	public $oldLayoutMode = FALSE;

	const DATE_CURRENT_YEAR = 'n/j';
 	const DATE_OTHER_YEAR =  'n/j/y';

	protected function beforeRender()
	{
		$user = Environment::getUser();
		
		if ($user->isAuthenticated())
		{
			$this->template->user = $user->getIdentity()->getData();
		}
		else
		{
			$this->template->user = NULL;
		}
	}
	
	public function formatDate($date, $format = false)
	{
		return Formatting::formatDate($date, $format);		
	}
	
	public function formatPrice($value)
	{
		return BillingUtils::formatPrice($value);
	}
	
	function actionLogout()
	{
		Environment::getUser()->signOut();
		$this->flashMessage('You have been logged off.');
		$this->redirect('Auth:login');
	}

}
