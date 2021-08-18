<style type="text/css">
  
  p{
    /*color:red !important;*/
     font-size:20px ;
     border-style:solid;
     border-style: groove;

  }

</style>
<?php
include_once'session_check_user.php';

if($_SERVER['HTTP_REFERER'] && isset($_SESSION["email"])) 
{

	include('LSHeader.php');

  if (isset($_GET["limit"]))
  {
      if($_GET["limit"]=="over")
      {
          echo "<p><center>Error Adding Product Product Limit Extend!<center></p>";   
      }
       // header('location: show_all_products.php?limit=over&coupun=1');
  }

  if(isset($_GET["coupun"]))
  {
    if(isset($_GET["cat"]))
    $cat=$_GET["cat"];
    if($_GET["coupun"]=="1")
    {
      ?>

       <p><center>Error Adding Product Limit Extend!</center>
        <center>Congratulations Have Coupon Want To Unlize it?<center></p>
        <div class="form-group ">
        <label class="col-md-4 control-label" for="singlebutton"></label>
        <div class="col-md-4">
          <?php
          if($Doner)
          {?>
            <a href="doner_add_product.php?cat=<?php echo $cat?>&use=coupun"><button id="singlebutton" type="button" class="btn btn-info">Use Coupon</button></a>

            <?php
          }
          else if(!$Doner)
          {?>
            
            <a href="add_new_product.php?cat=<?php echo $cat?>&use=coupun"><button id="singlebutton" type="button" class="btn btn-info">Use Coupon</button></a>
            <?php

          }

          ?>
        
      </div>
    </div>
    <div class="form-group ">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
      <a href="show_all_products.php?cnl"><button id="singlebutton" type="button" class="btn btn-warning">Cancel Adding</button></a></div></div>

    <?php
      include'footer.php';
      exit();
    }
      else if($_GET["coupun"]=="0")
      {
        echo "<p style='color:red !important; font-size:20px'><center>Error Adding Product Product Limit Extend And Coupun is Either Already Used Or Not Received!<center></p>"; 
      }

    }

  else if(isset($_GET["cat"]))
    {
      $cat=$_GET["cat"];
      header('location: add_new_product.php?cat='.$cat);
      exit();

    }



?>
<style type="text/css">
  .form-group
  {
    /*align-content: center;*/
    display: block;
    margin-left: 30%;
    text-align: center;
    margin-right: -50%;


  }
</style>
<div class="container">
<h2><center>Select Product Category</center></h2>
<form class="form-horizontal"  action="includes/check_coupon.inc.php" method="POST">
<fieldset>

<div class="form-group cat">
  <label class="col-md-4 control-label" for="selectbasic">
    </label>
  <div class="col-md-4 procat" >
    <select id="selectbasic" id="catID" name="pcategory" class="form-control" required>
      <option value="1">Mobile</option>
      <option value="2">Book</option>
      <option value="3">Vehicle</option>
      <option value="4">Food</option>
      <option value="5">Clothes</option>
      <option value="6">Pet</option>

    </select>

  </div>
</div>
<div >
<div class="form-group ">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
      <button id="singlebutton" type="submit" name="category-submit" class="btn btn-success">Proceed Furthur</button>

  </div>
</div>


<div class="form-group ">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
      <a href="show_all_products.php?cnl"><button id="singlebutton" type="button" class="btn btn-info">Cancel Adding</button></a>

  </div>
</div>
</div>

</div>
</fieldset>
</form>


<?php

include_once 'footer.php';
}

else
{
	header('location: index.php');
}

?>