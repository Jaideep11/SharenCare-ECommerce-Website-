<style type="text/css">
  
@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');


body {
    font-family: 'Poppins', sans-serif;
    background-color: aliceblue;
}
</style>

<?php
include'session_check_user.php';
if ($Doner||$Borrower) 
  {
    include 'doner_LSHeader.php';
  }
else
{
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
       <li><a href="index.php" >Home</a></li>
       <li><a href="mobiles.php" >Mobile Phones</a></li>
       <li><a href="books.php" >Books</a></li>
       <li><a href="vehicles.php" >Vehicles</a></li>
       <li><a href="clothes.php" >Clothes</a></li>
       <li><a href="foods.php" >Food</a></li>
       <li><a href="pets.php" >Pets</a></li>

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
}
?>
  </ul>
 </div>
</div>
</body>
</html>