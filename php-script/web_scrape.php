<?php
	
	$url = 'http://www.washingtonpost.com/world/national-security/cia-rushed-to-save-diplomats-as-libya-attack-was-underway/2012/11/01/c93a4f96-246d-11e2-ac85-e669876c6a24_story.html?hpid=z1';

	$file = file_get_contents($url);
	
	$start = "<div blah blah";
	$dom = new DOMDocument();
	@$dom->loadHTML($file);
	var_dump($dom);
	$domx = new DOMXPath($dom);
	
?>