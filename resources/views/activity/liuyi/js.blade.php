@if ( isset($js) )
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  wx.config(<?php echo $js->config(array('onMenuShareQQ','onMenuShareQZone', 'onMenuShareWeibo','onMenuShareTimeline','onMenuShareAppMessage'), false, true) ?>);

  var showTicket = '{{ url('activities/team/ticket',$cuser->id) }}';
  wx.ready(function(){

      var data = {
          title: '法治频道年货来袭,人人有份',
          desc:'晒出自己的新年记忆，我们会选出优秀作品进行大礼包奖励。',
          link:window.location.href,
          imgUrl: '',
          success: function(){
              $.ajax({
                  type:'POST',
                  url: '{{url('activities/team/addticket',$cuser->id)}}',
                  success: function( res ){
                      alert('分享成功');
                          
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