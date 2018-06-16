<?php 

$T_num=@$_GET['T_num'];
$reqJoin=@$_GET['reqJoin'];
$ReqCancelSet=@$_GET['ReqCancelSet'];

$servername = "127.0.0.1";
$username = "pi";
$password = "nccutest";
$dbname="Swimapp";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
// echo "reqJoin = ".$reqJoin."<br>";
// echo "ReqCancelSet = ".$ReqCancelSet."<br>";

if(isset($T_num)){
	$sqlQuit;
	$sqlJoin;
	if(isset($ReqCancelSet)){
		if(gettype($ReqCancelSet)=="array"){
			for($i=0 ; $i < count($ReqCancelSet) ; $i++ ){
				$sqlQuits='UPDATE `Group_List` SET `GL_Permission`="admin:-1" WHERE `T_num`= '.$T_num.' and  `U_num` = '. $ReqCancelSet[$i]. ' and `GL_Permission` = "admin:general"';
				$conn->query($sqlQuits);
				// echo $sqlQuits."<br>";	
			}
		}else{
			$sqlQuits='UPDATE `Group_List` SET `GL_Permission`="admin:-1" WHERE `T_num`= '.$T_num.' and  `U_num` = '. $ReqCancelSet. ' and `GL_Permission` = "admin:general"';
			$conn->query($sqlQuits);
			// echo $sqlQuits."<br>";
		}
	}

	if(isset($reqJoin)){

		if(gettype($reqJoin)=="array"){
			for($i=0 ; $i < count($reqJoin) ; $i++ ){

				$sqlJoin='UPDATE `Group_List` SET `GL_Permission`=\'admin:general\' WHERE `T_num`= '.$T_num.' and  `U_num` = '. $reqJoin[$i]. ' and `GL_Permission` = "admin:-1"';
				$conn->query($sqlJoin);
				// echo $sqlJoin."<br>";
			}
		}else{

			$sqlJoin='UPDATE `Group_List` SET `GL_Permission`=\'admin:general\' WHERE `T_num`= '.$T_num.' and  `U_num` = '. $reqJoin. ' and `GL_Permission` = "admin:-1"';
			
			$conn->query($sqlJoin);
			// echo $sqlJoin."<br>";

		}

	}

}else{
	echo "false";
}
$conn->close();


?>