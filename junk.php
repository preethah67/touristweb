<?php
$db=mysqli_connect('localhost:3306','root','','travel');
if(!$db){
	die("connection failed".mysqli_connect_error());
}
?>