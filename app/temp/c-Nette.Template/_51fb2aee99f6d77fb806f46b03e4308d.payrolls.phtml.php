<?php //netteCache[01]000241a:2:{s:4:"time";s:21:"0.93791600 1303007251";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:86:"/home/cpbeauty/public_html/salon/document_root/../app/templates/Reports/payrolls.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/Reports/payrolls.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '2801d1810f'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbe5d3dfe06d_content')) { function _cbbe5d3dfe06d_content() { extract(func_get_arg(0))
;if (SnippetHelper::$outputAllowed) { LatteMacros::includeTemplate("../Checkout/find-user.phtml", $template->getParams(), $_cb->templates['2801d1810f'])->render() ?>
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
            	
<?php LatteMacros::includeTemplate('navigation.phtml', $template->getParams(), $_cb->templates['2801d1810f'])->render() ?>
            	
                <div class="popupHdrBar">                	
                    <h4>Payroll report</h4>
                </div>
                                
                <div class="transactionsBox">					                    
<?php $control->getWidget("filterForm")->render('begin') ?>
                    
                    <table width="100%">
                    
                    <tr>
                    	<th width="200" align="left">Stylist</th>
                    	<td style="width:450px;" class="greySmallBox"><?php echo TemplateHelpers::escapeHtml($control['filterForm']['stylist']->control) ?> select stylist or leave to see all stylists</td>
                    </tr>
                    
                    <tr>
                    	<th align="left">Date</th>
                    	<td id="datepicker" style="width:650px;" class="greySmallBox"><?php echo TemplateHelpers::escapeHtml($control['filterForm']['date']->control) ?> use dd/mm/YYYY notation</td>
                    </tr>
                    
                    <tr>
                    	<td colspan="2">
                    	<br/>
                    		<?php echo TemplateHelpers::escapeHtml($control['filterForm']['show']->control) ?>

                    	</td>
                    </tr>
                    
                    </table>
                    
                    	
<?php $control->getWidget("filterForm")->render('end') ?>
                    
<?php if ($show_payroll): ?>
                    
                    <br/><br/>
                    
                    <p style="font-size:16px;">
                    Showing week: <strong><?php echo TemplateHelpers::escapeHtml($presenter->formatDate($start_date)) ?> - <?php echo TemplateHelpers::escapeHtml($presenter->formatDate($end_date)) ?></strong>
                    </p>
                    
                    
                    
                    <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                    	<tr style="border-bottom:1px black solid;">
                    		<th>Stylist name</th>
                    		<th align="right">Retail*</th>
                    		<th align="right">Services*</th>
                    		<th align="right">Total*</th>
                    	</tr>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($results) as $result): ?>
                    	<tr>
                    		<td align="center"><?php echo TemplateHelpers::escapeHtml($result['name']) ?></td>
                    		<td align="right" width="200">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($result['retail'])) ?></td>
                    		<td align="right" width="200">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($result['service'])) ?></td>
                    		<td align="right" width="200">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($result['total'])) ?></td>
                    	</tr>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
                    	
                    	<tr style="border-top:1px black solid;">
                    		<th>TOTAL</th>
                    		<th align="right" width="200">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($totals['retail'])) ?></th>
                    		<th align="right" width="200">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($totals['service'])) ?></th>
                    		<th align="right" width="200">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($totals['total'])) ?></th>
                    	</tr>
                    	
                    </table>
<?php if ($showing_transactions): ?>
                    <br/><br/>
                    <strong>Persons transactions</strong>
                    <br/><br/>
                                       
                     <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                     	<tr style="border-bottom:1px black solid;">
                    		<th width="100" align="center">Tran #</th>
                    		<th align="center">Date</th>
                    		<th align="center">Client name</th>
                    		<th align="center">Service/Product</th>
                    		<th align="right">Amount*</th>
                    	</tr>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($transactions) as $t): ?>
                    	<tr>
                    		<td align="center"><?php echo TemplateHelpers::escapeHtml($t['code']) ?></td>
                    		<td align="center"><?php echo TemplateHelpers::escapeHtml($presenter->formatDate($t['date'])) ?></td>
                    		<td align="center" width="200"><?php echo TemplateHelpers::escapeHtml($t['client_name']) ?></td>
                    		<td align="center" width="300"><?php echo TemplateHelpers::escapeHtml($t['item_name']) ?></td>
                    		<td align="right" width="100">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($t['amount'])) ?></td>
                    	</tr>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
                     </table>
<?php endif ?>
                    <br/><br/>
                    * Note: all amounts are shown pre-tax.
                    
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
