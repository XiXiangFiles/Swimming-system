<?php 
$token=@$_GET['token'];
$T_num=@$_GET['T_num'];

$servername = "127.0.0.1";
$username = "pi";
$password = "nccutest";
$dbname="Swimapp";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sqlGrouplist_N='SELECT * FROM `USER` WHERE `U_num` IN (SELECT `U_num` FROM `Group_List` WHERE`T_num` ='.$T_num.' and `GL_Permission` = "admin:-1" )';

// echo $sqlGrouplist_N."<br>";

$sqlGrouplist='SELECT * FROM `USER` WHERE `U_num` IN (SELECT `U_num` FROM `Group_List` WHERE`T_num` ='.$T_num.' and `GL_Permission` != "admin:-1" )';

$resGL = $conn->query($sqlGrouplist_N);

if(@$resGL->num_rows==0){

	echo "false";

}else{
	$arrNoReq;
	echo "{ \"ReqDone\":[";
	$resALLGL=$conn->query($sqlGrouplist);
	$count=$resALLGL->num_rows;

	while ( $row= $resALLGL->fetch_assoc()) {
			$arrNoReq = array('U_num' =>$row['U_num'] ,'U_name'=>$row['U_name'],'U_info'=>$row['U_info'] );
			echo json_encode($arrNoReq);
			if($count--!=1){
				echo ",";
			}

	}
	echo "],\"Req\":[";

	$count=$resGL->num_rows;
	while($row2= $resGL->fetch_assoc()){
		$arrReq = array('U_num' =>$row2['U_num'] ,'U_name'=>$row2['U_name'],'U_info'=>$row2['U_info'] );
		echo json_encode($arrReq);

		if($count--!=1){
				echo ",";
			}
	}


	echo "]}";
}
$conn->close();

?>