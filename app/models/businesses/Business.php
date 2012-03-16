<?php
/**
 * Represents one business.
 *
 * @author Smok
 */
class Business extends DataEntity
{
	
	public function getIdentifier()
	{
		return $this->business_id;
	}

	public function setIdentifier($id)
	{
		$this->business_id = $id;
	}
}