<?php

function getConfig() :array
{
	return require ROOT . '/config.php';
}

function getConfigOption(string $str, $default = null)
{
	static $config = null;
	if ($config === null)
	{
		$config = getConfig();
	}
	if(array_key_exists($str, $config))
	{
		return $config[$str];
	}
	if ($default !== null)
	{
		return $default;
	}

	throw new Exception("Config option {$str} not found");
}