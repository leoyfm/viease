@extends('video.layout')

@section('pre_js')

    <script type="text/javascript" src="{{ asset('qiniu/jquery-1.9.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('qiniu/plupload/plupload.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('qiniu/plupload/i18n/zh_CN.js') }}"></script>
    <script type="text/javascript" src="{{ asset('qiniu/qiniu.js') }}"></script>
@stop

@section('content')
    <form action="" method="post">

        <div class="form-group">
            <label for="title">标题</label>
            <input type="text" class="form-controll" name="title">
        </div>
        <div class="form-group">
            <label for="desc">描述
                <input type="text" class="form-controll" name="desc">
            </label>
        </div>
        <div class="form-group" id="videContainer"><label for="">选择视频</label>
            <button id="pickfiles" class="btn btn-primary btn-lg btn-block" type="submit">上传图片</button>
            <input type="text" name="path" id="videoId">
        </div>

        <div class="form-group">
            <button class="btn">提交</button>
        </div>

    </form>


@stop



@section('js')
    <script>

        var uploader = Qiniu.uploader({
            runtimes: 'html5,flash,html4', //上传模式,依次退化
            browse_button: 'pickfiles', //上传选择的点选按钮，**必需**
            uptoken_url: 'upload-url', //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
            domain: 'http://7xqjv9.media1.z0.glb.clouddn.com/', //bucket 域名，下载资源时用到，**必需**
            container: 'videContainer', //上传区域DOM ID，默认是browser_button的父元素，
            max_file_size: '100mb', //最大文件体积限制
            flash_swf_url: 'plupload/Moxie.swf', //引入flash,相对路径
            unique_names: true,
            max_retries: 3, //上传失败最大重试次数
            dragdrop: true, //开启可拖曳上传
            drop_element: 'container', //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
            chunk_size: '4mb', //分块上传时，每片的体积
            auto_start: true, //选择文件后自动上传，若关闭需要自己绑定事件触发上传
            init: {
                'UploadProgress': function(up, file) {
                    $('#pickfiles').prop('disabled', true).html('图片上传中...');
                },
                'FileUploaded': function(up, file, info) {
                    console.log('uploadup', info);

                    $('#pickfiles').prop('disabled', false).html('上传图片');
                    var res = JSON.parse(info);
                    url = up.getOption('domain') + res.key;
                    $('#videoId').val( url );
//                refresh(imgUrl);
                },
                'Error': function(up, err, errTip) {
                    $('#pickfiles').prop('disabled', false).html('上传图片');
                }
            }
        });
    </script>
@stop

