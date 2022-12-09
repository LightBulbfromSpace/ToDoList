<?php

namespace Todolist\Repository;

abstract class Repository
{
	public function getListOrFail(?array $filter = []) :array
	{
		$todos = $this->getList($filter);
		if (empty($todos))
		{
			echo 'No tasks yet' . PHP_EOL;
			exit();
		}
		return $todos;
	}

	abstract public function getList(array $filter) :array;

	abstract public function add($entity) : bool;
	abstract public function update($entity) : bool;
}