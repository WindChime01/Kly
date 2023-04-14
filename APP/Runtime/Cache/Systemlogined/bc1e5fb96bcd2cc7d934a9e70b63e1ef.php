<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="utf-8" />

		<title>加权平均等级管理</title>



		<meta name="description" content="Static &amp; Dynamic Tables" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />



		<!--basic styles-->



		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />

		<link href="__PUBLIC__/css/bootstrap-responsive.min.css" rel="stylesheet" />

		<link href="__PUBLIC__/css/animate.min.css" rel="stylesheet" />

		<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />

		<!-- 分页样式 -->

		<link rel="stylesheet" href="__PUBLIC__/css/page.css" />



		<style type="text/css" title="currentStyle">

			@import "__PUBLIC__/css/TableTools.css";

		</style>



		<!--[if IE 7]>

		  <link rel="stylesheet" href="__PUBLIC__/css/font-awesome-ie7.min.css" />

		<![endif]-->



		<!--page specific plugin styles-->



		<!--bbc styles-->



		<link rel="stylesheet" href="__PUBLIC__/css/bbc.min.css" />

		<link rel="stylesheet" href="__PUBLIC__/css/bbc-responsive.min.css" />

		<link rel="stylesheet" href="__PUBLIC__/css/bbc-skins.min.css" />

		<script src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>

		<!--[if lte IE 8]>

		  <link rel="stylesheet" href="__PUBLIC__/css/bbc-ie.min.css" />

		<![endif]-->



		<!--inline styles if any-->

	</head>



	<body>

		<!--导航-->

		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							<i class="icon-leaf"></i>
							内部销售系统
						</small>
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">




						<li class="light-blue user-profile">
							<a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
								<img class="nav-user-photo" src="__PUBLIC__/avatars/avatar2.png"/>
								<span id="user_info">
									<small>管理员</small>
									<?php echo (session('adminusername')); ?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer" id="user_menu">
								<li>
									<a href="<?php echo U(GROUP_NAME.'/Index/Logout');?>">
										<i class="icon-off"></i>
										安全退出
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>
        
        
<style>
#page_search input{ border:0px; background:#ccc;color:#ffffff; margin-left:5px;}
#page_search .current{ background:#005580; color:#ffffff;}
.page a{font-size:16px;}
a.active{ color:#C30 !important; font-size:18px;}

</style>        
        



		<div class="container-fluid" id="main-container">

			<a id="menu-toggler" href="#">

				<span></span>

			</a>



			<!--边栏-->

			<div id="sidebar">

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
	
</script>



			<div id="main-content" class="clearfix">

				<div id="breadcrumbs">

					<ul class="breadcrumb">

						<li>

							<i class="icon-home"></i>

							Home



							<span class="divider">

								<i class="icon-angle-right"></i>

							</span>

						</li>

						<li class="active">加权平均等级列表</li>

					</ul><!--.breadcrumb-->

				</div>



				<div id="page-content" class="clearfix">

                       <div class="page-header position-relative">

						   <div style="text-align:left;width:100%;">

						    <a type="button" href="<?php echo U(GROUP_NAME.'/LevelReward/add_level_reward_set');?>" class="btn btn-info btn-small no-border"> <i class="icon-plus icon-white"></i>添加节点代币奖励</a>

						    </div>

					   </div>

					<div class="row-fluid">

			



						<div class="row-fluid">

							<table id="table_report" class="table table-striped table-bordered table-hover">

								<thead>

									<tr>

										<th>编号</th>

										<th>等级名称</th>
							
										<th>购买T数</th>

										<th>Fil币奖励比例</th>

										<th>操作</th>

									</tr>

								</thead>

								<tbody>

									<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>

										    <td><?php echo ($v["id"]); ?></td>

                                            <td><?php echo ($v["level_name"]); ?></td>

											<td><?php echo ($v["condition"]); ?></td>
											
											<td><?php echo ($v["rate"]); ?>%</td>

											<td class="hidden-480">	
												<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

													<a class="green" href="<?php echo U(GROUP_NAME .'/LevelReward/edit_level_reward_set',array('id'=>$v['id']));?>">

														<i class="icon-pencil bigger-130">修改</i>

													</a>
    
													<a class="red" onclick="return confirm('你确定要删除吗')" href="<?php echo U(GROUP_NAME .'/LevelReward/del_level_reward_set',array('id'=>$v['id']));?>">

														<i class="icon-trash bigger-130">删除</i>

													</a>

																
												</div>

                                            </td>

										</tr><?php endforeach; endif; ?>

									<tr>

										<td colspan="15" style="text-align:center;"><div class="page"><?php echo ($page); ?></div></td>

									</tr>

								</tbody>

							</table>

						</div>

						<!--PAGE CONTENT ENDS HERE-->

					</div><!--/row-->

				</div><!--/#page-content-->

			</div><!--/#main-content-->

		</div><!--/.fluid-container#main-container-->



		<a href="#" id="btn-scroll-up" class="btn btn-small btn-inverse">

			<i class="icon-double-angle-up icon-only bigger-110"></i>

		</a>



		<!--basic scripts-->

		<script src="__PUBLIC__/js/jquery-1.9.1.min.js"></script>



		<script src="__PUBLIC__/js/bootstrap.min.js"></script>



		<!--page specific plugin scripts-->

		<script src="__PUBLIC__/js/bootbox.min.js"></script>

		<script src="__PUBLIC__/js/jquery.dataTables.min.js"></script>

		<script src="__PUBLIC__/js/jquery.dataTables.bootstrap.js"></script>

		<script src="__PUBLIC__/js/TableTools.min.js"></script>

		<!--bbc scripts-->



		<script src="__PUBLIC__/js/bbc-elements.min.js"></script>

		<script src="__PUBLIC__/js/bbc.min.js"></script>



		<script src="__PUBLIC__/js/bootstrap.notification.js"></script>

		<script src="__PUBLIC__/js/jquery.easing.1.3.js"></script>

		<!--inline scripts related to this page-->

	</body>

</html>