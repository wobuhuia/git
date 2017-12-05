<!DOCTYPE html>
<html>
<head>
	<title>添加日程</title>
</head>
<body>
	<form action="http://127.0.0.1/12/laravel52/public/Redis/add" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		
		内容<textarea name='content'></textarea>
		<br>
		日期<input type="text" name="time" class="sang_Calender">
		<br>
		提醒	是<input type="radio" name="static" value="1" checked>
				否<input type="radio" name="static" value="0">
		<br>
		<input type="submit" value="添加">
	</form>
</body>
<script type="text/javascript" src="http://127.0.0.1/12/laravel52/public/datetime.js"></script>
</html>