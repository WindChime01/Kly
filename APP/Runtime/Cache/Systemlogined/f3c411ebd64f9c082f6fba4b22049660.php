<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="utf-8" />

		<title>编辑角色</title>



		<meta name="description" content="Minimal empty page" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />



		<!--basic styles-->



		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />

		<link href="__PUBLIC__/css/bootstrap-responsive.min.css" rel="stylesheet" />

		<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />



		<!--[if IE 7]>

		  <link rel="stylesheet" href="__PUBLIC__/css/font-awesome-ie7.min.css" />

		<![endif]-->



		<!--page specific plugin styles-->





		<!--bbc styles-->



		<link rel="stylesheet" href="__PUBLIC__/css/bbc.min.css" />

		<link rel="stylesheet" href="__PUBLIC__/css/bbc-responsive.min.css" />

		<link rel="stylesheet" href="__PUBLIC__/css/bbc-skins.min.css" />

		<style type="text/css">
			.table label{
				display: inline-block;
				margin: 0 10px 0 0;
				width:100px;
			}
		</style>

		<!--[if lte IE 8]>

		  <link rel="stylesheet" href="__PUBLIC__/css/bbc-ie.min.css" />

		<![endif]-->

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

							<a href="#">Home</a>



							<span class="divider">

								<i class="icon-angle-right"></i>

							</span>

						</li>



						<li>

							<a href="#">权限管理</a>



							<span class="divider">

								<i class="icon-angle-right"></i>

							</span>

						</li>

					</ul><!--.breadcrumb-->

				</div>



				<div id="page-content" class="clearfix">

					<div class="page-header position-relative">

						<h1>

							编辑角色

						</h1>

					</div><!--/.page-header-->



					<div class="row-fluid">

						<!--PAGE CONTENT BEGINS HERE-->

							<form class="form-horizontal"  action="<?php echo U(GROUP_NAME .'/Rbac/editRoleHandle');?>" method="post">

								<div class="control-group">

									<label class="control-label" for="name"> 角色名称</label>



									<div class="controls">

										<input type="text" value="<?php echo ($role["name"]); ?>" name="name" id="name" placeholder="" />

									</div>

								</div>

								<div class="control-group">

									<label class="control-label" for="remark">

									角色描述</label>

									<div class="controls">

										<input type="text" value="<?php echo ($role["remark"]); ?>" name="remark" id="remark" placeholder="" />

									</div>

								</div>				

								<div class="control-group">

									<label class="control-label">是否开启</label>

									<div class="controls">

										<input type="radio" name="status" value="1" <?php if($role["status"] == 1): ?>checked="checked"<?php endif; ?>>

										<span class="lbl"> 启用</span>

										<input type="radio" <?php if($role["status"] == 0): ?>checked="checked"<?php endif; ?> name="status" value="0">

										<span class="lbl"> 关闭</span>

									</div>

								</div>

								<div>
									<table class="table table-striped table-bordered table-hover">
										<tr>
											<th>管理列表</th>
											<th>管理菜单</th>
										</tr>
										<?php ?>
										<?php if(is_array($nodess)): foreach($nodess as $key=>$n): ?><tr>
											<td><label><input type="checkbox" name="<?php echo ($n["name"]); ?>" value="1"><span class="lbl"><?php echo ($n["title"]); ?></span></label></td>
											<td>
											<?php if(is_array($n["children"])): foreach($n["children"] as $key=>$va): ?><label><input type="checkbox" class="<?php echo ($n["name"]); ?>" name="<?php echo ($n["name"]); ?>[<?php echo ($va["name"]); ?>]" value="1" <?php if($role['auth'][$n['name']][$va['name']] == 1): ?>checked="checked"<?php endif; ?>><span class="lbl"><?php echo ($va["title"]); ?></span></label><?php endforeach; endif; ?>
											</td>
										</tr><?php endforeach; endif; ?>
										
									</table>
								</div>

								<input type="hidden" name="rid" value="<?php echo ($role["id"]); ?>" />

								<div class="form-actions">

									<button class="btn btn-info no-border" type="button" onclick="submit_()">

										<i class="icon-ok bigger-110"></i>

										保存

									</button>

								</div>



							</form>

						<!--PAGE CONTENT ENDS HERE-->

					</div><!--/row-->



				</div><!--/#page-content-->

				

				<div id="ace-settings-container">

					<div class="btn btn-app btn-mini btn-warning" id="ace-settings-btn">

						<i class="icon-cog"></i>

					</div>



					<div id="ace-settings-box">

						<div>

							<div class="pull-left">

								<select id="skin-colorpicker" class="hidden">

									<option data-class="default" value="#438EB9">#438EB9</option>

									<option data-class="skin-1" value="#222A2D">#222A2D</option>

									<option data-class="skin-2" value="#C6487E">#C6487E</option>

									<option data-class="skin-3" value="#D0D0D0">#D0D0D0</option>

								</select>

							</div>

							<span>&nbsp; 选择样式</span>

						</div>



						<div>

							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />

							<label class="lbl" for="ace-settings-header"> Fixed Header</label>

						</div>



						<div>

							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />

							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>

						</div>

					</div>

				</div><!--/#ace-settings-container-->

			</div><!--/#main-content-->

		</div><!--/.fluid-container#main-container-->



		<!--basic scripts-->

		<script type="text/javascript">

			window.jQuery || document.write("<script src='__PUBLIC__/js/jquery-1.9.1.min.js'>"+"<"+"/script>");

		</script>

		<!--page specific plugin scripts-->



		<script src="__PUBLIC__/js/bootbox.min.js"></script>

		

		<script src="__PUBLIC__/js/bootstrap.min.js"></script>

			

		<!--bbc scripts-->



		<script src="__PUBLIC__/js/bbc-elements.min.js"></script>

		<script src="__PUBLIC__/js/bbc.min.js"></script>

		<script type="text/javascript">

		<?php if(is_array($nodess)): foreach($nodess as $key=>$n): ?>$(".<?php echo ($n["name"]); ?>").each(function(index, el) {
				if (el.checked == true) {
					$("[name=<?php echo ($n["name"]); ?>]")[0].checked = true;
				}
			});
			$(".<?php echo ($n["name"]); ?>").change(function(event) {
				var all = 0;
				$(".<?php echo ($n["name"]); ?>").each(function(index, el) {
					if (el.checked == 1) {
						all = 1;
						return false;
					}
				});
				if (all = 0) {
					$("[name=<?php echo ($n["name"]); ?>]")[0].checked = false;
				}
				console.log(all);
			});
			$("[name=<?php echo ($n["name"]); ?>]").change(function(event) {
				if (this.checked == true) {
					$(".<?php echo ($n["name"]); ?>").each(function(index, el) {
						el.checked = true;
					});
				}else if (this.checked == false) {
					$(".<?php echo ($n["name"]); ?>").each(function(index, el) {
						el.checked = false;
					});
				}
			});<?php endforeach; endif; ?>
		///
			
		function submit_(){
			$("[type=checkbox]").each(function(index, el) {
				if (el.checked == false) {
					el.value = 0;
					el.checked = true;
				}
			});
			$("form").submit();
		}
		</script>
	
	</body>

</html>