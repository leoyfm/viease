<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>战队投票</title>
<link href="{{ asset('/children/style/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/children/style/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrap bg wmax">
  <div class="banner"><img width="100%" src="{{ asset('/children') }}/images/team_banner.jpg" alt="" /> </div>
  <!-- Tab -->
  <ul class="tab txt_c">
    <li class="on"><a href="index.html" title="">最具人气战队</a></li>
    <li><a href="index.html" title="">最具人气辩手</a></li>
    <li><a href="top30.html" title="">最美女辩手</a></li>
  </ul>
  <!-- Tab end --> 
  <!-- box -->
  <div class="box color">
    <div class="list">
      <div class="tit">
        <div class="row"><span>排名</span><span>编号</span><span>姓名</span><span>票数</span></div>
      </div>
      <div class="list_top">
        @foreach( $users as $user)
          <div class="row"><span>No.1</span><span>{{$user->id}}</span><span>{{$user->name}}</span><span>{{$user->vote}}</span></div>
        @endforeach

      </div>
    </div>
  </div>
  <!-- box end -->
<!-- bottom -->
  <div class="bottom pos_r"><img width="100%" src="{{ asset('/children/images/team_footer.jpg') }}" alt="" />
    <div class="copyright">技术支持：凡森科技</div>
  </div>
  <!-- bottom end -->
</div>
<!-- wrap end -->
<script type="text/javascript" src="{{ asset('/children/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/children/js/web.js') }}"></script>
</body>
</html>