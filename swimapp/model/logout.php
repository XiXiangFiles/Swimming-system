<?php 
/*
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-
+-   Author : Wang Zi Xiang                   +- 
+-   Unit   : Nccu cs                         +- 
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-  
*/
	session_start();
 	if(isset($_COOKIE['f_login'])){
 		$_SESSION['token']="logout";
 		setcookie("f_login","",time()-2592000);
 		echo "true";
 		// header("Location: http://140.119.163.195/swimapp");  
 	}else{
 		$_SESSION['token']="logout";
 		setcookie("f_login","",time()-2592000);
 		echo "true";
 		// header("Location: http://140.119.163.195/swimapp");  
 	}

?>