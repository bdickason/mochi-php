<?php



require_once dirname(__FILE__) . '/BasePresenter.php';


class AuthPresenter extends BasePresenter
{
	/** @persistent */
	//public $backlink = '';


/*
	public static function getPersistentParams()
	{
		return array('backlink');
	}
*/


	/********************* component factories *********************/



	/**
	 * Login form component factory.
	 * @return mixed
	 */
	protected function createComponentLoginForm()
	{
		$form = new AppForm;
		$form->addText('username', 'Email')
			->addRule(Form::FILLED, 'Please provide a username.')
			->getLabelPrototype()->class('hidden');

		$form->addPassword('password', 'Password')
			->addRule(Form::FILLED, 'Please provide a password.')
			->getLabelPrototype()->class('hidden');

		$form->addSubmit('login', '');

		$form->addProtection('Please submit this form again (security token has expired).');

		$form->onSubmit[] = array($this, 'loginFormSubmitted');
		
		return $form;
	}


	
	public function loginFormSubmitted($form)
	{
		try {
			$user = Environment::getUser();
			$user->authenticate($form['username']->getValue(), $form['password']->getValue());
			//$this->getApplication()->restoreRequest($this->backlink);
			$this->redirect('Default:');

		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}
	

}
