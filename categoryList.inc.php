<!DOCTYPE html>
<html>
<head>
  <title></title>
    <!-- Bootstrap CSS -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
  <title></title>
  <link rel="stylesheet" type="text/css" href="Cs/style.css">

<link rel="stylesheet" type="text/css" href="Requirements/dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="Requirements/dist/css/bootstrap.min.css.map">

<!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="Requirements/a076d05399.js">
<link rel="stylesheet" type="text/css" href="Requirements/bootstrap.min.js">
<link rel="stylesheet" type="text/css" href="Requirements/jQuery-3.4.1.slim.min.js">
<link rel="stylesheet" type="text/css" href="Requirements/pooper.min.js">
</head>


<body>


<?php
  
    // 'doner_header.php';

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

//pagination
      if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;



$choice=$_SESSION['choice'];

require_once 'dbh.inc.php';
if($choice==1)
{


  $sql = " SELECT product.product_id,product.date_time,product.price,mobiles.mobile_name,account.state,account.city FROM product,mobiles,refowner,account where product_id=mobiles.mobile_id AND seller_id=ref_id AND category_id=1 AND(refowner.seler_id=account.accountID||refowner.buyer_id=account.accountID)";

  // $total_rows=$row["total_rows"];
   // $total_pages = ceil($total_rows / $no_of_records_per_page);
  // $sql = "SELECT * FROM table LIMIT $offset, $no_of_records_per_page";
        // $res_data = mysqli_query($conn,$sql);
        // while($row = mysqli_fetch_array($res_data))

}
if($choice==2)
{
    $sql="SELECT product.product_id,product.date_time,product.price,book.book_name,account.state,account.city FROM product,book,refowner,account where product_id=book.book_id AND seller_id=ref_id AND category_id=$choice AND(refowner.seler_id=account.accountID||refowner.buyer_id=account.accountID)";
}
if($choice==3)
{
  $sql = "SELECT product.product_id ,product.date_time,car.car_name ,product.price,account.state,account.city FROM product,car,refowner,account where product_id=car_id AND seller_id=ref_id AND category_id=$choice AND(refowner.seler_id=account.accountID||refowner.buyer_id=account.accountID)";


}
if($choice==4)
{
   $sql=" SELECT product.product_id,product.date_time,product.price,food.food_name,account.state,account.city FROM product,food,refowner,account where product_id=food.food_id AND category_id=4 and refowner.ref_id=product.seller_id AND(refowner.seler_id=account.accountID||refowner.buyer_id=account.accountID)";
}
if($choice==5)
{
  $sql="SELECT product.product_id,product.date_time,product.price,cloths.cloth_name,account.state,account.city FROM product,cloths,refowner,account where product_id=cloths.cloths_id AND seller_id=ref_id AND category_id=$choice AND(refowner.seler_id=account.accountID||refowner.buyer_id=account.accountID)";


}
if($choice==6)
{
     $sql="SELECT product.product_id,product.price,product.date_time,pet.pet_name,account.state,account.city FROM product,pet,refowner,account where product_id=pet.pet_id AND seller_id=ref_id AND category_id=$choice AND(refowner.seler_id=account.accountID||refowner.buyer_id=account.accountID)";


}

    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {?>
  
  <div class="container-fluid mt-5">
  <?php if($choice==1) {?>
  <span><h1>Name Phones</h1> </span><?php }
  elseif($choice==2) {?>
  <span><h1>Books</h1></span> <?php }
  elseif($choice==3) {?>
  <span><h1>Vehicles</h1> </span><?php } 
  elseif($choice==4) {?>
  <span><h1>Foods</h1> </span><?php }
  elseif($choice==5) {?>
  <span><h1>Clothes</h1></span> <?php }
  elseif($choice==6) {?>
  <span><h1>Pets</h1></span> <?php } ?>
        <h6></h6>
      
  <div class="row justify-content-center">
      <?php 
      while($row = $result->fetch_assoc())
      {

        $pid=$row['product_id'];
        $sql1="SELECT img_1, img_2,img_3 from imagesource where product_id=$pid  ";

    $result1 = $conn->query($sql1);

    if ($result1->num_rows > 0) 
    {
        $row1 = $result1->fetch_assoc();   
    }
   $img_1=$row1['img_1'];
   // $img_2=$row1['img_2'];
  
         
      ?>

    <div class="col-md-3 col-sm-6 col-xs-12 mb-5">
      <div class="card shadow" style="width: 18rem;">
        <div class="inner">
          <img class="card-img-top" src="<?php echo $img_1;?>" alt="Card image cap">
        </div>

        <div class="card-body text-center">
        <h5 class="card-title"></h5>
        <?php 

         $price= $row["price"];
         $city=$row["city"];
         $state=$row["state"];


  
        if($choice==1)
                $pname=$row["mobile_name"];
        if($choice==2)
                $pname=$row["book_name"];
        if($choice==3)
                $pname=$row["car_name"];
        if($choice==4)
                $pname=$row["food_name"];
         if($choice==5)
                $pname=$row["cloth_name"];
         if($choice==6)
                $pname=$row["pet_name"];
              
        $pdate="<td>" . date('d-m-Y', strtotime($row['date_time'])) . "</td>";


          ?>
        <p class="card-text"><strong><?php echo $pname;?></strong></p>
        <p class="card-text"><strong>Rs: <?php echo $price;?></strong></p>
        <p class="card-text"><strong><?php echo $city." ,".$state;?></strong></p>
        <h5 class="product-title"><?php echo $pdate;?></h5>
        <a href="product_details.php?req=<?php echo $pid;?>" class="btn btn-success" name="viewProduct" >Check Product</a>
        
      </div>
    </div>
  </div>
  
<?php }}?>
</div>
</div>


<nav aria-label="Page navigation example">
  <ul class="pagination" style="margin-left: 40% !important;">
    
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Previous</a></li>


    <li class="page-link" class="<?php if($pageno <= 1){ echo 'disabled'; } ?>"><a href="?pageno=1">First</a></li>

    <li class="page-link"class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
      <a  href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a></li>
    <li><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
  </ul>

  
</nav>
</body>
</html>
