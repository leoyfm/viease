@extends('video.layout')

@section('css')
    {{--<link href="{{ asset('qiniu/videojs/dist/video-js/video-js.css') }}" rel="stylesheet">--}}
    <link href="//cdn.bootcss.com/video.js/5.5.3/video-js.css" rel="stylesheet">
@stop
@section('pre_js')


@stop

@section('js')
    <script src="//cdn.bootcss.com/video.js/5.5.3/video.js"></script>


    <script>

    </script>
    {{--<script type="text/javascript" src="{{ asset('qiniu/videojs/dist/video-js/video.js') }}"></script>--}}
    <script src="http://vjs.zencdn.net/ie8/1.1.1/videojs-ie8.min.js"></script>
    <script type="text/javascript" src="{{ asset('qiniu/videojs-contrib-media-sources/src/videojs-media-sources.js')}}"></script>
        <script type="text/javascript" src="{{ asset('qiniu/videojs.hls.min.js')}}"></script>
<script>
    function initPlayer(vLink) {
        console.log( vLink );
//        if ($("#video-embed").length) {
//            return;
//        }

        var vType = function() {

            var type = '';
            $.ajax({
                url: vLink + "?stat",
                async: false
            }).done(function(info) {
                type = info.mimeType;
                if (type == 'application/x-mpegurl') {
                    type = 'application/x-mpegURL';
                }
            });

            return type;
        };

        var player = $('#video-embed');
//        $('#video-container').empty();
//        $('#video-container').append(player);

        console.log('=======>>Type:', vType(), '====>>vLink:', vLink);
        var poster = vLink + '?vframe/jpg/offset/2';
        videojs('video-embed', {
            "width": "100%",
            "height": "500px",
            "controls": true,
            "autoplay": false,
            "preload": "auto",
            "poster": poster
        }, function() {
            this.src({
                type: vType(),
                src: vLink
            });
        });
    }



    $(function(){

        console.log(videojs.MediaSource);

        videojs.options.flash.swf = "//cdn.bootcss.com/video.js/5.5.3/video-js.swf";

        $('.play').on('click',function(){
            console.log('ss');
            initPlayer( $(this).attr('url'));
        });
    });
</script>

@stop
@section('content')
    <div class="row">
        @foreach( $data as $video )
            <div class="col-md-4">
                <video id="example_video_1" class="video-js vjs-default-skin" controls="" preload="none" width="640" height="264" poster="{{ $video->path }}?vframe/jpg/offset/2" data-setup="{}">
                    <source src="http://7xqjv9.media1.z0.glb.clouddn.com/7bNOdFMmkSAixm2ID2IhIsrF5yM%3D%2FlpVVsItRWyc-y3PYE78q8iMKtF19" type="application/x-mpegURL">
                    <!-- Tracks need an ending tag thanks to IE9 -->
                    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
                </video>
                {{--<video id="video-embed" class="video-js vjs-default-skin"></video>--}}
                <button class="play" url="{{ $video->path }}"></button>

            </div>
        @endforeach
    </div>
@stop