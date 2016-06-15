@extends('activity.tour.layout')

@section('content')
@include('activity.tour.header')
  <!-- box -->
  <div class="box">
    <div class="con">
      <p class="title color1"> {{ $user->name }}</p>
      <div class="vote_data">
        <ul class="txt_c">
          <li>编号：#{{$user->id}}</li>
          <li>票数：{{ $user->vote == '' ? 0 : $user->vote }}</li>
        </ul>
      </div>
      <div class="photo"> <img src="{{ $user->pic }}?imageMogr2/thumbnail/500x"> </div>
      <p class="message">{{ $user->remark }}</p>
      <div class="txt_c">
        <div class="btn bg2 dis_ib"><a class="txt_c dis_ib" href="{{url('/activities/tour/index?activity=13')}}" title="返回首页">返回首页</a></div>
        <div class="zan btn bg3 dis_ib"><a class=" txt_c dis_ib" href="{{ url('activities/tour/vote',$user->id) }}?activity=13" title="投一票"><i class="fa fa-thumbs-up"></i>投一票</a></div><!-- /activities/team/vote/{{$user->id}} -->
      </div>
    </div>
  </div>
  <!-- box end -->
@include('activity.tour.rule')
@endsection

@section('pagejs')
<script type="text/javascript">
$(function(){
  //page js
    var num_ticket = {{ $num_ticket }};

    $(".zan").bind("click",function(){
        if( true )//判断条件
        {
            window.location.href= '{{ url('activities/liuyi/vote',$user->id) }}';
        }
        else
        {
          tipShow({content:"点击右上方分享到朋友圈<br>即可获得一次投票机会<br>每分享一次，获得一次投票"});
        }
    });
})
</script>
@endsection