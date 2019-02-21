<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/goods',GoodsController::class);
    $router->resource('/users',UsersController::class);
    $router->resource('/weixin/userinfo',WeiXinController::class);
    $router->resource('/wxmedia',WeixinMediaController::class); //微信素材管理
    $router->resource('/perpetual',WeixinPerpetualController::class);//永久素材管理
    $router->post('/open','WeixinPerpetualController@sendTextAll');//群发管理
});
