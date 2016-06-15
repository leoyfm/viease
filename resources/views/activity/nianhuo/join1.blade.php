@include('activity.nianhuo.header') 
<!-- box -->
<div class="box color">
  <div class="shai">
    <div class="tit txt_c color">我要晒年货</div>
    <form class="form" method="post" action="" enctype="multipart/form-data">
      <div class="t">个人信息：</div>
      <div class="row">
        <label>姓名</label>
        <input type="text" placeholder="请输入您的姓名" data="is_ch" maxlength="10" name="name" />
      </div>
      <div class="row">
        <label>电话</label>
        <input type="text" placeholder="请输入您的电话" data="is_mobile" maxlength="11" name="tel" />
      </div>
      <div class="pic">
        <div class="t">上传照片：</div>
        <div class="row" id="container">
          <button id="pickfiles" class="btn-primary btn-lg btn-block sub bg" type="submit" style="background-image:url({{ asset('/assetactivity/nianhuo/images/file_pic.jpg') }});"></button>
          <label class="pos_a" style="left:0; top:0;">图片</label>
          <input class="file" type="hidden" name="file1" id="file1" error="on" /><!-- -->
        </div>
      </div>
      <div class="msg">
        <div class="t">新年寄语：</div>
        <div class="row">
          <label>寄语</label>
          <textarea placeholder="请输入新年寄语" data="is_empty" name="msg"></textarea>
        </div>
      </div>
      <div class="error"><i class="fa fa-exclamation-triangle color"></i>您输入的<span id="str"></span>有误！</div>
      <div class="txt_c">
        <div class="btn bg dis_ib"><a class="bg txt_c dis_ib" href="{{ url('activities/nianhuo') }}" title="返回首页">返回首页</a></div>
        <div class="btn bg dis_ib"><i class="fa fa-arrow-right"></i>
          <input class="submit bg" type="submit" value="晒一下" />
        </div>
      </div>
    </form>
  </div>
</div>
<!-- box end --> 
<!-- 弹窗 -->
<div class="popup">
  <div class="popup_bg"> </div>
  <div class="popup_box"><img src="{{ asset('/assetactivity/nianhuo/images/loading.gif') }}" alt="" />请稍后...</div>
</div>
<!-- 弹窗 end --> 
@include('activity.nianhuo.rule')
@include('activity.nianhuo.footer')
<script type="text/javascript" src="{{ asset('qiniu/plupload/plupload.full.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('qiniu/plupload/i18n/zh_CN.js') }}"></script>
<script type="text/javascript" src="{{ asset('qiniu/qiniu.js') }}"></script>
<script>
  $(function(){
    var uploader = Qiniu.uploader({
      runtimes: 'html5,flash,html4', //上传模式,依次退化
      browse_button: 'pickfiles', //上传选择的点选按钮，**必需**
      uptoken_url: 'uploadurl', //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
      domain: 'http://7xqjse.com2.z0.glb.qiniucdn.com/', //bucket 域名，下载资源时用到，**必需**
      container: 'container', //上传区域DOM ID，默认是browser_button的父元素，
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
          $('#pickfiles').prop('disabled', true).css("background-image","none").html('图片上传中...');
        },
        'FileUploaded': function(up, file, info) {
          console.log('uploadup', info);

          $('#pickfiles').prop('disabled', false).css("background-image","none").html('');
          var res = JSON.parse(info);

                var style = '-thumb';
                imgUrl = up.getOption('domain') + res.key;
				
					if(jQuery.isPicture(imgUrl))
					{
						$('#pickfiles').css("background-image","url("+imgUrl + style+")");
						$('#file1').val(imgUrl).removeAttr("error");
					}
					else
					{
						$('#pickfiles').html("您上传的文件格式有误！<br>请重新上传");
						$('#file1').attr("error","on");
					}
//                refresh(imgUrl);
        },
        'Error': function(up, err, errTip) {
          $('#pickfiles').prop('disabled', false).css("background-image","none").html('点击上传图片');
        }
	  }
    });
	
	$("#pickfiles").find("input[type=file]").bind("change",function(){
		alert("error");
	});
	
  });

</script>