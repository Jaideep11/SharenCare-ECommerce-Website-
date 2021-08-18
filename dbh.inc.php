<?php  

$serverName ="localhost";
$dBUserName ="root";
$dBPassword ="";
$dBName ="SIC";

$conn=mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

if (!$conn) {
	die("Connection Failed:" .mysqli_connect_error());
}