@extends('admin.layout')
@section('content')

<div class="console-content">
    <div class="page-header">
        <h2 id="nav">活动管理 <div class="pull-right">
                <button class="btn btn btn-create" data-toggle="tooltip" data-placement="top" title="新建活动">新建</button>
                <button class="btn btn btn-sync" data-toggle="tooltip" data-placement="top" title="同步菜单">同步</button>
                <button class="btn btn btn-apply" data-toggle="tooltip" data-placement="top" title="同步菜单到服务器">应用</button>
                <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="启用或停用菜单">停用</button></div></h2>
    </div>
    <div class="well row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>活动名称</th>
                    <th>活动描述</th>

                </tr>
            </thead>
            <tbody>
            @if($activities->count())
                {{ $i = 1 }}
                @foreach($activities as $activity)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $activity->name }}</td>
                        <td>{{ $activity->desc }}</td>
                        <td>
                            @if( $activity->enable == 'yes')
                                <a href="{{ admin_url('activity/disable/'.$activity->id)}}" class="btn btn-success btn-xs">停用</a>
                            @else
                                <a href="{{ admin_url('activity/enable/'.$activity->id)}}" class="btn btn-success btn-xs">开启</a>
                            @endif
                            <a href="{{ admin_url('activity/update/'.$activity->id)}}" class="btn btn-success btn-xs">编辑</a>
                            <a href="{{ admin_url('activity/delete/'.$activity->id)}}" class="btn btn-success btn-xs">删除</a>

                        </td>

                    </tr>

                @endforeach

            @endif
            </tbody>

        </table>
    </div>
</div>

<!--End-->
<script type="text/template" id="no-menus-content-template">
    <div class="blankslate spacious">
        <p>尚未配置菜单</p>
        <div><a href="javascript:;" class="add-menu-item">点此立即创建</a></div>
    </div>
</script>
<script type="text/template" id="menu-item-template">
    <div class="list-group-item menu-item" id="<%= menu.id %>" data-parent-id="<%= menu.parent %>">
        <div class="menu-item-heading">
            <span class="menu-item-name"><%= menu.name %></span>
            <div class="actions pull-right">
                <a href="javascript:;" class="edit" title=""><i class="ion-ios-compose-outline"></i></a>
                <a href="javascript:;" class="add-sub" ><i class="ion-ios-plus-empty"></i></a>
                <a href="javascript:;" class="trash" ><i class="ion-ios-trash-outline"></i></a>
            </div>
        </div>
        <div class="list-group sub-buttons no-menus"></div>
    </div>
</script>
<script type="text/template" id="menu-item-form-template">
    <div class="list-group-item menu-item">
        <form action="" method="post" accept-charset="utf-8" class="menu-item-form">
            <div class="form-group">
                <input type="text" name="name" placeholder="" class="form-control" value="<% if (typeof name != 'undefined') { %><%= name %><% } %>">
            </div>
            <input type="hidden" name="id" value="<% if (typeof id != 'undefined') { %><%= id %><% } %>">
            <input type="hidden" name="parent" value="<% if (typeof parent != 'undefined') { %><%= parent %><% } %>">
            <button type="submit" class="btn btn-xs btn-success">保存</button>
            <button type="button" class="btn btn-xs btn-danger cancel-do">取消</button>
        </form>
    </div>
</script>

@stop

@section('js')
<script>
require(['pages/activity']);
</script>
@stop
