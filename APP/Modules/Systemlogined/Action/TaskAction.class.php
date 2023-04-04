<?php  

	/**

	* 会员管理控制器

	*/

	class TaskAction{

	    public function create_date(){
	        $today = strtotime(date("Y-m-d",time()));
	        $tomorrow = strtotime("+1day",$today);
	        $integral_rate = C('integral_rate');

	        $sale_where['kj_addtime'] = array(
	        	array('egt',$today),
	        	array('lt',$tomorrow)
	        );

	        $today_sale = M('order')->where($sale_where)->sum('sumprice');

	        $partner_level = C('partner_level');

			$all_member = M('member')->field('id,level,username,mobile')->group('level desc,id asc')->where(array("level"=>array('gt',2)))->select();


    		$level_group = M('team_level_group')->select();

    		$all_integral =  0;

    		foreach ($all_member as &$vv) {
    			$vv['level_name'] = '无';
    			$vv['integral'] = 0;
    			foreach ($level_group as &$vv2) {
    				if($vv['level']==$vv2['level']){
    					$vv['level_name'] = $vv2['name'];
    				}
    			}
    			$suanli_where['user_id'] = $vv['id'];
    			$suanli = M('order')->where($suanli_where)->sum('lixi');
    			$suanli = !empty($suanli)?$suanli:0;
    			$vv['integral'] = $suanli;
    			$all_integral+=$suanli;
    		}


			$today = strtotime(date('Y-m-d',time()));
			$where = '';
			$where['kj_addtime'] = array('lt',$today);
			$where['zt'] = 1;
			$total_suanli = M('order')->where($where)->sum('lixi');

			$average_income = round(($today_sale*$integral_rate/100)/$all_integral,2);

			$all_reward = round($all_integral*$average_income,2);

			$reward_array = array();
			foreach ($all_member as &$value) {
				$reward  = round($average_income * $value['integral'],2);
				$reward_array[] = array(
					'id'=>$value['id'],
					'username'=>$value['username'],
					'reward'=>$reward,
				);
			}
			$j_reward_array = json_encode($reward_array);

	    	$today  = date("Y-m-d",time());
	    	$data = array(
	    		'date'=> $today,
	    		'time'=> time(),
	    		'sale'=> $today_sale,
	    		'integral'=> $all_integral,
	    		'average_income'=> $average_income,
	    		'reward'=> $j_reward_array,
	    		'all_reward'=> $all_reward,
	    		'status'=> 0,
	    		'jackpot_status'=> 0
	    	);
	    	$data_exist = M('reward_status')->where(array('date'=>$today))->find();


	    	if(!$data_exist){
		    	$ret = M('reward_status')->add($data);
	    	}
	    }




	}
		




?>