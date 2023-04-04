<?php

class TimingAction extends Action{
    //每日雇佣收益
   
        public function income(){ 
        // dump(1);die;
        $income_log = M('kly_income_log')->order('id desc')->find();
        $time = strtotime(date('Ymd'));    // 今天零点时间戳
        // dump($time);die;
        if($time>$income_log['addtime']){
        $id = M('kly_gy')->where(['status'=>0])->field('id')->select();
        // dump($id);
        foreach ($id as $key=>$val) {
            $data = M('kly_gy')->where(['id'=>$val['id'],'status'=>0])->find();
            // dump($data);die;
            if($data){
                $income = M('kly_goods')->where(['id'=>$data['goods_id']])->getField('income'); //每日收益
                // dump($income);die;
                $USDT = M('member')->where(['id'=>$data['user_id']])->getField('yuanqi');
                $USDTs = $USDT+$income;
                $up_USDT = M('member')->where(['id'=>$data['user_id']])->save(['yuanqi'=>$USDTs]);
                $log = [
                        'user_id' => $data['user_id'],
                        'type' => 1,
                        'amount' => $income,
                        'addtime' => time(),
                        'status' => 1,
                        'desc' =>'雇佣奖励'
                    ];
                $logs = M('kly_income_log')->add($log);
            }
        }
        $this ->ajaxReturn(array("msg"=>"奖励发放成功","success"=>1));
        exit('ok');
    }else {
        $this ->ajaxReturn(array("msg"=>"今天已发放奖励","success"=>-1));
    }
    }
        public function reward(){
            $up_downline = $this->up_downline(30618);
            // dump($a);
            // dump($up_downline);
            $nowlevel = M('member')->where(['id'=>30618])->getField('weighted_level');
            $goods = 500;
            $levels = 0;
            $rewards =0;
            foreach ($up_downline as $val){
                $level = M('member')->where(['id'=>$val])->getField('weighted_level');
                $amount = M('kly_level')->where(['level'=>$level])->getField('price');
                // dump($level);die;
                if($levels>$level){
                    $rewards = 0;
                }
                if($level>0){
                    $reward =  $goods*$amount-$rewards;
                    // dump($amount);die;
                    $rewards = $reward;
                    // dump($rewards);
                    $levels = $level;
                    echo 'id'.$val.'获得佣金'.$reward.'<br>';
                }
        }
        }
        public function up_downline($user_id){
           $id = M('member')->where(['id'=>$user_id])->getField('parent_id');
           $arr = $id;
           $up_id = [];
           while($arr){
               $superior = M('member')->where(['id'=>$arr])->getField('parent_id');
            //   dump($superior);
               $up_id[] = $arr;
               $arr = $superior;
           }
           return $up_id;
        }
        
                //获取用户的所有下级ID
        public function downline($user_id){
            $id = M('member')->where(['id'=>$user_id])->getField('id');
            $user = M('member')->field('id,parent_id')->select();
            $arr = [$id];
            foreach ($user as $val){
                if(in_array($val['parent_id'],$arr)) {
                    $arr[] = $val['id'];
                }
            }
            unset($user);
            return $arr;
        }
}