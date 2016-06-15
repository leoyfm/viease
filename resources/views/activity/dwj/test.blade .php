<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>端午节活动</title>
<meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="full-screen" content="yes"/>
<meta name="screen-orientation" content="portrait"/>
<meta name="x5-fullscreen" content="true"/>
<meta name="360-fullscreen" content="true"/>
<link rel="stylesheet" href="{{ asset('/dwj') }}/style/main.css">
<style type="text/css">
.inner{ width: 100%;  font-size: 20px; color: #196849; background: #b0fff7;}
.top-title{ text-align: center; border-bottom: #196849;}
.top-list{ padding:40px 20px; }
.top-list .item{ padding: 10px 0; width: 100%;}
.top-list .item>div{ width: 33.33%; display: inline-block;}
</style>
</head>
<body>
<div class="inner">
	<h2 class="top-title">中奖名单</h2>
	<div class="top-list">
		<div class="item">
			<div>姓名</div>
			<div>电话</div>
			<div>分数</div>
		</div>
		@foreach( $participarts as $user )
		<div class="item">
			<div>{{ $user->name }}</div>
			<div class="tel">{{ $user->tel }}</div>
			<div>{{ $user->score }}</div>
		</div>
		@endforeach
	</div>
</div>
<script src="{{ asset('/dwj') }}/js/jquery.min.js"></script> 
<script src="{{ asset('/dwj') }}/js/web.js"></script> 
<script>
$(function(){
	$(".tel").each(){
		var temp = $(this).html();
		temp = temp.substr(0,3)+"****"+temp.substr(7);
		$(this).html(temp);
	}
});
</script>
</body>
</html>
