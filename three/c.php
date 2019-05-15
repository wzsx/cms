<?php
    $arr=["code"=>1];
    $callback=$_GET["callback"];
    $str=json_encode($arr);
    setcookie("uid",1,time()+36000,"/",".acc.com");
    setcookie("uname","lisi",time()+3600,"/",".acc.com");
    echo "$callback($str)";
?>