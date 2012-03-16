<?php

class AppointmentMapperDiBi extends MapperDiBi
{	
	function __construct()
	{	
		$this->table_name = 'appointments';
		$this->pkey_name = 'appointment_id';
		
		parent::__construct();	 
	}
	
	protected function createEntity($data)
	{
		$a = new Appointment();
		$a->setIdentifier($data['appointment_id']);
		
		$a->appointment_id = $data['appointment_id'];
		
		$a->appointment_start_date = $data['appointment_start_date'];
		$a->appointment_end_date = $data['appointment_end_date'];
				
		$a->appointment_shared_code = $data['appointment_shared_code'];

		$a->appointment_client_uid = $data['appointment_client_uid'];
		$a->appointment_client_name = $data['appointment_client_name'];
		
		$a->appointment_client_phone = $data['appointment_client_phone'];
		$a->appointment_client_phone_type = $data['appointment_client_phone_type'];

		$a->appointment_stylist_uid = $data['appointment_stylist_uid'];
		
		$a->appointment_service_id = $data['appointment_service_id']; 
		
		$a->appointment_active = $data['appointment_active'] == 1;	

		return $a;
	}
	
	protected function extractData(DataEntity $a)
	{
		$data = array(
			'appointment_start_date' => $this->formatDateTime($a->appointment_start_date),
			'appointment_end_date' => $this->formatDateTime($a->appointment_end_date),
			'appointment_shared_code' => $a->appointment_shared_code,
			'appointment_client_name' => $a->appointment_client_name,
			'appointment_client_uid' => $a->appointment_client_uid,
			'appointment_stylist_uid' => $a->appointment_stylist_uid,
			'appointment_service_id' => $a->appointment_service_id,	
			'appointment_active' => (int)$a->appointment_active,
			'appointment_client_phone' => $a->appointment_client_phone,
			'appointment_client_phone_type' => $a->appointment_client_phone_type
		);
		
		return $data;
	}
		
	function toString()
	{
		return 'Appointment ' . $appointment_id;
	}
}