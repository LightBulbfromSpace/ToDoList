<?php

class DatabaseException extends Exception {}

function getDbConnection() :mysqli
{
	static $connection = null;

	if ($connection === null)
	{
		$dbHost = getConfigOption('DB_HOST');
		$dbUser = getConfigOption('DB_USER');
		$dbPassword = getConfigOption('DB_PASSWORD');
		$dbName = getConfigOption('DB_NAME');

		$connection = mysqli_init();
		$connected = @mysqli_real_connect($connection, $dbHost, $dbUser, $dbPassword, $dbName);

		if (!$connected)
		{
			$error = mysqli_connect_errno() . ': ' . mysqli_connect_error();
			throw new DatabaseException($error);
		}

		$encodingResult = mysqli_set_charset($connection, 'utf8');
		if (!$encodingResult)
		{
			throw new DatabaseException(mysqli_error($connection));
		}
	}

	return $connection;
}