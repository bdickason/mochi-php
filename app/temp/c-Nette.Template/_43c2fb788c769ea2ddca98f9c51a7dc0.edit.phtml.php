<?php //netteCache[01]000235a:2:{s:4:"time";s:21:"0.91523400 1276921782";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:80:"/home/insitu/public_html/salon/document_root/../app/templates/Profile/edit.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/Profile/edit.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'ae6b9f3d87'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbe229f0ce88_content')) { function _cbbe229f0ce88_content() { extract(func_get_arg(0))
?>
    
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
<?php if ($euser['type'] == 'client'): ?>
   	  	    <div class="checkoutBtnUser floatRight"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:order", array('uid' => $uid,'transaction_id' => null))) ?>" title="Checkout"></a></div>
            
<?php endif ?>
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

<?php if ($saved): ?>
<div class="userWrapper">
<div style="background:url(<?php echo TemplateHelpers::escapeHtmlCss($basePath) ?>/images/icon-info.png) no-repeat; min-height: 25px; padding-left:40px; padding-top:7px; font-weight:bold;">
The user data has been saved.
</div>
</div>
<?php endif ;if (!$control['userForm']->isValid()): ?>
<div class="userWrapper">
<div style="background:url(<?php echo TemplateHelpers::escapeHtmlCss($basePath) ?>/images/icon-info.png) no-repeat; min-height: 25px; padding-left:40px; padding-top:7px; ">
<strong>Please fix the following errors:</strong>
<?php $control->getWidget("userForm")->render('errors') ?>
</div>
</div>
<?php endif ?>
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
                        <div class="cancelBtnUser floatLeft"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:search")) ?>"  onclick="return confirm('Do you really want to cancel changes?');" title="Cancel Changes"></a></div>
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
                    	                        
                        <div class="whiteSmallBox bottomMargin20px">
                        	<ul>
                            	<li class="purpleBar">
                                	<div class="width230"><p>Recent Transactions</p></div>
                                    <div class="width73"><p>Spent</p></div>
                                </li>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($transactions) as $trans): ?>
                                <li class="<?php if ($trans->transaction_void): ?>void <?php endif ;if ($iterator->isOdd()): ?>white<?php else: ?>ltGrey<?php endif ?>BarLink"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:order", array('uid'=>null,'transaction_id'=>$trans->transaction_id))) ?>">
                                	<div class="width230"><p><?php echo TemplateHelpers::escapeHtml($presenter->formatDate($trans->date, "F j, Y")) ?></p></div>

                                    <div class="width73"><p>$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($trans->price)) ?></p></div></a>
                                </li>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
                                <li class="ltYellowBar">
                                    	<table cellpadding="0" cellspacing="0" class="yellowBtnHolder alignCenter">
                                        	<tr>
                                            	<td class="yellowBtnLeft"></td>

                                                <td class="yellowBtnMid" onclick="location.href=<?php echo TemplateHelpers::escapeHtmlJs($control->link("Checkout:search", array('search'=>'','uid'=>$uid))) ?>"><p>View All Transactions</p></td>
                                                <td class="yellowBtnRight"></td>
                                            </tr>
                                        </table>
                                    </li>
                              </ul>
                            </div>
                    	
                       
                    </td>    
            	</tr>

            </table>
           <div class="clear"></div>
</div>
</div>
<?php $control->getWidget("userForm")->render('end') ?>
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
