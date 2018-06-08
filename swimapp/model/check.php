
<?php 
/*
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-
+-   Author : Wang Zi Xiang                   +- 
+-   Unit   : Nccu cs                         +- 
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-  
*/
session_start();
@$token=$_POST["token"];
@$token2=$_SESSION['token'];

// echo "pose_token".$token.'<br>';
// echo "SESSION".$token2.'<br>';
if(!isset($token) || !isset($_SESSION['token']) ){
	echo "false";
}else{
	if($_SESSION['token']== $token && isset($token2) ){
		echo "true";
	}else{
		echo "false";
	}
}


?>