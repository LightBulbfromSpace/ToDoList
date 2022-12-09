<?php

use Todolist\Repository\TodoRepository;

require_once __DIR__ . "/../boot.php";



$repository = new TodoRepository;

if(isset($_GET['date']))
{
	redirect('index.php?date=' . $_GET['date']);
}

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
try
{
	echo view('layout', [
		'title' => 'ToDoList::Report',
		'content' => view('pages/report', [
			'report' => $report,
			'menu' => getMenuData(),
		])
	]);
}
catch (DatabaseConnectionException $e)
{
	ob_clean();
	echo 'Cannot connect to database';
	exit;
}
catch (DatabaseEncodingException $e)
{
	ob_clean();
	echo 'Encoding error';
	exit;
}
catch (Exception $e)
{
	ob_clean();
	echo 'Something went wrong';
	exit;
}