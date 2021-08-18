<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

if (isset($_SESSION["email"]))
  {
    if($_SESSION["Doner"] || $_SESSION["Borrower"])
    {
      include_once'doner_header.php';
    }
  }
if (isset($_GET['doner-search'])) 
{
  $search=$_GET['doner-search']; 
include_once('includes/dbh.inc.php');
?>
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
	$sql="SELECT dpid,dpname,pro_img,city,state,entry_date from donate_product,account,refowner where donerid=ref_id and accountid=doner_id and dpname like CONCAT('%','$search','%')";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) 
  {
       ?>

        <div class="container-fluid mt-5">
        <span><h1>Search Results</h1>
        <h6></h6></span>
      <div class="row justify-content-center">
        <?php
      while($row = $result->fetch_assoc())
      {
      	
	      		$pname=$row["dpname"];
				$city=$row["city"];
				$state=$row["state"];
				$image=$row['pro_img'];
				$pid=$row['dpid'];
				$pdate="<td>" . date('d-m-Y', strtotime($row['entry_date'])) . "</td>";

        ?>
     <div class="col-md-3 col-sm-6 col-xs-12 mb-5">
      <div class="card shadow" style="width: 18rem;">
        <div class="inner">
          <img class="card-img-top" src="<?php echo $image;?>" alt="Card image cap">
        </div>

        <div class="card-body text-center">
        <h5 class="card-title"></h5>

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

  else
  {
    echo "<br><br><br><center>No Result Found</center>";
  }

include_once('footer.php');

}
else
{
  header("location: index.php");
  exit();
}


?>