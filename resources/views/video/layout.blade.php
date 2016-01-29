<!DOCTYPE html>
<!--[if lte IE 6 ]>
<html class="ie ie6 lte-ie7 lte-ie8" lang="zh-CN">
<![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7 lte-ie7 lte-ie8" lang="zh-CN">
<![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8 lte-ie8" lang="zh-CN">
<![endif]-->
<!--[if IE 9 ]>
<html class="ie ie9" lang="zh-CN">
<![endif]-->
<!--[if (gt IE 9)|!(IE)]>
<!-->
<html lang="zh-CN">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>视频</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="overtrue,bootstrap, bootstrap theme" />
    <meta name="description" content="a bootstrap theme made by overtrue." />
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('/css/ionicons.css') }}" media="screen">
    @yield('css')
            <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('/plugin/html5shiv/dist/html5shiv.js') }}"></script>
    <script src="{{ asset('/plugin/respond/dest/respond.min.js') }}></script>
  <![endif]-->
    @yield('pre_js')
</head>
<body>

<div class="container main-container">
    <div class="console-wrapper table-box">
        <section class="console-container table-row">
            <aside class="console-sidebar-wrapper table-cell">

            </aside>
            <section class="console-content-wrapper table-cell">
                @yield('content')
            </section>
        </section>
    </div>
</div>
<div class="console-footer">
    <div class="clearfix text-center">
        <ul class="list-unstyled list-inline">
            <li>POWERED BY <a href="http://www.firsen.net" target="_blank">FIRSEN {{ VIEASE_VERSION }}</a> &copy;  2015</li>
        </ul>
        <button class="pull-right hidden-print  back-to-top" onclick="window.scrollTo(0,0)"> <i class="ion-android-arrow-dropup"></i>
        </button>
    </div>
</div>
<script type="text/javascript" src="{{ asset('qiniu/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
@yield('js')
</body>
</html>