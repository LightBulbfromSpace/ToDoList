<?php

function listCommand($arguments)
{
	$time = null;

	if(!empty($arguments))
	{
		$data = array_shift($arguments);
		$time = strtotime($data);
		if ($time === false)
		{
			echo "Invalid date\n";
			exit(1);
		}
	}

	$todos = getToDosOrFail($time);

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