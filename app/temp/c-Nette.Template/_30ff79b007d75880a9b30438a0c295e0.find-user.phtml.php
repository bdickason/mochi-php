<?php //netteCache[01]000245a:2:{s:4:"time";s:21:"0.75804300 1276920527";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:90:"/home/insitu/public_html/salon-new/document_root/../app/templates/Checkout/find-user.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/Checkout/find-user.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'c49af9699e'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>
<div class="popupBG" id="find-user" style="display:none;">
	<div class="popupBorder">
		<div class="popupBox">
    	
        <div class="popupPurpleBar">
        	<div class="closeBtnPurple"><a href="#" onclick="sms.checkout.hide_checkout_step_1(); return false;">Cancel Checkout</a></div>
            <h4>CHECKOUT</h4>

        </div>
        
        <div class="transactionsBox">
        	<table cellspacing="0" cellpadding="0" border="0" width="100%">
            	<tr>
                	
                    <td valign="top" width="100%">
                    	<div class="darkGreyBar">
            				<p>Search for a Client</p>
            				<div class="clear"></div>

        				</div>
												
                        <div class="checkoutSearch">
<?php $control->getWidget("checkoutSearchForm")->render('begin') ?>
		            		<?php echo TemplateHelpers::escapeHtml($control['checkoutSearchForm']['q']->control) ?>

			                <div class="checkoutSearchBtn"><a href="#" onclick="$('.checkoutSearch form').submit();" title="Search"><div class="searchIconCheckout"><img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/icon-search-small.png" width="18" height="19" alt="Search" /></div></a></div>
			                <div class="clear"></div>
<?php $control->getWidget("checkoutSearchForm")->render('end') ?>
                            <div class="checkoutResultBoxUser qs-results-checkout" style="display:none;">
								<div id="snippet--wideresults"></div>
    					    </div>
        				</div>
                        
                    </td>
                </tr>
            </table>
        </div>

        
   	  </div>
	</div>
</div>
<script type="text/javascript">
 $('.checkoutSearch input').attr({'autocomplete':'off'})
        	.focus()
        	.bind('keydown', { url: <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchcheckout")) ?>}, sms.quicksearch.keydown)	
        	.bind('keyup', { url: <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchcheckout")) ?>}, sms.quicksearch.keyup);

        sms.quicksearch.url = <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchcheckout")) ?>;
</script><?php
}
