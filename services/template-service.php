<?php

function view(string $path, array $vars = []): string
{

	if (!preg_match('/^[0-9A-Za-z-_\/]+$/', $path))
	{
		throw new Exception('invalid page address');
	}

	$absolutePath = ROOT . "/views/$path.php";

	if (!file_exists($absolutePath))
	{
		throw new Exception('template not found');
	}

	extract($vars, EXTR_OVERWRITE);

	ob_start();
	require $absolutePath;
	return ob_get_clean();
}

function truncate(string $str, ?int $maxLength = null) :string
{
	if ($maxLength === null || $maxLength > strlen($str))
	{
		return $str;
	}

	$cropped = substr($str,0, $maxLength);
	return $cropped . '...';
}