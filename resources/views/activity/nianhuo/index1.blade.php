@include('activity.nianhuo.header')
   @include('activity.nianhuo.tab')
    <!-- list -->
    <div class="list_pic ove_h">

        @foreach ( $participarts as $user)

            <div class="item">
                <div class="pic" style="background-image:url(<?php
                    $url = $user->pic;
                    if( strstr( $url, 'http://') === false )
                        echo asset( $url );
                    else
                        echo $url.'-thumb';
                ?>);">
                    <a href="{{ url('activities/nianhuo/content', [ $user->id ]) }}" title=""></a>
                </div>
                <div class="info">
                    <p>{{ $user->name }}的年货</p>
                </div>
                <div class="zan pos_a"><a class="btn" href="{{ url('activities/nianhuo/vote',$user->id) }}" title="">顶</a>
                    <p class="color">{{ $user->vote }}赞</p>
                </div>
            </div>
        @endforeach

    </div>

    <!-- list end -->
{!! $participarts->render() !!}
@include('activity.nianhuo.footer')