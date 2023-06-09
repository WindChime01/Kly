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
  <div class="layui-tab-content">
    <div class="layui-tab-item layui-show </if> ">
    	<div style="text-align:center;width:80%;margin:30px auto">
    		<table class="layui-table">
    			<tr>
    				<td>所属银行</td>
    				<td><?php echo ($bank["bank_name"]); ?></td>
    			</tr>
    			<tr>
    				<td>所属银行支行</td>
    				<td><?php echo ($bank["sub_branch"]); ?></td>
    			</tr>
    			<tr>
    				<td>银行卡姓名</td>
    				<td><?php echo ($bank["account_name"]); ?></td>
    			</tr>
    			<tr>
    				<td>银行卡账号</td>
    				<td><?php echo ($bank["account_bank"]); ?></td>
    			</tr>
    		</table>
    	</div>
    </div>
    <div style="text-align:center;width:80%;margin:0 auto" class="infotable">
		<table class="layui-table">
			<colgroup>
				<col width="100">
				<col width="200">
			</colgroup>
			<tr>
				<td>申请时间</td>
				<td><?php echo (date("Y-m-d H:i:s",$bank["addtime"])); ?></td>
			</tr> 
			<tr>
				<td>提现币种</td>
				<td><span style="color:red"><?php echo ($bank["icon"]); ?></span></td>
			</tr>
			<tr>
				<td>提现方式</td>
				<td><span style="color:red">银行卡</span></td>
			</tr>
			<tr>
				<td>申请数量</td>
				<td><?php echo ($bank["amount"]); ?></td>
			</tr>
			<tr>
				<td>需转账数量</td>
				<td><span style="color:red"><?php echo ($bank["money"]); ?></span></td>
			</tr>
			<tr>
				<td>状态</td>
				<td><?php echo ($bank["status"]); ?></td>
			</tr>
			<?php if($bank['status'] == 0): ?><tr>
				<td>提现备注</td>
				<td><textarea placeholder="请输入提现通过或拒绝的备注说明" name="remark" class="layui-textarea" style="width:100%"><?php echo ($bank["remark"]); ?></textarea></td>
			</tr>
			<?php else: ?>
			<tr>
				<td>提现备注</td>
				<td><?php echo ($bank["remark"]); ?></td>
			</tr><?php endif; ?>
			</tbody>
		</table>
	</div>
	<div style="text-align:center" class="btns"><button type="button" class="layui-btn" onclick="check()">确认转账</button> <button type="button" class="layui-btn layui-btn-danger" onclick="reject()">拒绝转账</button></div>
  </div>
</div>
<script>
	var id = <?php echo ($bank["id"]); ?>;
	if (<?php echo ($bank["status"]); ?> != 0){
		$(".btns").remove();
	}

	function check(){
		var remark = $("[name=remark]").val();
		if (remark == ""){
			layer.msg("请输入备注信息");
			return false;
		}
		layer.confirm("请确认收款信息有效且已成功转账。",function(){
			$.ajax({
				url: "/systemlogined/add/update_withdrawal",
				type: "POST",
				data: {isa:1,id:id,remark:remark},
				success: function(res){
					layer.closeAll();
					layer.msg(res.info,{time:1500},function(){
						if (res.status == 1){
							window.parent.location.reload();
						}
					})
				}
			})
		})
	}
	
	function reject(){
		var remark = $("[name=remark]").val();
		if (remark == ""){
			layer.msg("请输入备注信息");
			return false;
		}
		layer.confirm("请确认收款信息无效或存在违法信息，拒绝转账。",function(){
			$.ajax({
				url: "/systemlogined/add/update_withdrawal",
				type: "POST",
				data: {isa:0,id:id,remark:remark},
				success: function(res){
					layer.closeAll();
					layer.msg(res.msg,{time:1500},function(){
						if (res.success == 1){
							window.parent.location.reload();
						}
					})
				}
			})
		})
	}
	

</script>