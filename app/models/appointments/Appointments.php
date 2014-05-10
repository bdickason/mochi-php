<?php


class Appointments extends DataDomain
{
	const APPOINTMENTS_TABLE_NAME = 'appointments';

	protected $businessHelper = null;

	public function __construct(BusinessHelper $bh)
	{
		$this->businessHelper = $bh;
	}

	/**
	 * Creates an empty appointment.
	 *
	 * @return Appointment
	 */
	public function create()
	{
		return new Appointment();
	}

	/**
	 * Loads one instance of Appointment, based on its id.
	 *
	 * @param int $appointment_id
	 * @return Appointment
	 */
	public function one($appointment_id)
	{
		$am = new AppointmentMapperDiBi();
		$a = $am->load($appointment_id);

		return $a;
	}

	public function delete($appointment_id)
	{
		$am = new AppointmentMapperDiBi();
		$am->delete(self::one($appointment_id));
	}

	public function save(Appointment $a)
	{
		try {
			$client = $this->businessHelper->getClients()->one($a->appointment_client_uid);
		}
		catch(MapperNotFoundException $e)
		{
			//need to create this client
			$client = $this->businessHelper->getClients()->create();
			$client->name = $a->appointment_client_name;
			$client->email = $a->appointment_client_email;
			$client->phone_primary_number = $a->appointment_client_phone;
			$client->phone_primary_type = $a->appointment_client_phone_type;

			$this->businessHelper->getClients()->save($client);

			$a->appointment_client_uid = $client->getIdentifier();
		}

		$am = new AppointmentMapperDiBi();
		return $am->save($a);
	}

	public function find($parameters)
	{
		if (!isset($parameters['fields']))
		{
			$fields = '*';
		}
		elseif (isset($parameters['objects']))
		{
			$fields = 'appointment_id';
		}
		else
		{
			$fields = implode(',', $parameters['fields']);
		}

		$data = dibi::select($fields)->from(self::APPOINTMENTS_TABLE_NAME);

		if (isset($parameters['date']))
		{
			$date = date('Y-m-d', strtotime($parameters['date']));

			$data = $data->where('appointment_start_date >= %s', $date . ' 00:00:00')
						->where('appointment_start_date <= %s', $date . ' 23:59:59');
		}

		// Get all appointments after this date
		if (isset($parameters['date_after']))
		{
			$date = date('Y-m-d', $parameters['date_after']);

			$data = $data->where('appointment_start_date >= %s', $date . ' 00:00:00');
		}

		if (isset($parameters['active']))
		{
			$data = $data->where('appointment_active=1');
		}

		if (isset($parameters['client']))
		{
			$data = $data->where('appointment_client_uid=%i', $parameters['client']);
		}

		if (isset($parameters['stylist']))
		{
			if (is_array($parameters['stylist']))
			{
				$data = $data->where('appointment_stylist_uid')->in($parameters['stylist']);
			}
			else
			{
				$data = $data->where('appointment_stylist_uid=%i', $parameters['stylist']);
			}
		}

		if (isset($parameters['service']))
		{
			if (is_array($parameters['service']))
			{
				$data = $data->where('appointment_service_id')->in($parameters['service']);
			}
			else
			{
				$data = $data->where('appointment_service_id=%i', $parameters['service']);
			}
		}

		if (isset($parameters['objects']))
		{
			$result = array();

			foreach($data as $row)
			{
				$result[] = $this->one($row['appointment_id']);
			}
		}
		else
		{
			$result = $data;
		}


		return $result;
	}

	public function getRawDailyData($date, $js_dates = false)
	{
		$a_data = self::find(array('date' => $date));

		$appts = array();
		foreach($a_data as $a_row)
		{
			$appt = Appointments::one($a_row['appointment_id']);
			if ($js_dates)
			{
				$appts[] = $appt->getJSObject();
			}
			else
			{
				$appts[] = $appt->getDataObject();
			}
		}

		return $appts;
	}

	public static function getListByUser($uid, $date)
	{
		$params = array();
		$params['client'] = $uid;
		$params['date_after'] = $date;
		$a_data = self::find($params);

		$appts = array();
		foreach($a_data as $a_row)
		{
			$appt = Appointments::one($a_row['appointment_id']);
			$appts[] = $appt->getDataObject();	// Only get one per day
		}

		return $appts;
	}
}

