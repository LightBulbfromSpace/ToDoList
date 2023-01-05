<?php

namespace Todolist\Repository;

use PHPUnit\Util\Exception;
use Todolist\models\Todo;

class TestingRepository extends Repository
{
	private array $tasks;

	public function __construct(array $tasks = [], string $date = null)
	{
		$time = $date ? strtotime($date) : time();
		if ($time === false)
		{
			throw new Exception('invalid date');
		}
		$this->tasks[(string)$time] = $tasks;
	}

	public function getList(array $filter = []): array
	{
		$todos = [];
		$time = (string)($filter['time'] ?? time());
		if (isset($this->tasks[$time]))
		{
			foreach ($this->tasks[$time] as $task)
			{
				$datetime = new \DateTime();
				$datetime->setTimestamp((int)$time);
				$todos[] = new Todo($task,
									uniqid("", true),
									false,
									$datetime);

			}
		}
		return $todos;
	}

	/**
	 * @param Todo $entity
	 *
	 * @return bool
	 */
	public function add($entity): bool
	{
		$this->tasks[(string)$entity->getCreatedAt()->getTimestamp()][] = $entity->getTitle();
		return true;
	}

	public function update($entity): bool
	{
		// TODO: Implement update() method.
		return false;
	}
}