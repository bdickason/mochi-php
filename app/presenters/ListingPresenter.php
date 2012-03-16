<?php
class ListingPresenter extends QuickSearchEnabledPresenter
{
	const SORT_ASC = 'ASC';
	const SORT_DESC = 'DESC';
	
	protected $orderBy = false;
	protected $orderDir = self::SORT_ASC;
		
	protected $pageSize = 10;
	
	protected $sortableColumns = array();
	protected $defaultOrder = false;
	
	/**
	 * Parses order string in the format "column ASC" or "column DESC" into the fields actually used when sorting.
	 * 
	 * @param string $order
	 * @param bool $default if true, turns off default recursion
	 * @return unknown_type
	 */
	protected function parseOrder($order, $default = false)
	{
		if (empty($order))
		{
			return $this->parseOrder($this->defaultOrder, true);
		}
		
		List($column, $dir) = explode(' ', $order);
		if (!in_array($column, $this->sortableColumns))
		{
			//prevent infinite recursion
			if ($default)
			{
				return;
			}
			
			return $this->parseOrder($this->defaultOrder, true);			
		}
		
		$this->orderBy = $column;
		
		if ($dir != self::SORT_ASC && $dir != self::SORT_DESC)
		{
			$this->orderDir = self::SORT_ASC;
		}
		else
		{
			$this->orderDir = $dir;
		}
	}
	
	public function createOrderString($column, $default_dir = 'ASC', $no_reverse = false)
	{	
		$order = $column . ' ';
		
		if (!$no_reverse && $this->orderBy == $column)
		{
			$order .= $this->reverseOrderDir($this->orderDir);	
		}
		else
		{
			$order .= $default_dir;
		}
		
		return $order;
	}
	
	protected function reverseOrderDir($dir)
	{ 
		if ($dir == self::SORT_ASC)
		{
			return self::SORT_DESC;
		}
		else
		{
			return self::SORT_ASC;
		}
	}
	
	public function getOrderDir($column)
	{
		if ($this->orderBy != $column)
		{
			return self::SORT_ASC;
		}
		else
		{
			return $this->orderDir;
		}
	}
}