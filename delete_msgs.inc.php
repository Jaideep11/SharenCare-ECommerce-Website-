<?php

if(!isset($_SESSION["email"]))
{
	session_start();
}
if (isset($_SESSION["email"]) && isset($_SERVER['HTTP_REFERER']) && isset($_GET["receiver_id"]))
{
	include 'dbh.inc.php';

	$sender_id=$_SESSION["accountid"];
	$receiver_id=$_GET["receiver_id"];
	$sql="DELETE FROM chats where sender_id=$sender_id AND receiver_id=$receiver_id";
	$result=$conn->query($sql);
	if($conn->query($sql)===TRUE)
	{
		$sql="DELETE FROM chats where sender_id=$sender_id OR receiver_id=$receiver_id";
		$result=$conn->query($sql);
		$conn->query($sql);
		
			header('location: ../display_all_chats.php?del=success');
			exit();
		
	}
	else
	{
		header('location: ../display_all_chats.php?del=failed');
		exit();
	}

}
else
{
	header('location: ../index.php');
	ob_end_flush();
	exit();
}
?>