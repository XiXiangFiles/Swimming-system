<?php 
    $ID=$_POST["id"];
    $PWD=$_POST['pwd'];
    if ((isset($ID)==0 && isset($_COOKIE['f_login'])==0)  || (isset($PWD)==0 && isset($_COOKIE['f_login'])==0)) {
        echo "false";
    }else if(isset($_COOKIE['f_login'])){
        echo $_COOKIE['f_login'];
    }else{
        $arr=array("id"=>$ID,"pwd"=>$PWD);
        $data=json_encode($arr);
        setcookie("f_login",$data,time()+2592000);
        
    }
    
?>