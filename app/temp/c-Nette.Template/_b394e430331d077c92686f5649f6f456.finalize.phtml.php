<?php //netteCache[01]000240a:2:{s:4:"time";s:21:"0.51804600 1276962906";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:85:"/home/insitu/public_html/salon/document_root/../app/templates/Checkout/finalize.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/Checkout/finalize.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '2108146a8a'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb9c8eefed9b_content')) { function _cbb9c8eefed9b_content() { extract(func_get_arg(0))
;if (SnippetHelper::$outputAllowed) { ?>
<div class="popupBG">
        	<div class="popupBorder">
       		<div class="popupBox">
            	
                <div class="popupPurpleBar">
                	<div class="closeBtnPurple"><a href="<?php if ($transaction_type == 'new'): echo TemplateHelpers::escapeHtml($control->link("Default:")) ;else: echo TemplateHelpers::escapeHtml($control->link("Checkout:cancelTransaction", array('transaction_id' => $transaction_id))) ;endif ?>" onclick="return confirm('Do you really want to <?php if ($transaction_type == 'finalized'): if ($transaction_void): ?>unvoid<?php else: ?>void<?php endif ;else: ?>cancel<?php endif ?> this transaction?');">
                	<?php if ($transaction_type == 'finalized'): if ($transaction_void): ?>Unvoid<?php else: ?>Void<?php endif ?> Transaction<?php else: ?>Cancel Transaction<?php endif ?>

                	</a></div>
                    <h4>CONFIRM TRANSACTION</h4>
                </div>
                
                <div class="clientName"><A HREF="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:edit", array('id' => $transaction_uid))) ?>"><?php echo TemplateHelpers::escapeHtml($client_name) ?></a></div>
                <div class="notes"><p>Confirm the Services and/or Products purchased by this Client.</p></div>
                
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
                            			<div class="pricepoint"><?php echo TemplateHelpers::escapeHtml($service->service_name) ?></div>
                          			</div>
                            	</div>

                            
                            	<div class="confirmTrans">
                            		<div class="ltGreyBar"><p>Stylist</p></div>
                                	<div class="checkedInClients"> 
                            			<div class="pricepoint"><?php echo TemplateHelpers::escapeHtml($service->stylist_name) ?></div>
                          			</div>
                            	</div>
                            
                            	<div class="pricetag">
                            		<div class="ltGreyBar"><h5>Price</h5></div>

                                	<div class="pricepoint">$<?php echo TemplateHelpers::escapeHtml($service->price) ?></div>
                            	</div>
                            
                            	<div class="clear"></div>
                            </div>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
                            <div>
                            	<div class="subtotalTxtConfirm">Services Subtotal:</div>
                                <div class="subtotalNum">$<?php echo TemplateHelpers::escapeHtml($services_subtotal) ?></div>

                                <div class="clear"></div>
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
                            	<div class="confirmTrans" style="width:374px;">
                            		<div class="ltGreyBar"><p>Product Name</p></div>
                                	<div class="checkedInClients"> 
                            			<div class="checkedInClients"> 
                            			<div class="pricepoint"><?php echo TemplateHelpers::escapeHtml($product->product_name) ?></div>
                          			</div>
                          			</div>                                    
                            	</div>
                            	 <div class="confirmTrans qty">
                            		<div class="ltGreyBar"><h5>QTY</h5></div>
                                	<div class="checkedInClients"> 
                            			<div class="pricepoint" style="text-align:center;"><?php echo TemplateHelpers::escapeHtml($product->quantity) ?></div>
                          			</div>
                            	</div>
                            	
                            	<div class="confirmTrans">
                            		<div class="ltGreyBar"><p>Product sold by</p></div>
                                	<div class="checkedInClients"> 
                            			<div class="checkedInClients"> 
                            			<div class="pricepoint"><?php echo TemplateHelpers::escapeHtml($product->user_name) ?></div>

                          			</div>
                          			</div>                                    
                            	</div>                            
                            	<div class="pricetag">
                            		<div class="ltGreyBar"><h5>Price</h5></div>
                                	<div class="pricepoint">$<?php echo TemplateHelpers::escapeHtml($product->price) ?></div>                                    
                            	</div>
                            
                            	<div class="clear"></div>

                            </div>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
                            <div>
                            	<div class="subtotalTxtConfirm">Products Subtotal:</div>
                                <div class="subtotalNum">$<?php echo TemplateHelpers::escapeHtml($products_subtotal) ?></div>
                                <div class="clear"></div>
                            </div>
                            
                        </div>
<?php endif ?>
                        <div class="transactionsBox">

                        	<div class="darkGreyBar">
                            	<p>The Bottom Line</p>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="itemRow">
                            	<div class="category">
                            		<div class="ltGreyBar"><p>Promotional Code?</p></div>
                                	<div class="checkedInClients"> 
                            			<div class="pricepoint">Unavailable</div>

                          			</div>
                            	</div>
                            	
                            	<div class="finalPrice">
                            		<div class="ltGreyBar"><h5>Payment Method</h5></div>
                                	<div class="checkedInClients"> 
                            			<?php echo TemplateHelpers::escapeHtml($payment_type) ?>

                          			</div>
                            	</div>
                            
                            	<div class="finalPrice">
                            		<div class="ltGreyBar"><p>Subtotal</p></div>
                                	<div class="checkedInClients"> 
                            			<div class="pricepoint">$<?php echo TemplateHelpers::escapeHtml($subtotal) ?></div>
                          			</div>
                            	</div>

                            
                            	<div class="pricetag">
                            		<div class="ltGreyBar"><h5>Taxes</h5></div>
                                	<div class="pricepoint">$<?php echo TemplateHelpers::escapeHtml($taxes) ?></div>
                            	</div>
                            
                            	<div class="grandTotal">
                            		<div class="purpleBarCheckout"><h5>GRAND TOTAL</h5><h4>$<?php echo TemplateHelpers::escapeHtml($grand_total) ?></h4></div>
                            	</div>

                            
                            	<div class="clear"></div>
                            </div>
                            
                            <div class="ConfirmTransaction floatLeft"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:confirm", array('transaction_id' => $transaction_id))) ?>" title="Confirm Transaction"></a></div>
                        	<div class="GoBackMakeChanges floatLeft"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:order", array('transaction_id' => $transaction_id))) ?>" title="Go Back and Make Changes"></a></div>
                            <div class="clear"></div>
                            
                        </div>
            	
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
} if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
