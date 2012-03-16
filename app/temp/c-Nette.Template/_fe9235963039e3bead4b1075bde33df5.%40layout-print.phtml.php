<?php //netteCache[01]000237a:2:{s:4:"time";s:21:"0.85322000 1276979387";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:82:"/home/insitu/public_html/salon/document_root/../app/templates//@layout-print.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates//@layout-print.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'bf67868b19'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php } LatteMacros::callBlock($_cb->blocks, 'title', get_defined_vars()) ;if (SnippetHelper::$outputAllowed) { ?></title>
<meta name="ROBOTS" content="NOINDEX,NOFOLLOW"> 
<link href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/style-print.css?1.1" rel="stylesheet" type="text/css">
<!--  load libraries -->
<script src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("jquery", "1.3.2");
google.load("jqueryui", "1.7.2");
</script>
<script src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/sms.core.js?1.1"></script>
</head>
<body>
	
    <?php } LatteMacros::callBlock($_cb->blocks, 'content', get_defined_vars()) ;if (SnippetHelper::$outputAllowed) { ?>    

<script type="text/javascript">
//window.print();
//window.close();
</script>

</body>
</html><?php
}
