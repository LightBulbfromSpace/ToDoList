<?php


function getMenuData(?int $time = null) :array
{
	$time = $time ?? time();
	$dayBefore = $time - 86400;
	$dayAfter = $time + 86400;

	return [
		['url' => '?date=' . date('Y-m-d', $dayBefore), 'text' => 'Previous day'],
		['url' => '/', 'text' => 'Today'],
		['url' => '/report.php', 'text' => 'Report'],
		['url' => '?date=' . date('Y-m-d', $dayAfter), 'text' => 'Next day'],
	];
}