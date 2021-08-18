<?php
if($_SERVER['HTTP_REFERER'])
{
include_once 'LSHeader.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>
    Forgot Password
  </title>
</head>
<body>
<section class="my_form">
  <img src="img/reset.png" width="200px" >
<center> <h1>Reset Password</h1></center>
<center><strong style="font-size: 18px;">If you need help resetting your password, we can help by sending you a link to reset it.</strong></center>
<form id="form" action="includes/reset_password.inc.php" method="post">
  <input type="email" name="email"  placeholder="Enter Your Email" required>
  <button type="submit" name="reset-password-submit">Send Email</button>
</form>
<?php
	if(isset($_GET["reset"]))
	{
		if ($_GET["reset"]=="no_email") 
		{
			echo '<p>You Are Not currently registered To SIC <a href="signup.php">Click Here To Sign Up</a></p>';
			
		}
		else if ($_GET["reset"]=="error_sending") 
		{
			echo "<p>Error Sending Email!</p>";
			
		}
		else if ($_GET["reset"]=="emailsent")
		{
			header('location: emailsent.php');
			exit();
		}
	}
}
else
{
	header('location: profile.php');
}
?>

</section>

</body>
<?php  include_once 'footer.php';?>
</html>
