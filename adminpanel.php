<?php
include_once'session_check_user.php';
if (!isset($_SESSION["email"])) 
{
	
}
else
{
	
	header('index.php');
}