<?php //netteCache[01]000262a:2:{s:4:"time";s:21:"0.45448700 1311851068";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:106:"/srv/www/bloom.getmochi.com/public_html/document_root/../app/templates/QuickSearch/quicksearch-small.phtml";i:2;i:1311820099;}}}?><?php
// file …/templates/QuickSearch/quicksearch-small.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '7ed55694b3'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
} if ($_cb->foo = SnippetHelper::create($control, "results")) { $_cb->snippets[] = $_cb->foo ;foreach ($iterator = $_cb->its[] = new SmartCachingIterator($results) as $res): ?>
<div class="searchResultUser" id="res-<?php echo TemplateHelpers::escapeHtml($res->uid) ?>"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:edit", array('id' => $res->uid))) ?>"><?php echo $res->title_hl ?></a></div>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ;if (count($results) == 0): ?>
<div class="searchResultUser" id="res-none"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:search")) ?>">No users found. Click to see all users.</a></div>
<?php else: ?>
<div class="searchResultUserMore" id="res-all"><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:search", array('search' => $search))) ?>">See all <?php echo TemplateHelpers::escapeHtml($total) ?> results</a></div>
<?php endif ?>
<div class="clear"></div>
<?php array_pop($_cb->snippets)->finish(); } if (SnippetHelper::$outputAllowed) { 
}
