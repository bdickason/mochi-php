if (typeof sms == 'undefined')
{
	var sms = {};
}

sms.calendar = function (currentDate)
{		
	this.currentDate = new Date(Date.parse(currentDate));
	
	this.startHour = null,
	this.endHour = null,
	this.dailyLink = null,
	
	this.event = null,
	
	this.currentAppointment = null,
	
	this.meshOffsetTop = 0,
	this.meshOfssetLeft = 176,
	this.meshSizeX = 40,
	this.meshSizeY = 40,
	
	//minutes
	this.newAppointmentDefaultLength = 60,
	
	this.appointments = [];
	
	this.editDialog = null;
	this.addDialog = null;
};

sms.calendar.prototype.init = function()
{
};

sms.calendar.prototype.flush = function()
{
	for(var index in this.appointments)
	{	
		this.eraseAppointment(this.appointments[index]);
	}
	
	this.appointments = [];
}

//adds a new appointment into the system
sms.calendar.prototype.addAppointment = function(appt)
{	
	this.appointments[appt.htmlId] = appt;
	this.drawAppointment(appt);
};

sms.calendar.prototype.findAppointment = function(id)
{
	if (this.appointments[id])
	{
		return this.appointments[id];
	}
	else
	{
		throw new Error('Cannot find appointment ' + id);
	}
};

sms.calendar.prototype.removeAppointment = function(appt)
{	
	$('#' + appt.htmlId).remove();
	this.appointments[appt.htmlId] = null;
	delete this.appointments[appt.htmlId];
};

sms.calendar.prototype.drawAppointment =  function(appt)
{
	var div = $('#' + appt.htmlId);
	//create if doesnt exist
	if(div.length == 0)
	{			
		div = this.createAppointmentBox(appt);
	}
			
	var calOffset = $('#calendar').offset();		
	var topOffset = $('#sa-' + appt.appointment_stylist_uid).offset();
	
	var position = { 
					left: this.meshOfssetLeft + (this.meshSizeX+1) * ((appt.startDate.getUTCHours() - this.startHour)*2 + (appt.startDate.getUTCMinutes() / 30)), 
					top: Number(topOffset.top - calOffset.top) + this.meshOffsetTop 
					};
	
	div.css({top:position.top,left:position.left,width: this.getAppointmentBoxWidth(appt) });
	
	var colorNumber = this.serviceColors[appt.appointment_service_id];

	//rather ugly way to remove current color class	
	div.removeClass(function(index, oldclass) {
		var res;
		if ((res = oldclass.match(/serviceColor([0-9]+)/)))
		{
			return 'serviceColor' + res[1];
		}
		else
		{
			return '';
		}
	}).addClass('serviceColor' + colorNumber);

	var self = this;

	var c = $('#calendar');
	var co = c.offset();
	div.draggable({
				containment:[co.left + this.meshOffsetLeft, co.top, co.left + c.width(), co.top + c.height()],
				grid:[this.meshSizeX + 1, this.meshSizeY + 1],
				start:function(event, ui) { self.apptDraggingStart(event, ui, appt); },
				drag:function(event, ui) { self.apptDragging(event, ui, appt); },
				stop:function(event, ui) { self.apptDraggingDone(event, ui, appt); }
				});

	if (!appt.temporary)
	{	
		div.mouseout(function(evt) { self.aMouseout(evt); });
		div.mousemove(function(evt) { self.aMouseover(evt, this.id); });
		div.removeClass('app-temp');
	}
	
	$('#calendar').append(div);				
};

sms.calendar.prototype.apptDraggingStart = function(e, ui, appt)
{
	appt.dragging = true;
};

sms.calendar.prototype.apptDragging = function(e, ui, appt)
{
	var pos = ui.position;
	var x = (pos.left - this.meshOfssetLeft) / (this.meshSizeX+1);
	var y = Math.floor(pos.top / this.meshSizeY);

	var h = Math.floor(x / 2) + this.startHour;
	var min = (x % 2) * 30;

	if (x < 0 || y < 1 || !this.stylistsIndex[y - 1])
	{
		return;
	}

	if (appt.timeDifferent(h, min) || appt.appointment_stylist_uid != this.stylistsIndex[y - 1].id)
	{
		appt.appointment_stylist_uid = this.stylistsIndex[y - 1].id;
		appt.moveToTime(h + ':' + min);

		this.fillInfoBox(appt);
	}
};

sms.calendar.prototype.apptDraggingDone = function(e, ui, appt)
{
	var pos = ui.position;
	var x = (pos.left - this.meshOfssetLeft) / (this.meshSizeX+1);
	var y = Math.floor(pos.top / this.meshSizeY);

	//mark the appointment dragged, so the click event does not trigger
	appt.dragging = false;
	appt.dragged = true;

	var h = Math.floor(x / 2) + this.startHour;
	var min = (x % 2) * 30;

	this.hoverAppointment = null;

	//do nothing, if it was dragged outside
	if (x < 0 || y < 1 || !this.stylistsIndex[y - 1])
	{
		this.makeHoverDiv().hide();
		this.drawAppointment(appt);
		return false;
	}

	appt.appointment_stylist_uid = this.stylistsIndex[y - 1].id;
	appt.moveToTime(h + ':' + min);

	this.fillInfoBox(appt);

	sms.loading.show(pos);
	$.post(
		this.udateAppointmentLink,
		{ data : appt.getServerObject() },
		function(payload)
		{
			if (payload.success)
			{
				//payload.appointment;
			}

			sms.loading.hide();
		},
		'json'
	);

	return false;
};

sms.calendar.prototype.eraseAppointment = function(appt)
{
	$('#' + appt.htmlId).remove();
}

sms.calendar.prototype.getAppointmentBoxWidth = function(appt)
{	
	var hrs = (appt.endDate.getTime() - appt.startDate.getTime()) / 3600000; //milliseconds
	
	return ((this.meshSizeX + 1) * (hrs * 2)) - 1
};

sms.calendar.prototype.createAppointmentBox = function(appt)
{
	var box = $('<div />').addClass('appointment')
		.attr('id', appt.htmlId)
		.css({ position:'absolute'});
	
	if (appt.temporary)
	{
		box.addClass('app-temp');
	}
	else
	{
		var self = this;
		box.click(function(evt) { self.editAppointmentClick(evt, this); });
	}
	
	
	return box;
};

sms.calendar.prototype.add = function(info)
{	
	var appt = new sms.appointment(
					{
						appointment_id : 'new',
						appointment_start_date : info.startDate.toString(),
						appointment_end_date : info.endDate.toString(),							
						appointment_stylist_uid : info.stylist_uid,
						appointment_service_id : info.service_id,
						appointment_client_phone : '',
						appointment_client_phone_type : 'mobile',
						temporary : 1
					});
	
	var self = this;
	this.addDialog = this.addDialog || new sms.appointmentDialog( 
				{ 
					edit:false,
					calendar:this, 
					cSave:function(payload) { self.addDone(payload) ; }, 
					cClose:function() { self.cancelAdd(); },
					cUpdate:function(_appt, dialog) { self.updateAppointment(_appt, dialog); },
					cDelete:function(_appt) { self.deleteAppointment(_appt); }
				}
				);
	
	this.addDialog.initData(appt);
	this.addDialog.show(info.pageX, info.pageY);
	
	this.currentAppointment = appt;	
	this.hoverAppointment = null;
	this.addAppointment(appt);
};

sms.calendar.prototype.edit = function(info)
{
	var self = this;
	//preserve the original appt
	info.appt = info.appt.clone();
	
	this.editDialog = this.editDialog || new sms.appointmentDialog(
			{
				edit:true,
				calendar:this,
				cSave:function(payload) { self.editDone(payload); },
				cClose:function() { self.editClose(); },
				cUpdate:function(appt, dialog) { self.updateAppointment(appt, dialog); },
				cDelete:function(appt) { self.deleteAppointment(appt); },
				cCheckout:function(appt) { self.checkoutAppointment(appt); }
			});
	
	this.editDialog.initData(info.appt);
	this.editDialog.show(info.pageX, info.pageY);
	this.currentAppointment = info.appt;	
};

sms.calendar.prototype.checkoutAppointment = function(appt)
{
	location.href = this.checkoutLink.replace(/ID/, appt.appointment_id);
};

sms.calendar.prototype.deleteAppointment = function(appt)
{
	var url = this.deleteAppointmentLink.replace('ID', appt.appointment_id);
	
	var self = this;
	var pos = $('#calChangeDate').offset();
	pos.left = Number(pos.left) + 180;
	sms.loading.show(pos);
	$.get(url, function(payload)
				{
					if (payload.success)
					{	
						self.removeAppointment(appt);
						self.currentAppointment = null;
					}
					
					sms.loading.hide();
				},
				'json');
};

sms.calendar.prototype.addDone = function(payload)
{	
	if (payload.success == 1)
	{
		this.removeAppointment(this.currentAppointment);
		this.currentAppointment = null;
		this.addAppointment(new sms.appointment(payload.appointment));
	}
};

sms.calendar.prototype.editDone = function(payload)
{
	if (payload.success == 1)
	{
		this.removeAppointment(this.currentAppointment);
		this.currentAppointment = null;
		this.addAppointment(new sms.appointment(payload.appointment));
	}
};

sms.calendar.prototype.editClose = function()
{	
	try {
		var a = this.findAppointment(this.currentAppointment.htmlId);
		this.drawAppointment(a);
		this.currentAppointment = null;
	}
	catch(e)
	{
		sms.debug.log(e);
	}
};

sms.calendar.prototype.updateAppointment = function(appt, dialog)
{	
	this.currentAppointment.update(appt);
	
	for(var id in this.appointments)
	{
		if (appt.htmlId != id)
		{
			if (appt.appointment_client_name == this.appointments[id].appointment_client_name)
			{
				if (!appt.appointment_client_phone || appt.appointment_client_phone.length == 0)
				{
					appt.appointment_client_phone = this.appointments[id].appointment_client_phone;
					appt.appointment_client_phone_type = this.appointments[id].appointment_client_phone_type;
					dialog.initData(appt);
					break;
				}					
			}
		}
	}
	
	this.drawAppointment(this.currentAppointment);
};

/**
 * Implement the "save changes" warning here.
 */
sms.calendar.prototype.changesWarning = function()
{
	return true;
};

sms.calendar.prototype.gotoDay = function(date)
{	
	if (date == 1 || date == -1)
	{
		var d = new Date(this.currentDate);
		d.setUTCDate(d.getUTCDate() + Number(date));
		date = (d.getUTCMonth() + 1) + '/' + d.getUTCDate() + '/' + d.getUTCFullYear();
	}

	var url = this.getAppointmentsLink.replace('DATE', date);
	//location.href = url;
	
	var self = this;
	var pos = $('#calChangeDate').offset();
	pos.left = Number(pos.left) + 180;
	sms.loading.show(pos);
	$.get(url, function(payload)
				{
					if (payload.success)
					{	
						self.flush();
						self.currentDate = new Date(Date.parse(payload.currentDate));
						$('#currentDate').html(payload.currentDateStr);
						
						for(var index in payload.appointments)
						{
							self.addAppointment(new sms.appointment(payload.appointments[index]));
						}
					}
					
					sms.loading.hide();
				},
				'json');
};

sms.calendar.prototype.closeAdd = function()
{	
};

sms.calendar.prototype.cancelAdd = function()
{	
	this.removeAppointment(this.currentAppointment);
};

sms.calendar.prototype.showDatePicker = function(evt)
{	
	sms.lightbox.show(function() { $('#smallCalendar').hide(); });
	$('#smallCalendar').css({ top:evt.pageY,left:evt.pageX}).show();
};

sms.calendar.prototype.getHoursDifference = function(start, end)
{
	var hmstart = start.split(':'); 
	var hmend = end.split(':');
	
	//proper order?
	if ((hmstart[0] * 2) + (hmstart[1] / 30) > (hmend[0] * 2) + (hmend[1] / 30))
	{
		throw new Error('Incorrect dates.'); 
	}
			
	return ((hmend[0] * 2) + (hmend[1] / 30) - ((hmstart[0] * 2) + (hmstart[1] / 30))) / 2;
};

sms.calendar.prototype.updateTimePart = function(date, setTime)
{
	var res = [];
	if ((res = setTime.match(/\s*([0-9]+)\:([0-9]+)\s*((am|pm|))\s*/i)))
	{
		var hours = res[1];
		if (res[3] == 'pm')
		{
			hours+=12;
		}
		
		date.setUTCHours(hours, res[2]);
		
		return date;
	}
	else
	{
		throw new Error('Incorrect time. Please use format like 9:12 am');
	}
};
	
sms.calendar.prototype.makeHoverDiv = function()
{
	var div = $('#app-hover');		
	return div;
};

sms.calendar.prototype.fillInfoBox = function(appt)
{
	$('#ah-name').html(appt.appointment_client_name);
	$('#ah-time-start').html(this.formatTime(appt.startDate));
	$('#ah-time-end').html(this.formatTime(appt.endDate));
	$('#ah-service').html(this.services[appt.appointment_service_id]);
	$('#ah-stylist').html(this.stylists[appt.appointment_stylist_uid]);
};

sms.calendar.prototype.aMouseover = function(evt, id)
{	
	var appt = this.findAppointment(id);	
	this.makeHoverDiv().css({top:evt.pageY + 10, left:evt.pageX}).show();
	
	if (this.hoverAppointment && this.hoverAppointment.appointment_id == appt.appointment_id)
	{
		return;
	}

	this.fillInfoBox(appt);
	
	this.hoverAppointment = appt;
};

sms.calendar.prototype.aMouseout = function(evt)
{
	this.makeHoverDiv().hide();
	this.hoverAppointment = null;
};

sms.calendar.prototype.formatDate = function(date, showTime)
{
	var str = (date.getUTCMonth()+1) + '/' + date.getUTCDate() + '/' + date.getUTCFullYear();
	
	if (showTime)
	{
		str += ' ' + this.formatTime(date);
	}
	
	return str;
};

sms.calendar.prototype.formatTime = function(date)
{
	var str = '';
	
	if (date.getUTCHours() > 12)
	{
		str += date.getUTCHours() - 12;
	}
	else
	{
		str += date.getUTCHours();
	}
	
	str += ':';
			
	if (date.getUTCMinutes() < 10)
	{
		str += '0' + date.getUTCMinutes();
	}
	else
	{
		str += date.getUTCMinutes();
	}
	
	return str + ' ' + (date.getUTCHours() >= 12 ? 'pm' : 'am');
};

sms.calendar.prototype.parseCellInfo = function(cell_id)
{
	var info = {};
	
	if (cell_id.match(/hour_([0-9]+)_([0-9]+)_s([0-9]+)/))
	{
		info.hour = RegExp.$1;
		info.minute = RegExp.$2;
		info.stylist_uid = RegExp.$3;
		info.service_id = null;
		
		return info;
	}
	else
	{
		throw new Exception('Error: cell id not initialized, passed: ' + cell_id);
	}	
};

sms.calendar.prototype.createDates = function(hour, minute, length_min)
{	
	hour = Number(hour);
	minute = Number(minute);
	length_min = Number(length_min);
	
	var d1 = new Date(this.currentDate.getTime());
	d1.setUTCHours(hour, minute, 0, 0);
	
	var d2 = new Date(this.currentDate.getTime());
	d2.setUTCHours(hour, minute + length_min, 0, 0);
	
	return { startDate: d1, endDate: d2 };
};

sms.calendar.prototype.newAppointmentClick = function(evt, cell)
{
	var info = this.parseCellInfo(cell.id);
	var dates = this.createDates(info.hour, info.minute, this.newAppointmentDefaultLength);
	
	info.startDate = dates.startDate;
	info.endDate = dates.endDate;
	
	info.pageX = evt.pageX;
	info.pageY = evt.pageY;
	
	this.add(info);
};

sms.calendar.prototype.editAppointmentClick = function(evt, div)
{
	var appt = this.findAppointment(div.id);

		//hack to prevent after-dragging click
		if (appt.dragged)
		{
			appt.dragged = false;
			return;
		}
	
	this.edit({appt:appt, pageX:evt.pageX, pageY:evt.pageY});
};

sms.calendar.prototype.initCells = function()
{
	var self = this;
	$('.hourcell').css({'cursor':'pointer'}).click(function(evt) { self.newAppointmentClick(evt, this); });
};
