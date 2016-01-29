<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" media="screen" />
    <title>法治频道年货来袭,人人有份</title>
    <link href="{{ asset('/assetactivity/style/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assetactivity/style/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{ asset('/assetactivity/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assetactivity/js/web.js') }}"></script>
    @if ( isset($js) )
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" charset="utf-8">
            wx.config(<?php echo $js->config(array('onMenuShareQQ','onMenuShareQZone', 'onMenuShareWeibo','onMenuShareTimeline','onMenuShareAppMessage'), false, true) ?>);

            var showTicket = '{{ url('activities/nianhuo/ticket',$cuser->id) }}';
            wx.ready(function(){

                var data = {
                    title: '法治频道年货来袭,人人有份',
                    desc:'晒出自己的新年记忆，我们会选出优秀作品进行大礼包奖励。',
                    link:window.location.href,
                    imgUrl: '',
                    success: function(){
                        $.ajax({
                            type:'POST',
                            url: '{{url('activities/nianhuo/addticket',$cuser->id)}}',
                            success: function( res ){
                                if( res.result){
                                    window.location.href = showTicket;
                                }

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
    <div class="banner" style="background-image:url({{ asset('/assetactivity/images/yun.jpg') }});"><img width="100%" src="{{ asset('/assetactivity/images/banner.jpg') }}" alt="" />
        <div class="hj pos_r" style="background-image:url({{ asset('/assetactivity/images/hj_pic.png') }});">
            <p class="tit txt_c"><img src="{{ asset('/assetactivity/images/hj_tit.png') }}" alt="" /></p>
            <p class="txt">过年啦，法治频道为您带来粉丝福利，我们举行了新春晒年货活动，凡参加活动晒出您的照片，均有机会获得新春大礼！祝大家身体健康，财源广进。</p>
            <div class="join bg mar_a"><a href="{{ url('activities/nianhuo/join') }}" title=""><i class="fa fa-arrow-right"></i>马上晒年货</a></div>
            <img class="mon_l pos_a" src="{{ asset('/assetactivity/images/monkey_left.png') }}" alt="" /><img class="mon_r pos_a" src="{{ asset('/assetactivity/images/monkey_right.png') }}" alt="" />
        </div>
    </div>