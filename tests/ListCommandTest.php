<?php


use PHPUnit\Framework\TestCase, Todolist\models\Todo, \Todolist\Repository\TodoRepository;
use Todolist\Repository\TestingRepository;

class ListCommandTest extends TestCase
{
	// public static function setUpBeforeClass(): void
	// {
	// 	// start transaction
	// 	$connection = getDbConnection();
	// 	mysqli_autocommit($connection, false);
	// 	mysqli_query($connection, 'START TRANSACTION;');
	// }
	//
	// public static function tearDownAfterClass(): void
	// {
	// 	// rollback
	// 	$connection = getDbConnection();
	// 	mysqli_rollback($connection);
	// 	mysqli_autocommit($connection, true);
	// }

	public function testListCommandWorksWithoutDate() : void
	{
		$repo = new TestingRepository();
		$command = new ListCommand($repo);
		$command->execute();
		$this->assertEquals(0, $command->getStatusCode());
	}
	public function testInvalidDate() : void
	{
		$repo = new TestingRepository();
		$command = new ListCommand($repo, ['date']);
		$command->execute();
		$this->assertEquals(1, $command->getStatusCode());
		$this->assertStringContainsString('Invalid date', $command->getOutput());
	}
	public function testValidUnusedDate() : void
	{
		$repo = new TestingRepository();
		$command = new ListCommand($repo, ['08.12.3022']);
		$command->execute();
		$this->assertEquals(0, $command->getStatusCode());
		$this->assertStringContainsString('No tasks yet', $command->getOutput());
	}
	public function testNonEmptyList() : void
	{
		$tasks = ["task1", "task2", "task3"];
		$repo = new TestingRepository($tasks);

		$command = new ListCommand($repo);
		$command->execute();
		$this->assertEquals(0, $command->getStatusCode());
		foreach ($tasks as $task)
		{
			$this->assertStringContainsString($task, $command->getOutput());
		}
	}
	public function testListForCertainDate() : void
	{
		$tasks = ["task1", "task2", "task7"];
		$repo = new TestingRepository($tasks, "08.04.2022");

		$command = new ListCommand($repo, ['08.04.2022']);
		$command->execute();
		$this->assertEquals(0, $command->getStatusCode());
		foreach ($tasks as $task)
		{
			$this->assertStringContainsString($task, $command->getOutput());
		}
	}
}
