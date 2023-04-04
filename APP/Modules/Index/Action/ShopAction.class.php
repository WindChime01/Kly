<?php  

//账号管理控制器

Class  ShopAction extends CommonAction{



	//平台签到奖励
	public function qiandao(){
	    $res = array('success'=>0,'msg'=>'');
	    $res['msg'] = '暂未开放，敬请期待！';
	    echo json_encode($res);exit;
        $s_time=strtotime(date("Y-m-d 00:00:01"));
        $o_time=strtotime(date("Y-m-d 23:59:59"));
        $user_id = $this->_mid;
        $username = $this->_username;
        $jiangli = C('qdjiangli');
        $qdzs = C('qdzs');
        $info = '签到奖励';

        $todayData = M('members_sign')->where("stime > {$s_time} and stime < {$o_time}")->count();
        $grtodayData = M('members_sign')->where("stime > {$s_time} and stime < {$o_time} and user_id  = {$user_id} ")->count();    //个人签到与否

        if($todayData < $qdzs){
            if($grtodayData == 1){
                $res['msg'] = '您今日已经签过到了,快去推广吧！';
                echo json_encode($res);exit;
            }else{
                $map['user_id'] = $user_id;
                $map['username'] = $username;
                $map['jiangli'] = $jiangli;
                $map['stime'] = time();
                $map['desc'] = $info;
                $id = M('members_sign')->add($map);

                if($id){
                    M('member')->where(array('id'=>$user_id))->setInc('jifen',$jiangli);
                    jifen($username,$jiangli,'每日签到',1,1);
                    $res['msg'] = '签到成功！';
                    $res['success'] = 1;
                    echo json_encode($res);exit;
                }else{
                    $res['msg'] = '签到失败,请重试！';
                    echo json_encode($res);exit;
                }
            }
        }else{
            $res['msg'] = '每天最多签到'. $qdzs .'人次！';
            echo json_encode($res);exit;
        }
	}





   //订单提交页面

   public function buy(){

		if(!IS_POST) {
			exit;
		}
		$res = array('success'=>0,'msg'=>'','data'=>'');
	    $userinfo = M("member")->field('id,username,level,parent_id,yuanqi,suanli,ipfs')->where(array("id"=>session("mid")))->find();
	    $product = M("product");

		$id =  $_POST['id'];
		//查询矿机信息
		$data = $product->where(array('id'=>$id))->find();
		if(empty($data)){
			$res['msg'] = '矿机不存在';
			echo json_encode($res);exit;
			alert('信息不存在',U('Emoney/shouye'));
		}


//团队结算===================================↓
       // $list = M('member')->field('id,username,parent_id,achievement')->select();
       // //无限上级同时增加总业绩

       // $this->achievement($list,$userinfo['id'],$data['gonglv']);
       // //奖励结算

       // $this->reward($userinfo,$data['price'],$data['gonglv']);

//团队结算===================================↑
   //     $status = $userinfo['status'];

   //     if($status == 0){
			// $res['msg'] = '请先实名认证';
			// $res['data'] = array('url'=>'/Index/Account/shoukuanma');
			// echo json_encode($res);exit;
   //         alert('请先实名认证',U('Account/shoukuanma'));exit;
   //     }

		//判断 是否已经达到限购数量
		$my_gounum=M("order")->where(array("user"=>session('username'),"sid"=>$id))->count();
		
		if($my_gounum >=$data['xiangou']){
			$res['msg'] = '已经达到你购买本矿机上限';
			echo json_encode($res);exit;	  
		}


		if ($_POST['paytype'] == "yuanqi"){
			M()->startTrans();	//添加事务 2020-05-19 author:mmx
			$yuanqi = $userinfo['yuanqi'];
	
			if($yuanqi < $data['price']){
				$res['msg'] = '元气值不足！';
				$res['tag'] = 'jump';
				echo json_encode($res);exit;
			}

		
			$rst = M("member")->where(array('id'=>session('mid')))->setDec('yuanqi',$data['price']);

			if(!$rst) {
				M()->rollback();
				$res['msg'] = '扣款失败！';
				echo json_encode($res);exit;
			}
	
		    jinbi(session('username'),$data['price'],'购买'.$data['title'],0,0,'yuanqi');
		    
			$map = array();
	
			$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'Q', 'Q', 'I', 'J');
	
			$map['kjbh'] = $yCode[intval(date('Y')) - 2011] . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
	
			  $map['user'] = session('username');
	
			  $map['user_id'] = session('mid');
	
			  $map['project']= $data['title'];
	
			  $map['sid'] = $data['id'];
	
			  $map['yxzq'] = $data['yszq'];		
	
	          $map['sumprice'] = $data['price'];
	
			  $map['addtime'] = date('Y-m-d H:i:s');	
	
	          $map['imagepath'] = $data['thumb'];
	
			  $map['lixi']	= $data['gonglv'];
	
			  $map['kjsl'] =  $data['shouyi'];
	
	          $map['zt'] =  1;	
	          $map['payway'] = '元气值';
	
	          $map['UG_getTime'] =  time();	
	          $map['kj_addtime'] = time();
	
			  M('order')->add($map);		
	
			  $product->where(array("id"=>$id))->setDec("stock");
	
			  //写入上级团队算力
	
			$parentpath = M("member")->where(array("username"=>session('username')))->getField("parentpath");
	
			$path2 = explode('|', $parentpath);
	
	        array_pop($path2);
	
		    $parentpath = array_reverse($path2);
	
	        foreach($parentpath as $k=>$v){
	
				 M("member")->where(array('id'=>$v))->setInc("teamgonglv",$map['lixi']);
	
	        }	
	        
	        //算力升级
	      $suanli = M("order")->where(array("user_id"=>$userinfo['id']))->sum('lixi');
	      $suanli = $suanli ? $suanli : 0;     
	      $level_array = M("team_level_group")->order('id desc')->select();
	      $user_level = M('member')->where(array("id"=>$userinfo['id']))->getField('level');
	      foreach ($level_array as  $vv) {
	        if($suanli>=$vv['condition']&&$user_level['level']<$vv['level']){
	          M('member')->where(array("id"=>$userinfo['id']))->save(array('level'=>$vv['level']));
	          break;
	        }
	      }
			$userinfo = M("member")->field('id,username,level,parent_id,yuanqi,suanli,ipfs')->where(array("id"=>session("mid")))->find();
	//团队结算===================================↓
		   // M('member')->where(array('id'=>$userinfo['id']))->setInc('achievement',$data['gonglv']);
	       // $list = M('member')->field('id,username,parent_id,achievement')->select();
	       //无限上级同时增加总业绩(算力)
	
	       // $this->achievement($list,$userinfo['id'],$data['gonglv']);
	       //奖励结算
	        $this->reward($userinfo,$data['price'],$data['gonglv']);
	//团队结算===================================↑
	
	
			   //写入个人算力
	
			  M("member")->where(array("username"=>session('username')))->setInc("mygonglv",$map['lixi']);
	
		            //写入个人矿机数量
	
			  M("member")->where(array("username"=>session('username')))->setInc('kjnum');
	
	
	
	       $user_id = session('mid');
	       
	    	$data = [
				"user_id"	=> session("mid"),
				"username"	=> session("username"),
				"paytype"	=> "yuanqi",
				"kjid"		=> $id,
				"kjname"	=> $data['title'],
				"upimg"		=> $_POST['upimg'],
				"addtime"	=> time(),
				"status"	=> 1,
				"price"		=> $data['price']
			];
			$ret = M("order_list")->add($data);
			if (!$ret){
				M()->rollback();
				$res['success'] = 0;
				$res['msg'] = "申请失败";
				echo json_encode($res);exit;
			}
			
			M()->commit();
			$res['success'] = 1;
			$res['msg'] = '购买成功';
			$res['data'] = array('url'=>'/index/shop/orderlist');
			echo json_encode($res);exit;
		}
		else if ($_POST['paytype'] == "erwei"){
			if ($_POST['upimg'] == ""){
				$res['msg'] = "请上传有效付款凭证";
			}
			$data = [
				"user_id"	=> session("mid"),
				"username"	=> session("username"),
				"paytype"	=> "erwei",
				"kjid"		=> $id,
				"kjname"	=> $data['title'],
				"upimg"		=> $_POST['upimg'],
				"addtime"	=> time(),
				"status"	=> 0,
				"price"		=> $data['price']
			];
			$ret = M("order_list")->add($data);
			if ($ret){
				$res['success'] = 1;
				$res['msg'] = "申请成功，等待管理员审核！";
				$res['data'] = array('url'=>'/index/shop/orderlist');
			}else{
				$res['success'] = 0;
				$res['msg'] = "申请失败";
			}
			echo json_encode($res);exit;
		}
   }

   /**
    * 奖励结算
    * @param $userinfo              //用户信息
    * @param $price
    * @param $leader_array          //递归上级的id
    */
   public function reward($userinfo,$price,$suanli){
 
      $leader_array = $this->leader_recursion($userinfo['id']);

      $this->sale_reward($userinfo,$price); //布道奖励

      // $this->suanli_reward($userinfo,$suanli); //Fil币奖励

      $this->partner_reward($userinfo,$price,$suanli,$leader_array);  //合伙人奖励

   }

   /**
    * 布道奖励
    * @param $userinfo                   用户信息
    * @param $price                      矿机价格
    * @param $rate                       布道奖励比例
    * @param $sale_reward                布道奖励
    * @param 
    */
   public function sale_reward($userinfo,$price){
      $rate = C('sale_rate');
      $sale_reward = $price*$rate/100;
      $leader_info = M("member")->where(array('id'=>$userinfo['parent_id']))->find();
      if($leader_info['is_partner'] == 1) {
          M("member")->where(array('id'=>$leader_info['id']))->setInc('yuanqi',$sale_reward);
	      jinbi($leader_info['username'],$sale_reward,'布道奖励',1,1,'yuanqi',$userinfo['username']);
      } else {
          $is_buy = M('order')->where(array('user_id'=>$userinfo['parent_id']))->find();
          if($is_buy){
    	      M("member")->where(array('id'=>$leader_info['id']))->setInc('yuanqi',$sale_reward);
    	      jinbi($leader_info['username'],$sale_reward,'布道奖励',1,1,'yuanqi',$userinfo['username']);
          }
      }
      
   }    

   /**
    * 管理算力
    * @param $userinfo                   用户信息
    * @param $suanli                     矿机算力
    * @param $user_rate_info             用户的Fil币奖励信息
    * @param $user_rate                  用户的Fil币奖励比例
    * @param $suanli_reward              用户的Fil币奖励
    */
   public function suanli_reward($userinfo,$suanli){
      $user_id = $userinfo['id'];
      $user_rate_info = M('level_reward_set')->where(array('level'=>$userinfo['level']))->find();
      $user_rate = $user_rate_info['rate'];
      $suanli_reward = $suanli*$user_rate/100;
      
      if($suanli_reward > 0) {
      	$leader_info = M("member")->where(array('id'=>$userinfo['parent_id']))->find(); 
      
    	 M("member")->where(array('id'=>$leader_info['id']))->setInc('my_sl',$suanli_reward);
    	jinbi($leader_info['username'],$suanli_reward,'节点代币奖励',1,2,'my_sl',$userinfo['username']);
      }
      
   }  

  /**
    * 合伙人奖励
    * @param $userinfo                     用户信息
    * @param $suanli                       矿机算力
    * @param $leader_array                 递归上级的id和等级
    * @param $partner_level_id             合伙人级别的ID
    * @param $partner_level_info           合伙人级别的信息
    * @param $partner_level                合伙人级别的level
    * @param $partner_id                   合伙人级别的用户的ID
    * @param $partner_rate                 合伙人级别的比例
    * @param $partner_reward               合伙人的奖励
    * @param $partner_info                 合伙人的信息
    */
   public function partner_reward($userinfo,$price,$suanli,$leader_array){
       foreach ($leader_array as $value) {
         if($value['is_partner']==1){
            $partner_id = $value['id'];
            break;
         }
       }

      $partner_integral_rate = C('partner_integral_rate');
      $partner_integral_reward = $price*$partner_integral_rate/100;

      if($partner_id){
      	$partner_info = M("member")->field('id,username')->where(array('id'=>$partner_id))->find(); 
    	M("member")->where(array('id'=>$partner_id))->setInc('yuanqi',$partner_integral_reward);
    	jinbi($partner_info['username'],$partner_integral_reward,'管理积分奖励',1,20,'yuanqi',$userinfo['username']); 
      }
     

   }  



  /**
    * 找出自己下面所有成员里业绩最好的成员的业绩
    * @param  $id               id
    * @return string
    */
   public function max($id){
       $list = M('member')->field('id,parent_id,achievement')->select();
       $push_member = M('member')->where(array("parent_id"=>$id))->select();

       foreach($push_member as $v){
           $push_member2['id'][]= $v['id'];
           $push_member2['achievement'][]= $v['achievement'];
       }
       $maxkey = array_search(max($push_member2['achievement']),$push_member2['achievement']);
       return $push_member2['achievement'][$maxkey];
   }

   /**
     * 无限上级同时新增业绩
     * @param $list         会员表全部数据
     * @param $id           购买矿机的会员的id
     * @param $achievement  新增的业绩
     */
   public function achievement($list,$id,$achievement){
       foreach($list as &$value){
           if($value['id']==$id){
               if($value['parent_id']!=0){
                  M('member')->where(array('id'=>$value['parent_id']))->setInc('achievement',$achievement);//自己也加上业绩
                  $arr = $this->achievement($list,$value['parent_id'],$achievement);
               }
           }
       }
   }
   
  /**
    *  递归一直找上级
    *  @param $user_id             用户的id
    *  @return $arr                返回找到的上级数组 
    */
    public function leader_recursion($user_id, $arr = array())
	   {
	       $user_info = M('member')->field('id,parent_id')->where(array("id"=>$user_id))->find();
	       if($user_info){
	        $leader_info = M('member')->field('id,level,parent_id,is_partner')->where(array("id"=>$user_info['parent_id']))->find();
	       }
	       if(!empty($leader_info)){
	           $arr[] = array(
	            'id'=>$leader_info['id'],
	            'level'=>$leader_info['level'],
	            'is_partner'=>$leader_info['is_partner'],
	           );
	           return $this->leader_recursion($leader_info['id'],$arr);
	       }
	       return $arr;
	   }



   

	public function show(){

		$id = I('id','intval',0);

		

		$info = M('order')->where(array('user'=>session('username'),'zt'=>1,'user_id'=>session('mid'),'id'=>$id))->find();



		$a_time = (time() - strtotime($info['addtime'])) / 3600;

        $info['a_time']=round($a_time,2);

		

		$this->assign('info',$info);

		$this->display();

	}

 
	//有效算力总和
	//id 用户id
	private function suanli(){		
		$dateStr = date('Y-m-d', time());   //当天日期
        $jssj = strtotime($dateStr);   //今天0点时间戳
		$total_suanli = M('order')->where(array('zt'=>1,'user_id'=>session('mid'),'kj_addtime'=>array('lt',$jssj)))->sum('lixi');
		if(!$total_suanli || $total_suanli < 0) {
			$total_suanli = 0.00;
		}
		return round($total_suanli,2);
	}
	
	//累计ipfs收益总量
	//id 用户id
	private function ipfsTotal(){
		$map['member'] = session('username');
		$map['type'] = array('in','5,6');
		$total_ipfs = M('jinbidetail')->where($map)->sum('adds');
		if(!$total_ipfs || $total_ipfs < 0) {
			$total_ipfs = 0.00;
		}
		return round($total_ipfs,2);
	}
 

   	//正常矿机

	public function orderlist(){

		// import('ORG.Util.Page');
		$count = M('order') ->where(array('user'=>session('username'),'zt'=>1,'user_id'=>session('mid')))->count();
		// $Page  = new Page($count,10);
		// $Page->setConfig('theme', '%first% %upPage% %linkPage% %downPage% %end%');
		// $show = $Page -> show();			 

        // $list = M('order')->where(array('user'=>session('username'),'zt'=>1,'user_id'=>session('mid')))->order('id desc') -> limit($Page ->firstRow.','.$Page -> listRows)->select();
		$list = M('order')->where(array('user'=>session('username'),'zt'=>1,'user_id'=>session('mid')))->order('id desc') ->select();
        foreach($list as $k=>$v) {
            // $a_time = (time() - strtotime($v['addtime'])) / 3600;
            // $list[$k]['a_time']=round($a_time,2);
            $dateStr = date('Y-m-d',$v['kj_addtime']);
            $validTime = strtotime($dateStr) + 86400;
            $list[$k]['a_time'] = ceil((time() - $validTime) / ( 3600 * 24 ));  //向上取整
        }
		$total_suanli = $this->suanli();
		$total_ipfs = $this->ipfsTotal();
        $kjnum = count($list);
		$this ->assign("kjnum",$kjnum);
		$this ->assign("suanli",$total_suanli);
		$this ->assign("ipfs",$total_ipfs);
		// $this ->assign("page",$show);
        $this->assign('list',$list);
		$this->display();
	}



    //到期矿机

    public function daoqi(){

        import('ORG.Util.Page');

        $count = M('order') ->where(array('user'=>session('username'),'zt'=>2))->count();

        // $Page  = new Page($count,10);

        // $Page->setConfig('theme', '%first% %upPage% %linkPage% %downPage% %end%');

        // $show = $Page -> show();



        $list = M('order')->where(array('user'=>session('username'),'zt'=>2))->order('id desc')->select();

        foreach($list as $k=>$v) {

            $dateStr = $v['addtime'];
            $validTime = strtotime($dateStr) + 86400;
            $list[$k]['a_time'] = ceil((time() - $validTime) / ( 3600 * 24 ));  //向上取整

        }

        // $this ->assign("page",$show);
		$kjnum = count($list);
		$total_suanli = $this->suanli();
		$total_ipfs = $this->ipfsTotal();
		$this ->assign("suanli",$total_suanli);
		$this ->assign("ipfs",$total_ipfs);
		$this ->assign("kjnum",$kjnum);
        $this->assign('list',$list);

        $this->display();

    }
    
    //查看协议/生成协议
    public function xieyi() {
    	$id = I('id');
    	$data = M('agreement')->where(array('id'=>$id))->find();
    	if(!$data) {
    		$this->error('ddd');
    	}
    	$order_data = M('order')->where(array('id'=>$data['order_id']))->find();
    	$price = intval($order_data['sumprice']);
    	$sl = $order_data['lixi'];
    	$cprice = cny($price) . '圆';
    	$order_id = $order_data['id'];
    	$this->assign('price',$price);
    	$this->assign('sl',$sl);
    	$this->assign('cprice',$cprice);
    	// dump($data);die;
    	$this->assign('order_id',$order_id);
    	$this->assign('data',$data);
    	$this->display();
    }
    
    //下载协议

	public function downloadXy(){
		$file_name = basename(I('path'));
		$file_sub_dir = dirname(I('path')) . '/';
		
		//对中文文件应该进行转码
		//$file_name=iconv("utf-8","gb2312",$file_name);
		$file_path=$_SERVER["DOCUMENT_ROOT"].$file_sub_dir.$file_name;
		$extension=substr($file_name,strrpos($file_name,"."));
		if(!file_exists($file_path)){
		echo "文件不存在";
		return;
		}
		$fp=fopen($file_path,"r");
		//获取下载文件的大小
		$file_size=filesize($file_path);
		//返回的文件
		if($extension==".jpg"){
		header("Content-type:image/jpeg");
		}else{
		header("Content-type:application/octet-stream");
		}
		//按照字节大小返回
		header("Accept-Ranges:bytes");
		//返回文件大小
		header("Accept-Length:$file_size");
		//这里客户端弹出的对话框，对应的文件名
		header("Content-Disposition:attachment;filename=".$file_name);
		//向客户端回送数据
		$buffer=1024;
		$file_count=0;
		//这句话用于判断文件是否结束
		while(!feof($fp) && ($file_size-$file_count>0)){
		$file_data=fread($fp,$buffer);
		//统计读了多少个字节
		$file_count+=$buffer;
		echo $file_data; //将数据完整的输出
		}
		//关闭文件
		fclose($fp);
	}

	//签订协议
	public function agreement() {
		$id = I('id');	//order表ID
		if(!$id){
		    $this->error('页面错误');
			echo "页面错误";exit;
		}
		$who_userid = M('order')->where(array('id'=>$id))->getField('user_id');
		if($who_userid != session('mid')) {
			$this->error('页面错误');
			echo "页面错误!";exit;		//不是自己的矿机订单
		}
		$is_old = 0;
		$addtime = M('order')->where(array('id'=>$id))->getField('kj_addtime');
		if($addtime < 1594310400) {
		    $is_old = 1;
		}
		$data = M('agreement')->where(array('order_id'=>$id))->find();
		if($data) {
			$this->assign('xieyi_id',$data['id']);
			if($data['path'] == '' || empty($data['path'])) {
				$this->assign('empty',1);
			}
		}
		$type = get_device_type();
		$this->assign('is_old',$is_old);
		$this->assign('type',$type);
		$this->assign('path',$data['path']);
		$this->assign('order_id',$id);
		$this->display();
	}
	
	
	
	//保存签名
	public function saveAgreement() {
		$res = array('success'=>0,'msg'=>'');
		/*  base64格式编码转换为图片并保存对应文件夹 */  
		$base64_content = $_POST['src_data'];
		if(!$base64_content) {
			$res['msg'] = '参数错误';
			echo json_encode($res);exit;
		}
		// echo $base64_content;die;
		
		//截取数据为数组
		$base64_content= explode(',',$base64_content); 
		
		$uploaddir = "/Public/agreement/".date('Ymd',time());//设置文件保存目录 注意包含
        if (!file_exists($uploaddir)) {
            mkdir('.'.$uploaddir, 0777, true);
        }
        
        $path = $uploaddir."/";
        $ext = 'png';	//获得图片文件名的后缀
        $tmp = base64_decode($base64_content[1]);
        $image_name = session('mid').'-'.time().".".$ext;
        // if(move_uploaded_file($tmp, $path.$image_name)){
        // 	echo json_encode(array('result' => 1,'msg'=>'签名保存成功!'));
        //     exit;
        // }else{
        //     echo json_encode(array('result' => 0,'msg'=>'上传出错了'));
        //     exit;
        // }
		
		// //生成目录：demo所在根目录下
		// // $new_file = "./".date('Ymd',time())."/";  
		// $new_file = date('Ymd',time())."/";  
		// if(!file_exists($new_file)){  
		// 	//检查是否有该文件夹，如果没有就创建，并给予最高权限  
		// 	mkdir($new_file, 0700);  
		// }
		
		// //文件后缀名
		// $type = 'png';
		// //生成文件名：相对路径
		// $new_file = $new_file.time().".$type";
		
		//转换为图片文件
		if (file_put_contents('.' . $path . $image_name,base64_decode($base64_content[1]))){
			$res['success'] = 1;
			$res['msg'] = '签名保存成功';
			$res['url'] = $path.$image_name;
			echo json_encode($res);exit;
		}else{ 
			$res['msg'] = '签名保存失败';
			echo json_encode($res);exit; 
		} 
	}
	
	//保存协议
	public function saveXy() {
		// dump('success');die;
		$res = array('success'=>0,'msg'=>'');
		/*  base64格式编码转换为图片并保存对应文件夹 */  
		$xieyi_id = $_POST['xieyi_id'];
		$base64_content = $_POST['data'];
		if(!$base64_content) {
			$res['msg'] = '参数错误';
			echo json_encode($res);exit;
		}
		// echo $base64_content;die;
		
		//截取数据为数组
		$base64_content= explode(',',$base64_content); 
		
		$uploaddir = "/Public/agreement/xieyi/".date('Ymd',time());//设置文件保存目录 注意包含
        if (!file_exists($uploaddir)) {
            mkdir('.'.$uploaddir, 0777, true);
        }
        
        $path = $uploaddir."/";
        $ext = 'pdf';	//获得图片文件名的后缀
        $tmp = base64_decode($base64_content[1]);
        $image_name = session('mid').'_xy'.time().".".$ext;
        // if(move_uploaded_file($tmp, $path.$image_name)){
        // 	echo json_encode(array('result' => 1,'msg'=>'签名保存成功!'));
        //     exit;
        // }else{
        //     echo json_encode(array('result' => 0,'msg'=>'上传出错了'));
        //     exit;
        // }
		
		// //生成目录：demo所在根目录下
		// // $new_file = "./".date('Ymd',time())."/";  
		// $new_file = date('Ymd',time())."/";  
		// if(!file_exists($new_file)){  
		// 	//检查是否有该文件夹，如果没有就创建，并给予最高权限  
		// 	mkdir($new_file, 0700);  
		// }
		
		// //文件后缀名
		// $type = 'png';
		// //生成文件名：相对路径
		// $new_file = $new_file.time().".$type";
		
		//转换为图片文件
		if (file_put_contents('.' . $path . $image_name,base64_decode($base64_content[1]))){
			
			$rst = M("agreement")->where(array('id'=>$xieyi_id))->save(array('path'=>$path.$image_name));
			if($rst){
				$res['success'] = 1;
				$res['msg'] = '生成协议成功';
				$res['url'] = $path.$image_name;
				echo json_encode($res);exit;
			}
			$res['msg'] = '生成协议失败';
			echo json_encode($res);exit;			
		}else{ 
			$res['msg'] = '生成协议失败';
			echo json_encode($res);exit; 
		} 
	}

	//保存协议
	public function agreementHandel(){
		if(!IS_POST) {
			exit;
		}
		$res = array('success'=>0,'msg'=>'');
		$data['addtime'] = time();
		$data['jiafang'] = $_POST['jiafang'];
		$data['idnum'] = $_POST['idnum'];
		$data['address'] = $_POST['address'];
		$data['phone'] = $_POST['phone'];
		$data['sign'] = $_POST['sign'];
		$data['agreement_num'] = 'GDXJY-2020-' . date('mdHis',time());
		$data['order_id'] = $_POST['order_id'];
		
// 		$addtime = M('order')->where(array('id'=>$data['order_id']))->getField('kj_addtime');
// 		if($addtime < 1594310400) {
// 		    $res['msg'] = '2020年7月10号之前购买的矿机如未签署协议，请联系客服签署纸质版协议！谢谢！';
// 			echo json_encode($res);exit;
// 		}
		if($data['order_id'] == '' || !$data['order_id']) {
			$res['msg'] = '参数错误';
			echo json_encode($res);exit;
		}
		$is_in = M('agreement')->where(array('order_id'=>$data['order_id']))->find();
		if($is_in) {
			$res['msg'] = '不能重复签署该协议！';
			echo json_encode($res);exit;
		}
		if($data['jiafang'] == '') {
			$res['msg'] = '请输入甲方信息';
			echo json_encode($res);exit;
		}
		if($data['idnum'] == '') {
			$res['msg'] = '请输入身份证或护照信息';
			echo json_encode($res);exit;
		}
// 		if(!validation_filter_id_card($data['idnum'])) {
// 			$res['msg'] = '身份证信息不正确';
// 			echo json_encode($res);exit;
// 		}
		if($data['address'] == '') {
			$res['msg'] = '请输入联系地址';
			echo json_encode($res);exit;
		}
		if($data['phone'] == '') {
			$res['msg'] = '请输入联系电话';
			echo json_encode($res);exit;
		}
		if(!check_mobile($data['phone'])) {
			$res['msg'] = '联系电话不正确';
			echo json_encode($res);exit;
		}
		if($data['sign'] == '') {
			$res['msg'] = '请确认您的签名';
			echo json_encode($res);exit;
		}
		$rst = M('agreement')->add($data);
		if($rst) {
			$res['success'] = 1;
			$res['msg'] = '保存成功,即将前往为您生成协议';
			$res['data'] = $rst;
			echo json_encode($res);exit;
		} else{
			$res['保存失败'];
			echo json_encode($res);exit;
		}
	}
	
	

    //一键结算

    public function jiesuan(){

        $user_id=session('mid');

        $username=session('username');

        //判断与上次结算时间有没有达到24小时

        /*        $jiesuan_time=C('jiesuan_time');

                if(empty($jiesuan_time)){

                    $jiesuan_time=24;

                }*/



        $jssj = time() - 24*3600;

       // $jssj = time() - 1800;



        $costData = M('order')->where("user = $username and user_id = $user_id and zt = 1 and UG_getTime < $jssj")->select();

        if (!$costData) 

        {

          alert('暂无可结算矿机！',U('Index/Shop/orderlist'));

          exit;

        }

        foreach ($costData as $k => $v) 

        {

            // 结算

            $a_time = $v['UG_getTime']?$v['UG_getTime']:strtotime($v['addtime']);

            $time1  = time()-$a_time;

            $shouyi = ($time1/3600)*$v['kjsl'];//本次收益

            M('order')->where(array('id'=>$v['id']))->setInc('already_profit',$shouyi);

            M('order')->where(array('id'=>$v['id']))->save(array('UG_getTime'=>time()));



            M('member')->where(array('username'=>$username))->setInc("jinbi",$shouyi);

            jinbi($username,$shouyi,'矿机收益',1);



        }

        alert('结算成功！',U('Index/Shop/orderlist'));



        // $p_id = M('order')->where("user = $username and user_id = $user_id and zt = 1 and UG_getTime < $jssj")->getField('id');

        // if(!empty($p_id)){

        //     for($i=1;$i<=50;$i++){

        //         $order=M('order')->where("user = $username and user_id = $user_id and zt = 1 and UG_getTime < $jssj")->order('id asc')->find();



        //         if(!empty($order)){



        //             /*       if(time()-$order['UG_getTime'] > $jiesuan_time*3600){*/

        //             if(time()-$order['UG_getTime'] > 1800){

        //                 //算出已经结算的时间

        //                 $a_time=$order['UG_getTime']-strtotime($order['addtime']);

        //                 //本次将要结算的时间

        //                 $n_time=time()-$order['UG_getTime'];



        //                 $data=array();

        //                 $data['UG_getTime']=time();

        //                 if($a_time+$n_time > $order['yxzq']*3600){



        //                     $time=($order['yxzq']*3600)-$a_time;

        //                     $data['zt']=2;

        //                     //扣除我的算力

        //                     M('member')->where(array('id'=>$user_id))->setDec("mygonglv",$order['lixi']);

        //                 }else{

        //                     $time=$n_time;

        //                 }



        //                 $shouyi=($time/3600)*$order['kjsl'];//本次收益



        //                 M('order')->where(array('user_id'=>$user_id,'zt'=> 1,'id'=>$order['id']))->setInc('already_profit',$shouyi);

        //                 M('order')->where(array('user_id'=>$user_id,'zt'=> 1,'id'=>$order['id']))->save($data);



        //                 M('member')->where("id = {$user_id}")->setInc("jinbi",$shouyi);

        //                 jinbi($username,$shouyi,'矿机收益',1);

        //             }



        //             if(empty($order['id'])){

        //                 break;

        //             }

        //         }else{



        //             break;

        //         }

        //     }

        // }



    }

	//矿机详情页面
	public function detail(){
		$id = I('get.id');
        $where = array(
            'id' => $id,
            'is_on' => 0
        );
        $address = M("address")->where("id = 1")->find();
        $address['isshow'] = json_decode($address['isshow'],true);
        $data = M("product")->where($where)->find();
        $num = M('order')->where(array('sid'=>$id))->count(); //已购数量
        $this->assign("address",$address);
        $this->assign('gift_detail',$data);
        $this->assign('num',$num + $data['basic_num']);
        $this->display();
	}
	
	public function uploadfkm(){
        $name = $_FILES['file']['name'];	//上传图片的名称
        $tmp = $_FILES['file']['tmp_name']; //上传图片的临时文件名，被用于在其他地方复制文件
        $uploaddir = "./Public/Uploads/shopfkm";//设置文件保存目录 注意包含
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
        	echo json_encode(array('result' => 1,'msg'=>'图片上传成功!','path'=>'/Public/Uploads/shopfkm/'.$image_name));
            return;
        }else{
            echo json_encode(array('result' => 0,'msg'=>'上传出错了'));
            return;
        }
	}
	
	public function extend($file_name){
        $extend = pathinfo($file_name);
        $extend = strtolower($extend["extension"]);
        return $extend;
    }
	

	public function index(){
	    $data =I('post.');
        $user = M('member')->where(['id'=>session('mid')])->field('yuanqi')->find();
        $hire_day = M('kly_goods')->field('hire_day')->order('hire_day')->select();
        $this -> assign('USDT',$user['yuanqi']);
        $this -> assign('hire_day',$hire_day);
	    $this -> display();
	}
	
	public function orderrecord(){
		function paytypename($type){
			if ($type == "erwei"){
				return "现金";
			}else if ($type == "yuanqi"){
				return "元气值";
			}
		}
		
		function zhuangtai($status){
			if ($status == 0){
				return "待审核";
			}else if ($status == 1){
				return "已租赁";
			}else if ($status == 2){
				return "已拒绝";
			}else if ($status == 4){
				return "申诉中";
			}else if ($status == 5){
				return "已处理申诉";
			}
		}
		if (IS_AJAX){
			$page = $_GET['page']?$_GET['page']:1;
			$get = M("order_list")->where(array("username"=>session("username"),"status"=>array("neq",3)))->order("case when status = 0 then 0 when status = 4 then 1 when status = 1 then 2 when status = 2 then 3 when status = 5 then 4 end,addtime desc")->page($page,5)->select();
			foreach ($get as &$v){
				$v['addtime'] = date("Y-m-d H:i",$v['addtime']);
				$v['paytypename'] = paytypename($v['paytype']);
				$v['zhuangtai'] = zhuangtai($v['status']);
			}
			$this->ajaxReturn($get);
		}else{
			$this->display();
		}
		
	}
	
	/**
	 * 上传图片
	 */
	public function reuploadImg(){
        $name = $_FILES['file']['name'];	//上传图片的名称
        $tmp = $_FILES['file']['tmp_name']; //上传图片的临时文件名，被用于在其他地方复制文件
        $uploaddir = "./Public/Uploads/shopfkm";//设置文件保存目录 注意包含
        if (!file_exists($uploaddir)) {
            mkdir($uploaddir, 0777, true);
        }
        
        $path = $uploaddir."/";
        $ext = $this->extend($name);	//获得图片文件名的后缀
        $image_name = time().rand(100,999).".".$ext;
        if(move_uploaded_file($tmp, $path.$image_name)){
        	$path = substr($path,1);
        	$id = $_POST['id'];
        	$r = M("order_list")->where(array("id"=>$id))->save(array("upimg"=>$path.$image_name));
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
	
	public function shensu_post(){
		$get = $_POST;
		$info = [
			"shensu"	=> $get['shensu'],
			"status"	=> 4
		];
		$ret = M("order_list")->where(array("id"=>$get['id']))->save($info);
		if ($ret){
			$this->ajaxReturn(array("msg"=>"申诉成功","success"=>1));
		}else{
			$this->ajaxReturn(array("msg"=>"申诉失败","success"=>0));
		}
		
	}

}

?>