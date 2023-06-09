<?php



Class IndexAction extends CommonAction{
	//我的奖品
	public function my_prize(){
		$my_prize = M('kly_prize_log')->where(['user_id'=>session('mid'),'prize_id'=>['neq','']])->select();
		// dump($my_prize);
		foreach($my_prize as $key=>$val){
			$my_prize[$key]['addtime'] = date('Y-m-d H:i:s',$my_prize[$key]['addtime']);
		}
		$this->assign('my_prize',$my_prize);
        $this->display();
	}
	//查看所有奖品
	public function all_prize(){
		$all_prize = M('kly_prize_set')->field('prize_name,probability')->order('probability')->select();
		foreach($all_prize as $key=>$val){
			if(ceil($all_prize[$key]['probability']) == $all_prize[$key]['probability']){
			$all_prize[$key]['probability'] = ceil($all_prize[$key]['probability']).'%';
			}else{
				$all_prize[$key]['probability'] = floatval($all_prize[$key]['probability']).'%';
			}
		}
		$this->assign('all_prize',$all_prize);
        $this->display();
	}
	//抽奖活动会场
	public function prize(){
		$prize = M('kly_prize_set')->field('prize_name')->order('probability')->limit(3)->select();
		$num = 1;
		$prize_num = 3;			//初始抽奖次数
		foreach($prize as $key=>$val){
			if($num==1){
			$prize1 = $prize[$key]['prize_name'];
			}else if($num==2){
			$prize2 = $prize[$key]['prize_name'];
			}else{
			$prize3 = $prize[$key]['prize_name'];
			}
			$num++;
		}
		$todaytime = strtotime(date('Ymd'));    // 今天零点时间戳
		$user_prize = M('kly_prize_log')->where(['user_id'=>session('mid'),'addtime'=>['egt',$todaytime]])->select();
		if($user_prize){
			$prize_num = $prize_num - count($user_prize);
		}
		// dump($user_prize);
		$this->assign('prize1',$prize1);
		$this->assign('prize2',$prize2);
		$this->assign('prize3',$prize3);
		$this->assign('prize_num',$prize_num);
        $this->display();
	}

    public function index(){
        $member = M('member');
        $username = session('username');
        $minfo = $member->where(array('username'=>$username))->find();
        $level = M('team_level_group')->where(array('level'=>$minfo['level']))->getField('name');
        $minfo['name'] = $level ? $level : '普通会员';
        $dateStr = date('Y-m-d', time());   //当天日期
        $jssj = strtotime($dateStr);   //今天0点时间戳
        $total_sl = M('order')->where(array('zt'=>1,'user'=>$username))->sum('lixi');	//总算力
		$total_sl = $total_sl ? $total_sl : 0;
		$my_sls = M('member')->where(array('username'=>$username))->getField('my_sl');	//我的算力
        $my_sls = $my_sls ? round($my_sls,2) : 0;
       
		$where['member'] = session('username');
		$where['type'] = array('in','2,3');
		$total_fh_profit = M('jinbidetail')->where($where)->sum('adds');	//累计分红收益
		$total_fh_profit = $total_fh_profit ? round($total_fh_profit,2) : 0;
		
		$minfo['suanli'] = $total_sl + $my_sls;
		
		$map['member'] = session('username');
		/*-------隐藏合伙人收益 start----------*/
// 		$map['type'] = array('in','20');     //20隐藏了
// 		$total_tj_profit = M('yuanqidetail')->where($map)->sum('adds');	//推荐合伙人收益
// 		$total_tj_profit = $total_tj_profit ? round($total_tj_profit,2) : 0;
// 		$minfo['yuanqi'] = $minfo['yuanqi'] - $total_tj_profit;
// 		$minfo['yuanqi'] = $minfo['yuanqi'] ? round($minfo['yuanqi'],2) : 0;
		/*----------隐藏合伙人收益 end---------*/
		
		$fil_adds = M('fildetail')->where(array('type'=>2,'member'=>session('username')))->sum('adds') + 0;   // 可提现产币
		$this->assign('total_fil',$fil_adds);
		
		$total_pledge_num = C("total_pledge_num") + 0;
		$total_user_sl = M('order')->where(array('zt'=>1,'user'=>$username))->sum('lixi') + 0;	//总算力
		$pt_total = M('order')->where(array('zt'=>1))->sum('lixi') + 0;	//总算力
		//用户总抵押费用
		$pinjun = M('member')->where(['parent_id'=>session('mid')])->count();
		$sr = M('kly_income_log')->where(['user_id'=>session('mid')])->sum('amount');
		if(!$sr){
		    $sr = 0;
		}
		$downline = $this->downline(session('mid'));
		$tdsy = M('kly_income_log')->where(['user_id'=> ['in',$downline]])->sum('amount');
// 		dump($tdsy);
		if(!$tdsy){
		    $tdsy = 0;
		}
		
		$this->assign('sr',$sr);
		$this->assign('tdsy',$tdsy);
		$this->assign('pinjun',$pinjun);
        $this->assign('minfo',$minfo);

        $this->display();

    }

	/**
	 * 我的资产
	 */
	 
	public function property(){
		$ipfs = $this->memberinfo['ipfs'];
		$suanli = $this->memberinfo['suanli'];
		$yuanqi = $this->memberinfo['yuanqi'];
		
		$end_time = strtotime(date('Y-m-d'));
		$start_time = $end_time - 86399;
		$map['member'] = session('username');
		$map['type'] = array('in','1,2,4');
		$total_tj_profit = M('yuanqidetail')->where($map)->sum('adds');	//推荐累计收益
		// dump($total_tj_profit);die;
		$map['type'] = array('in','5,6');
		$map['addtime'] = array('between',array($start_time,$end_time));
		$total_yesterday_profit = M('jinbidetail')->where($map)->sum('adds');	//昨日收益
		
		$where['member'] = session('username');
		$where['type'] = array('in','5,6');
		$total_fh_profit = M('jinbidetail')->where($where)->sum('adds');	//累计分红收益
		
		
		$where['type'] = array('in','3');		
		$total_gl_profit = M('yuanqidetail')->where($where)->sum('adds');	//管理累计收益
		$dateStr = date('Y-m-d', time());   //当天日期
        $jssj = strtotime($dateStr);   //今天0点时间戳
		$total_sl = M('order')->where(array('zt'=>1,'user_id'=>$this->memberinfo['id'],'kj_addtime'=>array('lt',$jssj)))->sum('lixi');	//总算力
		$user_list = M('member')->field('id,parent_id,level')->select();
        $zt_list = M('member')->where(array('parent_id'=>session('mid')))->order('id asc')->field('id,username,parent_id,level')->select();
        $levels = M('team_level_group')->select();
        
		$zt_nums = count($zt_list);
		$jt_nums = 0;
		foreach ($zt_list as &$val) {
			$nums = count($this->get_downline($user_list,$val['id']));
			$val['nums'] = $nums;
			$jt_nums += $nums;
			if($val['level'] == 0 || !$val['level']) {
				$val['level_name'] = '无';
				continue;
			}
			foreach ($levels as $value){
				if($val['level'] == $value['level']) {
					$val['level_name'] = $value['name'];
					break;
				}
			}
		}
		$all_users = $this->get_downline($user_list,session('mid'));
		$total_nums = count($all_users);
		$team_sl = $total_sl ? $total_sl : 0;
		foreach ($all_users as $val) {			
			$temp = M('order')->where(array('zt'=>1,'user_id'=>$val['id'],'kj_addtime'=>array('lt',$jssj)))->sum('lixi');	//总算力
			if($temp) {
				
				$team_sl += $temp;
			}
		}
		$this->assign("ipfs",$ipfs);
		$this->assign("suanli",$suanli);
		$this->assign("yuanqi",$yuanqi);
		$this->assign("total_yesterday_profit",$total_yesterday_profit);
		$this->assign("total_fh_profit",$total_fh_profit);
		$this->assign("total_tj_profit",$total_tj_profit);
		$this->assign("total_gl_profit",$total_gl_profit);
		$this->assign("total_sl",$total_sl);
		$this->assign('zt_nums',$zt_nums);
		$this->assign('jt_nums',$jt_nums);
		$this->assign('total_nums',$total_nums);
		$this->assign('team_sl',$team_sl);
		$this->display();
	}

	//获取用户的所有下级ID
    public function get_downline($data,$mid){
        $arr=array();
        foreach ($data as $key => $v) {
            if($v['parent_id']==$mid){
                $arr[]=$v;
                $arr = array_merge($arr,$this->get_downline($data,$v['id']));
            }
        }
        return $arr;
    }
    
	/**
	 * 充值提现明细
	 */	 
	public function wallet(){
	    $user = M('member')->where(['id'=>session('mid')])->field('yuanqi,achievement')->find();
	    $list = M('kly_up_log')->where(['user_id'=>session('mid')])->order('id desc')->select();
	    foreach ($list as $key=>$val){
	     if ($val['type'] == 1) {
            $list[$key]['type'] = "充值";
        }if ($val['type'] == 2) {
            $list[$key]['type'] = "提现";
        }if ($val['type'] == 3) {
            $list[$key]['type'] = "手续费";
        }if ($val['type'] == 4) {
            $list[$key]['type'] = "雇佣退款";
        }if ($val['type'] == 5) {
            $list[$key]['type'] = "雇佣";
        }
        $list[$key]['addtime'] = date("Y-m-d H:i",$val['addtime']);
	    $this -> assign('list',$list);
	    }
	    $this -> assign('USDT',$user['yuanqi']);
	    $this -> assign('achievement',$user['achievement']);
	    $this -> display();
	}
		/**
	 * 充值提现明细
	 */	 
	public function test(){
	    $user = M('member')->where(['id'=>session('mid')])->field('yuanqi,achievement')->find();
	    $list = M('kly_up_log')->where([['id'=>session('mid')]])->select();
	    foreach ($list as $key=>$val){
	     if ($val['type'] == 1) {
            $list[$key]['type'] = "充值";
        }if ($val['type'] == 2) {
            $list[$key]['type'] = "提现";
        }if ($val['type'] == 3) {
            $list[$key]['type'] = "手续费";
        }
        $list[$key]['addtime'] = date("Y-m-d H:i",$val['addtime']);
	    $this -> assign('list',$list);
	    }
	    $this -> assign('USDT',$user['yuanqi']);
	    $this -> assign('achievement',$user['achievement']);
	    $this -> display();
	}
	
	//充值余额
	    public function topup(){
        $user = M('member')->where(['id'=>session('mid')])->field('yuanqi')->find();
        $this -> assign('USDT',$user['yuanqi']);
	    $this -> display();
    }
	
	//充值提现流水
	public function cztxlist() {
		//流水
		$page = $_POST['page'] ? $_POST['page'] : 1;
		$type = $_POST['type'];
		$date = $_POST['date'] ? $_POST['date'] : 0;
		$wherels['member'] = session('username');
		// dump($_POST);
		$wherels['type'] = array('eq','9');
		if($date) {
			$start_time = strtotime($date);
			$end_time = $start_time + 86399;
			$wherels['addtime'] = array('between',array($start_time,$end_time));
		}
		$czlist = M('yuanqidetail')->where($wherels)->order('addtime desc')->select();
		$wherels['type'] = array('in','8,12');
		$txlist = M('jinbidetail')->where($wherels)->order('addtime desc')->select();
		if($czlist && $txlist) {
			$list = array_merge($txlist,$czlist);
		} elseif($czlist && $txlist == NULL) {
			$list = $czlist;
		} elseif($czlist == NULL && $txlist) {
			$list = $txlist;
		} else {
			$list = NULL;
		}
		if(!$list) {
			$this->success($list);
		}
		//按时间排序
		$last_names = array_column($list,'addtime');
		array_multisort($last_names,SORT_DESC,$list);
		$lists = array_slice($list, ($page - 1) * 10, 10 ,false);
		if(!count($lists)){
			$lists = NULL;
		}
		foreach($lists as &$val) {			
			$val['adds'] = round($val['adds'],2);
			$val['reduce'] = round($val['reduce'],2);
		}
		$this->success($lists);
	}

	/**
	 * 上传图片
	 */
	public function uploadImg(){
        $name = $_FILES['file']['name'];	//上传图片的名称
        $tmp = $_FILES['file']['tmp_name']; //上传图片的临时文件名，被用于在其他地方复制文件
        $uploaddir = "./Public/Uploads";//设置文件保存目录 注意包含
        if (!file_exists($uploaddir)) {
            mkdir($uploaddir, 0777, true);
        }
        
        $path = $uploaddir."/";
        $path = substr($path,1);
        $ext = $this->extend($name);	//获得图片文件名的后缀
        $pic_type = ['png','jpg','jpeg'];
        if(!in_array($ext,$pic_type)) {
            echo json_encode(array('result' => 0,'msg'=>'上传文件格式错误'));
            exit;
        }
        $image_name = time().rand(100,999).".".$ext;
        if(move_uploaded_file($tmp, $path.$image_name)){
        	echo json_encode(array('result' => 1,'msg'=>'图片导入成功!','path'=>$path.$image_name));
            return;
        }else{
            echo json_encode(array('result' => 0,'msg'=>'上传出错了'));
            return;
        }
	}
	
	
	/**
     * 获得后缀
     */
  
	public function extend($file_name){
        $extend = pathinfo($file_name);
        $extend = strtolower($extend["extension"]);
        return $extend;
    }

    /**

     * 生成验证码

     */

    public function verify(){

        ob_clean();

        import('ORG.Util.Image');

        Image::buildImageVerify(4,1,'png',55,25);

    }



    //退出系统

    public function logout(){

        //添加日志

        $desc = '会员'. session('username') .'登出';

        write_log(session('username'),'member',$desc);



        //销毁session

        //session('[destroy]');

        session('mid',null);

        session('username',null);

        session('member',null);

        session('usersecondlogin',null);

        $this->redirect(GROUP_NAME.'/Login/index');

        //$this->redirect(U('Index/Login/index'));

    }

	public function yuanqi(){
    	$userid = session("mid");
    	
    	$info = M("member")->where(array("id",$userid))->find();
    	
    	$yuanqi = $info['yuanqi'];
    	
    	$qrcode = null;
    	
    	$address = null;
    	
    	$this->assign("userid",$userid);
    	
    	$this->assign("yuanqi",$yuanqi);
    	
    	$this->display();
    }

	public function withdrawal(){
	    $user = M('member')->where(['id'=>session('mid')])->field('yuanqi')->find();
	    $bank = M('kly_bank')->where(['user_id'=>session('mid')])->find();
	    if(!$bank){
	        $this->assign("is_set",0);
	    }else{
    		$this->assign("is_set",1);
    	}
        $this -> assign('USDT',$user['yuanqi']);
	    $this -> display();
    }
    
	public function bank(){
    $bank = M('kly_bank')->where(['user_id'=>session('mid')])->find();
    $this -> assign('bank',$bank);
    $this -> display();
    }

	public function recharge(){
		$id = 1;
		$address = M("address")->where(array("id"=>$id))->find();
		$address['isshow'] = json_decode($address['isshow'],true);
		$config = M("charge_config")->find();
		$config['selection'] = json_decode($config['selection'],true);
		$this->assign("config",$config);
		$this->assign("address",$address);
		$this->display();
	}

	public function applylist(){
		if (IS_AJAX){
			$page = $_GET['page'];
			if ($_GET['list'] == "exchange"){
				// $exchange = M("exchange")->where(array("user_id"=>session("mid"),"status"=>array("neq",3),""))->order("case when status = 0 then 0 when status = 4 then 1 when status = 1 then 2 when status = 2 then 3 when status = 5 then 4 end,addtime desc")->field("id,username,ipfs,type,addtime,endtime,confirmcharge,total,status,image,remark")->page($page,5)->select();
				$exchange = M("exchange")->where(array("user_id"=>session("mid"),"status"=>array("neq",3),""))->order("addtime desc")->field("id,username,ipfs,type,addtime,endtime,confirmcharge,total,status,image,remark")->page($page,5)->select();
				foreach ($exchange as $ke => $e){
					if ($e['status'] == 0){
						$exchange[$ke]['zhuangtai'] = "申请中";
					}else if ($e['status'] == 1){
						$exchange[$ke]['zhuangtai'] = "已转换";
					}else if ($e['status'] == 2){
						$exchange[$ke]['zhuangtai'] = "已驳回";
					}else if ($e['status'] == 3){
						unset($exchange[$ke]);
					}else if ($e['status'] == 4){
						$exchange[$ke]['zhuangtai'] = "申诉中";
					}else if ($e['status'] == 5){
						$exchange[$ke]['zhuangtai'] = "已处理申诉";
					}
					$exchange[$ke]['addtime'] = date("Y-m-d H:i",$e['addtime']);
				}
				$this->ajaxReturn($exchange);
			}elseif ($_GET['list'] == "charge"){
				// $charge = M("charge")->where(array("user_id"=>session("mid"),"status"=>array("neq",3)))->order("case when status = 0 then 0 when status = 4 then 1 when status = 1 then 2 when status = 2 then 3 when status = 5 then 4 end,addtime desc")->field("id,username,charge,addtime,confirmtime,confirmcharge,total,status,image")->page($page,5)->select();
				$charge = M("charge")->where(array("user_id"=>session("mid"),"status"=>array("neq",3)))->order("addtime desc")->field("id,username,charge,addtime,confirmtime,confirmcharge,total,status,image")->page($page,5)->select();
				foreach ($charge as $kc => $c){
					if ($c['status'] == 0){
						$charge[$kc]['zhuangtai'] = "申请中";
					}else if ($c['status'] == 1){
						$charge[$kc]['zhuangtai'] = "已充值";
					}else if ($c['status'] == 2){
						$charge[$kc]['zhuangtai'] = "已拒绝";
					}else if ($c['status'] == 3){
						unset($charge[$kc]);
					}else if ($c['status'] == 4){
						$charge[$kc]['zhuangtai'] = "申诉中";
					}else if ($c['status'] == 5){
						$charge[$kc]['zhuangtai'] = "已处理申诉";
					}
					$charge[$kc]['charge'] = floatval($c['charge']);
					$charge[$kc]['total'] = number_format($c['total'],2);
					$charge[$kc]['addtime'] = date("Y-m-d H:i",$c['addtime']);
				}
				
				$this->ajaxReturn($charge);
				
			}else if ($_GET['list'] == "withdrawal"){
				// $withdrawal = M("withdrawal")->where(array("user_id"=>session("mid"),"status"=>array("neq",3),"bi"=>array("IN","ipfs,yuanqi")))->order("case when status = 0 then 0 when status = 4 then 1 when status = 1 then 2 when status = 2 then 3 when status = 5 then 4 end,addtime desc")->field("id,username,number,addtime,endtime,withdrawal,total,status,remark,image,bi")->page($page,5)->select();
				$withdrawal = M("withdrawal")->where(array("user_id"=>session("mid"),"status"=>array("neq",3),"bi"=>array("IN","ipfs,yuanqi")))->order("addtime desc")->field("id,username,number,addtime,endtime,withdrawal,total,status,remark,image,bi")->page($page,5)->select();
				foreach ($withdrawal as $k => $w){
					if ($w['status'] == 0){
						$withdrawal[$k]['zhuangtai'] = "申请中";
					}else if ($w['status'] == 1){
						$withdrawal[$k]['zhuangtai'] = "已提现";
					}else if ($w['status'] == 2){
						$withdrawal[$k]['zhuangtai'] = "已驳回";
					}else if ($w['status'] == 3){
						unset($withdrawal[$k]);
					}else if ($w['status'] == 4){
						$withdrawal[$k]['zhuangtai'] = "申诉中";
					}else if ($w['status'] == 5){
						$withdrawal[$k]['zhuangtai'] = "已处理申诉";
					}
					$withdrawal[$k]['number'] = floatval($w['number']);
					$withdrawal[$k]['total'] = number_format($w['total'],2);
					$withdrawal[$k]["addtime"] = date("Y-m-d H:i",$w['addtime']);
				}
				$this->ajaxReturn($withdrawal);
			}
			
		}else{
			$this->display();
		}
		
	
	}
	
	public function payqrcode(){
		$skm = M("member_skm")->where(array("user_id"=>session("mid")))->find();
		$this->assign("skm",$skm);
		$this->display('payqrcode2');
	}
	
	public function exchange(){
		$config = array("btc_ipfs"=>C("btc_ipfs"),"ltc_ipfs"=>C("ltc_ipfs"));
		$user = $this->memberinfo;
		$this->assign("config",$config);
		$this->assign("ipfs",$user['ipfs']);
		$this->display();
	}
	
	public function getprice(){
		$this->ajaxReturn(array("btc_ipfs"=>C("btc_ipfs"),"ltc_ipfs"=>C("ltc_ipfs")));
	}
	
	/**
	 * 上传图片
	 */
	public function reuploadImg(){
        $name = $_FILES['file']['name'];	//上传图片的名称
        $tmp = $_FILES['file']['tmp_name']; //上传图片的临时文件名，被用于在其他地方复制文件
        $uploaddir = "./Public/Uploads/fkm";//设置文件保存目录 注意包含
        if (!file_exists($uploaddir)) {
            mkdir($uploaddir, 0777, true);
        }
        
        $path = $uploaddir."/";
        $ext = $this->extend($name);	//获得图片文件名的后缀
        $pic_type = ['png','jpg','jpeg'];
        if(!in_array($ext,$pic_type)) {
            echo json_encode(array('result' => 0,'msg'=>'上传文件格式错误'));
            exit;
        }
        $image_name = time().rand(100,999).".".$ext;
        if(move_uploaded_file($tmp, $path.$image_name)){
        	$path = substr($path,1);
        	$id = $_POST['id'];
        	$r = M("charge")->where(array("id"=>$id))->save(array("image"=>$path.$image_name));
        	if ($r){
        		echo json_encode(array('result' => 1,'msg'=>'修改成功!','path'=>$path.$image_name));
        		return;
        	}else{
        		echo json_encode(array('result' => 0,'msg'=>'上传出错','data'=>$r));
            	return;
        	}
        }else{
            echo json_encode(array('result' => 0,'msg'=>'上传出错了'));
            return;
        }
	}
	
	public function service(){
	    $fxm = M('member')->where(['id'=>session('mid')])->getField('tgm');
	    $this->assign('fxm',$fxm);
		$this->display();
	}
}

?>