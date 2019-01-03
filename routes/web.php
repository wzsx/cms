<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    echo date('Y-m-d H:i:s' );
    //return view('welcome');
});
Route::get('user','user\User@test');
Route::get('vip/{id}','vip\vip@vip');
Route::get('user/add','user\User@add');
Route::get('user/update/{id}','user\User@update');
Route::get('user/update/{id}','user\User@update');
Route::get('user/delete/{id}','user\User@delete');
Route::get('/month/{m}/date/{d}','user\User@md');
//路由跳转
Route::redirect('/hello1','/world1',301);
Route::get('/world1','Test\TestController@world1');

Route::get('hello2','Test\TestController@hello2');
Route::get('world2','Test\TestController@world2');
//view视图
Route::view('/mvc','mvc');
Route::view('/error','error',['code'=>40300]);


// Query Builder
Route::get('/query/get','Test\TestController@query1');
Route::get('/query/where','Test\TestController@query2');


//Route::match(['get','post'],'/test/abc','Test\TestController@abc');
Route::any('/test/abc','Test\TestController@abc');


Route::get('/view/test1','Test\TestController@viewtest1');
Route::get('/view/test2','Test\TestController@viewtest2');
//用户注册
Route::get('/userreg','Test\TestController@reg');
Route::post('/userreg','Test\TestController@toReg');
//用户登录
Route::get('/userup','Test\TestController@users');
Route::post('/userup','Test\TestController@userAdd');