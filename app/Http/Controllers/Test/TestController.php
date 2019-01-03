<?php

namespace App\Http\Controllers\Test;

use App\Model\Cmsmodel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class TestController extends Controller
{
    //

    public function abc()
    {
        var_dump($_POST);echo '</br>';
        var_dump($_GET);echo '</br>';
    }

    public function world1()
    {
        echo __METHOD__;
    }


    public function hello2()
    {
        echo __METHOD__;
        header('Location:/world2');
    }

    public function world2()
    {
        header('Location:http://www.baidu.com');
    }

    public function md($m,$d)
    {
        echo 'm: '.$m;echo '<br>';
        echo 'd: '.$d;echo '<br>';
    }

    public function showName($name=null)
    {
        var_dump($name);
    }

    public function query1()
    {
        $list = DB::table('p_users')->get()->toArray();
        echo '<pre>';print_r($list);echo '</pre>';
    }

    public function query2()
    {
        $user = DB::table('p_users')->where('id', 3)->first();
        echo '<pre>';print_r($user);echo '</pre>';echo '<hr>';
        $root= DB::table('p_users')->where('id', 4)->value('root');
        var_dump($root);echo '<hr>';
        $info = DB::table('p_users')->pluck('age', 'sex')->toArray();
        echo '<pre>';print_r($info);echo '</pre>';


    }


    public function viewtest1()
    {
        $data = [];
        return view('test.index',$data);
    }

    public function viewtest2()
    {
        $list = Cmsmodel::all()->toArray();
        //echo '<pre>';print_r($list);echo '</pre>';

        $data = [
            'title'     => 'XXXX',
            'list'      => $list
        ];

        return view('test.child',$data);
    }
    public function reg(){
        return view('test.reg');
    }
    public function toreg(Request $request){
        echo __METHOD__;
        echo '<pre>';print_r($_POST);echo '</pre>';
        $data=[
            'root' => $request->input('u_name'),
            'email' =>$request->input('u_email'),
            'age' =>$request->input('u_pwd'),
            'reg_time' =>time()
        ];
        $id=Cmsmodel::insertGetId($data);
        var_dump($id);
        if($id){
            echo '注册成功';
        }else{
            echo '注册失败';
        }
    }
    public function users(){
        return view('test.regadd');
    }
    public function userAdd(Request $request){
        echo __METHOD__;
        echo '<pre>';print_r($_POST);echo '</pre>';
        $data=[
            'root' => $request->input('u_name'),
            'age' =>$request->input('u_pwd'),
            'reg_time' =>time()
        ];
        $id=Cmsmodel::insertGetId($data);
        var_dump($id);
        if($id){
            echo '登录成功';
        }else{
            echo '登录失败';
        }
    }
}
