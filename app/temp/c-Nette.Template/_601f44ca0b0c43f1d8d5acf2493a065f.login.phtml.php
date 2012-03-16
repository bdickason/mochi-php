<?php //netteCache[01]000242a:2:{s:4:"time";s:21:"0.60425800 1311822318";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:87:"/srv/www/bloom.getmochi.com/public_html/document_root/../app/templates/Auth/login.phtml";i:2;i:1311820096;}}}?><?php
// file …/templates/Auth/login.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '1436d1980f'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb7ed2d7166e_content')) { function _cbb7ed2d7166e_content() { extract(func_get_arg(0))
?>
<div class="wrapperHome">
<div class="loginbox">
<?php $control->getWidget("loginForm")->render('begin') ?>
<div>
<div class="searchBox loginMargin">
	<div class="searchInputUser">
	<?php echo TemplateHelpers::escapeHtml($control['loginForm']['username']->control) ?>

	</div>
	 <div class="clear"></div>
	
</div>
</div>
	<div class="searchBox loginMargin">
		<div class="searchInputUser">
		<?php echo TemplateHelpers::escapeHtml($control['loginForm']['password']->control) ?>

		</div>
		 <div class="clear"></div>		
	</div>
<div style="clear:both;"></div>
<div class="loginbutton">
<?php echo TemplateHelpers::escapeHtml($control['loginForm']['login']->control) ?>

</div>
<?php $control->getWidget("loginForm")->render('end') ?>
</div>
</div><?php
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
extract(array('robots' =>'noindex')) ?>

<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
