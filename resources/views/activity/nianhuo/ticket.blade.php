<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/assetactivity/images/favicon.ico') }}" media="screen" />
  <title>首页</title>
  <link href="{{ asset('/assetactivity/style/style.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assetactivity/style/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="{{ asset('/assetactivity/js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/assetactivity/js/web.js') }}"></script>
</head>
<body>
<div class="wrap share bg wmax">
  <div><img width="100%" src="{{ asset('/assetactivity/images/banner.jpg') }}" alt="" />
    <div class="box txt_c num">
      <p>您当前还有<span class="color">{{ $num }}</span>次投票机会 </p>
    </div>
    <div class="box txt_c color">
      <p class="tit">分享</p>
      <p>点击右上方分享到朋友圈，可额外获得一次投票机会。 </p>
      <p>分享多多，投票多多。</p>
    </div>
  </div>
  <div class="bottom pos_r" style="background:#FFD9B5;"><img width="100%" src="{{ asset('/assetactivity/images/bottom_pic.png') }}" alt="" />
    <div class="t pos_a txt_c wmax color"><a class="top" id="top" href="javascript:void(0)" title="回到顶部">回到顶部</a>
      <p>本活动最终解释权归凡森所有</p>
    </div>
  </div>
</div>
<script>
  $(function(){
    $(".wrap.share").height($(window).height());
  });
</script>
</body>
</html>