<?php
    $arr=["code"=>1];
    $callback=$_GET["callback"];
    $str=json_encode($arr);
    setcookie("uid",1,time()+3600,"/",".caa.com");
    setcookie("uname","lisi",time()+3600,"/",".caa.com");
    echo "$callback($str)";
?>