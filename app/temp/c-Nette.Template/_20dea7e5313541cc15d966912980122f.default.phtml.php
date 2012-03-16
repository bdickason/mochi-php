<?php //netteCache[01]000242a:2:{s:4:"time";s:21:"0.26339400 1276920525";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:87:"/home/insitu/public_html/salon-new/document_root/../app/templates/Default/default.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/Default/default.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'f195c843cf'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb256308f579_content')) { function _cbb256308f579_content() { extract(func_get_arg(0))
;LatteMacros::includeTemplate("../Checkout/find-user.phtml", $template->getParams(), $_cb->templates['f195c843cf'])->render() ?>
<!-- START CHECKOUT AND SEARCH -->
    	<div class="wrapperHome">
        	<div class="checkoutBtn"><a href="#" onclick="sms.checkout.show_checkout_step_1(); return false;" title="Checkout"></a></div>
            
            <div class="searchBox">
<?php $control->getWidget("searchForm")->render('begin') ?>
            	<?php echo TemplateHelpers::escapeHtml($control['searchForm']['q']->control) ?>

                <div class="searchBtn"><a href="#" onclick="$('form').submit();" title="Search"><div class="searchIcon"><img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/icon-search.png" width="51" height="54" alt="Search" /></div></a></div>
                <div class="clear"></div>
<?php $control->getWidget("searchForm")->render('end') ?>
            </div>            
            <div class="resultBox qs-results" style="display:none;">
            <div id="snippet--results"></div>        	
            </div>
            <div class="addClientBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:adduser")) ?>" title="Add Client"></a></div>
        </div>
    <!-- END CHECKOUT AND SEARCH -->

<script type="text/javascript">

$('.searchBox input').attr({'autocomplete':'off'})
	.focus()
	.bind('keydown', { url: <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchhome")) ?>}, sms.quicksearch.keydown)	
	.bind('keyup', { url: <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchhome")) ?>}, sms.quicksearch.keyup);

sms.quicksearch.url = <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchhome")) ?>;
</script><?php
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
