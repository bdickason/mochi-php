<?php

class BusinessClientMapperDiBi extends MapperDiBi
{	
	function __construct()
	{	
		$this->table_name = 'users';
		$this->pkey_name = 'uid';
		
		parent::__construct();	 
	}

	protected function createEntity($data)
	{
		$client = new BusinessClient();

		$client->setIdentifier($data['uid']);

		$md = $this->getMetadata();
		foreach($md['columns'] as $column_name => $dummy)
		{
			if ($column_name != $this->pkey_name)
			{
				$client->{$column_name} = $data[$column_name];
			}
		}

		return $client;
	}

	protected function updateExtractedData($data, $operation)
	{
		$current = Date('Y-m-d H:i:s');;

		if ($operation == self::OP_INSERT)
		{
			$data['date_added'] = $current;
		}

		$data['date_updated'] = $current;

		return $data;
	}
	
	protected function extractData(DataEntity $client)
	{
		$data = array();

		$md = $this->getMetadata();
		foreach($md['columns'] as $column_name => $dummy)
		{
			$data[$column_name] = $client->{$column_name};
		}

		$data['type'] = 'client';
		
		return $data;
	}	
}