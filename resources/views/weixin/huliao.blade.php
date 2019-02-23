@extends('layouts.bst')


@section('content')
    <form  action="/form/hl" method="post" enctype="multipart/form-data" >
        <textarea name="fs" id="" cols="30" rows="10"></textarea>
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">发送</button>
    </form>
@endsection




