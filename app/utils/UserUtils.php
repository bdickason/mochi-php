<?php
class UserUtils
{
	static function isLoggedIn()
	{
		$user = Environment::getUser();		
		return $user->isAuthenticated();
	}
	
	static function getUserID()
	{
		if (!self::isLoggedIn())
		{
			return false;
		}
		
		$data = Environment::getUser()->getIdentity()->getData();
		return $data['uid']; 
	}
	
	static function getPhoneTypes()
	{
		return array('home' => 'Home', 'mobile' => 'Mobile', 'work' => 'Work');
	}
}