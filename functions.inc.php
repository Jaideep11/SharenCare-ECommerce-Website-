<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function emptySignup($fname,$lname,$email,$country,$state,$city,$postal,$mobile_no,$gender,$password,$repassword,$account_type) 
{
	$result;
	if(empty($fname) || empty($lname) || empty($email) || empty($country) || empty($state)  || empty($city) || empty($postal) || empty($mobile_no) || empty($gender) || empty($password) || empty($repassword) || empty($account_type) )
	{
		$result=true;

	}
	else
	{
		$result=false;
	}
	return $result;

}


function InvalidName($fname,$lname)
{
	$result;
	if($fname===$lname || !preg_match ("/^[a-zA-Z]*$/", $fname) || !preg_match("/^[a-zA-Z]*$/", $lname))
	{
		$result=true;
	}
	else
	{
		$result=false;
	}
	return $result;

}

function InvalidEmail($email)
{
	$result;
	if(!filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		$result= true;
	}
	else
	{
		$result= false;
	}
	return $result;
}


function InvalidMobileNo($mobile_no)
{
	$result;
	if(!preg_match("/^[0-9]*$/", $mobile_no))
	{
		$result=true;
	}
	else
	{
		$result=false;
	}
	return $result;

}

function PasswordMatch($password,$repassword)
{
	$result;
	if($password!==$repassword)
	{	
		$result=true;
	}
	else
		{
			$result=false;
		}
	return $result;
}

function retrive_user_info($conn,$email)
{
	$sql="SELECT accountid,fname,date_time,lname,email,country,state,city,Postal_Code,mobile_no,gender,type
	 from Account where email=?;";
	$stmt=mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql))
	{
		header("location: ../profile.php?error=stmtfailed");
 		exit();
	}

	mysqli_stmt_bind_param($stmt,"s",$email);
	mysqli_stmt_execute($stmt);

	$resultData=mysqli_stmt_get_result($stmt);
	if($row=mysqli_fetch_assoc($resultData))
	{
		return $row;
	}
	else
	{
		$result=false;
		return $result;
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);

}

function EmailExists($conn,$email,$mobile_no)
{

	$sql="SELECT * from Account where email=? OR mobile_no=?;";
	$stmt=mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql))
	{
		header("location: ../signup.php?error=stmtfailed");
 		exit();
	}

	mysqli_stmt_bind_param($stmt,"ss",$email,$mobile_no);
	mysqli_stmt_execute($stmt);

	$resultData=mysqli_stmt_get_result($stmt);
	if($row=mysqli_fetch_assoc($resultData))
	{
		return $row;
	}
	else
	{
		return false;
	}

	mysqli_stmt_close($stmt);

}

function createAccount($conn,$fname,$lname,$email,$country,$state,$city,$postal,$mobile_no,$gender,$password,$account_type)
{	
	$status="";
	$sql="INSERT into ACCOUNT (fname,lname,email,country,state,city,Postal_Code,mobile_no,gender,pwd,type,date_time) values (?,?,?,?,?,?,?,?,?,?,?,?);";
	$stmt=mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql))
	{
		$status=false;
		return $status;
 		exit();
	}
	$accdate=date("Y-m-d H:i:s",strtotime( 'now' ) );

$hashed_pass=password_hash($password, PASSWORD_DEFAULT);
	mysqli_stmt_bind_param($stmt,"ssssssssssss",$fname,$lname,$email,$country,$state,$city,$postal,$mobile_no,$gender,$hashed_pass,$account_type,$accdate);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	$status=true;
	return $status;
 		exit();
}

function emptylogin($email,$password)
{
	$result;
	if(empty($email) || empty($password))
	{
		$result=true;
	}
	else
	{
		$result=false;
	}
	return $result;

}

function loginUser($conn,$email,$password)
{
	$emailcheck=EmailExists($conn,$email,$email);
	if($emailcheck===false)
	{
		header("location: ../login.php?error=emailnotexist");
 		exit();
	}
	$pwdHashed=$emailcheck["pwd"];	//$emailcheck["pwd"]; database password of associated user

	$pwdcheck=password_verify($password, $pwdHashed);		//check hashed version of user entered password and match with database hashed password
	
	if($pwdcheck===true)
	{
		session_start();
		$_SESSION["accountid"]=$emailcheck["accountID"];
		$_SESSION["email"]=$emailcheck["email"];
		$_SESSION["Borrower"]=0;$_SESSION["Doner"]=0;

		$sql="SELECT type from Account where accountID=?";
		$stmt=mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql))
		{
			header("location: ../index.php?error=stmtfailed");
	 		exit();
		}

	mysqli_stmt_bind_param($stmt,"i",$_SESSION["accountid"]);
	mysqli_stmt_execute($stmt);
	$resultData=mysqli_stmt_get_result($stmt);
	if($row=mysqli_fetch_assoc($resultData))
	{
		$tmp=$row["type"];
		if($tmp==="Borrower")
			$_SESSION["Borrower"]=1;
		else if($tmp==="Doner")
			$_SESSION["Doner"]=1;
		// echo $_SESSION["Borrower"]."  D:",$_SESSION["Doner"];
	}
	else
	{
		header("location: ../index.php?error=stmtfailed");
	 	exit();	
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);

		return true;
 		exit();
	}
	else if($pwdcheck===false)
	{
		header("location: ../login.php?error=wrongpassword");
 		exit();
	}
	return false;

}



function sendEmail($to,$headers,$subject,$body)
{
	

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);;

    //smtp settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "k180248@nu.edu.pk";
    $mail->Password = "Azmat1234";
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    //email settings
    $mail->isHTML(true);
    $mail->setFrom("k180248@nu.edu.pk",$headers);
    $mail->addAddress($to);
    $mail->Subject = ("$subject SIC");
    $mail->Body = $body;

    if($mail->send()){
        $status = 1;
        return $status;
    }
    else
    {
        $status = 0;
        return $status;
    }
}

function PasswordValidator($password)
{
// Validate password strength
// $uppercase = preg_match('@[A-Z]@', $password);
// $lowercase = preg_match('@[a-z]@', $password);
// $number    = preg_match('@[0-9]@', $password);
// $specialChars = preg_match('@[^\w]@', $password);
// !$uppercase || !$lowercase || !$number || !$specialChars ||
if( strlen($password) < 8) 
{
	return true;	    
}
else
{
	return false;
}

}

function Upload_Image($file,$imgNo,$accID,$type)
{

	$status="";
	$fileName=$file['name'];
	$fileTmpName=$file['tmp_name'];	//temp location before uploading to website
	$fileError=$file['error'];
	$fileSize=$file['size'];
	$fileType=$file['type'];

	$fileExtn=explode('.', $fileName);
	$fileActualExtn=strtolower(end($fileExtn));

	$allowedExtns= array('jpg','jpeg','png');		//file types to be allowed
		if(in_array($fileActualExtn, $allowedExtns))
		{
			if($fileError===0)
			{
				if ($fileSize<820000)		//8 mb 
				{
					$fileNewName= $accID."_".$imgNo.".".$fileActualExtn;	//12.1.jpg
					
					if($type!="Doner")
					$loc=$_SERVER['DOCUMENT_ROOT'].'/PROJECT/images/'.$fileNewName;
					
					else if($type=="Doner")
					$loc=$_SERVER['DOCUMENT_ROOT'].'/PROJECT/Donate_Product_Images/'.$fileNewName;

					$fileDestination=$loc;
					move_uploaded_file($fileTmpName, $fileDestination);
						$status=$fileNewName;
					// header("location: profile.php?porduct=added");
				}

				else
				{	
					// echo "File Size Must Be Less Than 8 Mb";
					$status="noimage.jpg";
						// $status="Format Error ";


				}

			}

			else
			{
				// echo "Error Uploading Your File<br>";
					// $status.="Error Uploading ";
				$statuss="noimage.jpg";
			}

		}
		else
		{
			// echo "You Can't Upload This Type Of Image type<br> Try Uploading .jpg OR .jpeg OR .png";
			$status="noimage.jpg";
		}
		return $status;

}
