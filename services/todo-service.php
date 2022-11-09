<?php

function mapToDos(array $todos, array $positions, Closure $callback) :array
{
	foreach ($positions as $position)
	{
		$index = $position - 1;
		if (!isset($todos[$index]))
		{
			continue;
		}

		$result = $callback($todos[$index]);

		if(is_array($result))
		{
			$todos[$index] = $result;
		}
		else
		{
			unset($todos[$index]);
		}

	}
	return array_values($todos);
}