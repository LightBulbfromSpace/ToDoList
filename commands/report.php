<?php

function reportCommand($arguments = [])
{
	$allToDos = prepareReportData();

	$totalDays = count($allToDos);

	$totalTasks = array_reduce($allToDos, function($prev, $todos){
		return $prev + count($todos);
	}, 0);

	$totalCompletedTasks = array_reduce($allToDos, function($prev, $todos){
		$completed = array_filter($todos, fn($todo) => $todo['completed']);
		return $prev + count($completed);
	}, 0);

	$numOfDailyTasks = array_map(function($todos){
		return count($todos);
	}, $allToDos);

	$minTasks = min($numOfDailyTasks);
	$maxTasks = max($numOfDailyTasks);

	$averageTasksPerDay = 0;
	$averageCompletedTasksPerDay = 0;

	if ($totalDays > 0)
	{
		$averageTasksPerDay = floor($totalTasks / $totalDays);
		$averageCompletedTasksPerDay = floor($totalCompletedTasks / $totalDays);
	}

	$report = [
		"Total days: $totalDays",
		"Total tasks: $totalTasks",
		"Total completed tasks: $totalCompletedTasks",
		"Min number of tasks per all days: $minTasks",
		"Max number of tasks per all days: $maxTasks",
		"Average number of tasks per day: $averageTasksPerDay",
		"Average number of completed tasks per day: $averageCompletedTasksPerDay",

	];
	echo implode(PHP_EOL, $report) . PHP_EOL;
}

function prepareReportData() :array
{
	$allToDos = [];

	$files = scandir(ROOT . '/data');

	foreach ($files as $file)
	{
		if (!preg_match('/^\d{4}-\d{2}-\d{2}\.txt$/', $file))
		{
			continue;
		}

		[$date] = explode('.', $file);

		$content = file_get_contents(ROOT . "/data/$file");
		$todos = unserialize($content, [ 'allowed classes' => false ]);
		$todos = is_array($todos) ? $todos : [];
		$allToDos[$date] = $todos;
	}

	return $allToDos;
}
