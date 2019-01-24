<?php
namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Model\UserModel;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
public function users($uid)
{
    echo "$uid";
}
public function test()
{
    echo '<pre>';print_r($_GET);echo '</pre>';
}
public function add()
    {
        $data = [
            'name'      => str_random(5),
            'reg_time'  => time()
        ];

        $id = UserModel::insertGetId($data);
        var_dump($id);
    }

    public function regs()
    {
        return view('reg.regs');
    }

    public function doRegs(Request $request)
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
            'reg_time'  => time(),
            'pass'  => $pass
        ];

        $uid = UserModel::insertGetId($data);

        if($uid){
            setcookie('uid',$uid,time()+86400,'/','cms.com',false,true);
            header("Refresh:3;url=/users/center");
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
        return view('reg.login',$data);
    }

    public function doLogin(Request $request)
    {
        echo '<pre>';print_r($_POST);echo '</pre>';

        $nick_name = $request->input('u_name');
        $pass = $request->input('u_pass');

        $u = UserModel::where(['nick_name'=>$nick_name])->first();

        if($u){
            if( password_verify($pass,$u->pass) ){

                $token = substr(md5(time().mt_rand(1,99999)),10,10);
                setcookie('uid',$u->uid,time()+86400,'/','cms.com',false,true);
                setcookie('token',$token,time()+86400,'/user','cms.com',false,true);

                $request->session()->put('u_token',$token);
                $request->session()->put('uid',$u->uid);

                header("Refresh:3;url=/users/center");
                echo "登录成功";
            }else{
                die("密码不正确");
            }
        }else{
            die("用户不存在");
        }

    }


    /**
     * 个人中心
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function center()
    {
        $data = [];
        return view('reg.center',$data);
    }
    /*
     * 修改密码
     **/
    public function upass()
    {
        $data =[];
        return view('reg.upass',$data);
    }
    public function doUpass(Request $request)
    {
        $nick_name = $request->input('nick_name');

        $u = UserModel::where(['nick_name'=>$nick_name])->first();

        $pass1 = $request->input('u_pass');
        $pass2 = $request->input('u_pass2');


        if($pass1 !== $pass2){
            die("修改成功");
        }else{
            if($pass1==$pass2){
                echo '修改失败';
            }
        }

        $pass = password_hash($pass1,PASSWORD_BCRYPT);

        $data = [
            'nick_name'  => $request->input('nick_name'),
            'reg_time'  => time(),
            'pass'  => $pass
        ];
    }

}
