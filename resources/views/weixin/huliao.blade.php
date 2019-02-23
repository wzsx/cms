@extends('layouts.bst')


@section('content')
    <form  action="/form/hl" method="post" enctype="multipart/form-data" >
        <textarea name="fs" id="" cols="30" rows="10"></textarea>
        <h1>客服管理</h1>
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">发送</button>
    </form>
@endsection
@section('footer')
    @parent
    <script src="{{URL::asset('/js/weixin/weixin.js')}}"></script>
@endsection




