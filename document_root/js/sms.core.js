if (typeof sms == 'undefined')
{
	var sms = {};
}

var KEY = {
		UP: 38,
		DOWN: 40,
		DEL: 46,
		TAB: 9,
		RETURN: 13,
		ESC: 27,
		COMMA: 188,
		PAGEUP: 33,
		PAGEDOWN: 34,
		BACKSPACE: 8
	};

sms.debug = {
		log: function(data)
		{
			try { console.log(data); } catch(e) { }
		}
};

sms.ef = {
		
	};

sms.loading = {
	
	show:function(pos)
	{	
		$('#loading').css({top:pos.top, left:pos.left}).show();
	},
	
	hide:function(element)
	{
		$('#loading').hide();
	}
	
}

sms.lightbox = {
	box:null,
		
	getbox : function()
	{
		if (sms.lightbox.box == null)
		{
			sms.lightbox.box = $('<div/>').css({
										display:'none', 
										position:'absolute',
										top:0, 
										left:0,
										width:'100%',
										height:$(document).height(),
										backgroundColor:'#000',
										opacity:0.5,
										zIndex:200,
										filter:"alpha(opacity = 50);"}
								);
			
			$('body').append(sms.lightbox.box);
		}
		
		return sms.lightbox.box;
	},
	
	show : function(callback)
	{
		var box = sms.lightbox.getbox();
		box.unbind().click(function() { sms.lightbox.hide(); if (callback) { callback(); } } );
		box.show();
	},
	
	hide: function()
	{
		var box = sms.lightbox.getbox();
		box.hide();
	}
};

sms.seamless = {
	focused:null,
		
	init : function()
	{
		$('.form input:text')
			.bind('focus', sms.seamless.focus)
			.bind('blur', sms.seamless.blur)
			.bind('mouseover', sms.seamless.mouseover)
			.bind('mouseout', sms.seamless.mouseout);
		$('.form textarea')
		.bind('focus', sms.seamless.focus)
		.bind('blur', sms.seamless.blur)
		.bind('mouseover', sms.seamless.mouseover)
		.bind('mouseout', sms.seamless.mouseout);
	},
	
	mouseover : function(e)
	{
		$(this).css({border:'1px #CCC solid'});
	},
	
	mouseout : function(e)
	{
		if (sms.seamless.focused != this)
		{
			$(this).css({border:'1px transparent solid'});
		}		
	},
	
	focus : function(e)
	{	
		e.target.select();		
		//$(e.target).animate({borderTopColor:'#CCCCCC',borderBottomColor:'#CCCCCC',borderLeftColor:'#CCCCCC',borderRightColor:'#CCCCCC'}, 1000);
		$(this).css({border:'1px #CCC solid'});
		sms.seamless.focused = this;
	},
	
	blur : function(e)
	{	
		$(this).css({border:'1px transparent solid'});
		if (sms.seamless.focused == this)
		{
			sms.seamless.focused = null;
		}
		//$(e.target).animate({borderTopColor:'#FFFFFF',borderBottomColor:'#FFFFFF',borderLeftColor:'#FFFFFF',borderRightColor:'#FFFFFF'}, 500);
	}
};

sms.form = {
	field_defaults: {},
	
	submit: function(formname, selector){
		var validator = 'validate' + formname;
		var passed = true;
		
		try {
			eval('passed = ' + validator + '();');
		} 
		catch (e) {
		}
		
		if (passed) {
			$(selector).submit();
		}
	},
	
	user_form_submit: function(formname, selector)
	{
		var values = {};
		
		$(selector + ' input:text').each(
			function()
			{
				values[this.name] = this.value;
			});
			
		if (values['name'] == sms.form.field_defaults['name'])
		{
			alert('Please enter a proper name.');
			return false;
		}		
			
		if (
			(values['phone_primary_number'] == '' || values['phone_primary_number'] == sms.form.field_defaults['phone_primary_number'])
			&& 
			(values['email'] == '' || values['email'] == sms.form.field_defaults['email'])
			)
		{
			alert('Please enter a phone number or an email address.');
			return false;
		}
		
		$(selector + ' input:text').each(
			function()
			{
				if (sms.form.field_defaults[this.name] && this.value == sms.form.field_defaults[this.name])
				{
					this.value = '';
				}
				
				values[this.name] = this.value;
			});		

		sms.form.submit(formname, selector);		
	}	
};

sms.form.validation = {
	fixPhoneNumber : function(e)
	{
		var element = this;
	
		var pn = element.value.replace(/[\s\-\(\)\/_]+/g, '');
				
		if(pn.length == 10)
		{
			pn = pn.substr(0, 3) + '-' + pn.substr(3,3) + '-' + pn.substr(6,4);
			element.value = pn;
			return true;
		}
		
		return false;
	},
	
	expandTextArea : function(e)
	{
		var matches = this.value.match(/[\n\r]/g);
		
		if (matches)
		{
			var height = ((matches.length+1) * 20);
			
			if (height > 60)
			{
				height = 60;
			}
			
			this.style.height = height + 'px';
		}
	}
}




sms.quicksearch = {
		map : [],
		index:null,
		url:null,
		target:'qs-results',
		enter : function(index) {
			if (index == null)
			{
				return;
			}
			$('#res-' + this.map[index].eid + ' a').addClass('selected');
		},
		leave : function(index) {
			if (index == null)
			{
				return;
			}
			$('#res-' + this.map[index].eid + ' a').removeClass('selected');
		},
		up : function() {
			this.leave(this.index);
			this.index = (this.index == null) ? this.count : this.index - 1;			
			if (this.index < 0) { this.index = null; }
			this.enter(this.index);
		},
		down : function() {
			this.leave(this.index);
			this.index = (this.index == null) ? 0 : this.index + 1;
			if (this.index > this.count) { this.index = null; }
			this.enter(this.index);
		},
		search : function(value) {
			if (!value.match(/^[#0-9]/) && value.length < 3)
			{
				//$('.resultBox').html('').hide();
				return;
			}
			
		    $.getJSON(sms.quicksearch.url, {'text': value}, function(payload) {
						var html = "";
		
						$('.' + sms.quicksearch.target).show();
						sms.quicksearch.count = payload.count + 1;
		
						sms.quicksearch.map = payload.map;
						sms.quicksearch.map[sms.quicksearch.count - 1] = { eid : 'all' };
						sms.quicksearch.map[sms.quicksearch.count] = { eid : 'add' };
		
						for(var i in payload.snippets)
						{
		                	$('#' + i).html(payload.snippets[i]);
						}
		
						sms.quicksearch.index = null;				
			});
		},
		follow : function()
		{
			location.href = $('#res-' + this.map[this.index].eid + ' a').attr('href');
		},
		keydown : function(event)
		{
			sms.quicksearch.url = event.data.url;
			
			switch(event.keyCode) {
				case KEY.RETURN:					
					if (sms.quicksearch.index == null)
					{
						return;	
					}
					event.preventDefault();
					sms.quicksearch.follow();
					
					break;
				case KEY.DOWN:
				case KEY.UP:
					event.preventDefault();
					break;
			}
		},
		keyup : function(event)
		{	
			sms.quicksearch.url = event.data.url;
			
			switch(event.keyCode) {
				case KEY.ESC:
					event.preventDefault();
					this.value = '';
					$('.' + sms.quicksearch.target).hide();
					break;
				case KEY.DOWN:
					event.preventDefault();
					sms.quicksearch.down();
					return;			
					break;
				case KEY.UP:
					event.preventDefault();
					sms.quicksearch.up();
					return;
				case KEY.RETURN:
					if (index != null)
					{
						event.preventDefault();
					}
					return;
					break;
			}
			
			if (sms.quicksearch.url.match(/checkout/))
			{
				sms.quicksearch.target = 'qs-results-checkout';
			}
			else
			{
				sms.quicksearch.target = 'qs-results';
			}	
			
			sms.quicksearch.search(this.value);
		}
};

sms.checkout = {
	show_checkout_step_1 : function()
	{
		$('#find-user').show().css({height:$(document).height() - 95});
	},

	hide_checkout_step_1 : function()
	{
		$('#find-user').hide();
	}
};

sms.order = {
		service_map : [],
		product_map : [],
		tax_ratio_services : 0,
		tax_ratio_products : 0,				
		transURL:null,
    	addService : function(index)
    	{
			var target = index + 1;
    	
    		if($('#service-cont-' + target).length > 0)
    		{
    			$('#add-service-' + index).hide();
    			$('#add-service-' + target).show();
    			$('#service-cont-' + target).show();
    		}
    		
    		$('.services .deleteBtnFloatNA').addClass('deleteBtnFloat').removeClass('deleteBtnFloatNA');
    	},
    	
    	removeService : function(index)
    	{
    		//we need to shift all services from the one beyond removed until last visible
    		for(i = index;$('#service-cont-' + (i + 1) + ':visible').length > 0 && $('#service-cont-' + (i + 1)).length > 0;i++)
    		{    		
    			//copy from next to this one
    			$('#' + formPrefix + 'service' + i).val($('#' + formPrefix + 'service' + (i + 1)).val());
    			$('#' + formPrefix + 'stylist' + i).val($('#' + formPrefix + 'stylist' + (i + 1)).val());
    			$('#' + formPrefix + 'sprice' + i).val($('#' + formPrefix + 'sprice' + (i + 1)).val());
    			$('#' + formPrefix + 'staxable' + i).val($('#' + formPrefix + 'staxable' + (i + 1)).val());
    		}
    		
    		if (i > 1)
    		{
    			$('#add-service-' + (i - 1)).show();
    			$('#service-cont-' + i).hide(); 
    		}
    		else
    		{
    			$('#rem-service-' + i).addClass('deleteBtnFloatNA').removeClass('deleteBtnFloat');
    		}
    		
    		$('#' + formPrefix + 'service' + i).val('');
    		$('#' + formPrefix + 'sprice' + i).val('0.00');
    		$('#' + formPrefix + 'stylist' + i).val('');
    		$('#' + formPrefix + 'staxable' + i).val(1);
    		
    		sms.order.recalculate();    		
    	},
    	
    	addProduct : function(index)
    	{
    		var target = index + 1;
        	
    		if($('#product-cont-' + target).length > 0)
    		{
    			$('#add-product-' + index).hide();
    			$('#add-product-' + target).show();
    			$('#product-cont-' + target).show();
    		}
    		
    		$('.products .deleteBtnFloatNA').addClass('deleteBtnFloat').removeClass('deleteBtnFloatNA');
    	},
    	
    	removeProduct : function(index)
    	{
    		//we need to shift all services from the one beyond removed until last visible
    		for(i = index;$('#product-cont-' + (i + 1) + ':visible').length > 0 && $('#product-cont-' + (i + 1)).length > 0;i++)
    		{    		
    			//copy from next to this one
    			$('#' + formPrefix + 'product' + i).val($('#' + formPrefix + 'product' + (i + 1)).val());
    			$('#' + formPrefix + 'user' + i).val($('#' + formPrefix + 'user' + (i + 1)).val());
    			$('#' + formPrefix + 'pprice' + i).val($('#' + formPrefix + 'pprice' + (i + 1)).val());
    			$('#' + formPrefix + 'pqty' + i).val($('#' + formPrefix + 'pqty' + (i + 1)).val());
    			$('#' + formPrefix + 'ptaxable' + i).val($('#' + formPrefix + 'ptaxable' + (i + 1)).val());
    		}
    		
    		//dont hide first row
    		if (i > 1)
    		{
    			$('#add-product-' + (i - 1)).show();
    			$('#product-cont-' + i).hide(); 
    		}
    		else
    		{
    			$('#rem-product-' + i).addClass('deleteBtnFloatNA').removeClass('deleteBtnFloat');
    		}
    		
    		$('#' + formPrefix + 'product' + i).val('');
    		$('#' + formPrefix + 'pprice' + i).val('0.00');
    		$('#' + formPrefix + 'user' + i).val('');
    		$('#' + formPrefix + 'pqty' + i).val(1);
    		$('#' + formPrefix + 'ptaxable' + i).val(1);
    		
    		sms.order.recalculate();
    	},

    	setServicePrice : function(event)
    	{
    		if (!this.id.match(/[a-z\-]+([0-9]+)$/i))
    		{
    			return;
    		}
    		
    		var id = RegExp.$1;
    		
    		//get indexes into the map
    		var i1 = $('#' + formPrefix + 'service' + id).val();
    		var i2 = $('#' + formPrefix + 'stylist' + id).val();
    		
    		var price = sms.order.getServicePrice(i1, i2);
    		
    		$('#' + formPrefix + 'sprice' + id).val(sms.order.round(price));
    		
    		// Set the item's taxable state
    		$('#' + formPrefix + 'staxable' + id).val(sms.order.getServiceIsTaxable(i1));
    		
    		sms.order.recalculate();
    	},
    	
    	setProductPrice : function(event)
    	{
    		if (!this.id.match(/[a-z\-]+([0-9]+)$/i))
        	{
            	return;
        	}

        	var id = RegExp.$1;

        	//get indexes into the map
        	var i1 = $('#' + formPrefix + 'product' + id).val();
        	var i2 = $('#' + formPrefix + 'pqty' + id).val();

        	var price = sms.order.getProductPrice(i1) * i2;
        	
        	$('#' + formPrefix + 'pprice' + id).val(sms.order.round(price));
        	
        	// Set the item's taxable state
        	$('#' + formPrefix + 'ptaxable' + id).val(sms.order.getProductIsTaxable(i1));

        	sms.order.recalculate();
    	},
    	
    	round : function(value)
    	{
    		var rounded = String(Math.round(value * 100) / 100);
    		var parts = rounded.split('.');
    		
    		if (parts[1])
    		{
    			return parts[0] + '.' + (parts[1] + '00').substr(0,2);
    		}
    		else
    		{
    			return parts[0] + '.00';
    		}
    	},
		
		get_tax : function(tax_ratio, value)
		{
			return Number(value) * (tax_ratio / 100);
		},

    	recalculate : function()
    	{
    		var taxes = 0,
    			services_sum = 0,
            	products_sum = 0;
    		
    		
    		// Loop thru all of the services and determine the taxable amount
    		$('.services .pricetag input:visible').each(function() {
    			
    				// Get the price for the service line item
    				var price = Number(this.value);
    			
    				// We always add to the sub_total
    				services_sum += price;
    				
    				// We have to collect tax on this service
    				if($(this).next(':input').val() != 0)
    				{
    					taxes += sms.order.get_tax(sms.order.tax_ratio_services, price);
    				}
    			});
    		
    		// Loop thru all of the products and determine the taxable amount
    		$('.products .pricetag input:visible').each(function() {
    			
	    			// Get the price for the product line item
					var price = Number(this.value);
				
					// We always add to the sub_total
					products_sum += price;
					
    				// We have to collect tax on this product
    				if($(this).next(':input').val() != 0)
    				{
    					taxes += sms.order.get_tax(sms.order.tax_ratio_products, price);
    				}
    			});
    		
    		$('#services_sum').html('$' + this.round(services_sum));
        	$('#products_sum').html('$' + this.round(products_sum));
    		
    		//console.log(tax_total);
    		
    		// Update the sub-total
    		$('#subtotal').html('$' + this.round(services_sum + products_sum));
    		
    		// Update the total taxes
    		$('#taxes').html('$' + this.round(taxes));
    		
    		// Update the grand total
    		$('#grand_total').html('$' + this.round(taxes + services_sum + products_sum));
    	},

    	getServicePrice: function(service_id, stylist_id)
    	{    		
        	if (this.service_map[service_id + '_' + stylist_id])
        	{
            	return this.service_map[service_id + '_' + stylist_id]['price'];
        	}
        	else
        	{
            	return 0;
        	}
    	},
    	
    	getServiceIsTaxable: function(service_id, stylist_id)
    	{    		
        	if (this.service_map[service_id + '_' + stylist_id])
        	{
        		console.log(this.service_map[service_id + '_' + stylist_id]);
            	return this.service_map[service_id + '_' + stylist_id]['taxable'];
        	}
        	else
        	{
            	return 1;
        	}
    	},
    	
    	getProductPrice: function(product_id)
    	{
    		if (this.product_map[product_id])
    		{
    			return this.product_map[product_id]['price'];
    		}
    		else
    		{
    			return 0;
    		}
    	},
    	
    	getProductIsTaxable: function(product_id)
    	{
    		if (this.product_map[product_id])
    		{
    			return this.product_map[product_id]['taxable'];
    		}
    		else
    		{
    			return 1;
    		}
    	},

    	init : function()
    	{
        	$('.service select').bind('change', sms.order.setServicePrice);
        	$('.stylist select').bind('change', sms.order.setServicePrice);
        	
        	$('.product select').bind('change', sms.order.setProductPrice);
        	$('.quantity select').bind('change', sms.order.setProductPrice);

        	$('.pricetag input').bind('keyup', function() { sms.order.recalculate() });
        	$('.pricetag input').bind('change', function() { this.value = sms.order.round(this.value); });
        	
        	$(function() { sms.order.recalculate(); });
    	},
    	
    	validateProduct : function(elm)
    	{
    		if ($(elm).val() == 'none')
    		{
    			return true;
    		}
    		
    		if (!$(elm).attr('id').match(/[a-z\-]+([0-9]+)$/i))
        	{
            	return true;
        	}

        	var id = RegExp.$1;
        	
        	if ($('#' + formPrefix + 'user' + id).val() == 'none')
        	{
        		alert('Please select a person who sold the product ' + $('#' + elm.id + ' :selected').text());
        		return false;
        	}
        	
        	return true;
    	},
    	
    	validateService : function(elm)
    	{	
    		if ($(elm).val() == 'none')
    		{
    			return true;
    		}
    		    		
    		if (!elm.id.match(/[a-z\-]+([0-9]+)$/i))
        	{
            	return true;
        	}
    		
        	var id = RegExp.$1;
        
        	if ($('#' + formPrefix + 'stylist' + id).val() == 'none')
        	{
        		alert('Please select a stylist for the service ' + $('#' + elm.id + ' :selected').text());
        		return false;
        	}
        	
        	return true;
    	},
    	
    	submit : function()
    	{
    		var error = false;
    		var service_count = 0;
    		var product_count = 0;
    		
    		$('.service select:visible').each(function()
			{ 
    			if ($(this).val() != 'none')
    			{
    				service_count++;
    			}
    			else
    			{
    				return true;
    			}
    			
    			if (!sms.order.validateService(this))
    			{
    				error = true;
    				return false;
    			}
			});
    		
    		if (error)
    		{
    			return;
    		}
    		
        	$('.product select:visible').each(function()
			{        		
        		if ($(this).val() != 'none')
    			{
        			product_count++;
    			}
        		else
        		{
        			return true;
        		}
    			
    			if (!sms.order.validateProduct(this))
    			{
    				error = true;
    				return false;
    			}
			});
        	
        	if (error)
        	{
        		return false;
        	}
        	
        	if (service_count == 0 && product_count == 0)
        	{
        		alert('Please select at least one service or product.');
        		return false;
        	}
        	
        	$('.transactionForm form').submit();
    	},
    	
    	voidTrans:function(tid)
    	{
    		$.getJSON(sms.order.transURL, {'transaction_id': tid}, function(payload) {
					if (payload.error && payload.error.length > 0)
					{
						alert(payload.error);
						return;
					}
					
					if (payload.voided)
					{
						$('#trans-' + tid + ' span').addClass('void');
						$('#trans-' + tid + ' .deleteBtn').removeClass('deleteBtn').addClass('deleteBtnVoid');
						
					}
					else
					{
						$('#trans-' + tid + ' span').removeClass('void');
						$('#trans-' + tid + ' .deleteBtnVoid').removeClass('deleteBtnVoid').addClass('deleteBtn');						
					}
    		});
    	},
    	
    	unvoidTrans:function(tid)
    	{
    	}
        	
    };

//setup the ajax form submit library
//first version inspired from:
//http://files.nettephp.com/109/jquery.ajaxform.js
jQuery.fn.extend({
ajaxSubmit: function (callback) {
	var form;
	var sendValues = {};

	// submit button
	if (this.is(":submit")) {
		form = this.parents("form");
		sendValues[this.attr("name")] = this.val() || "";

	// form
	} else if (this.is("form")) {
		form = this;

	// invalid element, do nothing
	} else {
		return null;
	}

	// validation
	if (form.get(0).onsubmit && !form.get(0).onsubmit()) return null;

	// get values
	var values = form.serializeArray();

	for (var i = 0; i < values.length; i++) {
		var name = values[i].name;

		// multi
		if (name in sendValues) {
			var val = sendValues[name];

			if (!(val instanceof Array)) {
				val = [val];
			}

			val.push(values[i].value);
			sendValues[name] = val;
		} else {
			sendValues[name] = values[i].value;
		}
	}

	// send ajax request
	var ajaxOptions = {
		url: form.attr("action"),
		data: sendValues,
		type: form.attr("method") || "get"
	};

	if (callback) {
		ajaxOptions.success = callback;
	}
	
	return jQuery.ajax(ajaxOptions);
}
});
