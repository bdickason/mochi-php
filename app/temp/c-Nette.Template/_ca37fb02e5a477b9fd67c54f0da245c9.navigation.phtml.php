<?php //netteCache[01]000241a:2:{s:4:"time";s:21:"0.87339500 1276969863";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:86:"/home/insitu/public_html/salon/document_root/../app/templates/Reports/navigation.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/Reports/navigation.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'b03e8d5c53'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>
<div style="margin-bottom:10px; margin-left:auto; margin-right:auto; width:400px;">
	<div style="float:left;" class="adminBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Reports:daily")) ?>" title="View Daily Summary">Daily Summary</a></div>
	<div style="float:left;" class="adminBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Reports:retail")) ?>" title="View Retail Report">Retail</a></div>
	<div style="float:left;" class="adminBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Reports:payrolls")) ?>" title="View Payroll">Payroll</a></div>
	<div style="float:left;" class="adminBtn"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Reports:merchant")) ?>" title="View Merchant">Merchant</a></div>
	<div class="clear"></div>
</div><?php
}
