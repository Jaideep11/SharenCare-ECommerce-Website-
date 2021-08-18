<?php
include_once'../session_check_user.php';
if (isset($_POST['update-item']) && isset($_SESSION['email']) && $_SERVER['HTTP_REFERER'] ) 
{
  include_once'dbh.inc.php';
  $pid=$_POST['pid'];
  if($Doner||$Borrower)
  {

    $pdescription=$_POST["pdescription"]; 
    $pname=$_POST['pname'];
    $pcategory=$_POST['pcategory'];
    $pcondition=$_POST['pcondition'];

      $sql="UPDATE donate_product SET
     pdescription='$pdescription',
     dpname='$pname',
     ptype=$pcategory,
     procondition='$pcondition'
    WHERE dpid=$pid";
    if(mysqli_query($conn, $sql))
    {
        header('location: ../show_all_products.php?update=success');
        exit();
    } 
    else
    {
      echo "Error Updating Product: " . mysqli_error($conn);
      header('location: ../show_all_products.php?update=failed');
        
        exit();
    }
     
    mysqli_close($conn);
    exit();
  }

// Product Details portion
//$pname=$_POST["pname"];
else
{
include_once 'functions.inc.php';
include_once 'dbh.inc.php';
$accID=$_SESSION["accountid"];
$pdescription=$_POST["pdescription"];
$price=$_POST['price'];
$cat_id=  $_POST['catgry'];
$conditions=$_POST['pcondition'];
$useremail=$_SESSION['email'];
// insert into donate product
  $sql ="UPDATE product set 
  price=$price,
  conditions='$conditions',
  pdescription='$pdescription'
  where product_id=$pid;";
  if($conn->query($sql)===TRUE)
        {
           echo "product updated"; 
        }
     else 
     {
        echo "Error: " . $sql . "<br>" . $conn->error;
     }

//end of inserting in product table
 
 if($cat_id==1)
 {
 	$mobile_name=$_POST['mobile_name'];
 	$processor=$_POST['processor'];
 	$display=$_POST['display'];
 	$memory=$_POST['memory'];
 	$battery=$_POST['battery'];
 	$company=$_POST['company_name'];
	$sql= "UPDATE  mobiles set 
    mobile_name='$mobile_name',
    processor='$processor',
    dispaly='$display',
    memory='$memory',
    battery='$battery',
    company_name='$company'
    where mobiles.mobile_id=$pid";

 }
 else if($cat_id==2)
 {
 	$Book_name=$_POST['Book_name'];
 	$Author=$_POST['Author'];
 	$Publisher=$_POST['Publisher'];
 	$title=$_POST['Title'];
 	$ISBN=$_POST['ISBN'];
 	
	$sql= "UPDATE book set book_name='$Book_name',
  author_name='$Author',
  title='$title',
  publisher='$Publisher',
  ISBN=$ISBN where book.book_id=$pid";

 }


 else if($cat_id==3)
 {
 	$Car_name=$_POST['Car_name'];
 	$Engine=$_POST['Engine'];
 	$Model=$_POST['Model'];
 	$Company_name=$_POST['Company_name'];
 	$sql= "UPDATE car set car_name='$Car_name',
    model_no=$Model,
    company_name='$Company_name',
    engin='$Engine'
    where car.car_id=$pid";

 }
 if($cat_id==4)
 {
 	$Food_name=$_POST['Food_name'];
 	$Food_type=$_POST['Food_type'];


 	$sql= "UPDATE food set food_name='$Food_name',
  food_type='$Food_type'
  where food.food_id=$pid";
   
 }
  else if($cat_id==5)
 {
 	$Cloth_name=$_POST['Cloth_name'];
 	$Color=$_POST['Color'];
 	$Lenght=$_POST['Lenght'];
 	$Company=$_POST['Company'];


 	   $sql= "UPDATE cloths set cloth_name='$Cloth_name',
     color='$Color',
     lenght=$Lenght,
     company_name='$Company'
     where cloths.cloths_id=$pid";
  
 }


 if ($cat_id==6)
 {
    $Pet_name=$_POST['Pet_name'];
    $Pet_color=$_POST['Pet_color'];
    $Pet_age=$_POST['Pet_age'];
       $sql= "UPDATE pet set pet_name='$Pet_name',
       pet_color='$Pet_color',
       pet_age=$Pet_age
       where pet.pet_id=$pid";
 }

 if(mysqli_query($conn, $sql))
    {
        header('location: ../show_all_products.php?update=success');
        exit();
    } 
    else
    {
      echo "Error Updating Product: " . mysqli_error($conn);
      // header('location: ../show_all_products.php?update=failed');
        
        exit();
    }

}



}

else
{
	header('location: ../index.php');
	exit();
}
?>
