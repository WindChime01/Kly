<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- saved from url=(0041)http://porter.weiyinstudio.com/Home/Index/jbmx/ -->

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



    <meta name="robots" content="noindex,nofollow">

    <meta name="robots" content="noarchive">

    <!-- 屏蔽-->

    <title>推广海报</title>

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

    <style type="text/css">
		*{margin:0};

        #middle{width:100%;height:200px;float:left;}
		.page{}
		.logo a{margin-top:15px;}
    </style>
	<style type="text/css">

        body{ background: #FFF;}

        .li_touxiang img {

            width: 80px;

            height: 80px;

            border-radius: 50%;

        }

		.button-box{width: 90%;height: 2.5rem;background:url('/Public/ybt/image/button@2x.png') no-repeat top center;background-size:100% 100%;margin: auto;}
        .button-box a{display:block;width:100%; margin: auto;text-align:center;line-height:2.5rem;color:#fff;font-size:0.8rem}

		.big-div{background:#C8E1FF;border-radius:10px;width:80%;margin:60px 10% 20px 10%;height:100px;text-align:center;position:relative;}
		.big-div p{margin-bottom:15px;}
		.headimg{width:72px;height:72px;border-radius:50%;position:absolute;left:50%;margin-left:-37px;
			top:-37px;z-index: 999;}
		.bg-circle{width:60px;height:60px;border-radius:50%;position:absolute;left:50%;margin-left:-30px;
			top:-30px;z-index: 889;background:#5DA7F8;}
		.saveimg{width:80%;border-radius:30px;border-top-left-radius:10px;background-image:linear-gradient(to right,#6DB8F9,#3A83F6);color:#fff;font-size:20px;text-align:center;height:50px;line-height:50px;margin:0 auto;}
		#ta{background:none;border:none;height:20px;width:100px;resize:none;vertical-align:middle;}
    </style>
</head>

<body style="">



<div class="page" id="my-page" style="background:url('/Public/ybt/image/new/tg-bg.png');background-size:100% 100%;">



    <!-- 标题栏 -->

    <header class="bar bar-nav">



        <a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 70px;font-size: 0.85rem; color:#FFF;">推广海报</a>    <div class="logo">

        <a id="cancle" href="javascript:history.go(-1)"><i class="icon icon-left"></i></a>    </div>

        <a class="icon pull-right open-panel"></a>

    </header>



<div class="content" id="main_content" style="margin:0">



    
	
    <div class="big-div" style="display:none">
    	<div class="bg-circle"></div>
    	<!--<img class="headimg" src="/Public/ybt/image/new/price-bg.png">-->
    	<img class="headimg" src="/Public/ybt/image/user2.png">
    	<p style="color:#000;margin-top:40px;display:inline-block;"><?php echo (session('username')); ?></p>
		<p style="color:#000;"><span>推广码：</span><textarea id="ta" readonly><?php echo ($tgm); ?></textarea><span style="color:#3A83F6;" onclick="copyArticle();" id="copy">复制</span></p>
    	
	
		<!--<span id="tjbd_text"><a class="button button-big button-fill button-danger js-tixian-submit" onclick="copyArticle();" style="width: 90%;margin: auto;font-size: 0.7rem">复制推广链接</a></span>-->
		<div class="saveimg" id="saveimg">生成图片</div>
    </div>
    <img style="height:60px;position:fixed;top:50px;right:20px" src="/Public/ybt/image/new/logo.png" />
	<img id="sharedImg" src="<?php echo ($erwei); ?>" style="position:fixed;bottom:0;left:1rem;width:100px;margin: auto;border-radius:10px;margin-top:100px;margin-bottom:20px">
</div>

</div>
<div id="my-black" style="width:100%;height:100%;background:black;opacity:0.5;position:fixed;z-index:101;display:none"></div>
<div id="camera" style="width:80%;height:80%;position:fixed;z-index:9999;top:10%;left:10%;display:none;border-radius:10px;overflow:hidden">
	<img id="downimg" src="" style="height:100%;width:100%" />
</div>

<script type="text/javascript" src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.js"></script>
<script type="text/javascript" src="/Public/ybt/js/layer/mobile/layer.js"></script>
<script src="/Public/ybt/js/htmlcanvas.js"></script>
<script type="text/javascript">
    $imgsrc = "<?php echo ($bgpath["path"]); ?>";
    // console.log($imgsrc);
    $('.page').css('background','url('+ $imgsrc +')');
    $('.page').css('background-size','100% 100%');

function jsCopy(){

    // var e=document.getElementById("ta");//对象是copy-num1

    // e.select(); //选择对象

    // document.execCommand("Copy"); //执行浏览器复制命令
    const range = document.createRange();
    range.selectNode(document.getElementById('ta'));
    const selection = window.getSelection();
    if (selection.rangeCount > 0) selection.removeAllRanges();
    selection.addRange(range);
    document.execCommand('copy');
	alert('复制成功');
}

	function copyArticle() {
        if(navigator.userAgent.match(/(iPhone|iPod|iPad);?/i)){
            const range = document.createRange();
            range.selectNode(document.getElementById('ta'));
            const selection = window.getSelection();
            if(selection.rangeCount > 0) selection.removeAllRanges();
            selection.addRange(range);
            document.execCommand('copy');
            layer.msg("复制成功");
        }else{
            //var input = document.createElement('input');
            //input.setAttribute('readonly', 'readonly');
            //input.setAttribute('value','我是复制的内容');
            //document.body.appendChild(input);
            //input.setSelectionRange(0, 9999);
            //input.select();
          	var e=document.getElementById("ta");
            e.select();
            if (document.execCommand('copy')) {
                document.execCommand('copy');
                layer.msg("复制成功");
            }
        }
    }


	



function adapt(){ 

var tableWidth = $("#imgTable").width(); //表格宽度 

var img = new Image(); 

img.src =$('#imgs').attr("src") ; 

var imgWidth = img.width; //图片实际宽度 

if(imgWidth<tableWidth){ 

$('#imgs').attr("style","width: auto"); 

}else{ 

$('#imgs').attr("style","width: 100%"); 

} 

} 

$('#saveimg').click(function(){
	$('.big-div').css('background','none');
	$('#my-black').show();
	html2canvas(document.getElementById('my-page'),{
		scale:2,
        logging:false,
		allowTaint:true,
		// windowWidth:100,
		// windowHeight:100,
        ignoreElements:(element)=>{
        	if(element.id==='saveimg' || element.id==='cancle' || element.id==='copy')
        	return true;
        },
		}).then(function(canvas) {
		    // document.getElementById('camera').appendChild(canvas);
		    // $('canvas').css('width','100%').css('height','100%');
		    $src = saveAsPNG(canvas);
		    $('#downimg').attr('src',$src);
		    $('#camera').show();
		}
	);
});

$('#my-black').click(function(){
	$('.big-div').css('background','#C8E1FF');
	clearTimeout(timeOutEvent);
	$('#my-black').hide();
	$('#camera').hide();
	// $('#downimg').attr('src','');
});

// 保存成png格式的图片
function saveAsPNG(canvas) {
    return canvas.toDataURL("image/png");
}

// var timeout; 
  
// $("body").mousedown(function() { 
//     timeout = setTimeout(function() { 
//         $('#saveimg').click();
//     }, 1000); 
// });

// $("body").mouseup(function() { 
//     clearTimeout(timeout); 
// }); 
// $("body").mouseout(function() { 
//     clearTimeout(timeout);
// }); 
</script>
<script>
var timeOutEvent=0;
$(function(){
    $("#main_content").on({
        touchstart: function(e){
            timeOutEvent = setTimeout("longPress()",1000);
            e.preventDefault();
        },
        touchmove: function(){
            clearTimeout(timeOutEvent);
            timeOutEvent = 0;
        },
        touchend: function(){
            clearTimeout(timeOutEvent);
            if(timeOutEvent!=0){
            	$('.big-div').css('background','#C8E1FF');
				clearTimeout(timeOutEvent);
				$('#my-black').hide();
				$('#camera').hide();
                // alert("你这是点击，不是长按");
            }
            return false;
        }
    })
});
  
  
function longPress(){
    timeOutEvent = 0;
    $('#saveimg').click();
}
  
</script>
</body>

</html>