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
  <div class="box">
    <div class="con">
      <p class="title color"> {{ $user->name }}</p>
      <div class="vote_data">
        <ul class="txt_c">
          <li>编号：#{{$user->id}}</li>
          <li>票数：{{ $user->vote == '' ? 0 : $user->vote }}</li>
        </ul>
      </div>
      <div class="pic"> <img src="{{ $user->pic }}"> </div>
      <p class="message">{{ $user->remark }}</p>
      <div class="txt_c">
        <div class="btn bg2 dis_ib"><a class="txt_c dis_ib" href="{{url('/')}}/activities/graduated/index" title="返回首页">返回首页</a></div>
        <div class="zan btn bg3 dis_ib"><a class=" txt_c dis_ib" href="{{ url('activities/graduated/vote',$user->id) }}" title="投一票"><i class="fa fa-thumbs-up"></i>投一票</a></div><!-- /activities/team/vote/{{$user->id}} -->
      </div>
    </div>
  </div>
  <!-- box end -->
@include('activity.graduated.rule')
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