<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- saved from url=(0049)http://porter.weiyinstudio.com/Home/Myuser/jihuo2/zt/0/ -->

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



	<meta name="robots" content="noindex,nofollow">

	<meta name="robots" content="noarchive">

	<!-- 屏蔽-->

	<title>我的团队</title>

	<meta name="keywords" content=" ">

	<meta name="viewport" content="initial-scale=1, maximum-scale=1">

	<meta name="apple-mobile-web-app-capable" content="yes">

	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<meta content="IE=9; IE=EDGE" http-equiv="X-UA-Compatible">

	<link rel="stylesheet" href="/Public/ybt/css/sm.css">

	<script src="/Public/ybt/js/jquery-1.10.2.min.js"></script>



	<link rel="stylesheet" href="/Public/ybt/css/sm-extend.css">



	<link rel="stylesheet" href="/Public/ybt/css/iconfont.css">

	<!--自定义-->

	<link rel="stylesheet" href="/Public/ybt/css/main.css">

	<link rel="stylesheet" href="/Public/ybt/css/order.css">
	<style>
	body{
	    color: white;
	}
	.receive{
		color: white;
		margin:0 0 1.5rem 0.5rem;
	}
	.Bar { position: relative; width: 100%;
		/* 宽度 */ 
		background: #DBD9D9;
		border-radius: 10px;}

	.Bar div{ display: block; position: relative;
		background:#3987F3;/* 进度条背景颜色 */ color: #333333;
		height: 6px; /* 高度 */ line-height: 6px;
		border-radius: 6px;
		/* 必须和高度一致，文本才能垂直居中 */ }
	.Bar div span{ position: absolute; width: 100%;
		/* 宽度 */ text-align: center; font-weight: bold; }
	hr{height:1px;border:none;border-top:1px solid #fff;width:1rem}
	.line_m{text-decoration:line-through;width:1rem}
	table tr td {line-height: 2rem;}
	.logo{position: absolute;top:0;left:0}
	
	.tabs{
		position: absolute;
		border-top-left-radius: 30px;
		border-top-right-radius: 30px;
		width:100%;
		top:200px;
		z-index: 999;
		
	}
	
	.page{
	}
	</style>
</head>

<body>

<div class="page">

<!-- 标题栏 -->

<header class="bar bar-nav" style="background:url('/Public/ybt/image/new/kuang-bg.png')  no-repeat top center; background-size:cover;min-height:230px;overflow:hidden;position:relative">
	<a style="position: none;z-index: 19;width: 100%;text-align: center;display: inline-block;line-height: 50px;font-size: 0.85rem; color:#FFF;">我的团队</a>
	
	<div class="logo">
		<a href="javascript:history.back(-1)"><i class="icon icon-left"></i></a>
	</div>
	<div style="width:90%;margin:auto;">
		<p style="color:#C2C7E4;margin:15px 0">团队业绩</p>
		<p style="font-size:36px;"><?php echo ($tdsy); ?></p>
	</div>
		<p style="color:#C2C7E4;margin:15px 0;position:absolute;">直推人数&nbsp;&nbsp;<?php echo ($ztrs); ?></p>
		<p style="color:#C2C7E4;margin:15px;position:absolute;margin-left:40%">团队人数&nbsp;&nbsp;<?php echo ($tdrs); ?></p>
	<a class="icon pull-right open-panel"></a>
</header>

<script type="text/javascript">

    $(function() {
    	var win_h = $(window).height();
		var header_h = $('.bar-nav').height();
		var box_h = win_h - header_h -80;
		$('.box').height(box_h+'px');

        $("#cancle").click(function() {

            $.router.back();


        });

    });

</script>
	<div class="tabs" style="overflow:hidden">
		<!--class card-->
		<div class="box" style="width:90%;margin: 1rem auto;min-height:50px;color:#fff;border-radius:5px;padding:10px;overflow:scroll;">
			
			<table style="width:100%">
                <tr style="color:#727B9E;font-size:0.75rem;font-weight:normal;text-align:center">
                    <th style="width: 3%">序号</th>
                    <th style="width: 60%">账号</th>
                    <td style="width: 20%">个人业绩</td>
                    <!--<th>最近登录</th>-->
                </tr>
                <?php if(is_array($user)): foreach($user as $key=>$v): ?><tr  style="border-width: 0;color:#333333;font-size:0.7rem;padding-left:10%">

                    <!--<td align="center" style="font-style: italic;font-size: 0.7rem"><?php echo ($key+1); ?></td>-->

<!--                    <td align="center" style="color: red;"><?php echo ($v["truename"]); ?></td>-->

                    <td align="center style="font-style: italic;font-size: 0.7rem""><?php echo ($v["id"]); ?></td>
                    <td align="center"><?php echo ($v["username"]); ?></td>
                    <td align="center"><?php echo ($v["gryj"]); ?></td>

                    <!--<td align="center" style="color: #f1c232"><?php echo (friend_date($v["logintime"])); ?></td>-->

                </tr><?php endforeach; endif; ?>
            </table>
            <div style="text-align: center;color:#808080;font-size:12px">没有了</div>
		</div>

	

<br>
</div>
</body></html>