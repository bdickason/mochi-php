<?php

abstract class MapperDiBi extends Mapper
{	
	protected $pkey_name = null;	
	protected $table_name = null;
	
	static $metadata = array();

	const OP_INSERT = 'insert';
	const OP_UPDATE = 'update';
	
	function __construct()
	{ 
		$this->populateMetadata();
	}
	
	protected function formatDateTime($value)
	{
		return Date('Y-m-d H:i:s', strtotime($value));
	}

	protected function getMetadata()
	{
		return self::$metadata[$this->table_name];
	}
			
	protected function populateMetadata()
	{
		if (isset(self::$metadata[$this->table_name]))
		{
			return;
		}
		
		$sql = "SHOW COLUMNS FROM `" . $this->table_name . "`";
		
		$results = dibi::query($sql);
		
		self::$metadata[$this->table_name] = array('columns' => array());
		
		foreach($results as $column)
		{
			self::$metadata[$this->table_name]['columns'][$column['Field']] = $column; 
		}
	}
	
	public function load($identifier)
	{	
		$a = dibi::select('*')->from($this->table_name)->where($this->pkey_name . '=%i', $identifier)->fetch();
		
		if (empty($a[$this->pkey_name]) || $a[$this->pkey_name] != $identifier)
		{
			throw new MapperNotFoundException('Could not find entity of type '.$this->table_name.' and id of '.$identifier);
		}
		
		return $this->createEntity($a);
	}
	
	public function delete(DataEntity $entity)
	{
		return dibi::delete($this->table_name)->where($this->pkey_name . '=%i', $entity->getIdentifier())->execute();
	}

	/**
	 * Allows to run modifications on the data just before saving.
	 * This is handy to set updated timestamps etc.
	 *
	 * The default handler does nothing.
	 */
	protected function updateExtractedData($data, $operation)
	{
		//do nothing to the data
		return $data;
	}
	
	public function save(DataEntity $entity)
	{
		if ($entity->getIdentifier() === null)
		{
			dibi::insert($this->table_name, $this->updateExtractedData($this->extractData($entity), self::OP_INSERT))->execute(dibi::IDENTIFIER);
			$entity->setIdentifier(dibi::getInsertId());			
		}
		else
		{
			dibi::update($this->table_name, $this->updateExtractedData($this->extractData($entity), self::OP_UPDATE))->where($this->pkey_name.'=%i', $entity->getIdentifier())->execute();
		}
		
		return true;
	}
}