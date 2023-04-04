<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>tree-table</title>
    <link rel="stylesheet" href="/Public/ybt/plugin/TreeTable/assets/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/ybt/plugin/TreeTable/assets/common.css"/>
    <style>
        input {
            height: 33px;
            line-height: 33px;
            padding: 0 7px;
            border: 1px solid #ccc;
            border-radius: 2px;
            margin-bottom: -2px;
            outline: none;
        }

        input:focus {
            border-color: #009E94;
        }
    </style>
</head>
<body>
<div class="layui-container" style="width:100%">
    <br><br>
    <button class="layui-btn" id="btn-refresh">刷新表格</button>
    &nbsp;&nbsp;
    <div class="layui-btn-group">
        <button class="layui-btn" id="btn-expand">全部展开</button>
        <button class="layui-btn" id="btn-fold">全部折叠</button>
    </div>
    &nbsp;&nbsp;
    <input id="edt-search" type="text" placeholder="输入关键字" style="width: 120px;"/>&nbsp;&nbsp;
    <button class="layui-btn" id="btn-search">&nbsp;&nbsp;搜索&nbsp;&nbsp;</button>

    <table id="auth-table" class="layui-table" lay-filter="auth-table"></table>
</div>

<script src="/Public/ybt/plugin/TreeTable/assets/layui/layui.js"></script>
<script>
    layui.config({
        base: '/Public/ybt/plugin/TreeTable/module/'
    }).extend({
        treetable: 'treetable-lay/treetable'
    }).use(['table', 'treetable'], function () {
        var $ = layui.jquery;
        var table = layui.table;
        var treetable = layui.treetable;

        // 渲染表格
        var renderTable = function () {
        layer.load(2);
	        treetable.render({
	            treeColIndex: 1,
	            treeSpid: '<?php echo ($pid); ?>',
	            treeIdName: 'id',
	            treeDefaultClose: true,
	            treePidName: 'pid',
	            elem: '#auth-table',
	            url: '/APP/Modules/Systemlogined/Tpl/Member/tree.json',
	            page: false,
	            cols: [[
	                {type: 'numbers'},
	                {field: 'id', minWidth: 200, title: 'id'},
	                {field: 'username', title: '账号'},
	                {field: 'level', title: '品类'},
	                {field: 'nums', title: '团队人数'},
	                // {
	                //     field: 'isMenu', width: 80, align: 'center', templet: function (d) {
	                //         if (d.isMenu == 1) {
	                //             return '<span class="layui-badge layui-bg-gray">按钮</span>';
	                //         }
	                //         if (d.parentId == -1) {
	                //             return '<span class="layui-badge layui-bg-blue">目录</span>';
	                //         } else {
	                //             return '<span class="layui-badge-rim">菜单</span>';
	                //         }
	                //     }, title: '类型'
	                // }
	            ]],
	            done: function () {
	                layer.closeAll('loading');
	            }
	        });
        };
        
        renderTable();

        $('#btn-expand').click(function () {
            treetable.expandAll('#auth-table');
        });

        $('#btn-fold').click(function () {
            treetable.foldAll('#auth-table');
        });
        
        $('#btn-refresh').click(function () {
            renderTable();
        });

        $('#btn-search').click(function () {
            var keyword = $('#edt-search').val();
            var searchCount = 0;
            $('#auth-table').next('.treeTable').find('.layui-table-body tbody tr td').each(function () {
                $(this).css('background-color', 'transparent');
                var text = $(this).text();
                if (keyword != '' && text.indexOf(keyword) >= 0) {
                    $(this).css('background-color', 'rgba(250,230,160,0.5)');
                    if (searchCount == 0) {
                        treetable.expandAll('#auth-table');
                        $('html,body').stop(true);
                        $('html,body').animate({scrollTop: $(this).offset().top - 150}, 500);
                    }
                    searchCount++;
                }
            });
            if (keyword == '') {
                layer.msg("请输入搜索内容", {icon: 5});
            } else if (searchCount == 0) {
                layer.msg("没有匹配结果", {icon: 5});
            }
        });
    });
</script>
</body>
</html>