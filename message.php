<?php
include_once'LSHeader.php';
include'session_check_user.php';
if(isset($_SESSION["email"]) )
{

    $name=$_POST["fname"];
    $gender=$_POST["gender"];
    $receiver_id=$_POST["receiver_id"];

   
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
                    if($gender=="Male" || $gender=="male"){echo "<img src='img/avatar7.png' alt=''>";}
                    else
                        {echo "<img src='img/avatar3.png' alt=''>";}
                    ?>
                </div>
                <div class="bg-light-gray padding-30px-all md-padding-25px-all sm-padding-20px-all text-center">
                    <h4 class="margin-10px-bottom font-size24 md-font-size22 sm-font-size20 font-weight-600">
                        <?php echo $name; ?> </h4>
                    <p class="sm-width-95 sm-margin-auto">Hi There! I am <?php echo $name; ?> If you are intrested in any of my product you are welcomed to contact me. </p>
                    <div class="margin-20px-top team-single-icons">
                        <ul class="no-margin">
                            
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-7">
                <div class="team-single-text padding-50px-left sm-no-padding-left">
                    <h4 class="font-size38 sm-font-size32 xs-font-size30 ">Send Message To <?php echo $name; ?></h4>
                    <?php

                        if($receiver_id!=$_SESSION["accountid"])
                        include_once'chatbox.php';
                        else
                        {
                            header('location: display_all_chats.php?selfmsg=true');
                            exit();
                        }
                    ?>
                    <!-- <p class="no-margin-bottom">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum voluptatem.</p> -->
                    <p class="mt-5"></p>
                    <div class="contact-info-section margin-40px-tb">
                            
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

include_once'footer.php';
}
else
{
    header('location: index.php');
}
?>