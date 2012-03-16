<?php
class DBONotFoundException extends Exception
{
	
}

abstract class DBO  implements ArrayAccess
{
	protected $instance = null;
	protected $pkey_name = null;
	protected $pkey_value = false;
	protected $table_name = null;
	
	protected $loaded = false;
	
	static public $total = 0;
	
	static $metadata = array();
	
	function __construct($pkey_value)
	{ 
		$this->populateMetadata();
		
		if ($pkey_value === false)
		{
			$this->instance = array();	
		}
		else
		{
			$this->pkey_value = $pkey_value;
			
			$this->instance = dibi::select('*')->from($this->table_name)->where($this->pkey_name . '=%i', $this->pkey_value)->fetch();
			
			if ($this->instance[$this->pkey_name] == $pkey_value)
			{				
				$this->loadAdditionalData();
				
				$this->loaded = true;
			}
			else
			{
				throw new DBONotFoundException("Cannot find entry in " . $this->table_name . ", pkey " . $this->pkey_value);
			}
		}
	}
	
	protected function getColumns()
	{
		if (!isset(self::$metadata[$this->table_name]) || self::$metadata[$this->table_name] == false)
		{
			$this->populateMetadata();
		}
		
		return self::$metadata[$this->table_name]['columns'];
	}
	
	/**
	 * Returns array of data based on the table metadata - only elements that are real columns will be returned. 
	 * 
	 * @return array
	 */
	protected function getDBData($data = false)
	{
		if ($data === false)
		{
			$data = $this->instance;
		}
		
		$this->populateMetadata();
		
		$dbdata = array();
		$columns = array_keys($this->getColumns());
		
		foreach($data as $name => $value)
		{
			if (in_array($name, $columns))
			{
				$dbdata[$name] = $value;
			}
		}
		
		return $dbdata;
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
	
	protected function loadAdditionalData()
	{
		//do nothing
	}
	
	function loaded()
	{
		return $this->loaded;
	}
	
	function __set($name, $value)
	{
		$this->instance[$name] = $value;
	}
	
	function __isset($name)
	{	
		return isset($this->instance[$name]);
	}
	
	function __unset($name)
	{
		if (isset($this->instance[$name]))
		{
			unset($this->instance[$name]);
		}
	}
	
	function __get($name)
	{
		if ($name == 'id')
		{
			return $this->pkey_value;
		}
		
		return $this->instance[$name];
	}
	
	public function delete()
	{
		if (!$this->loaded())
		{
			return false;
		}
		
		return dibi::delete($this->table_name)->where($this->pkey_name . '=%i', $this->pkey_value)->execute();
	}
	
	public function save()
	{
		if (!$this->loaded)
		{						
			dibi::insert($this->table_name, $this->getDBData())->execute(dibi::IDENTIFIER);
			$this->pkey_value = dibi::getInsertId();
			$this->loaded = true;
		}
		else
		{
			dibi::update($this->table_name, $this->getDBData())->where($this->pkey_name.'=%i', $this->pkey_value)->execute();
		}
		
		return true;
	}
	
	public function insert(array $data)
	{	
		return dibi::insert($this->table_name, $this->getDBData($data))->execute(dibi::IDENTIFIER);
	}
	
	public function update($id, array $data)
	{
		return dibi::update($this->table_name, $this->getDBData($data))->where($this->pkey_name.'=%i', $id)->execute();
	}
	
	public function getInstanceData()
	{
		return $this->instance;
	}
	
	/**
	 * ArrayAccess implementation
	 */	
	public function offsetSet($offset, $value)
	{
        $this->instance[$offset] = $value;
    }
    
    public function offsetExists($offset)
    {
        return isset($this->instance[$offset]);
    }
    
    public function offsetUnset($offset)
    {
        unset($this->instance[$offset]);
    }
    
    public function offsetGet($offset)
    {
        return isset($this->instance[$offset]) ? $this->instance[$offset] : null;
    }
}