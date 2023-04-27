<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="/public/ybt/plugin/TreeTable/assets/layui/css/layui.css">
	<script src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.min.js"></script>
	<script src="__PUBLIC__/layui/layui.all.js"></script>
</head>
<body>
	
</body>
</html>
<div class="layui-tab">
  <div class="layui-tab-content">
    <div class="layui-tab-item layui-show </if> ">
    	<div style="text-align:center;width:80%;margin:30px auto">
    		<table class="layui-table">
    			<tr>
    				<td>奖品名称</td>
    				<td>获奖时间</td>
    			</tr>
                <?php if(is_array($my_prize)): foreach($my_prize as $key=>$v): ?><tr>
                        <td><?php echo ($v["prize_name"]); ?></td>
                        <td><?php echo ($v["addtime"]); ?></td>
                    </tr><?php endforeach; endif; ?>
    		</table>
    	</div>
    </div>
<script>
	

</script>