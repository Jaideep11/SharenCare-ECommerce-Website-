<?php
if($_SERVER['HTTP_REFERER'] && (isset($_GET["cat"]) || isset($_GET["use"])) )
{
  include_once ('doner_LSHeader.php');

if($_GET["cat"])
$cat=$_GET["cat"];

if(isset($_GET["use"]))
{
  if($_GET["use"]=="coupun")
  $use_coupon=1;
}


  ?>

<!-- HTML -->
<script language="javascript">


</script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">

        <h2 style="text-align: center;">Add Products</h2>
<form class="form-horizontal"  action="includes/add_doner_product.inc.php" method="POST" enctype="multipart/form-data">
<fieldset>


<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Product Name:</label>  
  <div class="col-md-4">
  <input id="textinput" name="pname" type="text" required class="form-control input-md">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Description</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="textarea" name="pdescription" required></textarea>
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

<!-- Text input-->
<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">1st Product Image*</label>
  <div class="col-md-4">
    <input id="filebutton" name="pimage1" class="input-file" type="file" >
  </div>
</div>

<p style="color:blue ; text-align: center;">
Allowed File Types Are: .png .jpg .jpeg<br>
Max Size= 8 mb
</p> 
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
      <button id="singlebutton" type="submit" name="publish-doner-item" class="btn btn-success">Add New Product</button>

  </div>
</div>


<div class="form-group ">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
      <a href="show_all_products.php?cnl"><button id="singlebutton" type="button" name="upublish-doner-item" class="btn btn-info">Cancel Adding</button></a>

  </div>
</div>
</div>


<input type="hidden" name="pid" value="<?php echo $pid; ?>">
<input type="hidden" name="cat" value="<?php echo $cat; ?>">
<input type="hidden" name="use_coupon" value="<?php echo $use_coupon; ?>">
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