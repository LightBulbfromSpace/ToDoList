<?php

function addCommand($arguments)
{
	$title = trim(array_shift($arguments));
	try
	{
		$todo = new \Todolist\models\Todo($title);
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		exit(1);
	}

	$repo = new \Todolist\Repository\TodoRepository();
	try
	{
		$repo->add($todo);
	}
	catch (Exception $e)
	{
		echo 'Cannot connect to database: ' . $e->getMessage();
		exit(1);
	}

}