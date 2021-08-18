
<?php
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

if(isset($_SESSION["email"]))
{
	?>
	<center><code class="bg-white text-success">You are logged In</code></center>
	<?php
}

?>
<!DOCTYPE html>
<html>
<head>


  <!-- Bootstrap CSS -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
<!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
<link rel="stylesheet" type="text/css" href="Requirements/dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="Requirements/dist/css/bootstrap.min.css.map">

<!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->

<link rel="stylesheet" type="text/css" href="Requirements/a076d05399.js">
<link rel="stylesheet" type="text/css" href="Requirements/bootstrap.min.js">
<link rel="stylesheet" type="text/css" href="Requirements/jQuery-3.4.1.slim.min.js">
<link rel="stylesheet" type="text/css" href="Requirements/pooper.min.js">

<script type="text/javascript" src="js/jasc.js"></script>
  <script type="text/javascript">
    $(".active").on("click", function(){
   $(this).addClass("active");
});
  </script>
  <title></title>
</head>
<body>
 <!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384- J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> --> 


  <title>

  </title>
    <link rel="stylesheet" type="text/css" 
    href="Cs/style.css">
</head>
<body>
    <!-- Header Starts from here -->
   <div class="header">
  <header>
    <div class="main">
      <ul>
       <li><a href="doner_index.php" class="active">Home</a></li>
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
    <div class="title">
      <h1>Search Any Product</h1>
    </div>
    <div class="boxheader">
      <form action="doner_search.php" method="get">
        <input type="text" name="doner-search" placeholder="type anything">
        <input type="submit">
      </form>
    </div>
</header>
</div>


<!-- <button name="search-submit">Search</button> -->
</body>
<?php
include'footer.php';
?>

</html>