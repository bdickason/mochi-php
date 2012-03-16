<?php //netteCache[01]000231a:2:{s:4:"time";s:21:"0.92589900 1276921393";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:76:"/home/insitu/public_html/salon/document_root/../app/templates//@layout.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates//@layout.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'ab464cd6d3'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Mochi!</title>
<meta name="ROBOTS" content="NOINDEX,NOFOLLOW"> 
<link href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/style.css?1.1" rel="stylesheet" type="text/css">
<link href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/ext/redmond/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css">
<!--  load libraries -->
<script src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("jquery", "1.4.2");
</script>
<script src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/sms.core.js?1.21"></script>
<script src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/ext/jquery-ui-1.7.2.custom.min.js"></script>
</head>
<body>

	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-16511681-1']);
	  _gaq.push(['_setDomainName', '.getmochi.com']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>


<div id="loading" style="z-index:500;display:none;position:absolute;top:0px;left:0px;">
<img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/loading.gif">
</div>
<div class="container">
   
    	<div class="adminBar" style="height:34px;">
        	<div class="busName"><h1><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Default:default")) ?>" title="Go To Home Page">Get <strong>Mochi</strong></a></h1></div>
<?php if (isset($user)): ?>
            <div class="adminBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Reports:daily")) ?>" title="View Reports">Reports</a></div>
            <div class="adminBtn"><a href="javascript:alert('Not implemented. Patience, young Jedi!');" title="Admininstrative Tools">Admin</a></div>            
            <div class="adminBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search")) ?>" title="List All Transactions">Transactions</a></div>
            <div class="adminBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:search")) ?>" title="List All Clients">Clients</a></div>
            <div class="adminBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Calendar:home")) ?>" title="Calendary &amp; Booking">Calendar</a></div>
            <div class="adminPrefsTxt">
	            <a href="javascript:alert('Not implemented. Patience, young Jedi!');" title="My Preferences" class="greyLink">My Preferences</a> &nbsp;&nbsp;&nbsp;            
	            <a href="<?php echo TemplateHelpers::escapeHtml($control->link("logout")) ?>" title="Log Out" class="greyLink">Log Out</a>
            </div>           
            <div class="adminName">Hi <?php echo TemplateHelpers::escapeHtml($user['name']) ?>!</div>
            <div class="clear"></div>
<?php endif ?>
        </div>
    
    <?php } LatteMacros::callBlock($_cb->blocks, 'content', get_defined_vars()) ;if (SnippetHelper::$outputAllowed) { ?> 
</div>   
<script type="text/javascript">
$(document).ready(function() {
	sms.seamless.init();
});
</script>

</body>
</html><?php
}
