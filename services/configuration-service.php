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
		$masterConfig = require ROOT . '/config.php';;
		if (file_exists(ROOT . '/config.local.php'))
		{
			$localConfig = require ROOT . '/config.local.php';
		}
		else
		{
			$localConfig = [];
		}
		$config = array_merge($masterConfig, $localConfig);
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