<?php
include_once'session_check_user.php';
include'includes/dbh.inc.php';
if(isset($_SERVER['HTTP_REFERER']) && isset($_SESSION["email"]) && isset($_GET['req']))
{
  include_once ('LSHeader.php');
  $pid=$_GET['req'];
  $sql="SELECT * from Product where product_id=$pid";
  $result=$conn->query($sql);
  if($result->num_rows > 0 )
  {
    $row1=$result->fetch_assoc();
  }
  else
  {
    echo "Error Retriving Product For update: " . mysqli_error($conn);
      
      exit();
  }

  $cat=$row1['category_id'];

?>



<!-- HTML -->
<script language="javascript">


</script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">

        <h2 style="text-align: center;">Edit Products Details</h2>
<form class="form-horizontal"  action="includes/update_product.inc.php" method="POST">
<fieldset>

<!-- Form Name -->
<!-- Text input-->


<!-- Textarea -->



<?php
if($cat==1)
{

include_once'Product_Edit/edit_mobile.php';
}
else if($cat==2)
{
include_once'Product_Edit/edit_book.php';
}
else if($cat==3)
{
include_once'Product_Edit/edit_car.php';
}
else if($cat==4)
{
include_once'Product_Edit/edit_food.php';
}
else if($cat==5)
{
include_once'Product_Edit/edit_cloth.php';
}
else if($cat==6)
{
include_once'Product_Edit/edit_pet.php';
}
?>


<!-- Text input-->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="textinput">keyword</label>  
  <div class="col-md-4">
  <input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
  <span class="help-block">example:alibaba</span>  
  </div>
</div>
 -->
<!-- Select Basic -->


<div class="form-group" >
  <label class="col-md-4 control-label" for="textarea">Description</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="textarea" name="pdescription"><?php echo $row1['pdescription']?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Price</label>  
  <div class="col-md-4">
  <input id="textinput" name="price" type="text" value="<?php echo $row1['price']?>" class="form-control input-md" required>
<input type="hidden" name="catgry" value="<?php echo $cat;?>">
  </div>
</div>  



<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Product Condition</label>
  <div class="col-md-4">
    <select id="selectbasic" name="pcondition" class="form-control" required>
      <option value="New">Brand New</option>
      <option value="Used">Used / Second Hand</option>
    </select>
  </div>
</div>



<!-- Text input-->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Quantity - unit</label>  
  <div class="col-md-4">
  <input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
 -->    
  <!-- </div> -->
<!-- </div> -->

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Features & Specifications</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="pfands" name="textarea"></textarea>
  </div>
</div>


<!-- Button -->
<div style="text-align: center;">
<div class="form-group ">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    	<button id="singlebutton" type="submit" name="update-item" class="btn btn-success">Update  Product</button>

  </div>
</div>


<div class="form-group ">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
      <a href="show_all_products.php?cnl"><button id="singlebutton" type="button" name="update-item" class="btn btn-info">Cancel Update</button></a>

  </div>
</div>
</div>


<input type="hidden" name="pid" value="<?php echo $pid; ?>">

</form>


<fieldset>

    
<fieldset>
    <legend>Accepted Delivery Terms</legend>
</fieldset>

<fieldset>
    <legend>Accepted Delivery Currency</legend>
</fieldset>

<fieldset>
    <legend>Accepted Delivery Type</legend>
</fieldset>
    
    
</fieldset>


</fieldset>






</div>



<?php
  include_once ('footer.php');
}

else
{
  header('location: index.php');
}
?>