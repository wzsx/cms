<?php
namespace App\Http\Controllers\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller{
    public function index(Request $request){
        $current_url ='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $data =[
            'login' =>$request->get('is_login'),
            'current_url'  => urlencode($current_url),
        ];
        return view('test.index',$data);
    
    }
    public function pss(){
        $pass=$_POST['u_pass'];
        $email=$_POST['u_email'];
        $id = UserModel::where(['u_email'=>$email])->first();
        if(password_verify($pass,$id->pwd)){
            $token = substr(md5(time().mt_rand(1,99999)),10,10);
            setcookie('token',$token,time()+86400,'/','xiuge.52self.cn',false,true);
            setcookie('uid',$id->uid,time()+86400,'/','xiuge.52self.cn',false,true);
            $redis_key_web='str:u:pass:'.$id->uid;
            Redis::set($redis_key_web,$token);
            Redis::expire($redis_key_web,86400);
            $response=[
                'errno'=>0,
                'msg'=>'登录成功'
            ];
        } else {
            $response=[
                'errno'=>5001,
                'msg'=>'用户密码不正确'
            ];

        }
            return $response;
    }
    }


?>