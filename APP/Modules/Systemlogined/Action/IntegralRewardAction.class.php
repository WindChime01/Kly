<?php  



	/**

	* 会员管理控制器

	*/

	class IntegralRewardAction extends CommonAction{

		/**
		  * 节点分红列表
		  * @param  $integral_rate             公司销售额比例
		  * @param  $today                     今天零点的时间戳
		  * @param  $yesterday                 昨天零点的时间戳
		  * @param  $pass_member               等级大于G2的用户
		  * @param  $pass_id_array             等级大于G2的用户id
		  * @return $suanli_where			   总积分的条件
		  * @return $today_sale			       今天的销售额
		  * @return $large				       大区的业绩
		  * @return $total				       总业绩
		  * @return $little_sum				   小区的总和业绩
		  */
		public function integral_reward_list(){

			$Data = M('jinbidetail'); // 实例化Data数据对象
			
			import("@.ORG.Util.Page");// 导入分页类

	        $integral_rate = C('integral_rate');

	        $today = strtotime(date("Y-m-d",time()));
	        $yesterday = strtotime("-1day",$today);

	        $sale_where['kj_addtime'] = array(
	        	array('egt',$yesterday),
	        	array('lt',$today)
	        	
	        );



	        $suanli_where['kj_addtime'] = array('lt',$today);
	        $suanli_where['zt'] = 1;

	        $today_sale = M('order')->where($sale_where)->sum('sumprice');
			$today_sale = $today_sale ? $today_sale : 0;

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
			$select_member = array();

			$average_income = round(($today_sale*$integral_rate/100)/$all_integral,2);
			
			$all_reward = round($all_integral*$average_income,2);

			foreach ($all_member as &$value) {

				$where['user_id'] = $value['id'];
				$value['reward'] = round($average_income * $value['integral'],2);

				//查询
				if(!empty($_POST['typename'])){
					$type = $_POST['type'];
					$typename = $_POST['typename'];


					if($type ==1){
						if($value["id"]==$typename){
							$select_member[] = $value;
						}
					}elseif($type ==2){
						if($value["level_name"]==$typename){
							$select_member[] = $value;
						}
					}elseif($type ==3){
						if($value["username"]==$typename){
							$select_member[] = $value;
						}
					}elseif($type ==4){
						if($value["mobile"]==$typename){
							$select_member[] = $value;
						}
					}
				}

			}


			$all_count = count($all_member);// 查询满足要求的总记录数
			$select_count = count($select_member);// 查询满足要求的总记录数

	        $all_Page  = new Page($all_count,10);// 实例化分页类 传入总记录数
	        $select_Page  = new Page($select_count,10);// 实例化分页类 传入总记录数
	        if(empty($Page -> listRows)) $Page -> listRows=10;
		    $all_member_reward = array_slice($all_member, $all_Page ->firstRow,$Page -> listRows,true);
		    $select_member_reward = array_slice($select_member, $select_Page ->firstRow,$Page -> listRows,true);

 		    $today = strtotime(date("Y-m-d",time()));
 		    $yesterday = strtotime("-1day",$today);
 		    $day = date('Y-m-d',$yesterday);

		    $reward_ret = M('reward_status')->where(array('date'=>$day))->find();

		    if(!$reward_ret){
				$reward_status = '一键分配';
		    }else{
		    	if($reward_ret['status']==0){
		    		$reward_status = '一键分配';
		    	}else{
		    		$reward_status = '已分配';
		    	}
		    }

			$this->assign('reward_status',$reward_status);

			$this->assign('today_sale',$today_sale);

			$this->assign('all_integral',$all_integral);

			$this->assign('all_reward',$all_reward);

			$this->assign('average_income',$average_income);
			
			if(!empty($_POST['typename'])){
				$show = $select_Page->show();// 分页显示输出
				$this->assign('page',$show);// 赋值分页输出
				$this->assign('type',$_POST['type']);
				$this->assign('typename',$_POST['typename']);
				$this->assign('list',$select_member_reward);
			}else{
				$show = $all_Page->show();// 分页显示输出
				$this->assign('page',$show);// 赋值分页输出
				$this->assign('list',$all_member_reward);
			}
			$this->display();
		}

		/**
		  * 加权等级升级
		  * @param  $weighted_level            加权的级别
		  * @param  $all_member                全部会员的信息
		  * @param  $level_condition           加权等级的条件
		  * @param  $v4_condition              加权v4的条件
		  * @return $all_member				   全部会员的信息
		  * @return $large				       大区的业绩
		  * @return $total				       总业绩
		  * @return $little_sum				   小区的总和业绩
		  */
		function level_num($weighted_level,$all_member,$level_condition,$level_num){
			foreach ($all_member as $val2) {
				$count = M('member')->where(array('parent_id'=>$val2['id'],'weighted_level'=>$level_condition))->count();
				if($count>=$level_num){
					$now_level = M('member')->where(array('id'=>$val2['id']))->getField('weighted_level');
					if($now_level<$weighted_level){
						M('member')->where(array('id'=>$val2['id']))->save(array('weighted_level'=>$weighted_level));
					}
				}
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
		 		  * 一键分配
		 		  * @param  $total_coins               今日矿池代币总量
		 		  * @param  $weighted_average_set      加权平均设置的数据
		 		  * @param  $v4_condition              加权v4的条件
		 		  * @return $all_member				   全部会员的信息
		 		  * @return $num				   	   加权平均等级对应的人数
		 		  * @return $rate				       加权平均等级对应的奖励比例
		 		  * @return $reward				       加权平均等级对应的奖励总和
		 		  * @return $weighted_average		   加权平均对应等级下每个人能分到的值
		 		  * @return string
		 		  */
		 		 public function change_reward_status(){

			        $integral_rate = C('integral_rate');

        	        $today = strtotime(date("Y-m-d",time()));
        	        $yesterday = strtotime("-1day",$today);

        	        $sale_where['kj_addtime'] = array(
        	        	array('egt',$yesterday),
        	        	array('lt',$today)
        	        	
        	        );

	           

	                $suanli_where['kj_addtime'] = array('lt',$today);
	                $suanli_where['zt'] = 1;


	                $today_sale = M('order')->where($sale_where)->sum('sumprice');
	        		$today_sale = $today_sale ? $today_sale : 0;

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
					$select_member = array();

					$average_income = round(($today_sale*$integral_rate/100)/$all_integral,2);

					foreach ($all_member as &$value) {

						$where['user_id'] = $value['id'];
						$value['reward'] = round($average_income * $value['integral'],2);

					}






		 		    $today = strtotime(date("Y-m-d",time()));
		 		    $yesterday = strtotime("-1day",$today);
		 		    $day = date('Y-m-d',$yesterday);

		 		    $reward_status = M('reward_status')->where(array('date'=>$day))->find();

	 		    	if($reward_status['status']==0){
	 		    		foreach ($all_member as $value2) {
	 		    			if($value2['reward']>0){
	 		    				$data = array(
	 		    					'username'=>$value2['username'],
	 		    					'reward'=>$value2['reward']
	 		    				);
	 		    				M('member')->where(array('id'=>$value2['id']))->setInc('yuanqi',$value2['reward']);
	 		    			}
	 		    				jinbi($value2['username'],$value2['reward'],'节点积分奖励',1,4,'yuanqi');
	 		    			
	 		    		}

	 			    	M('reward_status')->where(array('date'=>$day))->save(array('status' =>1));
	 			    	echo json_encode(array('msg' => '分配成功','status'=>'已分配'));die;
	 		    	}else{
	 		    		echo json_encode(array('msg'=>'你已分配过','status'=>'已分配'));die;
	 		    	}

		 		    
		 		 }

	  		/**
	  		  * 一键分配
	  		  * @param  $id               		   ID
	  		  */
	  		 public function change_reward_status2(){
	  		 	$id = $_POST['id'];
	  		 	$reward_info = M('reward_status')->where(array('id'=>$id))->find();
	  		 	if($reward_info['status']==0){
	  		 		$reward_array = json_decode($reward_info['reward'],true);
	  		 		foreach ($reward_array as $value) {
	  		 			if($value['reward']>0){
	  		 				M('member')->where(array('id'=>$value['id']))->setInc('yuanqi',$value['reward']);
	  		 			}	
	  		 				jinbi($value['username'],$value['reward'],'节点积分奖励',1,4,'yuanqi');
	  		 			
	  		 		}
		  		 	M('reward_status')->where(array('id'=>$id))->save(array('status'=>1));
		  		 	echo json_encode(array('msg' => '分配成功','status'=>'已分配'));die;
		  		 }else{
		  		 	echo json_encode(array('msg'=>'你已分配过','status'=>'已分配'));die;
	  		 	}
	 	        
	  		    
	  		 }

		
	//导出全部/excel
	        public function excel() {

				$Data = M('jinbidetail'); // 实例化Data数据对象
			
				import("@.ORG.Util.Page");// 导入分页类
	
		        $integral_rate = C('integral_rate');

    	        $today = strtotime(date("Y-m-d",time()));
    	        $yesterday = strtotime("-1day",$today);

    	        $sale_where['kj_addtime'] = array(
    	        	array('egt',$yesterday),
    	        	array('lt',$today)
    	        	
    	        );


    	        $suanli_where['kj_addtime'] = array('lt',$today);
    	        $suanli_where['zt'] = 1;

    	        

    	        $today_sale = M('order')->where($sale_where)->sum('sumprice');
    			$today_sale = $today_sale ? $today_sale : 0;

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
				$select_member = array();

				$average_income = round(($today_sale*$integral_rate/100)/$all_integral,2);

				foreach ($all_member as &$value) {

					$where['user_id'] = $value['id'];
					$value['reward'] = round($average_income * $value['integral'],2);

					//查询
					if(!empty($_POST['typename'])){
						$type = $_POST['type'];
						$typename = $_POST['typename'];


						if($type ==1){
							if($value["id"]==$typename){
								$select_member[] = $value;
							}
						}elseif($type ==2){
							if($value["level_name"]==$typename){
								$select_member[] = $value;
							}
						}elseif($type ==3){
							if($value["username"]==$typename){
								$select_member[] = $value;
							}
						}elseif($type ==4){
							if($value["mobile"]==$typename){
								$select_member[] = $value;
							}
						}
					}

				}

				if($_GET['type']==1){
					if(!empty($_POST['typename'])){
						$list = $select_member;
					}else{
						$list = $all_member;
					}
				}else{
					$list = $all_member;
				}

	            require_once ROOT_PATH . '/extend/lib/PHPExcel/Classes/PHPExcel.php';
	            $objPHPExcel = new \PHPExcel();
	            //列宽 自适应
	            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
	            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
	            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
	            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
	            //根据excel坐标，添加数据
	            $objPHPExcel->setActiveSheetIndex(0)
	                ->setCellValue('A1', '编号')
	                ->setCellValue('B1', '级别')
	                ->setCellValue('C1', '姓名')
	                ->setCellValue('D1', '手机号码')
	                ->setCellValue('E1', '积分')
	                ->setCellValue('F1', '节点分红');
	            foreach($list as $key=>$val){
	                $num = $key +2;
	                $A = 'A'.$num;
	                $B = 'B'.$num;
	                $C = 'C'.$num;
	                $D = 'D'.$num;
	                $E = 'E'.$num;
	                $F = 'F'.$num;
	                $G = 'G'.$num;

	                $objPHPExcel->setActiveSheetIndex(0)
	                    ->setCellValue($A,$val['id'])
	                    ->setCellValue($B,$val['level_name'])
	                    ->setCellValue($C,$val['username'])
	                    ->setCellValue($D,$val['mobile'])
	                    ->setCellValue($E,$val['integral'])
	                    ->setCellValue($F,$val['reward']);
	            }

	            $showtime = date('Ymdhis');
	            $file_name = '节点分红列表'.$showtime.'.xlsx';

	            /*生成文件并下载*/
	            header('Content-Type: application/vnd.ms-excel');
	            // header('Content-Disposition: attachment;filename="'.'data.xlsx"');
	            header('Content-Disposition: attachment;filename="'.$file_name.'"');
	            header('Cache-Control: max-age=0');
	            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	            $objWriter->save('php://output');
	            #释放内存
	            unset($objWriter);
	            unset($objPHPExcel);
	            $desc = '导出全部订单';
				write_log(session('adminusername'),'admin',$desc);
	        }

	    public function reward_status_list(){

            import("@.ORG.Util.Page");// 导入分页类
	    	$start_time = strtotime($_POST['start_time']);
	    	$end_time = strtotime($_POST['end_time']) + 86400;
	    	$status_where = '';
	    	if(!empty($_POST['start_time'])||!empty($_POST['end_time'])){
		    	$status_where['time'] = array(
		    		array('egt',$start_time),
		    		array('lt',$end_time)
		    	);
	    	}

	    	$status = $_POST['status'];

	    	if($status==2){
		    	$status_where['status'] = 0;
	    	}elseif($status==3){
	    		$status_where['status'] = 1;
	    	}
	    	$count = M('reward_status')->where($status_where)->count();// 查询满足要求的总记录数

            $Page = new Page($count,20);// 实例化分页类 传入总记录数

	    	$status_list = M('reward_status')->where($status_where)->limit($Page ->firstRow.','.$Page -> listRows)->order('time desc')->select();

            $show = $Page->show();// 分页显示输出
            $this->assign('page',$show);
	    	$this->assign('status',$status);
	    	$this->assign('list',$status_list);

	    	$this->display();
	    } 

	 



	}
		




?>