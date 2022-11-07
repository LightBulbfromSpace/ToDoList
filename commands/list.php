<?php

function listCommand($arguments)
{
	$todos = getToDosOrFail();

	foreach ($todos as $index => $todo)
	{
		$res = sprintf(
			"[%s] %s. %s\n",
			$todo['completed']? 'x': ' ',
			$index + 1,
			$todo['task']);
		echo $res;
	}
}