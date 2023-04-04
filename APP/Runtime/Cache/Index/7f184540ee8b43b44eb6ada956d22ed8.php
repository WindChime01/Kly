<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- saved from url=(0041)http://www.porternew.com/Home/Index/index -->

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



    <meta name="robots" content="noindex,nofollow">

    <meta name="robots" content="noarchive">

    <!-- 屏蔽-->

    <title>矿机详情</title>

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
    
    <link rel="stylesheet" href="/Public/ybt/css/layui.css">

    <script type="text/javascript" src="/Public/ybt/sy/js/TouchSlide.1.1.js"></script>

    <script src="/Public/ybt/js/layer.js"></script>
    <style type="text/css">
    	body{overflow:auto;}
        #my-alert{display: block;width: 100%;height:100%;}
        .my-layer{width: 100%;height: 100%;}
        .product_img{width:100%;overflow: hidden;height:40%;padding:60px 60px 0 60px;}
        .product_img img{width: 100%;height:260px;}
        .gift-im{color:#fff;}
        .gift-im-left{width: 100%;float: left;height: 80%;border-radius: 10px;overflow: hidden;}
        .gift-im-left img{width: 100%;}
        .gift-im-left .gift-title{font-size:0.9rem;line-height:2rem;}
        .gift-im-right{width: 50%;float: right;padding: 10px 2%;height:80%;}
        .gift-im-right .gift-title{font-size: 0.9rem;line-height: 2rem;color: #fff}
        .gift-im-right .gift-detail{font-size: 0.5rem;line-height: 1rem;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;}
        .gift-im-right .gift-ims{font-size: 0.5rem;line-height: 1rem;color: #fff}
        .gift-im-right .ims{color: #f2d347}
        .text-line3{overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;}

        .gift-item-box{width: 100%;overflow: hidden;}
        .gift-item-box p{font-size: 0.5rem}
        .gift-item-box p span{color: #c02929}
        .gift-item{height: 1.3rem;display: inline-block;padding: 0 10px;background: #eee;line-height: 1.3rem;font-size: 0.5rem;margin-top: 10px;margin-right: 10px;border-radius: 5px;border: 1px solid #f6f6f6}
        .my-active{color: #ea482a;border: 1px solid #ea482a;}
        .my-pay-active{color: #ea482a;border: 1px solid #ea482a;}
        .user-im{width: 100%;overflow: hidden;border-top: 1px solid #ccc;margin-top: 20px;padding-top: 20px}
        .user-im p{font-size: 0.5rem}
        .user-im input{margin: 10px 0;border: 1px solid #ccc;height: 1.5rem;line-height: 1.5rem;font-size: 0.5rem;padding: 0 10px;border-radius: 5px;width: 60%}
        .button-box{width: 90%;height: 2.2rem;background-image:linear-gradient(to right,#6DB8F9,#3A83F6);background-size:100% 100%;margin:1rem auto;border-radius:30px;border-top-left-radius:5px;}
        .button-box a{display:block;width:100%; margin: auto;text-align:center;line-height:2.2rem;color:#fff;font-size:0.8rem}
        .lobby-nav li {width: 100%;}

        .product-detail{width: 100%;overflow: hidden;margin-top: 20px;color:#fff}
        .product-detail .else-title{font-size: 0.75rem;line-height: 2rem}
        .product-detail .detail-show{font-size: 0.6rem;line-height: 1rem;color:#C2C7E4;}
        .product-detail .detail-show img{height: auto;width: 50%;margin-bottom: 5px}
        .pay-way-box{height: 1.5rem;overflow: hidden;padding-top: 0.1rem}
        .pay-way{border: 1px solid red;color: #0e696d;text-decoration: none;text-align: center;display: block;border-radius: 0.25rem;line-height: 1.35rem;height: 1.35rem;width: 5rem;float: left}
        .pay-display{display: none}
        .gift-num{}
        .gift-num img{height:1rem}
        .gift-num span{line-height:1rem}
        .logo{height:50px;position:absolute;left:0;top:0;z-index:20;}
        .logo a{height:50px;margin-top:0;padding-top:0;line-height:50px;color:#333;}
        .toper-div{width:100%;height:50px;}
        .content{margin-bottom: 0;background-image:linear-gradient(to bottom,#C3CED5,#9196AC);padding-bottom:0;}
        .detail-content{min-height:60%;background:#252F58;border-top-left-radius:25px;border-top-right-radius:25px;padding:10px 30px;}
        .gift-detail{color:#3A83F6;font-size:16px;line-height:1.5rem;}
        .payway-div{background: #465686;width: 100%;height:auto;border-radius: 10px;margin:0 auto;margin-top: 20px;padding:15px;color:#fff;font-size: 16px;}
		.payway-div p{height: 35px;line-height: 35px;font-size: 14px;}
		.payway-title{color:#fff!important}
		.qrcode-div{width:100px;height:100px;border-radius: 5px;background: #fff;float:left;position: relative;}
		.text-div{color:#eee;width:60%;float: left;height:100%;padding:10px;}
		@media screen and (max-width:320px){.qrcode-div{width:90px;height:90px;}.text-div{width: 65%;}}
		.bao-div{width:100%;height:auto;float: left;margin-top:5px;}
		.bao-div .bao-title{color:#fff;width:90%;margin:5px 0;position: relative;font-size: 16px;}
		.qrcode-div{width:100px;height:100px;border-radius: 5px;background: #fff;float:left;position: relative;}
		.camera{position: absolute;left:50%;margin-left: -16px;margin-top: 30px;width:32px;height:32px;}
		.showimg{display: none;width: 300px;position: fixed;top:50%;left:50%;z-index: 10002;transform: translate(-50%,-50%);}
		.shade{position: absolute;top: 0;left: 0;width: 100%;height: 2000px;background-color:rgba(0,0,0,0.5);display: none;z-index: 10001;}
		#pre-img,#pre-img2{
			width:100%;
			height:100%;
			position: absolute;
			top:0;
			left:0;
			opacity: 0;
			border-radius:5px;
		}
    </style>

</head>

<body style="background: url('/Public/ybt/image/detail_bg@2x.png') no-repeat top center; background-size:auto 100%;">

<!--弹出公告-->

<!--弹出公告-->

<div class="page">
	<div class="toper-div">
	    <a style="position: absolute;z-index: 19;width:100%;text-align: center;display: inline-block;line-height: 50px;font-size: 0.85rem; font-weight:bold;color:#333;">矿机详情</a>    
	    <div class="logo">
	
	    <a id="cancle" href="javascript:history.go(-1)"><i class="icon icon-left"></i></a>    </div>
	
	    <a class="icon pull-right open-panel"></a>
	</div>
    
    <div class="content" id="main_content">

        <div id="my-alert">
            <div class="my-layer">
                <div class="product_img">
                    <img src="<?php echo ($gift_detail["thumb"]); ?>" alt="礼包"/>
                </div>
                <div class="detail-content">
	                <div class="gift-im">
	                    <div class="gift-im-left">
	                        <p class="gift-title"><?php echo ($gift_detail["title"]); ?></p>
	                        <p class="gift-detail">算力:<?php echo ($gift_detail["gonglv"]); ?>T</p>
	                        <p class="gift-detail">租赁人数：<?php echo ($num); ?>
	                        <span style="float:right;line-height:1.5rem;font-weight:600;font-size:1.2rem;color:#F63A3A;margin-bottom:5px">￥<?php echo ($gift_detail["price"]); ?></span></p>
	                    </div>
	                    <!--    <p class="gift-num"><img src="/Public/ybt/image/ic-cut@2x.png" /><span> 1 </span><img src="/Public/ybt/image/ic-add@2x.png" /></p>-->
	                    <div style="clear:both;"></div>
	        		</div>
		            
	                <div class="gift-item-box">
	                    <div class="product-detail" style="margin-top:0">
	                        <div class="else-title">详细介绍</div>
	                        <div class="detail-show"><?php echo ($gift_detail["content"]); ?></div>
	                    </div>
	                </div>
	                <div class="gift-item-box">
	                	<form class="layui-form" style="font-size:14px;color:#fff">
	                		<div class="layui-form-item">
	                		<label class="layui-form-label" style="width:90px">消费方式</label>
		                    <input type="radio" name="paytype" value="yuanqi" title="元气值" lay-filter="type" checked>
		                    <input type="radio" name="paytype" value="erwei" title="现金付款" lay-filter="type">
		                    </div>
		                    <div class="layui-form-item" id="erwei" style="display:none">
								<?php if($address['isshow']['bank'] == 1): ?><div class="payway-div">
									<p><span class="payway-title">转账银行：</span><?php echo ($address["bank"]); ?></p>
									<p><span class="payway-title">银行支行：</span><?php echo ($address["bank_branch"]); ?></p>
									<p><span class="payway-title">银行帐号：</span><?php echo ($address["bank_num"]); ?></p>
									<p><span class="payway-title">收款人：</span><?php echo ($address["bank_name"]); ?></p>
								</div><?php endif; ?>
								<?php if($address['isshow']['bank2'] == 1): ?><div class="payway-div">
									<p><span class="payway-title">转账银行：</span><?php echo ($address["bank2"]); ?></p>
									<p><span class="payway-title">银行支行：</span><?php echo ($address["bank_branch2"]); ?></p>
									<p><span class="payway-title">银行帐号：</span><?php echo ($address["bank_num2"]); ?></p>
									<p><span class="payway-title">收款人：</span><?php echo ($address["bank_name2"]); ?></p>
								</div><?php endif; ?>
								<?php if($address['isshow']['wechat'] == 1): ?><div class="payway-div">
									<div class="qrcode-div" id="wechat">
										<div class="qrcode-image" style="width:100%;height:100%;background-image:url('<?php echo ($address["wechat"]); ?>');background-size:cover;background-position:50%;border-radius:5px" data-src='<?php echo ($address["wechat"]); ?>'></div>
									</div>
									<div class="text-div">
										<p>微信收款码</p>
										<p>用微信扫描二维码</p>
									</div>
									<div style="clear:both;"></div>
								</div><?php endif; ?>
								<?php if($address['isshow']['alipay'] == 1): ?><div class="payway-div">
									<div class="qrcode-div" id="alipay">
										<div class="qrcode-image" style="width:100%;height:100%;background-image:url('<?php echo ($address["alipay"]); ?>');background-size:cover;background-position:50%;border-radius:5px" data-src='<?php echo ($address["alipay"]); ?>'></div>
									</div>
									<div class="text-div">
										<p>支付宝收款码</p>
										<p>用支付宝扫描二维码</p>
									</div>
									<div style="clear:both;"></div>
								</div><?php endif; ?>
								
								<div class="bao-div">
									<div class="bao-title">
										支付凭证
										<div class="stright-line"></div>
									</div>
									
									<div class="payway-div">
										<div class="qrcode-div" id="test2" style="background:transparent;border:1px dashed #8C93AF;">
											<img class="camera" src="/Public/ybt/image/center/paycode/camera.png">
											<img src="" id="pre-img2">
										</div>
										<div class="text-div">
											<p>上传凭证</p>
											<p>请上传有效付款凭证</p>
										</div>
										<div style="clear:both;"></div>
									</div>
								</div>
							</div>
							<input id="upimg" name="image" type="hidden" value="">
	                    </form>
	                </div>
	                
	                
	                <div class="button-box">
	                    <a onclick="buy(<?php echo ($gift_detail["id"]); ?>)" href="javascript:;" class="">立即租赁</a>
	                </div>
	            </div>
            </div>
        </div>
    </div>
</div>

<div class="showimg">
	<img src="" style="width:100%">
</div>
<div class="shade"></div>

<script type="text/javascript" src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.js"></script>
<script src="/Public/ybt/js/layui.js"></script>
<script type="text/javascript">
    function copyArticle() {
        if(navigator.userAgent.match(/(iPhone|iPod|iPad);?/i)){
            const range = document.createRange();
            range.selectNode(document.getElementById('ta'));
            const selection = window.getSelection();
            if(selection.rangeCount > 0) selection.removeAllRanges();
            selection.addRange(range);
            document.execCommand('copy');
            alert("复制成功");
        }else{
            var e=document.getElementById("ta");
            e.select();
            if (document.execCommand('copy')) {
                document.execCommand('copy');
                alert('复制成功');
            }
        }
    }
    var layer;
    var form;
    var confirmtext = "请确认消费<?php echo ($gift_detail["price"]); ?>个元气值租赁该矿机";
    var paytype = "yuanqi";
    layui.use(['layer','form','upload'],function(){
    	layer = layui.layer;
    	form = layui.form;
    	var upload = layui.upload
    	form.on("radio(type)",function(data){
	    	if (data.value == 'yuanqi'){
	    		$("#erwei").hide();
	    		confirmtext = "请确认消费<?php echo ($gift_detail["price"]); ?>个元气值租赁该矿机";
	    	}
	    	if (data.value == "erwei"){
	    		$("#erwei").show();
	    		confirmtext = "请确认消费￥<?php echo ($gift_detail["price"]); ?>租赁该矿机，并付款成功";
	    	}
	    	paytype = data.value;
	    })
	    
	    var upload2 = upload.render({
		    elem: '#test2' //绑定元素
		    ,url: "<?php echo U('Index/shop/uploadfkm');?>" //上传接口
		    ,exts: 'jpg|png|gif|'
		    ,field:'file'
		    ,choose: function(obj){
		    //将每次选择的文件追加到文件队列
				// var files = obj.pushFile();
				//预读本地文件，如果是多文件，则会遍历。(不支持ie8/9)
				// obj.preview(function(index, file, result){
				//   $("#pre-img2").css('opacity','1');
				//   $("#pre-img2").attr("src",result);
				// });
				layer.msg("上传中……",{time:0});
			}
		    ,done: function(res){   //上传完毕回调
		    	layer.closeAll();
		    	if (res.result == 1){
		    		$("#pre-img2").css('opacity','1');
					$("#pre-img2").attr("src",res.path);
		    		$("#upimg").val(res.path);
		    	}
		    	layer.msg(res.msg);	    	
		    }
		});
    })
    
    $(".qrcode-image").click(function(){
		$(".showimg").find("img").attr("src",this.dataset.src);
		$(".showimg").fadeIn("fast");
		$(".shade").fadeIn("fast");
	})
	
	$(".showimg").find("img").click(function(){
		$(".showimg").fadeOut("fast");
		$(".shade").fadeOut("fast");
	})
	
	$(".shade").click(function(){
		$(".showimg").fadeOut("fast");
		$(".shade").fadeOut("fast");
	})
    
    $lock = 1;
    function buy(id) {
    	if($lock != 1) {
    		layer.msg("请勿重复点击");
    	}
    	$lock = 0;
		if(!id) {
			layer.msg('参数错误');
		}
		var upimg = $("#upimg").val();
		if (paytype != "yuanqi" && upimg == ''){
			layer.msg("请上传有效付款凭证");
			return false;
		}
		layer.open({
			title:"确认",
			content: confirmtext,
			btn:["确认","取消"],
			yes: function(){
				$.post('/index/shop/buy',{id:id,paytype:paytype,upimg:upimg},function(response){
					$data = JSON.parse(response);
					if ($data.success == 0) {
						//弹出错误提示
						layer.msg($data.msg);
						if($data.tag == 'jump') {
							setTimeout(function(){
			                    window.location.href = '/index/index/recharge';
			                },1000);
						}
						$lock = 1;
					} else if ($data.success == 1) {
						//成功
						layer.msg($data.msg);
						setTimeout(function(){
		                    window.location.href = $data.data.url;
		                },2000);
		                $lock = 1;
					}
				});
			}
		})
			
		
	}
</script>


</body></html>