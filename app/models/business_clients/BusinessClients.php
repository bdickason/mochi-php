<?php

/**
 * Repository class.
 *
 * @author Smok
 */
class BusinessClients {

	const CLIENTS_TABLE_NAME = 'users';

	protected $businessHelper = null;

	public function __construct(BusinessHelper $bh)
	{
		$this->businessHelper = $bh;
	}

	/**
	 * Creates an empty client.
	 *
	 * @return BusinessClient
	 */
	public function create()
	{
		return new BusinessClient();
	}

	/**
	 * Loads one instance of BusinessClient, based on its id.
	 *
	 * @param int $uid
	 * @return BusinessClient
	 */
	public function one($uid)
	{
		$m = new BusinessClientMapperDiBi();
		$bc = $m->load($uid);

		return $bc;
	}

	public function delete($uid)
	{
		$m = new BusinessClientMapperDiBi();
		$m->delete(self::one($uid));
	}

	public function save(BusinessClient $bc)
	{
		$m = new BusinessClientMapperDiBi();
		return $m->save($bc);
	}

	public function find($parameters)
	{
		//TODO: implement this one!
	}
} 