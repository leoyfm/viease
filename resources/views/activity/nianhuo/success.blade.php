<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" media="screen" />
    <title>首页</title>
    <link href="{{ asset('/assetactivity/style/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assetactivity/style/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{ asset('/assetactivity/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assetactivity/js/web.js') }}"></script>
</head>
<body>
<div class="wrap ok bg wmax">
    <div class="top"> <img width="100%" src="{{ asset('/assetactivity/images/yun.jpg') }}" alt="" /> </div>
    <div class="box color">
        <div class="tit txt_c color">提交成功</div>
        <div class="icon txt_c"><i class="fa fa-check bg ove_h"></i>
            <p class="t">感谢您的参与，祝您新年愉快。</p>
        </div>
        <div class="txt_c">
            <div class="btn bg dis_ib"><a class="bg txt_c dis_ib" href="{{ url('activities/nianhuo') }}" title="返回首页">返回首页</a></div>
        </div>
    </div>
    <div class="bottom pos_r"><img width="100%" src="{{ asset('/assetactivity/images/bottom_pic.jpg') }}" alt="" />
        <div class="t pos_a txt_c wmax color"><a class="top" id="top" href="javascript:void(0)" title="回到顶部">回到顶部</a>
            <p>本活动最终解释权归凡森所有</p>
        </div>
    </div>
    <!-- wrap end -->
</div>
<script>
    $(function(){
        $(".wrap.ok").height($(window).height());
    });
</script>
</body>
</html>