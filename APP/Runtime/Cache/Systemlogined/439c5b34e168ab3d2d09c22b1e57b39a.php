<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html lang="en">	<head>		<meta charset="utf-8" />		<title>会员列表</title>		<meta name="description" content="Static &amp; Dynamic Tables" />		<meta name="viewport" content="width=device-width, initial-scale=1.0" />		<!--basic styles-->		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />		<link href="__PUBLIC__/css/bootstrap-responsive.min.css" rel="stylesheet" />		<link href="__PUBLIC__/css/animate.min.css" rel="stylesheet" />		<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />		<!-- 分页样式 -->		<link rel="stylesheet" href="__PUBLIC__/css/page.css" />		<style type="text/css" title="currentStyle">			@import "__PUBLIC__/css/TableTools.css";		</style>		<!--[if IE 7]>		  <link rel="stylesheet" href="__PUBLIC__/css/font-awesome-ie7.min.css" />		<![endif]-->		<!--page specific plugin styles-->		<!--bbc styles-->		<link rel="stylesheet" href="__PUBLIC__/css/bbc.min.css" />		<link rel="stylesheet" href="__PUBLIC__/css/bbc-responsive.min.css" />		<link rel="stylesheet" href="__PUBLIC__/css/bbc-skins.min.css" />		<script src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>		<!--[if lte IE 8]>		  <link rel="stylesheet" href="__PUBLIC__/css/bbc-ie.min.css" />		<![endif]-->		<!--inline styles if any-->	</head>	<body>    <style>	input[type="checkbox"].allcheckbox{ opacity:1; position:relative;}	</style>        		<!--导航-->		<div class="navbar navbar-inverse">			<div class="navbar-inner">				<div class="container-fluid">					<a href="#" class="brand">						<small>							<i class="icon-leaf"></i>							内部销售系统						</small>					</a><!--/.brand-->					<ul class="nav ace-nav pull-right">						<li class="light-blue user-profile">							<a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">								<img class="nav-user-photo" src="__PUBLIC__/avatars/avatar2.png"/>								<span id="user_info">									<small>管理员</small>									<?php echo (session('adminusername')); ?>								</span>								<i class="icon-caret-down"></i>							</a>							<ul class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer" id="user_menu">								<li>									<a href="<?php echo U(GROUP_NAME.'/Index/Logout');?>">										<i class="icon-off"></i>										安全退出									</a>								</li>							</ul>						</li>					</ul><!--/.ace-nav-->				</div><!--/.container-fluid-->			</div><!--/.navbar-inner-->		</div>                <style>#page_search input{ border:0px; background:#ccc;color:#ffffff; margin-left:5px;}#page_search .current{ background:#005580; color:#ffffff;}.page a{font-size:16px;}a.active{ color:#C30 !important; font-size:18px;}</style>                		<div class="container-fluid" id="main-container">			<a id="menu-toggler" href="#">				<span></span>			</a>			<!--边栏-->			<div id="sidebar">

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
	
</script>			<div id="main-content" class="clearfix">				<div id="breadcrumbs">					<ul class="breadcrumb">						<li>							<i class="icon-home"></i>							Home							<span class="divider">								<i class="icon-angle-right"></i>							</span>						</li>						<li class="active">会员管理</li>					</ul><!--.breadcrumb-->				</div>				<div id="page-content" class="clearfix">					<div class="row-fluid">						<!--PAGE CONTENT BEGINS HERE-->						<form id="table-searchbar" method="POST" class="form-inline well well-small">							<div class="row-fluid">&nbsp;&nbsp;<select class="span3" name="type" style="width: 100px;">																<option value="1" selected="selected">用户ID</option>																<option value="2">真实姓名</option>																<option value="3">手机号</option>																<option value="4">会员账号</option>															</select>				                <input type="text" class="input-small" name="typename" value="">    		                        &nbsp;&nbsp;								<button type="submit" class="btn btn-small no-border" id="btn-query" type="button"><i class="icon-search"></i>查询</button>								<button onclick="checkTree1();" class="btn btn-small no-border btn-primary" type="button">树状列表</button>																<button class="btn btn-small no-border btn-success" type="button">累计积分充值 <?php echo ($total_yqcz); ?></button>								<button class="btn btn-small no-border btn-success" type="button">累计布道奖励 <?php echo ($total_tjjl); ?></button>								<button class="btn btn-small no-border btn-success" type="button">累计分红奖励 <?php echo ($total_gljl); ?></button>								&nbsp;&nbsp;								<button class="btn btn-small no-border btn-danger" type="button">累计产币 <?php echo ($total_shouyi); ?></button>								<!--<button class="btn btn-small no-border btn-danger" type="button">累计合伙人奖励 <?php echo ($total_jqfh); ?></button>-->								&nbsp;&nbsp;																<button type="button"  onclick="return clear1()" class="btn btn-success btn-small no-border" >导出全部信息</button>							</div>						</form>                        							<table id="table_report" class="table table-striped table-bordered table-hover">								<thead>									<tr>										                                        <th><input type="checkbox"  class="allcheckbox" onClick="$('input[type=checkbox]').prop('checked', $(this).prop('checked'));"></th>                                        <th><a href="<?php echo U('systemlogined/Member/check',array('_order'=>'id','_sort'=>0));?>">编号↑</a></th>										<th>级别</th>										<th>是否合伙人</th>										<th>姓名</th>										<th>账号</th>										<th>推荐人</th>										<th>推广码</th>										<th>直推人数</th>										<th>团队人数</th>										<th><a href="<?php echo U('systemlogined/Member/check',array('_order'=>'regdate','_sort'=>0));?>">注册时间↑</a></th>										<th>个人算力</th>										<th><a href="<?php echo U('systemlogined/Member/check',array('_order'=>'ipfs','_sort'=>0));?>">IPFS钱包↑</a></th>										<th><a href="<?php echo U('systemlogined/Member/check',array('_order'=>'fil','_sort'=>0));?>">可提FIL余额↑</a></th>                                                                                <th>总抵押币</th>                                        <th>总未释放(FIL)</th>                                        <th>消耗GAS(FIL)</th>                                        										<th><a href="<?php echo U('systemlogined/Member/check',array('_order'=>'yuanqi','_sort'=>0));?>">元气钱包↑</a></th> 										<th>实名信息</th>										<th><a href="<?php echo U('systemlogined/Member/check',array('_order'=>'lock','_sort'=>0));?>">状态↑</a></th>                                        <th>在线状态</th>                                        <th>操作</th>									</tr>								</thead>								<tbody>									<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>											<td><input type="checkbox" name="userid[]" value="<?php echo ($v['id']); ?>" class="allcheckbox"></td>                                                                                        <td><?php echo ($v["id"]); ?></td>											<td><?php echo group($v[level]);?></td>											<?php if($v["is_partner"] == 1): ?><td>是</td>											<?php else: ?>												<td>否</td><?php endif; ?>											<td><?php echo ($v["truename"]); ?></td>											<td><?php echo ($v["username"]); ?></td>																							<!--<td><a target="_blank" href="<?php echo U('inMember',array('u'=>$v['parent']));?>"><?php echo ($v["parent_id"]); ?></td>-->											<td><?php echo ($v["parent_id"]); ?>-<?php echo ($v["parentname"]); ?></td>											<td><?php echo ($v["tgm"]); ?></td>											<td><?php echo ($v["ztnums"]); ?></td>											<td><?php echo ($v["teamnums"]); ?> <a href="javascript:;" onclick="checkTree(this,<?php echo ($v["id"]); ?>);" >树状图</a></td>											<td><?php echo (date('Y-m-d H:i',$v["regdate"])); ?></td>											<td><?php echo ($v["total_sl"]); ?></td>											<td>												<button class="btn btn-small btn-info" style="border-width:1px;margin-bottom:2px">余额：<?php echo ($v["ipfs"]); ?></button>												<br/><button class="btn btn-small btn-danger" style="border-width:1px">产币：<?php echo ($v["cb"]); ?></button>												<!--<br/><button class="btn btn-small btn-danger" style="border-width:1px">fil币奖励：<?php echo ($v["shouyi"]); ?></button>-->												<!--<br/><button class="btn btn-small btn-danger" style="border-width:1px">合伙人奖励：<?php echo ($v["jqfh"]); ?></button>-->											</td>											<td><?php echo ($v["fil"]); ?></td>                                                                                        <td><?php echo ($v["total_mortgage"]); ?></td>                                            <td><?php echo ($v["total_not_released"]); ?></td>                                            <td><?php echo ($v["total_gas"]); ?></td>											<td>												<button class="btn btn-small btn-info" style="border-width:1px;margin-bottom:2px">余额：<?php echo ($v["yuanqi"]); ?></button>												<br/><button class="btn btn-small btn-success" style="border-width:1px">充值：<?php echo ($v["yqcz"]); ?></button>												<br/><button class="btn btn-small btn-success" style="border-width:1px">推荐奖励：<?php echo ($v["tjjl"]); ?></button>												<br/><button class="btn btn-small btn-success" style="border-width:1px">分红奖励：<?php echo ($v["gljl"]); ?></button>																					</td>                                            <td>                                                <a href="javascript:;" onclick="checkInfo(<?php echo ($v["id"]); ?>)" <?php if($v["status"] == 1): ?>style="color:red"<?php elseif($v["status"] == 2): ?>style="color:yellow"<?php elseif($v["status"] == 3): ?>style="color:black"<?php endif; ?> >查看</a>                                            </td>											<td>												<?php if($v["lock"] == 1): ?><font color="red">已封停</font>												<?php else: ?>													<font color="#4169e1">正常</font><?php endif; ?>											</td>                                                                                                                                                                                <td>												<?php if((time()-$v["online_time"]) < 300){?>                                                                                                	<span style="color:#F00;">在线</span>                                                                                                <?php }else{ ?>                                                                                                	<span style="color:#ccc;">离线</span>                                                                                                <?php } ?>                                                											</td>                                            											<td><?php if($v["lock"] == 1): ?><a onclick="if(confirm('确认解封此账户吗?')==false)return false;" href="<?php echo U(GROUP_NAME .'/Member/editFeng',array('id'=>$v['id'],'lock'=>0));?>">解封</a>												<?php else: ?>											    <a onclick="if(confirm('确认暂停此账户吗？')==false)return false;" href="<?php echo U(GROUP_NAME .'/Member/editFeng',array('id'=>$v['id'],'lock'=>1));?>">封号</a><?php endif; ?>												| 																								<!--<a onclick="if(confirm('确认删除此账户吗？删除后会员相关数据也将被清除')==false)return false;" href="<?php echo U(GROUP_NAME .'/Member/delete',array('id'=>$v['id']));?>">删除</a> | -->												<a href="<?php echo U(GROUP_NAME .'/Member/editMember',array('id'=>$v['id']));?>">编辑</a>												<!--<a href="<?php echo U(GROUP_NAME .'/Member/addJinbi',array('id'=>$v['id']));?>">充值</a>-->											</td>										</tr><?php endforeach; endif; ?>									<tr>										<td colspan="20" style="text-align:center;"><div class="page"><?php echo ($page); ?></div></td>									</tr>								</tbody>							</table>                                                                                 </form>   						</div>						<!--PAGE CONTENT ENDS HERE-->					</div><!--/row-->				</div><!--/#page-content-->			</div><!--/#main-content-->		</div><!--/.fluid-container#main-container-->		<a href="#" id="btn-scroll-up" class="btn btn-small btn-inverse">			<i class="icon-double-angle-up icon-only bigger-110"></i>		</a>		<!--basic scripts-->		<script src="__PUBLIC__/js/jquery-1.9.1.min.js"></script>		<script src="__PUBLIC__/js/bootstrap.min.js"></script>		<!--page specific plugin scripts-->		<script src="__PUBLIC__/js/bootbox.min.js"></script>		<script src="__PUBLIC__/js/jquery.dataTables.min.js"></script>		<script src="__PUBLIC__/js/jquery.dataTables.bootstrap.js"></script>		<script src="__PUBLIC__/js/TableTools.min.js"></script>		<!--bbc scripts-->		<script src="__PUBLIC__/js/bbc-elements.min.js"></script>		<script src="__PUBLIC__/js/bbc.min.js"></script>		<script src="__PUBLIC__/js/bootstrap.notification.js"></script>		<script src="__PUBLIC__/js/jquery.easing.1.3.js"></script>		<script type="text/javascript">			function clear1(){			    if(confirm("确认要导出全部会员吗?")){			        $('#table-searchbar').attr('action',"<?php echo U(GROUP_NAME .'/member/excel2');?>").submit();			        $('#table-searchbar').removeAttr('action');			    }			}		</script>				<script type="text/javascript" src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.js"></script>		<script type="text/javascript" src="/Public/ybt/js/layer/layer.js"></script>		<script>		function checkTree(e,id) {			$username = $(e).parent().prev().prev().prev().prev().prev().prev().prev().prev().html() + '-' + $(e).parent().prev().prev().prev().prev().prev().html();			layer.open({			  type: 2,			  title: '用户<span style="color:#f00"> ' + $username + '</span> 的团队树状图列表',			  shadeClose: true,			  shade: 0.8,			  area: ['90%', '90%'],			  content: '/index.php/systemlogined/member/treetable?uid=' + id //iframe的url			}); 		}					function checkTree1() {			layer.open({			  type: 2,			  title: '团队树状列表',			  shadeClose: true,			  shade: 0.8,			  area: ['95%', '95%'],			  content: '/index.php/systemlogined/member/treetable'//iframe的url			}); 		}				function checkInfo(id) {			layer.open({			  type: 2,			  title: '实名信息',			  shadeClose: true,			  shade: 0.8,			  area: ['30%', '70%'],			  content: '/systemlogined/member/certification?id=' + id //iframe的url			}); 		}		</script>		<!--inline scripts related to this page-->	</body></html>