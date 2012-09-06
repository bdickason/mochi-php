sms.qs = function(options)
{
	this.map = [];
	this.mapIndex = {};
	this.index = null;
	this.url = options.url;
	this.target = options.target;
	this.resultShowCallback = options.resultCallback;
	this.followCallback = options.followCallback;
	this.minLength = options.minLength || 3;
	this.hoveroutTime = 7; // Seconds to wait before hiding the hover thing

	this.snippetsFilled = [];
	this.hideTimer = null;
};

sms.qs.prototype.enter = function(index) {
	if (index == null)
	{
		return;
	}
	$('#res-' + this.map[index].eid + ' a').addClass('selected');
};

sms.qs.prototype.leave = function(index) {
	if (index == null)
	{
		return;
	}
	$('#res-' + this.map[index].eid + ' a').removeClass('selected');
};

sms.qs.prototype.up = function() {
	this.leave(this.index);
	this.index = (this.index == null) ? this.count : this.index - 1;
	if (this.index < 0) { this.index = null; }
	this.enter(this.index);
};


sms.qs.prototype.down = function() {
	this.leave(this.index);
	this.index = (this.index == null) ? 0 : this.index + 1;
	if (this.index > this.count) { this.index = null; }
	this.enter(this.index);
};

sms.qs.prototype.buildMapIndex = function() {
	this.mapIndex = {};

	for (var index in this.map)
	{
		this.mapIndex[this.map[index].eid] = this.map[index];
	}
};


sms.qs.prototype.search = function(value) {
	
	this.value = value;

	if (!value.match(/^[#0-9]/) && value.length < this.minLength)
	{
		this.hide();
		return;
	}

	self = this;
	
	$.getJSON(this.url, {'text': value}, function(payload) {
				var html = "";

				self.target.show();
				self.count = payload.count;

				self.map = payload.map;

				if (payload.showall)
				{
					self.map[self.count] = { eid : 'all' };
					self.count++;
				}
				
				self.map[self.count] = { eid : 'add' };

				self.buildMapIndex();

				for(var i in payload.snippets)
				{
					self.snippetsFilled.push(i);
					$('.' + i, self.target).html(payload.snippets[i]);
				}

				self.index = null;

				//assign click handlers to all the elements
				var index;
				if (self.followCallback)
				{
					for(var eid in self.mapIndex)
					{
						//self = reference to dialog
						//this = reference to the A element in the event
						$('#res-' + eid + ' a').click(
							function(event) { return self.qsResultsFollowClick(this, event); }
						);
					}
				}

				if (self.resultShowCallback)
				{
					self.resultShowCallback(payload);
				}
				
				// Bind to the target to do hiding stuff
				self.target.mouseleave(function(e){
					if(!self.hideTimer)
					{
						self.hideTimer = setTimeout("self.target.hide(); self.hideTimer = null;", (self.hoveroutTime * 1000));
					}
				}).mouseenter(function(e){
					// Only clear if we have a timer active
					if(self.hideTimer != null)
					{
						clearTimeout(self.hideTimer);
						self.hideTimer = null;
					}
				});
	});
};

sms.qs.prototype.qsResultsFollowClick = function(elm, event)
{
	var res = null;
	//extract
	if (res = $(elm).parents('.resultItem').attr('id').match(/res\-(.*)/))
	{
		var eid = res[1];
		if (eid == 'add')
		{
			//add username to add item			
			this.mapIndex[eid].title = this.value;
		}
		
		this.followCallback(eid, this.mapIndex[eid]);
	}

	return false;
};

sms.qs.prototype.hide = function()
{
	var index;
	for(index in this.snippetsFilled)
	{
		$('.' + this.snippetsFilled[index], this.target).html();
	}

	this.snippetsFilled = [];
	this.value = '';

	this.target.hide();
};

sms.qs.prototype.follow = function()
{
	if (this.followCallback)
	{
		this.followCallback(this.map[this.index].eid, this.mapIndex[this.map[this.index].eid]);
	}
	else
	{
		location.href = $('#res-' + this.map[this.index].eid + ' a').attr('href');
	}
};

sms.qs.prototype.keydown = function(event)
{
	switch(event.keyCode) {
		case KEY.RETURN:
			if (this.index == null)
			{
				return;
			}
			event.preventDefault();
			this.follow();

			break;
		case KEY.DOWN:
		case KEY.UP:
			event.preventDefault();
			break;
	}
};

sms.qs.prototype.keyup = function(event)
{
	switch(event.keyCode) {
		case KEY.ESC:
			event.preventDefault();			
			this.hide();
			return;
			break;
		case KEY.DOWN:
			event.preventDefault();
			this.down();
			return;
			break;
		case KEY.UP:
			event.preventDefault();
			this.up();
			return;
			break;
		case KEY.RETURN:
			if (this.index != null)
			{
				event.preventDefault();
			}
			return;
			break;
	}

	this.search(event.target.value);
};