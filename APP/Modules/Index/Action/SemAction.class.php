<?php  use phpmailer\src\PHPMailer;use phpmailer\src\SMTP;header("Content-type:text/html;charset=utf-8");/** * 会员推广控制器 */Class SemAction extends Action{        public function _initialize(){            //判断是否关闭了网站            $open_web=C('open_web');            if(empty($open_web)){                $this->open_web_notice=C('open_web_notice');                $this->display('Index:404');                exit;            }        }    //注册推广     public function regSem(){         header("Content-type:text/html;charset=utf-8");         $d_key=I('get.u','','trim');//$d_keyid=encrypt("t24GWvVczWju",'D','xyb8888');			// echo $d_key;die;        //  if(!is_int($d_key)){        //       $d_key=str_replace('AAABBB','/',$d_key);        //       $uid =encrypt($d_key,'D','xyb8888');        //  }else{        //      $uid =$d_key;        // }		 //$uid =intval($uid);         $userinfo = M('member')->where(array('tgm'=>$d_key))->find();         if(!$userinfo){             $this->error('错误的访问请求!');         }        $username = $userinfo['username'];        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);		$type = 'other';		//分别进行判断		if(strpos($agent, 'iphone') || strpos($agent, 'ipad'))		{			$type = 'ios';		} 		if(strpos($agent, 'android'))		{			$type = 'android';		}		$this->assign("type",$type);        $this->assign('username',$username);        $this->assign('tgkey',$d_key);        $this->display();     }	//注册推广     public function regSempost(){        // alert('注册功能暂时关闭',-1);        // exit;		$res = array('msg'=>'','success'=>0);         if (IS_POST) {             $password    = $_POST['password'];             $password1   = $_POST['password1'];             $password2  =  $_POST['password2'];             $password21  =  $_POST['password21'];             $code = $_POST['code'];             $data['parent'] = trim($_POST['parent']);             $data['truename'] = $_POST['truename'];             $a_ip = $_SERVER['REMOTE_ADDR'];             $account = trim($_POST['mobile']);             if(preg_match("/^1[3456789]{1}\d{9}$/",$account)){            	$data['username'] = $data['mobile'] = $account;            	if (M('member')->where(array('mobile'=>trim($data['mobile'])))->getField('id')) {	            	$res['msg'] = '手机号已存在，请更换！';	                echo json_encode($res);exit;	            }		            if(!$code){	            	$res['msg'] = '短信验证码不能为空！';	                echo json_encode($res);exit;	            }		            $check_code = sms_code_verify($data['mobile'],$code,session_id());		            if($check_code['status'] != 1){	            	$res['msg'] = '手机验证码不匹配或已超时！';	                echo json_encode($res);exit;	            }             } else if(preg_match("/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/",$account)) {             	$data['username'] = $data['email'] = $account;             	if (M('member')->where(array('email'=>trim($data['email'])))->getField('id')) {	            	$res['msg'] = '邮箱已被注册，请更换！';	                echo json_encode($res);exit;	            }	            if(!$code){	            	$res['msg'] = '邮箱验证码不能为空！';	                echo json_encode($res);exit;	            }		            $check_code = session(session_id().'code');	            $realemail = session(session_id().'email');		            if($check_code != md5($code.'mima') || $realemail != $data['mobile']) {	            	$res['msg'] = '邮箱验证码不匹配或已超时！';	                echo json_encode($res);exit;	            }             } else {             	$res['msg'] = '手机号码或邮箱格式不正确！';                echo json_encode($res);exit;             }                          if (empty($password)  || empty($password1)) {            	$res['msg'] = '登陆密码不能为空！';                echo json_encode($res);exit;                alert('登陆密码不能为空!',-1);            }                        if (empty($password)  || empty($password1)) {            	$res['msg'] = '登陆密码不能为空！';                echo json_encode($res);exit;                alert('登陆密码不能为空!',-1);            }            if(!preg_match("/^[a-zA-Z\d_]{6,}$/",$password)){            	$res['msg'] = '登陆密码不能小于6位！';                echo json_encode($res);exit;                alert('登陆密码不能小于6位!',-1);            }            if ($password != $password1) {            	$res['msg'] = '两次输入的登陆密码不相同！';                echo json_encode($res);exit;                alert('两次输入的登陆密码不相同!',-1);            }            if (empty($password2)  || empty($password21)) {            	$res['msg'] = '交易密码不能为空！';                echo json_encode($res);exit;                alert('交易密码不能为空!',-1);            }            if(!preg_match("/^[a-zA-Z\d_]{6,}$/",$password2)){            	$res['msg'] = '交易密码不能小于6位！';                echo json_encode($res);exit;                alert('交易密码不能小于6位!',-1);            }            if ($password2 != $password21) {            	$res['msg'] = '两次输入的交易密码不相同！';                echo json_encode($res);exit;                alert('两次输入的交易密码不相同!',-1);            }            if(M('member')->find()){            	if(empty($data['parent'])){	                $res['msg'] = '推荐码不能为空！';	                echo json_encode($res);exit;	            }	            $parent = M('member')->where(array('tgm'=>$data['parent']))->find();	            // dump($parent);die;	            if (!$parent) {	                $res['msg'] = '推荐人不存在！';	                echo json_encode($res);exit;	            }				$data['parent'] = $parent['username'];				$data['parent_id'] = $parent['id'];            }             $data['password']  = md5($password);            //  $data['password2'] = md5($password2);             $parentinfo = M('member')->where(array('username'=>$data['parent']))->find();             $data['parentpath']  = trim($parentinfo['parentpath'] . $parentinfo['id'] . '|');;             $data['regdate']     = time();             $data['kczc']     = C('zs_num');             $data['ip']       = $a_ip;             			$data['tgm']	= getRandChar();			$rst = M('member')->where(array('tgm'=>$code))->find();			while($rst != NULL){				$data['tgm'] = $this->getRandChar();				$rst = M('member')->where(array('tgm'=>$code))->find();			}                        $rst = M('member')->add($data);			if(!$rst) {				$res['msg'] = '注册失败！请重试';            	echo json_encode($res);exit;			}             //我的上级直推加一             M('member')->where(array('username' => $data['parent']))->setInc('ztnum',1);             M('member')->where(array('username' => $data['parent']))->setInc('tdnum',1);             			$res['success'] = 1;			$res['msg'] = '注册成功！';            echo json_encode($res);exit;         }    }    //注册    public function reg(){        // alert('注册功能暂时关闭!',U('Index/Login/index'));        //     exit;        $this->display();    }    public function regpost(){        // alert('注册功能暂时关闭',-1);        // exit;		$res = array('msg'=>'','success'=>0);        if (IS_POST) {            $password    = $_POST['password'];            $password1   = $_POST['password1'];            $password2  =  $_POST['password2'];            $password21  =  $_POST['password21'];            $data['username'] = trim($_POST['mobile']);            $code = $_POST['code'];            $data['parent'] = trim($_POST['parent']);            $data['truename'] = $_POST['truename'];            $a_ip = $_SERVER['REMOTE_ADDR'];            $account = $data['username'];             if(preg_match("/^1[3456789]{1}\d{9}$/",$account)){            	$data['mobile'] = $account;            	if (M('member')->where(array('mobile'=>trim($data['mobile'])))->getField('id')) {	            	$res['msg'] = '手机号已存在，请更换！';	                echo json_encode($res);exit;	            }	             } else if(preg_match("/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/",$account)) {             	$data['email'] = $account;             	if (M('member')->where(array('email'=>trim($data['email'])))->getField('id')) {	            	$res['msg'] = '邮箱已被注册，请更换！';	                echo json_encode($res);exit;	            }	            if(!$code){	            	$res['msg'] = '邮箱验证码不能为空！';	                echo json_encode($res);exit;	            }		            $check_code = session(session_id().'code');	            $realemail = session(session_id().'email');		            if($check_code != md5($code.'mima') || $realemail != $data['email']) {	            	$res['msg'] = '邮箱验证码不匹配或已超时！';	                echo json_encode($res);exit;	            }             } else {             	$res['msg'] = '手机号码或邮箱格式不正确！';                echo json_encode($res);exit;             }            // $ipcount = M("member")->where(array('ip'=>$a_ip))->count();            // if ($ipcount >= 20000)            // {            //   alert('您的电脑地址已经注册了两个账户。请更换电脑',-1);            //   exit;            // }                        if(empty($_POST['truename'])){            	$res['msg'] = '姓名不能为空！';                echo json_encode($res);exit;                alert('手机号码不能为空!',-1);            }            // if(!preg_match("/^1[34578]{1}\d{9}$/",$data['mobile'])){            // 	$res['msg'] = '手机号码格式不正确！';            //     echo json_encode($res);exit;            //     alert('手机号码格式不正确!',-1);            // }            // if (M('member')->where(array('mobile'=>trim($data['mobile'])))->getField('id')) {            // 	$res['msg'] = '手机号已存在，请更换！';            //     echo json_encode($res);exit;            //     alert('手机号已存在，请更换!',-1);            // }            // if(!$code){            // 	$res['msg'] = '短信验证码不能为空！';            //     echo json_encode($res);exit;            //     alert('短信验证码不能为空!',-1);            // }            // $check_code = sms_code_verify($data['mobile'],$code,session_id());            // if($check_code['status'] != 1){            // 	$res['msg'] = '手机验证码不匹配或已超时！';            //     echo json_encode($res);exit;            //     alert('手机验证码不匹配或者超时!',-1);            // }			if (empty($password)  || empty($password1)) {            	$res['msg'] = '登陆密码不能为空！';                echo json_encode($res);exit;                alert('登陆密码不能为空!',-1);            }                        if (empty($password)  || empty($password1)) {            	$res['msg'] = '登陆密码不能为空！';                echo json_encode($res);exit;                alert('登陆密码不能为空!',-1);            }            if(!preg_match("/^[a-zA-Z\d_]{6,}$/",$password)){            	$res['msg'] = '登陆密码不能小于6位！';                echo json_encode($res);exit;                alert('登陆密码不能小于6位!',-1);            }            if ($password != $password1) {            	$res['msg'] = '两次输入的登陆密码不相同！';                echo json_encode($res);exit;                alert('两次输入的登陆密码不相同!',-1);            }            // if (empty($password2)  || empty($password21)) {            // 	$res['msg'] = '交易密码不能为空！';            //     echo json_encode($res);exit;            //     alert('交易密码不能为空!',-1);            // }            // if(!preg_match("/^[a-zA-Z\d_]{6,}$/",$password2)){            // 	$res['msg'] = '交易密码不能小于6位！';            //     echo json_encode($res);exit;            //     alert('交易密码不能小于6位!',-1);            // }            // if ($password2 != $password21) {            // 	$res['msg'] = '两次输入的交易密码不相同！';            //     echo json_encode($res);exit;            //     alert('两次输入的交易密码不相同!',-1);            // }                        if(M('member')->select()){            	if(empty($data['parent'])){	                $res['msg'] = '推荐码不能为空！';	                echo json_encode($res);exit;	            }	         //   if(!is_int($data['parent'])){		        //     $data['parent']=str_replace('AAABBB','/',$data['parent']);				        //     $uid =encrypt($data['parent'],'D','xyb8888');				        // }else{				        //     $uid =$data['parent'];				        // }		        //验证推荐人信息是否已存在及审核		        // dump($data['parent']);die;	            $parent = M('member')->where(array('tgm'=>$data['parent']))->find();	            // dump($parent);die;	            if (!$parent) {	                $res['msg'] = '推荐人不存在！';	                echo json_encode($res);exit;	            }				$data['parent'] = $parent['username'];				$data['parent_id'] = $parent['id'];            }                        	                                $data['password']  = md5($password);            // $data['password2'] = md5($password2);            // $parentinfo = M('member')->where(array('id'=>$data['parent']))->find();            $data['parentpath']  = trim($parent['parentpath'] . $parent['id'] . '|');            $data['regdate']     = time();            $data['level']      = 0;            $data['kczc']     = C('zs_num');            $data['ip']       = $a_ip;            $data['tgm']	= getRandChar();			$rst = M('member')->where(array('tgm'=>$data['tgm']))->find();			while($rst != NULL){				$data['tgm'] = $this->getRandChar();				$rst = M('member')->where(array('tgm'=>$data['tgm']))->find();			}                        $rst = M('member')->add($data);            session(session_id().'code','');            session(session_id().'email','');			if(!$rst) {				$res['msg'] = '注册失败！请重试';            	echo json_encode($res);exit;			}            //我的上级直推加一            M('member')->where(array('id' => $data['parent']))->setInc('ztnum',1);            M('member')->where(array('id' => $data['parent']))->setInc('tdnum',1);			$res['success'] = 1;			$res['msg'] = '注册成功！';            echo json_encode($res);exit;            alert('注册成功！请登录后完善个人资料,即可获得免费矿机!',U('Index/Login/index'));        }    }	public function regemail(){		$this->display('emailreg');	}		//邮箱已注册	public function regemailpost(){        // alert('注册功能暂时关闭',-1);        // exit;		$res = array('msg'=>'','success'=>0);        if (IS_POST) {            $password    = $_POST['password'];            $password1   = $_POST['password1'];            $password2  =  $_POST['password2'];            $password21  =  $_POST['password21'];            $data['username']      = $data['email']    = $_POST['email'];            $code = $_POST['code'];            $data['parent'] = trim($_POST['parent']);            $data['truename'] = $_POST['truename'];            $a_ip = $_SERVER['REMOTE_ADDR'];            // $ipcount = M("member")->where(array('ip'=>$a_ip))->count();            // if ($ipcount >= 20000)            // {            //   alert('您的电脑地址已经注册了两个账户。请更换电脑',-1);            //   exit;            // }                        if(empty($_POST['truename'])){            	$res['msg'] = '真实姓名不能为空！';                echo json_encode($res);exit;                alert('手机号码不能为空!',-1);            }            if(!preg_match("/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/",$data['email'])){            	$res['msg'] = '邮箱格式不正确！';                echo json_encode($res);exit;                alert('手机号码格式不正确!',-1);            }            if (M('member')->where(array('email'=>trim($data['email'])))->getField('id')) {            	$res['msg'] = '邮箱已存在，请更换！';                echo json_encode($res);exit;                alert('手机号已存在，请更换!',-1);            }            if(!$code){            	$res['msg'] = '邮箱验证码不能为空！';                echo json_encode($res);exit;                alert('短信验证码不能为空!',-1);            }            $check_code = session(session_id().'code');            $realemail = session(session_id().'email');            if($check_code != md5($code.'mima') || $realemail != $data['email']) {            	$res['msg'] = '邮箱验证码不匹配或已超时！';                echo json_encode($res);exit;            }			if (empty($password)  || empty($password1)) {            	$res['msg'] = '登陆密码不能为空！';                echo json_encode($res);exit;                alert('登陆密码不能为空!',-1);            }                        if (empty($password)  || empty($password1)) {            	$res['msg'] = '登陆密码不能为空！';                echo json_encode($res);exit;                alert('登陆密码不能为空!',-1);            }            if(!preg_match("/^[a-zA-Z\d_]{6,}$/",$password)){            	$res['msg'] = '登陆密码不能小于6位！';                echo json_encode($res);exit;                alert('登陆密码不能小于6位!',-1);            }            if ($password != $password1) {            	$res['msg'] = '两次输入的登陆密码不相同！';                echo json_encode($res);exit;                alert('两次输入的登陆密码不相同!',-1);            }            if (empty($password2)  || empty($password21)) {            	$res['msg'] = '交易密码不能为空！';                echo json_encode($res);exit;                alert('交易密码不能为空!',-1);            }            if(!preg_match("/^[a-zA-Z\d_]{6,}$/",$password2)){            	$res['msg'] = '交易密码不能小于6位！';                echo json_encode($res);exit;                alert('交易密码不能小于6位!',-1);            }            if ($password2 != $password21) {            	$res['msg'] = '两次输入的交易密码不相同！';                echo json_encode($res);exit;                alert('两次输入的交易密码不相同!',-1);            }                        if(M('member')->select()){            	if(empty($data['parent'])){	                $res['msg'] = '推荐码不能为空！';	                echo json_encode($res);exit;	            }	         //   if(!is_int($data['parent'])){		        //     $data['parent']=str_replace('AAABBB','/',$data['parent']);				        //     $uid =encrypt($data['parent'],'D','xyb8888');				        // }else{				        //     $uid =$data['parent'];				        // }		        //验证推荐人信息是否已存在及审核		        // dump($data['parent']);die;	            $parent = M('member')->where(array('tgm'=>$data['parent']))->find();	            // dump($parent);die;	            if (!$parent) {	                $res['msg'] = '推荐人不存在！';	                echo json_encode($res);exit;	            }				$data['parent'] = $parent['username'];				$data['parent_id'] = $parent['id'];            }                        	                                $data['password']  = md5($password);            $data['password2'] = md5($password2);            // $parentinfo = M('member')->where(array('id'=>$data['parent']))->find();            $data['parentpath']  = trim($parent['parentpath'] . $parent['id'] . '|');            $data['regdate']     = time();            $data['level']      = 0;            $data['kczc']     = C('zs_num');            $data['ip']       = $a_ip;            $data['tgm']	= getRandChar();			$rst = M('member')->where(array('tgm'=>$data['tgm']))->find();			while($rst != NULL){				$data['tgm'] = $this->getRandChar();				$rst = M('member')->where(array('tgm'=>$data['tgm']))->find();			}                        $rst = M('member')->add($data);			if(!$rst) {				$res['msg'] = '注册失败！请重试';            	echo json_encode($res);exit;			}            //我的上级直推加一            M('member')->where(array('id' => $data['parent']))->setInc('ztnum',1);            M('member')->where(array('id' => $data['parent']))->setInc('tdnum',1);            mmtjrennumadd($data['parent_id']);//  所有上级加一人			$res['success'] = 1;			$res['msg'] = '注册成功！';            echo json_encode($res);exit;            alert('注册成功！',U('Index/Login/index'));        }    }		// 注册账号：邮箱验证    public function sendemail()    {        $email = $_GET['email'] ? $_GET['email'] : '';        if(!$email){        	$this->error('请输入您的邮箱');        }		$type = I('type');	    if($type == 1) {	    	//注册	    	if(!check_email($email)) {	    		exit(json_encode(array('status' => -1, 'msg' => '邮箱格式错误!')));	    		$this->error('邮箱格式有误！');		    }		    if (M('member')->where(array('email' => $email))->find()) {		    	exit(json_encode(array('status' => -1, 'msg' => '邮箱已注册!')));	            $this->error('邮箱已注册！');	        }	    } elseif ($type == 2) {	    	//找回密码	    	if (!M('member')->where(array('email'=>$email))->getField('id')) {	    		exit(json_encode(array('status' => -1, 'msg' => '账号不存在!')));				$this->error('账号不存在！');		        }	    } else {	    	exit(json_encode(array('status' => -1, 'msg' => '参数错误!')));	    	$this->error('参数错误！');	    }                // if (checkstr($email) || checkstr($verify)) {        //     $this->error(L('您输入的信息有误！'));        // }            // 过滤非法字符----------------E        // if (!check_verify(strtoupper($verify),"1")) {        //     $this->error(L('图形验证码错误!'));        // }        // if (!check($mobile, 'mobile')) {        // 	$this->error(L('手机号码格式错误！'));        // }                $code = rand(1111, 9999);        session(session_id().'code', md5($code.'mima'));        session(session_id().'email',$email);        // dump($code);        // echo json_encode(array('msg'=>'验证码已发送到您的邮箱，请注意查收','status'=>1));exit;        // 实例化PHPMailer核心类        // include "/extends/phpmailer/src/PHPMailer.php";        // include "/extends/phpmailer/src/SMTP.php";        // include "/extends/phpmailer/src/Exception.php";        // $aa =$_SERVER['DOCUMENT_ROOT'];        include dirname(dirname(dirname(dirname(dirname(__FILE__)))))."/extend/phpmailer/src/PHPMailer.php";		include dirname(dirname(dirname(dirname(dirname(__FILE__)))))."/extend/phpmailer/src/SMTP.php";		include dirname(dirname(dirname(dirname(dirname(__FILE__)))))."/extend/phpmailer/src/Exception.php";		// var_dump(dirname(dirname(dirname(dirname(__FILE__)))));die;        $mail = new PHPMailer();        // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可默认关闭debug调试模式        $mail->SMTPDebug = 0;        // 使用smtp鉴权方式发送邮件        $mail->isSMTP();        // smtp需要鉴权 这个必须是true        $mail->SMTPAuth = true;        // 链接qq域名邮箱的服务器地址        $mail->Host = C('SEND_HOST');        // 设置使用ssl加密方式登录鉴权        $mail->SMTPSecure = 'ssl';        $mail->SMTPOptions = array(            'ssl' => array(                'verify_peer' => false,                'verify_peer_name' => false,                'allow_self_signed' => true            )        );        // 设置ssl连接smtp服务器的远程服务器端口号        $mail->Port = 465;        // 设置发送的邮件的编码        $mail->CharSet = 'UTF-8';        // 设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名        $mail->FromName = '星际元';        // smtp登录的账号 QQ邮箱即可        $mail->Username = C('SEND_EMAIL'); // 你的QQ邮箱        // smtp登录的密码 使用生成的授权码        $mail->Password = C('SMTP_PASSWORD');        // 设置发件人邮箱地址 同登录账号        $mail->From = C('SEND_EMAIL'); // 你的QQ邮箱        // 邮件正文是否为html编码 注意此处是一个方法        $mail->isHTML(true);        // 设置收件人邮箱地址        $mail->addAddress($email);        // 添加多个收件人 则多次调用方法即可        //$mail->addAddress('87654321@163.com');        // 添加该邮件的主题        $mail->Subject = '星际元';        // 添加邮件正文        $mail->Body = "您的验证码为：<h1>$code</h1>，如非本人操作请忽略。";        // 为该邮件添加附件        //$mail->addAttachment('./example.pdf');        // 发送邮件 返回状态        $status = $mail->send();        if ($status) {            echo json_encode(array('msg'=>'验证码已发送到您的邮箱，请注意查收','status'=>1));exit;        } else {            echo json_encode(array('msg'=>'发送失败','status'=>0));exit;        }    }    /** * 发送手机注册验证码 */public function send_sms_reg_code(){    $mobile = I('mobile');    $type = I('type');    if($type == 1) {    	//注册    	if(!check_mobile($mobile)) {	        exit(json_encode(array('status' => -1, 'msg' => '手机号码格式有误!')));	    }	    if (M('member')->where(array('mobile'=>$mobile))->getField('id')) {		      exit(json_encode(array('status'=>-1,'msg'=>'手机号码已存在!')));		    }    } elseif ($type == 2) {    	//找回密码    	if (!M('member')->where(array('mobile'=>$mobile))->getField('id')) {			$res['msg'] = '账号不存在';			echo json_encode($res);exit;        }    } else {    	exit(json_encode(array('status' => -1, 'msg' => '参数错误!')));    }        $code =  rand(1000,9999);    $send = sms_log($mobile,$code,session_id());    if($send['status'] != 1){         exit(json_encode(array('status'=>-1,'msg'=>$send['msg'])));    }    session('verify',null);    exit(json_encode(array('status'=>1,'msg'=>'验证码已发送，请注意查收')));}public function verify(){    ob_clean();    import('ORG.Util.Image');    Image::buildImageVerify();}public function send_sms_reg_codes(){    $mobile = I('mobile');    // $verify=I('verCode','','trim');    if (!$mobile || $mobile == '') {        exit(json_encode(array('success'=>0,'msg'=>'请填写手机号')));    }    if(!check_mobile($mobile)) {        exit(json_encode(array('status'=>-1,'msg'=>'手机号码格式有误!')));    }    $rst = M('member')->where(array('mobile'=>$mobile))->getField('id');	if (!$rst) {        exit(json_encode(array('success'=>0,'msg'=>'手机号码不存在!')));    }    $code =  rand(1000,9999);    $send = sms_log($mobile,$code,session_id());    if($send['status'] != 1){         exit(json_encode(array('status'=>-1,'msg'=>$send['msg'],'data'=>array('code'=>$code))));    }    // session('verify',null);    exit(json_encode(array('status'=>1,'msg'=>'验证码已发送，请注意查收')));}    //下载协议	public function downloadXy(){		$file_name = basename(I('path'));		$file_sub_dir = dirname(I('path')) . '/';				//对中文文件应该进行转码		//$file_name=iconv("utf-8","gb2312",$file_name);		$file_path=$_SERVER["DOCUMENT_ROOT"].$file_sub_dir.$file_name;		$extension=substr($file_name,strrpos($file_name,"."));		if(!file_exists($file_path)){		echo "文件不存在";		return;		}		$fp=fopen($file_path,"r");		//获取下载文件的大小		$file_size=filesize($file_path);		//返回的文件		if($extension==".jpg"){		header("Content-type:image/jpeg");		}else{		header("Content-type:application/octet-stream");		}		//按照字节大小返回		header("Accept-Ranges:bytes");		//返回文件大小		header("Accept-Length:$file_size");		//这里客户端弹出的对话框，对应的文件名		header("Content-Disposition:attachment;filename=".$file_name);		//向客户端回送数据		$buffer=1024;		$file_count=0;		//这句话用于判断文件是否结束		while(!feof($fp) && ($file_size-$file_count>0)){		$file_data=fread($fp,$buffer);		//统计读了多少个字节		$file_count+=$buffer;		echo $file_data; //将数据完整的输出		}		//关闭文件		fclose($fp);	}		// 发送协议到邮箱    public function sendXy()    {    	$res = array('success'=>0,'msg'=>'');    	if(!IS_POST) {    		exit;    	}        $email = $_POST['email'] ? $_POST['email'] : '';        $path = $_POST['path'] ? $_POST['path'] : '';        if(!$email){        	$res['msg'] = '请输入您的邮箱';        	echo json_encode($res);exit;        }        if(!check_email($email)) {        	$res['msg'] = '邮箱格式错误';        	echo json_encode($res);exit;	    }	    if(!$path) {	    		    	$res['msg'] = '文件不存在';        	echo json_encode($res);exit;	    }	    $path = '.' . $path;	    if(!file_exists($path)) {	    	$res['msg'] = '文件不存在';        	echo json_encode($res);exit;	    }        // $code = rand(1111, 9999);        // session(session_id().'code', md5($code.'mima'));        // session(session_id().'email',$email);        // dump($code);        // echo json_encode(array('msg'=>'验证码已发送到您的邮箱，请注意查收','status'=>1));exit;        // 实例化PHPMailer核心类        // include "/extends/phpmailer/src/PHPMailer.php";        // include "/extends/phpmailer/src/SMTP.php";        // include "/extends/phpmailer/src/Exception.php";        // $aa =$_SERVER['DOCUMENT_ROOT'];        include dirname(dirname(dirname(dirname(dirname(__FILE__)))))."/extend/phpmailer/src/PHPMailer.php";		include dirname(dirname(dirname(dirname(dirname(__FILE__)))))."/extend/phpmailer/src/SMTP.php";		include dirname(dirname(dirname(dirname(dirname(__FILE__)))))."/extend/phpmailer/src/Exception.php";		// var_dump(dirname(dirname(dirname(dirname(__FILE__)))));die;        $mail = new PHPMailer();        // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可默认关闭debug调试模式        $mail->SMTPDebug = 0;        // 使用smtp鉴权方式发送邮件        $mail->isSMTP();        // smtp需要鉴权 这个必须是true        $mail->SMTPAuth = true;        // 链接qq域名邮箱的服务器地址        $mail->Host = C('SEND_HOST');        // 设置使用ssl加密方式登录鉴权        $mail->SMTPSecure = 'ssl';        $mail->SMTPOptions = array(            'ssl' => array(                'verify_peer' => false,                'verify_peer_name' => false,                'allow_self_signed' => true            )        );        // 设置ssl连接smtp服务器的远程服务器端口号        $mail->Port = 465;        // 设置发送的邮件的编码        $mail->CharSet = 'UTF-8';        // 设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名        $mail->FromName = '星际元';        // smtp登录的账号 QQ邮箱即可        $mail->Username = C('SEND_EMAIL'); // 你的QQ邮箱        // smtp登录的密码 使用生成的授权码        $mail->Password = C('SMTP_PASSWORD');        // 设置发件人邮箱地址 同登录账号        $mail->From = C('SEND_EMAIL'); // 你的QQ邮箱        // 邮件正文是否为html编码 注意此处是一个方法        $mail->isHTML(true);        // 设置收件人邮箱地址        $mail->addAddress($email);        // 添加多个收件人 则多次调用方法即可        //$mail->addAddress('87654321@163.com');        // 添加该邮件的主题        $mail->Subject = '星际元';        // 添加邮件正文        $mail->Body = "星际元产品服务租赁协议";        // 为该邮件添加附件        $mail->addAttachment($path);        // 发送邮件 返回状态        $status = $mail->send();        if ($status) {        	$res['success'] = 1;            $res['msg'] = '发送成功！';        	echo json_encode($res);exit;        } else {            $res['msg'] = '发送失败！';        	echo json_encode($res);exit;        }    }}?>