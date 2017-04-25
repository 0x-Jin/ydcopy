<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<title>{{ $title }}</title>
</head>
<body>
<div class='container'>
	<div class="modal" style="display:block">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	
	<h4 class="modal-title">{{ $title }}</h4>
	</div>
	<div class="modal-body">
	<p>{{$message}}</p>
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-primary" onclick="goTo();">确定</button>
	</div>
	</div>
	</div>
	</div>
</div>
</body>
</html>
<script>
var Handler = {
	go:function(url){
		window.location = url;
	},
	setTime:function(mills,func){
		setTimeout(func,mills);
	}
};
Handler.setTime(3000,goTo);
function goTo(){
	Handler.go('{{$url}}')
}
</script>

