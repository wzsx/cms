<?php

namespace App\Http\Controllers\Weixin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp;
use Illuminate\Support\Facades\Storage;
class ApiController extends Controller
{
public function password(){
    $url="http://curl.com/jiami.php";
    $str = "Hello world";
    $method="AES-128-CBC";
    $key="key";
    $option=OPENSSL_RAW_DATA;
    $time=time();
    $salt="salt88";
    $iv=substr(md5($time.$salt),5,16);
    $enc_str = openssl_encrypt(json_encode($data),$str,$method,$key,$option,$iv);
    $res = $client->request('POST',$url,['info'=>$enc_str]);
    print_r($res);exit;
    echo $res->getbody();
}


}