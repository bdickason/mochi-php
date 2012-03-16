<?php //netteCache[01]000246a:2:{s:4:"time";s:21:"0.86753000 1311851144";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:91:"/srv/www/bloom.getmochi.com/public_html/document_root/../app/templates/Checkout/order.phtml";i:2;i:1311820097;}}}?><?php
// file …/templates/Checkout/order.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '7d3cd0344c'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb592d8556fb_content')) { function _cbb592d8556fb_content() { extract(func_get_arg(0))
;if (SnippetHelper::$outputAllowed) { ?>
<div class="popupBG transactionForm">
        	<div class="popupBorder">
       		<div class="popupBox">
       		
<?php if (($transaction_type == 'finalized')): ?>
       		<div class="ReceiptHome floatLeft"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Default:")) ?>" title="Back To Home"></a></div>
            <div class="ReceiptPrint floatLeft"><a target="_blank" href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:receiptPrint", array('transaction_id' => $transaction_id))) ?>" title="Print Receipt"></a></div>
            <div class="clear"></div>
<?php endif ?>
       			
                <div class="popupPurpleBar">
                	<div class="closeBtnPurple"><a href="<?php if ($transaction_type == 'new'): echo TemplateHelpers::escapeHtml($control->link("Default:")) ;else: echo TemplateHelpers::escapeHtml($control->link("Checkout:cancelTransaction", array('transaction_id' => $transaction_id))) ;endif ?>" onclick="return confirm('Do you really want to <?php if ($transaction_type == 'finalized'): if ($transaction_void): ?>unvoid<?php else: ?>void<?php endif ;else: ?>cancel<?php endif ?> this transaction?');">
                	<?php if ($transaction_type == 'finalized'): if ($transaction_void): ?>Unvoid<?php else: ?>Void<?php endif ?> Transaction<?php else: ?>Cancel Transaction<?php endif ?>

                	</a></div>
                    <h4><?php if ($transaction_type == 'finalized'): if ($transaction_void): ?>VOID - <?php endif ?>TRANSACTION #<?php echo TemplateHelpers::escapeHtml($transaction_code) ;else: ?>CHECKOUT<?php endif ?></h4>

                </div>
                
                <div class="clientName"><?php echo TemplateHelpers::escapeHtml($client_name) ?></div>
            	<div class="notes"><p>Select the Services and/or Products purchased by this Client.</p></div>
<?php } if ($_cb->foo = SnippetHelper::create($control, "client")) { $_cb->snippets[] = $_cb->foo ;$control->getWidget("transactionForm")->render('begin') ?>
                <div class="form transactionsBox services">
                        <div class="darkGreyBar">
                            <p>What Services did this Client receive?</p>
                                <div class="clear"></div>

                            </div>
<?php for ($i=1;$i<=$total_service_count;$i++): ?>
                            <div class="itemRow" id="service-cont-<?php echo TemplateHelpers::escapeHtml($i) ?>" <?php if ($used_service_count < $i): ?>style="display:none;"<?php endif ?>>
                            <div class="category">
                            <div class="ltGreyBar"><p>Service</p></div>
                                <div class="checkedInClients service"> 
                            	<?php echo TemplateHelpers::escapeHtml($control['transactionForm']['service' . $i]->control) ?>

                          	</div>
                            </div>
                            
                            <div class="category">
                            <div class="ltGreyBar"><p>Stylist</p></div>
                                <div class="checkedInClients stylist"> 
                            	<?php echo TemplateHelpers::escapeHtml($control['transactionForm']['stylist' . $i]->control) ?>

                          	</div>
                            </div>
                            
                            <div class="pricetag">
                            	<div class="ltGreyBar"><h5>Price</h5></div>
                                <div class="pricepoint">$<?php echo TemplateHelpers::escapeHtml($control['transactionForm']['sprice' . $i]->control) ?></div>
                            </div>
                            
                            <div id="rem-service-<?php echo TemplateHelpers::escapeHtml($i) ?>" class="deleteBtnFloat<?php if ($used_service_count == 1): ?>NA<?php endif ?>"><a href="#" onclick="sms.order.removeService(<?php echo TemplateHelpers::escapeHtmlJs($i) ?>); return false;" title="Void This"></a></div>
                            
                            <div id="add-service-<?php echo TemplateHelpers::escapeHtml($i) ?>" class="addNewItem" <?php if ($i != $used_service_count): ?>style="display:none;"<?php endif ?>>
                            <table width="100%" cellpadding="0" cellspacing="0" class="yellowBtnHolder">
                            	<tr>
                                	<td class="yellowBtnLeft"></td>
                                    <td class="yellowBtnMid" onclick="sms.order.addService(<?php echo TemplateHelpers::escapeHtmlJs($i) ?>); return false;"><h4>+ Add Service</h4></td>
                                    <td class="yellowBtnRight"></td>
                                </tr>
                             </table>                             		
                            </div>
                            <div class="clear"></div>
                            </div>
<?php endfor ?>
                            <div>
                            <div class="subtotalTxt">Services Subtotal:</div>

                                <div class="subtotalNum" id="services_sum">$0</div>
                                <div class="clear"></div>
                            </div>
                            
                       </div>
                        
                        <div class="transactionsBox form products">
                        	<div class="darkGreyBar">
                            	<p>What Products did this Client purchase?</p>
                                <div class="clear"></div>

                            </div>
<?php for ($i=1;$i<=$total_product_count;$i++): ?>
                            <div class="itemRow" id="product-cont-<?php echo TemplateHelpers::escapeHtml($i) ?>" <?php if ($used_product_count < $i): ?>style="display:none;"<?php endif ?>>
                            	<div class="category">
                            		<div class="ltGreyBar"><p>Product Name</p></div>
                                	<div class="checkedInClients product"> 
                            			<?php echo TemplateHelpers::escapeHtml($control['transactionForm']['product' . $i]->control) ?>

                          			</div>
                            	</div>
                            	
                            	<div class="qty">
                            		<div class="ltGreyBar"><h5>QTY</h5></div>
                                	<div class="checkedInClients quantity"> 
                            			<?php echo TemplateHelpers::escapeHtml($control['transactionForm']['pqty' . $i]->control) ?>

                          			</div>
                            	</div>
                            	
                            
                            	<div class="category">
                            		<div class="ltGreyBar"><p>Product sold by</p></div>
                                	<div class="checkedInClients"> 
                            			<?php echo TemplateHelpers::escapeHtml($control['transactionForm']['user' . $i]->control) ?>

                          			</div>
                            	</div>
                            
                            	<div class="pricetag">

                            		<div class="ltGreyBar"><h5>Price</h5></div>
                                	<div class="pricepoint">$<?php echo TemplateHelpers::escapeHtml($control['transactionForm']['pprice' . $i]->control) ?></div>
                            	</div>
                            	
                            	<div id="rem-product-<?php echo TemplateHelpers::escapeHtml($i) ?>" class="deleteBtnFloat<?php if ($used_product_count == 1): ?>NA<?php endif ?>"><a href="#" onclick="sms.order.removeProduct(<?php echo TemplateHelpers::escapeHtmlJs($i) ?>); return false;" title="Void This"></a></div>
                            	                            	
                            	<div id="add-product-<?php echo TemplateHelpers::escapeHtml($i) ?>" class="addNewItem"  <?php if ($i != $used_product_count): ?>style="display:none;"<?php endif ?>>
                            		<table width="100%" cellpadding="0" cellspacing="0" class="yellowBtnHolder">
                            			<tr>
                                			<td class="yellowBtnLeft"></td>
                                    		<td class="yellowBtnMid" onclick="sms.order.addProduct(<?php echo TemplateHelpers::escapeHtmlJs($i) ?>); return false;"><h4>+ Add Product</h4></td>
                                    		<td class="yellowBtnRight"></td>
                                		</tr>
                             		</table>
                            	</div>                           
                            	<div class="clear"></div>                            	
                            </div>
<?php endfor ?>
                            
                            <div>
                            	<div class="subtotalTxt">Products Subtotal:</div>
                                <div class="subtotalNum" id="products_sum">$0</div>
                                <div class="clear"></div>
                            </div>

                            
                        </div>
                        
                        <div class="transactionsBox form finalize">
                        	<div class="darkGreyBar">
                            	<p>Finalize Transaction</p>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="itemRow">

                            	<div class="category">
                            		<div class="ltGreyBar"><p>Does the Client have a Promotional Code?</p></div>
                                	<div class="promoCode">
                						<input disabled="true" name="search" value="Unavailable">
                        				<div class="clear"></div>
                					</div>
                            	</div>
                            	
                            	<div class="finalPrice">
                            		<div class="ltGreyBar"><h5>Payment Method</h5></div>
                                	<div class="checkedInClients"> 
                            			<?php echo TemplateHelpers::escapeHtml($control['transactionForm']['payment_type']->control) ?>

                          			</div>
                            	</div>
                            	
                            
                            	<div class="finalPrice">

                            		<div class="ltGreyBar"><p>Subtotal</p></div>
                                	<div class="checkedInClients"> 
                            			<div class="pricepoint" id="subtotal">$0</div>
                          			</div>
                            	</div>
                            
                            	<div class="pricetag">
                            		<div class="ltGreyBar"><h5>Taxes</h5></div>
                                	<div class="pricepoint" id="taxes">$0</div>

                            	</div>
                            
                            	<div class="grandTotal">
                            		<div class="purpleBarCheckout"><h5>GRAND TOTAL</h5><h4 id="grand_total">$0</h4></div>
                            	</div>
                            
                            	<div class="clear"></div>
                            </div>
                            
                            <div class="checkoutProceed"><a href="#" onclick="sms.order.submit(); return false;" title="Proceed to Confirmation Screen"></a></div>
                            
                        </div>
<?php $control->getWidget("transactionForm")->render('end') ;array_pop($_cb->snippets)->finish(); } if (SnippetHelper::$outputAllowed) { ?>
        		</div>
            </div>
        </div>
        <script type="text/javascript">
		var formPrefix = 'frmtransactionForm-';
        
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($service_price_map) as $id => $price): ?>
			sms.order.service_map[<?php echo TemplateHelpers::escapeJs($id) ?>] = <?php echo TemplateHelpers::escapeJs($price) ?>;			
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>

<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($product_price_map) as $id => $price): ?>
			sms.order.product_map[<?php echo TemplateHelpers::escapeJs($id) ?>] = <?php echo TemplateHelpers::escapeJs($price) ?>;
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>

			sms.order.tax_ratio_services = <?php echo TemplateHelpers::escapeJs($tax_ratio_services) ?>;
			sms.order.tax_ratio_products = <?php echo TemplateHelpers::escapeJs($tax_ratio_products) ?>;
	        sms.order.init();
			
	       
	        
	       
        </script>
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
