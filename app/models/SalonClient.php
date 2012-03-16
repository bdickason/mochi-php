<?php

class SalonClient extends Users
{	
	const UO_STYLIST_COLOR = 'salon_stylist_color';
	const UO_STYLIST_CUT = 'salon_stylist_cut';
	
	public function insert(array $data)
	{			
		$uid = parent::insert($data);
		
		if (!$uid)
		{
			return $uid;
		}
		
		UserOptions::setUserOption($uid, self::UO_STYLIST_COLOR, $data['stylist_color']);		
		UserOptions::setUserOption($uid, self::UO_STYLIST_CUT, $data['stylist_cut']);

		return $uid;
	}
	
	protected function loadAdditionalData()
	{		
		$this->stylist_cut = UserOptions::getUserOption($this->pkey_value, self::UO_STYLIST_CUT);
		$this->stylist_color = UserOptions::getUserOption($this->pkey_value, self::UO_STYLIST_COLOR);
	}
		
	public function update($id, array $data)
	{	
		$res = parent::update($id, $data);
				
		UserOptions::setUserOption($id, self::UO_STYLIST_COLOR, $data['stylist_color']);		
		UserOptions::setUserOption($id, self::UO_STYLIST_CUT, $data['stylist_cut']);
		
		return true;
	}
}