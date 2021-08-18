<?php
include_once 'doner_header.php';
if(isset($_SERVER['HTTP_REFERER']))
{
	if (isset($_GET['cat'])) 
	{
		$category=$_GET['cat'];
		include_once 'includes/donercategoryList.inc.php';
	}




include_once 'footer.php';

}
else
{
	header('location: index.php');
}
?>
