@extends('activity.tour.layout')

@section('content')
@include('activity.tour.header')
  <!-- list -->
  <div class="list_pic ove_h">
    @foreach( $participarts as $user )
    <!-- item -->
    <div class="item shadow">
      <div class="pic" style="background-image:url({{ $user->pic }}?imageView2/1/w/300/h/300);"><a href="/activities/tour/content/{{$user->id}}?activity=13" title=""></a></div>
      <div class="info">
        <p>{{ $user->name }}</p>
        <span>{{ $user->vote == '' ? 0 : $user->vote }}票</span> </div>
      <a href="/activities/tour/content/{{$user->id}}?activity=13" class="vote">投TA<br />
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
      <a class="add" href="{{url('/activities/tour/join?activity=13')}}" title="">参加活动</a>
      <a class="add rank" href="{{url('/activities/tour/most?activity=13')}}" title="">排行榜</a> 
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