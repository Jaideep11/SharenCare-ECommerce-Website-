<?php
		//pid coming from profile.php file
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
if(isset($_SESSION["email"]))
	{
    include_once 'dbh.inc.php';
    include_once 'functions.inc.php';
    if($_SESSION['Doner']|| $_SESSION['Borrower'])
    {
      
      $sql="SELECT email FROM donate_product,refowner,account where refowner.ref_id=donerid and refowner.doner_id=account.accountID and dpid=$pid";
    }
    else
		{
		$sql="SELECT email FROM product,refowner,account where (refowner.ref_id=product.seller_id and refowner.seler_id=account.accountID and product.product_id=$pid)||(refowner.ref_id=product.seller_id and refowner.buyer_id=account.accountID and product.product_id=$pid)";
    }

	$result = $conn->query($sql);
    if ($row=$result->num_rows > 0) 
    	{
        	$row = $result->fetch_assoc();   
		  }

      $row=retrive_user_info($conn,$row["email"]);

	?>

	<!-- <div class="row gutters-sm"> -->
	<div class="col-md-8 ">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    	<?php echo $row["fname"]; echo " ".$row["lname"];?>
            
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $row["email"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $row["mobile_no"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $row["gender"];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <?php echo $row["city"]; echo " , ".$row["Postal_Code"];; echo " , ".$row["state"];echo " , ".$row["country"];?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"><?php echo $row["type"];?></i> Status</h6>
                    
            


</div>
</div>
</div>
</div>
</div>

<?php		
	// include_once'footer.php';
}

	else
	{
    
		header('location: ../index.php');
		exit();
	}
?>
