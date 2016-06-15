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
<div class="wrap">
  <div class="top pos_r"> <img class="title pos_a" src="{{ URL::asset('/') }}assetactivity/slotmachine/img/title_2.png" alt="" /></div>
  <div class="lucky">
  <p class="balance">还剩<span>{{ 200000 - 126190 - $remaining / 100 }}</span>元</p>
    <div id="casino">
      <div class="content">
        <div class="list">
          <div id="casino1" class="slotMachine">
            <div class="slot slot1"></div>
            <div class="slot slot2"></div>
            <div class="slot slot3"></div>
            <div class="slot slot4"></div>
            <div class="slot slot5"></div>
            <div class="slot slot6"></div>
          </div>
          <div id="casino2" class="slotMachine">
            <div class="slot slot1"></div>
            <div class="slot slot2"></div>
            <div class="slot slot3"></div>
            <div class="slot slot4"></div>
            <div class="slot slot5"></div>
            <div class="slot slot6"></div>
          </div>
          <div id="casino3" class="slotMachine">
            <div class="slot slot1"></div>
            <div class="slot slot2"></div>
            <div class="slot slot3"></div>
            <div class="slot slot4"></div>
            <div class="slot slot5"></div>
            <div class="slot slot6"></div>
          </div>
        </div>
      </div>
      <div class="btn-group-casino" role="group">
        <div id="slotMachineButtonShuffle" type="button" class="btn">摇起来</div>
        <div id="slotMachineButtonStop" type="button" class="btn orange">停止</div>
      </div>
      <div class="sildetop" style="margin-bottom:5rem;">
        <div class="list">
           <div class="item"><span class="name">林浩</span><span class="tip">人品爆发</span>，中了<span class="bonus">9.22</span>元</div>
          <div class="item"><span class="name">赵晓晴</span><span class="tip">人品爆发</span>，中了<span class="bonus">6.31</span>元</div>
          <div class="item"><span class="name">张建国</span><span class="tip">人品爆发</span>，中了<span class="bonus">4.57</span>元</div>
          <div class="item"><span class="name">李茹</span><span class="tip">人品爆发</span>，中了<span class="bonus">3.49</span>元</div>
          <div class="item"><span class="name">秦慧慧</span><span class="tip">人品爆发</span>，中了<span class="bonus">1.92</span>元</div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="copyright bottom">本活动最终解释权归凡森所有</div>
  <div class="popup">
    <div class="popup_bg"></div>
    <div class="popup_content">
      <div class="red_box"><img class="pic" src="{{ URL::asset('/') }}assetactivity/slotmachine/img/red_pic.png" alt="" />
        <form action="{{ url("activities/shake/ward") }}" method="post">
          <input type="hidden" name="activity" value="{{ $activity->id }}" />
          <input type="hidden" name="user" value="{{ $user->id }}" />
          <input type="hidden" name="sign" value="{{ $sign }}" />
          <input class="receive" type="submit" value="马上领取" />
        </form>
      </div>
    </div>
  </div>
</div>
<script>

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

$(function(){
        var machine4 = $("#casino1").slotMachine({
            active	: 0,
            delay	: 300
        });
        var machine5 = $("#casino2").slotMachine({
            active	: 1,
            delay	: 300
        });
        var machine6 = $("#casino3").slotMachine({
            active	: 2,
            delay	: 300
        });
        var started = 0;
        $("#slotMachineButtonShuffle").click(function(){
            machine4.shuffle();
            machine5.shuffle();
            machine6.shuffle();
        });
        $("#slotMachineButtonStop").click(function(){
            machine4.stop();
            machine5.stop();
            machine6.stop();
            if( machine4.stopping && machine5.stopping && machine6.stopping ){

                if( (machine4.active == machine5.active) && (machine5.active == machine6.active) ){
                    popup();//调用弹窗方法	
                }
            }
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
  }
});
</script>
<script>
$(function(){
	var name_arr = ['常艳华','张珂珂','王晴云','丁家磊','刘佳彬','李想','赵梅','程晓阳','王月星','晋启迪','王丹','曾莹','强敏','冯时','王艺','张星辰','王海帆','王志坤','周政','康景彬','崔燚','王佳欢','李永霞','张琳','李欢','康清清','王天雨','秦玉洁','潘三霞','仝亮亮','丰瑞娜','李颖','杨慧珠','蒋少可','王小溪','马若飞','能亚东','苏琬越','朱朋威','李前程','陈悦','李元玉','王峥','蔡幸燕','李哲','苏佳佳','王东','孙英','李蔚','贾强政','吴博','沈成龙','李耀明','郭颖颖','王龙飞','郝婷婷','林冉','李爽','桑耀文','王硕','楚应敬','涂慧杰','张晓敏','邓奇奇','李亚男','姚泽科','荣娟','刘晓斌','吴僖慧','赵倩倩','栗鹏伟','朱迪','刘庆伟','付克利','郭燕杰','李书顶','王新维','陈英豪','马慧利','裴璐','刘园','郭艳勤'];
	var tip_arr = ['人品爆发','鸿运当头','好运连连','福星高照','时来运转','天随人愿','双喜临门'];
	var r_arr = new Array();
	
	for( var i = 0; i < 15; i++){
		r_arr[i] = parseInt(Math.random() * name_arr.length);
	}
	//(Math.random() + 1).toFixed(10);
	var obj = $(".sildetop .list");
	obj.html("");
	for( var j = 0; j < r_arr.length; j++)
	{
		obj.append("<div class='item'><span class='name'>" + name_arr[r_arr[j]] +"</span><span class='tip'>"+tip_arr[parseInt(Math.random() * tip_arr.length)]+"</span>，中了<span class='bonus'>"+(Math.random()*9+1).toFixed(2)+"</span>元</div>");
	}
	jQuery(".sildetop").slide({mainCell:".list",autoPage:true,effect:"topLoop",autoPlay:true,vis:3,delayTime:500,opp:true,interTime:4000});
});
</script>
</body>
</html>