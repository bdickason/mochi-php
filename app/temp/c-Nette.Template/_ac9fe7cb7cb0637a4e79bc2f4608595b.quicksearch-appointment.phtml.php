<?php //netteCache[01]000259a:2:{s:4:"time";s:21:"0.95843300 1276921858";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:103:"/home/insitu/public_html/salon/document_root/../app/templates/QuickSearch/quicksearch-appointment.phtml";i:2;i:1276920425;}}}?><?php
// file …/templates/QuickSearch/quicksearch-appointment.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '51d2923a3a'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
} if ($_cb->foo = SnippetHelper::create($control, "appointmentresults")) { $_cb->snippets[] = $_cb->foo ;foreach ($iterator = $_cb->its[] = new SmartCachingIterator($results) as $res): ?>
<div class="searchResult resultItem" id="res-<?php echo TemplateHelpers::escapeHtml($res->uid) ?>"><a href="#"><?php echo $res->title_hl ?>&nbsp;&nbsp;&nbsp;<span style="font-size:12px;"><?php echo TemplateHelpers::escapeHtml($res->phone_primary_number) ?></span></a></div>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ;if (count($results) > 6): ?>
<div class="searchResult resultItem" id="res-all">Too many results, refine your search.</div>
<?php endif ?>
<div class="clear"></div>
<div class="addClientBtn resultItem" id="res-add"><h3><a href="<?php echo TemplateHelpers::escapeHtml($control->link("Profile:adduser")) ?>" title="Add New Client">Add New Client</a></h3></div>

<?php array_pop($_cb->snippets)->finish(); } if (SnippetHelper::$outputAllowed) { 
}
