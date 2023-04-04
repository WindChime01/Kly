<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html lang="en">	<head>		<meta charset="utf-8" />		<title>收款设置</title>		<meta name="description" content="Minimal empty page" />		<meta name="viewport" content="width=device-width, initial-scale=1.0" />		<!--basic styles-->		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />		<link href="__PUBLIC__/css/bootstrap-responsive.min.css" rel="stylesheet" />		<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />		<!--自定义样式-->		<link rel="stylesheet" href="__PUBLIC__/css/custom.css" />		<!--[if IE 7]>		  <link rel="stylesheet" href="__PUBLIC__/css/font-awesome-ie7.min.css" />		<![endif]-->		<!--page specific plugin styles-->		<!--bbc styles-->		<link rel="stylesheet" href="__PUBLIC__/css/bbc.min.css" />		<link rel="stylesheet" href="__PUBLIC__/css/bbc-responsive.min.css" />		<link rel="stylesheet" href="__PUBLIC__/css/bbc-skins.min.css" />		<!--[if lte IE 8]>		  <link rel="stylesheet" href="__PUBLIC__/css/bbc-ie.min.css" />		<![endif]-->	</head>	<body>		<!--导航-->		<div class="navbar navbar-inverse">			<div class="navbar-inner">				<div class="container-fluid">					<a href="#" class="brand">						<small>							<i class="icon-leaf"></i>							内部销售系统						</small>					</a><!--/.brand-->					<ul class="nav ace-nav pull-right">						<li class="light-blue user-profile">							<a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">								<img class="nav-user-photo" src="__PUBLIC__/avatars/avatar2.png"/>								<span id="user_info">									<small>管理员</small>									<?php echo (session('adminusername')); ?>								</span>								<i class="icon-caret-down"></i>							</a>							<ul class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer" id="user_menu">								<li>									<a href="<?php echo U(GROUP_NAME.'/Index/Logout');?>">										<i class="icon-off"></i>										安全退出									</a>								</li>							</ul>						</li>					</ul><!--/.ace-nav-->				</div><!--/.container-fluid-->			</div><!--/.navbar-inner-->		</div>                <style>#page_search input{ border:0px; background:#ccc;color:#ffffff; margin-left:5px;}#page_search .current{ background:#005580; color:#ffffff;}.page a{font-size:16px;}a.active{ color:#C30 !important; font-size:18px;}</style>                		<div class="container-fluid" id="main-container">			<a id="menu-toggler" href="#">				<span></span>			</a>			<!--边栏-->			<div id="sidebar">

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
	
</script>			<div id="main-content" class="clearfix">				<div id="breadcrumbs">					<ul class="breadcrumb">						<li>							<i class="icon-home"></i>							Home							<span class="divider">								<i class="icon-angle-right"></i>							</span>						</li>						<li>							收款设置							<span class="divider">								<i class="icon-angle-right"></i>							</span>						</li>					</ul><!--.breadcrumb-->				</div>				<div id="page-content" class="clearfix">					<div class="page-header position-relative">						<h1>							收款设置						</h1>					</div><!--/.page-header-->					<div class="row-fluid">						<!--PAGE CONTENT BEGINS HERE-->							<form name="editAnnounceType" class="form-horizontal"  action="<?php echo U(GROUP_NAME.'/Jinbidetail/address_post');?>" method="post">							<div class="control-group">									<label class="control-label" for="send_style"> 微信收款码：</label>									<div class="controls">										<div><img src="<?php echo ($address["wechat"]); ?>" id="wechatcode" style="width:150px"></div>										<input type="file" id="wechat" name="wechat" value="<?php echo ($address["wechat"]); ?>" style="display:none">										<div style="margin:5px"><button type="button" class="btn btn-info no-border" onclick="wechat_edit()">修改图片</button></div>									</div>							</div>							<div class="control-group">									<label class="control-label" for="send_style"> 支付宝收款码：</label>									<div class="controls">										<div><img src="<?php echo ($address["alipay"]); ?>" id="alipaycode" style="width:150px"></div>										<input type="file" id="alipay" name="alipay" value="<?php echo ($address["alipay"]); ?>" style="display:none">										<div style="margin:5px"><button type="button" class="btn btn-info no-border" onclick="alipay_edit()">修改图片</button></div>									</div>							</div>														<input type="hidden" name="isupload" value="0">														<div class="control-group">								<label class="control-label" for="password">支付宝账号：</label>								<div class="controls">									<input type="text" value="<?php echo ($address["alipay_name"]); ?>" name="alipay_name" id="alipay_name" placeholder="支付宝账号" autocomplete="off"/>								</div>							</div>														<div class="control-group">								<div style="display:inline-block">								<label class="control-label" for="password">银行卡号：</label>								<div class="controls">									<input type="text" value="<?php echo ($address["bank_num"]); ?>" name="bank_num" id="bank_num" placeholder="请输入银行卡号" oninput="bankinfo(this)" />								</div>								</div>																<div style="display:inline-block">								<label class="control-label" for="password">银行卡号2：</label>								<div class="controls">									<input type="text" value="<?php echo ($address["bank_num2"]); ?>" name="bank_num2" id="bank_num2" placeholder="请输入银行卡号" oninput="bankinfo2(this)" />								</div>								</div>							</div>														<div class="control-group">								<div style="display:inline-block">								<label class="control-label" for="password">所属银行：</label>								<div class="controls">									<input type="text" value="<?php echo ($address["bank"]); ?>" name="bank" id="bank" placeholder="所属银行" />								</div>								</div>																<div style="display:inline-block">								<label class="control-label" for="password">所属银行2：</label>								<div class="controls">									<input type="text" value="<?php echo ($address["bank2"]); ?>" name="bank2" id="bank2" placeholder="所属银行" />								</div>								</div>															</div>														<div class="control-group">								<div style="display:inline-block">								<label class="control-label" for="password">所属银行支行：</label>								<div class="controls">									<input type="text" value="<?php echo ($address["bank_branch"]); ?>" name="bank_branch" id="bank_branch" placeholder="所属银行支行" />								</div>								</div>																<div style="display:inline-block">								<label class="control-label" for="password">所属银行支行2：</label>								<div class="controls">									<input type="text" value="<?php echo ($address["bank_branch2"]); ?>" name="bank_branch2" id="bank_branch2" placeholder="所属银行支行" />								</div>								</div>															</div>														<div class="control-group">								<div style="display:inline-block">								<label class="control-label" for="password">银行卡姓名：</label>								<div class="controls">									<input type="text" value="<?php echo ($address["bank_name"]); ?>" name="bank_name" id="bank_name" placeholder="请输入姓名" />								</div>								</div>																<div style="display:inline-block">								<label class="control-label" for="password">银行卡姓名2：</label>								<div class="controls">									<input type="text" value="<?php echo ($address["bank_name2"]); ?>" name="bank_name2" id="bank_name2" placeholder="请输入姓名" />								</div>								</div>							</div>														<div class="control-group">									<label class="control-label" for="send_style"> USDT地址二维码：</label>									<div class="controls">										<div><img src="<?php echo ($address["usdt_paycode"]); ?>" id="usdtcode" style="width:150px"></div>										<input type="file" id="usdt" name="usdt" value="<?php echo ($address["usdt_paycode"]); ?>" style="display:none">										<div style="margin:5px"><button type="button" class="btn btn-info no-border" onclick="usdt_edit()">修改图片</button></div>									</div>							</div>														<input type="hidden" name="isupload" value="0">														<div class="control-group">								<label class="control-label" for="password">USDT地址：</label>								<div class="controls">									<input type="text" value="<?php echo ($address["usdt_address"]); ?>" name="usdt_address" id="usdt_address" placeholder="USDT地址（ERC20）" autocomplete="off"/>								</div>							</div>														<div class="control-group">								<label class="control-label" for="password">显示与隐藏：</label>								<div class="controls">									<label style="display:inline-block">										<input name="isshow[wechat]" type="checkbox" value="1" <?php if($address['isshow']['wechat'] == 1): ?>checked<?php endif; ?>>										<span class="lbl">微信收款码</span>									</label>									<label style="display:inline-block">										<input name="isshow[alipay]" type="checkbox" value="1" <?php if($address['isshow']['alipay'] == 1): ?>checked<?php endif; ?>>										<span class="lbl">支付宝收款码</span>									</label>									<label style="display:inline-block">										<input name="isshow[bank]" type="checkbox" value="1" <?php if($address['isshow']['bank'] == 1): ?>checked<?php endif; ?>>										<span class="lbl">银行卡1</span>									</label>									<label style="display:inline-block">										<input name="isshow[bank2]" type="checkbox" value="1" <?php if($address['isshow']['bank2'] == 1): ?>checked<?php endif; ?>>										<span class="lbl">银行卡2</span>									</label>									<label style="display:inline-block">										<input name="isshow[usdt]" type="checkbox" value="1" <?php if($address['isshow']['usdt'] == 1): ?>checked<?php endif; ?>>										<span class="lbl">USDT</span>									</label>								</div>							</div>																												<!--<div class="control-group">-->							<!--	<label class="control-label" for="password">USDT地址：</label>-->							<!--	<div class="controls">-->							<!--		<input type="text" value="<?php echo ($address["usdt_address"]); ?>" name="usdt_address" id="usdt_address" placeholder="请输入USDT地址" />-->							<!--	</div>-->							<!--</div>-->														<!--<div class="control-group">-->							<!--	<label class="control-label" for="password">USDT二维码：</label>-->							<!--	<div class="controls">-->							<!--		<div><img src="<?php echo ($address["usdt_paycode"]); ?>" id="usdtcode" style="width:150px"></div>-->							<!--			<input type="file" id="usdt" name="usdt_paycode" value="<?php echo ($address["usdt_paycode"]); ?>" style="display:none">-->							<!--			<div style="margin:5px"><button type="button" class="btn btn-info no-border" onclick="usdt_edit()">修改图片</button></div>-->							<!--	</div>-->							<!--</div>-->											<div class="form-actions">									<button class="btn btn-info no-border" type="submit">										<i class="icon-ok bigger-110"></i>										修改									</button>							</div>							</form>						<!--PAGE CONTENT ENDS HERE-->					</div><!--/row-->				</div><!--/#page-content-->				<!--/#ace-settings-container-->			</div><!--/#main-content-->		</div><!--/.fluid-container#main-container-->		<!--basic scripts-->		<script src="__PUBLIC__/js/jquery-1.9.1.min.js"></script>		<script src="/Public/ybt/js/bankcardinfo/index.js"></script>				<script>			function wechat_edit(){				$("#wechat").click();			}			function alipay_edit(){				$("#alipay").click();			}			function usdt_edit(){				$("#usdt").click();			}			$("#wechat").change(function(){				// console.log(this.files);				uploadpic("wechat")			})			$("#alipay").change(function(){				// console.log(this.files);				uploadpic("alipay")			})			$("#usdt").change(function(){				// console.log(this.files);				uploadpic("usdt")			})			function uploadpic(type){				var form = new FormData();				form.append("img",$("#"+type)[0].files[0]);				form.append("type",type);				// var file = this.files[0]				$.ajax({					url:"/Systemlogined/Jinbidetail/upload_address",					type:"post",					data:form,					async:false,					processData: false,                    contentType: false,                    success: function(res){                    	                    	$("#"+type+"code").attr("src",res.path);                    	$("[name=isupload]").val("1");                    }				})			}						function bankinfo(obj){				bank_num = obj.value;				var bankinfo = bankCardAttribution(bank_num);				if(bankinfo != "error"){					$("[name=bank]").val(bankinfo.bankName);				};			}						function bankinfo2(obj){				bank_num = obj.value;				var bankinfo = bankCardAttribution(bank_num);				if(bankinfo != "error"){					$("[name=bank2]").val(bankinfo.bankName);				};			}						// function getnewprice(bi){			// 	$.ajax({			// 		url: "/Systemlogined/Jinbidetail/getnewprice",			// 		data: {market:bi},			// 		type: 'GET',			// 		success: function(res1){			// 			if (bi == "btc"){			// 				$("#btc_ipfs").val(res1);			// 			}else if (bi == "ltc"){			// 				$("#ltc_ipfs").val(res1);			// 			}			// 		}			// 	})			// }		</script>		<!--page specific plugin scripts-->		<script src="__PUBLIC__/js/bootbox.min.js"></script>				<script src="__PUBLIC__/js/bootstrap.min.js"></script>				<!--bbc scripts-->		<script src="__PUBLIC__/js/jquery.validate.min.js"></script>		<!--bbc scripts-->		<script src="__PUBLIC__/js/bbc-elements.min.js"></script>		<script src="__PUBLIC__/js/bbc.min.js"></script>			</body></html>