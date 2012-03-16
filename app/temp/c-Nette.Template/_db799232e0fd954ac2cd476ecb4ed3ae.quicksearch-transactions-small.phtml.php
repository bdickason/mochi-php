<?php //netteCache[01]000266a:2:{s:4:"time";s:21:"0.36828300 1279034990";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:110:"/home/insitu/public_html/salon/document_root/../app/templates/QuickSearch/quicksearch-transactions-small.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/QuickSearch/quicksearch-transactions-small.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '9c9e14a1e7'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
} if ($_cb->foo = SnippetHelper::create($control, "results")) { $_cb->snippets[] = $_cb->foo ;foreach ($iterator = $_cb->its[] = new SmartCachingIterator($results) as $res): ?>
<div class="searchResultUser" id="res-<?php echo TemplateHelpers::escapeHtml($res->transaction_id) ?>"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:order", array('uid' => null, 'transaction_id' => $res->transaction_id))) ?>"><strong>#</strong><?php echo $res->title_hl ?> - <?php echo TemplateHelpers::escapeHtml($res->date) ?>, <?php echo TemplateHelpers::escapeHtml($res->transaction_client_name) ?></a></div>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ;if (count($results) == 0): ?>
<div class="searchResultUser" id="res-none"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search")) ?>">No transaction found. Click to list all.</a></div>
<?php else: ?>
<div class="searchResultUserMore" id="res-all"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Checkout:search", array('search' => $search))) ?>">See all <?php echo TemplateHelpers::escapeHtml($total) ?> results</a></div>
<?php endif ?>
<div class="clear"></div>
<?php array_pop($_cb->snippets)->finish(); } if (SnippetHelper::$outputAllowed) { 
}
