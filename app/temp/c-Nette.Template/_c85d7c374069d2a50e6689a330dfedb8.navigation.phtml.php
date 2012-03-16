<?php //netteCache[01]000243a:2:{s:4:"time";s:21:"0.13319200 1303002078";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:88:"/home/cpbeauty/public_html/salon/document_root/../app/templates/Reports/navigation.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/Reports/navigation.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '7a6d1ae010'); unset($_extends);

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
