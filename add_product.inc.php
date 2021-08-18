<?php
if (isset($_POST['publish-item'])) 
{
	if(!isset($_SESSION)) 
  { 
    session_start(); 
  }

// Product Details portion
//$pname=$_POST["pname"];
include_once 'functions.inc.php';
include_once 'dbh.inc.php';

	if($_SESSION["email"])
	$useremail=$_SESSION["email"];
  $accID=$_SESSION["accountid"];
  $coupon_give_at=7;       //number after which coupon is added to buyer or seller

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

$pdescription=$_POST["pdescription"];
$price=$_POST['price'];
$cat_id=  $_POST['catgry'];
$conditions=$_POST['pcondition']; 
$use_coupun=$_POST['coupun'];



//inserting into product table 

$sql ="INSERT into product(seller_id,price,conditions,category_id,pdescription,date_time) values ($refID,$price,'$conditions',$cat_id,'$pdescription',NOW())";

if(mysqli_query($conn, $sql)===TRUE)
{     

$sql ="SELECT * FROM product ORDER BY product_id DESC LIMIT 1";	     //geting last row
	$result = $conn->query($sql);
	if ($result->num_rows > 0) 
	{
        $row = $result->fetch_assoc();      
	      $productid=$row['product_id'];
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
	$sql= "INSERT into  mobiles(mobile_id,mobile_name,processor,dispaly,memory,battery,company_name) values($productid,'$mobile_name','$processor','$display','$memory','$battery','$company')";

 }
 else if($cat_id==2)
 {
 	$Book_name=$_POST['Book_name'];
 	$Author=$_POST['Author'];
 	$Publisher=$_POST['Publisher'];
 	$title=$_POST['Title'];
 	$ISBN=$_POST['ISBN'];
	$sql= "INSERT into  book(book_id,book_name,author_name,title,publisher,ISBN) values($productid,'$Book_name','$Author','$title','$Publisher',$ISBN)";


 }


 else if($cat_id==3)
 {
 	$Car_name=$_POST['Car_name'];
 	$Engine=$_POST['Engine'];
 	$Model=$_POST['Model'];
 	$Company_name=$_POST['Company_name'];
 	$sql= "INSERT into car(car_id,car_name,model_no,company_name,engin) values($productid,'$Car_name',$Model,'$Company_name',$Engine)";
   

 }
 if($cat_id==4)
 {
 	$Food_name=$_POST['Food_name'];
 	$Food_type=$_POST['Food_type'];


 	$sql= "insert into  food(food_id,food_name,food_type) values($productid,'$Food_name','$Food_type')";
   
 }
  else if($cat_id==5)
 {
 	$Cloth_name=$_POST['Cloth_name'];
 	$Color=$_POST['Color'];
 	$Lenght=$_POST['Lenght'];
 	$Company=$_POST['Company'];
 	   $sql= "insert into cloths(cloths_id,cloth_name,color,lenght,company_name) values($productid,'$Cloth_name','$Color',$Lenght,'$Company')";


 }
 if ($cat_id==6)
 {
    $Pet_name=$_POST['Pet_name'];
    $Pet_color=$_POST['Pet_color'];
    $Pet_age=$_POST['Pet_age'];

       $sql= "insert into  pet(pet_id,pet_name,pet_color,pet_age) values($productid,'$Pet_name','$Pet_color',$Pet_age)";
 }

if(mysqli_query($conn, $sql))
{
          
//Image Portion

$img_1="images/";
$img_2="images/";
$img_3="images/";
$type="Seller";

$file=$_FILES['pimage1'];
if(!empty($file))
$img_1.=Upload_Image($file,1,$productid,$type);
else if(empty($file))
$img_1.="noimage.jpg";

$file=$_FILES['pimage2'];
if(!empty($file))
$img_2.=Upload_Image($file,2,$productid,$type);
else if(empty($file))
$img_1.="noimage.jpg";


$file=$_FILES['pimage3'];
if(!empty($file))
$img_3.=Upload_Image($file,3,$productid,$type);
else if(empty($file))
$img_1.="noimage.jpg";

$sql="INSERT into imagesource (img_1,img_2,img_3,product_id) values ('$img_1','$img_2','$img_3',$productid)";
if($conn->query($sql)===TRUE)
{
  //image insertion successful
//Adding counpon now
$num_coupuns=0;
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

      if($use_coupun==1)    //if user used his coupon
      {
        $sql2="UPDATE coupon SET num_coupon = num_coupon -1 WHERE coupon_holder=$accID";
            if($conn->query($sql2)===TRUE)
            {
              echo "Use:updated = -1".$use_coupun;
             header('location: ../show_all_products.php?c=-up');
             exit();
            }
            else
            {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }

       }

    else if($use_coupun==0)
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
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit();
   }

}   //images added successfully and product added
 
 else 
 {
  // header('location: ../show_all_products.php?add=failed');
          echo "Error: " . $sql . "<br>" . $conn->error;
         exit(); 
}

   }
     else {
    echo "Error: " . $sql . "<br>" . $conn->error;
     }

} //if came through button

else
{
	header('location: ../index.php');
	exit();
}
?>
