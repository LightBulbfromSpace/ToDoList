<?php
	require_once __DIR__ . '/../boot.php';

	echo view('layout', [
		'title' => 'ToDoList',
		'content' => view('pages/index', [
			'todos' => getToDos(),
		])
	]);
