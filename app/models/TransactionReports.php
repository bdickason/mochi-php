<?php

class TransactionReports extends Transaction
{
	/**
	 * Returns transactions from the given date range, grouped by payment type. 
	 * 
	 * @param $start_date
	 * @param $end_date
	 * @return 
	 */
	static public function getPaymentTypesReport($start_date, $end_date)
	{	
		$sql ="			
			SELECT
				transaction_payment_type AS payment_type,
				SUM(transaction_total) AS sum,
				COUNT(*) AS count
			FROM				
				transactions T
			WHERE
				T.transaction_void = 0
				AND
				T.transaction_finalized = 1
				AND
				transaction_created_date >= '".$start_date."'
				AND
				transaction_created_date <= '".$end_date."'
			GROUP BY
				transaction_payment_type
			ORDER BY
				transaction_payment_type DESC";
		
		return dibi::query($sql);	
	}
	
	
	static public function getMerchantTransactionData($mid, $start_date, $end_date)
	{
		$sql ="
			SELECT
	                transaction_client_name as name,
                    transaction_created_date as date,
					transaction_payment_type AS payment_type,
					transaction_total AS sum
				FROM				
					transactions T
				WHERE
					T.transaction_void = 0
					AND
					T.transaction_finalized = 1
					AND
					transaction_created_date >= '".$start_date."'
					AND
					transaction_created_date <= '".$end_date."' ";
			if($mid !== false)
			{
				$sql .= "AND T.payment_type = '".$mid."' ";
				
			}
			$sql .= "ORDER BY
					payment_type DESC";
					
		return dibi::query($sql);
	}
}