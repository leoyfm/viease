@extends('activity.graduated.layout')

@section('content')
  <div class="box color msg">
    <div class="icon txt_c"><i class="fa fa-check bg3 ove_h"></i>
      <p class="t">{{ $msg }}</p>
    </div>
    <div class="txt_c">
      <div class="btn bg2 dis_ib"><a class="txt_c dis_ib" href="{{url('/activities/graduated/index')}}" title="返回首页">返回首页</a></div>
    </div>
  </div>
@endsection

@section('pagejs')
<script type="text/javascript">
$(function(){
  //page js
  $(".wrap").addClass("ok").css("min-height",$(window).height());
})
</script>
@endsection