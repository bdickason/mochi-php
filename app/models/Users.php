<?php

require_once('DBO.php');

class Users extends DBO implements IAuthenticator
{		
	protected $uid = false;
	
	const TYPE_STYLIST = 'stylist';
	const TYPE_ADMINISTRATOR = 'administrator';
	const TYPE_RECEPTIONIST = 'receptionist';
	const TYPE_ASSISTANT = 'assistant';
	const TYPE_CLIENT = 'assistant';
		
	public function __construct($uid = false)
	{
		$this->uid = $uid;
		$this->table_name = 'users';
		$this->pkey_name = 'uid';
		
		parent::__construct($uid);
	}
	
	/**
	 * Performs an authentication
	 * @param  array
	 * @return void
	 * @throws AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		//using email as the username
		$email = strtolower($credentials[self::USERNAME]);
		$password = strtolower($credentials[self::PASSWORD]);
		
		$row = dibi::select('*')->from('users')->where('email=%s', $email)->fetch();
		
		if (!$row) {
			throw new AuthenticationException("User '$email' not found.", self::IDENTITY_NOT_FOUND);
		}

		if ($row->password_hash !== sha1($password . $row->password_salt)) {
			throw new AuthenticationException("Invalid password.", self::INVALID_CREDENTIAL);
		}

		unset($row->password_hash);
		
		
		return new Identity($row->email, NULL, $row);
	}
		
	static public function getList($fields, $type = false, $search = false, $order = array('name', 'ASC'), $limit = false, $offset = false)
	{
		$users = dibi::select($fields)->from('users');
			
		if ($type !== false)
		{
			if (is_array($type))
			{
				$users = $users->where('type')->in($type);
			}
			else
			{
				$users = $users->where('type=%s', $type);
			}
		}
		
		if ($search !== false)
		{
			$users = $users->where('name')->like('%s', '%'.$search.'%');
		}
		
		self::$total = count($users);
		
		if (is_array($order) && count($order) == 2 && $order[0] !== false && $order[1] !== false)
		{
			$users = $users->orderBy($order[0] . ' ' . $order[1]);
		}
		
		if ($limit !== false)
		{
			$users = $users->limit($limit . ',' . $offset);
		}
		
		return $users;
	}
	
	static public function getData($uid)
	{
		$row = dibi::select('*')->from('users')->where('uid=%i', $uid)->fetch();
		return $row;
	}
}