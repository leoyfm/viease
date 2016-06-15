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
  <!-- list -->
  <div class="list_pic ove_h">
    @foreach( $participarts as $user )
    <!-- item -->
    <div class="item">
      <div class="pic" style="background-image:url({{ $user->pic }});"><a href="/activities/graduated/content/{{$user->id}}" title=""></a></div>
      <div class="info">
        <p>{{ $user->name }}</p>
        <span>{{ $user->vote == '' ? 0 : $user->vote }}票</span> </div>
      <a href="/activities/graduated/content/{{$user->id}}" class="vote">投TA<br />
      一票</a> </div>
      <!-- item end -->
    @endforeach
  </div>
  <!-- list end -->
  <!-- paging -->
    {!! $participarts->render() !!}
  <!-- paging end -->
  <!-- menu -->
  <div class="menu">
    <div> 
      <a class="add" href="{{url('/')}}/activities/graduated/join" title="">参加活动</a>
      <a class="add rank" href="{{url('/')}}/activities/graduated/most" title="">排行榜</a> 
    </div>
  </div>
  <!-- menu end -->
@endsection

@section('pagejs')
<script type="text/javascript">
$(function(){
  //page js
  $(".bottom").css({'padding-bottom':'5.6rem'});
})
</script>
@endsection