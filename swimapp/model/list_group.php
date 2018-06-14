<?php 

$token=@$_GET['token'];

$servername = "127.0.0.1";
$username = "pi";
$password = "nccutest";
$dbname="Swimapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM `Team` WHERE `U_num` = (SELECT `U_num` FROM `USER` WHERE `U_mail`='".$token."')";
$result = $conn->query($sql);
$group='{"group":[';
$groupPic='{"name":'.$token.',"children":[';
$count=@$result->num_rows;
$myfile =fopen("../json/".$token.".json", "wb");
fwrite($myfile, $groupPic);
if (@$result->num_rows > 0) {
	echo $group; 
    // echo $groupPic;
	while($row = $result->fetch_assoc()) {
        $arr=array('T_num' => $row['T_num'], 'U_num' => $row['U_num'], 'T_name' => $row['T_name'],'T_info' => $row['T_info']);
        if($count!=1){
			echo json_encode($arr).",";
        }else{
			echo json_encode($arr);
        }

        
        $size=3938;
        $arr2=array('name' =>$row['T_num'],'size'=>3398);
        if($count!=1){
            // echo json_encode($arr2).",";
            fwrite($myfile, json_encode($arr2).",");
        }else{
            // echo json_encode($arr2);
            fwrite($myfile, json_encode($arr2));
        }
		$count--;
    }
    echo "]}";
    fwrite($myfile, "]}");
} else {
    echo "false";
}
$conn->close();



?>