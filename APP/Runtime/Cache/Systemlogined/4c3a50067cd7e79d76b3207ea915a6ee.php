<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>后台管理系统</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />
		<link href="__PUBLIC__/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="__PUBLIC__/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--bbc styles-->

		<link rel="stylesheet" href="__PUBLIC__/css/bbc.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/css/bbc-responsive.min.css" />

		<!--[if lt IE 9]>
		  <link rel="stylesheet" href="__PUBLIC__/css/bbc-ie.min.css" />
		<![endif]-->
	</head>


	<body class="login-layout">
			<div class="container-fluid" id="main-container">
				<div id="main-content">
					<div class="row-fluid">
						<div class="span12">
							<div class="login-container">
								<div class="row-fluid">
									<div class="center">
										<h1>
											<i class="icon-leaf green"></i>
										
											<span class="white">后台管理系统</span>
										</h1>
										
									</div>
								</div>

								<div class="space-6"></div>

								<div class="row-fluid">
									<div class="position-relative">
										<div id="login-box" class="visible widget-box no-border">
											<div class="widget-body">
												<div class="widget-main">
													<h4 class="header blue lighter bigger">
														<i class="icon-coffee green"></i>
														请输入您的账号和密码
													</h4>

													<div class="space-6"></div>

													<form mathod="post" id="login">
													    
														<fieldset>
															<label>
																<span class="block input-icon input-icon-right">
																	<input name="username" type="text" class="span12" placeholder="用户名" />
																	<i class="icon-user"></i>
																</span>
															</label>

															<label>
																<span class="block input-icon input-icon-right">
																	<input name="password" type="password" class="span12" placeholder="密码" />
																	<i class="icon-lock"></i>
																</span>
															</label>
															
															<label>
																<span class="block input-icon input-icon-right">
																	<input name="code" type="text" class="span6" placeholder="验证码" />
																	<a href="javascript:void(change_code());"><img src="<?php echo U(GROUP_NAME .'/Login/verify');?>" id="code"/>看不清</a>
																</span>
															</label>
															
															<!--<label>-->
															<!--	<span class="block input-icon input-icon-right">-->
															<!--		<input id="author_code" name="author_code" type="password" class="span12" placeholder="授权码" />-->
															<!--		<i class="icon-lock"></i>-->
															<!--	</span>-->
															<!--</label>-->
															<!--<label>-->
															<!--	<span class="block input-icon input-icon-right">-->
															<!--		<input name="code2" type="text" class="span6" placeholder="短信验证码" />-->
															<!--		<span  id="count_down" onClick="send_sms_reg_code()" class="" style="line-height: 2.15rem;margin-left: 40px;color: #EAB044;">获取验证码</span>-->
															<!--	</span>-->
															<!--</label>-->

															<div class="space"></div>

															<div class="row-fluid">
																<!--<label class="span8">-->
																	<!--<input type="checkbox" />-->
																	<!--<span class="lbl"> Remember Me</span>-->
																<!--</label>-->

																<button type="button" class="span4 btn btn-small btn-primary no-border" onclick="loginin()">
																	<i class="icon-key"></i>
																	登录
																</button>
															</div>
														</fieldset>
													</form>
												</div><!--/widget-main-->

												<div class="toolbar clearfix">
													<div>
														<a href="#" onclick="return false;" class="forgot-password-link">
															<i class="icon-arrow-left"></i>
															请不要在公共场所操作!
														</a>
													</div>

													
												</div>
											</div><!--/widget-body-->
										</div><!--/login-box-->

								
									</div><!--/position-relative-->
								</div>
							</div>
						</div><!--/span-->
					</div><!--/row-->
				</div>
			</div><!--/.fluid-container-->
		</form>

		<!--basic scripts-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='__PUBLIC__/js/jquery-1.9.1.min.js'>"+"<"+"/script>");
		</script>

		<!--page specific plugin scripts-->

		<!--inline scripts related to this page-->
		<script type="text/javascript">
			var verifyURL = '<?php echo U(GROUP_NAME .'/Login/verify','','');?>';
			function change_code(){
				$("#code").attr("src", verifyURL + '/' + Math.random());
				return false;
			}
		</script>
<script src="https://cdn.bootcss.com/blueimp-md5/2.10.0/js/md5.js"></script>
<script type="text/javascript" src="/Public/ybt/js/jquery-3.3.1/jquery-3.3.1.js"></script>
<script type="text/javascript" src="/Public/ybt/js/layer/layer.js"></script>
<script type="text/javascript">
    function loginin(){
        $username = $("input[name='username']").val();
        $password = $("input[name='password']").val();
        $code = $("input[name='code']").val();
        $code2 = $("input[name='code2']").val();
        if(!$username || !$password || !$code) {
            layer.msg('请输入账号密码及图形验证码');
            return;
        }
        $author_code = $('#author_code').val();
        // if(!$author_code) {
        //     layer.msg('请输入授权码');
        //     return;
        // }
        // if(!$code2) {
        //     layer.msg('请输入手机验证码');
        //     return;
        // }
        $token = $("input[name='__hash__']").val();
        console.log($token);
        $.post("<?php echo U(GROUP_NAME.'/Login/login');?>",{'username':$username,'password':md5(md5($password)),'code':$code,'author_code':md5(md5($author_code)),'code2':$code2,'__hash__':$token},function(data){
            obj = $.parseJSON(data);
            layer.msg(obj.msg);// alert(obj.msg);
            if(obj.status == 1) {
                window.location.href = obj.url;
            } else if(obj.status == 2) {
                setTimeout("window.location.href = obj.url",2000);
            } else {
                change_code();
            }
        })

    }
    
    // 发送手机短信
//     $lock = 0;
//     function send_sms_reg_code(){
//         $username = $("input[name='username']").val();
//         $password = $("input[name='password']").val();
//         $code = $("input[name='code']").val();
//         if(!$username || !$password || !$code) {
//             layer.msg('请输入账号密码及图形验证码');
//             return;
//         }
//         $author_code = $('#author_code').val();
//         if(!$author_code) {
//             layer.msg('请输入授权码');
//             return;
//         }
//         if($lock == 1) {
//             layer.msg('正在发送中，请稍后...');
//             return;
//         }
//         $lock = 1;
//         $.post("/systemlogined/login/send_sms_login_code/",{'username':$username,'password':md5(md5($password)),'code':$code,'author_code':md5(md5($author_code))},function(data){

//             obj = $.parseJSON(data);

//             if(obj.status == 1)

//             {

//                 $('#count_down').attr("disabled","disabled");

//                 intAs = 60; // 手机短信超时时间

//                 jsInnerTimeout('count_down',intAs);

//             } else {
//                 change_code();
//             }

//             layer.msg(obj.msg);// alert(obj.msg);

//             $lock = 0;

//         })

//     }

//     $('#count_down').removeAttr("disabled");

//     //倒计时函数

//     function jsInnerTimeout(id,intAs)

//     {

//         var codeObj=$("#"+id);
//         intAs--;

//         if(intAs<=-1)

//         {

//             codeObj.removeAttr("disabled");

// //            codeObj.attr("IntervalTime",60);

//             codeObj.text("获取验证码");

//             return true;

//         }



//         codeObj.text(intAs+'秒');

// //        codeObj.attr("IntervalTime",intAs);



//         setTimeout("jsInnerTimeout('"+id+"',"+intAs+")",1000);

//     };
</script>
	</body>
</html>