<?php //netteCache[01]000240a:2:{s:4:"time";s:21:"0.54110500 1276921396";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:85:"/home/insitu/public_html/salon/document_root/../app/templates/Calendar/calendar.phtml";i:2;i:1276921100;}}}?><?php
// file …/templates/Calendar/calendar.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'ebfa631072'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbba65694757f_content')) { function _cbba65694757f_content() { extract(func_get_arg(0))
;if (SnippetHelper::$outputAllowed) { ?>
<div id="smallCalendar"></div>

<div id="app-hover" style="top:0px; left:0px;">
<span id="ah-name">Peter Jackson</span><br/>
<span id="ah-service">Cut</span> with <span id="ah-stylist">Jeremy</span>
<br/>
<span id="ah-time-start">10:30 - 12:00</span> to <span id="ah-time-end">10:30 - 12:00</span>
</div>

 <div class="calendarContainerOuter">
    <div class="calendarContainer clearfix">
        <div class="calTopButtonBar clearfix">
            <div class="calBtn floatLeft" id="calChangeDate">
                <a href="#" title="Calendar"><span class="miniCalIcon"></span>&#x25BE;</a>
            </div>

            <div class="calBtn floatLeft todayBtnMargin">
                <a id="today" href="<?php echo TemplateHelpers::escapeHtml($control->link("Calendar:home", array('date'=> 'today'))) ?>">Today</a>
            </div>

            <div class="calBtn floatLeft">
                <a title="Previous Day" id="prevday" href="<?php echo TemplateHelpers::escapeHtml($control->link("Calendar:home", array('date'=>Date('Y-m-d', strtotime($date) - 86400)))) ?>">&#x25c2;</a>
            </div>
            <div id="currentDate" class="currentDate floatLeft">
                <?php echo TemplateHelpers::escapeHtml($presenter->formatDate($date, 'F j')) ?>

            </div>
            <div class="calBtn floatLeft">
                <a title="Next Day" id="nextday" href="<?php echo TemplateHelpers::escapeHtml($control->link("Calendar:home", array('date'=>Date('Y-m-d', strtotime($date) + 86400)))) ?>">&#x25B8;</a>
            </div>
        </div>
            
        <div class="clear"></div>
								
        <div class="calendar" id="calendar">
            <div class="timeline">
                <div class="calTopLeftEmpty"></div>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($hours) as $hour): ?>
                <div class="hour heading <?php if ($hour->m == 30): ?>half<?php endif ?> <?php if ($iterator->isFirst()): ?>roundedTopLeft<?php endif ?> <?php if ($iterator->isLast()): ?>roundedTopRight<?php endif ?>">
<?php if ($hour->m == 0): ?>
                        <h2><?php if ($hour->h > 12): echo TemplateHelpers::escapeHtml($hour->h - 12) ;else: echo TemplateHelpers::escapeHtml($hour->h) ;endif ?></h2><h5><?php if ($hour->h >= 12): ?>PM<?php else: ?>AM<?php endif ?></h5>
<?php else: ?>
                        <p>:30</p>
<?php endif ?>
                 </div>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
                <div style="clear:both;"></div>
            </div>
            <div class="body">
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($stylists) as $uid => $name): ?>
                <div class="row <?php if ($iterator->isLast()): ?>lastrow<?php endif ?>" id="sa-<?php echo TemplateHelpers::escapeHtml($uid) ?>">
                    <div class="personName firstcell"><?php echo TemplateHelpers::escapeHtml($name) ?></div>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($hours) as $hour): ?>
                    <div id="hour_<?php echo TemplateHelpers::escapeHtml($hour->h) ?>_<?php echo TemplateHelpers::escapeHtml($hour->m) ?>_s<?php echo TemplateHelpers::escapeHtml($uid) ?>" class="hourcell <?php if ($hour->m == 30): ?>half<?php endif ?> <?php if ($iterator->isLast()): ?>lastcell<?php endif ?>">                   
                    </div>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
                    <div style="clear:both;"></div>
                </div>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>


     <div class="noteToolbar">
    <p>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($service_colors) as $id => $color_number): ?>
        <span class="legendColor serviceColor<?php echo $color_number ?>"></span> <?php echo TemplateHelpers::escapeHtml($services[$id]) ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
    </p>
</div>
<!-- END LEGEND -->

</div>

<!-- START LEGEND -->

					
<script type="text/javascript" src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/sms.calendar.js">
</script>
<script type="text/javascript" src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/sms.appointment.js">
</script>
<script type="text/javascript" src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/sms.dialog.js"></script>
<script type="text/javascript" src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/sms.qs.js">
</script>
			
<script type="text/javascript">

var calendar = new sms.calendar(<?php echo TemplateHelpers::escapeJs($date) ?>);

calendar.diffZ = <?php echo TemplateHelpers::escapeJs($diffZ) ?>;
calendar.stylists = <?php echo $stylists_json ?>;
calendar.stylistsIndex = <?php echo $stylists_index_json ?>;
calendar.services = <?php echo $services_json ?>;
calendar.serviceColors = <?php echo $service_colors_json ?>;

calendar.startHour = Number(<?php echo TemplateHelpers::escapeJs($hours[0]->h) ?>);
calendar.getAppointmentsLink = <?php echo TemplateHelpers::escapeJs($control->link("Calendar:getAppointments", array('date'=>"DATE"))) ?>

calendar.deleteAppointmentLink = <?php echo TemplateHelpers::escapeJs($control->link("Calendar:deleteAppointment", array('id'=>"ID"))) ?>

calendar.udateAppointmentLink = <?php echo TemplateHelpers::escapeJs($control->link("Calendar:updateAppointment")) ?>

calendar.quckSearchLink = <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quickSearchAppointment")) ?>

calendar.checkoutLink = <?php echo TemplateHelpers::escapeJs($control->link("Checkout:order", array('appointment_id' => "ID"))) ?>


var appts = <?php echo $appts ?>;

//add all the appointments
for(var index in appts)
{					
    calendar.addAppointment(new sms.appointment(appts[index]));
}

$(function()
{					
    calendar.initCells();
});

$('#smallCalendar').datepicker({ onSelect:function (date)	{	$('#smallCalendar').hide();	sms.lightbox.hide(); calendar.gotoDay(date);	} } );
$('#calChangeDate a').click(calendar.showDatePicker);
$('#prevday').click(function() { calendar.gotoDay(-1); return false; } );
$('#nextday').click(function() { calendar.gotoDay(1); return false;} );                                
$('#today').click(function() { calendar.gotoDay('today'); return false;} );
</script>
<?php LatteMacros::includeTemplate("dialogs.phtml", $template->getParams(), $_cb->templates['ebfa631072'])->render() ?>
<center style="margin-top:30px;">
<iframe align="center" src="http://spreadsheets.google.com/embeddedform?formkey=dGNGUHVpQ3dCWjdwenhEbVU2cF9Rc2c6MQ" width="760" height="585" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
</center>
<?php
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
} if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
