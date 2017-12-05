@extends('layouts.layout')
@section('title')
登录
@endsection
@section('content')
<form action="http://127.0.0.1/12/laravel52/public/Redis/login" method="post">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
    username <input type="text" name="username"><br>
    password <input type="password" name="password"><br>
    <input type="submit" value="登陆">
</form>
@endsection

