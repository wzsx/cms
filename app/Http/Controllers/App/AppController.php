<?php
namespace App\Http\Controllers\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Routing\Router;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;
class AppController extends Controller
{
    public function apireg(Request $request){
        $name=$request->input('name');
        $pass=$request->input('pass');;
        $data =[
            'name' =>$name,
            'pass'  =>$pass,
        ];
        //var_dump($data);die;
        $url='http://pass.52xiuge.com/reg';
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        //执行命令
        $r2 = curl_exec($curl);
        $re2=json_decode($r2,true);
        //var_dump($re2);die;
        return $re2;

    }


    public function apiLogin(Request $request){
        $email=$request->input('email');
        $password=$request->input('pass');
        $data =[
            'email' =>$email,
            'pass'  =>$password
        ];
        //var_dump($data);die;
        $url='http://pass.52xiuge.com/pss';
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        //执行命令
        $r2 = curl_exec($curl);
        $re2=json_decode($r2,true);
        //var_dump($re2);die;
        return $re2;

    }

    public function ss(){

    }

    public function reg(Request $request){
        $name=$request->input("name");
        $pass=$request->input("pass");
        $arr['code']=111;
        return $arr=json_encode();
    }
    public function apptoken(){
        $redis= new Redis();
        $redis->connect("127.0.0.1",6379);

        $key = "token_app";
        $useToken = $redis->scard($key);
        for($i=0;$i<100-$useToken;$i++){
            $num=rand(100,1000000).time();
            $token=md5($num);
            $start=rand(0.10);
            $end=rand(11,32);
            $token=substr($token,$start,$end);
            $redis->sadd($key,$token);
        }
    }
    public function logins(){
        $token=Redis::SPOP('token_app');
        return json_encode($token);
    }
    public function token(){
        $key='token_app';
        $useToken=Redis::scard($key);
        for($i=0;$i<100-$useToken;$i++){
            $num=rand(100,100000).time();
            $token=md5($num);
            $start=rand(0.10);
            $end=rand(11,32);
            $token=substr($token,$start,$end);
            Redis::sadd($key,$token);
        }
    }
}
?>