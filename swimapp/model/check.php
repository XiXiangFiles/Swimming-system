
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
if($_SESSION['token']==$token){
	echo "true";
}else{
	echo "false";
}

?>