<?php

class Appointment extends DataEntity
{
	/**
	 * Database persisted properties.
	 
		appointment_id;
		appointment_start_date;
		appointment_end_date;
		appointment_stylist_uid;
		appointment_client_uid;
		appointment_client_name;
		appointment_service_id;
		appointment_active;	
		//code used to identify linked appointments
		appointment_shared_code;
		appointment_client_phone
		appointment_checked_out
		appointment_transaction_id
	*/
	
	public function setIdentifier($id)
	{
		$this->appointment_id = $id;
	}
	
	public function getIdentifier()
	{
		return $this->appointment_id;
	}

	//appointment start date setter
	function setappointment_start_date($value)
	{
		return $this->data->appointment_start_date = Date('r', strtotime($value));		
	}
	
	//end date setter
	function setappointment_end_date($value)
	{
		return $this->data->appointment_end_date = Date('r', strtotime($value));
	}
		
	/**
	 * Creates stdClass with data converted for usage in Javascript.
	 */
	public function getJSObject()
	{
		$data = $this->data;
		
		$data->appointment_start_date = Formatting::dateToJS($data->appointment_start_date);
		$data->appointment_end_date =  Formatting::dateToJS($data->appointment_end_date);
		
		return $data;
	}
}