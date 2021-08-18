<link rel="stylesheet" type="text/css" href="Requirements/dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="Requirements/dist/css/bootstrap.min.css.map">

<!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->

<link rel="stylesheet" type="text/css" href="Requirements/a076d05399.js">
<link rel="stylesheet" type="text/css" href="Requirements/bootstrap.min.js">
<link rel="stylesheet" type="text/css" href="Requirements/jQuery-3.4.1.slim.min.js">
<link rel="stylesheet" type="text/css" href="Requirements/pooper.min.js">

<?php
// include_once'Cs/display_produc?t.css.php';
// if($_SERVER['HTTP_REFERER'])
include_once'session_check_user.php';
if($Doner || $Borrower)
{
    if (isset($_GET['req'])) 
    {
      $pid=$_GET['req'];
      // echo $pid;
    }

include_once('doner_header.php');
include_once('includes/dbh.inc.php');


$sql = "SELECT * FROM donate_product where dpid=$pid";
      $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
    // output data of each row
        $row = $result->fetch_assoc();      
    }
    else
    {
      echo "No Record Found";
      exit();
    }
  
$pdate="<td>" . date('d-m-Y', strtotime($row['entry_date'])) . "</td>"; 
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="Cs/product_details.css">
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

  </head>

<body>
    
    <div class="container mt-5">
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">
                        
                        <div class="preview-pic tab-content">
                          <div class="tab-pane active" id="pic-1"><img src="<?php echo $row['pro_img'];?>" /></div>
                        
                        </div>
                        <p class="preview-thumbnail nav nav-tabs"></p>
                        
                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title"><?php echo $row['dpname'];?></h3>
                        <h5 class="product-title">Added:<?php echo $pdate;?></h5>
                        <div class="rating">
                            <div class="stars">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <span class="review-no">41 reviews</span>
                        </div>
                        <p class="product-description"><strong>User Words:</strong><?php echo $row['pdescription'];?></p>
                        <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
                        <h5 class="sizes">Condition:
                            <span class="size" data-toggle="tooltip" title="condition"><?php echo $row['procondition'];?></span>
                            
                        </h5>
                        <h5 class="colors">colors:
                            <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                            <span class="color green"></span>
                            <span class="color blue"></span>
                        </h5>
                        <div class="action">
                            <a href="buy-product.php?req=<?php echo $pid; ?>"><button class="add-to-cart btn btn-default" type="button">I want to Borrow this</button>
                            <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>


  
<?php

include_once('footer.php');

}
else
{
    header("location: doner_index.php");
    exit();
}


?>