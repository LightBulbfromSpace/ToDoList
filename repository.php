<?php

function getToDos(?int $time = null) :array
{
	$filePath = getRepositoryPath($time);

	if (!file_exists($filePath))
	{
		return [];
	}

	$content = file_get_contents($filePath);
	$todos = unserialize($content, [
		'allowed classes' => false
	]);

	return is_array($todos) ? $todos : [];
}

function storeToDos(array $todos, ?int $time = null)
{
	$filePath = getRepositoryPath($time);
	file_put_contents($filePath, serialize($todos));
}

function appendToDo(array $toDo, ?int $time = null)
{
	$todos = getToDos($time);
	$todos[] = $toDo;
	storeToDos($todos, $time);
}

function getToDosOrFail(?int $time = null) :array
{
	$todos = getToDos($time);
	if (empty($todos))
	{
		echo 'No tasks yet' . PHP_EOL;
		exit();
	}
	return $todos;
}

function getRepositoryPath(?int $time): string
{
	$time = $time ?? time();

	$fileName = date('Y-m-d', $time) . '.txt';
	return ROOT . '/data/' . $fileName;
}

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