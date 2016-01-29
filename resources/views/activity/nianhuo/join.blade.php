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
        <input type="text" placeholder="请输入您的电话" data="is_mobile" maxlength="11" name="tell" />
      </div>
      <div class="pic">
        <div class="t">上传照片：<span>照片至少要上传1张，最多可上传3张</span></div>
        <div class="row">
          <label>照片</label>

          <input class="file" type="file" name="file1" />
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
  <div class="popup_box"><img src="{{ asset('/assetactivity/images/loading.gif') }}" alt="" />请稍后...</div>
</div>
<!-- 弹窗 end --> 
@include('activity.nianhuo.rule')
@include('activity.nianhuo.footer')