<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>战队投票</title>
<link href="{{ asset('/teams/style/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/teams/style/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
@if ( isset($js) )
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  wx.config(<?php echo $js->config(array('onMenuShareQQ','onMenuShareQZone', 'onMenuShareWeibo','onMenuShareTimeline','onMenuShareAppMessage'), false, true) ?>);

  var showTicket = '{{ url('activities/team/ticket',$cuser->id) }}';
  wx.ready(function(){

      var data = {
          title: '法制进校园，大学辩论赛',
          desc:'为你觉得优秀的团队投票，我们会选出优秀作品进行大礼包奖励。',
          link:window.location.href,
          imgUrl: '{{ asset("/teams/images/team_banner.jpg") }}',
          success: function(){
              $.ajax({
                  type:'POST',
                  url: '{{url('activities/team/addticket',$cuser->id)}}',
                  success: function( res ){
                      alert('分享成功，投票次数加1');
                          
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

</script>
@endif
</head>
<body>
<div class="wrap bg wmax">
  <div class="banner"><img width="100%" src="{{ asset('/teams') }}/images/team_banner.jpg" alt="" /> </div>
  <!-- Tab -->
  <ul class="tab txt_c">
    <li><a href="{{url('/')}}/activities/team" title="">最具人气战队</a></li>
    <li><a href="{{url('/')}}/activities/team/list2" title="">最具人气辩手</a></li>
    <li class="on"><a href="{{url('/')}}/activities/team/list3" title="">最美女辩手</a></li>
  </ul>
  <!-- Tab end --> 
  <!-- list -->
  <div class="list_pic ove_h">
    @foreach( $participarts as $user )

    <!-- item -->
    <div class="item">
      <div class="pic" style="background-image:url({{ $user->pic }});"><a href="/activities/team/content/{{$user->id}}" title=""></a></div>
      <div class="info">
        <p>{{ $user->name }}</p>
        <span>{{ $user->vote == '' ? 0 : $user->vote }}票</span> </div>
      <a href="{{url('/')}}/activities/team/content/{{$user->id}}" class="vote">投TA<br />
      一票</a> </div>
      <!-- item end -->
    @endforeach
  </div>
  <!-- list end -->

  <!--
  <ul class="pagination">
    <li class="disabled"><span>«</span></li>
    <li class="active"><span>1</span></li>
    <li><a href="#2">2</a></li>
    <li><a href="#2" rel="next">»</a></li>
  </ul>
  -->

<!-- bottom -->
  <div class="bottom pos_r"><img width="100%" src="{{ asset('/teams/images/team_footer.jpg') }}" alt="" />
    <div class="copyright">技术支持：凡森科技 电话：0371-60906138</div>
  </div>
  <!-- bottom end -->
</div>
<!-- wrap end -->
<script type="text/javascript" src="{{ asset('/teams/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/teams/js/web.js') }}"></script>
</body>
</html>