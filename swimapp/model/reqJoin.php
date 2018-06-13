<?php 
	$token=@$_POST["token"];
	$T_num=@$_POST["T_num"];
	$admin=@$_POST["admin"];
	$servername = "127.0.0.1";
	$username = "pi";
	$password = "nccutest";
	$dbname="Swimapp";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$GetNum="SELECT `U_num` FROM `USER` WHERE `U_mail`='".$token."'";
	// echo "GetNum=".$GetNum;
	$result = $conn->query($GetNum);

	if(@$result->num_rows==1){

		$row = $result->fetch_assoc();
		$U_num=$row['U_num'];
		if(isset($token)&& isset($admin) ){
			$sqlGetT_num="SELECT `T_num` FROM `Team` WHERE `U_num`='".$U_num."' ORDER BY `Team`.`T_num` DESC";	
			$resT_num=$conn->query($sqlGetT_num);
			$row = $resT_num->fetch_assoc();
			$T_num=$row['T_num'];
		}

		$checkSql="SELECT * FROM `Group_List` WHERE `T_num` =".$T_num. " and `U_num` =".$U_num;
		$resCheck=$conn->query($checkSql);
		
		if($resCheck->num_rows>0){
			echo "false";
		}else{

			if(isset($admin)){
				$insSql="INSERT INTO `Group_List`(`GL_num`, `T_num`, `U_num`, `GL_Permission`) VALUES (NULL,'".$T_num."','".$U_num."','".$admin."')";
				// echo "insql=".$insSql."<br>";
				$conn->query($insSql);
			}else{
				$insSql="INSERT INTO `Group_List`(`GL_num`, `T_num`, `U_num`, `GL_Permission`) VALUES (NULL,'".$T_num."','".$U_num."','admin:-1')";
				// echo "insql=".$insSql."<br>";
				$conn->query($insSql);
			}
			echo "ture";
		}

	}else{
		echo "false";
	}





	// echo $GetNum;


?>