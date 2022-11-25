<?php

session_start();

if(isset($_SESSION['USER']))
{
	echo '<pre>';
	print_r($_SESSION['USER']);
}