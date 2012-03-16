<?php //netteCache[01]000245a:2:{s:4:"time";s:21:"0.00598600 1311895614";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:90:"/srv/www/bloom.getmochi.com/public_html/document_root/../app/templates/Reports/daily.phtml";i:2;i:1311820099;}}}?><?php
// file …/templates/Reports/daily.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '872c741bbf'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb3985b6ebfc_content')) { function _cbb3985b6ebfc_content() { extract(func_get_arg(0))
;if (SnippetHelper::$outputAllowed) { LatteMacros::includeTemplate("../Checkout/find-user.phtml", $template->getParams(), $_cb->templates['872c741bbf'])->render() ?>
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
    
    <!-- START CLIENT AND SERVICE DETAILS -->
    	<div class="userWrapper">

        	<div class="popupBox">
            	
<?php LatteMacros::includeTemplate('navigation.phtml', $template->getParams(), $_cb->templates['872c741bbf'])->render() ?>
            	
                <div class="popupHdrBar">                	
                    <h4>Daily report</h4>
                </div>
                                
                <div class="transactionsBox">					                    
<?php $control->getWidget("dailyFilterForm")->render('begin') ?>
                    
                    <table>
                    <tr>
                    	<th align="left">Date</th>
                    	<td id="datepicker" style="width:650px;"><?php echo TemplateHelpers::escapeHtml($control['filterForm']['date']->control) ?> use dd/mm/YYYY notation</td>
                    </tr>
                    
                    <tr>
                    	<td colspan="2">
                    	<br/>
                    		<?php echo TemplateHelpers::escapeHtml($control['filterForm']['show']->control) ?>

                    	</td>
                    </tr>
                    
                    </table>
                    
                    	
<?php $control->getWidget("dailyFilterForm")->render('end') ?>
                    
<?php if ($show_report): ?>
                    
                    <br/><br/>
                    
                    <!-- TOTAL REVENUE -->
                    <table cellpadding="0" cellspacing="0" style="margin-bottom:20px; border-collapse:collapse; width:400px;">
                    	
                    	<tr>
                    		<th>Total revenue for <?php echo TemplateHelpers::escapeHtml($presenter->formatDate($date, 'n/j/Y')) ?></th>
                    		<th colspan="2" align="right">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($total_revenue)) ?></th>
                    	</tr>
                    	
                    	<tr style="height:40px;"><td colspan="3">&nbsp;</td></tr>
                    
                    <!-- SERVICES REVENUE -->
                                        	
                    	<tr style="border-bottom:1px black solid;">
                    		<th>Service</th>
                    		<th>#</th>
                    		<th>Amount</th>
                    	</tr>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($results[TransactionEntry::ENTRY_TYPE_SERVICE]['entries']) as $entry): ?>
                    	<tr>
                    		<td><?php echo TemplateHelpers::escapeHtml($entry['name']) ?></td>
                    		<td align="right"><?php echo TemplateHelpers::escapeHtml($entry['count']) ?></td>
                    		<td align="right">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($entry['sum'])) ?></td>
                    	</tr>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
                    	<tr style="border-top:1px black solid;">
                    		<th>Services subtotal</th>
                    		<td></td>
                    		<th align="right">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($results[TransactionEntry::ENTRY_TYPE_SERVICE]['total'])) ?></th>
                    	</tr>
                    	
                    	<tr style="height:40px;"><td colspan="3">&nbsp;</td></tr>
                    
                    <!-- PRODUCTS REVENUE -->
                                                            	
                    	<tr style="border-bottom:1px black solid;">
                    		<th>Retail</th>
                    		<th>#</th>
                    		<th>Amount</th>
                    	</tr>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($results[TransactionEntry::ENTRY_TYPE_PRODUCT]['entries']) as $entry): ?>
                    	<tr>
                    		<td><?php echo TemplateHelpers::escapeHtml($entry['name']) ?></td>
                    		<td align="right"><?php echo TemplateHelpers::escapeHtml($entry['count']) ?></td>
                    		<td align="right">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($entry['sum'])) ?></td>
                    	</tr>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
                    	<tr style="border-top:1px black solid;">
                    		<th>Retail subtotal</th>
                    		<td></td>
                    		<th align="right">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($results[TransactionEntry::ENTRY_TYPE_PRODUCT]['total'])) ?></th>
                    	</tr>
                    	
                    	<tr style="height:40px;"><td colspan="3">&nbsp;</td></tr>
                    
                    <!-- PAYMENT TYPES -->
                                        	
                    	<tr style="border-bottom:1px black solid;">
                    		<th>Payment type (tax included)</th>
                    		<th>#</th>
                    		<th>Amount</th>
                    	</tr>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($results['payment_types']['entries']) as $entry): ?>
                    	<tr>
                    		<td><?php echo TemplateHelpers::escapeHtml($entry['name']) ?></td>
                    		<td align="right"><?php echo TemplateHelpers::escapeHtml($entry['count']) ?></td>
                    		<td align="right">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($entry['sum'])) ?></td>
                    	</tr>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
                    	<tr style="border-top:1px black solid;">
                    		<th>Payments total</th>
                    		<td></td>
                    		<th align="right">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($results['payment_types']['total'])) ?></th>
                    	</tr>
                    	
                    	<tr style="height:40px;"><td colspan="3">&nbsp;</td></tr>
                    
                    <!-- TAXES -->
                                        	
                    	<tr style="border-bottom:1px black solid;">
                    		<th>Tax</th>
                    		<th></th>
                    		<th>Amount</th>
                    	</tr>                    	
                    	<tr>
                    		<td>Services tax</td>                    		
                    		<td colspan="3" align="right">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($results[TransactionEntry::ENTRY_TYPE_SERVICE]['tax'])) ?></td>                    		
                    	</tr>
                    	<tr>
                    		<td>Retail tax</td>                    		
							<td colspan="3" align="right">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($results[TransactionEntry::ENTRY_TYPE_PRODUCT]['tax'])) ?></td>                    		
                    	</tr>
                    	
                    	<tr style="border-top:1px black solid;">
                    		<th>Tax total</th>
                    		<td></td>
                    		<th align="right">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($total_tax)) ?></th>
                    	</tr>
                    </table>
<?php endif ?>
       		  	</div>
            </div>	
            <div class="clear"></div>			
		</div>
		<script type="text/javascript">
		$(function() {
			$("#datepicker input").datepicker();
		});
	
		</script>
<!-- END CLIENT AND SERVICE DETAILS -->

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
