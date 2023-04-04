<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html lang="en">	<head>		<meta charset="utf-8" />		<title>矿机购买申请列表</title>		<meta name="description" content="Static &amp; Dynamic Tables" />		<meta name="viewport" content="width=device-width, initial-scale=1.0" />		<!--basic styles-->		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />		<link href="__PUBLIC__/css/bootstrap-responsive.min.css" rel="stylesheet" />		<link href="__PUBLIC__/css/animate.min.css" rel="stylesheet" />		<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />		<!-- 分页样式 -->		<link rel="stylesheet" href="__PUBLIC__/css/page.css" />		<style type="text/css" title="currentStyle">			@import "__PUBLIC__/css/TableTools.css";		</style>		<!--[if IE 7]>		  <link rel="stylesheet" href="__PUBLIC__/css/font-awesome-ie7.min.css" />		<![endif]-->		<!--page specific plugin styles-->		<!--bbc styles-->		<link rel="stylesheet" href="__PUBLIC__/css/bbc.min.css" />		<link rel="stylesheet" href="__PUBLIC__/css/bbc-responsive.min.css" />		<link rel="stylesheet" href="__PUBLIC__/css/bbc-skins.min.css" />		<script src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>		<!--[if lte IE 8]>		  <link rel="stylesheet" href="__PUBLIC__/css/bbc-ie.min.css" />		<![endif]-->		<!--inline styles if any-->	</head>	<body>	<div class="shade"></div>    <style>	input[type="checkbox"].allcheckbox{ opacity:1; position:relative;}		.imagecenter{		display: none;		z-index:100;		position: fixed;		top: 50%;		left: 50%;		transform: translate(-50%,-50%);		width: 400px;	}		.shade{		display: none;		z-index:98;		position: absolute;		background:rgba(0,0,0,0.2);		width: 100%;		height: 100%;	}	</style>        		<!--导航-->		<div class="navbar navbar-inverse">			<div class="navbar-inner">				<div class="container-fluid">					<a href="#" class="brand">						<small>							<i class="icon-leaf"></i>							内部销售系统						</small>					</a><!--/.brand-->					<ul class="nav ace-nav pull-right">						<li class="light-blue user-profile">							<a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">								<img class="nav-user-photo" src="__PUBLIC__/avatars/avatar2.png"/>								<span id="user_info">									<small>管理员</small>									<?php echo (session('adminusername')); ?>								</span>								<i class="icon-caret-down"></i>							</a>							<ul class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer" id="user_menu">								<li>									<a href="<?php echo U(GROUP_NAME.'/Index/Logout');?>">										<i class="icon-off"></i>										安全退出									</a>								</li>							</ul>						</li>					</ul><!--/.ace-nav-->				</div><!--/.container-fluid-->			</div><!--/.navbar-inner-->		</div>                <style>#page_search input{ border:0px; background:#ccc;color:#ffffff; margin-left:5px;}#page_search .current{ background:#005580; color:#ffffff;}.page a{font-size:16px;}a.active{ color:#C30 !important; font-size:18px;}</style>                		<div class="container-fluid" id="main-container">			<a id="menu-toggler" href="#">				<span></span>			</a>			<!--边栏-->			<div id="sidebar">

				<div id="sidebar-shortcuts">

				

					<div id="sidebar-shortcuts-mini">

						<span class="btn btn-success"></span>



						<span class="btn btn-info"></span>



						<span class="btn btn-warning"></span>



						<span class="btn btn-danger"></span>

					</div>

				</div><!--#sidebar-shortcuts-->



				<ul class="nav nav-list">

					<?php if(is_array($nodes["child"])): foreach($nodes["child"] as $key=>$action): ?><li <?php if(MODULE_NAME == $action['name']): ?>class="open"<?php endif; ?> >
					<a href="#" class="dropdown-toggle">

							<i class="icons <?php if($action['icon']): echo ($action['icon']); else: ?>icon-random<?php endif; ?>"></i>

							<span><?php echo ($action["title"]); ?></span>

							<b class="arrow icon-angle-down"></b>

						</a>
					<ul class="submenu" <?php if(MODULE_NAME == $action['name']): ?>style="display: block;"<?php endif; ?>>
					<?php if(is_array($action["child"])): foreach($action["child"] as $key=>$vv): ?><li >

						<a href="<?php echo U($action['name']."/".$vv['name']);?>">

							<i class="icon-double-angle-right"></i>

							<?php echo ($vv["title"]); ?>

						</a>

					</li><?php endforeach; endif; ?>
					</ul><?php endforeach; endif; ?>
					

				</ul><!--/.nav-list-->



				<div id="sidebar-collapse">

					<i class="icon-double-angle-left"></i>

				</div>

			</div>



<script type="text/javascript">

	window.jQuery || document.write("<script src='__PUBLIC__/js/jquery-1.9.1.min.js'>"+"<"+"/script>");

</script>
<script src="__PUBLIC__/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">

	$(function() {

		var method = '<?php echo ($_SERVER['PATH_INFO']); ?>';

		var middle = method.split('/')[2];

		var end = method.split('/')[3];



		$('li[sid*='+ middle + end +']').addClass("active open");

		$('li[url*='+ middle + end +']').addClass("active");

	});

	function intoApply($id) {
		$('#apply_item').val($id);
		$('#apply_way').attr('action','/systemlogined/gift/applys');
		$('#apply_way').submit();
	}
	
</script>			<div id="main-content" class="clearfix">				<div id="breadcrumbs">					<ul class="breadcrumb">						<li>							<i class="icon-home"></i>							Home							<span class="divider">								<i class="icon-angle-right"></i>							</span>						</li>						<li class="active">矿机购买申请列表</li>					</ul><!--.breadcrumb-->				</div>								<div id="page-content" class="clearfix">					<div class="row-fluid">						<!--PAGE CONTENT BEGINS HERE-->						<form id="table-searchbar" method="GET" class="form-inline well well-small">							<div class="row-fluid">&nbsp;&nbsp;<select class="span3" name="type" style="width: 100px;">									<option value="1" <?php if($_GET['type'] == 1): ?>selected="selected"<?php endif; ?>>用户ID</option>									<option value="2" <?php if($_GET['type'] == 2): ?>selected="selected"<?php endif; ?>>会员账号</option>								</select>				                <input type="text" class="input-small" name="typename" value="<?php echo $_GET['typename'];?>">    		                        &nbsp;		                        		                        开始时间&nbsp;<input type="date" class="input-small" name="start_time" value="<?php echo ($_GET['start_time']); ?>" style="width:110px">    		                        &nbsp;		                        		                        结束时间&nbsp;<input type="date" class="input-small" name="end_time" value="<?php echo ($_GET['end_time']); ?>" style="width:110px">    		                        &nbsp;								<button type="submit" class="btn btn-small no-border" id="btn-query" type="button"><i class="icon-search"></i>查询</button>							<!--	&nbsp;&nbsp;								<button type="button"  onclick="return clear1()" class="btn btn-success btn-small no-border" id="btn-compute" type="button">导出会员报表</button>	-->							</div>						</form>							<table id="table_report" class="table table-striped table-bordered table-hover">								<thead>									<tr>										<th>序号</th>										<th>用户名</th>										<th>矿机编号</th>																				<th>矿机名称</th>																				<th>价格(￥)</th>										<th>付款时间</th>																				<th>交易截图</th>										<th>状态</th>                                        <th>操作</th>									</tr>								</thead>								<tbody>									<?php if(is_array($order_list)): foreach($order_list as $key=>$v): ?><tr>											<td><?php echo ($v["id"]); ?></td>											<td><a href="<?php echo U('',array('typename'=>$v['username'],'type'=>2));?>"><?php echo ($v["user_id"]); ?>-<?php echo ($v["truename"]); ?>-<?php echo ($v["username"]); ?></a></td>											<td><?php echo ($v["kjid"]); ?></td>											<td><?php echo ($v["kjname"]); ?></td>											<td><?php echo number_format($v['price'],2);?></td>																						<td><?php echo (date("Y-m-d H:i:s",$v["addtime"])); ?></td>																						<td><a href="javascript:;" onclick="showimg('<?php echo ($v["upimg"]); ?>')"><img src="<?php echo ($v["upimg"]); ?>"  style="width:40px;"/></a></td>											<td>												<?php if($v["status"] == 0): ?><font color="red">待审核</font>													<?php elseif($v["status"] == 1): ?>													<font color="#4169e1">已通过</font>																										<?php elseif($v["status"] == 2): ?>													<font color="red">已拒绝</font>																										<?php elseif($v["status"] == 4): ?>													<font color="red">申诉中</font>																										<?php elseif($v["status"] == 5): ?>													<font color="#4169e1">已处理申诉</font><?php endif; ?>											</td>											<td>												<?php if($v["status"] == 0): ?><a href="javascript:;" onclick="adopt(<?php echo ($v["id"]); ?>,<?php echo round($v['price'],2);?>)">通过</a> |												<a href="javascript:;" onclick="reject(<?php echo ($v["id"]); ?>)">拒绝</a>																								<?php elseif($v['status'] == 4): ?>												<p>申诉内容：</p>												<p><?php echo ($v['shensu']); ?></p>												<a href="javascript:;" onclick="solve(<?php echo ($v["id"]); ?>)">确认处理</a><?php endif; ?>											</td>										</tr><?php endforeach; endif; ?>									<tr>										<td colspan="18" style="text-align:center;"><div class="page"><?php echo ($page); ?></div></td>									</tr>								</tbody>							</table>							                         </form>   						</div>						<!--PAGE CONTENT ENDS HERE-->					</div><!--/row-->				</div><!--/#page-content-->			</div><!--/#main-content-->		</div><!--/.fluid-container#main-container-->				<div class="imagecenter">			<img src="" style="width:100%">		</div>		<a href="#" id="btn-scroll-up" class="btn btn-small btn-inverse">			<i class="icon-double-angle-up icon-only bigger-110"></i>		</a>		<!--basic scripts-->		<script src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.min.js"></script>				<script src="/Public/ybt/js/layer/layer.js"></script>		<script src="__PUBLIC__/js/bootstrap.min.js"></script>		<!--page specific plugin scripts-->		<script src="__PUBLIC__/js/bootbox.min.js"></script>		<script src="__PUBLIC__/js/jquery.dataTables.min.js"></script>		<script src="__PUBLIC__/js/jquery.dataTables.bootstrap.js"></script>		<script src="__PUBLIC__/js/TableTools.min.js"></script>		<!--bbc scripts-->		<script src="__PUBLIC__/js/bbc-elements.min.js"></script>		<script src="__PUBLIC__/js/bbc.min.js"></script>		<script src="__PUBLIC__/js/bootstrap.notification.js"></script>		<script src="__PUBLIC__/js/jquery.easing.1.3.js"></script>		<script type="text/javascript">		function adopt(id,num){			var con = "请确认是否已收到款：￥" + num.toFixed(2);			if (confirm(con)){				$.ajax({					url: "/systemlogined/shop/adopt_order",					type: "POST",					async: false,					data: {isa:1,id:id},					success: function(res){						alert(res.info);						window.location.reload();					}				})			}		}				function reject(id){			if (confirm("请确认该购买记录存在问题，且未收到款项。")){				$.ajax({					url: "/systemlogined/shop/adopt_order",					type: "POST",					async: false,					data: {isa:0,id:id},					success: function(res){						alert(res.info);						window.location.reload();					}				})			}		}				function solve(id){			if (confirm("请确认已处理该申诉。")){				$.ajax({					url: "/systemlogined/shop/adopt_order",					type: "POST",					async: false,					data: {isa:5,id:id},					success: function(res){						alert(res.info);						window.location.reload();					}				})			}		}				function showimg(img){			$(".imagecenter").find("img").attr("src",img);			$(".imagecenter").fadeIn('fast');			$(".shade").fadeIn("fast");		}				$(".imagecenter").click(function(){			$(".imagecenter").fadeOut('fast');			$(".shade").fadeOut("fast");		})				$(".shade").click(function(){			$(".imagecenter").fadeOut('fast');			$(".shade").fadeOut("fast");		})		</script>				<!--inline scripts related to this page-->	</body></html>