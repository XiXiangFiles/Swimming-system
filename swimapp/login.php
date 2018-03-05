<?php 
$ID=$_POST["id"];
$PWD=$_POST['pwd'];

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

$sql = 'SELECT * FROM `USER` WHERE `U_mail` = "'.$ID.'" and `U_pwd` ="'.$PWD.'"';
// echo "string";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $str="{ U_mail:".$row['U_mail'].",U_name:".$row['U_name']."}";
        echo $str;
    }
} else {
    echo "false";
}
$conn->close();

?>