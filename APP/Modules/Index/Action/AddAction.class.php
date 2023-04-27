<?php
Class AddAction extends CommonAction{
    //抽奖
    public function prize(){ 
        $todaytime = strtotime(date('Ymd'));    // 今天零点时间戳
		$user_prize = M('kly_prize_log')->where(['user_id'=>session('mid'),'addtime'=>['egt',$todaytime]])->select();
        if(count($user_prize)<3){
        $data = M('kly_prize_set')->order('probability')->select();
        // dump($data);die;
        $res = rand(1,10000);
        // dump($res);die;
        foreach ($data as $key=>$val){
            // dump($data[$key]['probability']);die;
            if($res<$data[$key]['probability']*100){
                // dump($data[$key]['name']);
                // $max = $res;
                $name = $data[$key]['prize_name'];
                $data = [
                    'user_id'=>session('mid'),
                    'prize_name'=>$name,
                    'prize_id'=>$data[$key]['id'],
                    'addtime'=>time(),
                ];
                $add = M('kly_prize_log')->add($data);
                    $this ->ajaxReturn(array("msg"=>"恭喜中奖,奖品为".$name.'',"success"=>1));
                    die;
            }
        }
        $data = [
            'user_id'=>session('mid'),
            'prize_name'=>'未中奖',
            'addtime'=>time(),
        ];
        $add = M('kly_prize_log')->add($data);
        $this ->ajaxReturn(array("msg"=>"很遗憾未中奖","success"=>1));
    }else{
        $this ->ajaxReturn(array("msg"=>"今日抽奖次数已用完","success"=>-1));
    }
    }
    //签到
    public function sign_in(){
        $userinfor = M('kly_sign_log')->where(['user_id'=>session('mid')])->order('sign_time desc')->find();      //最近签到的时间
        $nowtime = strtotime(date('Ymd'));  //今日零点时间戳
        if($userinfor['sign_time']>$nowtime){
            $this->ajaxReturn(array("msg"=>"今日已签到,已连续签到".$userinfor['sign_number'].'天',"success"=>-1));
        }
        $yesterday_time = strtotime(date('Ymd',time()-86399));  //昨日零点时间戳
        if($userinfor['sign_time']>$yesterday_time){
            $sign_number = $userinfor['sign_number'] + 1;
        }else{
            $sign_number = 1;
        }
        $data = [
            'user_id'=>session("mid"),
            'sign_time'=>time(),
            'sign_number'=>$sign_number,
        ];
        if($sign_number<4){
            $reward = M('kly_sign_reward')->where(['id'=>1])->getField('reward');
        }else if($sign_number<7){
            $reward = M('kly_sign_reward')->where(['id'=>2])->getField('reward');
        }else{
            $reward = M('kly_sign_reward')->where(['id'=>3])->getField('reward');
        }
        $reward_log = [
            'user_id'=>session("mid"),
            'reward'=>$reward,
            'addtime'=>time(),
            'sign_number'=>$sign_number,
        ];
        $reward_add = M('kly_sign_reward_log')->add($reward_log);
        $add =  M('kly_sign_log')->add($data);
        if($add and $reward_add){
        $this->ajaxReturn(array("msg"=>"签到成功,已连续签到".$sign_number.'天,获得'.$reward.'积分',"success"=>1));
       }else{
        $this->ajaxReturn(array("msg"=>"签到失败,请联系客服查询情况","success"=>1));
       }
    }
    //雇佣
    public function test(){                     
        $data =I('post.');
        // dump($data);die;
        // $data = json_encode($data);
        $data['user_id'] = session('mid');
        $data['createtime'] = time();
        $data['status'] = 0;
        $goods_id = M('kly_goods')->where(['hire_day'=>$data['hire_day']])->getField('id');
        $data['goods_id'] = $goods_id;
        // dump($data);
        if(empty($data['hire_day'])){
            $this->ajaxReturn(array("msg"=>"请选择雇佣天数","success"=>-1));
        }
        if(empty($data['coin'])){
            $this->ajaxReturn(array("msg"=>"请选择币种","success"=>-1));
        }
        if(empty($data['password'])){
            $this->ajaxReturn(array("msg"=>"请输入交易密码","success"=>-1));
        }
        $passwords = M('member')->where(['id'=>$data['user_id']])->find();
        $password = md5($data['password']);
        if(!($password == $passwords['password'])){
            $this->ajaxReturn(array("msg"=>"交易密码错误请重试","success"=>-1));
        }
        include_once "plugins/payment/ZFB/Demo.php";
        $pay = new \Demo;
        $res = $pay->pc($data);
        if($res['code']!=10000){
            $this->ajaxReturn(array("msg"=>$res['msg'],"success"=>-1));         //支付调用失败返回失败信息
        }
        M('kly_up_log')->add($datas);
        $USDT = M('member')->where(['id'=>$data['user_id']])->find();
        $newUSDT = $USDT['yuanqi']-$data['amount'];

        if($newUSDT>0){
          $add = M('kly_gy')->add($data);
          $datas = [
                'user_id' => session('mid'),
                'type' => 5,
                'amount' => $data['amount'],
                'pay_time' => time(),
                'addtime' => time(),
            ];

          $USDTs = M('member')->where(['id'=>$data['user_id']])->setField('yuanqi',$newUSDT);
          $this->ajaxReturn(array("msg"=>"雇佣成功","success"=>1));
        }else{
            $this->ajaxReturn(array("msg"=>"余额不足","success"=>-1));
        }
    }
    
    //雇佣列表
    public function gy_list(){              
        if (IS_AJAX){
			$page = $_GET['page'];
			if ($_GET['list'] == "charge"){
				$gy = M("kly_gy")->where(["user_id"=>session("mid")])->order('id desc')->page($page,5)->select();
				// dump($gy);die;
				foreach ($gy as $ke => $e){
					$gy[$ke]['createtime'] = date("Y-m-d H:i",$e['createtime']);
				}
				$this->ajaxReturn($gy);
			}
    }
    }
    
    //雇佣列表取消
    public function gy_qx(){
        $id = I('post.id');
        // dump($id);
        $save = M('kly_gy')->where(['id'=>$id])->save(['status'=>2]);
        if($save){
            $amount = M('kly_gy')->where(['id'=>$id])->find();
            $USDT = M('member')->where(['id'=>session('mid')])->find();
            $newUSDT = $USDT['yuanqi']+$amount['amount'];
            // dump($newUSDT);die;
            $USDTs = M('member')->where(['id'=>session('mid')])->setField('yuanqi',$newUSDT);
            if($USDTs){
                $data = [
                        'user_id' => session('mid'),
                        'type' => 4,
                        'amount' => $amount['amount'],
                        'addtime' => time(),
                    ];
                    M('kly_up_log')->add($data);
                $this->ajaxReturn(array("msg"=>"取消成功,佣金已退还","success"=>1));
            }
          
    }else{
         $this->ajaxReturn(array("msg"=>"取消失败","success"=>-1));
    }
    }
    
    //充值
    public function up(){
        $data = I('post.');
        if(empty($data['password'])){
        $this->ajaxReturn(array("msg"=>"请输入交易密码","success"=>-1));
        }
        $data['user_id'] = session('mid');
        $data['addtime'] = time();
        $data['type'] = 1;
        $data['icon'] = 'USDT';
        $data['createtime'] = time();
        $passwords = M('member')->where(['id'=>$data['user_id']])->find();
        $password = md5($data['password']);
        if(!($password == $passwords['password'])){
            $this->ajaxReturn(array("msg"=>"交易密码错误请重试","success"=>-1));
        }
        
        $add = M('kly_up_log')->add($data);
        // $add =1;
        if($add){
            $USDT = M('member')->where(['id'=>$data['user_id']])->find();
            $newUSDT = $USDT['yuanqi']+$data['amount'];
            // dump($newUSDT);die;
            $USDTs = M('member')->where(['id'=>$data['user_id']])->setField('yuanqi',$newUSDT);
          $this->ajaxReturn(array("msg"=>"充值成功","success"=>1));
        }else{
            $this->ajaxReturn(array("msg"=>"充值失败","success"=>-1));
        }
    }
        public function withdrawal(){
        $data = I('post.');
	    $bank = M('kly_bank')->where(['user_id'=>session('mid')])->find();
	    if(!$bank){
	        $this->ajaxReturn(array("msg"=>"请先绑定银行卡信息再进行提现","success"=>-1));
	    }
        if(empty($data['password'])){
        $this->ajaxReturn(array("msg"=>"请输入交易密码","success"=>-1));
        }
        $data['user_id'] = session('mid');
        $data['addtime'] = time();
        $data['type'] = 2;
        $data['pay_type'] = 'bank';
        $data['fee'] = $data['amount'] * 0.06;
        $data['money'] = $data['amount']- ($data['amount'] * 0.06);
        $data['bank_name'] = $bank['bank_name'];
        $data['sub_branch'] = $bank['sub_branch'];
        $data['account_bank'] = $bank['account_bank'];
        $data['account_name'] = $bank['account_name'];

        // dump($data['fee']);die;
        $passwords = M('member')->where(['id'=>$data['user_id']])->find();
        $password = md5($data['password']);
        if(!($password == $passwords['password'])){
            $this->ajaxReturn(array("msg"=>"交易密码错误请重试","success"=>-1));
        }
        
            $USDT = M('member')->where(['id'=>$data['user_id']])->find();
            $newUSDT = $USDT['yuanqi']-$data['amount'];
            // dump($newUSDT);die;
        if($newUSDT>0){
          $add = M('kly_up_log')->add($data);
          $USDTs = M('member')->where(['id'=>$data['user_id']])->setField('yuanqi',$newUSDT);
          $withdrawal = M('kly_withdrawal')->add($data);
          $this->ajaxReturn(array("msg"=>"提现请求成功","success"=>1));
        }else{
            $this->ajaxReturn(array("msg"=>"余额不足","success"=>-1));
        }
    }
    public function bank(){
        $data = I('post.');
        $data['user_id'] = session('mid');
            if(!($data['bank_name'])){
        $this->ajaxReturn(array("msg"=>"请输入银行名称","success"=>-1));
        }
            if(!($data['sub_branch'])){
        $this->ajaxReturn(array("msg"=>"请输入开户银行","success"=>-1));
        }
            if(!($data['account_bank'])){
        $this->ajaxReturn(array("msg"=>"请输入银行卡号","success"=>-1));
        }
            if(!($data['account_name'])){
        $this->ajaxReturn(array("msg"=>"请输入银行账户名","success"=>-1));
        }
        $bank = M('kly_bank')->where(['user_id'=>session('mid')])->find();
            if(!$bank){
        $data['addtime'] = time();
        $data['createtime'] = time();
        $add = M('kly_bank')->add($data);
            if($add){
        $this->ajaxReturn(array("msg"=>"提交成功","success"=>1));
        }else{
        $this->ajaxReturn(array("msg"=>"提交失败","success"=>-1));
        }
        }else{
        $data['createtime'] = time();
        $save = M('kly_bank')->where(['user_id'=>session('mid')])->save($data);
            if($save){
        $this->ajaxReturn(array("msg"=>"修改信息成功","success"=>1));
        }else{
        $this->ajaxReturn(array("msg"=>"信息与之前一致，修改信息失败","success"=>-1));
        }
        }
    }
    public function bank_delete(){
        $bank = M('kly_bank')->where(['user_id'=>session('mid')])->find();
        if($bank){
            $delete = M('kly_bank')->where(['user_id'=>session('mid')])->delete();
            if($delete){
                $this->ajaxReturn(array("msg"=>"解绑成功","success"=>1));
            }else{
                $this->ajaxReturn(array("msg"=>"解绑失败","success"=>-1));
            }
        }else{
            $this->ajaxReturn(array("msg"=>"未绑定银行卡","success"=>-1));
        }
    }
}