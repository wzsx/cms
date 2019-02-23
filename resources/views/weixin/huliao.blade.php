@extends('layouts.bst')


@section('content')
    <form  action="/form/hll" method="post" enctype="multipart/form-data" >
        <h1>客服管理</h1>
        <textarea name="fs" id="" cols="30" rows="10">聊天记录</textarea>
        {{csrf_field()}}
        <input type="text" name="ts">
        <button type="submit" class="btn btn-default">发送</button>
    </form>
@endsection
@section('footer')
    @parent
    <script src="{{URL::asset('/js/weixin/weixin.js')}}"></script>
@endsection




