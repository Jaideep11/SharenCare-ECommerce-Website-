<?php
if($_SERVER['HTTP_REFERER'])
{
include_once 'LSHeader.php';
?>
<!DOCTYPE html>
<html>
<head>
<title> Sign Up </title>
</head>

<body>
<section class="my_form">
    <section>
        <?php
    if(isset($_GET["error"]))
    {
        if($_GET["error"]=="MustacceptToterms")
        {
            echo "<p style='color:red; margin:20px;'>You Must Accept Terms of Services Try Again!</p>";
        }
        if($_GET["error"]=="emptyinput")
        {
            echo "<p style='color:red; margin:20px;'>One Or More Fields Were Empty Try Again!</p>";
        }
        if($_GET["error"]=="InvalidName")
        {
            echo "<p style='color:red; margin:20px;'>Name Can't Include Special Cracters/Numbers <br>  <br>First Name and last Name can't be Same Try Again!</p>";
        }

        if($_GET["error"]=="InvalidEmail")
        {
            echo "<p style='color:red; margin:20px;'>Invalid Email Try Again!</p>";
        }
        if($_GET["error"]=="InvalidMobileNo")
        {
            echo "<p style='color:red; margin:20px;'>Invalid Mobile Number Try Again!</p>";
        }

        if($_GET["error"]=="PasswordsNotMatch")
        {
            echo "<p style='color:red; margin:20px;'>Passwords Donot Match Try Again!</p>";
        }
        if($_GET["error"]=="emailalreadyregistered")
        {
            echo "<p style='color:red; margin:20px;'>Email Already Exist Try With Different Email Try Again!</p>";
        }

        if($_GET["error"]=="stmtfailed")
        {
            echo "<p style='color:red; margin:20px;'>Something Error Occured Try Again!</p>";
        }

        if($_GET["error"]=="PasswordNotValid")
        {
            echo "<p style='color:red; margin:20px; font-size:20px'>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.!</p>";
        }
        
        if($_GET["error"]=="none")
        {
            echo "<p style='color:red; margin:20px;'>You Are Signed Up!</p>";
        }

    }

?>
</section>

  <img src="img/newuser_icon.png" width="150px" >
    <center> <h1>Sign Up Now</h1> </center>
    <form action="includes/signup.inc.php" method="post">
            <input type="text" placeholder="First Name" name="fname" required>
            <input type="text" placeholder="Last Name " name="lname" required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="text" placeholder="Country" name="country" required>
            <input type="text" placeholder="State" name="state" required>
            <input type="text" placeholder="City" name="city" required>
            <input type="number" placeholder="Postal Code" name="postal" required>
            <input type="number" placeholder="Mobile No." name="mobile_no" required>
            <div id="gender">
            <br><label>Male<input type="radio" name="gender" value="Male" checked></label>
            <label>Female<input type="radio" name="gender" value="Female"></label>
            <label>Other<input type="radio" name="gender" value="Other"></label>
            </div>

            <input type="password" placeholder="Password" name="password" required>
            <input type="password" placeholder="Confirm Password" name="repassword" required><br>
            <label>Sign Up As:</label><br>
            <select name="account_type" id="type">
              <option value="Buyer">Buyer</option>
              <option value="Borrower">Borrower</option>
              <option value="Doner">Doner</option>
              <option value="Seller">Seller</option>
            </select>
            <p><section><input style="width: 10%;" type="checkbox" name="agreed">
            I Agree To Terms Of Services</p></section>
            <button type="submit" name="submit" >Sign Up</button>
            <br><br>
            <label>Already Have An Account</label><br><br>
            <a href="login.php"> Login Instead </a>
    </form>
    
  </section>


</body>
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
