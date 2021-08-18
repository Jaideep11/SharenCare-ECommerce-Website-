<?php
// include_once'../session_check_user.php';
if (!isset($_SESSION))
{
	session_start();
}
if (isset($_POST["save-changes"]) && isset($_SESSION["email"]) && $_SERVER['HTTP_REFERER']) 
{
	include_once'dbh.inc.php';

	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$city=$_POST["city"];
	$postal=$_POST["postal"];
	$state=$_POST["state"];
	$mobile=$_POST["mobile"];
	$country=$_POST["country"];
	$type=$_POST["type"];
	$accID=$_SESSION["accountid"];

	$sql="UPDATE account SET
	 fname='$fname',
	 lname='$lname',
	 city='$city',
	 postal_code=$postal,
	 state='$state',
	 mobile_no=$mobile,
	 country='$country',
	 type='$type'
	WHERE accountid=$accID";
	$result = $conn->query($sql);
	if(mysqli_query($conn, $sql))
	{
    	header('location: ../profile.php?update=success');
			exit();
	} 
	else
	{
		echo "Error Updating Account: " . mysqli_error($conn);
		header('location: ../profile.php?update=failed');
	    
	    exit();
	}
	 
	mysqli_close($conn);

}

else
{
	header('location: ../index.php');
}
?>