
@include('activity.nianhuo.header', ['js' => $js])
    <!-- box -->
    <div class="box color">
        <div class="con">
            <p class="title color">{{ $user->name }}的年货</p>
            <div class="data">
                <ul class="txt_c">


                    <li>赞数：{{ $user->vote }}</li>
                </ul>
            </div>
            <div class="hr"></div>
            <div class="img"> <img src="<?php
                $url = $user->pic;
                if( strstr( $url, 'http://') === false )
                    echo asset( $url );
                else
                    echo $url.'-thumb';
                ?>"> </div>
            <p class="p1">{{ $user->remark }}</p>


            <!-- 此处修改 -->

            <div class="txt_c">
                <div class="btn bg dis_ib"><a class="bg txt_c dis_ib" href="{{ url('activities/nianhuo') }}" title="返回首页">返回首页</a></div>
                <div class="zan btn bg dis_ib"><a class="bg txt_c dis_ib" href="#2" title="赞一个"><i class="fa fa-thumbs-up"></i>赞一个</a></div>
            </div><!-- {{ url('activities/nianhuo/vote',$user->id) }} -->

            <!-- 结束 -->


        </div>
    </div>
    <script>
	$(function(){

        var num_ticket = {{ $num_ticket }};
		if($(".zan").length)
		{
			var temp ='<div class="popup"><div class="popup_bg close"> </div><div class="popup_box color"><div class="tit">分享</div><div class="c">点击右上方分享到朋友圈<br>即可获得一次投票机会<br>每分享一次，获得一次投票</div></div></div>';
			$("body").append(temp);
		}
		$(".zan").bind("click",function(){
			if( num_ticket != 0 )//判断条件
			{
                window.location.href= '{{ url('activities/nianhuo/vote',$user->id) }}';

			}
			else
			{
				popup();//投票失败方法
			}
		});
		$(".close").bind("click",function(){
		   popup_off();
		});
	});
    </script>
    <!-- box end -->


    <!-- 投票记录 -->
  <div class="jl box txt_c">
    <p class="tit color">最近投票</p>
    <div class="list">
        @foreach ( $voters as $voter)
            <div class="item"><span class="color">{{ $voter->nickname }}</span>送上了宝贵的一票</div>
        @endforeach

    </div>
  </div>
  <script type="text/javascript" src="{{ asset('/assetactivity/js/jquery.SuperSlide.2.1.1.js') }}"></script>
  <script>
	  $(function(){
		  jQuery(".jl").slide({mainCell:".list",autoPage:true,effect:"topLoop",autoPlay:true,vis:3,delayTime:500});

          {{--wx.ready(function(){--}}

              {{--var data = {--}}
                  {{--title: '晒年货,赢大奖',--}}
                  {{--desc:'csdfsdf',--}}
                  {{--link:window.location.href,--}}
                  {{--imgUrl: '',--}}
                  {{--success: function(){--}}
                      {{--$.ajax({--}}
                          {{--type:'POST',--}}
                          {{--url: '{{url('activities/nianhuo/addticket',$cuser->id)}}',--}}
                          {{--success: function( res ){--}}
                              {{--if( res.result)--}}
                                  {{--alert('分享成功 票数加1');--}}
                          {{--}--}}
                      {{--});--}}


                  {{--},--}}
                  {{--cancel: function(){--}}

                  {{--}--}}
              {{--};--}}

              {{--wx.onMenuShareTimeline( data);--}}
              {{--wx.onMenuShareAppMessage( data);--}}
              {{--wx.onMenuShareQQ( data);--}}
              {{--wx.onMenuShareWeibo( data);--}}
              {{--wx.onMenuShareQZone( data);--}}
          {{--});--}}

      });
  </script>
  <!-- 投票记录 end -->
    @include('activity.nianhuo.rule')
@include('activity.nianhuo.footer')