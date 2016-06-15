<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>横店影视城 文化之旅</title>
<link href="{{ asset('/activity/tour/style/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/activity/tour/style/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
@if ( isset($js) )
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
      wx.config(<?php echo $js->config(array('onMenuShareQQ','onMenuShareQZone', 'onMenuShareWeibo','onMenuShareTimeline','onMenuShareAppMessage'), false, true) ?>);
      var showTicket = '{{ url('activities/tour/ticket',$cuser->id) }}';
      wx.ready(function(){

          var data = {
              title: '横店影视城 文化之旅',
              desc:'为你觉得优秀的用户投票，我们会选出优秀用户进行大礼包奖励。',
              link:'http://viease.ponyhelp.com/activities/13?activity=13',
              imgUrl: '{{ asset("activity/tour/images/top_banner.jpg") }}',
              success: function(){
                 /* $.ajax({
                      type:'POST',
                      url: '{{url('activities/tour/addticket',$cuser->id)}}',
                      success: function( res ){        
                      }
                  });*/
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
    </script>
    @endif
</head>
<body>
<div class="wrap bg1 wmax">
  @yield('content')
  <!-- bottom -->
  <div class="bottom"><img width="100%" src="{{ asset('activity/tour/images/footer_bg.jpg') }}" alt="" />
    <div class="copyright">技术支持：凡森科技</div>
  </div>
  <!-- bottom end -->
</div>
<!-- wrap end -->
<script type="text/javascript" src="{{ asset('activity/tour/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('activity/tour/js/web.js') }}"></script>
@yield('pagejs')
</body>
</html>