<?php
// if($_SERVER['HTTP_REFERER']) 
if(1)
{
	include_once ('LSHeader.php');
	$selector =$_GET["selector"] ;
	$validator=$_GET["validator"];
	if (empty($selector) || empty($validator) ) 
	{
		echo "SIC couldn't verify its You";	

	}
	else
	{
		if (ctype_xdigit($selector)!==false && ctype_xdigit($validator) ) //if validator and password matches
		{
			?>


			<section class="my_form">
			 <img src="img/passwordreset.png" width="150px" class="img-responsive" >
			<center><h1>Reset Password</h1></center>

			<form id="form" action="includes/update_password.inc.php" method="post">
			  <input type="hidden" name="selector" value="<?php echo $selector; ?>">
			  <input type="hidden" name="validator" value="<?php echo $validator; ?>">
			  <input type="password" name="password" placeholder="Enter A New Password" required>
			  <input type="password" name="repassword" placeholder="Repeat New Password" required>
			  <button class="btn-success" type="submit" name="reset-password-submit">Reset Password</button>
			</form>
			</section>

	<?php

	if(isset($_GET["status"]))
	{
		if ($_GET["status"]=="pwdnotmatch") 
		{
			echo "<center style='color:red; font-size:30px'>Password Donot Match Enter Again!</center><br>";
			
		}
	}

  }

include_once 'footer.php';}
}
else
{
	header('location: index.php');
}
?>