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
          desc:'为你觉得优秀的萌宝投票，我们会选出优秀用户进行大礼包奖励。',
          link:'http://viease.ponyhelp.com/activities/10',
          imgUrl: '{{ asset("/teams/images/team_banner.jpg") }}',
          success: function(){
              $.ajax({
                  type:'POST',
                  url: '{{url('activities/liuyi/addticket',$cuser->id)}}',
                  success: function( res ){
//                      alert('分享成功，投票次数加1');
//                      location.reload(true);          
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
  <div class="banner"><img width="100%" src="{{ asset('/teams') }}/images/team_banner.jpg" alt="" /> </div>
  <!-- Tab -->
  <ul class="tab txt_c">
    <li class="on"><a href="{{url('/')}}/activities/liuyi/index" title="">最新投票</a></li>
    <li><a href="{{url('/')}}/activities/liuyi/most" title="">TOP30</a></li>
  </ul>
  <!-- Tab end --> 
  <!-- list -->
  <div class="list_pic ove_h">
    @foreach( $participarts as $user )

    <!-- item -->
    <div class="item">
      <div class="pic" style="background-image:url({{ $user->pic }});"><a href="/activities/liuyi/content/{{$user->id}}" title=""></a></div>
      <div class="info">
        <p>{{ $user->name }}</p>
        <span>{{ $user->vote == '' ? 0 : $user->vote }}票</span> </div>
      <a href="/activities/liuyi/content/{{$user->id}}" class="vote">投TA<br />
      一票</a> </div>
      <!-- item end -->
    @endforeach

  </div>

    {!! $participarts->render() !!}
  <!-- 
  <ul class="pagination">
    <li class="disabled"><span>«</span></li>
    <li class="active"><span>1</span></li>
    <li><a href="#2">2</a></li>
    <li><a href="#2" rel="next">»</a></li>
  </ul> -->

<div class="menu">
    <div> <a class="add" href="{{url('/')}}/activities/liuyi/join" title="">参加活动</a> </div>
  </div>
<!-- bottom -->
  <div class="bottom pos_r"><img width="100%" src="{{ asset('/teams/images/team_footer.jpg') }}" alt="" />
    <div class="copyright">技术支持：凡森科技 电话：0371-60906138</div>
  </div>
  <!-- bottom end -->
</div>
<!-- wrap end -->
<script type="text/javascript" src="{{ asset('/teams/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/teams/js/web.js') }}"></script>
<script>
$(function(){
  $(".wrap").css("padding-bottom",$(".menu").height());
});
</script>
</body>
</html>