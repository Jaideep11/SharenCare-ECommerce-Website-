<?php
if($_SERVER['HTTP_REFERER'])
{
include_once 'LSHeader.php';
include_once'session_check_user.php';
if(isset($_SESSION["email"]))
header('location: profile.php?s=alreadylogedin');
?>
<section class="my_form">
<?php

$pid="";

    if(isset($_GET["error"]))
    {
        if($_GET["error"]=="emptyinput")
        {
            echo "<p style='color:red; margin:20px;'>Email Or Password Left Empty Try Again!</p>";
        }
       else if($_GET["error"]=="InvalidEmail")
        {
            echo "<p style='color:red; margin:20px;'>Incorrect Email Format Try Again!</p>";
        }

        else if($_GET["error"]=="emailnotexist")
        {
            echo "<p style='color:red; margin:20px;'>Account Doesn't Exists!</p>";
        }

        else if($_GET["error"]=="wrongpassword")
        {
            echo "<p style='color:red; margin:20px;'>Incorrect Password Try Again!</p>";
        }

    }

    else if(isset($_GET["pwdRest"]))
    {
      if($_GET["pwdRest"]=="successful")
      {
        echo "<p class'success-text' style='color:green; font-size:30px'>Password Updated Successfully<br> You Can Login Now!</p>";
      }
    }

    else if(isset($_GET["signup"]))
    {
      if($_GET["signup"]=="verified")
      {
        echo "<p style='color:green; font-size:30px'>Account Created Successfully<br> You Can Login Now!</p>";
      }
    }

     else if(isset($_GET["req"]))
    {
        $pid=$_GET["req"];
        echo "<p style='color:red; font-size:20px'>Login To See Seller Information!<br> You Are Not Logged In !</p>";

    }
    

?>

  <img src="img/user_icon.png" width="150px" class="img-responsive" >
<center><h1>Login</h1></center>

<form id="form" action="includes/login.inc.php" method="post">
  <input type="email" name="email" placeholder="Email" required>
  <span id="email" style="color: red; font: bold;" ></span>
  <input type="password" name="password" placeholder="Password" required>
  <input type="hidden" name="pid" value="<?php echo $pid; ?>">
  <button class="btn-success" type="submit" name="submit">Login</button>
  <br><br><a href="forgot-password.php">I Forgot My Password</a>
  <label>OR New Here? Get Started By</label>
    <br><a href="signup.php">Sign Up</a>
</form>
</section>

<?php 
 include_once 'footer.php';
}
else
{
  header("location: index.php");
  exit();
}
 ?>

</html>
