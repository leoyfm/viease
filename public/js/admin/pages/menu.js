/**
 * 菜单管理页 js
 *
 * @author overtrue <anzhengchao@gmail.com>
 */
define(['jquery', 'repos/menu-store', 'repos/menu', 'WeChatEditor', 'util', 'admin/response-picker', 'admin/common'], function ($, Menu, MenuRepo, WeChatEditor, Util, ResponsePicker) {
    $(function(){
        // 菜单列表
        var $menusListContainer     = $('.menus');
        var $emptyMenusTemplate     = _.template($('#no-menus-content-template').html());
        var $menuItemFormTemplate   = _.template($('#menu-item-form-template').html());
        var $menuItemTemplate       = _.template($('#menu-item-template').html());
        var $responseContainer = $('.response-content');



        // 监听变化
        $menusListContainer.ifEmpty(function(el){
            el.html($emptyMenusTemplate()).addClass('no-menus');
        });
        $responseContainer.ifEmpty(function(el){
            el.html('<div class="blankslate spacious">你可以从左边创建一个菜单并设置响应内容。</div>');
        });

        // listsMenuFromDB();
        // 显示菜单列表
        function listsMenuFromDB () {

            console.log('listsMenuFromDB');
            MenuRepo.getMenus(function($menus){
                console.log('result menu',$menus);
                // clean
                $menusListContainer.html('').removeClass('no-menus');


                listMenusFromDb( $menus );
                return $menus;

                $res = {};

                //TODO:
                _.each($menus, function($menu){
                    var $id = (new Date).getTime();

                    $res[$id] = {
                        id: $id,
                        name: $menu['name'],
                        type: $menu['type'],
                    };
                });

                console.log('res', $res);
                return $res;
            });
        }

        function listMenus ($menus) {
            console.log('listMenus');

            console.log($menus);
            for ($id in $menus) {
                var $button = $menus[$id];
                var $target = $menusListContainer;

                if (!isNaN($button.parent) && $button.parent > 0) {
                    $target = $('#'+$button.parent).find('> .sub-buttons');
                }

                $target.removeClass('no-menus');

                console.log('add menu', $button);
                $target.append($($menuItemTemplate({ menu: $button })).data($button));
            }
        }

        function listMenusFromDb( $menus ){
            Menu.clean();

            for($id in $menus ){

                console.log('o menu', $menus[ $id] );

                var $iid = (new Date).getTime();
                console.log('new menu id', $iid );

                var item = {id:$iid,name:$menus[$id].name};

                if( $menus[$id].sub_buttons.length == 0){
                    item.hasChild =false;
                    item.parent = 0;
                    item.content={type: $menus[$id].type, 'text':$menus[$id].key};

                    switch ($menus[$id].type){

                        case 'view':
                            item.content={type: 'url'};
                            item.content['url'] = $menus[$id].key;
                            break;
                        case 'click':
                            item.content={type: 'text'};
                            item.content['text'] = $menus[$id].material['value'];
                            break;

                    }

                    console.log('new menu', item );
                    Menu.put( $iid, item);

                    //put to store;
                }else{
                    item.hasChild =true;
                    item.parent = 0;
                    item.content={};

                    console.log('new menu', item );
                    //put to store
                    Menu.put( $iid, item);
                    var $submenus = $menus[$id].sub_buttons;
                    for( var $cid in $submenus ){

                        console.log('o sub menu '+ $cid, $submenus[$cid] );
                        var $ccid = (new Date).getTime();
                        var citem = {id:$ccid,name:$submenus[$cid].name};
                        
                        citem.hasChild =false;
                        citem.parent = $iid;
                     
                        switch ($submenus[$cid].type){

                            case 'view':
                                citem.content={type: 'url'};
                                citem.content['url'] = $submenus[$cid].key;
                                break;
                            case 'click':
                                citem.content={type: 'text'};
                                citem.content['text'] = $submenus[$cid].material['value'];
                                break;

                        }
                        console.log('n sub menu '+ $cid, citem );
                        //put to store;
                        Menu.put( $ccid, citem);
                    }
                }
            }

            $menus = Menu.all();
            listMenus( $menus);

        }

        // 本地存储的
        var $cachedMenus = Menu.all();
        // $cachedMenus = {};


        if (!$.isEmptyObject($cachedMenus)) {
            listMenus($cachedMenus);
        } else {
            $menus = listsMenuFromDB();
            listMenusFromDb($menus);
        }



        /**
         * 创建表单
         *
         * @param {Object} $target
         */
        function createMenuItemForm($target, $parentId) {
            if ($target.hasClass('no-menus')) {
                $target.html('').removeClass('no-menus');
            };

            var $form = $menuItemFormTemplate({ parent: ($parentId || 0) });

            $target.append($form);

            $target.find('input').focus();
        }

        /**
         * 点击父级时显示
         *
         * @param {Menu} $menu
         */
        function showFirstLevelContent ($menu) {
            $blankslate = $('<div class="blankslate spacious"><a href="javascript:;" class="btn btn-success">添加子级</a></div>');
            $blankslate.find('.btn').on('click', function(){
                $('.menu-item[id='+$menu.id+'] .actions .add-sub').trigger('click');
            });
            $('.response-content').html($blankslate);
        }

        //同步按钮
        $(document).on('click', '.btn-sync', function(event){
            event.stopPropagation();
            MenuRepo.syncMenu(function( res ){

                console.log('res', res);

                if(res.status){
                    Menu.clean();
                    success('保存成功！');
                    setTimeout(function(){
                        window.location.reload();
                    }, 1500);
                }
            });
        });

        //应用按钮
        $(document).on('click', '.btn-apply', function(event){
            event.stopPropagation();
            MenuRepo.applyMenu(function( res ){

                console.log('res', res);

                if(res.status){
                    Menu.clean();
                    success('保存成功！');
                    setTimeout(function(){
                        window.location.reload();
                    }, 1500);
                }
            });
        });

        // 创建一级
        $(document).on('click', '.add-menu-item', function(event){
            event.stopPropagation();
            if ($menusListContainer.find('> .menu-item').length >= 3) {
                return error('最多只有 3 个一级菜单');
            };
            createMenuItemForm($menusListContainer);
        });

        // 创建二级
        $(document).on('click', '.actions .add-sub', function(event){
            event.stopPropagation();
            var $item = $(this).closest('.menu-item');
            var $subButtons = $item.find('.sub-buttons:first');
            if ($item.data('parentId')) {return;};

            if ($subButtons.find('.menu-item').length >= 5) {
                return error('最多只有 5 个二级菜单');
            };

            createMenuItemForm($subButtons, $item.attr('id'));
        });

        // 删除菜单
        $(document).on('click', '.actions .trash', function(event){
            event.stopPropagation();
            var $item = $(this).closest('.menu-item');

            $item.slideUp(300, function(){

                console.log('delete menu id',$(this).attr('id') );
                Menu.delete($(this).attr('id'));
                $(this).remove();

                // 父级下面如果没有了更新父级属性
                if ($item.data('parentId')) {
                    var $parent = $('[id='+$item.data('parentId')+']');
                    if (!$parent.find('.sub-buttons .menu-item').length) {
                        Menu.update($item.data('parentId'), {hasChild:false});
                    };
                };

                $responseContainer.html('');
            })
        });

        // 编辑菜单
        $(document).on('click', '.menu-item', function(event){
            event.stopPropagation();
            $('.menu-item.current').removeClass('current');
            $(this).addClass('current');
            var $menu = Menu.get($(this).attr('id'));

            if ($menu['hasChild']) {
                return showFirstLevelContent($menu);
            };
            

            console.log('reponse content', $responseContainer );

            new ResponsePicker($responseContainer, {
                current: $menu.content,
                onChanged: function($item){
                    console.log('pasr',$item);
                    Menu.update($menu.id, {content: $item});
                }
            });
        });

        // 编辑菜单名称
        $(document).on('click', '.actions .edit', function(event){
            event.stopPropagation();
            var $item = $(this).closest('.menu-item').hide();

            var $id   = $item.attr('id');
            var $name = $item.find('.menu-item-name:first').text();

            $item.after($menuItemFormTemplate($item.data()));
        });

        // 创建菜单按钮表单提交
        $(document).on('submit', '.menus form.menu-item-form:first', function(event){
            event.preventDefault();
            event.stopPropagation();
            var $params = Util.parseForm($(this));
            var $formItem = $(this).closest('.list-group-item');

            if ($params.name.replace(' ', '').length < 1) {
                error('名称不能为空！');
            };

            $params['parent'] = parseInt($params['parent']) || 0;

            // 更新
            if ($params.id) {
                $('#'+$params.id).data($params).show()
                .find('.menu-item-heading .menu-item-name:first').text($params.name);
                $formItem.remove();
                Menu.update($params.id, $params);
            } else {
                // 新建
                $params.id = (new Date).getTime();
                var $item   = $($menuItemTemplate({ menu: $params})).data($params);

                if ($params['parent']) {
                    Menu.update($params['parent'], {hasChild:true});
                }

                $formItem.replaceWith($item);
                Menu.put($params['id'], $params);
            }
        });

        // 防止冒泡
        $(document).on('click', '.menus form', function (event) {
            event.stopPropagation();
        });

        // 取消
        $(document).on('click', '.menus form .cancel-do', function(event){
            event.preventDefault();
            event.stopPropagation();
            var $form = $(this).closest('form.menu-item-form');
            var $params = Util.parseForm($form);

            if ($params.id) {
                $('#'+$params.id).show();
            }

            $(this).closest('form').parent().remove();
        });

        // 提交菜单
        $(document).on('click', '.submit-menu', function(){
            submitMenu();
        });

        // 表单 -> 结果
        function saveMenu ($content, $data) {
            var $menuId = $('.menu-item.current').data('id');
            Menu.update($menuId, {});
            Menu.update($menuId, $data);
        }

        // 提交设置好的菜单到后端
        function submitMenu () {
            var $menus = Menu.all();

            console.log( 'all menu', $menus );
            var $data = {};

            for($id in $menus){
                console.log( 'menu item', $menus[$id] );
                var $item = {
                    name: $menus[$id].name,
                    type: $menus[$id]['content']['type'] ? ($menus[$id]['content']['type'] == 'url' ? 'view' : $menus[$id]['content']['type']) : null,
                };

                console.log( 'menu item type', $menus[$id]['content']['type'] );
                
                $item['value'] = $menus[$id]['content'][$menus[$id]['content']['type']];
                console.log( 'menu item', $item );

                if (!$menus[$id].hasChild && !$item['value']) {
                    return error('请设置菜单 "'+$item.name+'" 的响应内容！');
                };

                if ($menus[$id].parent) {

                    $data[$menus[$id].parent]['sub_button'] = $data[$menus[$id].parent]['sub_button'] || [];
                    $data[$menus[$id].parent]['sub_button'].push($item);
                } else {
                    $data[$id] = $item;
                }
            }

            MenuRepo.submitMenu($data, function(){
                Menu.clean();
                success('保存成功！');
                setTimeout(function(){
                    window.location.reload();
                }, 1500);
            });
        }
    });
});