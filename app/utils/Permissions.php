<?php

class Permissions
{
	const PERM_ADMINISTRATOR = 'administrator';
	
	public function isAdministrator()
	{
		$user = Environment::getUser();
		if (!$user->isAuthenticated())
		{
			return false;
		}
		
		$info = $user->getIdentity();
		
		return preg_match('/' . self::PERM_ADMINISTRATOR . '/', $info->permissions);
	}
}