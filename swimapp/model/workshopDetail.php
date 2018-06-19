<?php
	$token=@$_POST["token"];
	$servername = "127.0.0.1";
	$username = "pi";
	$password = "nccutest";
	$dbname="Swimapp";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	if(!isset($token)){
		echo "false";
	}else{
		$sqlGetU_num='SELECT `U_num` FROM `USER` WHERE `U_mail` = "\'$token\'"';
		$resCheck=$conn->query($sqlGetU_num);

		if($resCheck->num_rows==0){
			
			echo "false";

		}else{

			$row=$resCheck->fetch_assoc();
			$U_num=$row['U_num'];

			$sqlGetTeamNum="SELECT * FROM `Team` WHERE `U_num` = $U_num";

			$resCheckTeamNum=$conn->query($sqlGetTeamNum);

			if($resCheckTeamNum->num_rows==0){
				echo "false";
			}else{

				while($row2=$resCheckTeamNum->fetch_assoc()){
					
					
				}
			
			}

		}

	}

?>