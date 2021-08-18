<?php
include'session_check_user.php';
include_once'LSheader.php';
if(isset($_SERVER['HTTP_REFERER']) )
{
	$pid="";
	if (isset($_GET['req'])) 
	    $pid=$_GET['req'];

	if($_SESSION["email"])
	{
		
		include('user_profile_details.php');
		// include('includes/victim_profile.inc.php');
		// include ('includes/seller_info.inc.php');	//row contains all data of seller
	}
	
	else
	{
		header('location: login.php?req='.$pid);
	}

include'footer.php';
}
else
{
	
	header('location: index.php');
}