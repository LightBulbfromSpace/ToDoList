<?php
	require_once __DIR__ . '/../boot.php';

	$errors = [];

	session_start();

	if (!isset($_SESSION['USER']))
	{
		redirect('login.php');
	}


	if ($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		$newTitle = trim($_POST['newTitle']);
		if (strlen($newTitle) > 0)
		{
			$toDo = createToDo($newTitle);
			appendToDo($toDo);
			redirect('/');
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
			'todos' => getToDos($time),
			'isHistory' => $isHistory,
			'errors' => $errors,
			'menu' => getMenuData($time),
		])
	]);
