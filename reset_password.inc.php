<?php
if(isset($_POST['reset-password-submit']))
{

	include 'dbh.inc.php';
	include 'functions.inc.php';
	$useremail=$_POST["email"];

	$checkemail=EmailExists($conn,$useremail,$useremail);
	if($checkemail==true)			//if email exits in database
	{
		$selector=bin2hex(random_bytes(8));
		$token=random_bytes(32);

		//sending link to user
		$baseurl="http://localhost/PROJECT/";
		$url=$baseurl."create-new-password.php?selector=".$selector."&validator=".bin2hex($token);

		//expiry date after one hour
		$expires = date("U")+1800; 	

		$sql="delete from pwdReset where PRemail=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "Error Getting Prepared Statements for Reset Password";
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt,"s",$useremail);
			mysqli_stmt_execute($stmt);
		// echo $url;
		}
		
		$sql="INSERT into pwdReset (PRemail,PRselector,PRtoken,PRexpire) Values (?,?,?,?);";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "Error Getting Prepared Statements for Reset Password";
			exit();
		}
		else
		{
			$hashedToken= password_hash($token, PASSWORD_DEFAULT);
			
			mysqli_stmt_bind_param($stmt,"ssss",$useremail,$selector,$hashedToken,$expires);
			mysqli_stmt_execute($stmt);
		
		}

		mysqli_stmt_close($stmt);
		mysqli_close($conn);


		//Sending Actutal Email To User
		$to=$useremail;
		$subject="Reset Password For";
		$body='<p>Hi '.$to.' ,</p><p>We got a request to reset your SIC password.</p>';
		$body.='<p><a href="' .$url .  '">' .$url . '</a></p>';
		$body.="<p>If you ignore this message, your password will not be changed. If you didn't request a password reset, Kindly Ignore This Link.</p>";

		$headers="From: SIC <noreply-sicteam@gmail.com>\r\n>";
		$headers.="Content-type: text/html\r\n";
	
		$success=sendEmail($to,$headers,$subject,$body);
		if($success)
		{
		header("location: ../forgot-password.php?reset=emailsent");
		}
		else
		{
			header("location: ../forgot-password.php?reset=error_sending");
			echo "Error Sending Email";

		}
		
	}
	else
	{
		header("location: ../forgot-password.php?reset=no_email");
		exit();
	}
}
else
{
	header("location: ../index.php");
	exit();
}