<?php  	/**	 * 会员前台公共控制器	 */	Class CommonAction extends Action{		public function _initialize(){			header("Content-Type:text/html; charset=utf-8");										//判断是否关闭了网站			$open_web=C('open_web');			if(empty($open_web)){				$this->open_web_notice=C('open_web_notice');				$this->display('Index:404');					exit;			}										  		if(!isset($_SESSION['mid']) && !isset($_SESSION['username']) ){	  			$this->redirect('Index/Login/index');	  		}else{				  $memberinfo = M("member")->where(array('username'=>$_SESSION['username']))->find();				  $this->memberinfo = $memberinfo;				  M("member")->where(array('id'=>$_SESSION['mid']))->save(array('online_time'=>time()));				  			}            if ($_SESSION['username'] == 'admin') {                $this->redirect('Index/Login/index');            }					$everyday_last_time=C('everyday_last_time');			$everyday_rose=C('everyday_rose');			//判断今天是否已经更新过了			$s_time_a=strtotime(date('Y-m-d 00:00:01',time()));			$o_time_a=strtotime(date('Y-m-d 23:59:59',time()));            if($everyday_last_time < $s_time_a || $everyday_last_time > $o_time_a){                $path = './APP/Conf/system.php';                $config = include $path;                if(!empty($everyday_rose)){                    $lcsj=M('date')->order('id desc')->find();                    $jiage      = $lcsj['price']+$everyday_rose;                    $map['date']=time();                    $map['price']=$jiage;                    M('date')->add($map);                }                $config['everyday_last_time']      = time();                $data = "<?php\r\nreturn " . var_export($config, true) . ";\r\n?>";                file_put_contents($path, $data);            }						}                //获取用户的所有下级ID                public function downline($user_id){                    $user = M('member')->field('id,parent_id')->select();                    $arr = [$user_id];                    foreach ($user as $val){                        if(in_array($val['parent_id'],$arr)) {                            $arr[] = $val['id'];                        }                    }                    unset($user);                    return $arr;                }	}?>