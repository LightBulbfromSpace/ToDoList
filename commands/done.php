<?php

function doneCommand($arguments)
{
	$todos = getToDosOrFail();

	$now = time();

	$todos = mapToDos($todos, $arguments, function($todo) use ($now){
		return array_merge($todo, [
			'completed' => true,
			'updated_at' => $now,
			'completed_at' => $now,
		]);
	});
	storeToDos($todos);
}