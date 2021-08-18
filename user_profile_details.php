<?php
include'session_check_user.php';
if(isset($_SESSION["email"]))
{
    include_once 'includes/dbh.inc.php';
    include_once 'includes/functions.inc.php';
    if($Doner || $Borrower)
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
    else
    {
        echo "No Account Found";
        exit();
    }

      $row=retrive_user_info($conn,$row["email"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>user profile details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

</head>

</script>

    <section  class="victim_profile">
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
<div class="container mt-5">
    <div class="team-single">
        <div class="row">
            <div class="col-lg-4 col-md-5 xs-margin-30px-bottom">
                <div class="team-single-img">
                    <?php
                    if($row["gender"]=="Male" ||$row["gender"]=="male"){echo "<img src='img/avatar7.png' alt=''>";}
                    else
                        {echo "<img src='img/avatar3.png' alt=''>";}
                    ?>
                </div>
                <div class="bg-light-gray padding-30px-all md-padding-25px-all sm-padding-20px-all text-center">
                    <h4 class="margin-10px-bottom font-size24 md-font-size22 sm-font-size20 font-weight-600">
                        Type:<?php echo $row["type"]; ?> </h4>
                    <p class="sm-width-95 sm-margin-auto">Hi There! I am <?php echo $row["fname"]; ?> If you are intrested in any of my product you are welcomed to contact me. </p>
                    <div class="margin-20px-top team-single-icons">
                       



                        <ul class="no-margin">
                            <form action="message.php" method="post">
                                <input type="hidden" name="receiver" value="<?php echo $row['email']; ?>">
                                <input type="hidden" name="receiver_id" value="<?php echo $row['accountid']; ?>">
                                <input type="hidden" name="fname" value="<?php echo $row['fname'].' '.$row['lname']; ?>">
                                <input type="hidden" name="gender" value="<?php echo $row['gender']; ?>">
                                <button style="padding: 10px 100px;" type="submit" name="message-user" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </form>

                            <!-- <button style="padding: 10px 100px;" type="submit" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i></button> -->

                            <!-- <li><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fab fa-instagram"></i></a></li> -->
                        
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-7">
                <div class="team-single-text padding-50px-left sm-no-padding-left">
                    <h4 class="font-size38 sm-font-size32 xs-font-size30"><?php echo $row["fname"]."  ".$row["lname"]; ?></h4>
                    <!-- <p class="no-margin-bottom">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum voluptatem.</p> -->
                    <p class="mt-5"></p>
                    <div class="contact-info-section margin-40px-tb">
                        <ul class="list-style9 no-margin">
                            <li>

                                <div class="row">
                                    <div class="col-md-5 col-5">
                                        <i class="fas fa-user text-orange"></i>
                                        <strong class="margin-10px-left text-orange"> Gender:</strong>
                                    </div>
                                    <div class="col-md-7 col-7">
                                        <p><?php echo $row["gender"]?></p>
                                    </div>
                                </div>

                            </li>
                            <li>

                                <div class="row">
                                    <div class="col-md-5 col-5">
                                        <i class="fas fa-calendar-alt text-yellow"></i>
                                        <strong class="margin-10px-left text-yellow">User Since:</strong>
                                    </div>
                                    <div class="col-md-7 col-7">
                                        <p><?php $pdate="<td>" . date('d-m-Y', strtotime($row['date_time'])) . "</td>";echo $pdate;?></p>
                                    </div>
                                </div>

                            </li>
                            <li>

                                <div class="row">
                                    <div class="col-md-5 col-5">
                                        <i class="far fa-file text-lightred"></i>
                                        <strong class="margin-10px-left text-lightred">Courses:</strong>
                                    </div>
                                    <div class="col-md-7 col-7">
                                        <p>Design Category</p>
                                    </div>
                                </div>

                            </li>
                            <li>

                                <div class="row">
                                    <div class="col-md-5 col-5">
                                        <i class="fas fa-map-marker-alt text-green"></i>
                                        <strong class="margin-10px-left text-green">Address:</strong>
                                    </div>
                                    <div class="col-md-7 col-7">
                                        <p><?php echo $row["city"]." , ".$row["Postal_Code"]." , ". $row["state"]." , ". $row["country"]; ?></p>
                                    </div>
                                </div>

                            </li>
                            <li>

                                <div class="row">
                                    <div class="col-md-5 col-5">
                                        <i class="fas fa-mobile-alt text-purple"></i>
                                        <strong class="margin-10px-left xs-margin-four-left text-purple">Phone:</strong>
                                    </div>
                                    <div class="col-md-7 col-7">
                                        <p> <?php echo $row["mobile_no"];?></p>
                                    </div>
                                </div>

                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-5 col-5">
                                        <i class="fas fa-envelope text-pink"></i>
                                        <strong class="margin-10px-left xs-margin-four-left text-pink">Email:</strong>
                                    </div>
                                    <div class="col-md-7 col-7">
                                        <p><a href="javascript:void(0)"><?php echo $row["email"]?></a></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <h5 class="font-size24 sm-font-size22 xs-font-size20">Want To Know More?</h5>

                    <div class="sm-no-margin">
                        <div class="progress-text">
                            <div class="row">
                                <div class="col-7">Response Rate</div>
                                <div class="col-5 text-right">40%</div>
                            </div>
                        </div>
                        <div class="custom-progress progress">
                            <div role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:40%" class="animated custom-bar progress-bar slideInLeft bg-sky"></div>
                        </div>
                        <div class="progress-text">
                            <div class="row">
                                <div class="col-7">Availability </div>
                                <div class="col-5 text-right">50%</div>
                            </div>
                        </div>
                        <div class="custom-progress progress">
                            <div role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:50%" class="animated custom-bar progress-bar slideInLeft bg-orange"></div>
                        </div>
                        <div class="progress-text">
                            <div class="row">
                                <div class="col-7">Product Add </div>
                                <div class="col-5 text-right">60%</div>
                            </div>
                        </div>
                        <div class="custom-progress progress">
                            <div role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:60%" class="animated custom-bar progress-bar slideInLeft bg-green"></div>
                        </div>
                        <div class="progress-text">
                            <div class="row">
                                <div class="col-7">Excellent Communication</div>
                                <div class="col-5 text-right">80%</div>
                            </div>
                        </div>
                        <div class="custom-progress progress">
                            <div role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:80%" class="animated custom-bar progress-bar slideInLeft bg-yellow"></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-12">

            </div>
        </div>
    </div>
</div>
</section>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>

<?php
}


?>