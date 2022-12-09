<?php

namespace Todolist\Repository;

use Exception,
	Todolist\models\Todo;

class UserRepository extends Repository
{
	/**
	 * @param array|null $filter
	 *
	 * @return User[]
	 * @throws Exception
	 */
	public function getList(?array $filter = []) :array
	{
		// TODO: Implement getList() method.
		return [];
	}

	/**
	 * @param User $user
	 *
	 * @return bool
	 * @throws Exception
	 */
	public function add($user) : bool
	{
		// TODO: Implement add() method.
		return true;
	}

	/**
	 * @param Todo $todo
	 *
	 * @return bool
	 */
	function update($todo): bool
	{
		// TODO: Implement update() method.
		return true;
	}
}