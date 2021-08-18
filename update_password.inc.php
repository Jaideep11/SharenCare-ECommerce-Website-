<?php
if (isset($_POST["reset-password-submit"])) 
{
	$selector=$_POST["selector"];
	$validator=$_POST["validator"];
	$pwd=$_POST["password"];
	$pwdRepeat=$_POST["repassword"];
	if (empty($pwd) || empty($pwdRepeat)  )
	{
		header('location: ../create-new-password.php?status=emptypwd&$selector&$validator');
		exit();
	}
	else if($pwd !== $pwdRepeat)
	{
		
		header("location: ../create-new-password.php?status=pwdnotmatch&selector=".$selector."&validator=".$validator."");
		exit();
	}
	
	$currDate=date("U");
	include_once'dbh.inc.php';
	$sql="SELECT * from pwdReset where PRselector = '$selector' AND PRexpire >= $currDate";
	$result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
    	if($row = $result->fetch_assoc())
      	{
      		
      	}
		else if (!$row=mysqli_fetch_assoc($result))
		{
			echo "You need to re-submit your reset request";
			exit();
		}

		$tokenbin=hex2bin($validator);
		$tokencheck=password_verify($tokenbin, $row["PRtoken"]);	//checking user token vs db token validator
		if($tokencheck===false)
		{
				echo "Validator Doesn't Match You need to re-submit your reset request";
				exit();

		}
		else if($tokencheck===true)
		{
			$tokenEmail=$row["PRemail"];

			//AZMAT
			$sql="UPDATE Account SET pwd=? where email=? ";

			//End Azmat
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) 
			{
				echo "Error Getting Prepared Statements for Update Password";
				exit();
			}
			else 		//update password
			{

				$hashedPwd=password_hash($pwd, PASSWORD_DEFAULT);
				mysqli_stmt_bind_param($stmt,"ss",$hashedPwd,$tokenEmail);
				mysqli_stmt_execute($stmt);
				
				$sql="delete from pwdReset where PRemail=?";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt,$sql)) 
				{
					echo "Error Getting Prepared Statements for Reset Password";
					exit();
				}
				else
				{
					mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
					mysqli_stmt_execute($stmt);
					header('location: ../login.php?pwdRest=successful');
				// echo $url;
				}
		
			}


		}
	}
	else
	{
		echo "No Data Found";
		exit();
	}mysqli_close($conn);



}
else
{
	header('location: index.php');
}
?>