<?php

	$dbhost = "localhost";
	$dbname = "sic";
	$dbuser = "root";
	$dbpass = '';


	try{
		$db = new PDO("mysql:dbhost=$dbhost;dbname=$dbname", "$dbuser", "$dbpass");
	}catch(PDOException $e){
		echo $e->getMessage();
	}

	



?>