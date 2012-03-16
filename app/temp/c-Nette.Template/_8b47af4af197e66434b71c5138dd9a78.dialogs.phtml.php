<?php //netteCache[01]000243a:2:{s:4:"time";s:21:"0.22658400 1276921108";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:88:"/home/insitu/public_html/salon-new/document_root/../app/templates/Calendar/dialogs.phtml";i:2;i:1276921100;}}}?><?php
// file …/templates/Calendar/dialogs.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '493532ba0a'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>
<div class="popupBox apptPopup" id="dialog-appointment-add" style="display:none;">
        	<div class="titleBar clearfix" style="cursor:move;">
        	<div class="closeBtn floatRight"><p><a href="#" title="Close Window"><span class="closeIcon"></span>Close</a></p></div>
            <div class="floatLeft"><p><span class="moveIcon"></span>Add Appointment</p></div>
            </div>
<?php $control->getWidget("addForm")->render('begin') ?>
	   <div style="display:none;" class="fUID"> <?php echo TemplateHelpers::escapeHtml($control['addForm']['client_uid']->control) ?></div>
    <div class="subTitleBar apptClient"><p>Client</p></div>
          <div class="apptClientInput fClientName"><?php echo TemplateHelpers::escapeHtml($control['addForm']['client_name']->control) ?></div>
			 <div class="resultBox qs-results" style="display:none;">
            <div class="snippet--appointmentresults"></div>
            </div>

		   <div class="subTitleBar apptClient"><p>Phone Number</p></div>
            <div class="apptClientInput inputSmall fPhoneNumber">
				<?php echo TemplateHelpers::escapeHtml($control['addForm']['phone_number']->control) ?>

			</div>
 
 <div class="subTitleBar apptClient"><p>Service</p></div>
            <div class="fService">
              <?php echo TemplateHelpers::escapeHtml($control['addForm']['service']->control) ?>

          </div>

            <div class="subTitleBar apptClient"><p>Stylist</p></div>
            <div class="fStylist">
               <?php echo TemplateHelpers::escapeHtml($control['addForm']['stylist']->control) ?>

          </div>

            <div class="fDate" style="display:none;"><?php echo TemplateHelpers::escapeHtml($control['addForm']['date']->control) ?></div>

<table cellpadding="0" cellspacing="0">
            	<tr>
                	<td><div class="startTime subTitleBar "><p>Start Time</p></div></td>
                    <td><div class="endTime subTitleBar"><p>End Time</p></div></td>
                </tr>
                <tr>
                	<td><div class="startTimeInput inputSmall fStartTime"><?php echo TemplateHelpers::escapeHtml($control['addForm']['startTime']->control) ?></div></td>
                    <td><div class="endTimeInput inputSmall fEndTime"><?php echo TemplateHelpers::escapeHtml($control['addForm']['endTime']->control) ?></div></td>
                </tr>
            </table>

            <div class="clear"></div>

            <div class="apptSaveDeleteBox clearfix">
            	<div class="actionBtn floatLeft fSave"><h4><a href="#" title="Book This Appoinment">Book It!</a></h4></div>
                <div class="cancelActionBox floatLeft">
                  <h4>or <a href="#" class="redLink fDelete" title="Cancel This Appoinment">Cancel</a></h4></div>
            </div>

            <div class="tenPxSpacer"></div>
<?php $control->getWidget("addForm")->render('end') ?>
							
        </div>

<div class="popupBox apptPopup" id="dialog-appointment-edit" style="display:none;">
        	<div class="titleBar clearfix" style="cursor:move;">
        	<div class="closeBtn floatRight"><p><a href="#" title="Close Window"><span class="closeIcon"></span>Close</a></p></div>
            <div class="floatLeft"><p><span class="moveIcon"></span>Edit Appointment</p></div>
            </div>
<?php $control->getWidget("editForm")->render('begin') ?>
       <div style="display:none;" class="fID"> <?php echo TemplateHelpers::escapeHtml($control['editForm']['appointment_id']->control) ?></div>
	   <div style="display:none;" class="fUID"> <?php echo TemplateHelpers::escapeHtml($control['editForm']['client_uid']->control) ?></div>
    <div class="subTitleBar apptClient"><p>Client</p></div>
          <div class="apptClientInput fClientName"><?php echo TemplateHelpers::escapeHtml($control['editForm']['client_name']->control) ?></div>
		   <div class="resultBox qs-results" style="display:none;">
            <div class="snippet--appointmentresults"></div>
            </div>
 <div class="subTitleBar apptClient"><p>Phone Number</p></div>
            <table cellpadding="0" cellspacing="0">
            	<tr>
                	<td><div class="apptPhone inputSmall fPhoneNumber"><?php echo TemplateHelpers::escapeHtml($control['editForm']['phone_number']->control) ?></div></td>
                    <td><div class="apptPhone fPhoneType">
                    	<?php echo TemplateHelpers::escapeHtml($control['editForm']['phone_type']->control) ?>

                        </div>
                    </td>
              </tr>
          </table>

 <div class="subTitleBar apptClient"><p>Service</p></div>
            <div class="fService">
              <?php echo TemplateHelpers::escapeHtml($control['editForm']['service']->control) ?>

          </div>

            <div class="subTitleBar apptClient"><p>Stylist</p></div>
            <div class="fStylist">
               <?php echo TemplateHelpers::escapeHtml($control['editForm']['stylist']->control) ?>

          </div>

            <div class="fDate" style="display:none;"><?php echo TemplateHelpers::escapeHtml($control['editForm']['date']->control) ?></div>

<table cellpadding="0" cellspacing="0">
            	<tr>
                	<td><div class="startTime subTitleBar "><p>Start Time</p></div></td>
                    <td><div class="endTime subTitleBar"><p>End Time</p></div></td>
                </tr>
                <tr>
                	<td><div class="startTimeInput inputSmall fStartTime"><?php echo TemplateHelpers::escapeHtml($control['editForm']['startTime']->control) ?></div></td>
                    <td><div class="endTimeInput inputSmall fEndTime"><?php echo TemplateHelpers::escapeHtml($control['editForm']['endTime']->control) ?></div></td>
                </tr>
            </table>

            <div class="clear"></div>

            <div class="apptSaveDeleteBox clearfix">
            	<div class="actionBtn floatLeft fSave"><h4><a href="#" title="Book This Appoinment">Save!</a></h4></div>
                <div class="cancelActionBox floatLeft">
                  <h4>or <a href="#" class="redLink fDelete" title="Delete This Appoinment">Delete</a></h4></div>
            </div>

            <div class="tenPxSpacer"></div>

            <div class="subTitleBar" style="text-align:center;">
            	<p><a class="checkoutAppointmentLink" href="#" title="Checkout This Person"><span class="smallCalIcon"></span> Checkout This Person</a></p>
            </div>
<?php $control->getWidget("editForm")->render('end') ?>

        </div>

<?php
}
