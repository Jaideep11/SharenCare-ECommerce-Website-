<?php
// include_once'Cs/display_produc?t.css.php';
// if($_SERVER['HTTP_REFERER'])
if(1)
{
  if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    if (isset($_GET['req'])) 
    {
      $pid=$_GET['req'];
      // echo $pid;
    }

include_once('header.php');
include_once('includes/dbh.inc.php');
$sql = "SELECT category_id FROM product where product_id=$pid";
      $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
    // output data of each row
      
        $row = $result->fetch_assoc();      
    }
    else
    {
      echo "No category_id Found";
      header('location: 404.php');
      exit();
    }
    if ($row['category_id']==1)
    {
         include_once'Product_Details/mobile_display.php';
    }

    else if ($row['category_id']==2)
    {
         include_once'Product_Details/book_display.php';
    }

    else if ($row['category_id']==3)
    {
         include_once'Product_Details/vehicles_display.php';
    }

    else if ($row['category_id']==4)
    {
         include_once'Product_Details/food_display.php';
    }

    else if ($row['category_id']==5)
    {
         include_once'Product_Details/clothes_display.php';
    }

    else if ($row['category_id']==6)
    {
         include_once'Product_Details/pet_display.php';
    }

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="Cs/product_details.css">
<link rel="stylesheet" type="text/css" href="Cs/style.css">
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

  </head>

  
<?php
include_once('footer.php');

}
else
{
    header("location: index.php?");
    exit();
}


?>