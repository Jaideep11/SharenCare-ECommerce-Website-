<?php
include_once'session_check_user.php';
      if(! $Doner && !$Borrower)
        exit();
?>
<!DOCTYPE html>
<html>
<head>

  </script>

  <!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="Requirements/dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="Requirements/dist/css/bootstrap.min.css.map">

<!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->

<link rel="stylesheet" type="text/css" href="Requirements/a076d05399.js">
<link rel="stylesheet" type="text/css" href="Requirements/bootstrap.min.js">
<link rel="stylesheet" type="text/css" href="Requirements/jQuery-3.4.1.slim.min.js">
<link rel="stylesheet" type="text/css" href="Requirements/pooper.min.js">

<script type="text/javascript" src="js/jasc.js"></script>
  <script type="text/javascript">
    $(".nav .nav-link").on("click", function(){
   $(".nav").find(".active").removeClass("active");
   $(this).addClass("active");
});</script>

  <title></title>
</head>
<body>

  <title>

  </title>
    <link rel="stylesheet" type="text/css" 
    href="Cs/style.css">
    <link rel="stylesheet" type="text/css" 
    href="css/style.css">

    <!-- Header Starts from here -->
   <div class="headerblog">
    <div class="mainblog">
      <ul>
       <li><a href="doner_index.php" >Home</a></li>
       <li><a href="doner_cat.php?cat=1" >Mobile Phones</a></li>
       <li><a href="doner_cat.php?cat=2" >Books</a></li>
       <li><a href="doner_cat.php?cat=3" >Vehicles</a></li>
       <li><a href="doner_cat.php?cat=5" >Clothes</a></li>
       <li><a href="doner_cat.php?cat=4" >Food</a></li>
       <li><a href="doner_cat.php?cat=6" >Pets</a></li>

<?php
if (isset($_SESSION["email"])) {
  
  echo "<li><a href='profile.php' >Profile</a></li>";
  echo "<li><a href='logout.php' >Log Out</a></li>";
}
else
{
  echo "<li><a href='login.php' >Login</a> </li>";
  echo "<li> <a href='signup.php' >Sign Up</a></li>";
}


?>
  </ul>
 </div>
</div>

</body>
</html>