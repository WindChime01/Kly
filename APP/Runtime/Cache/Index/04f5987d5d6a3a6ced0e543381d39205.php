<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    <meta name="robots" content="noindex,nofollow">    <meta name="robots" content="noarchive">    <!-- 屏蔽-->    <title>雇佣列表</title>    <meta name="keywords" content=" ">    <meta name="viewport" content="initial-scale=1, maximum-scale=1">    <meta name="apple-mobile-web-app-capable" content="yes">    <meta name="apple-mobile-web-app-status-bar-style" content="black">    <meta content="IE=9; IE=EDGE" http-equiv="X-UA-Compatible">    <link rel="stylesheet" href="/Public/ybt/css/sm.css">    <script src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.min.js"></script>    <link rel="stylesheet" href="/Public/ybt/css/sm-extend.css">    <link rel="stylesheet" href="/Public/ybt/css/iconfont.css">    <!--自定义-->    <link rel="stylesheet" href="/Public/ybt/css/main.css">    <link rel="stylesheet" href="/Public/ybt/css/order.css">    	<link rel="stylesheet" href="/Public/ybt/css/layui.css"></head><style>	.content{		height:100%;		width:100%;		padding-bottom: 0;	}		.top_bg{		background: #253057;		width:100%;		height:125px;		position: fixed;		top:0;		left:0;		opacity: 1;		z-index: 999;	}		.coin-div{		overflow: hidden;		border-radius:15px;		width:90%;		height:auto;		background: #253057;		margin:0 auto;		margin-top: 20px;		color:#fff;		position: relative;	}		.font-div{		padding:15px 20px;		position: relative;	}		.coin-type{		width:100%;		margin-bottom: 20px;	}		.coin{		font-size: 16px;		margin-bottom:5px;	}		.coin-detail{		color:#D6D6D6;		font-size: 16px;		margin-bottom:5px;		opacity:0.8;		word-wrap:break-word;	}		.arrow{		width:9px;		height:16px;		margin-left: 10px;	}		.profit{		height:25px;		line-height: 25px;		display: inline-block;		width:100%;		font-size: 14px;	}		.profit ul li{		width:50%;		display: inline-block;		float: left;		position: relative;	}	.profit ul li span{		margin-left: 25px;		opacity: 0.8;	}	.profit ul li .money{		top:50%;		margin-top: -8.5px;		width:17px;		height:17px;		left: 0;		position: absolute;	}		.right{		position: absolute;		right:20px;		top:20px;		width:60px;		height:23px;		background: url('/Public/ybt/image/center/right-icon.png');		background-size: 100% 100%;		line-height: 23px;	}		.right img{		width:12px;		height:12px;		position: absolute;		top:50%;		margin-top: -6px;		left:10px;	}		.right span{		font-size: 14px;		margin-left:30px;		opacity:0.8;	}		.top-div{		width:100%;		height:auto;		position: fixed;		top:0;		z-index: 999;		background: transparent;	}		#cancle{		position: absolute;		left:20px;		top:35%;		margin-top: -9px;		color:#fff;	}		.top-title{		padding:5px 20px;		width:100%;		line-height: 36px;		font-size: 14px;		background: #323E65;	}		.top-title .top-time{		color:#C2C7E4;		float: left;		font-size: 16px;	}		.top-title .top-tip{		color:#3A83F6;		float: right;		font-size: 17px;	}		@media screen and (min-width:320px){		.coin-detail span{			color:#4099FC;			display: block;			margin-top: 5px;		}	}		@media screen and (min-width:375px){		.coin-detail span{			color:#4099FC;			display: block;		}	}		.appeal{		line-height: 20px;		position: absolute;		right:20px;		top:50px;		background:#3A83F6;		border: none;		border-radius: 15px;		border-top-left-radius: 5px;		font-size: 15px;		padding:3px 20px;	}		/*.layui-layer{*/	/*	top:50%!important;*/	/*	left:50%!important;*/	/*	transform: translate(-50%,-50%)!important;*/	/*}*/		.layui-btn{		margin: 0 5px;	}		.layui-tab{		margin:70px 0 20px;	}		.layui-tab-title{		border:none;		width:100%;		position: fixed;		z-index:999;	}		.layui-tab-title li{		width:50%;		color:#D6D6D6;		font-size: 0.8rem;	}		.layui-tab-brief>.layui-tab-title .layui-this{		color:#fff;	}		.layui-tab-brief>.layui-tab-title .layui-this:after{		width:20px;		left:50%;		margin-left: -10px;		height:5px;		background: #fff;		border-radius: 30px;		top:unset;		bottom:0;	}		.foot-bar .foot-menu span{		padding:1px 0 0 0;	}	.showimg{		display: none;		width: 300px;		position: fixed;		top:50%;		left:50%;		z-index: 10002;		transform: translate(-50%,-50%);	}	.shade{		position: absolute;		top: 0;		left: 0;		width: 100%;		height: 2000px;		background-color:rgba(0,0,0,0.5);		display: none;		z-index: 10001;	}	.layui-tab-content{		padding:30px 0 0;		position: fixed;		top: 100px;		height: calc(100% - 102px);		width: 100%;		overflow-y: scroll;	}		.detail-title{		color:#C2C7E4;	}</style><body><!-- Main Container start --><div class="page">	<div class="content" id="main_content">		<div class="top_bg"></div>	<!-- 标题栏 -->		<div class="top-div">		<a style="width: 100%;text-align: center;display: inline-block;line-height: 60px;height:90px;font-size: 0.85rem; color:#FFF;">雇佣列表</a>	    <a id="cancle" href="javascript:history.back(-1)"><i class="icon icon-left"></i></a>		</div>		<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">		  <ul class="layui-tab-title">		    <!--<li class="layui-this" lay-id="h">货币转换</li>-->		    <li class="layui-this" lay-id="c">充值</li>		    <li lay-id="w">提现</li>		    <li lay-id="s">申请</li>		  </ul>		  		  <!--货币转换申请列表-->		  <div class="layui-tab-content">		  			  	<!--提现申请列表-->		  	<div class="layui-tab-item" id="charge">		  	</div>		  			  	<!--充值申请列表-->		  	<div class="layui-tab-item" id="withdrawal">		  	</div>		  			  	<!--申请列表-->		  	<div class="layui-tab-item" id="shenqing">		  	</div>		  	<div id="no-more" style="text-align: center;color:#ccc;font-size:12px;line-height:2rem">加载中</div>		  </div>		  		</div>      	</div></div><script src="/Public/ybt/js/layui.js"></script><script>	var page = 1;	var lock = 0;	var tabindex = "#c";	var upload;	var element;	var layer;	// showlist("charge",page);	layui.use(["upload",'element','layer'],function(){		upload = layui.upload		,element = layui.element		,layer = layui.layer;			element.on('tab(docDemoTabBrief)', function(data){			page = 1;			if(data.index == 0){				lock = 0;				tabindex = "#c";				showlist("charge",page);			}else if(data.index == 1){				lock = 0;				tabindex = "#w"				showlist("withdrawal",page);			}else if(data.index == 2){				lock = 0;				tabindex = "#s"				showlist("shenqing",page);			}			$("#no-more").html("加载中");		});		if (tabindex == "#c"){			element.tabChange('docDemoTabBrief', 'c');			// lock = 0;			// showlist("charge",page);		}else if (tabindex == "#w"){			element.tabChange('docDemoTabBrief', 'w');			// lock = 0;			// showlist("withdrawal",page);		}else if (tabindex == "#s"){		    element.tabChange('docDemoTabBrief','s');		}	});		$(".layui-tab-content").on("scroll",function(){		var scrollTop = $(this).scrollTop();		var scrollHeight = $(".layui-tab-item.layui-show").height();		var windowHeight = $(this).height();		if (scrollTop + windowHeight >= scrollHeight){			if (tabindex == "#c"){				showlist("charge",page+1);			}else if (tabindex == "#w"){				showlist("withdrawal",page+1);			}else if (tabindex == "#s"){				showlist("shenqing",page+1);			}		}	})		function showimg(img){		$(".showimg").find("img").attr("src",img);		$(".showimg").fadeIn("fast");		$(".shade").fadeIn("fast");	}		function closeimg(){		$(".showimg").fadeOut("fast");		$(".shade").fadeOut("fast");	}		$(".shade").click(function(){		$(".showimg").fadeOut("fast");		$(".shade").fadeOut("fast");	})		function showlist(thelist,p){		if (lock == 1) return false;		page = p;		lock = 1;		var html = '';		switch (thelist){			case "charge":				$.get("/index/add/gy_list",{list:thelist,page:p},function(res){					if (!res){						if (p == 1){							$("#no-more").html("暂无记录");						}else{							$("#no-more").html("到底了");							lock = 1;						}						return false;					}										for (var i = 0;i < res.length;i++){						html += '<div class="coin-div"><div class="top-title" ><span class="top-time" style="margin-left:60%;position:absolute"">'+res[i].createtime+'</span><span class="detail-title" >币种：</span>'+res[i].coin+'</p><br>';						html += '<p class="coin"><span class="detail-title">雇佣天数：</span>'+res[i].hire_day+'</p><p class="coin"><p class="coin"><span class="detail-title">金额：</span>'+res[i].amount+'</p>'						if (res[i].status == 0){							html += '<button class="appeal" style="margin-top:20%" onclick="wchexiao('+res[i].id+')">进行中</button>'						}else if (res[i].status == 1){							html += '<button class="appeal" style="margin-top:20%" onclick="wshensu('+res[i].id+')">已完成</button>'						}else if (res[i].status == 2){							html += '<button class="appeal" style="margin-top:20%" onclick="wshensu('+res[i].id+')">已取消</button>'						}						html += '</div></div>'					}					if (page != 1){						$("#charge").append(html);					}else{						$("#charge").html(html);					}					if (res && res.length < 5){						$("#no-more").html("到底了");					}					lock = 0;				})				break;			case "withdrawal":				$.get("/index/index/applylist",{list:thelist,page:p},function(res){					if (!res){						if (p == 1){							$("#no-more").html("暂无记录");						}else{							$("#no-more").html("到底了");							lock = 1;						}						return false;					}					for (var i = 0;i < res.length;i++){						if (res[i].bi == "ipfs"){							html += '<div class="coin-div"><div class="top-title"><span class="top-time">'+res[i].addtime+'</span><span class="top-tip">'+res[i].zhuangtai+'</span></div><div class="font-div"><p class="coin"><span class="detail-title">提 币：</span>'+res[i].number+'FIL</p><p class="coin"><span class="detail-title">数 量：</span>'+res[i].total+'</p>'						}else if (res[i].bi == "yuanqi"){							html += '<div class="coin-div"><div class="top-title"><span class="top-time">'+res[i].addtime+'</span><span class="top-tip">'+res[i].zhuangtai+'</span></div><div class="font-div"><p class="coin"><span class="detail-title">提 现：</span>'+res[i].number+'元气值</p><p class="coin"><span class="detail-title">金 额：</span>￥'+res[i].total+'</p>'						}												if (res[i].image != ""){							var image = '<span onclick="showimg(\''+res[i].image+'\')">查看图片> </span>';						}else{							var image = "";						}						if (res[i].status == 0){							html += '<p class="coin-detail">状态：审核中，请耐心等待。</span></p><button class="appeal" onclick="wchexiao('+res[i].id+')">撤销</button>'						}else if (res[i].status == 1){							html += '<p class="coin-detail">状态：转换成功-'+res[i].remark+' '+image+'</p><button class="appeal" onclick="wshensu('+res[i].id+')">申诉</button>'						}else if (res[i].status == 2){							html += '<p class="coin-detail">状态：转换失败-'+res[i].remark+' '+image+'</p><button class="appeal" onclick="wshensu('+res[i].id+')">申诉</button>'						}else if (res[i].status == 4){							html += '<p class="coin-detail">状态：申诉中 '+image+'</span></p>'						}else if (res[i].status == 5){							html += '<p class="coin-detail">状态：已处理申诉 '+image+' </span></p>'						}						html += '</div></div>'					}					if (page != 1){						$("#withdrawal").append(html);					}else{						$("#withdrawal").html(html);					}					if (res && res.length < 5){						$("#no-more").html("到底了");					}					lock = 0;				})				break;		}	}		function cshow(id,image,obj){		$("#cshow").find("img").attr("src",image);		layer.open({			title:"查看",			type:1,			content: '<div style="margin:15px"><div><img id="reuploadimg" src="'+image+'" style="width:100%;margin-bottom:15px" onclick="closeimg()"></div><div style="text-align:center"><button class="layui-btn" id="reuploadclick">修改截图</button></div></div>',			btn:false,			area: "85%",			isOutAnim:false,			success: function(i,layero){				upload.render({					elem: "#reuploadclick" //绑定元素					,url: '/index/index/reuploadimg' //上传接口					,data: {id:id}					,done: function(res){						if (res.result == 1){							$("#reuploadimg").attr("src",res.path);							$(obj).attr("onclick","cshow("+id+",'"+res.path+"')");							$("#layui-layer"+layero).css({'top':"50%","left":"50%","transform":"translate(-50%,-50%)"})						}						layer.msg(res.msg);					}				});			}		})	}		function cchexiao(id){		layer.confirm("确定要撤销此次充值吗？",function(i,v){			$.post("/index/yuanqi/chexiao",{id:id,type:"charge"},function(res){				layer.closeAll();				layer.msg(res.msg,{time:1500},function(){					if (res.success == 1){						window.location.reload();					}				});			})		})	}		function wchexiao(id){		layer.confirm("确定要取消雇佣吗？",function(i,v){			$.post("/index/add/gy_qx",{id:id,type:"withdrawal"},function(res){				layer.closeAll();				layer.msg(res.msg,{time:1500},function(){					if (res.success == 1){						window.location.reload();						element.tabChange('docDemoTabBrief', 'c')					}				});			})		})	}		function cshensu(id){		layer.prompt({			formType: 2,			title: '请输入申诉内容',			area: ['250px', '150px'] //自定义文本域宽高		}, function(value, index, elem){			$.post("/index/yuanqi/shensu_post",{id:id,shensu:value,type:"charge"},function(res){				layer.close(index);				layer.msg(res.msg,{time:1500},function(){					if (res.success == 1){						window.location.reload();					}				});			})		});	}			function eshensu(id){		layer.prompt({			formType: 2,			title: '请输入申诉内容',			area: ['250px', '150px'] //自定义文本域宽高		}, function(value, index, elem){			$.post("/index/yuanqi/shensu_post",{id:id,shensu:value,type:"exchange"},function(res){				layer.close(index);				layer.msg(res.msg,{time:1500},function(){					if (res.success == 1){						window.location.reload();					}				});			})		});	}</script></body></html>