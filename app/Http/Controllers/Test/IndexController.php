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
    
    public function apiLogin(Request $request){
        $email=$request->input('email');
        $password=$request->input('pass');
        $data =[
            'email' =>$email,
            'pass'  =>$password
        ];
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
       }
    }
    



?>