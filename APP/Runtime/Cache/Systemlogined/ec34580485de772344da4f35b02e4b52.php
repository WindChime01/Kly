<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/layui/css/layui.css">
	<script src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.min.js"></script>
	<script src="__PUBLIC__/layui/layui.all.js"></script>
</head>
<body>
	
</body>
</html>
<div class="layui-tab">
  <ul class="layui-tab-title" style="padding-left:20px">
    <li class="layui-this" ><?php echo ($info["id"]); ?>-<?php echo ($info["username"]); ?> 的实名信息</li>
  </ul>
  <div class="layui-tab-content">
    <div style="text-align:center;width:80%;margin:0 auto" class="infotable">
		<table class="layui-table">
			<colgroup>
				<col width="100">
				<col width="200">
			</colgroup>
			<tr>
				<td>姓名</td>
				<td><?php echo ($info["truename"]); ?></td>
			</tr> 
			<tr>
				<td>证件号码</td>
				<td><?php echo ($info["shenfen"]); ?></td>
			</tr>
			
			<tr>
				<td>证件图片</td>
				<td><img src="<?php echo ($info["image"]); ?>" style="width:100%"></td>
			</tr>
			<tr>
				<td>状态</td>
				<td id="tip"><?php echo ($info["status_im"]); ?></td>
			</tr>
			</tbody>
		</table>
	</div>
	<?php if($info['status'] == 1): ?><div style="text-align:center" class="btns"><button type="button" class="layui-btn" onclick="pass(<?php echo ($info["id"]); ?>,2)">通过</button> <button type="button" class="layui-btn layui-btn-danger" onclick="pass(<?php echo ($info["id"]); ?>,3)">不通过</button></div><?php endif; ?>
	
  </div>
</div>
<script>
	//通过审核
	function pass(id,type) {
		$.post('/systemlogined/member/certificationPass',{id:id,type:type},function(response){
			$res = JSON.parse(response);
			layer.msg($res.msg);
			console.log($res.success);
			if($res.success == 1) {
				$('.btns').hide();
				$('#tip').text($res.data.msg);
			}
		})
	}

</script>