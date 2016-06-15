@extends('admin.layout')

@section('content')
<div class="console-content">
    <div class="page-header">
        <h2 id="nav">@if(isset($activity)) 编辑活动 @else 添加活动 @endif</h2>
    </div>
    <div class="well bs-component">
        @form(['url' => isset($activity)? admin_url('activity/update/'.$activity->id): admin_url('activity/create'), 'method' => 'post', 'class' => 'form-horizontal'])
        @col_input('text','name',$errors,'*活动名称',isset($activity) ? $activity->name : old('name'), ['placeholder' => '例如：摇红包'])
        @col_input('text','desc',$errors,'活动描述',isset($activity) ? $activity->desc : old('desc'), ['placeholder' => '例如：活动简介'])
        @col_input('text','url',$errors,'页面URL',isset($activity) ? $activity->url : old('url'), ['placeholder' => '例如：活动页面入口'])

        @col_input('text','',$errors,'入口页面',isset($activity) ? 'activities/'.$activity->id.'?activity='.$activity->id : '',['disabled' => true])

        @col_submit('提交')
        @endform
    </div>
</div>
@endsection