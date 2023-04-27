<?php if (!defined('THINK_PATH')) exit();?><!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->

<!-- saved from url=(0041)http://porter.weiyinstudio.com/Home/Index/index -->

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



	<meta name="robots" content="noindex,nofollow">

	<meta name="robots" content="noarchive">

	<!-- 屏蔽-->

	<title>抽奖活动会场</title>

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

	<!-- 变量声明  -->



	<link rel="stylesheet" href="/Public/ybt/sy/css/style.css">
	<link rel="stylesheet" type="text/css" href="/Public/ybt/plugin/jquerySwiper/css/swiper.css"/>
	<script src="/Public/ybt/plugin/jquerySwiper/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>

	<script type="text/javascript" src="/Public/ybt/sy/js/TouchSlide.1.1.js"></script>

	<script src="/Public/ybt/js/layer.js"></script>
	<style>
		body{
	    background:url(/Public/Uploads/780.jpg) ;
	}
		.slideBox{
			width:90%;
		}
		
		.pic img{
			height:160px;
			border-radius: 20px;
		}
		
		.slideBox .hd{
			visibility: hidden;
		}
		
		.content-padded{
			margin:0.5rem auto;
			margin-top: 0;
			position: relative;
		}

		.content-padded span{
		    position: absolute;
		    margin-top: 3%;
		    margin-left:1%;
		    font-size: 15px;
		}
		.content-padded select{
		    position: absolute;
		    margin-top: 3%;
		    margin-left:50%;
		    border: none;
		    appearance: none;
		}
		
		
		.li-css{
			padding:15px 22px;
			display: flex;
			flex-direction: row;
		}
		
		.text-content{
			height:100%;
			display: inline-block;
			flex:1;
		}
		
		.text-content p{
			margin:10px 0;
		}
		
		.img-content{
			height:100%;
			flex:1;
			position: relative;
		}
		
		.img-content img{
			width:95%;
			padding: 10px 0 10px 15px;
			position: absolute;
			top:-30px;
		}
		.swiper-slide img{
			width:100%;
		}
		.swiper-container{
			 width: 100%;
			 height: 8rem;
			 margin:0 auto;
		 }
		 .swiper-button-next {
		   right: 10px;
		   left: auto;
		 }
		 .swiper-button-prev {
		   left: 10px;
		   right: auto;
		 }
		 .hr0{
            height:1px;
            border:none;
            border-top:5px solid #F5F5F5;
		 }
		 .button{
			width:100%;
			margin: 20px auto;
			height:auto;
			display: inline-block;
			text-align: center;
		}
		
		 /* css定义分页，导航按钮颜色 */
		 #case5{
		     --swiper-theme-color: #ff6600;
		     --swiper-pagination-color: #00ff33;
		     /* 两种都可以 */
		 }
		/*#case6{*/
		/*	--swiper-navigation-size: 24px;*/
		/*}*/
		#case6 img,#case7 img{transform: scale(0.9);}
		#case7{
			 width:auto;
		}
        .main_now_tab{
            background:url('/Public/Uploads/R-C\ \(1\).jpg');
            width: 500px;
            height: 200px;
        }
	</style>
</head>

<body style="">

<!--弹出公告-->

<!--弹出公告-->

<div class="page">
	<div class="content" id="main_content">
	
		<div class="">
            <a  href="javascript:history.back(-1)" ><i class="icon icon-left" style="padding-top:10%;padding-left:2%"></i></a>
			<a class="top-title" style="font-size:32px;text-align:center;color:#0A294F;">抽奖活动会场</a>
			
			 <hr class="hr0" />  
		</div>



<form class="layui-form">
		<div class="row" style="width:95%;border-radius:5px;margin:10px auto;margin-top:0;">

			<div class="main_now_tab">
                <h2 style="margin-left: 30%;margin-top: 5%;">一等奖：<?php echo ($prize1); ?></h2>
                <h2 style="margin-left: 30%;margin-top: 3%;">二等奖：<?php echo ($prize2); ?></h2>
                <h2 style="margin-left: 30%;margin-top: 3%;">三等奖：<?php echo ($prize3); ?></h2>
				<a class="button button-success" style="margin-top: 10%;margin-left: 25%;width: 50%;" onclick="all_prize()">查看所有奖品</a>

			</div>

		</div>
        <h3 style="text-align:center;color:greenyellow">剩余抽奖次数：<?php echo ($prize_num); ?></h3>
        <a lay-submit class="button button-success" lay-filter="j" style="width: 60%;margin-left: 20%;margin-top: 5%;background-color: aquamarine;">摇一摇</a>
        <a lay-submit class="button button-success" lay-filter="log" style="width: 60%;margin-left: 20%;background-color: aquamarine;" onclick="my_prize()">我的奖品</a>
</form>
	</div>




</div>



<script type="text/javascript" src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.js"></script>
<script type="text/javascript" src="/Public/ybt/js/layui.js"></script>
<script type="text/javascript" src="/Public/ybt/js/layer/mobile/layer.js"></script>

<script type="text/javascript">
    function all_prize(){
        layer.open({
            title: "所有奖品",
            type: 2,
            area: ['350px',"400px"],
            content:"/index/index/all_prize"
        })
    }
    function my_prize(){
        layer.open({
            title: "我的奖品",
            type: 2,
            area: ['350px',"400px"],
            content:"/index/index/my_prize"
        })
    }
    layui.use(['layer','jquery','form'],function(){
        var layer = layui.layer;
        var jquery = layer.jquery;
        var form = layui.form;
        form.render("select");
        form.on('submit(s)',function(data){
            $.post("/index/add/bank",(data.field),function(res){
            layer.msg(res.msg ? res.msg :'请求失败',{time:1500},function(){
            if (res.success == 1){
				window.parent.location.reload();
				}
            })
        });
        });

        form.on('submit(j)',function(data){
            $.post("/index/add/prize",(data.field),function(res){
            layer.msg(res.msg ? res.msg :'请求失败',{time:1500},function(){
            if (res.success == 1){
				window.parent.location.reload();
				}
            })
        });
        });
    });
</script>

</body></html>