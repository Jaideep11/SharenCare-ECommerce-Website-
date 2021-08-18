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

<link rel="stylesheet" type="text/css" href="Requirements/a076d05399.js">
<link rel="stylesheet" type="text/css" href="Requirements/bootstrap.min.js">
<link rel="stylesheet" type="text/css" href="Requirements/jQuery-3.4.1.slim.min.js">
<link rel="stylesheet" type="text/css" href="Requirements/pooper.min.js">
</head>


<?php
if(isset($_SERVER['HTTP_REFERER']))
{

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if (isset($_GET['cat'])) 
	{

		include_once'dbh.inc.php';
		$category=$_GET['cat'];
		$sql="SELECT dpid,dpname,pro_img,entry_date,city,state from donate_product,account,refowner where donerid=ref_id and doner_id=accountid and ptype=$category";
				$_SESSION["category"]=0;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {?>
  
  <div class="container-fluid mt-5">
  <?php if($category==1) {?>
  <span><h1>Name Phones</h1> </span><?php }
  elseif($category==2) {?>
  <span><h1>Books</h1></span> <?php }
  elseif($category==3) {?>
  <span><h1>Vehicles</h1> </span><?php } 
  elseif($category==4) {?>
  <span><h1>Foods</h1> </span><?php }
  elseif($category==5) {?>
  <span><h1>Clothes</h1></span> <?php }
  elseif($category==6) {?>
  <span><h1>Pets</h1></span> <?php } ?>
        <h6></h6>
      
  <div class="row justify-content-center">
      <?php 
       while($row = $result->fetch_assoc())
      {
   			$img_1=$row['pro_img'];
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
         $city=$row["city"];
         $state=$row["state"];
		     $pname=$row["dpname"];
         $pid=$row["dpid"];
        $pdate="<td>" . date('d-m-Y', strtotime($row['entry_date'])) . "</td>";
          ?>
        <p class="card-text"><strong><?php echo $pname;?></strong></p>
        <p class="card-text"><strong><?php echo $city." ,".$state;?></strong></p>
        <h5 class="product-title"><?php echo $pdate;?></h5>
        <a href="doner_product_details.php?req=<?php echo $pid;?>" class="btn btn-success" name="viewProduct" >Check Product</a>
        
      </div>
    </div>
  </div>
  
<?php 
}
}

		
	}

echo "<br><br><br><br><br>";
include_once'footer.php';
}
else
{
	header('location: index.php');
}

?>