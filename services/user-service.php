<?php

// todo: check for uniqueness of login
function getUserByLogin(string $login) :?array
{
	$userList = getUserList();
	var_dump($userList);
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
	if (!preg_match('/^\d+\.txt$/', $userFile->getFilename()))
	{
		continue;
	}

	$userStr = file_get_contents($dirPath . $userFile->getFilename());
	var_dump($userStr);
	$data = unserialize($userStr, [
		'allowed_classes' => false,
	]);

	$userList[] = $data;

	}
	return $userList;
}

