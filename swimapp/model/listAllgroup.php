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
		$group='{"name":"root" ,"children":[';
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
    		echo "], \"size\":\"3398\"}";
		}else{
			echo "false";
		}
		
	}else{
		$myfile =fopen("../json/allGroupMember.json", "wb");
		$group='{"name":"root" ,"children":[';
		fwrite($myfile, $group);
		$count=@$result->num_rows;
		if (@$result->num_rows > 0) {
			echo $group; 
			while($row = $result->fetch_assoc()) {
				$children="[";
				$sqlChildren="SELECT `U_mail`,`U_name` FROM `USER` WHERE `U_num` in (SELECT `U_num` FROM `Group_List` WHERE `T_num`=".$row['T_num'].")";
				$resChildren=$conn->query($sqlChildren);
				$childCount=0;
				while($rowChildren = $resChildren->fetch_assoc()){

					$arrChild=array('name' =>$rowChildren['U_name'], 'size'=>3398 );
					$children=$children.json_encode($arrChild);
					if(++$childCount!=$resChildren->num_rows)
						$children=$children.",";
				}
				$children=$children."]";
				// fwrite($myfile, $children);
				$T_num=$row['T_num'];
				$T_name= $row['T_name'];
				$T_info=$row['T_info'];
		        $arr=array('T_num' => $row['T_num'],'T_name' => $row['T_name'],'T_info' => $row['T_info'],'children'=> $children);
		        if($count!=1){
		        	// fwrite($myfile, json_encode($arr));
		        	fwrite($myfile, '{"T_num":'.$T_num.',"name":"'.$T_name.'","T_info":"'.$T_info.'","children":'.$children.',"size":"6000"},');
		        	echo '{"T_num":'.$T_num.',"T_name":"'.$T_name.'","T_info":"'.$T_info.'","children":'.$children.',"size":"5000"},';
					// echo json_encode($arr).",";
		        }else{
					// echo json_encode($arr);
					echo '{"T_num":'.$T_num.',"T_name":"'.$T_name.'","T_info":"'.$T_info.'","children":'.$children.'}';
					fwrite($myfile, '{"T_num":'.$T_num.',"name":"'.$T_name.'","T_info":"'.$T_info.'","children":'.$children.',"size":"6000"}');
		        }
				$count--;
		    }
		    echo "], \"size\":\"3398\"}";
		    fwrite($myfile, "], \"size\":\"3398\"}");

		} else {
		    echo "false";
		}
	}
}else{
	echo "false";
}
$conn->close();

?>