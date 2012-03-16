<?php //netteCache[01]000240a:2:{s:4:"time";s:21:"0.86582700 1303003518";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:85:"/home/cpbeauty/public_html/salon/document_root/../app/templates/Checkout/search.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/Checkout/search.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '03ac102d9a'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbcf0241f7fe_content')) { function _cbbcf0241f7fe_content() { extract(func_get_arg(0))
;if (SnippetHelper::$outputAllowed) { LatteMacros::includeTemplate("../Checkout/find-user.phtml", $template->getParams(), $_cb->templates['03ac102d9a'])->render() ?>
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
            	
<?php if (empty($uid)): ?>
                <div class="popupHdrBar">                	
                    <h4>Search Results: Transactions</h4>
                </div>
                
                <div class="clientName"><?php if (!empty($search)): ?>#<?php echo TemplateHelpers::escapeHtml($search) ;endif ?></div>
<?php endif ;if (!empty($uid)): ?>
                <div class="popupHdrBar">                	
                    <h4>Transactions Of A Client</h4>
                </div>
                
                <div class="clientName"><a href=<?php echo TemplateHelpers::escapeHtml($control->link("Profile:edit", array('id'=>$uid))) ?>><?php echo TemplateHelpers::escapeHtml($client_name) ?></a></div>
<?php endif ?>
            	<div class="notes"><p><?php echo TemplateHelpers::escapeHtml($total_results) ?> results</p></div>

                
                <div class="transactionsBox">
						<ul class="purpleBar">
                        	<li>
                        	<span class="idNum"><p><a href=<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search", array('search' => $search, 'page' => 0, 'order' => $presenter->createOrderString('transaction_code')))) ?>>ID#<?php if ($order_column == 'transaction_code'): ?>&nbsp;<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/<?php if ($presenter->getOrderDir('transaction_code') == 'DESC'): ?>down<?php else: ?>up<?php endif ?>-white-arrow.png" width="7" height="4" alt="Sort Down"><?php endif ?></a></p></span>
                            <span class="idNum"><p><a href=<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search", array('search' => $search, 'page' => 0, 'order' => $presenter->createOrderString('transaction_created_date')))) ?>>Date<?php if ($order_column == 'transaction_created_date'): ?>&nbsp;<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/<?php if ($presenter->getOrderDir('transaction_created_date') == 'DESC'): ?>down<?php else: ?>up<?php endif ?>-white-arrow.png" width="7" height="4" alt="Sort Down"><?php endif ?></a></p></span>
                            <span class="clName"><p><a href="#" title="Sort"><a href=<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search", array('search' => $search, 'page' => 0, 'order' => $presenter->createOrderString('transaction_client_name')))) ?>>Client Name<?php if ($order_column == 'transaction_client_name'): ?>&nbsp;<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/<?php if ($presenter->getOrderDir('transaction_client_name') == 'DESC'): ?>down<?php else: ?>up<?php endif ?>-white-arrow.png" width="7" height="4" alt="Sort Down"><?php endif ?></a></p></span>
                            <span class="stylistName"><p><a href=<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search", array('search' => $search, 'page' => 0, 'order' => $presenter->createOrderString('transaction_stylists')))) ?>>Stylist(s)<?php if ($order_column == 'transaction_stylists'): ?>&nbsp;<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/<?php if ($presenter->getOrderDir('transaction_stylists') == 'DESC'): ?>down<?php else: ?>up<?php endif ?>-white-arrow.png" width="7" height="4" alt="Sort Down"><?php endif ?></a></p></span>
                            <span class="stylistName"><p><a href=<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search", array('search' => $search, 'page' => 0, 'order' => $presenter->createOrderString('transaction_products')))) ?>>Products Purchased<?php if ($order_column == 'transaction_products'): ?>&nbsp;<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/<?php if ($presenter->getOrderDir('transaction_products') == 'DESC'): ?>down<?php else: ?>up<?php endif ?>-white-arrow.png" width="7" height="4" alt="Sort Down"><?php endif ?></a></p></span>
                            <span class="noteIcon"></span>
                            <span class="total"><p><a href=<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search", array('search' => $search, 'page' => 0, 'order' => $presenter->createOrderString('transaction_total')))) ?>>Total<?php if ($order_column == 'transaction_total'): ?>&nbsp;<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/<?php if ($presenter->getOrderDir('transaction_total') == 'DESC'): ?>down<?php else: ?>up<?php endif ?>-white-arrow.png" width="7" height="4" alt="Sort Down"><?php endif ?></a></p></span>
                            <span class="editBtns"><p></p></span>
                            </li>
                        </ul>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($results) as $t): ?>
                        <ul id="trans-<?php echo TemplateHelpers::escapeHtml($t->transaction_id) ?>" class="row<?php if ($iterator->isOdd()): ?>White<?php else: ?>Grey<?php endif ?>">
                            <li>
                                <a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:order", array('transaction_id' => $t->transaction_id))) ?>">
                                <span class="idNum <?php if ($t->transaction_void == 1): ?>void<?php endif ?>"><?php echo TemplateHelpers::escapeHtml($t->transaction_code) ?></span>
                                <span class="idNum <?php if ($t->transaction_void == 1): ?>void<?php endif ?>"><?php echo TemplateHelpers::escapeHtml($presenter->formatDate($t->transaction_created_date)) ?></span>
                                <span class="clName <?php if ($t->transaction_void == 1): ?>void<?php endif ?>"><?php echo TemplateHelpers::escapeHtml($t->transaction_client_name) ?></span>
                                <span class="stylistName <?php if ($t->transaction_void == 1): ?>void<?php endif ?>"><?php echo TemplateHelpers::escapeHtml($t->transaction_stylists) ?></span>
                                <span class="stylistName <?php if ($t->transaction_void == 1): ?>void<?php endif ?>"><?php echo TemplateHelpers::escapeHtml($t->transaction_products) ?></span>
								<span class="total <?php if ($t->transaction_void == 1): ?>void<?php endif ?>">$<?php echo TemplateHelpers::escapeHtml($presenter->formatPrice($t->transaction_total)) ?></span>
                                </a>
                                <div class="editBtns">
                                    <table cellpadding="0" cellspacing="0" class="yellowBtnHolder floatLeft" onClick="window.location.href='#'">
                                        <tr>
                                            <td class="yellowBtnLeft"></td>
                                            <td class="yellowBtnMid" onclick='location.href=<?php echo TemplateHelpers::escapeHtmlJs($control->link("Checkout:order", array('transaction_id' => $t->transaction_id))) ?>'><p>Edit&nbsp;Details</p></td>

                                            <td class="yellowBtnRight"></td>
                                        </tr>
                                     </table>
                                    <div class="deleteBtn<?php if ($t->transaction_void == 1): ?>Void<?php endif ?> floatLeft"><a href="#" onclick="if (confirm('Do you really want to change this transaction?')) { sms.order.voidTrans(<?php echo TemplateHelpers::escapeHtmlJs($t->transaction_id) ?>); return false; }" title=" <?php if ($t->transaction_void == 1): ?>Unvoid<?php else: ?>Void<?php endif ?>This"></a></div>	
                                </div>
                             </li>
                	    </ul>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ;if ($num_results > $page_size): ?>
                    	<div class="paginationBar">

                        	<table cellpadding="0" cellspacing="0">
                            	<tr>
                                	<td width="130">
                                		<div class="prevPage">
                                			<a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search", array('search' => $search, 'order' => $order,'page' => $page_prev, 'uid' => $uid))) ?>" title="Previous Page">
                                				<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/left-white-arrow.png" alt="Previous Page">&nbsp; Previous Page</a>
                                		</div>
                                	</td>
                                    <td width="780"  class="pagination">
                                    <?php if ($page == 0): ?>1<?php else: ?><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search", array('search' => $search, 'order' => $order, 'page' => 0, 'uid' => $uid))) ?>">1</a><?php endif ?>

                                    <?php if ($page > 6): ?>...<?php endif ?>

<?php for ($i=($page - 6 < 0 ? 1 : $page - 6); $i < ($page + 6 > $max_page - 1 ? $max_page - 1 : $page + 6); $i++): ?>
                                    <?php if ($i == $page): echo TemplateHelpers::escapeHtml($i + 1) ;else: ?><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search", array('search' => $search, 'order' => $order, 'page' => $i, 'uid' => $uid))) ?>"><?php echo TemplateHelpers::escapeHtml($i+1) ?></a><?php endif ?>

<?php endfor ?>
                                    <?php if ($page < $max_page - 7): ?>...<?php endif ?>

                                    <?php if ($page == $max_page - 1): echo TemplateHelpers::escapeHtml($max_page) ;else: ?><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search", array('search' => $search, 'order' => $order, 'page' => $max_page - 1, 'uid' => $uid))) ?>"><?php echo TemplateHelpers::escapeHtml($max_page) ?></a><?php endif ?>

                                    </td>
                                    <td width="130"><div class="nextPage"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search", array('search' => $search, 'order' => $order,'page' => $page_next, 'uid' => $uid))) ?>" title="Next Page">Next Page &nbsp;<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/right-white-arrow.png" alt="Next Page"></a></div></td>
                                </tr>
                            </table>
                        </div>

<?php endif ?>
       		  		</div>
            	</div>	
            <div class="clear"></div>
			<script type="text/javascript">
			sms.order.transURL = <?php echo TemplateHelpers::escapeJs($control->link("Checkout:void")) ?>

			</script>
		</div>
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
