<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="robots" content="noindex,nofollow">
    <meta name="robots" content="noarchive">
    <!-- 屏蔽-->
    <title>账户解封</title>
    <meta name="keywords" content=" ">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="IE=9; IE=EDGE" http-equiv="X-UA-Compatible">
    <link rel="stylesheet" href="/Public/ybt/css/sm.css">
    <script src="/Public/ybt/js/jquery-1.10.2.min.js"></script>

    <link rel="stylesheet" href="/Public/ybt/css/sm-extend.css">
    <!--图标-->
    <link rel="stylesheet" href="/Public/ybt/css/iconfont.css">
    <!--自定义-->

    <link rel="stylesheet" href="/Public/ybt/css/main.css">
    <link rel="stylesheet" href="/Public/ybt/css/order.css">

</head>
<body style="">



<!-- 标题栏 -->
<header class="bar bar-nav">

    <a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 1.1rem; color:#FFF;">账户解封</a>    <div class="logo">
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
<br>
<br>

<!-- Main Container start -->

<style type="text/css">
    body{ background: #FFF;}
    .li_touxiang img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
    }
</style>
<div class="list-block">
    <form class="cmxform form-horizontal tasi-form" action="<?php echo U('Index/Account/jfpost');?>" name="xgmm" id="xgmm" method="post">
        <ul>


            <li>
                <div class="item-content">
                    <div class="item-media"><i class="icon icon-form-name"></i></div>
                    <div class="item-inner">
                        <div class="item-title label">解封账号</div>
                        <div class="item-input">
                            <input class="col-20" type="text" placeholder="请输入您需要解封的手机号" name="mobile" value="">
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="item-content">
                    <div class="item-media"><i class="icon icon-form-name"></i></div>
                    <div class="item-inner">
                        <div class="item-title label">二级密码</div>
                        <div class="item-input">
                            <input class="col-20" type="password" placeholder="请输入您的二级密码" name="password2" value="">
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="item-content">
                    <div class="item-media"><i class="icon icon-form-name"></i></div>
                    <div class="item-inner">
                        <div class="item-title label">身份证</div>
                        <div class="item-input">
                            <input class="col-20" type="text" placeholder="请输入身份证号" name="shenfen" value="">
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </form>
</div>
<div class="content-block">
    <div class="row">
        <div class="col-50">
            <button type="button" class="button button-big button-fill button-success js-submit" style="width: 100%;" onclick="document.getElementById('xgmm').submit();">提交</button>

        </div>
        <div class="col-50"><a href="javascript:history.go(-1)" class="button button-big button-fill button-dark">取消</a></div>
    </div>
</div>








</body></html>