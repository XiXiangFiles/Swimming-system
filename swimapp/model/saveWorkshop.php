<?php 

	$token=@$_POST["token"];
	$T_num=@$_POST["T_num"];
	$workshopInfo=@$_POST['workshopInfo'];
	$workshopDate=@$_POST["workshopDate"];
	$workshopTime=@$_POST["workshopTime"];
	$set=@$_POST["set"];
	$itemInfo=@$_POST['itemInfo'];
	$time;

	$servername = "127.0.0.1";
	$username = "pi";
	$password = "nccutest";
	$dbname="Swimapp";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	if(!isset($token) && !isset($T_num)){
		echo "false";
	}else{

		$sqlCheck="SELECT `U_num` FROM `USER` WHERE `U_mail` ='$token'";
		$resCheck=$conn->query($sqlCheck);
		if($resCheck->num_rows==0 || $resCheck->num_rows >1){
			echo "false";
		}else{
			$sqlGetP_num="SELECT `P_num` FROM `Program` WHERE `T_num`= $T_num  and `P_name` ='$workshopDate'";
			
			$resGetP_num=$conn->query($sqlGetP_num);
			if($resGetP_num->num_rows==0){
				$sqlInsertProgram="INSERT INTO `Program`(`T_num`, `P_name`, `P_info`) VALUES ('$T_num','$workshopDate','$workshopInfo')";
				$conn->query($sqlInsertProgram);
			}

			$resGetP_num=$conn->query($sqlGetP_num);

			$row = $resGetP_num->fetch_assoc();

			if(gettype($workshopTime)=="array"){
				$time=implode(',', $workshopTime);
			}else{
				$time=$workshopTime;
			}
			$P_num=$row['P_num'];
			$sqlInsertItem="INSERT INTO `ProgramList`(`P_num`, `Time`,`PL_set`,`PL_detail`) VALUES ($P_num,'$time','$set','$itemInfo')";
			$conn->query($sqlInsertItem);
			echo "true";

		
		}

	}	
?>