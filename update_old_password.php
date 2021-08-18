<?php
include_once'session_check_user.php';
if (isset($_SERVER['HTTP_REFERER']) && isset($_SESSION['email'])) 
{
	include_once ('LSHeader.php');
	?>
	     <section class="my_form">
			 <img src="img/passwordreset.png" width="150px" class="img-responsive" >
			<center><h1>Change My Password</h1></center>
			<form id="form" action="includes/update_old_password.inc.php" method="post">
			  <input type="password" name="oldpassword" placeholder="Enter Your Old Password" required>
			  <input type="password" name="newpassword" placeholder="Enter A New Password" required>
			  <input type="password" name="newrepassword" placeholder="Repeat New Password" required>
			  <button class="btn-success" type="submit" name="update-password-submit">Change Password</button>
			</form>
			</section>
<?php
include_once 'footer.php';

}


else
{
	header('location: index.php');
}