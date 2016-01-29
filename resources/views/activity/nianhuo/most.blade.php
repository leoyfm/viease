@include('activity.nianhuo.header')
    @include('activity.nianhuo.tab')
        <!-- box -->
<div class="box color">
    <div class="list">
        <div class="tit">
            <div class="row"><span>排名</span><span>编号</span><span>姓名</span><span>赞数</span></div>
        </div>
        <div class="list_top">
            @foreach( $users as $key => $user )
                <div class="row"><span>No.{{ $key +1 }}</span><span>{{ $user->id }}</span><span>{{ $user->name }}</span><span>{{ $user->vote }}</span></div>

            @endforeach

        </div>
    </div>

</div>
<!-- box end -->

@include('activity.nianhuo.footer')