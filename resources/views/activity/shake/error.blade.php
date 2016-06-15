<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>玩一玩</title>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<link href="{{ asset('/assetactivity/slotmachine/jquery.slotmachine.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/assetactivity/slotmachine/css/style.css') }}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ asset('/assetactivity/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assetactivity/slotmachine/jquery.slotmachine.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assetactivity/js/jquery.SuperSlide.2.1.1.js') }}"></script>
</head>
<body>
<script type="text/javascript" src="http://zb.weixin.qq.com/nearbycgi/addcontact/BeaconAddContactJsBridge.js"></script>
<div class="wrap">
  <div class="rule error"> <img class="icon" src="{{ URL::asset('/') }}assetactivity/slotmachine/img/exclamation-circle.png" alt="" />
    <p class="msg">{{ $msg }}</p>
  </div>
  <div class="play"><a href="http://vi.ponyhelp.com/shake/shake" class="btn">返回</a></div>
  <div class="copyright bottom">本活动最终解释权归凡森所有</div>
</div>
<script type="text/javascript">
//Ready
$(function(){
	start();
	if($(".wrap").height() < $(window).height())
	{
		$(".wrap").height($(window).height());
	}
});
//初始化
function start(){
	var winwidth = $(window).width();
	var winwidth = winwidth > 600 ? 600 : winwidth;
	$("body,html").css({"font-size":winwidth/30, width:winwidth, margin:"0 auto"});
}
//窗口大小改变
window.onresize = function(){
	start();
}
</script>
</body>
</html>