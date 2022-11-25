<?php

function addCommand($arguments)
{
	$title = array_shift($arguments);

	$toDo = createToDo($title);

	appendToDo($toDo);
}