<?php if (!defined('THINK_PATH')) exit();?><!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->

<!-- saved from url=(0041)http://porter.weiyinstudio.com/Home/Index/index -->

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



	<meta name="robots" content="noindex,nofollow">

	<meta name="robots" content="noarchive">

	<!-- 屏蔽-->

	<title>Home</title>

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
		

		
		.slideBox .hd{
			visibility: hidden;
		}
		
		.content-padded{
			margin:0.5rem auto;
			margin-top: 0;
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
		.news-title {
			overflow: hidden;
			text-overflow: ellipsis;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
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
		 .jye{
		     margin-left:10px ;
		     width: 40%;
		     height: 80px;
		     background-color: #F3F6FD;
		 }
		 .jye p{
		        padding-top:10px;
		        padding-left:5px;
		        font-size: 14px;
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

<body >

<!--弹出公告-->

<!--弹出公告-->

<div class="page">
	<div class="content" id="main_content">
	
		<div class="">
			
			<a class="top-title" style="font-size:24px;text-align:center;color:#0A294F;">Kangle Source</a>
			<a class="top-title" style="font-size:18px;text-align:center;color:#0A294F;margin-top:-40px">Kangle Source </a>
			 <!--Slider -->
			 <hr class="hr0" />  
			<div id="slideBox" class="slideBox">
	
				<div class="bd">
	
					<ul>
	
						<?php if(is_array($banner_list)): foreach($banner_list as $key=>$vo): ?><li>
	
								<a class="pic" href="#"><img src="<?php echo ($vo['path']); ?>"/></a>
	
							</li><?php endforeach; endif; ?>
	
					</ul>
	
				</div>
	
				<div class="hd">
	
					<ul></ul>
	
				</div>
	
			</div>
			
			<!--swiper导航 start-->
			<!--<div class="swiper-container" id="case6">-->
			 <!-- <div class="swiper-wrapper">-->
			 <!-- 	<?php if(is_array($banner_list)): foreach($banner_list as $key=>$vo): ?>-->
			 <!-- 		<div class="swiper-slide"><img src="<?php echo ($vo['path']); ?>"></div>-->
			 <!--<?php endforeach; endif; ?>-->
				<!--<div class="swiper-slide"><img src="/Public/Uploads/20200420/5e9d511f1b8c4.png"></div>-->
				<!--<div class="swiper-slide"><img src="/Public/Uploads/20200420/5e9d511f1b8c4.png"></div>-->
				<!--<div class="swiper-slide"><img src="/Public/ybt/plugin/jquerySwiper/img/t1.png"></div>-->
				<!--<div class="swiper-slide"><img src="/Public/ybt/plugin/jquerySwiper/img/t2.png"></div>-->
				<!--<div class="swiper-slide"><img src="/Public/ybt/plugin/jquerySwiper/img/t3.png"></div>-->
				<!--<div class="swiper-slide"><img src="/Public/ybt/plugin/jquerySwiper/img/t4.png"></div>-->
				<!--<div class="swiper-slide"><img src="/Public/ybt/plugin/jquerySwiper/img/t5.png"></div>-->
				<!--<div class="swiper-slide"><img src="/Public/ybt/plugin/jquerySwiper/img/t6.png"></div>-->
			 <!-- </div>-->
			   <!--导航按钮 上一页下一页 -->
			  <!--<div class="swiper-button-prev"></div>-->
			  <!--<div class="swiper-button-next"></div>-->
			   <!--分页器 -->
			  <!--<div class="swiper-pagination"></div>-->
			   <!--滚动条 -->
			   <!--<div class="swiper-scrollbar"></div>-->
			<!--</div>-->
			<!--swiper导航 end-->
		</div>

		<!--<div style="width:95%;border-radius:5px;margin:10px auto;line-height:1.6rem;color:#fff;font-size:0.7rem;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;padding: 0 5px">-->
		<!--	<a href="/index/account/gonggao" style="color:#fff">-->
		<!--	<img style="height:1rem;margin-top:-0.2rem;margin-right:5px" src="/Public/ybt/image/gongao@2x.png" />  公告：<?php echo ($new["title"]); ?>-->
		<!--	</a>-->
		<!--</div>-->

		<div class="row">

			<!--<div class="main_menu_bg"><a id="qiandao" href="javascript:;"><img src="/Public/ybt/image/icon-tg@2x.png"><span style="color:#fff">签到</span></a>-->

			<!--</div>-->
			<!--<div class="main_menu_bg"><a href="<?php echo U('Account/tgm');?>"><img src="/Public/ybt/image/new/extension.png"><span>推广海报</span></a>-->

			<!--</div>-->

			<!--<div class="main_menu_bg"><a href="<?php echo U('Index/account/gonggao');?>"><img src="/Public/ybt/image/new/announce.png"><span>系统公告</span></a>-->
			<!--</div>-->
			
			<!--<div class="main_menu_bg"><a href="<?php echo U('index/Index/property');?>"><img src="/Public/ybt/image/icon-qianbao@2x.png"><span style="color:#fff">我的资产</span></a>-->

			<!--</div>-->


			<!--<div class="main_menu_bg"><a href="<?php echo U('index/Index/exchange');?>"><img src="/Public/ybt/image/icon-huobi@2x.png"><span style="color:#fff">货币转换</span></a>-->

			<!--</div>-->
			
			<!--<div class="main_menu_bg"><a href="<?php echo U('index/index/applylist#c');?>"><img src="/Public/ybt/image/new/order.png"><span>我的订单</span></a>-->

			<!--</div>-->

			<!--<div class="main_menu_bg"><a href="javascript:layer.open({content: '敬请期待',skin: 'msg',time: 2});"><img src="/Public/ybt/image/icon-kefu@2x.png"><span style="color:#fff">客服</span></a>-->

			<!--</div>-->

		</div>




		<div class="row" style="width:95%;border-radius:5px;margin:10px auto;margin-top:0;">

			<div class="main_now_tab">

				<!--<div class="now_title">矿机租赁</div>-->
				<div class="jye">
				    <p>累计交易额 （USTD)</p>
				    <p style="font-size:24px;text-align:center;color:#5597F4"><?php echo ($transaction); ?></p>
				</div>
				<div class="jye" style="position:absolute;margin-left:50%;margin-top:-22%">
				    <p>累计交易量 （单）</p>
				    <p style="font-size:24px;text-align:center;color:#5597F4"><?php echo ($count); ?></p>
				</div>
				<div class="content-padded lobby-nav">
					<div style="height:30px;width:100%;line-height:30px;color:#0A294F;font-size:20px;text-align:center;margin-top:10%"><a><img style="height:1.2rem;margin-right:5px;transform: rotate(-180deg); " src="/Public/ybt/image/69.png"  /></a>News information<a><img style="height:1.2rem;margin-left:5px;" src="/Public/ybt/image/69.png"  /></a></div>
					<?php if(is_array($news)): foreach($news as $key=>$vo): ?><a style="width:100%" href="/index/account/gongdetail?id=<?php echo ($vo["id"]); ?>">
						<li class="li-css" style="height:120px">
							<div style="float:left;width:60%;">
								<div style="height:50px;line-height:25px;font-size:14px"><p class="news-title"><?php echo ($vo["title"]); ?></p></div>
								<div style="height:20px;font-size:12px;line-height:20px;color:#3A83F6;margin-top:20px"><?php echo (date("m-d H:i:s",$vo["addtime"])); ?></div>
							</div>
							<div style="float:right;width:37%;height:60px;overflow:hidden;margin-left:3%">
								<img style="height:100%;float:right;border-radius:5px" src="<?php echo ($vo["cover"]); ?>" />
							</div>
						</li>
						</a><?php endforeach; endif; ?>

				</div>

			</div>

		</div>

	</div>




	<nav class="foot-bar">

		<div class="foot-menu"><a href="<?php echo U('Index/Emoney/shouye');?>" style="color:#5d93ea">
			<i class="iconfont icon-shouye"></i><span>Home</span></a></div>
			
		<div class="foot-menu"><a href="<?php echo U('Index/Shop/index');?>">

			<i class="iconfont icon-share"></i><span>Hire</span></a></div>

		<!--<div class="foot-menu"><a href="javascript:layer.open({content: '敬请期待',skin: 'msg',time: 2});">-->

		<!--	<i class="iconfont icon-gouwuche"></i><span>交易中心</span></a></div>-->

		<div class="foot-menu"><a href="/">

			<i class="iconfont icon-all"></i><span>Mine</span></a></div>

	</nav>

</div>



<script type="text/javascript" src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.js"></script>
<script type="text/javascript" src="/Public/ybt/js/layer/mobile/layer.js"></script>

<script type="text/javascript">

    TouchSlide({

        slideCell:"#slideBox",

        titCell:"#slideBox .hd ul",

        mainCell:"#slideBox .bd ul",

        effect:"leftLoop",

        autoPage:true,

        autoPlay:true,

        interTime:3000



    });

</script>
<script type="text/javascript">
	$('#qiandao').click(function () {
		$.post('/Index/Shop/qiandao','',function (response) {
			$data = JSON.parse(response);
			if ($data.success == 0) {
				//弹出错误提示
				layer.open({
					content: $data.msg
					,skin: 'msg'
					,time: 2 //2秒后自动关闭
				});
			} else if ($data.success == 1) {
				//成功
				layer.open({
					content: $data.msg
					,skin: 'msg'
					,time: 2 //2秒后自动关闭
				});
			}
		})
	});
	
	function buy(e,id) {
		if(!id) {
			layer.open({
				content: '参数错误'
				,skin: 'msg'
				,time: 2 //2秒后自动关闭
			});
		}
		$.post('/index/shop/buy',{id:id},function(response){
			$data = JSON.parse(response);
			if ($data.success == 0) {
				//弹出错误提示
				layer.open({
					content: $data.msg
					,skin: 'msg'
					,time: 2 //2秒后自动关闭
				});
			} else if ($data.success == 1) {
				//成功
				layer.open({
					content: $data.msg
					,skin: 'msg'
					,time: 2 //2秒后自动关闭
				});
				setTimeout(function(){
                    window.location.href = $data.data.url;
                },2000);
			}
		});
	}
</script>
<script>
	var width = document.body.clientWidth;
	var height = document.body.clientHeight;
	var bili = width / height;
	function getNaturalWidth(imgsrc) {
	    var image = new Image();
	    image.src = imgsrc;
	    var naturalWidth = image.width;
	    var naturalHeight = image.height;
	    var bili = naturalWidth / naturalHeight;
	    return bili;
	}
	var realBili = getNaturalWidth('/Public/ybt/image/bg_index@2x.png');
	if(realBili > bili) {
		//高取全屏
		$('body').css('background-size','auto 100%');
	} else {
		//宽取全屏
		$('body').css('background-size','100% auto');
	}
</script>
<script type="text/javascript">
		<!--水平切换  -->
		var mySwiper = new Swiper('#case1', {
			autoplay: true,//可选选项，自动滑动
			initialSlide :1,//默认显示第二张图片索引从0开始
			speed:2000,//设置过度时间
			/* grabCursor: true,//鼠标样式根据浏览器不同而定 */
			 autoplay : {
				delay:3000
			  },                 /*  设置每隔3000毫秒切换 */
			// <!-- 分页器 -->
			 pagination: {
				  el: '.swiper-pagination',
				  clickable :true,
				},
			// <!-- 导航按钮 上一页下一页 -->
			 navigation: {
				  nextEl: '.swiper-button-next',
				  prevEl: '.swiper-button-prev',
				},
			// <!-- 滚动条 -->
			 scrollbar: {
				  el: '.swiper-scrollbar',
				  hide:true,
				},
			/*  设置当鼠标移入图片时是否停止轮播*/
			autoplay: {
				disableOnInteraction: false,
			  },
		});
		 /* 垂直切换 */
		var mySwiper2 = new Swiper("#case2",{
			direction : 'vertical', //垂直轮播
			autoplay: true,//可选选项，自动滑动
			initialSlide :1,//默认显示第二张图片索引从0开始
			speed:2000,//设置过度时间
			/* grabCursor: true,//鼠标样式根据浏览器不同而定 */
			 autoplay : {
				delay:3000
			  },                 /*  设置每隔3000毫秒切换 */
			// <!-- 分页器 -->
			 pagination: {
				  el: '.swiper-pagination',
				  clickable :true,
				},
			// <!-- 导航按钮 上一页下一页 -->
			 navigation: {
				  nextEl: '.swiper-button-next',
				  prevEl: '.swiper-button-prev',
				},
			// <!-- 滚动条 -->
			 scrollbar: {
				  el: '.swiper-scrollbar',
				  hide:true,
				},
		});
		/* 视差轮播 */
		var mySwiper3 = new Swiper("#case3",{
			loop : true,       //允许从第一张到最后一张，或者从最后一张到第一张  循环属性
			parallax : true,//视差位移动画
			autoplay: true,//可选选项，自动滑动
			initialSlide :0,//默认显示第二张图片索引从0开始
			speed:2000,//设置过度时间
			/* grabCursor: true,//鼠标样式根据浏览器不同而定 */
			 autoplay : {
				delay:3000
			  },                 /*  设置每隔3000毫秒切换 */
			// <!-- 分页器 -->
			 pagination: {
				  el: '.swiper-pagination',
				  clickable :true,
				},
			// <!-- 导航按钮 上一页下一页 -->
			 navigation: {
				  nextEl: '.swiper-button-next',
				  prevEl: '.swiper-button-prev',
				},
			// <!-- 滚动条 -->
			 scrollbar: {
				  el: '.swiper-scrollbar',
				  hide:true,
				},
		});
	    /* 幻灯片轮播*/
	    var mySwiper4 = new Swiper("#case4",{
		loop : true,       //允许从第一张到最后一张，或者从最后一张到第一张  循环属性
	    slidesPerView :3,   // 设置显示三张
	    centeredSlides : true,     //使当前图片居中显示
	    centeredSlidesBounds: true,    //使左右两边的图片始终贴合边缘
		/* slidesOffsetBefore : 100,  //偏移，使第一张图片向右偏移100px */
	   	autoplay: true,//可选选项，自动滑动
	   	initialSlide :0,//默认显示第二张图片索引从0开始
	   	speed:2000,//设置过度时间
	   	/* grabCursor: true,//鼠标样式根据浏览器不同而定 */
	   	 autoplay : {
	   		delay:1000
	   	  },                 /*  设置每隔3000毫秒切换 */
	   	// <!-- 分页器 -->
	   	 pagination: {
	   		  el: '.swiper-pagination',
	   		  clickable :true,
	   		},
	   	// <!-- 导航按钮 上一页下一页 -->
	   	 navigation: {
	   		  nextEl: '.swiper-button-next',
	   		  prevEl: '.swiper-button-prev',
	   		},
	   	// <!-- 滚动条 -->
	   	 scrollbar: {
	   		  el: '.swiper-scrollbar',
	   		  hide:true,
	   		},
	   });
		/*渐变轮播 */
	    var mySwiper = new Swiper('#case5', {
			loop : true,        //允许从第一张到最后一张，或者从最后一张到第一张  循环属性
			parallax : true,   //视差位移动画
			effect : 'fade',  //轮播效果，fade渐变
	    	autoplay: true,  //可选选项，自动滑动
	    	initialSlide :1,//默认显示第二张图片索引从0开始
	    	speed:3000,//设置过度时间
	    	/* grabCursor: true,//鼠标样式根据浏览器不同而定 */
	    	 autoplay : {
	    		delay:3000
	    	  },                 /*  设置每隔3000毫秒切换 */
	    	// <!-- 分页器 -->
	    	 pagination: {
	    		  el: '.swiper-pagination', 
	    		  clickable :true,        /* 可点击切换 */
				  dynamicBullets: true,   /* 动力球样式 */
	    		},
	    	// <!-- 导航按钮 上一页下一页 -->
	    	 navigation: {
	    		  nextEl: '.swiper-button-next',
	    		  prevEl: '.swiper-button-prev',
	    		},
	    	// <!-- 滚动条 -->
	    	 scrollbar: {
	    		  el: '.swiper-scrollbar',
	    		  hide:true,
	    		},
	    	/*  设置当鼠标移入图片时是否停止轮播*/
	    	autoplay: {
	    		disableOnInteraction: false,
	    	  },
			  
	    });
	    /* 立方轮播 */
	    var mySwiper = new Swiper('#case6', {
			keyboard : true,     //启用键盘左右切换
			loop : true,        //允许从第一张到最后一张，或者从最后一张到第一张  循环属性
			parallax : true,   //视差位移动画
	    	effect : 'cube',  //轮播效果，cube立方轮播
	    	autoplay: true,  //可选选项，自动滑动
	    	initialSlide :0,//默认显示第二张图片索引从0开始
	    	speed:3000,//设置过度时间
	    	/* grabCursor: true,//鼠标样式根据浏览器不同而定 */
	    	 autoplay : {
	    		delay:3000
	    	  },                 /*  设置每隔3000毫秒切换 */
	    	// <!-- 分页器 -->
	    	 pagination: {
	    		  el: '.swiper-pagination', 
	    		  clickable :true,        /* 可点击切换 */
	    		  dynamicBullets: true,   /* 动力球样式 */
	    		},
	    	// <!-- 导航按钮 上一页下一页 -->
	    	 navigation: {
	    		  nextEl: '.swiper-button-next',
	    		  prevEl: '.swiper-button-prev',
				  hideOnClick: true,
	    		},
	    	// <!-- 滚动条 -->
	    	 scrollbar: {
	    		  el: '.swiper-scrollbar',
	    		  hide:true,
	    		},
	    	/*  设置当鼠标移入图片时是否停止轮播*/
	    	autoplay: {
	    		disableOnInteraction: false,
	    	  },
		  /* 立方轮播属性 */
			cubeEffect: {
				slideShadows: true,
				shadow: true,
				shadowOffset: 100,
				shadowScale: 0.6
				},
	    });
	   /* 覆盖流3d切换 */
		var mySwiper = new Swiper('#case7', {
	    	loop : true,        //允许从第一张到最后一张，或者从最后一张到第一张  循环属性
	    	effect : 'coverflow',  //轮播效果，coverflow覆盖流效果
			slidesPerView :2, 
			centeredSlides: true,
	    	autoplay: true,  //可选选项，自动滑动
	    	initialSlide :1,//默认显示第二张图片索引从0开始
	    	speed:3000,//设置过度时间
	    	/* grabCursor: true,//鼠标样式根据浏览器不同而定 */
	    	 autoplay : {
	    		delay:3000
	    	  },                 /*  设置每隔3000毫秒切换 */
	    	// <!-- 分页器 -->
	    	 pagination: {
	    		  el: '.swiper-pagination', 
	    		  clickable :true,        /* 可点击切换 */
	    		  dynamicBullets: true,   /* 动力球样式 */
	    		},
	    	// <!-- 导航按钮 上一页下一页 -->
	    	 navigation: {
	    		  nextEl: '.swiper-button-next',
	    		  prevEl: '.swiper-button-prev',
	    		},
	    	// <!-- 滚动条 -->
	    	 scrollbar: {
	    		  el: '.swiper-scrollbar',
	    		  hide:true,
	    		},
	    	/*  设置当鼠标移入图片时是否停止轮播*/
	    	autoplay: {
	    		disableOnInteraction: false,
	    	  },
	    	  coverflowEffect: {
	    	      rotate: 30,
	    	      stretch: 10,
	    	      depth: 60,
	    	      modifier: 2,
	    	      slideShadows : true
	    	    },
	    });
	   /* 翻转效果轮播 */
	   var mySwiper = new Swiper('#case8', {
		zomm :true,         //变焦属性，可以放大图片
	   	loop : true,        //允许从第一张到最后一张，或者从最后一张到第一张  循环属性
	   	effect : 'flip',  //轮播效果，flip翻转效果
	   	slidesPerView :2, 
	   	centeredSlides: true,
	   	autoplay: true,  //可选选项，自动滑动
	   	initialSlide :1,//默认显示第二张图片索引从0开始
	   	speed:3000,//设置过度时间
	   	/* grabCursor: true,//鼠标样式根据浏览器不同而定 */
	   	 autoplay : {
	   		delay:3000
	   	  },                 /*  设置每隔3000毫秒切换 */
	   	// <!-- 分页器 -->
	   	 pagination: {
	   		  el: '.swiper-pagination', 
	   		  clickable :true,        /* 可点击切换 */
	   		  dynamicBullets: true,   /* 动力球样式 */
	   		},
	   	// <!-- 导航按钮 上一页下一页 -->
	   	 navigation: {
	   		  nextEl: '.swiper-button-next',
	   		  prevEl: '.swiper-button-prev',
	   		},
	   	// <!-- 滚动条 -->
	   	 scrollbar: {
	   		  el: '.swiper-scrollbar',
	   		  hide:true,
	   		},
	   	/*  设置当鼠标移入图片时是否停止轮播*/
	   	autoplay: {
	   		disableOnInteraction: false,
	   	  },
	   	  coverflowEffect: {
	   	      rotate: 30,
	   	      stretch: 10,
	   	      depth: 60,
	   	      modifier: 2,
	   	      slideShadows : true
	   	    },
	   });
	</script>
</body></html>