<?php 

session_start();
session_unset();
session_destroy();
if (isset($_GET["adel"])) 
{
	if($_GET["adel"]=="success")
	{
		echo "<script>";
		echo " alert('Account Deleted Successfully!');      
        window.location.href='../index.php';
		</script>";
	}

}
else
header("location: ../index.php");
exit();

 ?>