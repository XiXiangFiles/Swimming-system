<?php

/*
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-
+-   Author : Wang Zi Xiang                   +- 
+-   Unit   : Nccu cs                         +- 
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-  
*/
@$ID=$_POST["id"];
@$PWD=$_POST['pwd'];
@$user_name=$_POST['user_name'];
@$user_info=$_POST['user_info'];

$servername = "127.0.0.1";
$username = "pi";
$password = "nccutest";
$dbname="Swimapp";


if(!empty($ID)){

	$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql="SELECT (COUNT(`U_mail`))AS numofU_mail FROM `USER` WHERE `U_mail`='".$ID."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		 while($row = $result->fetch_assoc()) {
		 	if($row['numofU_mail']!=0 && empty($PWD) && empty($user_name) && empty($user_info)){
		 		
		 		$str = array('ID' => 'error' );
		 		 echo json_encode($str);

		 	}else if($row['numofU_mail']==0 && empty($PWD) && empty($user_name) && empty($user_info)){
		 		
		 		$str = array('ID' => 'true' );
		 		echo json_encode($str);

		 	}else if($row['numofU_mail']!=0 && !empty($PWD) && !empty($user_name) && !empty($user_info)){

		 		$str = array('ID' => 'error' );
		 		echo json_encode($str);

		 	}else if($row['numofU_mail']==0 && !empty($PWD) && !empty($user_name) && !empty($user_info)){

		 		$sql2="INSERT INTO `USER`( `U_mail`, `U_pwd`, `U_name`, `U_permission`, `U_info`) VALUES ('".
		 		$ID."','".$PWD."','".$user_name."','admin:-1','".$user_info."')";
		 		// echo '<br>'.$sql2;
		 		$conn->query($sql2);
		 		echo "true";
		 	
		 	}
		 }
	}
}
$conn->close();




 ?>