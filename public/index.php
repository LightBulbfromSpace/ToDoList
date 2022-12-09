<?php

use Todolist\Repository\TodoRepository,
	Todolist\models\Todo;

require_once __DIR__ . '/../boot.php';

try
{
	$errors = [];

	session_start();

	if (!isset($_SESSION['USER']))
	{
		redirect('login.php');
	}

	$repository = new TodoRepository;

	if ($_SERVER['REQUEST_METHOD'] === 'POST')
	{

		$newTitle = trim($_POST['newTitle']);
		if (strlen($newTitle) > 0)
		{
			$toDo = new Todo($newTitle);
			$repository->add($toDo);
			redirect('/?saved=true');
		}
		else
		{
			$errors[] = 'Task cannot be empty';
		}

	}

	$time = null;
	$title =  $config['APP_NAME'] ?? 'ToDoList';
	$isHistory = false;

	if(isset($_GET['date']))
	{
		$time = strtotime($_GET['date']);
		if ($time === false)
		{
			$time = time();
		}

		if (date('Y-m-d') !== date('Y-m-d', $time))
		{
			$isHistory = true;
			$title = sprintf('ToDoList :: %s', date('j M', $time));
		}
	}

	echo view('layout', [
		'title' => $title,
		'content' => view('pages/index', [
			'todos' => $repository->getList(['time' => $time]),
			'isHistory' => $isHistory,
			'errors' => $errors,
			'menu' => getMenuData($time),
		])
	]);
}
catch (DatabaseException $e)
{
	ob_clean();
	echo view('layout', [
		'title' => 'Something went wrong',
		'content' => view('pages/fatal-error', []),
	]);
	exit;
}
catch (Exception $e)
{
	ob_clean();
	echo 'Something went wrong';
	exit;
}


