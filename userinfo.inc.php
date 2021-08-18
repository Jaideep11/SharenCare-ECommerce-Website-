<?php

if(isset($_SESSION["email"]))
{
include_once 'dbh.inc.php';
include_once 'functions.inc.php';
$row=retrive_user_info($conn,$_SESSION["email"]);
}
else
{
	header('location: index.php');
}