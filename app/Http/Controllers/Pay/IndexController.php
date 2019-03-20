<?php

namespace App\Http\Controllers\Pay;

use App\Model\OrderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //

    public function index(){

    }

    /**
     * 订单支付
     *
     */
    public function order($oid){
        //查询订单
        $order_info = OrderModel::where(['oid'=>$oid])->first();
        if(!$order_info){
            die("订单 ".$oid. "不存在！");
        }
        //检查订单状态 是否已支付 已过期 已删除
        if($order_info->pay_time > 0){
            die("此订单已被支付，无法再次支付");
        }

        //调起支付宝支付


        //支付成功 修改支付时间
        OrderModel::where(['oid'=>$oid])->update(['pay_time'=>time(),'pay_amount'=>rand(1111,9999),'is_pay'=>1]);

        //增加消费积分 ...

        header('Refresh:2;url=/user/center');
        echo '支付成功，正在跳转';

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
                 //header("Refresh:3;url=/user/center");
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
     
                     //header("Refresh:3;url=/user/center");
                     echo "登录成功";
                 }else{
                     die("密码不正确");
                 }
             }else{
                 die("用户不存在");
             }
     
         }

?>
