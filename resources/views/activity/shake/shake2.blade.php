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
  <div class="top pos_r"> <img class="title_1 pos_a" src="{{ URL::asset('/') }}assetactivity/slotmachine/img/title_1.png" alt="" /></div>
  <form method="post" action="{{url("activities/shake/user")}}" id="play_form" name="play_form">
    <div class="r_1">
      <div class="rule">
        <div class="tit">法治频道提醒您</div>
        <p>玩游戏抢红包，20万现金红包等你拿。</p>
      </div>
      <div class="play">
        <input id="focus" type="button" class="btn" value="关注">
      </div>
    </div>
    <div class="r_2">
      <div class="rule">
        <div class="tit">用户信息</div>
        <div class="text">
         <div class="row">
            <div class="name">姓名</div>
            <input type="text" placeholder="请输入姓名" name="name" ver="is_ch" />
          </div>
          <div class="row">
            <div class="name">电话</div>
            <input type="text" placeholder="请输入电话" name="tell" maxlength="11" ver="is_mobile" />
          </div>
          <div class="warning">您输入的<span>姓名</span>有误！</div>
        </div>
      </div>
      <div class="play">
        <input type="submit" id="start" class="btn" value="开始游戏">
      </div>
    </div>
  </form>
  <div class="copyright bottom">本活动最终解释权归凡森所有</div>
  <div class="popup">
    <div class="popup_bg"></div>
    <div class="popup_content">
      <div class="check_box">
        <div class="tit">温馨提示</div>
        <div class="text">您尚未关注<span>法治频道</span><br/>
          请关注后重试</div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(".r_2").show();
  /*BeaconAddContactJsBridge.ready(function(){
	  //判断是否关注
	  BeaconAddContactJsBridge.invoke('checkAddContactStatus',{} ,function(apiResult){
		  if(apiResult.err_code == 0){
			  var status = apiResult.data;
			  if(status == 1){
				 $(".r_1").hide();
				 $(".r_2").show();
			  }else{
				 $(".r_1").show();
				 $(".r_2").hide();
			  }
		  }else{
			  alert(apiResult.err_msg)
		  }
	  });
  });
*/
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
<script type="text/javascript">
    $("#focus").on("click",function(){
        BeaconAddContactJsBridge.invoke('jumpAddContact');
    });

	//check_box弹窗
    function popup(){
	  var $popup = $(".popup");//获取弹窗对象
	  var $popup_bg = $popup.find(".popup_bg");//获取弹窗背景对象
	  var $popup_content = $popup.find(".popup_content");//获取弹窗内容对象
	  
	  //重置弹窗高度
	  $popup.height($("body").height());
	  //点击显示弹窗
		  $popup.css("display","table");
	  //点击弹窗背景关闭弹窗
	  $popup_content.bind("click",function(){
		$popup.hide();
	});
  };
  
  //错误函数
function errorfun(t) {
	$(t).attr("error","on");
	$(".warning span").html($(t).prev(".name").html());
	$(".warning").show();
}
//正确函数
function rightfun(t) {
	$(t).removeAttr("error");
	$(".warning").hide();
}

jQuery.verification = function(error, right) {
  //类名数组
  /* is_user:用户名,is_qq:QQ号,is_tell:固话号码,is_mobile:手机号码,is_id:身份证号码,is_email:邮箱,is_pass:密码,is_bank:银行卡,is_num:纯数字,is_ch:纯中文,is_ip:IP*/
  var name = ["is_user", "is_qq", "is_tell", "is_mobile", "is_id", "is_email", "is_pass", "is_bank", "is_num", "is_ch","is_empty"];
  //正则表达式数组
  var regex = [/[^a-zA-Z0-9]/, /^\d{5,11}$/, /^0\d{2,3}-{0,1}\d{7,8}$|^\d{7,8}$/, /((1[34578][0-9]{1}))\d{8}/, /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/, /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/, /\d+[a-zA-Z]+|[a-zA-Z]+\d+/, /^\d{19}$|^\d{12}$|^\d{16}$/, /[^\d-.]/, /[\u4E00-\u9FFF]/,/[\u4E00-\u9FFF]/];
  //提示数组
  //反向数组
  var rev = [0, 8];
  var obj = $("[ver]");
  for (i = 0; i < obj.length; i++) {
	  for (j = 0; j < name.length; j++) {
		  if (name[j] == obj.eq(i).attr("ver")) {
			  obj.eq(i).attr("ver", j);
			  break;
		  }
	  }
  }
  //失去焦点
  obj.bind("blur", function() {
	  var val = $(this).val();
	  var dat = $(this).attr("ver");
	  if (val == "") {
		  error(this);
		  return false;
	  }
	  if (!test(val, dat)) {
		  error(this);
	  } else {
		  right(this);
	  }
  });
  //测试方法
  function test(value, num) {
	  var temp = regex[num].test(value); //验证正则表达式
	  //判断取反
	  for (i = 0; i < rev.length; i++) {
		  if (num == rev[i]) {
			  temp = !temp;
			  break;
		  }
	  }
	  //判断对错
	  if (temp) {
		  return true;
	  } else {
		  return false;
	  }
  }
  
  //提交
  $("#play_form").bind("submit", function() {
	  var t = $(this).find("[ver]");
	  t.blur();
	  var err = $(this).find("[error='on']");
	  if (err.length) {
		  err.eq(0).blur();
		  return false;
	  }
  });
  
}

//调用表单验证
	jQuery.verification(errorfun, rightfun);
</script>
</body>
</html>