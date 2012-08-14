<?php

class CalendarPresenter extends QuickSearchEnabledPresenter
{
	protected $appointmentInfo = null;
	protected $currentDate = null;

	protected function getCalendarConfig()
	{
		$config = new stdClass();

		$bs = $this->businessHelper->getSettings();

		$config->hours = CalendarUtils::createTimeSequence($bs->getOpeningHours());
		$config->stylists = $bs->getStylists();
		$config->services = $bs->getServices();
		$config->service_colors = $bs->getServiceColors();

		return $config;
	}

	public function actionHome($date = null)
	{
		//current date
		if ($date === null || $date == 'today')
		{
			$this->currentDate = Date('Y-m-d H:i:s');
		}
		else
		{
			$this->currentDate = Date('Y-m-d H:i:s', strtotime($date));
		}
	}

	protected function renderCalendar()
	{
		$this->setView('calendar');
		$this->setLayout('layout-new');

		$config = $this->getCalendarConfig();

		$stylists_index = array();
		foreach($config->stylists as $id => $name)
		{
			$dt = new DObject();
			$dt->id = $id;
			$dt->name = $name;
			$stylists_index[] = $dt;
		}

		$this->template->services = $config->services;
		$this->template->service_colors = $config->service_colors;
		$this->template->service_colors_json = json_encode($config->service_colors);
		$this->template->diffZ = (int)(Date('Z') / 60);
		$this->template->hours = $config->hours;
		$this->template->stylists = $config->stylists;
		$this->template->stylists_index_json = json_encode($stylists_index);
		$this->template->stylists_json = json_encode($config->stylists);
		$this->template->services_json = json_encode($config->services);
		$this->template->date = Formatting::dateToJS($this->currentDate);

		$appts = $this->businessHelper->getAppointments()->getRawDailyData($this->currentDate, true);
		$this->template->appts = json_encode($appts);
	}

	public function renderHome()
	{
		$this->renderCalendar();
	}

	public function createComponentAddForm()
	{
		$form = new AppForm(null, "add");

		$stylists = Users::getList('uid,name', Users::TYPE_STYLIST)->fetchPairs('uid', 'name');
		$services = Service::getActive(true);

		$form->addText('client_name', 'Client name');
		$form->addHidden('date', 'Date');
		$form->addHidden('client_uid', 'UID');
		$form->addText('startTime', 'Start time');
		$form->addText('endTime', 'End time');
		$form->addText('phone_number', 'Phone number');
		$form->addSelect('phone_type', 'Phone types')->setItems(UserUtils::getPhoneTypes());
		$form->addSelect('stylist', 'Stylist')->setItems($stylists);
		$form->addSelect('service', 'Service')->setItems($services);

		$form->addSubmit('book', 'Book!');

		$form->onSubmit[] = array($this, 'onAddAppointment');

		return $form;
	}

	public function createComponentEditForm()
	{
		$form = new AppForm(null, "edit");

		$stylists = Users::getList('uid,name', Users::TYPE_STYLIST)->fetchPairs('uid', 'name');
		$services = Service::getActive(true);

		//do not set any values, its all javascript bound
		$form->addHidden('appointment_id', 'Appointment id');
		$form->addText('client_name', 'Client name');
		$form->addHidden('date', 'Date');
		$form->addHidden('client_uid', 'UID');
		$form->addText('phone_number', 'Phone number');
		$form->addSelect('phone_type', 'Phone types')->setItems(UserUtils::getPhoneTypes());
		$form->addText('startTime', 'Start time');
		$form->addText('endTime', 'End time');
		$form->addSelect('stylist', 'Stylist')->setItems($stylists);
		$form->addSelect('service', 'Service')->setItems($services);

		$form->addSubmit('save', 'Save!');

		$form->onSubmit[] = array($this, 'onEditAppointment');

		return $form;
	}

	public function onAddAppointment($form)
	{
		$value = $form->getValues();

		$a = $this->businessHelper->getAppointments()->create();
		//initialize the data
		$a->appointment_stylist_uid = $value['stylist'];
		$a->appointment_service_id = $value['service'];

		$a->appointment_start_date = $value['date'] . ' ' . $value['startTime'];
		$a->appointment_end_date = $value['date'] . ' ' . $value['endTime'];

		$a->appointment_client_name = $value['client_name'];
		$a->appointment_client_uid = $value['client_uid'];
		$a->appointment_client_phone = $value['phone_number'];
		//$a->appointment_client_phone_type = $value['phone_type'];

		$a->appointment_active = true;

		//save!
		$this->businessHelper->getAppointments()->save($a);

		$this->payload->success = 1;
		$this->payload->appointment = $a->getJSObject();
	}

	public function onEditAppointment($form)
	{
		$value = $form->getValues();

		$a = $this->businessHelper->getAppointments()->one($value['appointment_id']);
		//initialize the data
		$a->appointment_stylist_uid = $value['stylist'];
		$a->appointment_service_id = $value['service'];

		$a->appointment_start_date = $value['date'] . ' ' . $value['startTime'];
		$a->appointment_end_date = $value['date'] . ' ' . $value['endTime'];

		$a->appointment_client_name = $value['client_name'];
		$a->appointment_client_uid = $value['client_uid'];
		$a->appointment_client_phone = $value['phone_number'];

		//$a->appointment_client_phone_type = $value['phone_type'];

		$a->appointment_active = true;

		//save!
		$this->businessHelper->getAppointments()->save($a);

		$this->payload->success = 1;
		$this->payload->appointment = $a->getJSObject();
	}

	public function actionUpdateAppointment($data)
	{
		$this->setView('calendar');
		$value = $data;

		$a = $this->businessHelper->getAppointments()->one($value['appointment_id']);
		//initialize the data
		$a->appointment_stylist_uid = $value['appointment_stylist_uid'];
		$a->appointment_service_id = $value['appointment_service_id'];

		$a->appointment_start_date = Formatting::dateFromJS($value['appointment_start_date']);
		$a->appointment_end_date = Formatting::dateFromJS($value['appointment_end_date']);

		$a->appointment_client_name = $value['appointment_client_name'];
		$a->appointment_client_phone = $value['appointment_client_phone'];
		//$a->appointment_client_phone_type = $value['appointment_client_phone_type'];

		$a->appointment_active = true;

		//save!
		$this->businessHelper->getAppointments()->save($a);

		$this->payload->success = 1;
		$this->payload->appointment = $a->getJSObject();
	}

	public function actionGetAppointments($date)
	{
		if ($date == 'today')
		{
			$time = time();
		}
		else
		{
			$time = strtotime($date);
		}

		if ($time === false)
		{
			$this->payload->success = 0;
			$this->payload->error = 'Incorrect date.';
			return;
		}

		$this->payload->success = 1;
		$this->payload->appointments = $this->businessHelper->getAppointments()->getRawDailyData(Date('Y-m-d', $time), true);
		$this->payload->currentDate = Formatting::dateToJS($date);
		$this->payload->currentDateStr = Date('l  F j, Y', $time);
	}

	function actionDeleteAppointment($id)
	{
		$this->businessHelper->getAppointments()->delete($id);
		$this->payload->success = 1;
	}

	public function renderGetAppointments()
	{
		$this->setView('calendar');
	}

	public function renderDeleteAppointment()
	{
		$this->setView('calendar');
	}

	public function renderUpdateAppointment()
	{
		$this->setView('calendar');
	}
}