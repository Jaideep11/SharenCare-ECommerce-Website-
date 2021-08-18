<?php
include_once'../session_check_user.php';
if ($_SERVER['HTTP_REFERER'] && isset($_SESSION["email"]))
{	
	include_once'../session_check_user.php';
	include_once'dbh.inc.php';
	if(isset($_GET['req']))
	{
		$pid=$_GET['req'];
		
	}
	if($Doner)
	$sql="DELETE from donate_product where dpid=$pid";
	else
	$sql="DELETE from product where product_id=$pid";
	$result = $conn->query($sql);
	if (mysqli_query($conn, $sql)) 
	{
			header('location: ../show_all_products.php?del=success');
			exit();
     }
	else 
		{
			header('location: ../show_all_products.php?del=failed');
			exit();
		}

}
else 
{
	header('loacation: index.php?delprd');
	exit();
}
?>