<?php

// todo: check for uniqueness of login
function getUserByLogin(string $login) :?array
{
	$userList = getUserList();
	$userIndex = array_search($login, array_column($userList, 'login'), true);
	if ($userIndex === false)
	{
		return null;
	}

	return $userList[$userIndex];
}

function getUserList() :array
{
	$userList = [];
	$dirPath = ROOT . '/users/';
	$userDir = new DirectoryIterator($dirPath);

	foreach ($userDir as $userFile)
	{
	if ($userFile->isDot())
	{
		continue;
	}

	$userStr = file_get_contents($dirPath . $userFile->getFilename());
	$data = unserialize($userStr, [
		'allowed_classes' => false,
	]);

	$userList[] = $data;

	}
	return $userList;
}

