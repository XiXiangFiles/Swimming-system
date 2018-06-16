<?php 
$token=@$_GET['token'];
$T_name=@$_GET['T_name'];

$servername = "127.0.0.1";
$username = "pi";
$password = "nccutest";
$dbname="Swimapp";

if(isset($token)){
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$sql='SELECT * FROM `Team` WHERE `T_name` LIKE' .'"%'.$T_name.'%"';
	$result = $conn->query($sql);
	$count=@$result->num_rows;

	if(@$result->num_rows==0){
		$group='{"group":[';
		$sql2="SELECT * FROM `Team` WHERE 1";
		$res=$conn->query($sql2);
		$count2=@$res->num_rows;

		if($res->num_rows == 0){
			while($row = $res->fetch_assoc()) {
		        $arr=array('T_num' => $row['T_num'], 'U_num' => $row['U_num'], 'T_name' => $row['T_name'],'T_info' => $row['T_info']);
		        if($count!=1){
					echo json_encode($arr).",";
		        }else{
					echo json_encode($arr);
		        }
				$count2--;
    		}
    		echo "]}";
		}else{
			echo "false";
		}
		
	}else{

		$group='{"group":[';
		$count=@$result->num_rows;
		if (@$result->num_rows > 0) {
			echo $group; 
			while($row = $result->fetch_assoc()) {
		        $arr=array('T_num' => $row['T_num'], 'U_num' => $row['U_num'], 'T_name' => $row['T_name'],'T_info' => $row['T_info']);
		        if($count!=1){
					echo json_encode($arr).",";
		        }else{
					echo json_encode($arr);
		        }
				$count--;
		    }
		    echo "]}";

		} else {
		    echo "false";
		}
	}
}else{
	echo "false";
}
$conn->close();

?>