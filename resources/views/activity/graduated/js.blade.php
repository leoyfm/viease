@section('js')
    @if ( isset($js) )
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
      wx.config(<?php echo $js->config(array('onMenuShareQQ','onMenuShareQZone', 'onMenuShareWeibo','onMenuShareTimeline','onMenuShareAppMessage'), false, true) ?>);

      var showTicket = '{{ url('activities/liuyi/ticket',$cuser->id) }}';
      wx.ready(function(){

          var data = {
              title: '毕业季晒照片',
              desc:'为你觉得优秀的用户投票，我们会选出优秀用户进行大礼包奖励。',
              link:'http://viease.ponyhelp.com/activities/12',
              imgUrl: '{{ asset("/graduated/images/team_banner.jpg") }}',
              success: function(){
                  $.ajax({
                      type:'POST',
                      url: '{{url('activities/liuyi/addticket',$cuser->id)}}',
                      success: function( res ){        
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
@endsection