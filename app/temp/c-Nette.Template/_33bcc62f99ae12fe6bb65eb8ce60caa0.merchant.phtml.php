<?php //netteCache[01]000241a:2:{s:4:"time";s:21:"0.14100500 1303002082";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:86:"/home/cpbeauty/public_html/salon/document_root/../app/templates/Reports/merchant.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/Reports/merchant.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '4753d917a4'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb409c69cdf1_content')) { function _cbb409c69cdf1_content() { extract(func_get_arg(0))
;if (SnippetHelper::$outputAllowed) { LatteMacros::includeTemplate("../Checkout/find-user.phtml", $template->getParams(), $_cb->templates['4753d917a4'])->render() ?>
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
    
    <!-- START MERCHANT REPORT DETAILS -->
    	<div class="userWrapper">

        	<div class="popupBox">
            	
<?php LatteMacros::includeTemplate('navigation.phtml', $template->getParams(), $_cb->templates['4753d917a4'])->render() ?>
            	
                <div class="popupHdrBar">                	
                    <h4>Merchant report</h4>
                </div>
                                
                <div class="transactionsBox">					                    
<?php $control->getWidget("retailFilterForm")->render('begin') ?>
                    
<!--
MERCHANT REPORT
Date Range: Daily
Input: $start_date Select the day you want to view

Outputs:
-Total CC Revenue by Merchant
 -VISA/MC
 -AMEX
 -DISCOVER (?)

-Transaction by Merchant
 -Transaction ID
 -Client's Name
 -Amount

-->
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
                    
                    	
<?php $control->getWidget("retailFilterForm")->render('end') ?>
                    
<?php if ($show_report): ?>
                    
                    <br/><br/>
                    
                    <!-- TOTAL REVENUE -->
                    <table cellpadding="0" cellspacing="0" style="margin-bottom:20px; border-collapse:collapse; width:500px;">
                    	
                    	<tr>
                    		<th>Total <strong>Merchant $$$</strong> for:  <strong><?php echo TemplateHelpers::escapeHtml($presenter->formatDate($start_date, 'n/j/Y')) ?></strong></th>
                    	</tr>
                    	
                    	<tr style="height:40px;"><td colspan="3">&nbsp;</td></tr>
                    
                    <!-- REVENUE by Merchant-->
                                        	
                    	<tr style="border-bottom:1px black solid;">
                    		<th>Merchant</th>
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
                    		<th>Merchant subtotal</th>
                    		<td><?php echo TemplateHelpers::escapeHtml($results['payment_types']['totalcount']) ?></td>
                    		<th align="right">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($results['payment_types']['total'])) ?></th>
                    	</tr>
						<tr><td>&nbsp;</td></tr>

								<tr style="height:40px;">&nbsp;</tr>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($results['payment_types']['entries']) as $entry): ?>
								<tr>
									<th><?php echo TemplateHelpers::escapeHtml($entry['name']) ?></th>
								</tr>
								<tr style="border-bottom:1px black solid;">
		                    		<td>Name</td>
		                    		<td>Time</td>
		                    		<td align="right">Amount</td>
		                    	</tr>

<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($entry['transactions']) as $transaction): ?>

									<tr>
										<td><?php echo TemplateHelpers::escapeHtml($transaction['name']) ?></td>
			                    		<td><?php echo TemplateHelpers::escapeHtml($presenter->formatDate($transaction['date'], 'H:i')) ?></td>
			                    		<td align="right">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($transaction['sum'])) ?></td>
			                    	</tr>	
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>

									<tr style="border-top:1px black solid;">
			                    		<th><?php echo TemplateHelpers::escapeHtml($entry['payment_type']) ?> subtotal</th>
			                    		<td><?php echo TemplateHelpers::escapeHtml($entry['count']) ?></td>
			                    		<th align="right">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($entry['sum'])) ?></th>
			                    	</tr>	
								<tr><td>&nbsp;</td></tr>
								<tr style="height:40px;"><td colspan="3">&nbsp;</td></tr>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
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
