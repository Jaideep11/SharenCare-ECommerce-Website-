<?php
if (isset($_POST['submit'])) 
{
	 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

 	$_SESSION['signup-data'] = $_POST;

	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$country=$_POST['country'];
	$state=$_POST['state'];
	$city=$_POST['city'];
	$postal=$_POST['postal'];
	$mobile_no=$_POST['mobile_no'];
	$gender=$_POST['gender'];
	$password=$_POST['password'];
	$repassword=$_POST['repassword'];
	$account_type=$_POST['account_type'];
	$agreed=$_POST['agreed'];

	if(!$agreed)
	{
		header("location: ../signup.php?error=MustacceptToterms");
 		exit();
	}

	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';

	$registered=EmailExists($conn,$email,$mobile_no);
	echo $registered;

	if(emptySignup($fname,$lname,$email,$country,$state,$city,$postal,$mobile_no,$gender,$password,$repassword,$account_type) !==false)
	{
		header("location: ../signup.php?error=emptyinput");
 		exit();

	}


	else if(InvalidName($fname,$lname) !==false)
	{
		header("location: ../signup.php?error=InvalidName");
 		exit();

	}

	else if(InvalidEmail($email) !==false)
	{
		header("location: ../signup.php?error=InvalidEmail");
 		exit();

	}

	else if(InvalidMobileNo($mobile_no) !==false)
	{
		header("location: ../signup.php?error=InvalidMobileNo");
 		exit();
	}

	else if(PasswordMatch($password,$repassword) !==false)
	{
		header("location: ../signup.php?error=PasswordsNotMatch");
 		exit();
	}

	
	else if($registered !== false)
	{
		header("location: ../signup.php?error=emailalreadyregistered&".$registered['email']."");
 		exit();
	}

	else if(PasswordValidator($password) !==false)
	{
		header("location: ../signup.php?error=PasswordNotValid");
		exit();
	}


	else 		//email verification
	{	
		$selector=bin2hex(random_bytes(8));
		$token=random_bytes(32);

		//sending link to user
		$baseurl="http://localhost/PROJECT/";
		$url=$baseurl."verify_signup.php?selector=".$selector."&validator=".bin2hex($token);
		//expiry date after one hour
		$expires = date("U")+1800;
	
		$sql="INSERT into pwdReset (PRemail,PRselector,PRtoken,PRexpire) Values (?,?,?,?);";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "Error Getting Prepared Statements for Reset Password";
			exit();
		}
		else
		{
			$hashedToken= password_hash($token, PASSWORD_DEFAULT);
			mysqli_stmt_bind_param($stmt,"ssss",$email,$selector,$hashedToken,$expires);
			mysqli_stmt_execute($stmt);
		
		}

		mysqli_stmt_close($stmt);
		mysqli_close($conn);


		//Sending Actutal Email To User for vefication
		$to=$email;
		$subject="Verify Your Email For SIC";
		$body='<p>Hi '.$to.' ,</p><p>Thank You For Signing Up For SIC</p> <p>We wish you a happy journey with us. Click The Link Below To Get Verified</p>';
		$body.='<p><a href="' .$url .  '">' .$url . '</a></p>';
		$body.="<p>If you ignore this message, You won't be able to continue with your registeration.</p>";

		$headers="From: SIC <noreply-sicteam@gmail.com>\r\n>";
		$headers.="Content-type: text/html\r\n";
		$success=sendEmail($to,$headers,$subject,$body);
		if($success)
		{
			
			header("location: ../emailsent.php?regitr=success");
		}
		else
		{
			header("location: ../emailsent.php?regitr=error_sending");
			echo "Error Sending Email";

		}
		
	}

}
 
 else
 {
 	header("location: ../signup.php");
 	exit();
 }