@extends('activity.tour.layout')

@section('content')
@include('activity.tour.header')
  <!-- box -->
  <div class="box">
    <div class="list">
      <div class="tit">
        <div class="row"><span>排名</span><span>姓名</span><span>票数</span></div>
      </div>
      <div class="list_top">
      <?php $n=1; ?>
        @foreach( $users as $user)
          <div class="row color1"><span>No.<?php echo $n;$n++;?></span><span>{{$user->name}}</span><span>{{ $user->vote == '' ? 0 : $user->vote }}</span></div>
        @endforeach
      </div>
    </div>
    <div class="txt_c">
      <div class="btn bg2 dis_ib"><a class="txt_c dis_ib" href="{{url('/activities/tour/index?activity=13')}}" title="返回首页">返回首页</a></div>
    </div>
  </div>
  <!-- box end -->
@endsection

@section('pagejs')
<script type="text/javascript">
$(function(){
  //page js
  $(".wrap").css("min-height",$(window).height());
})
</script>
@endsection