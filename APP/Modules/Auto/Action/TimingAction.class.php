<?php
header("Content-Type:text/html;charset=utf-8");
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
        public function reward($id){
            $up_downline = $this->up_downline($id);
            // dump($a);
            // dump($up_downline);
            $nowlevel = M('member')->where(['id'=>$id])->getField('weighted_level');
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
        //获取用户上级ID(不包括自己)
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
        
        //获取用户的所有下级ID(包括自己)
        public function downline($user_id){
            $user = M('member')->field('id,parent_id')->select();
            $arr = [$user_id];
            foreach ($user as $val){
                if(in_array($val['parent_id'],$arr)) {
                    $arr[] = $val['id'];
                }
            }
            unset($user);
            return $arr;
        }
        //写族谱
        public function parentpath($id){
               $up_id = $this->up_downline($id);
               $reverse = array_reverse($up_id);
               $parentpath = implode('|',$reverse);
               $save = M('member')->where(['id'=>$id])->save(['parentpath'=>$parentpath]);
               if($save){
                return true;
               }else{
                return false;
               }
        }
        //假自动入单
        public function voucher($id){
            $userinfo = M('member')->where(['id'=>$id])->find();
            if(!$userinfo['parent_id'] and !$userinfo['parentpath']){
            $user = M('member')->field('id')->order('id')->select();
            // dump($user);
            foreach($user as $val){
                $parent = M('member')->where(['parent_id'=>$val['id']])->select();
                // dump($parent);
                if(count($parent)>1){
                    continue;
                }else{
                    $save = M('member')->where(['id'=>$id])->save(['parent_id'=>$val['id']]);
                    $parentpath = $this->parentpath($id);
                    dump('账号ID'.$id.'已自动绑定上级'.$val['id']);
                    die;
                }
            }
        }else{
            dump('该ID'.$id.'已绑定上级');
        }
        }
        //真自动入单    缺陷：顶级账户下级不足两人无法使用
        public function vouchers(){
            $id = 30614;
            $userinfo = M('member')->where(['id'=>$id])->find();
            $maxuser = M('member')->order('id')->find();
            $user = M('member')->where(['parent_id'=>$maxuser['id']])->field('id,prelogintime')->order('prelogintime')->select();
            $arr = [];
            foreach ($user as $val){
                $arr[] = $val['id'];
            }
            if(!$userinfo['parent_id'] and !$userinfo['parentpath']){
            while($arr){
                //把下级ID保存一下
                $user_id = $arr;
                //销毁$arr数组里的数据让数据更新
                unset($arr);
                $arr = [];
                    foreach($user_id as $val){
                        $users = M('member')->where(['parent_id'=>$val])->field('id,prelogintime')->order('prelogintime')->select();
                        if(count($users)>1){
                        foreach($users as $val){
                        $arr[] = $val['id'];
                        }
                    }else{
                        M('member')->startTrans();      //开启事务
                        $parent = M('member')->where(['id'=>$id])->save(['parent_id'=>$val]);
                        $parentpath = $this->parentpath($id);
                        $judgment = M('member')->where(['id'=>$id])->find();
                        if($judgment['parent_id'] and $judgment['parentpath']){
                            dump('该账户'.$id.'已自动绑定'.$val);
                            M('member')->commit();          //提交事务
                            die;
                        }else{
                            dump('绑定失败');
                            M('member')->rollback();        //事务回滚
                            die;
                        }
                    }
                    }
            }
        }else{
            dump('该账户'.$id.'已绑定上级不可再次绑定');
        }
        }
        //更新团队业绩
        public function achievement(){
            $user_id = M('member')->select();
            foreach($user_id as $val){
                $achievement = M('member')->where(['id'=>['in',array_slice($this->downline($val['id']),1)]])->sum('yuanqi');
                $up = M('member')->where(['id'=>$val['id']])->save(['achievement'=>$achievement]);
                if($up){
                dump($val['id'].'账号更新'.$achievement.'团队业绩');
                }
            }
        }
        //改上级，团队解绑并更改族谱
        public function unbind(){
            // die('404');
            $id = 29929;        //需要更改ID
            $old_id = $this->up_downline($id);      //旧上级
            $ids = 29935;       //新上级
            //改个人上级以及个人族谱
            M('member')->startTrans();      //开启事务
            $downline_count = M('member')->where(['parent_id'=>$ids])->count();
            if($downline_count<2){
            $change = M('member')->where(['id'=>$id])->save(['parent_id'=>$ids]);
            $parentpath = $this->parentpath($id);
            if(!$change and $parentpath==false){
                dump('改写个人上级或个人族谱失败');
                M('member')->rollback();        //事务回滚
                die;
            }
            //改下级族谱
            $downline = array_slice($this->downline($id),1);
            foreach($downline as $val){
                $downline_parentpath = $this->parentpath($val);
                if($downline_parentpath == false){
                    dump('改写下级族谱失败');
                    M('member')->rollback();        //事务回滚
                    die;
                }
            }
            //调整业绩
            $parentpaths = M('member')->where(['id'=>$id])->getField('parentpath');
            $parent = explode('|',$parentpaths);
            //下级业绩与个人业绩之和
            $performance = M('member')->where(['id'=>['in',$this->downline($id)]])->sum('yuanqi');      
            // dump($performance);die;
            //减旧上级团队业绩
            $Dec = M('member')->where(['id'=>['in',$old_id]])->setDec('achievement',$performance);
            if($Dec){
                dump('扣除ID'.$id.'旧上级业绩'.$performance);
            }else{
                dump('扣除ID'.$id.'旧上级业绩失败');
            }
            //加新上级团队业绩
            $Inc = M('member')->where(['id'=>['in',$this->up_downline($id)]])->setInc('achievement',$performance);
            if($Inc){
                dump('增加ID'.$id.'新上级业绩'.$performance);
            }else{
                dump('增加ID'.$id.'新上级业绩失败');
            }
            if($Dec and $Inc){
                M('member')->commit();          //提交事务
            }else{
                M('member')->rollback();        //事务回滚
            }
    }else{
        dump('该ID'.$ids.'下级已满');
    }

        }
}