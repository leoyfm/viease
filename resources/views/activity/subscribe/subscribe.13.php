<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>请先关注官方微信</title>
<link href="{{ asset('/activity/tour/style/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/activity/tour/style/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrap bg1 wmax">
  <div class="box color1 msg txt_c" style="margin-top: 5rem;">
    <img style="width: 12rem; margin-bottom: 1rem;" src="{{ asset('/activity/tour/images/fzpd_ewm.jpg') }}" alt="" />
      <p class="t">请先关注官方微信</p>
    </div>
  <!-- bottom -->
  <div class="bottom"><img width="100%" src="{{ asset('/activity/tour/images/footer_bg.jpg') }}" alt="" />
    <div class="copyright">技术支持：凡森科技</div>
  </div>
  <!-- bottom end -->
</div>
<!-- wrap end -->
<script type="text/javascript" src="{{ asset('/activity/tour/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/activity/tour/js/web.js') }}"></script>
<script >
$(function(){
  $(".wrap").addClass("ok").css("min-height",$(window).height());
});
</script>
</body>
</html>