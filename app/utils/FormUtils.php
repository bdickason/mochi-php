<?php
class FormUtils
{
	const OPTION_EMPTY = 'none';
	
	static public function prependEmpty($label, $options)
	{
		$res = array(self::OPTION_EMPTY => $label);
		
		foreach($options as $value => $label)
		{
			$res[$value] = $label;
		}
		
		return $res;
	}	
}