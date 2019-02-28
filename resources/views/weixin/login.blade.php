@extends('layouts.bst')

@section('content')
    <div class="container">
        <h2>微信登录</h2>
        <h3>
            <a href="https%3a%2f%2fopen.weixin.qq.com%2fconnect%2fqrconnect%3fappid%3dwxe24f70961302b5a5%26redirect_uri%3dhttp%3a%2f%2fmall.77sc.com.cn%2fweixin.php%3fr1%3dhttp%3a%2f%2fxiuge.52self.cn%2fweixin%2fgetcode%26response_type%3dcode%26scope%3dsnsapi_login%26state%3dSTATE%23wechat_redirect">Login</a>
        </h3>
    </div>
@endsection
@section('footer')
    @parent
    <script src="{{URL::asset('/js/weixin/chat.js')}}"></script>
@endsection