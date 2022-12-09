<?php

namespace Todolist\Repository;

use Exception,
	DateTime,
	Todolist\models\Todo;

class TodoRepository extends Repository
{
	/**
	 * @param array|null $filter
	 *
	 * @return Todo[]
	 * @throws Exception
	 */

	public function getList(?array $filter = []) :array
	{

		$connection = getDbConnection();

		$time = $filter['time'] ?? time();

		$from = date('Y-m-d 00:00:00', $time);
		$to = date('Y-m-d 23:59:59', $time);

		$result = mysqli_query($connection, "
		SELECT * FROM todos
		WHERE created_at BETWEEN '{$from}' AND '{$to}'
		ORDER BY created_at
		LIMIT 100");

		if(!$result)
		{
			throw new Exception(mysqli_error($connection));
		}

		$todos = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$todos[] = new Todo(
				$row['title'],
				$row['id'],
				($row['completed'] === 'Y'),
				new DateTime($row['created_at']),
				$row['completed_at'] ? new DateTime($row['updated_at']) : null,
				$row['completed_at'] ? new DateTime($row['completed_at']) : null,
			);
		}

		return $todos;
	}

	/**
	 * @param Todo $todo
	 *
	 * @return bool
	 * @throws Exception
	 */
	public function add($todo) : bool
	{
		$connection = getDbConnection();

		$id = mysqli_real_escape_string($connection, $todo->getId());
		$title = mysqli_real_escape_string($connection, $todo->getTitle());
		$completed = $todo->isCompleted() ? 'Y' : 'N';
		$createdAt = $todo->getCreatedAt()->format('Y-m-d H:i:s');
		$updatedAt = $todo->getUpdatedAt() ? sprintf('%s', $todo->getUpdatedAt()->format('Y-m-d H:i:s')) : 'NULL';
		$completedAt = $todo->getCompletedAt() ? sprintf('%s', $todo->getCompletedAt()->format('Y-m-d H:i:s'))  : 'NULL';

		$query = "INSERT INTO todos (id, title, completed, created_at, updated_at, completed_at)
    VALUE (
			 '{$id}', 
			 '{$title}',
             '{$completed}',
             '{$createdAt}',
             {$updatedAt},
             {$completedAt}
	);";

		$result = mysqli_query($connection, $query);

		if (!$result)
		{
			throw new Exception(mysqli_error($connection));
		}

		return true;
	}

	/**
	 * @param Todo $todo
	 *
	 * @return bool
	 */

	public function update($todo): bool
	{
		// TODO: Implement update() method.
		return true;
	}
}

