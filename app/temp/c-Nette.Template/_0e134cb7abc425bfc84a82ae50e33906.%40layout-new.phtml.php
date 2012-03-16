<?php //netteCache[01]000244a:2:{s:4:"time";s:21:"0.44102500 1311824165";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:89:"/srv/www/bloom.getmochi.com/public_html/document_root/../app/templates//@layout-new.phtml";i:2;i:1311824147;}}}?><?php
// file …/templates//@layout-new.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'eb1961e995'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Mochi!</title>
<meta name="ROBOTS" content="NOINDEX,NOFOLLOW">
<link href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/sms-styles-v2.css?1.1" rel="stylesheet" type="text/css">
<link href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/ext/redmond/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css">
<!--  load libraries -->
<script src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("jquery", "1.4.2", { uncompressed:true });
</script>
<script src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/sms.core.js?1.21"></script>
<script src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/ext/jquery-ui-1.7.2.custom.min.js"></script>
</head>
<body>
<div id="loading" style="z-index:500;display:none;position:absolute;top:0px;left:0px;">
<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/loading.gif">
</div>
<div class="container">
   
    	<div class="adminBar">
        	<div class="busName"><p><a href="/" title="Go To Home Page">Get <strong>Mochi</strong></a></p></div>
<?php if (isset($user)): ?>
            <div class="adminBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Reports:daily")) ?>" title="View Reports">Reports</a></div>
            <div class="adminBtn"><a href="javascript:alert('Not implemented. Patience, young Jedi!');" title="Admininstrative Tools">Admin</a></div>            
            <div class="adminBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search")) ?>" title="List All Transactions">Transactions</a></div>
            <div class="adminBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:search")) ?>" title="List All Clients">Clients</a></div>
            <div class="adminBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Calendar:home")) ?>" title="Calendary &amp; Booking">Calendar</a></div>
            <div class="adminBtn"><a href="javascript:alert('Not implemented. Patience, young Jedi!');" title="My Preferences" class="greyLink">My Preferences</a></div>
            <div class="adminBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("logout")) ?>" title="Log Out" class="greyLink">Log Out</a></div>                        
            <div class="clear"></div>
<?php endif ?>
        </div>
        

    <!-- START TOP SEARCH AND CHECKOUT -->
<?php LatteMacros::includeTemplate("Checkout/find-user.phtml", $template->getParams(), $_cb->templates['eb1961e995'])->render() ?>
    	<div class="calSearchCheckBar">
        	<div class="calCheckoutBtn floatLeft">
            	<a href="<?php echo TemplateHelpers::escapeHtml($control->link("Calendar:home")) ?>" title="Calendar">
                	<div class="calIconBig floatLeft"></div>
                    <div class="calCheckoutBtnTxt floatLeft">Calendar</div>
                </a>
            </div>

            <div class="searchBox">
<?php $control->getWidget("searchForm")->render('begin') ?>
            	<?php echo TemplateHelpers::escapeHtml($control['searchForm']['q']->control) ?>

<?php $control->getWidget("searchForm")->render('end') ?>
                <div class="clear"></div>
            </div>
            <div class="resultBox qs-results" style="display:none;">
            <div id="snippet--results"></div>
            </div>

            <div class="calCheckoutBtn floatLeft">
            	<a href="#" onclick="sms.checkout.show_checkout_step_1(); return false;" title="Checkout">
                	<div class="checkoutIconBig floatLeft"></div>
                    <div class="calCheckoutBtnTxt floatLeft">Checkout</div>
              </a>
            </div>
        </div>


    <!-- END TOP SEARCH AND CHECKOUT -->

    <?php } LatteMacros::callBlock($_cb->blocks, 'content', get_defined_vars()) ;if (SnippetHelper::$outputAllowed) { ?> 
</div>
<script type="text/javascript">
$(document).ready(function() {
	sms.seamless.init();
});
</script>

<script type="text/javascript">

$('.searchBox input').attr({'autocomplete':'off'})
	.focus()
	.bind('keydown', { url: <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchhome")) ?>}, sms.quicksearch.keydown)
	.bind('keyup', { url: <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchhome")) ?>}, sms.quicksearch.keyup);

sms.quicksearch.url = <?php echo TemplateHelpers::escapeJs($control->link("QuickSearch:quicksearchhome")) ?>;
</script>

<script type="text/javascript">
 var gaq = gaq || []; gaq.push(['setAccount', 'UA-12019250-3']); gaq.push(['trackPageview']);

(function() { var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga); })();
</script>
</body>
</html><?php
}
