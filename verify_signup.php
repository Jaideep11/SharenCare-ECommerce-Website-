<?php
// if($_SERVER['HTTP_REFERER']) 
if(1)
{
	include_once ('LSHeader.php');
	$selector =$_GET["selector"] ;
	$validator=$_GET["validator"];
	if (empty($selector) || empty($validator) ) 
	{
		echo "SIC couldn't verify its You";	

	}
	else
	{
		if (ctype_xdigit($selector)!==false && ctype_xdigit($validator) ) //if validator and password matches
		{
			?>


			<section class="my_form">
			 <img src="img/passwordreset.png" width="150px" class="img-responsive" >
			<center><h1>Verify SignUp</h1></center>

			<form id="form" action="includes/create_acc.inc.php" method="post">
			  <input type="hidden" name="selector" value="<?php echo $selector; ?>">
			  <input type="hidden" name="validator" value="<?php echo $validator; ?>">
			  <button class="btn-success" type="submit" name="confirm-signup-submit">Confirm And Create Account</button>
			</form>
			</section>


			<?php
		}

	}

?>


?>
<?php
include_once 'footer.php';
}
else
{
	header('location: index.php');
}
?>