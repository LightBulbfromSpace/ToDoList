<?php

function removeCommand($arguments)
{
	$todos = getToDosOrFail();

	$todos = mapToDos($todos, $arguments, fn($todo) => null);

	storeToDos($todos);
}
