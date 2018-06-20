<?php
	$token=@$_GET["token"];
	$servername = "127.0.0.1";
	$username = "pi";
	$password = "nccutest";
	$dbname="Swimapp";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	// echo "$token";
	if(!isset($token)){
		echo "false";
	}else{
		$sqlGetU_num='SELECT `U_num` FROM `USER` WHERE `U_mail` = "'.$token.'"';

		$resCheck=$conn->query($sqlGetU_num);
		if($resCheck->num_rows==0){
			
			echo "false";

		}else{

			$row=$resCheck->fetch_assoc();
			$U_num=$row['U_num'];

			// $sqlGetTeamNum="SELECT * FROM `Group_List` WHERE `U_num` = $U_num";
			$sqlGetTeamNum="SELECT * FROM `Team` WHERE `T_num` in(SELECT `T_num` FROM `Group_List` WHERE `U_num` = $U_num)";

			$resCheckTeamNum=$conn->query($sqlGetTeamNum);

			if($resCheckTeamNum->num_rows==0){
				echo "false";
			}else{
				echo '{"token":"'.$token.'","workshopes":[';
				$countFather=$resCheckTeamNum->num_rows;
				while($row2=$resCheckTeamNum->fetch_assoc()){
					$T_name=$row2['T_name'];
					echo "{ \"T_name\": \"$T_name\",\"list\":[ ";

					$sqlGetWorkshop='SELECT'. ' Program.P_num, T_num, P_name , P_info , PL_num , Time ,PL_set ,PL_detail FROM `Program` LEFT JOIN `ProgramList` ON Program.P_num=ProgramList.P_num WHERE `T_num` =\''.$row2['T_num']."' ORDER BY `Program`.`P_name` ASC";
					$resWorkshopDetail=$conn->query($sqlGetWorkshop);
					if($resWorkshopDetail->num_rows>0){
						$count=$resWorkshopDetail->num_rows;
						while($row3=$resWorkshopDetail->fetch_assoc()){
							if($resWorkshopDetail->num_rows==1)
								echo '{ "P_name": "'.$row3['P_name'].'", "P_info" : "'.$row3['P_info'].'", "workshop" :[{ "Time" : "'.$row3['Time'].'","set": "'.$row3['PL_set'].'","PL_detail":"'.$row3['PL_detail'] .'"}]}';
							else if($resWorkshopDetail->num_rows>1 &&  $count >1 ){
									echo '{ "P_name": "'.$row3['P_name'].'", "P_info" : "'.$row3['P_info'].'", "workshop" :[{ "Time" : "'.$row3['Time'].'","set": "'.$row3['PL_set'].'","PL_detail":"'.$row3['PL_detail'] .'"}]},';
							}else if($resWorkshopDetail->num_rows>1 &&  $count ==1 ){
									echo '{ "P_name": "'.$row3['P_name'].'", "P_info" : "'.$row3['P_info'].'", "workshop" :[{ "Time" : "'.$row3['Time'].'","set": "'.$row3['PL_set'].'","PL_detail":"'.$row3['PL_detail'] .'"}]}';
							}
							$count--;
						}
					}
					// echo $resWorkshopDetail->num_rows."<br>"."<br>"."<br>";
					if(--$countFather!=0)
						echo "]},";
					else
						echo "]}";
				}
				echo "]}";
			}

		}

	}

?>