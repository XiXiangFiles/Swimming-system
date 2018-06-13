<?php 
	$token=@$_GET['token'];
	$T_num=@$_GET['T_num'];
	$servername = "127.0.0.1";
	$username = "pi";
	$password = "nccutest";
	$dbname="Swimapp";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	


?>