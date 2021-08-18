<?php
if ($_SERVER['HTTP_REFERER'])
{  

include_once'session_check_user.php';
include_once'LSHeader.php';
include_once'includes/userinfo.inc.php';// row contains current user data
 $pdate="<td>" . date('d-m-Y', strtotime($row['date_time'])) . "</td>";
 $accID=$_SESSION["accountid"];
?>
<!DOCTYPE html>
                        <html>
                            <head>
                                <meta charset='utf-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1'>
                                <title>Profile</title>
                                <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
                                <link href='' rel='stylesheet'>
                                <style>@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: aliceblue
}

.wrapper {
    padding: 30px 50px;
    border: 1px solid #ddd;
    border-radius: 15px;
    margin: 10px auto;
    max-width: 600px
}

h4 {
    letter-spacing: -1px;
    font-weight: 400
}

.img {
    width: 70px;
    height: 70px;
    border-radius: 6px;
    object-fit: cover
}

#img-section p,
#deactivate p {
    font-size: 12px;
    color: #777;
    margin-bottom: 10px;
    text-align: justify
}

#img-section b,
#img-section button,
#deactivate b {
    font-size: 14px
}

label {
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 500;
    color: #777;
    padding-left: 3px
}

.form-control {
    border-radius: 10px
}

input[placeholder] {
    font-weight: 500
}

.form-control:focus {
    box-shadow: none;
    border: 1.5px solid #0779e4
}

select {
    display: block;
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 10px;
    height: 40px;
    padding: 5px 10px
}

select:focus {
    outline: none
}

.button {
    background-color: #fff;
    color: #0779e4
}

.button:hover {
    background-color: #0779e4;
    color: #fff
}

.btn-primary {
    background-color: #0779e4
}

.danger {
    background-color: #fff;
    color: #e20404;
    border: 1px solid #ddd
}

.danger:hover {
    background-color: #e20404;
    color: #fff
}

@media(max-width:576px) {
    .wrapper {
        padding: 25px 20px
    }

    #deactivate {
        line-height: 18px
    }


}
* {box-sizing: border-box}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Float cancel and delete buttons and add an equal width */
.cancelbtn, .deletebtn {
  float: left;
  width: 50%;
}

/* Add a color to the cancel button */
.cancelbtn {
  background-color: #ccc;
  color: black;
}

/* Add a color to the delete button */
.deletebtn {
  background-color: #f44336;
}

/* Add padding and center-align text to the container */
.container {
  padding: 16px;
  text-align: center;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* The Modal Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and delete button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .deletebtn {
    width: 100%;
  }
}

</style>
                                <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
                                <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
                                <script type='text/javascript'></script>
                            </head>






<body oncontextmenu='return false' class='snippet-body'>
<div class="wrapper bg-white mt-sm-5">
    <h4 class="pb-4 border-bottom">Account Settings</h4>
    <div class="d-flex align-items-start py-3 border-bottom"> <img src="img/user_icon.png?auto=compress&cs=tinysrgb&dpr=1&w=500" class="img" alt="">
        <div class="pl-sm-4 pl-2" id="img-section"> 
            <p style="font-size: 30px; text-align: center;"><?php echo $row["fname"]." ".$row["lname"]?>
            </p> 
        </div>
    </div>

    <form action="includes/update_account.inc.php" method="post">  

    <div class="py-2">
        <div class="row py-2">
            <div class="col-md-6"> <label for="firstname">First Name</label> <input type="text" class="bg-light form-control" name="fname" value="<?php echo $row["fname"]?>"> </div>
            <div class="col-md-6 pt-md-0 pt-3"> <label for="lastname">Last Name</label> <input type="text" class="bg-light form-control" name="lname" value="<?php echo $row["lname"]?>"> </div>
        </div>

       <div class="row py-2">
            <div class="col-md-6"> <label for="firstname">City </label> <input type="text" class="bg-light form-control" name="city" value="<?php echo $row["city"]?>"> </div>
            <div class="col-md-6 pt-md-0 pt-3"> <label for="lastname">State</label> <input type="text" class="bg-light form-control" name="state" value="<?php echo $row["state"]?>"> </div>
        </div>

        <div class="row py-2">
            <div class="col-md-6"> <label for="firstname">Postal Code </label> <input type="number" class="bg-light form-control" name="postal" value="<?php echo $row["Postal_Code"]?>"> </div>
            <div class="col-md-6 pt-md-0 pt-3"> <label for="lastname">Country</label> <input type="text" class="bg-light form-control" name="country" value="<?php echo $row["country"]?>"> </div>
        </div>
        <div class="row py-2">
            <div class="col-md-6"> <label for="firstname">Mobile Number </label> <input type="number" class="bg-light form-control" name="mobile" value="<?php echo $row["mobile_no"]?>"> </div>
          </div>
       
      
        <div class="row py-2">
            <div class="col-md-6"> <label for="type">Account Type</label> <select name="type" id="country" class="bg-light">
                    <option value="Buyer" selected>Buyer</option>
                    <option value="Seller">Seller</option>
                    <option value="Doner">Doner</option>
                    <option value="Borrower">Borrower</option>
                </select> </div>
            <div class="col-md-6 pt-md-0 pt-3" id="lang"> <label for="language">Language</label>
                <div class="arrow"> <select name="language" id="language" class="bg-light">
                        <option value="english" selected>English</option>
                        <option value="english_us">English (United States)</option>
                        <option value="enguk">English UK</option>
                        <option value="arab">Arabic</option>
                    </select> </div>
            </div>
        </div>

       




        <div class="py-3 pb-4 border-bottom"> <button name="save-changes" class="btn btn-primary mr-3">Save Changes</button>
        </form>
        <div class="py-3 pb-4 border-bottom"><a href="update_old_password.php"><button  type="button" class="btn btn-outline-info mr-3">Change Password</button></a></div>

         <a href="profile.php"><button  type="button" class="btn border button">Cancel</button></a></div>

        <div class="d-sm-flex align-items-center pt-3" id="deactivate">
            <div> <b>Deactivate your account</b>
                <p>Details about your company account and password</p>
            </div>





</div>
             <button  type="button" class="btn danger ml-auto" onclick="document.getElementById('id01').style.display='block'">Deactivate</button>
                                    
                        <div id="id01" class="modal">
                          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                          <form class="modal-content">
                            <div class="container">
                              <h1>Delete Account Permenantly</h1>
                              <p>Are you sure you want to delete your account?</p>

                              <div class="clearfix">
                                <a onclick="document.getElementById('id01').style.display='none'"><button type="button" class="cancelbtn">Cancel</button></a>
                                <a href="includes/delete_account.inc.php?req=<?php echo $accID;?>"><button type="button" class="deletebtn">Delete</button></a>
                              </div>
                            </div>
                          
                        </div>












    </div>
</div>
</form>
                            </body>
                        </html>



<?php
echo "<br><br><br>";
include_once'footer.php';
}
else
{
  header('location: index.php');
}


?>