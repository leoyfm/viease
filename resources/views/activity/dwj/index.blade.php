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
@if ( isset($js) )
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  wx.config(<?php echo $js->config(array('onMenuShareQQ','onMenuShareQZone', 'onMenuShareWeibo','onMenuShareTimeline','onMenuShareAppMessage'), false, true) ?>);

  var showTicket = '{{ url('activities/dwj/ticket',$cuser->id) }}';
  wx.ready(function(){

      var data = {
          title: '法治频道，“粽”有好礼',
          desc:'端午节，玩游戏，送好礼。',
          link:'http://viease.ponyhelp.com/activities/11',
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
<script>
if (typeof replacedRes != "undefined") {
	top.G_eqiwanReplacedRes = replacedRes
} else if (typeof G_eqiwanReplacedRes != "undefined") {
	top.G_eqiwanReplacedRes = G_eqiwanReplacedRes
}
window.G_eqiwan = ""
</script>
<script src="{{ asset('/dwj') }}/js/preloader.min.js" ></script>
</head>
<body>
<canvas id="gameCanvas" width="800" height="450"></canvas>
<script src="{{ asset('/dwj') }}/js/game.js"></script>
<div id='wx_logo' style='margin:0 auto;display:none;'> <img src="{{ asset('/dwj') }}/images/face.png" width="300px" height="300px" /> </div>
<div class="main-mask all-black"></div>
<div class="main-orient">
  <div class="orient-content">
    <div class="orient-desc">为了更好的体验，请使用竖屏浏览</div>
  </div>
</div>
<div class="main-layout" >
  <div class="overdue-tip">活动已过期,分数将不予提交</div>
  <!-- Load 加载层 -->
  <div id="perloadLayer" class="preload-layer"> <img res-name="load-gif" class="load" alt="loading" src="{{ asset('/dwj') }}/images/load.gif"> </div>
  <img src="" class="share-tip" res-name="share-img"> 
  <!-- Load 弹出框 -->
  <div class="load-box"> <img res-name="load-gif" src="{{ asset('/dwj') }}/images/load.gif" />
    <div class="status-text">加载中...</div>
  </div>
  <!-- 开始层 -->
  <div id="startLayer" class="start-layer layer"> <img src="" res-name="start-bg" class="bg">
    <div class="copyright" style="position:absolute; left:0; bottom:10px; text-align:center; z-index:5; font-size:16px; width:100%; color:#19684B;">技术支持：凡森科技</div>

    <div class="test" style="position:absolute; right:30px; top:30px; z-index:6; font-size:20px; color:#000; display: none;">测试提交</div>
    <div style=" position:absolute; top:50%; left:0; width:100%; text-align:center;">
      <div class="start-btn btn_style">开始</div>
      <div>
        <div class="resume-btn btn_style">活动介绍</div>
        <div class="rank-btn btn_style">排行榜</div>
      </div>
    </div>
  </div>
  <!-- 结束弹框 -->
  <div id="endLayer" class="layer">
    <div class="end-panel panel" > <img src="" res-name="end-panel" class="bg"> <img class="close-btn" res-name="close-btn" src="" />
      <p class="score-text"> <span>得分</span> <b id="score-num">1</b> </p>
      <div res-name="collect-info" class="collect-info">
        <div class="input-group"> <span>
          <label>姓名</label>
          <input type="text" id="nameInput" placeholder="请输入获奖人姓名"/>
          </span> </div>
        <div class="input-group"> <span>
          <label>电话</label>
          <input type="text" id="mobileInput" placeholder="请输入获奖人手机号码" maxlength="11"/>
          </span> </div>
        <div class="submit_btn">提交</div>
      </div>
      <div class="btn-group">
        <div class="back-btn btn_style">再来一次</div>
        <div class="end-rank-btn btn_style">排行榜</div>
      </div>
    </div>
  </div>
  <!-- 说明弹框 -->
  <div id="resumeLayer" class="layer">
    <div class="resume-panel panel"> <img src="" res-name="resume-pic" class="bg"> <img class="close-btn" res-name="close-btn" src="" />
      <div class="resume-panel"></div>
    </div>
  </div>
  <!-- 排行榜弹框 -->
  <div id="rankLayer" class="layer">
    <div class="rank-panel panel"> <img src="" res-name="rank-panel" class="bg"> <img class="close-btn" res-name="close-btn" src="" />
      <div class="user-info"> <span class="face"><img src="{{ asset('/dwj') }}/images/face.png" alt=""></span> 
      <span class="name2">  </span> <span class="score-title">得分</span> <span class="rank-title">排名</span> <span class="score2">   </span> <span class="rank" myself="">未上榜</span> </div>
      <div class="rank-list" style="display: none;"><span class="name"></span><span class="score"></span></div>
      <div class="rank-list2">
      	  <?php $num = 1; ?>
		  @foreach( $participarts as $user )
	      <p class="good" userid="{{ $user->user_id}}">
		      <span class="rank-id"><i><?php echo $num; ?></i></span>
		      <span class="rank-img"><img src="/dwj/images/face.png" alt=""></span>
		      <span class="rank-name">{{ $user->name }}</span>
		      <span class="rank-score">{{ $user->score == '' ? 0 : $user->score }}</span>
	      </p>
	      <?php $num++; ?>
	      @endforeach
      </div>
      {!! $participarts->render() !!}
    </div>
  </div>
</div>
<script src="{{ asset('/dwj') }}/js/jquery.min.js"></script> 
<script src="{{ asset('/dwj') }}/js/web.js"></script> 
<script>

$(function(){
	tipStart();//初始化弹窗
	$(".test").on("click",function(){
		$("#endLayer").show();
	});

	//获取排名
	var rank = 100;
	$(".rank-list2 .good").each(function(i, e) {
        if($(this).attr("userid") == $(".rank").attr("myself"))
		{
			rank = rank < i+1 ? rank : i+1;
		}
    });
    rank = rank <= 30 ? rank : '未上榜';
    $(".rank").html(rank);

	//提交
	$(".submit_btn").on("click",function(){
		var name = $("#nameInput").val();//获取姓名
		var tell = $("#mobileInput").val();//获取电话
		var score = $("#score-num").html();//获取分数
		if(!name.length)
		{
			tipShow({content:"姓名不可为空！"});
		}
		else if(!tell.length)
		{
			tipShow({content:"电话不可为空！"});
		}
		else if(!/((1[34578][0-9]{1}))\d{8}/.test(tell))
		{
			tipShow({content:"电话格式不对！"});
		}
		else
		{
			ajax_submit();
		}
	});	
});
//提交数据
function ajax_submit(){
	$.ajax({
		url:"submit",
		type:"POST",
		dataType:"json",
		async:false,
		data:{
			name:$("#nameInput").val(),
			tell:$("#mobileInput").val(),
			score:$("#score-num").html()
		},
		beforeSend: function(){
			tipShow({content:"正在提交，请稍后...",shut:true});
		},
		success: function(data){
			if(data.success)
			{
				tipShow({content:"提交成功"});
				$(".popup").on("click",function(){
					location.reload(true);   
				})
			}
			else
			{
				tipShow({content:"提交失败，请重试"});
			}
		},
		error: function(msg){
			tipShow({content:"提交失败，请重试"});
		}
	});
};


//初始化弹窗
function tipStart()
{
	//设置弹窗层
	var temp ='<div class="popup"><div class="popup_bg"></div><div class="popup_content"><div><div class="box"></div></div></div></div>';
	//输出弹窗
	$("body").append(temp);
}
//显示弹窗
function tipShow(parm){
	/*
	参数说明
	content：弹窗内容
	shut：是否可关闭，true不可关闭，false可关闭
	*/
	//初始化参数
	var content = parm["content"].length ? parm["content"] : "请输入弹窗内容！";//初始化内容
	var shut = parm["shut"] ? true : false;//初始化是否关闭
	
	var $popup = $(".popup");//获取弹窗对象
	var $popup_bg = $popup.find(".popup_content");//获取弹窗背景对象
	var $popup_content =  $popup.find(".box");//获取弹窗内容
	
	$popup.height($(window).height());//设置弹窗高度
	
	$popup.hide();
	$popup_content.html(content);//设置弹窗内容
	$popup.show();//显示弹窗
	
	//判断是否可关闭
	if(!shut)
	{
		$popup_bg.on("click",function(){
			$popup.hide();//隐藏弹窗
		});
	}
};
//隐藏弹窗
function tipHide(){
	$(".popup").hide();
	$(".popup .popup_content .box").html("");
};
</script>
</body>
</html>
