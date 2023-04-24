<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="utf-8" />

		<title>签到奖励设置</title>



		<meta name="description" content="Minimal empty page" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />



		<!--basic styles-->



		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />

		<link href="__PUBLIC__/css/bootstrap-responsive.min.css" rel="stylesheet" />

		<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />

		<link rel="stylesheet" href="__PUBLIC__/kindeditor/themes/default/default.css" />

		<script charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor-min.js"></script>

		<script charset="utf-8" src="__PUBLIC__/kindeditor/lang/zh_CN.js"></script>



		<script type="text/javascript" src="__PUBLIC__/My97DatePicker/WdatePicker.js"></script>

		<!--自定义样式-->

		<link rel="stylesheet" href="__PUBLIC__/css/custom.css" />



		<!--[if IE 7]>

		  <link rel="stylesheet" href="__PUBLIC__/css/font-awesome-ie7.min.css" />

		<![endif]-->



		<!--page specific plugin styles-->



		<!--bbc styles-->



		<link rel="stylesheet" href="__PUBLIC__/css/bbc.min.css" />

		<link rel="stylesheet" href="__PUBLIC__/css/bbc-responsive.min.css" />

		<link rel="stylesheet" href="__PUBLIC__/css/bbc-skins.min.css" />



		<!--[if lte IE 8]>

		  <link rel="stylesheet" href="__PUBLIC__/css/bbc-ie.min.css" />

		<![endif]-->

	</head>



	<body>

		<!--导航-->

		<div class="navbar navbar-inverse">



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

							<a href="#">签到奖励设置</a>



							<span class="divider">

								<i class="icon-angle-right"></i>

							</span>

						</li>

					</ul><!--.breadcrumb-->

				</div>



				<div id="page-content" class="clearfix">

					<div class="page-header position-relative">

						<h1>

							签到奖励设置

						</h1>

					</div><!--/.page-header-->



					<div class="row-fluid">

						<!--PAGE CONTENT BEGINS HERE-->

							<form class="form-horizontal"  enctype="multipart/form-data"  method="post">

								<div class="control-group">

									<label class="control-label" for="reward1"> 1-3天奖励</label>



									<div class="controls">

										<input type="text" value=<?php echo ($reward1); ?> name="reward1" id="reward1" placeholder="" />

									</div>

								</div>

								<div class="control-group">

									<label class="control-label" for="reward2"> 4-6天奖励</label>



									<div class="controls">

										<input type="text" value=<?php echo ($reward2); ?> name="reward2" id="reward2" placeholder="" />

									</div>

								</div>

								<div class="control-group">

									<label class="control-label" for="reward3"> 7天及以后奖励</label>



									<div class="controls">

										<input type="text" value=<?php echo ($reward3); ?> name="reward3" id="reward3" placeholder="" />

									</div>

								</div>		


                                

              						

								<div class="form-actions">

									<button class="btn btn-info no-border" type="submit" >

										<i class="icon-ok bigger-110"></i>

										保存设置

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







		<script src="__PUBLIC__/js/jquery-1.9.1.min.js"></script>

		<!--page specific plugin scripts-->



		<script src="__PUBLIC__/js/bootbox.min.js"></script>

		

		<script src="__PUBLIC__/js/bootstrap.min.js"></script>

			

		<!--bbc scripts-->

		<script src="__PUBLIC__/Js/jquery.validate.min.js"></script>

		<!--自定义JS-->

											

		



		<script src="__PUBLIC__/js/bbc-elements.min.js"></script>

		<script src="__PUBLIC__/js/bbc.min.js"></script>



	</body>

</html>