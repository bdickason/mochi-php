<?php

/**
 * BusinessClient data entity.
 *
 * @author Smok
 */
class BusinessClient extends DataEntity {
    /**
	 * Database persisted properties.
	 *
	 * A lot.
	 *
	*/

	public function setIdentifier($id)
	{
		$this->uid = $id;
	}

	public function getIdentifier()
	{
		return $this->uid;
	}

	function toString()
	{
		return 'Client ' . $this->name + ' ['.$this->uid.']';
	}
}
?>
