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
@if ( isset($js) )
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  wx.config(<?php echo $js->config(array('onMenuShareQQ','onMenuShareQZone', 'onMenuShareWeibo','onMenuShareTimeline','onMenuShareAppMessage'), false, true) ?>);

  var showTicket = '{{ url('activities/dwj/ticket',$cuser->id) }}';
  wx.ready(function(){

      var data = {
          title: '法治频道，“粽”有好礼',
          desc:'端午节，玩游戏，送好礼。',
          link:'http://fzpd.ponyhelp.com/activities/11',
          imgUrl: '{{ asset("/dwj/images/bg_pic.png") }}',
      };
      wx.onMenuShareTimeline( data);
      wx.onMenuShareAppMessage( data);
      wx.onMenuShareQQ( data);
      wx.onMenuShareWeibo( data);
      wx.onMenuShareQZone( data);
  });
</script>
@endif
<style type="text/css">
*{ margin:0; }
.inner{ width: 100%;  font-size: 20px; color: #196849; background: #b0fff7;}
.top-title{ text-align: center; border-bottom: #196849 4px solid;}
.top-list{ padding:40px 20px; }
.top-list .item{ padding: 10px 0; width: 100%; text-align: center;}
.top-list .item>div{ width: 30%; display: inline-block;}
.top-list .item .name{ width: 20%; }
.top-list .item .tel{ width: 50%; }
.top-list .item .score{ width: 20%; }
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
			<div class="name">{{ $user->name }}</div>
			<div class="tel">{{ $user->tel }}</div>
			<div class="score">{{ $user->score }}</div>
		</div>
		@endforeach
	</div>
</div>
<script src="{{ asset('/teams') }}/js/jquery.min.js"></script>
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
