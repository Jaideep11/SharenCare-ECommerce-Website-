<?php
include 'dbh.inc.php';
include '../session_check_user.php';
if(isset($_SESSION["email"]) && isset($_POST["category-submit"]))
{
  $DonerLimit=20;    //limit for doenr
  $Limit=10;//10        //limit for buyer and seller 
     
  $cat=$_POST["pcategory"];

//getting ref_id
  if($_SESSION["email"])
  $accID=$_SESSION["accountid"];

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


//checking for limit of 30 days
  if($Doner)
  {
    $sql="SELECT count(product_id) as ppm from doner_insertion_history where ref_id=$refID and date_time BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) and NOW()";
   $result =$conn->query($sql);
   if($result->num_rows>0)
   {
       $row=$result->fetch_assoc();
       $ppm=$row['ppm'];      //number of products per month for doneer
      // echo $ppm."<br>";
   }
   else
   {
    echo "Error Getting Products PER MONTH: " . $sql . "<br>" . $conn->error;
    exit();
   }


  }
  else if(!$Doner)
  {
   $sql="SELECT count(product_id) as ppm from insertion_history where ref_id=$refID and date_time BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) and NOW()";
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
   }

///checking for coupun if user has coupun
$num_coupuns=0;
$sql="SELECT num_coupon as c from coupon where coupon_holder=$accID";
$result =$conn->query($sql);
if($result->num_rows>0)
{
   $row=$result->fetch_assoc();
   $num_coupuns=$row['c'];      //number of products per month

}
// else
// {
//    header('location: ../get_category.php?coupun=0');
//   exit();
// }


//inserting into product table 

if($Doner && $ppm > $DonerLimit && $num_coupuns<=0)        //doner limit checking
{
  header('location: ../get_category.php?limit=over');
  exit();
}
else if(!$Doner && $ppm > $Limit && $num_coupuns<=0)
{
  header('location: ../get_category.php?limit=over');
  exit();
}


else if($Doner && $ppm >= $DonerLimit && $num_coupuns>=1)
{
  header('location: ../get_category.php?coupun=1&cat='.$cat);
  exit();
}
else if(!$Doner && $ppm >= $Limit && $num_coupuns>=1)
{

   header('location: ../get_category.php?coupun=1&cat='.$cat);
  exit();
}
else
{
  if($Doner)
  header('location: ../doner_add_product.php?cat='.$cat);
  else if(!$Doner) 
  header('location: ../add_new_product.php?cat='.$cat);
  exit();
}




}
else
{
  header('location: ../index.php');
}


?>