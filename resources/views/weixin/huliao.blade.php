@extends('layouts.bst')


@section('content')
    <form  action="/form/hl" method="post" enctype="multipart/form-data" >
       <input type="textarea" name="fs">
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">发送</button>
    </form>
@endsection




