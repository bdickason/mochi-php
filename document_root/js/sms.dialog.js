/**
 * Add dialog javascript.
 * We assume sms namespace already exists.
 */

/**
 * Constructor.
 * 
 * @param info
 * 
 * info.save - save button callback
 * info.close - close button callback
 */
sms.appointmentDialog = function(options)
{
	this.saveCallback = options.cSave;
	this.closeCallback = options.cClose;
	this.updateCallback = options.cUpdate;
	this.deleteCallback = options.cDelete;
	this.checkoutCallback = options.cCheckout;
	
	this.calendar = options.calendar;

	var self = this;
	
	if (options.edit)
	{
		this.edit = true;
		this.dialogHtmlId = 'dialog-appointment-edit';
	}
	else
	{
		this.edit = false;
		this.dialogHtmlId = 'dialog-appointment-add';
	}

	this.qs = new sms.qs({
			resultCallback : function(payload) { self.quickSearchHandler(payload); },
			followCallback : function(eid, data) { self.quickSearchClickHandler(eid, data); },
			url : this.calendar.quckSearchLink,
			target : $('#' + this.dialogHtmlId + ' .qs-results'),
			minLength : 2
		});

	this.appt = {};
	
	this.dialog = $('#' + this.dialogHtmlId);
	
	this.iID = $('#' + this.dialogHtmlId + ' .fID input');
	this.iClientName = $('#' + this.dialogHtmlId + ' .fClientName input');
	this.iClientName.attr({'autocomplete':'off'})
	
	this.iDate = $('#' + this.dialogHtmlId + ' .fDate input');
	this.iUID = $('#' + this.dialogHtmlId + ' .fUID input');
	//this.iDateLabel = $('#' + this.dialogHtmlId + ' .fDate span');
	this.iStartTime = $('#' + this.dialogHtmlId + ' .fStartTime input');
	this.iEndTime = $('#' + this.dialogHtmlId + ' .fEndTime input');	
	this.iStylist = $('#' + this.dialogHtmlId + ' .fStylist select');
	this.iService = $('#' + this.dialogHtmlId + ' .fService select');
	this.iPhone = $('#' + this.dialogHtmlId + ' .fPhoneNumber input');
	this.iEmail = $('#' + this.dialogHtmlId + ' .fEmailAddress input');
	this.tError = $('#' + this.dialogHtmlId + ' .fError');	
	this.iForm = $('#' + this.dialogHtmlId + ' form');
	
	this.setupHandlers();
};

sms.appointmentDialog.prototype.initData = function(appt)
{
	this.appt = appt.clone();
	this.setData(this.appt);
};

sms.appointmentDialog.prototype.setupHandlers = function()
{
	var instance = this;
	
	this.iStylist.change(function() {instance.updateHandler({stylist_uid:$(this).val()});});
	
	var fTime = function() {instance.updateHandler({startTime:instance.iStartTime.val(), endTime:instance.iEndTime.val()});};	
	this.iStartTime.change(fTime);
	this.iEndTime.change(fTime);
	
	//this.iClientName.change(function(e) {instance.updateHandler( {clientName:instance.iClientName.val()});});

	this.iClientName.bind('keyup', function(event) { instance.qs.keyup(event); });
	this.iClientName.bind('keydown', function(event) { instance.qs.keydown(event); });
	
	this.iForm.submit(function(e) {e.stopPropagation();instance.saveHandler();return false;});
	$('#' + this.dialogHtmlId + ' form :submit').click(function(e) {e.stopPropagation();instance.saveHandler();return false;});
	$('#' + this.dialogHtmlId + ' .closeBtn').click( function (e) {e.stopPropagation();instance.closeHandler();return false;});	
	$('#' + this.dialogHtmlId + ' .fDelete').click( function(e) {e.stopPropagation();instance.deleteHandler();return false;});
    $('#' + this.dialogHtmlId + ' .fSave a').click( function(e) {e.stopPropagation();instance.saveHandler();return false;});
	$('#' + this.dialogHtmlId + ' .checkoutAppointmentLink').click( function(e) { e.stopPropagation(); instance.checkoutHandler(); });
};

sms.appointmentDialog.prototype.checkoutHandler = function()
{
	this.checkoutCallback(this.appt);
};

sms.appointmentDialog.prototype.quickSearchClickHandler = function(id, data)
{
	this.appt.appointment_client_name = data.title;

	//new user
	if (id != 'add')
	{
		this.appt.appointment_client_uid = data.eid;
		this.appt.appointment_client_phone = data.phone;
		this.appt.appointment_client_email = data.email;
	}
	else
	{
		this.appt.appointment_client_uid = null;
		this.appt.appointment_client_phone = '';
		this.appt.appointment_client_email = '';
	}

	this.setData(this.appt);
	this.qs.hide();
};

sms.appointmentDialog.prototype.quickSearchHandler = function(payload)
{
	$('#res-add a').html('Click to add "' + this.iClientName.val() + '" as a new client.');
};

sms.appointmentDialog.prototype.deleteHandler = function()
{
	if (!this.edit)
	{
		this.closeHandler();
		return;
	}
	
	if (confirm('Really delete appointment?'))
	{
		this.hide();
		this.deleteCallback(this.appt);
	}
}

sms.appointmentDialog.prototype.updateHandler = function(data)
{
	try {
		if (data.startTime && data.endTime)
		{
			this.appt.updateTime(data.startTime, data.endTime);		
		}
		
		if (data.stylist_uid)
		{
			this.appt.appointment_stylist_uid = data.stylist_uid;
		}
		
		if (data.clientName)
		{
			this.appt.appointment_client_name = data.clientName;
		}
	}
	catch(e)
	{
		this.tError.html(e.message);
		return;
	}
	
	//TODO: add service update
	this.updateCallback(this.appt, this);
};

sms.appointmentDialog.prototype.saveHandler = function()
{	
	//prevent multiple postings
	if (this.saving)
	{
		return;
	}	
	this.saving = true;
	
	var self = this;
	this.iForm.ajaxSubmit(function(payload) {self.saving=false;self.hide();self.saveCallback(payload);});	
	return false;
};

sms.appointmentDialog.prototype.closeHandler = function()
{
	this.hide();
	this.closeCallback();
	
	return false;
};

sms.appointmentDialog.prototype.validate = function()
{
	
};

sms.appointmentDialog.prototype.show = function(x, y)
{
	var self = this;
	sms.lightbox.show(function() {self.dialog.hide();self.closeCallback();});
	
	this.tError.html('');
	
	var left = ($(window).width()/2) - (this.dialog.width()/2);
	var top = (($(window).height()/2) - (this.dialog.height()/2)) + $(window).scrollTop();
	
	this.dialog.css({left:left, top:top}).show();
	this.iClientName.focus();
	this.iClientName.select();
	
	this.dialog.draggable();
};

sms.appointmentDialog.prototype.hide = function()
{
	this.qs.hide();
	sms.lightbox.hide();	
	this.dialog.hide();
};

sms.appointmentDialog.prototype.setData = function(appt)
{	
	if (!appt.appointment_client_name)
	{
		this.iClientName.val('Type a client name...');
	}
	else
	{
		this.iClientName.val(appt.appointment_client_name);
	}

	// Update the client link
	$('#client_link').attr('href', '/?id='+appt.appointment_client_uid+'&action=edit&presenter=Profile');
	
	this.iID.val(appt.appointment_id);
	this.iUID.val(appt.appointment_client_uid);
	this.iDate.val(this.calendar.formatDate(appt.startDate));
	//this.iDateLabel.html(this.calendar.formatDate(appt.startDate));
	this.iStartTime.val(this.calendar.formatTime(appt.startDate));
	this.iEndTime.val(this.calendar.formatTime(appt.endDate));	
	this.iStylist.val(appt.appointment_stylist_uid);
        
    if (appt.appointment_service_id) {this.iService.val(appt.appointment_service_id);}
	this.iPhone.val(appt.appointment_client_phone);
	this.iEmail.val(appt.appointment_client_email);
};