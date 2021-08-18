<?php
if (isset($_POST["confirm-signup-submit"])) 
{
	$selector=$_POST["selector"];
	$validator=$_POST["validator"];
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
			if(!isset($_SESSION)) 
			{ 
		     session_start(); 
			}
				include_once'functions.inc.php';


				$fname=$_SESSION['signup-data']['fname'];
				$lname=$_SESSION['signup-data']['lname'];
				$email=$_SESSION['signup-data']['email'];
				$country=$_SESSION['signup-data']['country'];
				$state=$_SESSION['signup-data']['state'];
				$city=$_SESSION['signup-data']['city'];
				$postal=$_SESSION['signup-data']['postal'];
				$mobile_no=$_SESSION['signup-data']['mobile_no'];
				$gender=$_SESSION['signup-data']['gender'];
				$password=$_SESSION['signup-data']['password'];
				$repassword=$_SESSION['signup-data']['repassword'];
				$account_type=$_SESSION['signup-data']['account_type'];
				$agreed=$_SESSION['signup-data']['agreed'];
				unset($_SESSION['signup-data']);

			//AZMAT
			
			$status=createAccount($conn,$fname,$lname,$email,$country,$state,$city,$postal,$mobile_no,$gender,$password,$account_type);
		     if(!status)
		     {
		     	echo "Error Entering Values To Database";
		     	exit();
		     }
		    $sql= "SELECT accountID,type from account where email='$email'";
      			$result=$conn->query($sql);
		      if($result->num_rows>0)
		      {
		        $row=$result->fetch_assoc();
		      }
		        $id=$row['accountID'];
		        $type=$row['type'];

		      if($type=='Seller')
       			{
                  $sql="INSERT into seler (seller_id) value($id)";
                     if($conn->query($sql)===TRUE);
                     else 
                    {
                         echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    $sql="INSERT into refowner(seler_id) values($id)";
                      if($conn->query($sql)===TRUE)
                    {
                         echo "seller is add in refowner";
                    }
                     else 
                    {
                         echo "Error: " . $sql . "<br>" . $conn->error;
                    }

       			}


      
		       	else if($type=='Doner')
		       	{
                     $sql="INSERT into doner (doner_id) value($id)";
                     if($conn->query($sql)===TRUE);
                     else 
                    {
                         echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    $sql="INSERT into refowner(doner_id) values($id)";
                      if($conn->query($sql)===TRUE)
                    {
                         echo "doner is add in refowner";
                    }
                     else 
                    {
                         echo "Error: " . $sql . "<br>" . $conn->error;
                    }

       			}
       				else if($type=='Buyer')
		       	{
                     $sql="INSERT into buyer (buyer_id) value($id)";
                     if($conn->query($sql)===TRUE);
                     else 
                    {
                         echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    $sql="INSERT into refowner(buyer_id) values($id)";
                      if($conn->query($sql)===TRUE)
                    {
                         echo "doner is add in refowner";
                    }
                     else 
                    {
                         echo "Error: " . $sql . "<br>" . $conn->error;
                    }

       			}
   
   
			
			//End Azmat
				
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
					if ($status==true) 
					{
						header("location: ../login.php?signup=verified");
					}
					// header('location: ../login.php?pwdRest=successful');
				// echo $url;
				}
		
			}


		}
	else
	{
		echo "No Data Found";
		exit();
	}
	mysqli_close($conn);
}
else
{
	header('location: index.php');
}
?>