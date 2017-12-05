@extends('layouts.layout')
@section('title')
修改
@endsection
@section('content')
<form action="http://127.0.0.1/12/laravel52/public/save_act" method="post">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<input type="hidden" name="id" value="{{$arr['id']}}">
    <textarea name='content'>{{$arr['content']}}</textarea><br>
    <input type="submit" value="修改">
</form>
@endsection

