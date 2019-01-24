{{--用户修改密码--}}
@extends('layouts.bst')

@section('content')
    <form class="form-signin" action="/users/upass" method="post">
        {{csrf_field()}}
        <h2 class="form-signin-heading">用户名</h2>
        <label for="inputNickName">Nickname</label>
        <input type="text" name="nick_name" id="inputNickName" class="form-control" placeholder="nickname" required autofocus>

        <label for="inputPassword" >原密码</label>
        <input type="password" name="u_pass" id="inputPassword" class="form-control" placeholder="***" required>

        <label for="inputPassword2" >要修改的密码</label>
        <input type="password" name="u_pass2" id="inputPassword2" class="form-control" placeholder="***" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">修改</button>
    </form>
@endsection