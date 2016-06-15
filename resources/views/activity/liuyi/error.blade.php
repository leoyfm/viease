<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('/children/images/favicon.ico') }}" media="screen" />
<title>幸福家 晒萌娃</title>
<link href="{{ asset('/children/style/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/children/style/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrap ok bg wmax">
  <div class="box color msg ok">
    <div class="icon txt_c"><i class="fa fa-times bg3 ove_h"></i>
      <p class="t">{{ $msg }}</p>
    </div>
    <div class="txt_c">
      <div class="btn bg2 dis_ib"><a class="txt_c dis_ib" href="{{url('/')}}/activities/team" title="返回首页">返回首页</a></div>
    </div>
  </div>
  <!-- bottom -->
  <div class="bottom pos_r"><img width="100%" src="{{ asset('/children/images/team_footer.jpg') }}" alt="" />
    <div class="copyright">技术支持：凡森科技 电话：0371-60906138</div>
  </div>
  <!-- bottom end -->
</div>
<!-- wrap end -->
<script type="text/javascript" src="{{ asset('/children/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/children/js/web.js') }}"></script>
<script >
$(function(){
  $(".wrap.ok").height($(window).height());
});
</script>
</body>
</html>