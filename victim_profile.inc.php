<?php
include 'LSheader.php';
echo "<br><br><br>";
?>
<link rel="stylesheet" type="text/css" href="Cs/profile.css">

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="container">
    <div class="user-profile">
        <div class="profile-header-background"><img src="http://demo.thedevelovers.com/dashboard/queenadmin-1.2/assets/img/city.jpg" alt="Profile Header Background"></div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-info-left">
                    <div class="text-center">
                        <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="Avatar" class="avatar img-circle">
                        <h2>Jack Bay</h2>
                    </div>
                    <div class="action-buttons">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="btn btn-success btn-block"><i class="fa fa-plus-round"></i> Follow</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" class="btn btn-primary btn-block"><i class="fa fa-android-mail"></i> Message</a>
                            </div>
                        </div>
                    </div>
                    <div class="section">
                        <h3>About Me</h3>
                        <p>Energistically administrate 24/7 portals and enabled catalysts for change. Objectively revolutionize client-centered e-commerce via covalent scenarios. Continually envisioneer.</p>
                    </div>
                    <div class="section">
                        <h3>Statistics</h3>
                        <p><span class="badge">332</span> Following</p>
                        <p><span class="badge">124</span> Followers</p>
                        <p><span class="badge">620</span> Likes</p>
                    </div>
                    <div class="section">
                        <h3>Social</h3>
                        <ul class="list-unstyled list-social">
                            <li><a href="#"><i class="fa fa-twitter"></i> @jackbay</a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i> Jack Bay</a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i> jackdribs</a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i> Jack Bay</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="profile-info-right">
                    <ul class="nav nav-pills nav-pills-custom-minimal custom-minimal-bottom">
                        <li class="active"><a href="#activities" data-toggle="tab">ACTIVITIES</a></li>
                        <li><a href="#followers" data-toggle="tab">FOLLOWERS</a></li>
                        <li><a href="#following" data-toggle="tab">FOLLOWING</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- activities -->
                        <div class="tab-pane fade in active" id="activities">
                            <div class="media activity-item">
                                <a href="#" class="pull-left">
                                    <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="Avatar" class="media-object avatar">
                                </a>
                                <div class="media-body">

                    <?php
        //pid coming from profile.php file
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
if(isset($_SESSION["email"]))
    {
    include_once 'includes/dbh.inc.php';
    include_once 'functions.inc.php';
    if($_SESSION['Doner']|| $_SESSION['Borrower'])
    {
      include_once 'doner_LSHeader.php';

      $sql="SELECT email FROM donate_product,refowner,account where refowner.ref_id=donerid and refowner.doner_id=account.accountID and dpid=$pid";
    }
    else
        {include_once 'LSheader.php';
    
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






















                        <!-- end following -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>