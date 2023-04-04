<?php if (!defined('THINK_PATH')) exit();?><!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->

<!-- saved from url=(0041)http://porter.weiyinstudio.com/Home/Index/index -->

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



	<meta name="robots" content="noindex,nofollow">

	<meta name="robots" content="noarchive">

	<!-- 屏蔽-->

	<title>Hire</title>

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
	    background-color: white;
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
	</style>
</head>

<body style="">

<!--弹出公告-->

<!--弹出公告-->

<div class="page">
	<div class="content" id="main_content">
	
		<div class="">
			
			<a class="top-title" style="font-size:32px;text-align:center;color:#0A294F;">Hire</a>
			<a class="top-title" style="font-size:18px;text-align:center;color:#0A294F;margin-top:-40px">Hire</a>
			<div style="background-color:#234ADB;width:30%;height:23px;margin-left:65%;margin-top:-12%;border-radius:30% ;">			<span style="position:absolute;padding-top:3px;padding-left:3px" ><img id="img" src="/Public/ybt/image/center/icon/zh.png" width="50%" height="50%"></span>
			<select id="lang"  lay-ignore style="margin-left:35%;margin-top:3%;appearance: none;background-color:#234ADB;color:white;border:none;">

			<option>中文</option>
			<option>English</option>
			</select>
			</div>
			 <hr class="hr0" />  
		</div>



<form class="layui-form">
		<div class="row" style="width:95%;border-radius:5px;margin:10px auto;margin-top:0;">

			<div class="main_now_tab">
				<div class="content-padded lobby-nav">
				    <span>Employment time</span>
                    <input type="text" id="" value=""  readonly="readonly" style="height:36px;width:100%;margin-bottom:5%;border-color:#C4C8CC" >
                    <select name="hire_day"  id="RiverTypeLevel"  lay-ignore>
                        <option value="">--请选择雇佣天数--</option>
                        <?php if(is_array($hire_day)): $i = 0; $__LIST__ = $hire_day;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["hire_day"]); ?>"><?php echo ($v["hire_day"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    </div>
                <div class="content-padded lobby-nav">
                    <span>Type of withdrawal</span>
                    <input type="text" id=""  value=""  readonly="readonly" style="height:36px;width:100%;margin-bottom:5%;border-color:#C4C8CC" >
                    
                     <select name="coin" id="TypeB" lay-ignore>
                        <option value="">--请选择币种--</option> 
                        <option value="USDT">USDT</option>
                    </select>
                    </div>
                    <div class="content-padded lobby-nav">   
                    <span>Payment quantity</span>
                    <span style="color:blue;margin-left:50%;font-size:10px">USDT余额:<?php echo ($USDT); ?></span>
                    <input type="number" id="roleId"  value="10.00" elem name="amount"  readonly="readonly" style="height:72px;width:100%;margin-bottom:5%;border-color:#C4C8CC;" >
                    </div>
                    <div class="content-padded lobby-nav">   
                    <span>Transaction password</span>
                    <input type="password" id=""  value="" name="password" style="height:36px;width:100%;margin-bottom:5%;border-color:#C4C8CC;text-align:right" >
                    </div>
				<a lay-submit class="button button-success" lay-filter="s">立即上传</a>

			</div>
        
		</div>
</form>
	</div>




	<nav class="foot-bar">

		<div class="foot-menu"><a href="<?php echo U('Index/Emoney/shouye');?>" >
			<i class="iconfont icon-shouye"></i><span>Home</span></a></div>
			
		<div class="foot-menu"><a href="<?php echo U('Index/Shop/index');?>" style="color:#5d93ea">

			<i class="iconfont icon-share"></i><span>Hire</span></a></div>

		<!--<div class="foot-menu"><a href="javascript:layer.open({content: '敬请期待',skin: 'msg',time: 2});">-->

		<!--	<i class="iconfont icon-gouwuche"></i><span>交易中心</span></a></div>-->

		<div class="foot-menu"><a href="/">

			<i class="iconfont icon-all"></i><span>Mine</span></a></div>

	</nav>

</div>



<script type="text/javascript" src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.js"></script>
<script type="text/javascript" src="/Public/ybt/js/layui.js"></script>
<script type="text/javascript" src="/Public/ybt/js/layer/mobile/layer.js"></script>

<script type="text/javascript">
    layui.use(['layer','jquery','form'],function(){
        var layer = layui.layer;
        var jquery = layer.jquery;
        var form = layui.form;
        form.render("select");
        form.on('submit(s)',function(data){
            $.post("/index/add/test",(data.field),function(res){
            layer.msg(res.msg,{time:1500},function(){
            if (res.success == 1){
					window.parent.location.reload();
				}
				// console.log(res.success);
            })
        });
        });
        
        
    });
    
        $("#RiverTypeLevel").change(function () {
            var roleId = $("#RiverTypeLevel option:selected").val();
            $("#roleId").val(roleId);
            if(roleId==90){
            $("#roleId").val(500);
            }else if(roleId==180){
            $("#roleId").val(1000);
            }else if(roleId==365){
            $("#roleId").val(2000);
            }
            // console.log(roleId);
    });
</script>

</body></html>