@extends('activity.graduated.layout')

@section('content')
  <!-- banner -->
  <div class="banner pos_r">
    <img width="100%" src="{{ asset('activity/graduated/images/top_banner.jpg') }}" alt="" />
    <a class="top_join_btn" href="{{url('/')}}/activities/graduated/join" title=""> 
      <img src="{{ asset('activity/graduated/images/top_join_btn.jpg') }}" alt="" />
    </a>
  </div>
  <!-- banner end -->
  <!-- data -->
  <div class="page_data" style="background-image:url({{ asset('activity/graduated/images/data_bg.jpg')}});">
    <div class="list">
      <div class="item"><p>2375</p>参与人数</div>
      <div class="item"><p>3247</p>投票人数</div>
      <div class="item"><p>6524</p>累计票数</div>
    </div>
  </div>
  <!-- data end -->
  <!-- box -->
  <div class="box color">
    <div class="list">
      <div class="tit">
        <div class="row"><span>排名</span><span>姓名</span><span>票数</span></div>
      </div>
      <div class="list_top">
      <?php $n=1; ?>
        @foreach( $users as $user)
          <div class="row"><span>No.<?php echo $n;$n++;?></span><span>{{$user->name}}</span><span>{{ $user->vote == '' ? 0 : $user->vote }}</span></div>
        @endforeach
      </div>
    </div>
    <div class="txt_c">
      <div class="btn bg2 dis_ib"><a class="txt_c dis_ib" href="{{url('/activities/graduated/index')}}" title="返回首页">返回首页</a></div>
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