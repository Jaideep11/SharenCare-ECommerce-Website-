<?php
if (!isset($_SESSION)) 
{
	session_start();
}
if () {
	# code...
}
if ($_SESSION["email"] && $_SERVER['HTTP_REFERER'] && isset($_POST["update-password-submit"])) 
{

	include_once'functions.inc.php';
	include_once'dbh.inc.php';
	$email=$_SESSION["email"];
	$old=$_POST["oldpassword"];
	$new=$_POST["newpassword"];
	$renew=$_POST["newrepassword"];

	if(PasswordMatch($new,$renew) !==false)
	{
		header("location: ../update_old_password.php?error=PasswordsNotMatch");
 		exit();
	}
	if(PasswordMatch($old,$renew) ==false)
	{
		header("location: ../update_old_password.php?error=PasswordsCantBeSame");
 		exit();
	}
	
	// if(PasswordValidator($new) ==false)
	// {
	// 	header("location: ../update_old_password.php?error=PasswordNotValid");
	// 	exit();
	// }

	if($row=EmailExists($conn,$email,$email))
	{
		$pwdHashed=$row["pwd"];	//$emailcheck["pwd"]; database password of associated user
		$pwdcheck=password_verify($old, $pwdHashed);		//check hashed version of user entered password and match with database hashed password
		if($pwdcheck===true)
		{
			$sql="UPDATE Account SET pwd=? where email=? ";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) 
				{
					echo "Error Getting Prepared Statements for Update Password";
					exit();
				}
			else 		//update password
				{

					$hashedPwd=password_hash($newpassword, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt,"ss",$hashedPwd,$email);
					mysqli_stmt_execute($stmt);
					header('location: ../profile.php?update=success');
					
				}
				mysqli_stmt_close($stmt);
		
			}
			else
			{
				header('location: ../update_old_password.php?error=oldPassNotValid');
			}
		}
	
		
	}
		else
		{
			header('location: ../index.php');
			exit();
		}

		




?>
