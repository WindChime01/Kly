<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- saved from url=(0041)http://porter.weiyinstudio.com/Home/Login/reg2/ -->

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



    <meta name="robots" content="noindex,nofollow">

    <meta name="robots" content="noarchive">

    <!-- 屏蔽-->

    <title>注册</title>

    <meta name="keywords" content="">

    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <meta content="IE=9; IE=EDGE" http-equiv="X-UA-Compatible">

    <link rel="stylesheet" href="/Public/ybt/css/sm.css">

    <link rel="stylesheet" href="/Public/ybt/css/sm-extend.css">

    <link rel="stylesheet" href="/Public/ybt/css/iconfont.css">

    <link rel="stylesheet" href="/Public/ybt/css/main.css">

    <style type="text/css">

        body{background: url('/Public/ybt/image/new/login-bg.png') no-repeat top center; background-size: 100%;}
		
		
		input::placeholder{
			color:#727B9E;
		}
		
		.list-block{
			margin:5rem 0;
		}
		
        .content-block .button.button-fill {
            color: #FFF;
            font-size: 1.2rem;
            border-radius: 20px;
			background-image: linear-gradient(to right,#6DB8F9,#3A83F6);
			border-radius:30px;
			border-top-left-radius: 10px;
			font-size:1rem;
			width:100%;
        }
    </style>

</head>

<body>

<!--<div class="page">-->

    <!-- 标题栏 -->

    <header class="bar bar-nav"><a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 0.85rem; color:#FFF;">新用户注册</a>

        <div class="logo"><a href="javascript:history.back(-1)"><i class="icon icon-left"></i></a></div>

    </header>

    <!-- 这里是页面内容区 -->

    <div class="content" style="margin-bottom:10px;">

        <form class="form-signin" name="regForm" id="regForm" method="post">

            <div class="list-block">
				<div style="margin: 0 1rem 0 1rem">
					<div class="main-box">
						<div class="item-inner" style="height:70px;border-top: none">

                            <div class="item-title label" style="width:10%"><img src="/Public/ybt/image/phone-icon@2x.png" style="width:20px" /></div>

                            <div class="item-input">
                                <input style="color:#fff;" name="mobile" id="mobile" type="text" placeholder="请输入手机号码或邮箱">
                            </div>

                        </div>
					</div>
					<div class="main-box">
						<div class="item-inner" style="height:70px;border-top: none">

                            <div class="item-title label" style="width:10%"><img src="/Public/ybt/image/phone-icon@2x.png" style="width:20px" /></div>

                            <div class="item-input">
                                <input style="color:#fff;" name="truename" id="truename" type="text" placeholder="请输入您的姓名" >
                            </div>

                        </div>
					</div>
					<div class="main-box">
						<div class="item-inner" style="height:70px;border-top: none">

                            <div class="item-title label" style="width:10%"><img src="/Public/ybt/image/mima-icon@2x.png" style="width:20px" /></div>

                            <div class="item-input">
                                <input style="color:#fff;" name="password" id="password" type="password" placeholder="请输入登录密码" >
                            </div>

                        </div>
					</div>
					<div class="main-box">
						<div class="item-inner" style="height:70px;border-top: none">

                            <div class="item-title label" style="width:10%"><img src="/Public/ybt/image/mima-icon@2x.png" style="width:20px" /></div>

                            <div class="item-input">
                                <input style="color:#fff;" name="password1" id="password1" type="password" placeholder="请确认登录密码" >
                            </div>

                        </div>
					</div>
					<!--<div class="main-box">-->
					<!--	<div class="item-inner" style="height:70px;border-top: none">-->

     <!--                       <div class="item-title label" style="width:10%"><img src="/Public/ybt/image/mima-icon@2x.png" style="width:20px" /></div>-->

     <!--                       <div class="item-input">-->
     <!--                           <input style="color:#fff;" name="password2" id="password2" type="password" placeholder="请输入二级密码" maxlength="11">-->
     <!--                       </div>-->

     <!--                   </div>-->
					<!--</div>-->
					<!--<div class="main-box">-->
					<!--	<div class="item-inner" style="height:70px;border-top: none">-->

     <!--                       <div class="item-title label" style="width:10%"><img src="/Public/ybt/image/mima-icon@2x.png" style="width:20px" /></div>-->

     <!--                       <div class="item-input">-->
     <!--                           <input style="color:#fff;" name="password21" id="password21" type="password" placeholder="请确认二级密码" maxlength="11">-->
     <!--                       </div>-->

     <!--                   </div>-->
					<!--</div>-->
					<div class="main-box">
						<div class="item-inner" style="height:70px;border-top: none">

                            <div class="item-title label" style="width:10%"><img src="/Public/ybt/image/phone-icon@2x.png" style="width:20px" /></div>

                            <div class="item-input">
                                <input style="color:#fff;" name="parent" id="parent" type="text" placeholder="推荐码" >
                            </div>

                        </div>
					</div>
				</div>


                <!--<ul>-->



                <!--    <li>-->

                <!--        <div class="item-content">-->

                <!--            <div class="item-media"><i class="icon icon-form-name"></i></div>-->

                <!--            <div class="item-inner">-->

                <!--                <div class="item-title label">用户名手机号</div>-->

                <!--                <div class="item-input">-->

                <!--                    <input class="col-20" name="mobile" id="mobile" placeholder="必须本人银行卡绑定的手机号" type="text" value="">-->

                <!--                </div>-->

                <!--            </div>-->

                <!--        </div>-->

                <!--    </li>-->

                <!--      <li>-->

                <!--        <div class="item-content">-->

                <!--            <div class="item-media"><i class="icon iconfont icon-yanjing"></i></div>-->

                <!--            <div class="item-inner">-->

                <!--                <div class="item-title label">验证码</div>-->

                <!--                <div class="item-input">-->

                <!--                    <div style="float:left; width:50%;margin:0px;padding: 0px;">-->

                <!--                        <input type="text" class="form-control tooltips" data-trigger="hover" data-toggle="tooltip" placeholder="请输入验证码" name="verCode" id="verCode">-->

                <!--                    </div>-->

                <!--                    <div style=" float:left;width:50%;margin:0px;padding: 0px;">-->

                <!--                        <img width="110" height="38" src="<?php echo U('Sem/verify');?>" onclick="this.src='<?php echo U('Sem/verify','','');?>?'+Math.random();" alt="点击刷新验证码" style="cursor:pointer;margin-top: 5px;">-->

                <!--                    </div>-->

                <!--                </div>-->

                <!--            </div>-->

                <!--        </div>-->

                <!--    </li>-->



                <!--    <li>-->

                <!--        <div class="item-content">-->

                <!--            <div class="item-media"><i class="icon icon-form-name"></i></div>-->

                <!--            <div class="item-inner">-->

                <!--                <div class="item-title label">短信验证码</div>-->

                <!--                <input type="text" placeholder="短信验证码" name="code" required id="code" class="fl">-->



                <!--                <span  id="count_down" onClick="send_sms_reg_code()" class="button button-fill button-warning  col-20 fr reg-mobile-js" style="width:200px;">获取验证码</span>-->



                <!--            </div>-->
                <!--        </div>-->

                <!--    </li>-->

                <!--    <li>-->

                <!--        <div class="item-content">-->

                <!--            <div class="item-media"><i class="icon icon-form-name"></i></div>-->

                <!--            <div class="item-inner">-->

                <!--                <div class="item-title label">姓名</div>-->

                <!--                <div class="item-input">-->

                <!--                    <input class="col-20" name="truename" id="truename" placeholder="必须真实姓名，注册后不可修改" type="text" value="">-->

                <!--                </div>-->

                <!--            </div>-->

                <!--        </div>-->

                <!--    </li>-->

                <!--    <li>-->

                <!--        <div class="item-content">-->

                <!--            <div class="item-media"><i class="icon icon-form-name"></i></div>-->

                <!--            <div class="item-inner">-->

                <!--                <div class="item-title label">登录密码</div>-->

                <!--                <div class="item-input">-->

                <!--                    <input class="col-20" name="password" id="password" type="password" placeholder="请输入登录密码" value="">-->

                <!--                </div>-->

                <!--            </div>-->

                <!--        </div>-->

                <!--    </li>-->

                <!--    <li>-->

                <!--        <div class="item-content">-->

                <!--            <div class="item-media"><i class="icon icon-form-name"></i></div>-->

                <!--            <div class="item-inner">-->

                <!--                <div class="item-title label">确认密码</div>-->

                <!--                <div class="item-input">-->

                <!--                    <input class="col-20" name="password1" id="password1" type="password" placeholder="请输入确认登录密码" value="">-->

                <!--                </div>-->

                <!--            </div>-->

                <!--        </div>-->

                <!--    </li>-->

                <!--    <li>-->

                <!--        <div class="item-content">-->

                <!--            <div class="item-media"><i class="icon icon-form-name"></i></div>-->

                <!--            <div class="item-inner">-->

                <!--                <div class="item-title label">二级密码</div>-->

                <!--                <div class="item-input">-->

                <!--                    <input class="col-20" name="password2" id="password2" type="password" placeholder="请输入二级密码" value="">-->

                <!--                </div>-->

                <!--            </div>-->

                <!--        </div>-->

                <!--    </li>-->

                <!--    <li>-->

                <!--        <div class="item-content">-->

                <!--            <div class="item-media"><i class="icon icon-form-name"></i></div>-->

                <!--            <div class="item-inner">-->

                <!--                <div class="item-title label">确认密码</div>-->

                <!--                <div class="item-input">-->

                <!--                    <input class="col-20" name="password21" id="password21" type="password" placeholder="请输入确认二级密码" value="">-->

                <!--                </div>-->

                <!--            </div>-->

                <!--        </div>-->

                <!--    </li>-->

                <!--    <li>-->

                <!--        <div class="item-content">-->

                <!--            <div class="item-media"><i class="icon icon-form-name"></i></div>-->

                <!--            <div class="item-inner">-->

                <!--                <div class="item-title label">推荐人手机号</div>-->

                <!--                <div class="item-input">-->

                <!--                    <input class="col-20" name="parent" id="parent" type="text" placeholder="请输入推荐人手机号" value="">-->

                <!--                </div>-->

                <!--            </div>-->

                <!--        </div>-->

                <!--    </li>-->



                <!--</ul>-->



            </div>

        </form>

        <div class="content-block">

            <div class="row">

                <div class="col-100">

                    <button id="send" type="submit" class="button button-big button-fill" onclick="reg();">注 册</button>

                </div>

            </div>

        </div>

       <!--  <div align="center"><a href="">点击下载APP</a><br>

            <img src="/Public/ybt/image/1520935591.png" width="80%"></div> -->

    </div>

</div>

<script src="/Public/ybt/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.js"></script>
<script type="text/javascript" src="/Public/ybt/js/layer/layer.js"></script>
<script type="text/javascript">
	function reg() {
        $data = $('#regForm').serialize();
        $.post('/Index/Sem/regpost',$data,function (response) {
            $data = JSON.parse(response);
            if ($data.success == 0) {
                //弹出错误提示
                layer.msg($data.msg);
                $('#verify').click();
            } else if ($data.success == 1) {
                //注册成功
                layer.msg($data.msg);
                setTimeout(function(){
                    window.location.href = '/index.php/index/login/index';
                },2000);
            }
        })
    }
</script>

<script type="text/javascript">

    // 发送手机短信

    function send_sms_reg_code(){

        var mobile = $('#mobile').val();

        var tag = '';
        if(checkMobile(mobile)){
			var tag = 'mobile';
        } else if(checkEmail(mobile)) {
        	var tag = 'email';
        } else {
        	layer.msg('请输入正确的手机号码或邮箱');
        	return;
        }
        if(tag == 'email') {
        	var url = "/index.php/index/sem/sendemail/email/" + mobile;
        } else if(tag == 'mobile') {
        	var url = "/index.php/index/sem/send_sms_reg_code/mobile/" + mobile;
        } else {
        	return;
        }

		var type = 1;
        $.get(url,{type:type},function(data){

            obj = $.parseJSON(data);

            if(obj.status == 1)

            {

                $('#count_down').attr("disabled","disabled");

                intAs = 60; // 手机短信超时时间

                jsInnerTimeout('count_down',intAs);

            }

            layer.msg(obj.msg);// alert(obj.msg);



        })

    }

    $('#count_down').removeAttr("disabled");

    //倒计时函数

    function jsInnerTimeout(id,intAs)

    {

        var codeObj=$("#"+id);

        //var intAs = parseInt(codeObj.attr("IntervalTime"));



        intAs--;

        if(intAs<=-1)

        {

            codeObj.removeAttr("disabled");

//            codeObj.attr("IntervalTime",60);

            codeObj.text("获取验证码");

            return true;

        }



        codeObj.text(intAs+'秒');

//        codeObj.attr("IntervalTime",intAs);



        setTimeout("jsInnerTimeout('"+id+"',"+intAs+")",1000);

    };

    function checkMobile(tel) {

        var reg = /(^1[3|4|5|7|8|6|9][0-9]{9}$)/;

        if (reg.test(tel)) {

            return true;

        }else{

            return false;

        };

    }
    
    function checkEmail(email) {
    	var reg = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
    	if (reg.test(email)) {

            return true;

        }else{

            return false;

        };
    }

</script>

<script>
	// var width = document.body.clientWidth;
	// var height = document.body.clientHeight;
	// var bili = width / height;
	// function getNaturalWidth(imgsrc) {
	//     var image = new Image();
	//     image.src = imgsrc;
	//     var naturalWidth = image.width;
	//     var naturalHeight = image.height;
	//     var bili = naturalWidth / naturalHeight;
	//     return bili;
	// }
	// var realBili = getNaturalWidth('/Public/ybt/image/login_bg@2x.png');
	// if(realBili > bili) {
	// 	//高取全屏
	// 	$('body').css('background-size','auto 100%');
	// } else {
	// 	//宽取全屏
	// 	$('body').css('background-size','100% auto');
	// }
</script>

</body></html>