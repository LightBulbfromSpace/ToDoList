<?php

function removeCommand($arguments)
{
	$todos = getToDosOrFail();

	$todos = mapToDos($todos, $arguments, function($todo) {
		return null;
	});

	storeToDos($todos);
}
