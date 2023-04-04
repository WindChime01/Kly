<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html lang="en">	<head>		<meta charset="utf-8" />		<title>会员矿机列表</title>		<meta name="description" content="Static &amp; Dynamic Tables" />		<meta name="viewport" content="width=device-width, initial-scale=1.0" />		<!--basic styles-->		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />		<link href="__PUBLIC__/css/bootstrap-responsive.min.css" rel="stylesheet" />		<link href="__PUBLIC__/css/animate.min.css" rel="stylesheet" />		<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />		<!-- 分页样式 -->		<link rel="stylesheet" href="__PUBLIC__/css/page.css" />		<style type="text/css" title="currentStyle">			@import "__PUBLIC__/css/TableTools.css";		</style>		<!--[if IE 7]>		  <link rel="stylesheet" href="__PUBLIC__/css/font-awesome-ie7.min.css" />		<![endif]-->		<!--page specific plugin styles-->		<!--bbc styles-->		<link rel="stylesheet" href="__PUBLIC__/css/bbc.min.css" />		<link rel="stylesheet" href="__PUBLIC__/css/bbc-responsive.min.css" />		<link rel="stylesheet" href="__PUBLIC__/css/bbc-skins.min.css" />		<script src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>		<!--[if lte IE 8]>		  <link rel="stylesheet" href="__PUBLIC__/css/bbc-ie.min.css" />		<![endif]-->		<!--inline styles if any-->	</head>	<body>		<!--导航-->		<div class="navbar navbar-inverse">			<div class="navbar-inner">				<div class="container-fluid">					<a href="#" class="brand">						<small>							<i class="icon-leaf"></i>							内部销售系统						</small>					</a><!--/.brand-->					<ul class="nav ace-nav pull-right">						<li class="light-blue user-profile">							<a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">								<img class="nav-user-photo" src="__PUBLIC__/avatars/avatar2.png"/>								<span id="user_info">									<small>管理员</small>									<?php echo (session('adminusername')); ?>								</span>								<i class="icon-caret-down"></i>							</a>							<ul class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer" id="user_menu">								<li>									<a href="<?php echo U(GROUP_NAME.'/Index/Logout');?>">										<i class="icon-off"></i>										安全退出									</a>								</li>							</ul>						</li>					</ul><!--/.ace-nav-->				</div><!--/.container-fluid-->			</div><!--/.navbar-inner-->		</div>                <style>#page_search input{ border:0px; background:#ccc;color:#ffffff; margin-left:5px;}#page_search .current{ background:#005580; color:#ffffff;}.page a{font-size:16px;}a.active{ color:#C30 !important; font-size:18px;}</style>                		<div class="container-fluid" id="main-container">			<a id="menu-toggler" href="#">				<span></span>			</a>			<!--边栏-->			<div id="sidebar">

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
	
</script>			<div id="main-content" class="clearfix">				<div id="breadcrumbs">					<ul class="breadcrumb">						<li>							<i class="icon-home"></i>							Home							<span class="divider">								<i class="icon-angle-right"></i>							</span>						</li>						<li class="active">会员矿机列表</li>					</ul><!--.breadcrumb-->				</div>				<div id="page-content" class="clearfix">                       					<div class="row-fluid">						<form id="table-searchbar" method="POST" class="form-inline well well-small">                            <div class="row-fluid" style="margin-bottom: 20px">&nbsp;&nbsp;                                <select class="span3" name="type" style="width: 100px;">                                    <option value="1" <?php if($type == 1): ?>selected="selected"<?php endif; ?> >ID</option>                                    <option value="2" <?php if($type == 2): ?>selected="selected"<?php endif; ?> >账号</option>                                </select>                                &nbsp;&nbsp;                                <input type="text" class="input-small" name="typename" value="<?php echo $_POST['typename'];?>">                                    &nbsp;&nbsp;开始日期                                <input type="date" value="<?php echo $_POST['start_time'];?>"class="input-small" name="start_time" style="width:120px">                                &nbsp;&nbsp;截止日期                                <input type="date" value="<?php echo $_POST['end_time'];?>" class="input-small" name="end_time" style="width:120px">                                                        &nbsp;&nbsp;                                <button type="submit" class="btn btn-small no-border" id="btn-query" type="button"><i class="icon-search"></i>查询</button>                                                                <button type="button" onclick="return clear1()" class="btn btn-small no-border btn-info">导出所有已购矿机</button>                            </div>                        </form>						<div class="row-fluid">							<table id="table_report" class="table table-striped table-bordered table-hover">								<thead>									<tr>								                                            <th>ID</th>								            <th>会员ID</th>								            <th>会员名称</th>								            <!--<th>账号</th>-->											<th>商品名称</th>                                            <!--<th>已发放收益</th>-->                                            <th>购买价格</th>																						<th>购买方式</th>																						<th>有效期</th>											                                            <th>状态</th>                                            											<th>雇佣时间</th>									</tr>								</thead>								<tbody>                                    <?php if(is_array($orders)): foreach($orders as $key=>$v): ?><tbody> 										<tr>										<td><?php echo ($v["id"]); ?></td>										<td><?php echo ($v["user_id"]); ?></td>									    <td><?php echo ($v["truename"]); ?></td>                                        <td><?php echo ($v["goods_name"]); ?></td>                                        <!--<td><?php echo ($v["count"]); ?>小时</td>-->                                        <td>￥ <?php echo ($v["amount"]); ?></td>									    <td><?php echo ($v["coin"]); ?></td>									    <td><?php echo ($v["hire_day"]); ?>天</td>										<!--<td class="hidden-480"><?php if($v['expiry_time'] == 0): else: echo (date('Y-m-d H:i:s',$v["expiry_time"])); endif; ?></td>-->										<td><?php if($v['status'] == 0): ?>进行中										<?php elseif($v['status'] == 1): ?>已完成										<?php elseif($v['status'] == 2): ?>已取消										<?php else: ?>已到期<?php endif; ?>														</td>										<td>											<?php if($v['createtime'] == NULL): else: echo (date("Y-m-d H:i",$v["createtime"])); endif; ?>										</td>                                                                                   </tr><?php endforeach; endif; ?>									<tr>										<td colspan="11" style="text-align:center;"><div class="page"><?php echo ($page); ?></div></td>									</tr>								</tbody>							</table>						</div>						<!--PAGE CONTENT ENDS HERE-->					</div><!--/row-->				</div><!--/#page-content-->			</div><!--/#main-content-->		</div><!--/.fluid-container#main-container-->		<a href="#" id="btn-scroll-up" class="btn btn-small btn-inverse">			<i class="icon-double-angle-up icon-only bigger-110"></i>		</a>		<!--basic scripts-->		<script src="__PUBLIC__/js/jquery-1.9.1.min.js"></script>		<script src="__PUBLIC__/js/bootstrap.min.js"></script>		<!--page specific plugin scripts-->		<script src="__PUBLIC__/js/bootbox.min.js"></script>		<script src="__PUBLIC__/js/jquery.dataTables.min.js"></script>		<script src="__PUBLIC__/js/jquery.dataTables.bootstrap.js"></script>		<script src="__PUBLIC__/js/TableTools.min.js"></script>		<!--bbc scripts-->		<script src="__PUBLIC__/js/bbc-elements.min.js"></script>		<script src="__PUBLIC__/js/bbc.min.js"></script>		<script src="__PUBLIC__/js/bootstrap.notification.js"></script>		<script src="__PUBLIC__/js/jquery.easing.1.3.js"></script>		<!--inline scripts related to this page-->		<script type="text/javascript">			function clear1(){			    if(confirm("确认要导出全部已购矿机吗?")){			        $('#table-searchbar').attr('action',"<?php echo U(GROUP_NAME .'/shop/excelorder');?>").submit();			        $('#table-searchbar').removeAttr('action');			    }			}		</script>	</body></html>