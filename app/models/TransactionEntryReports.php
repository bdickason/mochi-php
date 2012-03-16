<?php

class TransactionEntryReports extends TransactionEntry
{	
	/**
	 * Returns sum of transaction entries, filtered by entry type, date and groups them by service id.
	 * Orders by the amounts.
	 * 
	 * @param string $entry_type
	 * @param string $start_date
	 * @param string $end_date
	 * @return array
	 */
	static public function getPreTaxDataGrouped($entry_type, $start_date, $end_date)
	{
		$sql ="
			SELECT
				transaction_entry_service_id AS service_id,
				COUNT(*) as count,
				SUM(transaction_entry_price_added) AS sum
			FROM
				transactions_entries TE
				INNER JOIN
				transactions T
				ON
				TE.transaction_id = T.transaction_id
			WHERE
				TE.transaction_entry_type = '".$entry_type."'
				AND
				T.transaction_void = 0
				AND
				T.transaction_finalized = 1
				AND
				transaction_entry_date_added >= '".$start_date."'
				AND
				transaction_entry_date_added <= '".$end_date."'
			GROUP BY
				transaction_entry_service_id,
				transaction_entry_type
			ORDER BY
				sum DESC";
		
		return dibi::query($sql);
	}
	
	static public function getPayrollData($uid, $start_date, $end_date)
	{
		$sql ="
			SELECT
				transaction_entry_uid AS uid,
				transaction_entry_type AS type,
				SUM(transaction_entry_price_added) AS sum
			FROM
				transactions_entries TE
				INNER JOIN
				transactions T
				ON
				TE.transaction_id = T.transaction_id
			WHERE
				T.transaction_void = 0
				AND
				T.transaction_finalized = 1
				AND
				transaction_entry_date_added >= '".$start_date."'
				AND
				transaction_entry_date_added <= '".$end_date."'";
		
		if ($uid !== false)
		{
			$sql .= " AND transaction_entry_uid = '".(int)$uid."' ";
		}
		
		$sql .= "
			GROUP BY
				transaction_entry_uid,
				transaction_entry_type
			ORDER BY
				transaction_entry_uid, transaction_entry_type";
				
		return dibi::query($sql);
	}
	
	static public function getPersonTransactionData($uid, $start_date, $end_date)
	{
		$sql ="
			SELECT
				T.transaction_code AS code,
				T.transaction_client_name AS client_name,
				transaction_entry_uid AS uid,
				transaction_entry_type AS type,
				transaction_entry_service_id AS service_id,
				transaction_entry_quantity AS quantity,
				transaction_entry_price_added AS price,
				transaction_entry_date_added AS date
			FROM
				transactions_entries TE
				INNER JOIN
				transactions T
				ON
				TE.transaction_id = T.transaction_id
			WHERE
				T.transaction_void = 0
				AND
				T.transaction_finalized = 1
				AND
				transaction_entry_date_added >= '".$start_date."'
				AND
				transaction_entry_date_added <= '".$end_date."'";
		
		if ($uid !== false)
		{
			$sql .= " AND transaction_entry_uid = '".(int)$uid."' ";
		}
		
		$sql .= "			
			ORDER BY
				transaction_entry_date_added DESC,
				transaction_entry_type DESC";
				
		return dibi::query($sql);
	}
	
	static public function getRetailTransactionDataGrouped($pid, $start_date, $end_date)
	{
		$sql ="
			SELECT  
				SUBSTRING(product_name, 1, LOCATE(' ', product_name)) AS product_brand,
				SUM(te.transaction_entry_price_added) AS product_brand_price,
				SUM(te.transaction_entry_quantity) AS product_brand_count
			FROM
		 		transactions_entries AS te
		 		LEFT JOIN
		 		products AS p 
				ON 
				te.transaction_entry_service_id = p.product_id 
			WHERE
				te.transaction_entry_type = 'product' 
				AND
				te.transaction_entry_date_added BETWEEN '".$start_date."' AND '".$end_date."'";
			
				
		if($pid !== false)
		{
			$sql .= " AND p.product_id = '".$pid."' ";
		}
	
		$sql .= "GROUP BY
					product_brand
				 ORDER BY
					product_brand ASC";
					
		return dibi::query($sql);
	}
	
	static public function getRetailTransactionData($pid, $start_date, $end_date)
	{
		$sql ="
			SELECT  
				product_name,
				SUM(te.transaction_entry_price_added) AS product_sumprice,
				SUM(te.transaction_entry_quantity) AS product_count
			FROM
		 		transactions_entries AS te
		 		LEFT JOIN
		 		products AS p 
				ON 
				te.transaction_entry_service_id = p.product_id 
			WHERE
				te.transaction_entry_type = 'product' 
				AND
				te.transaction_entry_date_added BETWEEN '".$start_date."' AND '".$end_date."'";
			
				
		if($pid !== false)
		{
			$sql .= " AND p.product_id = '".$pid."' ";
		}
	
		$sql .= "GROUP BY
					product_name
				 ORDER BY
					product_name ASC";
					
		return dibi::query($sql);
	}
}