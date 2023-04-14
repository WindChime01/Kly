<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



	<meta name="robots" content="noindex,nofollow">

	<meta name="robots" content="noarchive">

	<!-- 屏蔽-->

	<title>Mine</title>

	<meta name="keywords" content="">

	<meta name="viewport" content="initial-scale=1, maximum-scale=1">

	<meta name="apple-mobile-web-app-capable" content="yes">

	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<meta content="IE=9; IE=EDGE" http-equiv="X-UA-Compatible">

	<link rel="stylesheet" href="/Public/ybt/css/sm.css">

	<script src="/Public/ybt/js/jquery-1.10.2.min.js"></script>

	<link rel="stylesheet" href="/Public/ybt/css/sm-extend.css">

	<link rel="stylesheet" href="/Public/ybt/css/iconfont.css">

	<link rel="stylesheet" href="/Public/ybt/css/main.css">

	<link rel="stylesheet" href="/Public/ybt/css/order.css">

	<!-- 变量声明  -->


	<style>
	body{
	    background-color: white;
	}
		.info-top .uphoto img{
			width:70px;
			height:70px;
		}
		
		.top-info{
			width:100%;
			height:180px;
		}
		
		/*.main{*/
		/*	position: fixed;*/
		/*	top:180px;*/
		/*	height:calc(100% - 240px);*/
		/*	overflow-y: scroll;*/
		/*}*/
		
		.content{
			height:100%;
			width:100%;
			z-index: -1;
			padding-bottom: 3rem;
		}
		
		.info-top .uinfo{
			border-left:none;
			padding:0;
			margin:0;
			margin-top: 18px;
		}
		
		.info-top .uinfo p{
			margin-bottom: 10px;
			color:#fff;
			font-size: 15px;
		}
		
		.info-top{
			background:none;
			position: relative;
			width:100%;
			margin-top: 5px;
		}
		
		.info-top .uphoto{
			width:22%;
		}
	
		.property{
			width:90%;
			margin:0 auto;
			display: flex;
			justify-content:space-between;
			color: white;
			margin-top:10px ;
		}

		.center-div{
			color:#fff;
			position: relative;
			width:32%;
			height:150px;
			background: url('/Public/ybt/image/new/center-div.png');
			background-size: 100% 100%;
		}
		
		.center-div .center-icon{
			width:35px;
			height:35px;
			left:10px;
			top:10px;
			position: absolute;
		}

		.center-div .price-name{
			width: 100%;
			text-align: left;
			position: absolute;
			bottom:35px;
			left:15px;
			font-size: 14px;
		}

		.center-div .price-value{
			width: 100%;
			text-align: left;
			position: absolute;
			bottom:65px;
			left:15px;
			display: block;
    		overflow: hidden;
    		text-overflow: ellipsis;
    		width:80%;
		}

		.detail-div{
			width:90%;
			height:280px;
			margin:0 auto;
			margin-bottom: 30px;
			margin-top: 30px
		}

		.detail-div ul{
			width:90%;
			height:100%;
			margin:0 auto;
			list-style: none;
		}
		
		.detail-div ul li{
			font-size: 16px;
			margin:15px 0;
			float:left;
			width:100%;
			position: relative;
			height:30px;
			color:#333333;
			line-height: 30px;
		}
		
		.detail-div ul li span{
			margin-left: 30px;
		}
		
		.icon{
			width:48px;
			height:48px;
			margin-top: 9px;
			top:50%;
			margin-left:10%;
		}
		
		.arrow{
			width:9px;
			height:16px;
			float: right;
			position: absolute;
			margin-top: -8px;
			top:50%;
			right:0;
		}
		
		.btn{
			width:90%;
			background-size: 100% 100%;
			margin: 20px auto;
			height:48px;
		}
		
		.button-success.button-fill{
			background-color: transparent;
			color:#3A83F6;
		}
		.hr0{
            height:1px;
            border:none;
            border-top:5px solid #F5F5F5;
		 }
		.info-list{margin-bottom: 1px; height:auto;}

		.info-list li{height:100%;padding: 20px 0 19px 0; border-bottom: 1px solid #efeff4;margin-top:0px;}
		.partner{position:absolute;right:10px;top:27%;}
		.partner img{width:75px;height:26px;}
		.page{background:transparent;}
	</style>
</head>

<body style="">

<div class="page">

	<nav class="foot-bar">

		<div class="foot-menu"><a href="<?php echo U('Index/Emoney/shouye');?>" >
			<i class="iconfont icon-shouye"></i><span>Home</span></a></div>
			
		<div class="foot-menu"><a href="<?php echo U('Index/Shop/index');?>" >

			<i class="iconfont icon-share"></i><span>Hire</span></a></div>

		<!--<div class="foot-menu"><a href="javascript:layer.open({content: '敬请期待',skin: 'msg',time: 2});">-->

		<!--	<i class="iconfont icon-gouwuche"></i><span>交易中心</span></a></div>-->

		<div class="foot-menu"><a href="/" style="color:#5d93ea">

			<i class="iconfont icon-all"></i><span>Mine</span></a></div>

	</nav>




	<div class="content" id="main_content">
	<!-- 标题栏 -->
	<div class="top-info">
		<a class="top-title" style="font-size:32px;text-align:center;color:#0A294F;">Mine</a>
		<a class="top-title" style="font-size:18px;text-align:center;color:#0A294F;margin-top:-40px">Mine</a>
		<hr class="hr0" />  
		<div class="info-top">

			<div class="uphoto" ><img src="/Public/ybt/image/user2.png" ><p style="font-size:10px;margin-top:-10px;"><?php echo ($minfo["name"]); ?></p></div>

			<div class="uinfo">

				<p style="font-size:14px;color:#003333">ID： <?php echo ($minfo["id"]); ?></p>
				<p style="color:#333333;">账号：<?php echo ($minfo["username"]); ?></p>

				<!--<p>直推人数：<?php echo ($ztnum); ?></p>-->

				<!--<p>团队人数：<?php echo ($tdnum); ?></p>-->
				<?php if($minfo["is_partner"] == 1): ?><a class="partner" href="#"><img src="/Public/ybt/image/new/partner.png"></a><?php endif; ?>				
			</div>

		</div>
	</div>
	<div class="main">
		<div class="property" style="color:#234ADB">
				<p class="price-value"><?php echo ($sr); ?></p>
				<p class="price-value" style="margin-left:-4%"><?php echo ($tdsy); ?></p>
				<p class="price-value" style="margin-right:10%"><?php echo ($pinjun); ?></p>
		</div>
				<div class="property" style="color:#003333">
				<p class="price-name">总收入</p>
				<p class="price-name">团队收入</p>
				<p class="price-name">推荐人数</p>
		</div>
		<div class="detail-div" style="border-color:#C4C8CC;">
		    <a style="margin-left:10px;">Basic function</a>
			<ul>
				<li>
                    <img class="icon" style="margin-left:-8px"  src="/Public/ybt/image/center/icon/wodezichan.png">
					<img class="icon" src="/Public/ybt/image/center/icon/guyong.png">
					<img class="icon" src="/Public/ybt/image/center/icon/wodetuandui.png">
					<img class="icon" src="/Public/ybt/image/center/icon/fenxiang.png">
				</li>
									
				<li>
					<a href="<?php echo U('Index/index/wallet');?>" style="margin-left:-12px;font-size:14px">我的资产</a>
					<a href="<?php echo U('Index/index/applylist');?>" style="margin-left:12%;font-size:14px">雇佣</a>
					<a href="<?php echo U('Index/account/myAccount');?>" style="margin-left:12%;font-size:14px">我的团队</a>
					<a href="<?php echo U('Index/index/service');?>" style="margin-left:12%;font-size:14px">分享</a>
				</li>
				<li>
					<img class="icon" style="margin-left:-8px"  src="/Public/ybt/image/center/icon/guanyuwomen.png" >
					<img class="icon" src="/Public/ybt/image/center/icon/guanyuwomen.png">
					<img class="icon" src="/Public/ybt/image/center/icon/guanyuwomen.png">
					<img class="icon" src="/Public/ybt/image/center/icon/tuichu.png">
				</li>
									
				<li>
					<a href="" style="margin-left:-12px;font-size:14px">关于我们</a>
					<a href="javascript:;" style="margin-left:9%;font-size:14px" onclick="yqm();">邀请码</a>
					<a href="<?php echo U('Index/index/bank');?>" style="margin-left:13%;font-size:14px">银行卡</a>
					<a href="javascript:;" style="margin-left:10%;font-size:14px" onclick="logout();">退出登录</a>
				</li>
				
				<div style="clear:both;"></div>
			</ul>
			
		
	</div>
		<!--<div class="my-qiandao" style="width:100%;">-->

		<!--	<div class="row-box clearfix"><a class="col-xs-3 sub-tab" style="border:0px;" href="/index/yuanqi/index"><span class="num_qiandao"><?php echo (two_number($minfo["yuanqi"])); ?></span>-->

		<!--		<p class="subtitle">元气值</p>-->

		<!--	</a><a class="col-xs-3 sub-tab"><span class="num_qiandao"><?php echo ($yxkj); ?>台</span>-->

		<!--		<p class="subtitle">有效矿机</p>-->

		<!--	</a><a class="col-xs-3 sub-tab"><span class="num_qiandao"><?php echo (two_number($ljcl)); ?></span>-->

		<!--		<p class="subtitle">总收益</p>-->

		<!--	</a></div>-->

		<!--</div>-->

		<!--<div class="my-qiandao" style="width:100%; background:#0e696d">-->

		<!--	<div class="row-box clearfix"><a class="col-xs-3 sub-tab" style="border:0px;" href="/index/yuanqi/jinbi"><span class="num_qiandao"><?php echo (two_number($minfo["jinbi"])); ?></span>-->

		<!--		<p class="subtitle">矿池钱包</p>-->

		<!--	</a><a class="col-xs-3 sub-tab"><span class="num_qiandao"><?php echo (two_number($minfo["kczc"])); ?></span>-->

		<!--		<p class="subtitle">矿池资产</p>-->

		<!--	</a><a class="col-xs-3 sub-tab"><span class="num_qiandao"><?php echo ($minfo["teamgonglv"]); ?></span>-->

		<!--		<p class="subtitle">团队算力</p>-->

		<!--	</a></div>-->

		<!--</div>-->
		
		

		<!--<ul>-->

		<!--	<div class="info-list">-->

		<!--		<li><a href="<?php echo U('Index/Shop/qiandao');?>"><img src="/Public/ybt/image/info-jsbz.png"><span>我要签到</span></a></li>-->

		<!--		<li><a href="<?php echo U('Account/dhgl');?>"><img src="/Public/ybt/image/info-zhuan.png"><span>兑换管理</span></a></li>-->

		<!--		<li><a href="<?php echo U('Account/kczc');?>"><img src="/Public/ybt/image/info-jsbz.png"><span>矿池资产</span></a></li>-->

		<!--		<li><a href="<?php echo U('Account/hdjl');?>"><img src="/Public/ybt/image/info-score.png"><span>活动奖励</span></a></li>-->



		<!--		<li><a href="<?php echo U('Account/skm');?>"><img src="/Public/ybt/image/info-pass.png"><span>收款设置</span></a></li>-->

		<!--		<li><a href="<?php echo U('Account/tuiguangma');?>"><img src="/Public/ybt/image/info-code.png"><span>推广文案</span></a></li>-->

		<!--		<li><a href="<?php echo U('Financial/keshou');?>"><img src="/Public/ybt/image/info-tgbz.png"><span>财务明细</span></a></li>-->



		<!--		<li><a href="<?php echo U('Account/shoukuanma');?>"><img src="/Public/ybt/image/info-update.png"><span>实名认证</span></a></li>-->

		<!--		<li><a href="<?php echo U('Account/grzl');?>"><img src="/Public/ybt/image/info-pass.png"><span>个人资料</span></a></li>-->



		<!--		<li><a href="<?php echo U('Account/sqjl');?>"><img src="/Public/ybt/image/info-tuandui.png"><span>社群奖励</span></a></li>-->

		<!--		<li><a href="<?php echo U('Index/new/news');?>"><img src="/Public/ybt/image/info-out.png"><span>系统消息</span></a></li>-->



		<!--		<li><a href="<?php echo U('Account/gonggao');?>"><img src="/Public/ybt/image/info-update.png"><span>更新公告</span></a></li>-->

		<!--	</div>-->


		

		<!--</ul>-->



	</div>

</div>
<script type="text/javascript" src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.js"></script>
<script type="text/javascript" src="/Public/ybt/js/layer/mobile/layer.js"></script>
<script type="text/javascript">
	function logout() {
		layer.open({
		    content: '您确定要退出登录吗？'
		    ,btn: ['退出', '取消']
		    ,yes: function(index){
		      window.location.href = "<?php echo U('Index/Index/logout');?>";
		      //layer.close(index);
		    }
		});
	}
	function yqm(){
        layer.open({
            type: 2,
            closeBtn: false,
            shadeClose: true,
            area: ['600px',"700px"],
			function(index){
			window.location.href = "<?php echo U('Index/Index/logout');?>";
			}
            // console.log(1),
	});
	}
	
</script>


</body></html>