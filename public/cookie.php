<?php

$pages = [
	'index.php' => 1,
	'report.php' => 1,
	'cookie.php' => 1,
];

echo '<pre>';
if(isset($_COOKIE['VISIT_COUNTER']))
{
	$pages = json_decode($_COOKIE['VISIT_COUNTER'], true);
	$pages['cookie.php'] += 1;
	var_export($pages);
}

setcookie('VISIT_COUNTER', json_encode($pages), [
	'expires' => strtotime('+30 days'),
	'secure' => true, // https only
	'httponly' => true, // http only
]);