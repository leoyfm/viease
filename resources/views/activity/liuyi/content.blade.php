<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>幸福家 晒萌娃</title>
<link href="{{ asset('/children/style/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/children/style/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
@if ( isset($js) )
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  wx.config(<?php echo $js->config(array('onMenuShareQQ','onMenuShareQZone', 'onMenuShareWeibo','onMenuShareTimeline','onMenuShareAppMessage'), false, true) ?>);

  var showTicket = '{{ url('activities/team/ticket',$cuser->id) }}';
  wx.ready(function(){

      var data = {
          title: '幸福家 晒萌娃',
          desc:'幸福家 晒萌娃',
          link:window.location.href,
          imgUrl: '{{ asset("/children/images/team_banner.jpg") }}',
          success: function(){
              $.ajax({
                  type:'POST',
                  url: '{{url('activities/team/addticket',$cuser->id)}}',
                  success: function( res ){
                      alert('分享成功，投票次数加1');
                      location.reload(true);          
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
  <div class="banner"><img width="100%" src="{{ asset('/children/images/team_banner.jpg') }}" alt="" /> </div>
  <!-- box -->
  <div class="box">
    <div class="con">
      <p class="title color">{{ $user->name }}</p>
      <div class="data">
        <ul class="txt_c">
          <li>票数：{{ $user->vote == '' ? 0 : $user->vote }}</li>
        </ul>
      </div>
      <div class="img"> <img src="{{ $user->pic }}"> </div>
      <p class="p1">{{ $user->remark }}</p>
      <div class="txt_c">
        <div class="btn bg2 dis_ib"><a class="txt_c dis_ib" href="{{url('/')}}/activities/team" title="返回首页">返回首页</a></div>
        <div class="zan btn bg3 dis_ib"><a class=" txt_c dis_ib" href="javascript:void(0)" title="投一票"><i class="fa fa-thumbs-up"></i>投一票</a></div><!-- /activities/team/vote/{{$user->id}} -->
      </div>
    </div>
  </div>
  <!-- box end -->

  
  <!-- 活动规则 -->
  <div class="rule">
    <div class="column">活动规则</div>
    <ul class="ul1">
      <li>参加活动和投票，必须先关注微信公众号“法治频道”。</li>
      <li>本次比赛1个微信号每天仅限为1个参赛作品投一票，但是可以对多个参赛作品投票。</li>
      <li>请注意，若投票后取消“法治频道”微信号的关注，之前的投票一律不作数。</li>
    </ul>
  </div>
  <!-- 活动规则 end -->
    <!-- bottom -->
  <div class="bottom pos_r"><img width="100%" src="{{ asset('/children/images/team_footer.jpg') }}" alt="" />
    <div class="copyright">技术支持：凡森科技 电话：0371-60906138</div>
  </div>
  <!-- bottom end -->
</div>
<!-- wrap end -->
<script type="text/javascript" src="{{ asset('/children/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/children/js/web.js') }}"></script>
<script>
$(function(){

  var num_ticket = {{ $num_ticket }};

  if($(".zan").length)
    {
      var temp ='<div class="popup"><div class="popup_bg close"> </div><div class="popup_box color"><div class="tit">分享</div><div class="c">点击右上方分享到朋友圈<br>即可获得一次投票机会<br>每分享一次，获得一次投票</div></div></div>';
      $("body").append(temp);
    }

  $(".zan").bind("click",function(){
    if( num_ticket > 0 )//判断条件
    {
              window.location.href= '{{ url('activities/team/vote',$user->id) }}';
    }
    else
    {
      popup();//投票失败方法
    }
  });
  $(".close").bind("click",function(){
     popup_off();
  });

  
});
</script>
</body>
</html>