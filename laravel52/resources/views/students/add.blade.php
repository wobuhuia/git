@extends('layouts.layout')
@section('title')
留言板
@endsection
@section('content')
<?php
use DfaFilter\SensitiveHelper;
$word=array(
	'杨兴国'
);
?>

<form action="add" method="post">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
    <textarea name='content'></textarea><br>
    <input type="submit" value="留言">
</form>
<table>
	<tr>
		<th>id</th>
		<th>author</th>
		<th>content</th>
		<th>do</th>
	</tr>
	@foreach($arr as $val)
	<tr>
		<td>{{$val['id']}}</td>
		<td>{{$val['uid']}}</td>
		<td>{{SensitiveHelper::init()->setTree($word)->replace($val['content'], '***')}}</td>
		<td>
			<a href="del/{{$val['id']}}">删除</a>-
			<a href="save/{{$val['id']}}">修改</a>
		</td>
	</tr>
	@endforeach
</table>
{{ $link->links() }}
@endsection

