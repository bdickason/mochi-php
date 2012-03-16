<?php //netteCache[01]000245a:2:{s:4:"time";s:21:"0.83872500 1276979387";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:90:"/home/insitu/public_html/salon/document_root/../app/templates/Checkout/receipt-print.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/Checkout/receipt-print.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '4bc3ffc02f'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbbbcb81f895a_title')) { function _cbbbcb81f895a_title() { extract(func_get_arg(0))
;if (SnippetHelper::$outputAllowed) { ?>
RECEIPT - TRANSACTION # <?php echo TemplateHelpers::escapeHtml($transaction_code) ?>

<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbba4c65a2f47_content')) { function _cbba4c65a2f47_content() { extract(func_get_arg(0))
;if (SnippetHelper::$outputAllowed) { ?>
<div>        	
       		<div class="popupBox">
       		     <div class="busName">Insitu Beauty Lounge</div>       		      
                 <div class="popupPurpleBar">
                    <h4><?php if ($transaction_void): ?>VOID - <?php endif ?>RECEIPT - TRANSACTION # <?php echo TemplateHelpers::escapeHtml($transaction_code) ?></h4>
                </div>
                       		            	                
                <div class="clientName"><?php echo TemplateHelpers::escapeHtml($client_name) ?></div>
                <div class="notes"><p><?php echo TemplateHelpers::escapeHtml($presenter->formatDate($transaction_update_date, 'M j, Y - h:m A')) ?></p></div>
<?php if (count($services) > 0): ?>
            	<div class="transactionsBox">
                        	<div class="darkGreyBar">
                            	<p>Services Received</p>
                                <div class="clear"></div>

                            </div>
                            
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($services) as $service): ?>
                            <div class="itemRow">
                            	<div class="confirmTrans">
                            		<div class="ltGreyBar"><p>Service</p></div>
                                	<div class="checkedInClients">
	                                	<table cellpadding="0" cellspacing="0" width="100%">
	                                            <tr>
	                                                <td><div class="pricepoint"><?php echo TemplateHelpers::escapeHtml($service->service_name) ?> - <?php echo TemplateHelpers::escapeHtml($service->stylist_name) ?></div></td>
	                                            	<td><div class="pricetag">$<?php echo TemplateHelpers::escapeHtml($service->price) ?></div></td>
	                                        	</tr>
	                                        </table>
                          			</div>
                            	</div>
                           
                            	<div class="clear"></div>
                            </div>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
                            <div>
                            	<table cellpadding="0" cellspacing="0" width="100%" class="bordertop">
                                	<tr>
                                        <td><div class="subtotalTxtConfirm">Services Subtotal:</div></td>
                                        <td><div class="subtotalNum">$<?php echo TemplateHelpers::escapeHtml($services_subtotal) ?></div></td>
                                        <div class="clear"></div>
                                	</tr>

                                </table>
                            </div>
                            
                        </div>
<?php endif ;if (count($products) > 0): ?>
                        <div class="transactionsBox">
                        	<div class="darkGreyBar">
                            	<p>Products Purchased</p>
                                <div class="clear"></div>
                            </div>

<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($products) as $product): ?>
                            <div class="itemRow">
                            	<div class="confirmTrans">
                            		<div class="ltGreyBar"><p>Product Name</p></div>
                                	<div class="checkedInClients">
                                	<div class="checkedInClients">
                            			<table cellpadding="0" cellspacing="0" width="100%">
                                            	<tr> 
                            						<td><div class="pricepoint"><?php echo TemplateHelpers::escapeHtml($product->product_name_raw) ;if ($product->quantity > 1): ?> x<?php echo TemplateHelpers::escapeHtml($product->quantity) ;endif ?></div></td>
                                                    <td><div class="pricetag">$<?php echo TemplateHelpers::escapeHtml($product->price) ?></div></td>
                                        		</tr>
                                        </table>
                                    </div>
                          			</div>                                    
                            	</div>
                            	
                            	<div class="clear"></div>

                            </div>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
                                                        
                            	<div>
                            	<table cellpadding="0" cellspacing="0" width="100%" class="bordertop">
                                	<tr>
                                        <td><div class="subtotalTxtConfirm">Products Subtotal:</div></td>
                                        <td><div class="subtotalNum">$<?php echo TemplateHelpers::escapeHtml($products_subtotal) ?></div></td>
                                        <div class="clear"></div>
                                	</tr>
                                </table>

                            </div>
                            
                        </div>
<?php endif ?>
                        <div class="transactionsBox">
                        	<div class="darkGreyBar">
                            	<p>The Bottom Line</p>
                                <div class="clear"></div>
                            </div>
                            
                            <div>

                            	<table cellpadding="0" cellspacing="0" width="100%">
                                	<tr>
                                        <td><div class="subtotalTxtConfirm">Subtotal:</div></td>
                                        <td><div class="subtotalNum">$<?php echo TemplateHelpers::escapeHtml($subtotal) ?></div></td>
                                        <div class="clear"></div>
                                	</tr>
                                </table>
                            </div>

                            
                            	<div>
                            	<table cellpadding="0" cellspacing="0" width="100%">
                                	<tr>
                                        <td><div class="subtotalTxtConfirm">Taxes:</div></td>
                                        <td><div class="subtotalNum">$<?php echo TemplateHelpers::escapeHtml($taxes) ?></div></td>
                                        <div class="clear"></div>
                                	</tr>
                                </table>

                            </div>
                            
                            	<div class="grandTotal">
                                	<table cellpadding="0" cellspacing="0" width="100%">
                                    	<tr>
                                        	<td><div class="purpleBarCheckout"><h5>GRAND TOTAL</h5></div></td>
                                            <td><div class="purpleBarCheckout"><h4>$<?php echo TemplateHelpers::escapeHtml($grand_total) ?></h4></div></td>
                                    	</tr>
                                    </table>

                            	</div>
                            
                            	<div class="clear"></div>
                        </div>
        		</div>        
        </div>

<?php
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
} if (!$_cb->extends) { call_user_func(reset($_cb->blocks['title']), get_defined_vars()); } ?>

<?php } if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
