@extends('admin.layout')
@section('content')
<div class="console-content">
    <div class="page-header">
        <h2 id="nav">自动回复 <button class="btn btn-success btn-sm add-new">添加规则</button></h2>
    </div>
    <div class="well rule-container">
        <div class="panel panel-default rule-item" data-id="2" data-name="abd" data-trigger-type="contain" data-trigger-keywords="sss" data-text="ssss" data-url="">
            <div class="panel-heading">规则1 <div class="pull-right"><a href="javascript:;" class="edit-rule"><i class="ion-ios-compose-outline icon-md"></i></a> <a href="javascript:;" class="delete-rule"><i class="ion-ios-trash-outline icon-md"></i></a></div></div>
            <div class="panel-body">
                <div class="keywords">关键词：股票</div>
                <div class="replys">回复：xxxx</div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">规则1</div>
            <div class="panel-body">
                <div class="keywords">关键词：股票</div>
                <div class="replys">回复：xxxx</div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">规则1</div>
            <div class="panel-body">
                <div class="keywords">关键词：股票</div>
                <div class="replys">回复：xxxx</div>
            </div>
        </div>

    <!--样例使用完后删除-->
    <a href="javascript:;" id="list">获取列表</a>
    <a href="javascript:;" id="tester">保存测试</a>
    <a href="javascript:;" id="save">修改测试</a>
    <a href="javascript:;" id="add">增加一个自动回复</a>
     <a href="javascript:;" id="update">修改一个自动回复</a>
    <script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">
    $(function(){
        $('#tester').click(function(){
            $.ajax({
              type: 'POST',
              url: '/admin/reply/save-event-reply',
              data: {
                    type:"follow",
                    reply_content:"MEDIA_XXXXXXXXXXXXX",
                    reply_type:'material'
                },
            });
        });
    });
    </script>
    <script type="text/javascript">
    $(function(){
        $('#list').click(function(){
            $.ajax({
              type: 'GET',
              url: '/admin/reply/lists',
              success: function($resp){
                console.log($resp);
              }
            });
        });
    });
    </script>
    <script type="text/javascript">
    $(function(){
        $('#save').click(function(){
            $.ajax({
              type: 'POST',
              url: '/admin/reply/save-event-reply',
              data: {
                    type:"follow",
                    reply_content:"你好啊",
                    reply_type:'text'
                },
            });
        });
    });
    </script>

    <script type="text/javascript">
    $(function(){
        $('#add').click(function(){
            $.ajax({
              type: 'POST',
              url: '/admin/reply/store',
              data: {
                    name:"单回复",
                    trigger_keywords:[
                        "说话"
                    ],
                    trigger_type:"equal",
                    replies:[
                        {
                            'type':'text',
                            'content':'你好啊大家好才是真的好'
                        },
                        {
                            'type':'text',
                            'content':'你好啊大家好才是真的好2'
                        }
                    ],
                },
            });
        });
    });
    </script>

      <script type="text/javascript">
    $(function(){
        $('#update').click(function(){
            $.ajax({
              type: 'POST',
              url: '/admin/reply/update/15',
              data: {
                    name:"粉丝",
                    trigger_keywords:[
                       "大学","你好"
                    ],
                    trigger_type:"contain",
                    replies:[
                        {
                            'type':'text',
                            'content':'大家好才是真的好'
                        }
                    ],
                },
            });
        });
    });
    </script>
    <!--End 样例使用完删除-->
    </div>
</div>

<script type="text/plain" class="form-template">
  <div class="form-container">
      <div class="panel panel-default">
          <div class="panel-heading">添加规则</div>
          <div class="panel-body">
          <form class="form-horizontal form-create">
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">规则名称</label>
                  <div class="col-lg-6">
                    <input type="text" name="name" class="form-control" id="inputEmail" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">类型</label>
                  <div class="col-lg-6">
                    <div class="radio">
                      <label>
                        <input type="radio" name="trigger_type" id="optionsRadios1" value="contain" checked="">
                        包含
                      </label>
                      <label>
                        <input type="radio" name="trigger_type" id="optionsRadios2" value="equal">
                        等于
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">关键词</label>
                  <div class="col-lg-6">
                    <input type="text" name="trigger_keywords" class="form-control" id="inputEmail" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-8 col-lg-offset-2">
                      <div class="response-media-picker">

                      </div>
                  </div>
                 </div>
                  <hr>
                <div class="form-group">
                  <div class="col-lg-6 col-lg-offset-2">
                    <input type="hidden" name="id" value="">
                    <button class="btn btn-default form-cancel">取消</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                  </div>
                </div>
            </form>
            </div>
      </div>
  </div>
</script>
@stop

@section('js')
<script>
    require(['pages/reply'])
</script>
@stop