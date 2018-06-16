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
$groupPic='{"name":"'.$token.'","children":[';
$count=@$result->num_rows;
$myfile =fopen("../json/".$token.".json", "wb");
fwrite($myfile, $groupPic);
$sizeRoot=$result->num_rows;
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
        // $arr2=array('name' =>$row['T_num'],'size'=>3398);
        $groupPic2="{\"name\":\"".$row['T_name'].'","children":[';
        // echo $groupPic2;
        fwrite($myfile, $groupPic2);

        $sqlGrouplist='SELECT * FROM `USER` WHERE `U_num` IN (SELECT `U_num` FROM `Group_List` WHERE`T_num` ='.$row['T_num'].' and `GL_Permission` != "admin:-1" )';

        $resGL = $conn->query($sqlGrouplist);
        $sizeRoot+=$resGL->num_rows;
        $count2=@$resGL->num_rows;
        while($row2 = $resGL->fetch_assoc()){
            $arr3=array("name" =>$row2['U_mail'],"size"=>3398);
            
            // echo json_encode($arr3);
            fwrite($myfile, json_encode($arr3));
            // echo "]";
            // echo ',"size":'.$size*($resGL->num_rows+1)."}";
            // fwrite($myfile,"]");
            
            if($count2!=1){
                // echo ",";
                fwrite($myfile,",");
            }else{
                // echo "";
                fwrite($myfile," ");
                fwrite($myfile,'],"size":'.$size*($resGL->num_rows+1).",\"T_num\":\"".$row['T_num'].'"');
                fwrite($myfile,"}");
            }
            $count2--;
        }
        if($count-- !=1)
            fwrite($myfile,",");

        
    }
    echo "]}";
    fwrite($myfile, "],\"size\":".($sizeRoot*4000)."}");
} else {
    echo "false";
}
$conn->close();



?>