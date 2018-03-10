<?php 
session_start();
$token=$_POST["token"];
if($_SESSION['token']==$token){
	echo "true";
}else{
	echo "false";
}

?>