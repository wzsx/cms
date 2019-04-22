<?php
namespace App\Http\Controllers\Xm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Routing\Router;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;
class XmController extends Controller{
    public function demo(){

        return view('weixin.logins');
    }
    public function demo2(Request $request)

{


    $name = $request->input('name');
    $password = $request->input('pwd');

    //echo $password;

        $uid = $name;

        $key = 'token:' . $uid;
            $token = substr(md5(time() + $uid + rand(1000,9999)),10,20);
            Redis::del($key);
            Redis::set($key,$token);
    header("refresh:0;/demo3?token=$token&uid=$uid");
}
public function demo3(Request $request){
    $token=$request->input('token');
    $uid=$request->input('uid');

    $key = 'token:' . $uid;

    $tokens = Redis::get($key);
    if($token!=$tokens){
        echo 'NO';
    }else{
        echo "OK";
    }
}
}
?>