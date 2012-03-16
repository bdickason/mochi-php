<?php //netteCache[01]000244a:2:{s:4:"time";s:21:"0.28229500 1311872636";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:89:"/srv/www/bloom.getmochi.com/public_html/document_root/../app/templates/Profile/list.phtml";i:2;i:1311820098;}}}?><?php
// file …/templates/Profile/list.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'e654fc58ad'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbee9736a9b4_content')) { function _cbbee9736a9b4_content() { extract(func_get_arg(0))
;LatteMacros::includeTemplate("../Checkout/find-user.phtml", $template->getParams(), $_cb->templates['e654fc58ad'])->render() ?>
<!-- START CLIENT AND SERVICE DETAILS -->
	<div class="userWrapper">
        	
   	  <div class="searchBoxUser">
<?php $control->getWidget("searchForm")->render('begin') ?>
        	<?php echo TemplateHelpers::escapeHtml($control['searchForm']['q']->control) ?>

            <div class="searchBtnUser"><a href="#" onclick="$('form').submit();" title="Search"><div class="searchIconUser"><img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/icon-search-med.png" width="40" height="42" alt="Search" /></div></a></div>
            <div class="clear"></div>
<?php $control->getWidget("searchForm")->render('end') ?>
        </div>
        <div class="userResultWrapper qs-results" style="display:none;">
	    	<div class="resultBoxUser">
	            <div id="snippet--results" ></div>            
	 		</div>
			<div class="addClientBtnUser clear"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:adduser")) ?>" title="Add Client"></a></div>
		</div>	
        <div class="checkoutBtnUser floatRight"><a href="#" onclick="sms.checkout.show_checkout_step_1(); return false;" title="Checkout"></a></div>
        <div class="clear"></div>
        </div>
	
    	<div class="userWrapper">

        	<div class="popupBox">
<?php if ($searching): ?>
                <div class="popupHdrBar">                	
                    <h4>Search Results: User</h4>
                </div>
                
                <div class="clientName">
                <?php echo TemplateHelpers::escapeHtml($search) ?>

                </div>
            	<div class="notes"><p><?php echo TemplateHelpers::escapeHtml($num_results) ?> results</p></div>
            	<script type="text/javascript">

        $('.searchBoxUser input').attr({'autocomplete':'off'})
        	.focus()
        	.bind('keydown', { url: <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchuser")) ?>}, sms.quicksearch.keydown)	
        	.bind('keyup', { url: <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchuser")) ?>}, sms.quicksearch.keyup);

        sms.quicksearch.url = <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchuser")) ?>;

        </script>
<?php endif ?>
                
                <div class="transactionsBox">
						<ul class="purpleBar">
                        	<li>
                            <span class="clName"><p><a href=<?php echo TemplateHelpers::escapeHtml($control->link("Profile:search", array('search' => $search, 'page' => 0, 'order' => $presenter->createOrderString('name')))) ?>>Client Name<?php if ($order_column == 'name'): ?>&nbsp;<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/<?php if ($presenter->getOrderDir('name') == 'DESC'): ?>down<?php else: ?>up<?php endif ?>-white-arrow.png" width="7" height="4" alt="Sort Down"><?php endif ?></a></p></span>
                            <span class="stylistName"><p>Phone Number(s)</p></span>
                            <span class="transaction"><p><a href=<?php echo TemplateHelpers::escapeHtml($control->link("Profile:search", array('search' => $search, 'page' => 0, 'order' => $presenter->createOrderString('last_transaction_date')))) ?>>Last Transaction<?php if ($order_column == 'last_transaction_date'): ?>&nbsp;<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/<?php if ($presenter->getOrderDir('last_transaction_date') == 'DESC'): ?>down<?php else: ?>up<?php endif ?>-white-arrow.png" width="7" height="4" alt="Sort Down"><?php endif ?></a></p></span>
                            <span class="editBtns"><p></p></span>

                            </li>
                        </ul>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($users) as $user): ?>
                        <ul class="row<?php if (($iterator->isOdd())): ?>White<?php else: ?>Grey<?php endif ?>">
                            <li>
                                <a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:edit", array('id'=>$user->uid))) ?>">
                                <span class="clName"><?php echo TemplateHelpers::escapeHtml($user->name) ?></span>
                                <span class="stylistName"><?php if (empty($user->phone_number)): ?>--<?php else: echo TemplateHelpers::escapeHtml($user->phone_number) ;endif ?></span>
                                <span class="transaction"><?php echo TemplateHelpers::escapeHtml($presenter->formatDate($user->last_transaction_date)) ?></span>

                                </a>
                                <div onclick='location.href=<?php echo TemplateHelpers::escapeHtmlJs($control->link("Profile:edit", array('id'=>$user->uid))) ?>' class="editBtns">
                                	
                                    <table cellpadding="0" cellspacing="0" class="yellowBtnHolder floatRight">
                                        <tr>
                                            <td class="yellowBtnLeft"></td>
                                            <td class="yellowBtnMid"><p>Edit&nbsp;Profile</p></td>
                                            <td class="yellowBtnRight"></td>
                                        </tr>

                                     </table>
                                    </a>
                                </div>
                             </li>
                	    </ul>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ;if ($num_results > $page_size): ?>
                    	<div class="paginationBar">

                        	<table cellpadding="0" cellspacing="0">
                            	<tr>
                                	<td width="130">
                                		<div class="prevPage">
                                			<a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:search", array('search' => $search,'page' => $page_prev, 'order' => $order))) ?>" title="Previous Page">
                                				<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/left-white-arrow.png" alt="Previous Page">&nbsp; Previous Page</a>
                                		</div>
                                	</td>
                                    <td width="780"  class="pagination">
                                    <?php if ($page == 0): ?>1<?php else: ?><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:search", array('search' => $search, 'page' => 0, 'order' => $order))) ?>">1</a><?php endif ?>

                                    <?php if ($page > 6): ?>...<?php endif ?>

<?php for ($i=($page - 6 < 0 ? 1 : $page - 6); $i < ($page + 6 > $max_page - 1 ? $max_page - 1 : $page + 6); $i++): ?>
                                    <?php if ($i == $page): echo TemplateHelpers::escapeHtml($i + 1) ;else: ?><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:search", array('search' => $search, 'page' => $i, 'order' => $order))) ?>"><?php echo TemplateHelpers::escapeHtml($i+1) ?></a><?php endif ?>

<?php endfor ?>
                                    <?php if ($page < $max_page - 7): ?>...<?php endif ?>

                                    <?php if ($page == $max_page - 1): echo TemplateHelpers::escapeHtml($max_page) ;else: ?><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:search", array('search' => $search, 'page' => $max_page - 1, 'order' => $order))) ?>"><?php echo TemplateHelpers::escapeHtml($max_page) ?></a><?php endif ?>

                                    </td>
                                    <td width="130"><div class="nextPage"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:search", array('search' => $search,'page' => $page_next, 'order' => $order))) ?>" title="Next Page">Next Page &nbsp;<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/right-white-arrow.png" alt="Next Page"></a></div></td>
                                </tr>
                            </table>
                        </div>

<?php endif ?>
       		  		</div>
            	</div>	
            <div class="clear"></div>

		</div>
<!-- END CLIENT AND SERVICE DETAILS -->
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
