<?php
class UserOptions
{
	static function setUserOption($uid, $user_option_tag, $user_option_value)
	{
		$uo = self::getUserOption($uid, $user_option_tag);

		$data = array(
					'uid' => $uid,
					'user_option_tag' => $user_option_tag,
					'user_option_value' => $user_option_value
				);
		
		if ($uo === false)
		{	
			dibi::insert('users_options', $data)->execute();
		}
		else
		{
			dibi::update('users_options', array('user_option_value' => $user_option_value))
				->where('uid=%i',$uid)
				->where('user_option_tag=%s', $user_option_tag)
				->execute();
		}
	}
	
	/**
	 * Returns all users UOs, key - value pairs.
	 * 
	 * @param $uid
	 * @return array
	 */
	static function getUserOptions($uid)
	{
		$data = dibi::select('user_option_tag,user_option_value')
					->from('users_options')
					->where('uid=%i')
					->fetchPairs('user_option_tag', 'user_option_value');
					
		return $data;
	}
	
	/**
	 * Returns the value of one single user option.
	 * 
	 * @param $uid
	 * @param $user_option_tag
	 * @return string
	 */
	static public function getUserOption($uid, $user_option_tag)
	{	
		$data = dibi::select('user_option_value')
					->from('users_options')
					->where('uid=%i', $uid)
					->where('user_option_tag=%s', $user_option_tag)
					->fetchSingle();
					
		return $data;
	}
}