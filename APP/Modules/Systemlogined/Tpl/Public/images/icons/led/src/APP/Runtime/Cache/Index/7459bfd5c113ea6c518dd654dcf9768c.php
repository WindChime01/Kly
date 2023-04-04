<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0, user-scalable=no" />
    <link href="/Public/ybt/css/mui.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="/Public/ybt/css/common.css" />
    <link rel="stylesheet" href="/Public/ybt/css/verified.css" />

    <link rel="stylesheet" href="/Public/ybt/css/sm.css">
    <script src="/Public/ybt/js/jquery-1.10.2.min.js"></script>

    <link rel="stylesheet" href="/Public/ybt/css/sm-extend.css">

    <link rel="stylesheet" href="/Public/ybt/css/iconfont.css">
    <!--自定义-->
    <link rel="stylesheet" href="/Public/ybt/css/main.css">
    <link rel="stylesheet" href="/Public/ybt/css/order.css">
    <title>实名认证</title>
</head>
<body style="">

<!-- <div class="page">-->

<!-- 标题栏 -->
<header class="bar bar-nav">

    <a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 1.1rem; color:#FFF;">上传付款截图</a>    <div class="logo">
    <a id="cancle" href="javascript:history.go(-1)"><i class="icon icon-left"></i></a>    </div>
    <a class="icon pull-right open-panel"></a>
</header>
<nav class="foot-bar">
    <div class="foot-menu"><a href="<?php echo U('Index/Emoney/shouye');?>">
        <i class="iconfont icon-shouye"></i><span>首页</span></a></div>
    <div class="foot-menu"><a href="<?php echo U('Index/Shop/orderlist');?>">
        <i class="iconfont icon-wxbmingxingdianpu"></i><span>我的矿机</span></a></div>
    <div class="foot-menu"><a href="<?php echo U('Index/Account/myAccount');?>">
        <i class="iconfont icon-gouwuche"></i><span>我的团队</span></a></div>
    <div class="foot-menu"><a href="<?php echo U('Index/Emoney/index');?>">
        <i class="iconfont icon-wxbdingwei"></i><span>交易平台</span></a></div>
    <div class="foot-menu"><a href="/">
        <i class="iconfont icon-geren"></i><span>会员中心</span></a></div>
</nav>
<div class="content" id="main_content">

    <style type="text/css">
    body{ background: #FFF;}
    .li_touxiang img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
    }
</style>
<form method="post" action="<?php echo U('Emoney/scpost');?>" id="formid" enctype="multipart/form-data" data-ajax="false">

    <div class="exchange" style="margin-top: 16px;height: 30px">

    </div>
    <div class="code">
        <div>
            <span>上传付款截图</span>
        </div>
        <div>
            <div>
                <span>请上传付款截图页面，示例如下</span>
            </div>

            <div>
                <div>
                    <div>
                        <span  class="sima"> <img id="clickimg" src="/Public/ybt/image/icon_add.png" onclick="document.getElementById('upfile').click()" id="clickimg" width="120" height="120" /></span>
                    </div>
                    <input type="file" name="photoimg" multiple="multiple"  id="upfile"  class="upload_pic" style="display: none;" />
                    <input type="hidden" id="image" name="image" value="">
                </div>
                <div>
                    <li>  <img id="img1" src="/Public/ybt/image/code.png" style="width:100px;height:150px" alt="" /></li>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden"  name="id" value="<?php echo ($id); ?>">
    <div class="subMessage">
        <button id="sub" onclick="but()">提交</button>
    </div>
</form>
</div>
<script src="/Public/ybt/js/jquery-1.11.3.min.js"></script>
<script src="/Public/ybt/js/jquery.form.js"></script>
<script src="/Public/ybt/js/layer.js"></script>
<script type="text/javascript">
    $(function(){
        $("#img1").click(function(){
            var width = $(this).width();
            if(width==100)
            {
                $(this).width(400);
                $(this).height(600);
            }
            else
            {
                $(this).width(100);
                $(this).height(150);
            }
        });
    });
</script>
<script type="text/javascript">
    $(function(){
        $("#upfile").wrap("<form action='<?php echo U('Emoney/uploads');?>' method='post' enctype='multipart/form-data'></form>");
        $("#upfile").off().on('change',function(){
            var objform = $(this).parents();
            objform.ajaxSubmit({
                dataType:  'json',
                target: '#preview',
                success:function(data){
                    if(data.result==1){
                        $("#clickimg").attr('src','/Public/'+data.url)
                        $("#image").val('/Public/'+data.url)
                    }else{
                        $('.sima').html('<font style="color:red;">'+data.msg+'</font>')
                    }
                },
                error:function(){
                }
            });
        });
    });
</script>

</body>
</html>