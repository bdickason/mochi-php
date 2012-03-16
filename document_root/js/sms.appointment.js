//appointment data object
sms.appointment = function(initData)
{	
	for(var key in initData)
	{
		if (typeof initData[key] != 'function')
		{
			this[key] = initData[key];
		}
	}
	
	this.updateLocal();
};

//creates a copy of itself only passing literals (no functions and objects)
//this is later used when sending to the server
sms.appointment.prototype.getServerObject = function()
{
	var obj = {};

	for (var key in this)
	{
		if (typeof this[key] != 'function' && typeof this[key] != 'object')
		{
			obj[key] = this[key];
		}
	}

	obj['appointment_start_date'] = this.formatDateForServer(this.startDate);
	obj['appointment_end_date'] = this.formatDateForServer(this.endDate);

	return obj;
};

sms.appointment.prototype.formatDateForServer = function(date)
{
	var dd = function(num)
	{
		if (num < 10)
		{
			return '0' + num;
		}
		else
		{
			return num;
		}
	}

	var d = date.getUTCFullYear() + '-' + dd(date.getUTCMonth()+1) + '-' + dd(date.getUTCDate());
	d += ' ' + dd(date.getUTCHours()) + ':' + dd(date.getUTCMinutes());

	return d;
};

sms.appointment.prototype.clone = function()
{
	return new sms.appointment(this);	
};

sms.appointment.prototype.updateLocal = function()
{		
	this.htmlId = 'ai-' + this.appointment_id;
	this.startDate = new Date(Date.parse(this.appointment_start_date));
	this.endDate = new Date(Date.parse(this.appointment_end_date));
};

sms.appointment.prototype.parseTime = function(timeString)
{
	var res = null;
	if (res = timeString.match(/\s*([0-9]+)\:([0-9]+)\s*((am|pm|))\s*/i))
	{	
		var hours = Number(res[1]);
		if (res[3] == 'pm' && hours < 12)
		{
			hours += Number(12);
		}
		
		if (res[3] == 'am' && hours == 12)
		{
			hours = 0;
		}
		
		var minutes = Number(res[2]);
		
		return {hours: hours, minutes: minutes};
	}
	else
	{
		throw new Error('Incorrect time. Please use format like 9:12 am');
	}
}

sms.appointment.prototype.updateTime = function(startTime, endTime)
{	
	var time_start = this.parseTime(startTime);
	var time_end = this.parseTime(endTime);
	
	if (((time_start.hours*60) + Number(time_start.minutes)) > ((time_end.hours*60) + Number(time_end.minutes)))		
	{
		throw new Error('Start time must be less than end time');
	}
	
	this.startDate.setUTCHours(time_start.hours, time_start.minutes);
	this.appointment_start_date = this.startDate.toString();
	
	this.endDate.setUTCHours(time_end.hours, time_end.minutes);
	this.appointment_end_date = this.endDate.toString();
}

sms.appointment.prototype.timeDifferent = function(hours, minutes)
{
	return (hours != this.startDate.getUTCHours() || minutes != this.startDate.getUTCMinutes());
};

sms.appointment.prototype.moveToTime = function(startTime)
{
    //getTime is milliseconds
    //convert to minutes
    var length_mins = (this.endDate.getTime() - this.startDate.getTime()) / 60000;
    var time_start = this.parseTime(startTime);

    //set the start date
    this.startDate.setUTCHours(time_start.hours, time_start.minutes);
    this.appointment_start_date = this.startDate.toString();

    //same for end date, just add the difference
    this.endDate.setUTCHours(time_start.hours, time_start.minutes + length_mins);
    this.appointment_end_date = this.endDate.toString();
};

sms.appointment.prototype.update = function(appt)
{
	for(var key in appt)
	{
		if (typeof appt[key] != 'function')
		{
			this[key] = appt[key];
		}
	}
}