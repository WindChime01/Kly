<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">	<meta name="robots" content="noindex,nofollow">	<meta name="robots" content="noarchive">	<!-- 屏蔽-->	<title>新闻公告</title>	<meta name="keywords" content="">	<meta name="viewport" content="initial-scale=1, maximum-scale=1">	<meta name="apple-mobile-web-app-capable" content="yes">	<meta name="apple-mobile-web-app-status-bar-style" content="black">	<meta content="IE=9; IE=EDGE" http-equiv="X-UA-Compatible">	<link rel="stylesheet" href="/Public/ybt/css/sm.css">	<script src="/Public/ybt/js/jquery-1.10.2.min.js"></script>	<link rel="stylesheet" href="/Public/ybt/css/sm-extend.css">	<link rel="stylesheet" href="/Public/ybt/css/iconfont.css">	<link rel="stylesheet" href="/Public/ybt/css/main.css">	<link rel="stylesheet" href="/Public/ybt/css/order.css">		<link rel="stylesheet" href="/Public/ybt/css/layui.css">	<!-- 变量声明  -->	<style>				.content-padded{			margin:0.5rem auto;			margin-top: 0;		}				.li-css{			padding:15px 22px;			display: flex;			flex-direction: row;		}				.text-content{			height:100%;			display: inline-block;			flex:1;		}				.text-content p{			margin:10px 0;		}				.img-content{			height:100%;			flex:1;			position: relative;		}				.img-content img{			width:95%;			padding: 10px 0 10px 15px;			position: absolute;			top:-30px;		}		.news-title {			overflow: hidden;			text-overflow: ellipsis;			display: -webkit-box;			-webkit-line-clamp: 2;			-webkit-box-orient: vertical;		}		.top-div{			z-index: 999;			top:0;			width:100%;			height:75px;			background: #253057;			margin-bottom: 0;			position: fixed;		}				#cancle{			position: absolute;			left:22px;			top:50%;			margin-top: -11px;			color:#fff;		}				.icon-left{			font-size: 22px;		}				.gong-one{			width:90%;			background: #253057;			border-radius: 20px;			margin:0 auto;			height:190px;			margin-top: 30px;			padding:20px 30px;		}				.gong-title-p{			width:100%;			height:30px;			line-height: 30px;			margin-bottom: 10px;		}				.gong-title{			color: #fff;			font-size: 20px;			font-weight: bold;			float: left;		}				.gong-time{			float: right;			color: #C2C7E4;			font-size: 15px;		}				.gong-content{			width:100%;			color: rgba(194, 199, 228, 0.8);			font-size: 15px;		}				.content{			margin-top: 75px;			margin-bottom: 0;		}	</style></head><body style=""><div class="page">	<!-- 标题栏 -->	<div class="top-div">		<a style="width: 100%;text-align: center;display: inline-block;line-height: 75px;font-size: 0.9rem; color:#FFF;">新闻公告</a>	    <a id="cancle" href="javascript:history.back(-1)"><i class="icon icon-left"></i></a>	</div>		<div class="content" id="main_content" style="margin-bottom:20px">				<div class="row" style="width:95%;border-radius:5px;margin:10px auto;margin-top:0;">			<div class="main_now_tab">				<!--<div class="now_title">矿机租赁</div>-->				<div class="content-padded lobby-nav" id="detail-list">					<?php if(is_array($news)): foreach($news as $key=>$vo): ?><li class="li-css" style="height:120px" onclick="window.location.href='/index/account/gongdetail?id=<?php echo ($vo["id"]); ?>'">							<div style="float:left;width:60%;">								<div style="height:50px;line-height:25px;font-size:14px"><p class="news-title"><?php echo ($vo["title"]); ?></p></div>								<div style="height:20px;font-size:12px;line-height:20px;color:#3A83F6;margin-top:20px"><?php echo (date("m-d H:i:s",$vo["addtime"])); ?></div>							</div>							<div style="float:right;width:37%;height:60px;overflow:hidden;margin-left:3%">								<img style="height:100%;float:right;border-radius:5px" src="<?php echo ($vo["cover"]); ?>" />							</div>						</li><?php endforeach; endif; ?>					<?php if($news == null): ?><p style="text-align:center;color:#ccc;font-size:12px;line-height:2rem">暂无更多</p><?php endif; ?>				</div>				<div id="no-more" style="text-align: center;color:#ccc;font-size:12px;display:none;line-height:2rem">暂无更多资讯</div>			</div>		</div>	</div></div><script src="/Public/ybt/js/layui.js"></script><script type="text/javascript" src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.js"></script><script type="text/javascript" src="/Public/ybt/js/layer/mobile/layer.js"></script><script type="text/javascript" src="/Public/ybt/js/template-native.js"></script><script type="text/html" id="demo">    <%for(var i=0;i < info.length; i++){%>  	<li class="li-css" style="height:120px" onclick="window.location.href='/index/account/gongdetail?id=<%=info[i].id%>'">		<div style="float:left;width:60%;">			<div style="height:50px;line-height:25px;font-size:14px"><p class="news-title"><%=info[i].title%></p></div>			<div style="height:20px;font-size:12px;line-height:20px;color:#3A83F6;margin-top:20px"><%=getTime(info[i].addtime)%></div>		</div>		<div style="float:right;width:37%;height:60px;overflow:hidden;margin-left:3%">			<img style="height:100%;float:right;border-radius:5px" src="<%=info[i].cover%>" />		</div>	</li>    <%}%></script><script type="text/javascript">	function getFormatDate(date) {		var date = new Date(date);		var YY = date.getFullYear() + '-';		var MM = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';		var DD = (date.getDate() < 10 ? '0' + (date.getDate()) : date.getDate());		var hh = (date.getHours() < 10 ? '0' + date.getHours() : date.getHours()) + ':';		var mm = (date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes()) + ':';		var ss = (date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds());		return MM + DD +" "+hh + mm + ss;	}    $(function(){        template.helper('getTime',function(timer){            return getFormatDate(timer*1000);        });    });	var type = 1;	//1为收入，2为支出	var pagelen = 8;	//单页行数	$lasttime = 0;    $('#main_content').on("scroll", function () {    	        var no_more = document.getElementById('no-more');        if (no_more.style.display != 'block') {            $("#load").show();        }        console.log(Math.ceil($(this).scrollTop()));        console.log($(this).innerHeight());        console.log($(this)[0].scrollHeight);        console.log('------');        if (Math.ceil($(this).scrollTop()) + $(this).innerHeight() >= $(this)[0].scrollHeight) {        	console.log('success');        	$nowtime = Date.parse(new Date()); //1514736000000	        if($nowtime - $lasttime < 200) {	        	return;	//200毫秒内只加载一次	        }	        $lasttime = $nowtime;            var url = "<?php echo U(GROUP_NAME.'/account/newslist');?>";            var len = $('#main_content li').length;            console.log(len);            len = len/pagelen;            console.log(len);            if (len%1 != 0) {            	console.log('show');                $('#load').hide();                $('#no-more').show();                return;            }            console.log(1);            var page = len+1;            var date = $('#date').html();            if(date == '选择日期') {            	date = 0;            }            var select = $("option:selected");            if (select.index() == 0) {            	console.log(2);                $.post(url,{page:page,type:type,date:date},function(res){                    if(res.info==null){                        $('#load').hide();                        $('#no-more').show();                        return;                    }                    var html = template('demo',res);                    $('#detail-list').append(html);                });            }else{            	console.log(3);                $.post(url,{page:page,type:type,date:date,time:select.val()},function(res){                    if(res.info==null){                        $('#load').hide();                        $('#no-more').show();                        return;                    }                    var html = template('demo',res);                    $('#detail-list').append(html);                });             }        }    });</script></body></html>