<?php //netteCache[01]000260a:2:{s:4:"time";s:21:"0.57117000 1304622529";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:104:"/home/cpbeauty/public_html/salon/document_root/../app/templates/QuickSearch/quicksearch-small-wide.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/QuickSearch/quicksearch-small-wide.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'bf9c35a452'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
} if ($_cb->foo = SnippetHelper::create($control, "wideresults")) { $_cb->snippets[] = $_cb->foo ;foreach ($iterator = $_cb->its[] = new SmartCachingIterator($results) as $res): ?>
<div class="checkoutResultUser" id="res-<?php echo TemplateHelpers::escapeHtml($res->uid) ?>"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:order", array('uid' => $res->uid))) ?>"><?php echo $res->title_hl ?></a></div>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
<div class="clear"></div>
<?php array_pop($_cb->snippets)->finish(); } if (SnippetHelper::$outputAllowed) { 
}
