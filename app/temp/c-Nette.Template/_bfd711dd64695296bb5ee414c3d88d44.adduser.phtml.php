<?php //netteCache[01]000240a:2:{s:4:"time";s:21:"0.15822800 1303246788";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:85:"/home/cpbeauty/public_html/salon/document_root/../app/templates/Profile/adduser.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/Profile/adduser.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '4192d93124'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb1c21eba347_content')) { function _cbb1c21eba347_content() { extract(func_get_arg(0))
;LatteMacros::includeTemplate("../Checkout/find-user.phtml", $template->getParams(), $_cb->templates['4192d93124'])->render() ?>
 <!-- START TOP SEARCH AND CHECKOUT -->
    	<div class="userWrapper">
    	<div class="userResultWrapper qs-results" style="display:none;">
    	<div class="resultBoxUser">
            <div id="snippet--results" ></div>
            
		 </div>
		 <div class="addClientBtnUser clear"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:adduser")) ?>" title="Add Client"></a></div>
		 </div>	 
    	<div class="searchBoxUser">
<?php $control->getWidget("searchForm")->render('begin') ?>
		            	<?php echo TemplateHelpers::escapeHtml($control['searchForm']['q']->control) ?>

		                <div class="searchBtnUser"><a href="#" onclick="$('form').submit();" title="Search"><div class="searchIconUser"><img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/icon-search-med.png" width="40" height="42" alt="Search" /></div></a></div>
		                <div class="clear"></div>
<?php $control->getWidget("searchForm")->render('end') ?>
		 </div>		 
		 
   	  	 <div class="checkoutBtnUser floatRight"><a href="#" onclick="sms.checkout.show_checkout_step_1(); return false;" title="Checkout"></a></div>
         
         <div class="clear"></div>	
		 
        </div>
        
        <script type="text/javascript">

        $('.searchBoxUser input').attr({'autocomplete':'off'})
        	.focus()
        	.bind('keydown', { url: <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchuser")) ?>}, sms.quicksearch.keydown)	
			.bind('keyup', { url: <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchuser")) ?>}, sms.quicksearch.keyup);

        sms.quicksearch.url = <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchuser")) ?>;

        </script>
        
    <!-- END TOP SEARCH AND CHECKOUT -->

<div class="userWrapper">
<div class="form">
<?php $control->getWidget("userForm")->render('begin') ?>
        	<table cellpadding="0" cellspacing="0" width="1080">
            	<tr>
                    <td class="userLeftCol">
                        <div class="ltYellowBar">
                        	User type:
                        	<?php echo TemplateHelpers::escapeHtml($control['userForm']['type']->control) ?>

                            <div class="clear"></div>
                        </div>
                    	
                        <div class="clientName fieldSizeLarge"><?php echo TemplateHelpers::escapeHtml($control['userForm']['name']->control) ?></div>
                        <div class="notes"><p><?php echo TemplateHelpers::escapeHtml($control['userForm']['notes']->control) ?></p></div>
                        
                         <div class="greyBigBox">

                        	<div class="darkGreyBar">
                            	<p>E-mail</p>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="email fieldSizeMedium"><?php echo TemplateHelpers::escapeHtml($control['userForm']['email']->control) ?></div>

                        </div>
                        
                        
                        <div class="greySmallBox">
                        	<div class="darkGreyBar">
                            	<div class="floatRight">
                            		<?php echo TemplateHelpers::escapeHtml($control['userForm']['phone_primary_type']->control) ?>

								</div>
                            	<p>Phone Number</p>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="phoneNum fieldSizeMedium"><?php echo TemplateHelpers::escapeHtml($control['userForm']['phone_primary_number']->control) ?></div>
                        </div>
                        
                        <div class="spacer19px"></div>
                        
                         <div class="greySmallBox">
                        	<div class="darkGreyBar">
                            	<div class="floatRight">
                            		<?php echo TemplateHelpers::escapeHtml($control['userForm']['phone_secondary_type']->control) ?>

								</div>
                            	<p>Secondary Phone Number</p>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="phoneNum fieldSizeMedium"><?php echo TemplateHelpers::escapeHtml($control['userForm']['phone_secondary_number']->control) ?></div>
                        </div>
                        	
                        <div class="greyBigBox">

                        	<div class="darkGreyBar">
                            	<p>Mailing Address</p>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="address">
                            	<div class="ltGreyBar"><p>Street Address</p></div>
                                <div class="addressTxt fieldSizeSmall"><?php echo TemplateHelpers::escapeHtml($control['userForm']['address_street']->control) ?></div>

                            </div>
                            
                            <div class="aptZip">
                            	<div class="ltGreyBar"><p>Apartment #</p></div>
                                <div class="addressTxt fieldSizeSmall"><?php echo TemplateHelpers::escapeHtml($control['userForm']['address_apartment']->control) ?></div>
                            </div>
                            
                            <div class="city">
                            	<div class="ltGreyBar"><p>City</p></div>

                                <div class="addressTxt fieldSizeSmall"><?php echo TemplateHelpers::escapeHtml($control['userForm']['address_city']->control) ?></div>
                            </div>
                            
                            <div class="state">
                            	<div class="ltGreyBar"><p>State</p></div>
                                <div class="addressTxt fieldSizeSmall"><?php echo TemplateHelpers::escapeHtml($control['userForm']['address_state']->control) ?></div>
                            </div>
                            
                            <div class="aptZip">

                            	<div class="ltGreyBar"><p>Zip Code</p></div>
                                <div class="addressTxt fieldSizeSmall"><?php echo TemplateHelpers::escapeHtml($control['userForm']['address_zip']->control) ?></div>
                            </div>
                        </div>
                        
                         <div class="greySmallBox">
                        	<div class="darkGreyBar">

                            	<p>Gender</p>
                              <div class="clear"></div>
                            </div>
                            
                           <div class="plainBox"> 
                            
                             <?php echo TemplateHelpers::escapeHtml($control['userForm']['gender']->control) ?>

                          </div>
                        </div>
                        
                        <div class="spacer19px"></div>
                        
                       <div class="greySmallBox">

                        	<div class="darkGreyBar">
                            	<p>Date of Birth</p>
                                
                                <div class="clear"></div>
                            </div>
                            <div class="dobM fieldSizeMedium"><?php echo TemplateHelpers::escapeHtml($control['userForm']['bdm']->control) ?></div>
							<div class="dobD fieldSizeMedium"><?php echo TemplateHelpers::escapeHtml($control['userForm']['bdd']->control) ?></div>
							<div class="dobY fieldSizeMedium"><?php echo TemplateHelpers::escapeHtml($control['userForm']['bdy']->control) ?></div>
                        </div>
                       
                       <div class="greyBigBox">
                        	<div class="darkGreyBar">
                            	<p>Referred by</p>
                              <div class="clear"></div>
                            </div>

                            
                          <div class="referred fieldSizeMedium">
                          <?php echo TemplateHelpers::escapeHtml($control['userForm']['referral']->control) ?>

                          </div>
                      </div>
                       
                       
                        <div class="saveBtnUser floatLeft"><a href="#" onclick="sms.form.user_form_submit('UserForm', '.form form'); return false;" title="Save Changes"></a></div>
                        <div class="cancelBtnUser floatLeft"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:search")) ?>" onclick="return confirm('Do you really want to cancel changes?');" title="Cancel Changes"></a></div>
                	</td>
                    
                 <!-- START RIGHT COLUMN -->
                    <td class="userRightCol">
                    	 <div class="whiteSmallBox bottomMargin20px">

                        	<ul>
                            	<li class="purpleBar">
                                	<div class="width230"><p>Preferred Stylist (cut &amp; color)</p></div>
                                </li>
                                <li class="whiteBar">
                                	<?php echo TemplateHelpers::escapeHtml($control['userForm']['stylist_cut']->control) ?>

                                </li>
                                <li class="whiteBar">
                                	<?php echo TemplateHelpers::escapeHtml($control['userForm']['stylist_color']->control) ?>

                                </li
                            </ul>	
                        </div>
                    	                       
                    </td>    
            	</tr>

            </table>
           <div class="clear"></div>
</div>
</div>
<?php $control->getWidget("userForm")->render('end') ;$control->getWidget("userForm")->render('errors') ?>
<script type="text/javascript">
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($field_defaults) as $field => $default): ?>
sms.form.field_defaults[<?php echo TemplateHelpers::escapeJs($field) ?>] = <?php echo TemplateHelpers::escapeJs($default) ?>;
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>

$(document).ready(		
		function() {
			 
			$('.form .phoneNum input').bind('change', sms.form.validation.fixPhoneNumber);
			$('.form .notes textarea').bind('keyup', sms.form.validation.expandTextArea);
		}
	);
</script>


<?php
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
