<?php
if (isset($_POST['submit'])) {
 	
 	$email=$_POST['email'];
 	$password=$_POST['password'];
 	require_once 'dbh.inc.php';
 	require_once 'functions.inc.php';

 	if(emptyLogin($email,$password) !==false)
	{
		header("location: ../login.php?error=emptyinput");
 		exit();
	}

	if(InvalidEmail($email) !==false)
	{
		header("location: ../login.php?error=InvalidEmail");
 		exit();
	}
	$status=loginUser($conn,$email,$password);
	if($status)
	{
		if(empty($_POST["pid"]))
			header("location: ../profile.php");
		else
		{
			header("location: ../product_details.php?req=".$_POST["pid"]);	
		}
		exit();
	}

 } 
 else
 {
 	header("location: ../login.php");
 	exit();
 }