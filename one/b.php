<?php
$user_id=$_COOKIE['uid'];
@$user_name=$_COOKIE['uname'];
if($user_name){
    echo "登陆成功";
    setcookie('uname',"",0,'/','.caa.com');


}else{
//header("refresh:1;url=a.html");
//    echo "请重新登录2";
}

?>