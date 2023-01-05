<?php

use Todolist\Repository\Repository;

class ListCommand
 {
	 private array $arguments;

	 private int $statusCode = 0;

	 private string $output = '';

	 private Repository $repo;

	 public function __construct(Repository $repo, array $arguments = [])
	 {
		 $this->arguments = $arguments;
		 $this->repo = $repo;
	 }

	public function getStatusCode(): int
	{
		return $this->statusCode;
	}

	public function getOutput(): string
	{
		return $this->output;
	}

	public function execute() : void
	{
		$time = null;

		if(!empty($this->arguments))
		{
			$data = array_shift($this->arguments);
			$time = strtotime($data);
			if ($time === false)
			{
				$this->output .= "Invalid date\n";
				$this->statusCode = 1;
				return;
			}
		}

		$todos = $this->repo->getListOrFail(['time' => $time]);
		if ($this->repo->output === 'No tasks yet' . PHP_EOL)
		{
			$this->output .= $this->repo->output;
		}
		foreach ($todos as $index => $todo)
		{
			$this->output .= sprintf(
				"[%s] %s. %s\n",
				$todo->isCompleted() ? 'x': ' ',
				$index + 1,
				$todo->getTitle());
		}
	}
}