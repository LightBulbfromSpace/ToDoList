<?php

function undoneCommand($arguments)
{
	$todos = getToDosOrFail();

	$todos = mapToDos($todos, $arguments, function($todo){
			return array_merge($todo, [
				'completed' => false,
				'updated_at' => time(),
				'completed_at' => null,
			]);
	});

	storeToDos($todos);
}