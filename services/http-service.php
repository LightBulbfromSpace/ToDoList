<?php

//@todo: check url is valid
function redirect(string $url)
{
	header("Location: $url");
}

function shielding(string $value) :string
{
	return htmlspecialchars($value, ENT_QUOTES);
}

