<?php 
    $token=@$_GET['token'];
    $T_name=@$_GET['group_name'];
    $T_info=@$_GET['group_info'];
    
    $servername = "127.0.0.1";
	$username = "pi";
	$password = "nccutest";
	$dbname="Swimapp";
	$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql="SELECT `U_num` FROM `USER` WHERE `U_mail`='".$token."'";
	$result = $conn->query($sql);
	
	if (@$result->num_rows ==1) {
		while($row = $result->fetch_assoc()) {

	        $sql2="INSERT INTO `Team` (`T_num`, `U_num`, `T_name`, `T_info`) VALUES (NULL,'".$row['U_num'] ."','".$T_name."','".$T_info."')";
	         $conn->query($sql2);
	        echo "true";

    	}
	}else{
		echo "false";
	}
 ?>