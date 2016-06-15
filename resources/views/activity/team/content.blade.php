<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>幸福家 晒萌娃</title>
<link href="{{ asset('/teams/style/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/teams/style/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
@if ( isset($js) )
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  wx.config(<?php echo $js->config(array('onMenuShareQQ','onMenuShareQZone', 'onMenuShareWeibo','onMenuShareTimeline','onMenuShareAppMessage'), false, true) ?>);

  var showTicket = '{{ url('activities/liuyi/ticket',$cuser->id) }}';
  wx.ready(function(){

      var data = {
          title: '幸福家 晒萌娃',
          desc:'为你觉得优秀的萌宝投票,我们会选出优秀用户进行大礼包奖励.',
          link:window.location.href,
          imgUrl: '{{ asset("/teams/images/team_banner.jpg") }}',
          success: function(){
              $.ajax({
                  type:'POST',
                  url: '{{url('activities/liuyi/addticket',$cuser->id)}}',
                  success: function( res ){
                      /*alert('分享成功，投票次数加1');
                      location.reload(true); */         
                  }
              });
          },
          cancel: function(){

          }
      };
      wx.onMenuShareTimeline( data);
      wx.onMenuShareAppMessage( data);
      wx.onMenuShareQQ( data);
      wx.onMenuShareWeibo( data);
      wx.onMenuShareQZone( data);
  });
//{{url('/')}}
</script>
@endif
</head>
<body>
<div class="wrap bg wmax">
  <div class="banner"><img width="100%" src="{{ asset('/teams/images/team_banner.jpg') }}" alt="" /> </div>
  <!-- box -->
  <div class="box">
    <div class="con">
      <p class="title color">编号#{{$user->id}} {{ $user->name }}</p>
      <div class="data">
        <ul class="txt_c">
          <li>票数：{{ $user->vote == '' ? 0 : $user->vote }}</li>
        </ul>
      </div>
      <div class="img"> <img src="{{ $user->pic }}"> </div>
      <p class="p1">{{ $user->remark }}</p>
      <div class="txt_c">
        <div class="btn bg2 dis_ib"><a class="txt_c dis_ib" href="{{url('/')}}/activities/liuyi/index" title="返回首页">返回首页</a></div>
        <div class="zan btn bg3 dis_ib"><a class=" txt_c dis_ib" href="javascript:void(0)" title="投一票"><i class="fa fa-thumbs-up"></i>投一票</a></div><!-- /activities/team/vote/{{$user->id}} -->
      </div>
    </div>
  </div>
  <!-- box end -->

  
  <!-- 活动规则 -->
  <div class="rule">
    <div class="column">活动规则</div>
    <ul class="ul1" style="text-indent: 2rem; overflow: hidden;">
        六一就要到了，您准备送给孩子什么礼物呢？六一儿童节，快来加入公共频道《幸福家•庆六一》晒萌娃大赛！即日起至6月3日，晒与孩子合影或孩子单独照片，发微信赢大奖！参与方式：在活动页面上传照片，留下你最想对孩子说的话或者照片背后的故事，姓名和联系方式，即可参与活动，<img style="float: right; width: 12rem; margin-top: 0.5rem;" src="{{ asset('/teams/images/hdjc_pic.jpg') }}" alt="" />我们将在公共频道官方微信、官方微博集中展示您和孩子的靓照，同时，公共频道将每天展示优秀照片全天滚动播出。每天转发活动页面到朋友圈为自己拉票，票数高者将有机会获得郑州纽克殿堂级儿童摄影机构提供的价值1680元的肖像照一套或韩日游等等奖品。晒萌娃活动截止时间：6月3日18点。
        
    </ul>
  </div>
  <!-- 活动规则 end -->
  <!-- 弹窗 -->
  <div class="popup">
    <div class="popup_bg"></div>
    <div class="popup_content">
      <div>
        <div class="popup_box"></div>
      </div>
    </div>
  </div>
  <!-- 弹窗 end --> 
    <!-- bottom -->
  <div class="bottom pos_r"><img width="100%" src="{{ asset('/teams/images/team_footer.jpg') }}" alt="" />
    <div class="copyright">技术支持：凡森科技</div>
  </div>
  <!-- bottom end -->
</div>
<!-- wrap end -->
<script type="text/javascript" src="{{ asset('/teams/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/teams/js/web.js') }}"></script>
<script>
$(function(){

  var num_ticket = {{ $num_ticket }};

  $(".zan").bind("click",function(){
    if( true )//判断条件
    {
        //window.location.href= '{{ url('activities/liuyi/vote',$user->id) }}';
        alert('活动已结束');
    }
    else
    {
      tipShow({content:"点击右上方分享到朋友圈<br>即可获得一次投票机会<br>每分享一次，获得一次投票"});
    }
  });
});
</script>
</body>
</html>