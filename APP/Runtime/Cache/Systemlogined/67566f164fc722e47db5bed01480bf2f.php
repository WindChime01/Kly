<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />

        <title>会员等级管理</title>



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

        <style>
          .search_condition{
            height:30px;
                padding:2px 12px;
                border-radius:0;
                margin-left:5px;
          }
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

        <div class="navbar navbar-inverse">			<div class="navbar-inner">				<div class="container-fluid">					<a href="#" class="brand">						<small>							<i class="icon-leaf"></i>							内部销售系统						</small>					</a><!--/.brand-->					<ul class="nav ace-nav pull-right">						<li class="light-blue user-profile">							<a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">								<img class="nav-user-photo" src="__PUBLIC__/avatars/avatar2.png"/>								<span id="user_info">									<small>管理员</small>									<?php echo (session('adminusername')); ?>								</span>								<i class="icon-caret-down"></i>							</a>							<ul class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer" id="user_menu">								<li>									<a href="<?php echo U(GROUP_NAME.'/Index/Logout');?>">										<i class="icon-off"></i>										安全退出									</a>								</li>							</ul>						</li>					</ul><!--/.ace-nav-->				</div><!--/.container-fluid-->			</div><!--/.navbar-inner-->		</div>                <style>#page_search input{ border:0px; background:#ccc;color:#ffffff; margin-left:5px;}#page_search .current{ background:#005580; color:#ffffff;}.page a{font-size:16px;}a.active{ color:#C30 !important; font-size:18px;}</style>                



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

                        <li class="active">会员明细</li>

                    </ul><!--.breadcrumb-->

                </div>



                <div id="page-content" class="clearfix">

                       <div class="page-header position-relative">

                           <div style="text-align:left;width:100%;">

                         <!--   <a type="button" href="<?php echo U(GROUP_NAME.'/Member/add_member_group');?>" class="btn btn-info btn-small no-border"> <i class="icon-plus icon-white"></i>添加会员组</a> -->

                            </div>

                       </div>

                    <div class="row-fluid">

                       
                        <form id="table-searchbar" method="GET" class="form-inline well well-small">
                            <div class="row-fluid" style="margin-bottom: 20px">&nbsp;&nbsp;
                                    <select class="span3" name="type" style="width: 100px;">

                                        <!-- <option value="1" <?php if($type == 1): ?>selected="selected"<?php endif; ?> >编号</option> -->

                                        <option value="2" <?php if($type == 2): ?>selected="selected"<?php endif; ?> >姓名</option>

                                        <option value="3" <?php if($type == 3): ?>selected="selected"<?php endif; ?> >手机号</option>

                                        <option value="4" <?php if($type == 4): ?>selected="selected"<?php endif; ?> >级别</option>

                                        <option value="5" <?php if($type == 5): ?>selected="selected"<?php endif; ?> >合伙人</option>

                                    </select>  
                                    &nbsp;&nbsp;
                                    <input type="text" class="input-small" name="typename" value="<?php echo $_GET['typename'];?>">    

                                  &nbsp;&nbsp;开始日期
                                    <input type="date" value="<?php echo $_GET['start_time'];?>"class="input-small" name="start_time" style="width:120px">
                                    &nbsp;&nbsp;截止日期
                                    <input type="date" value="<?php echo $_GET['end_time'];?>" class="input-small" name="end_time" style="width:120px">
                            
                                   &nbsp;&nbsp;
                                <button type="submit" class="btn btn-small no-border" id="btn-query" type="button"><i class="icon-search"></i>查询</button>
                                &nbsp;&nbsp;
                                <button type="button"  onclick="return clear1()" class="btn btn-success btn-small no-border" id="btn-compute" type="button">导出所查询信息</button>
                                &nbsp;&nbsp;
                                <button type="button"  onclick="return clear2()" class="btn btn-success btn-small no-border" >导出全部信息</button>
                            </div>
                        </form>



                        <div class="row-fluid">

                            <table id="table_report" class="table table-striped table-bordered table-hover">

                                <thead>

                                    <tr>

                                        <th>编号</th>

                                        <th>姓名</th>

                                        <th>手机号</th>

                                        <th>级别</th>

                                        <th>是否合伙人</th>

                                        <th width="120px">所属合伙人</th>

                                        <th>直推人数</th>

                                        <th>团队人数</th>

                                        <th>算力</th>

                                        <th>FIL余额(FIL)</th>

                                        <th>产币(FIL)</th>

                                        <th>代币奖(FIL)</th>

                                        <th>管理代币奖(FIL)</th>

                                        <th>积分余额</th>

                                        <th>推荐奖</th>

                                        <th>积分分红奖</th>

                                        <th>管理积分奖</th>


                                    </tr>

                                </thead>

                                <tbody>

                                    <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>

                                            <td><?php echo ($v["id"]); ?></td>

                                            <td><?php echo ($v["truename"]); ?></td>

                                            <td><?php echo ($v["mobile"]); ?></td>  

                                            <td><?php echo ($v["level_name"]); ?></td>                                           

                                            <td><?php echo ($v["is_partner"]); ?></td>                                       

                                            <td><?php echo ($v["partner__id"]); ?><br/><?php echo ($v["partner_truename"]); ?><br/><?php echo ($v["partner_mobile"]); ?></td>

                                            <td><?php echo ($v["push_num"]); ?></td>                                            

                                            <td><?php echo ($v["team_num"]); ?></td>

                                            <td><?php echo ($v["suanli"]); ?></td>

                                            <td><?php echo ($v["ipfs"]); ?></td>

                                            <td><?php echo ($v["jackpot_reward"]); ?></td>

                                            <td><?php echo ($v["fil"]); ?></td>

                                            <td><?php echo ($v["partner_fil"]); ?></td>

                                            <td><?php echo ($v["yuanqi"]); ?></td>

                                            <td><?php echo ($v["tjj"]); ?></td>

                                            <td><?php echo ($v["jffh"]); ?></td>

                                            <td><?php echo ($v["partner_integral"]); ?></td>

                                        

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
        <script type="text/javascript">

            function change_reward_status(){
                $.post("<?php echo U(GROUP_NAME .'/member/change_reward_status');?>","",function(e){
                    // console.log("<?php echo U(GROUP_NAME .'/Reward/change_reward_status');?>");
                    alert(e.msg)
                    $('#btn-query2').removeClass('btn-info');
                    $('#btn-query2').html(e.status);
                },'json')
            }

            function clear1(){

                if(confirm("确认要导出所查询信息吗?")){
                    $('#table-searchbar').attr('action',"<?php echo U(GROUP_NAME .'/member/excel?type=1');?>").submit();
                    $('#table-searchbar').removeAttr('action');
                }

            }

            function clear2(){

                if(confirm("确认要导出全部信息吗?")){
                    $('#table-searchbar').attr('action',"<?php echo U(GROUP_NAME .'/member/excel?type=2');?>").submit();
                    $('#table-searchbar').removeAttr('action');
                }
            }


        </script>

    </body>

</html>