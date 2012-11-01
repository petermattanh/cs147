<?php
	$url = 'http://www.economist.com/news/united-states/21565628-week%E2%80%99s-storm-showed-american-crisis-management-its-best-yet-raised-questions';

	$rawHtml = file_get_contents($url);
	//echo $rawHtml;
	$startTagOfBody = '<div id="ec-article-body" class="clearfix">';
	$endTagOfBody = '</div> <!-- /#ec-article-body -->';

	$start = strpos($rawHtml, $startTagOfBody);
	$end = strpos($rawHtml, $endTagOfBody, $start) + strlen($endTagOfBody);
 
	$extractedHtml = substr($rawHtml, $start, $end-$start);
	phpinfo();
?>