<?php
if (isset($_POST['publish-doner-item'])) 
{

	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


    $coupon_give_at=5;    //doner after adding 5 prodcuts donner can recieve coupun



	if($_SESSION["email"])
	$useremail=$_SESSION["email"];

// Product Details portion

include_once 'functions.inc.php';
include_once 'dbh.inc.php';
$pname=$_POST["pname"];
$pdescription=$_POST["pdescription"];
$cat_id=  $_POST['cat'];
$conditions=$_POST['pcondition'];
$use_coupon=$_POST["use_coupon"];



	$accID="";
  $type="";					//retriving category id
 	$sql ="SELECT accountid,type from account where email='$useremail'";
 	$result = $conn->query($sql);
	if ($result->num_rows > 0)
    {
    	if($row = $result->fetch_assoc())
      	{
      		  $accID=$row['accountid'];
          	$type=$row['type'];

      	}
		else if (!$row=mysqli_fetch_assoc($result))
		{
			echo "Account ID not found by email ".$useremail."<br>";
			exit();
		}
	}

 
  //refowner
  $sql ="SELECT ref_id from refowner where buyer_id=$accID||seler_id=$accID||doner_id=$accID";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) 
    {
      if($row = $result->fetch_assoc())
        {
          $refID=$row['ref_id'];
        }
    else if (!$row=mysqli_fetch_assoc($result))
    {
      echo "Account ID not found   ".$accID."<br>";
      exit();
    }
  }
// insert into donate product
  if($type=='Doner')
  { 
      $img_1="Donate_Product_Images/";
      $file=$_FILES['pimage1'];
      $productid=uniqid('',true);
      if(!empty($file))
      $img_1.=Upload_Image($file,1,$productid,$type);
      
      echo $img_1."image";

      $sql="INSERT into donate_product (donerid,dpname,procondition,ptype,pdescription,pro_img,entry_date) values ($refID,'$pname','$conditions',$cat_id,'$pdescription','$img_1',now());";

      if($conn->query($sql)===TRUE)
      {

          $num_coupuns=0;
          $sql="SELECT count(product_id) as ppm from doner_insertion_history where ref_id=$refID and date_time BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) and NOW()";
          $result =$conn->query($sql);
          if($result->num_rows>0)
             {
                 $row=$result->fetch_assoc();
                 $ppm=$row['ppm'];      //number of products per month

             }
             else
             {
              echo "Error Getting Products PER MONTH: " . $sql . "<br>" . $conn->error;
              exit();
             }

          if($ppm > $coupon_give_at)
          {

          $sql1="SELECT coupon_holder from coupon where  coupon_holder = $accID";
          $result=$conn->query($sql1);
          if ($result->num_rows > 0)      //updating coupon if already exists
          {

            $row = $result->fetch_assoc();
            $oid=$row['coupon_holder'];
            if($oid==$accID)
            {

                if($use_coupon==1)    //if user used his coupon
                {
                  $sql2="UPDATE coupon SET num_coupon = num_coupon -1 WHERE coupon_holder=$accID";
                      if($conn->query($sql2)===TRUE)
                      {
                        echo "Use:updated = -1".$use_coupon;
                       header('location: ../show_all_products.php?c=-up');
                       exit();
                      }
                      else
                      {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                      }

                 }

              else if($use_coupon==0)
                    {
                      $sql2="UPDATE coupon SET num_coupon = num_coupon +1 WHERE coupon_holder=$accID";
                        if($conn->query($sql2)===TRUE)
                        {
                         header('location: ../show_all_products.php?c=+up');
                         exit();
                        }
                        else
                        {
                          echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
              }
          }

          else
          {
            $sql1="INSERT into coupon (num_coupon,coupon_holder) values (1,$accID)";  //adding new coupon
              if($conn->query($sql1)===TRUE)
              {
               header('location: ../show_all_products.php?c=a');
               exit();
              }
              else
              {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
            }

          }

              //end of insertion of coupon
              header('location: ../show_all_products.php?add=success'); 
              exit();
                 // echo "Images Added Successfully<br>";
            }
       
       else 
       {
           header('location: ../show_all_products.php?add=failed');
                echo "Error: " . $sql . "<br>" . $conn->error;
               exit(); 
      }

   }

  else 
  {
    header('location: ../show_all_products.php?add=failed');
      echo "Error: " . $sql . "<br>" . $conn->error;
     exit(); 
  }
}
else
{
	header('location: ../index.php');
	exit();
}
?>
