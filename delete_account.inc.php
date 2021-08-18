<?php
if ($_SERVER['HTTP_REFERER'])
{	
	include_once'../session_check_user.php';
	include_once'dbh.inc.php';
	if(isset($_GET['req']))
	{
		$accid=$_GET['req'];
	}
	$sql="DELETE from account where accountid=$accid";
	$result = $conn->query($sql);
	if (mysqli_query($conn, $sql)) 
	{
			header('location: logout.inc.php?adel=success');
			exit();
      	}
	else 
		{
			echo "Error deleting record: " . mysqli_error($conn);
			header('location: ../account_settings.php?del=failed?accid='.$accid.'');
			exit();
		}

mysqli_close($conn);

}
else 
{
	header('loacation: index.php?delacc');
	exit();
}
?>