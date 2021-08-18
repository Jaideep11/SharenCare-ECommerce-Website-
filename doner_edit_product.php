  <?php
include_once'session_check_user.php';
include'includes/dbh.inc.php';
if(isset($_SERVER['HTTP_REFERER']) && isset($_SESSION["email"]) && isset($_GET['req']))
{
  include_once ('LSHeader.php');
  $pid=$_GET['req'];
    $sql="SELECT dpname,pdescription from donate_product where dpid=$pid";

  $result=$conn->query($sql);
  if($result->num_rows > 0 )
  {
    $row1=$result->fetch_assoc();
  }
  else
  {
    echo "Error Retriving Doner Product For update: " . mysqli_error($conn);
      exit();
  }

  ?>

<!-- HTML -->

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">

        <h2 style="text-align: center;">Add Products</h2>
<form class="form-horizontal"  action="includes/update_product.inc.php" method="POST">
<fieldset>


<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Product Name:</label>  
  <div class="col-md-4">
  <input id="textinput" name="pname" type="text" value="<?php echo $row1['dpname']?>" class="form-control input-md">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Description</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="textarea" name="pdescription" ><?php echo $row1['pdescription']?></textarea>
  </div>
</div>

<!-- Text input-->
<fieldset>
<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Select Category</label>
  <div class="col-md-4">
    <select id="selectbasic" id="catID" name="pcategory" class="form-control" >
      <option value="1">Mobile</option>
      <option value="2">Book</option>
      <option value="3">Vehicle</option>
      <option value="4">Food</option>
      <option value="5">Clothes</option>
      <option value="6">Pet</option>
    </select>  
</div>
</div>
</fieldset>



<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Product Condition</label>
  <div class="col-md-4">
    <select id="selectbasic" name="pcondition" class="form-control" required>
      <option value="New">Brand New</option>
      <option value="Used">Used / Second Hand</option>
    </select>
  </div>
</div>


<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Features & Specifications</label>  
  <div class="col-md-4">
  <input id="textinput" name="pfands" type="text" placeholder="" class="form-control input-md">
    
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