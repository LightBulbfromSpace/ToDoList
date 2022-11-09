<?php

function addCommand($arguments)
{
	$task = array_shift($arguments);

	$toDo = [
		'id' => uniqid('', false),
		'title' => $task,
		'completed' => false,
		'created_at' => time(),
		'updated_at' => null,
		'completed_at' => null,
	];

	$todos = getToDos();

	$todos[] = $toDo;

	storeToDos($todos);
}