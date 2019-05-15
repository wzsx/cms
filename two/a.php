<?php
$user_id=isset($_COOKIE['uid'])?$_COOKIE['uid']:"";
@$user_name=isset($_COOKIE['uname'])?$_COOKIE['uname']:"";
echo $user_name;
if($user_name){
    echo "登陆成功";
    setcookie('uname','',0,'/','.caa.com');

}else{
  //  header("refresh:1;url=b.html");
//    echo "请重新登录2";

}
?>