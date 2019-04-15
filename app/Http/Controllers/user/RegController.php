<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Model\UserModel;
use Illuminate\Support\Facades\Session;

class RegController extends Controller
{
    //

    public function user($uid)
    {
        echo $uid;
    }

    public function test()
    {
        echo '<pre>';print_r($_GET);echo '</pre>';
    }

    public function add()
    {
        $data = [
            'name'      => str_random(5),
            'age'       => mt_rand(20,99),
            'email'     => str_random(6) . '@gmail.com',
            'reg_time'  => time()
        ];

        $id = UserModel::insertGetId($data);
        var_dump($id);
    }


    /**
     * 用户注册
     * 2019年1月3日14:26:56
     * liwei
     */
    public function reg()
    {
        return view('users.reg');
    }

    public function doReg(Request $request)
    {

        $nick_name = $request->input('nick_name');

        $u = UserModel::where(['nick_name'=>$nick_name])->first();
        if($u){
            die("用户名已存在");
        }

        $pass1 = $request->input('u_pass');
        $pass2 = $request->input('u_pass2');


        if($pass1 !== $pass2){
            die("密码不一致");
        }

        $pass = password_hash($pass1,PASSWORD_BCRYPT);

        $data = [
            'nick_name'  => $request->input('nick_name'),
            'age'  => $request->input('age'),
            'email'  => $request->input('u_email'),
            'reg_time'  => time(),
            'pass'  => $pass
        ];

        $uid = UserModel::insertGetId($data);

        if($uid){
            setcookie('uid',$uid,time()+86400,'/','cms.com',false,true);
            header("Refresh:3;url=/user/center");
            echo '注册成功,正在跳转';
        }else{
            echo '注册失败';
        }
    }

    /**
     * 用户登录
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        $data = [];
        return view('users.login',$data);
    }

    public function doLogin(Request $request)
    {
        echo '<pre>';print_r($_POST);echo '</pre>';

        $emial = $request->input('u_email');
        $pass = $request->input('u_pass');

        $u = UserModel::where(['email'=>$emial])->first();

        if($u){
            if( password_verify($pass,$u->pass) ){

                $token = substr(md5(time().mt_rand(1,99999)),10,10);
                setcookie('uid',$u->uid,time()+86400,'/','cms.com',false,true);
                setcookie('token',$token,time()+86400,'/user','cms.com',false,true);

                $request->session()->put('u_token',$token);
                $request->session()->put('uid',$u->uid);

                header("Refresh:3;url=/user/center");
                echo "登录成功";
            }else{
                die("密码不正确");
            }
        }else{
            die("用户不存在");
        }

    }
public function userlogin(Request $request){
        $emial = $request->input('u_email');
        $pass = $request->input('u_pass');
        $u = UserModel::where(['email'=>$emial])->first();
}


    public function alogin(){
        $user_account=$_POST['user_name'];
        $user_pwd=$_POST['user_pwd'];
        if(empty($user_account)){
            $res_data=[
                'errcode'=>'5010',
                'msg'=>'账号不能为空'
            ];
            return $res_data;
        }
        if(empty($user_pwd)){
            $res_data=[
                'errcode'=>'5010',
                'msg'=>'密码不能为空'
            ];
            return $res_data;
        }
//        if(is_numeric($user_account) || strlen($user_account)==11){
//            $user_where=[
//                'user_tel'=>$user_account,
//                'user_pwd'=>$user_pwd
//            ];
//        }elseif(substr_count($user_account,'@')!=0){
//            $user_where=[
//                'user_email'=>$user_account,
//                'user_pwd'=>$user_pwd
//            ];
//        }else{
//            $user_where=[
//                'user_name'=>$user_account,
//                'user_pwd'=>$user_pwd
//            ];
//        }
        $user_where=[
            'user_name'=>$user_account,
            'user_pwd'=>$user_pwd
        ];
        $user_data=UserModel::where($user_where)->first();
        $ktoken='token:u:'.$user_data['user_id'];
        $token=$token=str_random(32);
        Redis::hSet($ktoken,'app:token',$token);
        Redis::expire($ktoken,3600*24*3);
        if($user_data){
            $res_data=[
                'errcode'=>0,
                'msg'=>'登陆成功',
                'token'=>$token,
                'user_id'=>$user_data['user_id'],
                'user_name'=>$user_data['user_name'],
            ];
        }else{
            $res_data=[
                'errcode'=>'5011',
                'msg'=>'账号或者密码错误'
            ];
        }
        return $res_data;
    }


    /**
     * 个人中心
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function center()
    {
        $data = [];
        return view('users.center',$data);
    }

}
