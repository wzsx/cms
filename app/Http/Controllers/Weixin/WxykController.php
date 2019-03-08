<?php
namespace App\Http\Controllers\Weixin;

use App\Model\YkModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp;
use Illuminate\Support\Facades\Storage;
class WxykController extends Controller
{
    protected $redis_weixin_access_token = 'str:weixin_access_token';     //微信 access_token
    protected $redis_weixin_jsapi_ticket = 'str:weixin_jsapi_ticket';     //微信 jsapi_ticket
    public function yk(){
        return view ("weixin.yk");
    }
    public function getWXAccessToken()
    {

        //获取缓存
        $token = Redis::get($this->redis_weixin_access_token);
        if(!$token){        // 无缓存 请求微信接口
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WEIXIN_APPID').'&secret='.env('WEIXIN_APPSECRET');
            $data = json_decode(file_get_contents($url),true);

            //记录缓存
            $token = $data['access_token'];
            Redis::set($this->redis_weixin_access_token,$token);
            Redis::setTimeout($this->redis_weixin_access_token,3600);
        }
        return $token;

    }

    public function token(){
        Redis::del($this->redis_weixin_access_token);
        echo $this->getWXAccessToken();
    }
    public function ddd(){
        return view ("weixin.ddd");
    }
}