<?php	Class CommonAction extends Action{	  		  	/**	  	 * 验证登录	  	 * @return [type] [description]	  	 */	  	public function _initialize(){	  		header("Content-Type:text/html; charset=utf-8");	  		if(!isset($_SESSION[C('USER_AUTH_KEY')])){	  			$this->redirect(GROUP_NAME.'/Login/index');	  		}	  		// 	  		import('ORG.Net.IpLocation');// 导入IpLocation类// 		    $Ip = new IpLocation(); // 实例化类// 		    $loginip = get_client_ip();// 		    $location = ipToArea($loginip);// 			$location = $Ip->getlocation($loginip); // 获取某个IP地址所在的位置			// 			$ip_black = ['127.0.0.1','localhost'];// 			if(in_array($loginip,$ip_black) || strstr($location,'北京') || strstr($location,'福建')) {// 			    $desc = 'ip拦截，操作失败';// 			    write_log(I('adminusername'),'admin',$desc);// 			    exit;// 			}// 			$country_white = ['东莞'];// 			$exist_white = false;// 			foreach ($country_white as $val) {// 			    if(strstr($location,$val)) {// 			        $exist_white = true;// 			        break;// 			    }// 			}// 			if(!$exist_white) {// 			    $desc = 'ip拦截操作，不在白名单';// 			    write_log(I('adminusername'),'admin',$desc);// 			    exit;// 			}			// 			$ip_white = ['120.229.109'];// 			$exist_white = false;// 			foreach ($ip_white as $val) {// 			    if(strstr($loginip,$val)) {// 			        $exist_white = true;// 			        break;// 			    }// 			}// 			if(!$exist_white) {// 			    $desc = 'ip拦截操作，不在白名单2';// 			    write_log(I('username'),'admin',$desc);// 			    exit;// 			}	  		//检查无需验证的控制器或方法	  		// $noAuth = in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME, explode(',', C('NOT_AUTH_ACTION')));	  		// if (C('USER_AUTH_ON') && !$noAuth) {	  		// 	import('ORG.Util.RBAC');	  		// 	//如果是单入口对应一个项目的话，下面的GROUP_NAME不用填写	  		// 	RBAC::AccessDecision(GROUP_NAME) || $this->error('没有权限');	  		// }	  			  		$nodes = S("nodes");	  		if (empty($nodes)) {	  			$nodes = M("node")->order("sort asc")->select();				$nodes = node_merge($nodes);				S("nodes",$nodes);	  		}			// dump($nodes);die;			$this->assign("nodes",$nodes[0]);			// if(!session('adminusername') || session('adminusername'))	  		if ($_SESSION[C('ADMIN_AUTH_KEY')] != true) {	  			// $roledata = S("roledata_".session("id"));	  			// dump($roledata);die;	  			// if (empty($roledata)){		  			$roles = M("role_user")->where(array("user_id"=>session("id")))->select();		  			foreach ($roles as $kd){		  				$roledatas = M("role")->where(array("id"=>$kd['role_id'],'status'=>1))->find();		  				if (!empty($roledatas)){		  					$roledata = json_decode($roledatas['auth'],true);		  					break;		  				}		  			}		  			foreach ($roledata as $kr => $r){		  				$roledata[$kr] = json_decode($r,true);		  			}		  			foreach ($roles as $v) {		  				$role = M("role")->where(array("id"=>$v['role_id'],'status'=>1))->find();		  				$role["auth"] = json_decode($role["auth"],true);		  				foreach ($role["auth"] as $key => $value) {		  					$role["auth"][$key] = json_decode($value,true);		  					foreach ($role["auth"][$key] as $k => $val) {		  						if ($val == 1){		  							$roledata[$key][$k] = 1;		  							$roledata[$key]["show__"] = true;		  						}		  					}		  					if(!isset($roledata[$key]["show__"])){		  						$roledata[$key]["show__"] = false;		  					}			  				}	  						  			}		  					  			//找第四级权限	  				$fourth = M("node")->where(array("level"=>4))->select();	  				foreach ($fourth as $four) {	  					$third = M("node")->where(array("id"=>$four['pid']))->select();	  					$second = M("node")->where(array("id"=>$third[0]['pid']))->getField("name");		  				foreach ($third as $kth => $th) {		  					if($roledata[$second][$th['name']] == 1){		  						$roledata[$second][$four['name']] = 1;		  					}else{		  						$roledata[$second][$four['name']] = 0;		  					}		  				}	  				}	  				// S("roledata_".session("id"),$roledata);	  			// }	  				  			// dump(MODULE_NAME."/".ACTION_NAME);dump($roledata);die;	  			$this->assign("roledata",$roledata);	  			if (MODULE_NAME == "Index" || MODULE_NAME == "Shops" || MODULE_NAME == "Excel" || MODULE_NAME == "Login") {	  				return;	  			}	  				  			if (MODULE_NAME == "Index" && ACTION_NAME == "logout"){	  				return;	  			}	  			if ($roledata[MODULE_NAME][ACTION_NAME] == 0) {	  				$this->error("对不起，您没有权限！");	  			}	  		}	  	}	  	public function index(){	  		$map = $this -> _search();			if (method_exists($this, '_search_filter')) {				$this -> _search_filter($map);			}			$name = $this -> getActionName();			$model = D($name);						if (!empty($model)) {				$this -> _list($model, $map);			}			$this -> display();	  	}		//生成查询条件		protected function _search($name = '', $view = false) {			$map = array();			$request = array_filter(array_keys(array_filter($_REQUEST)), "filter_search_field");			if (empty($name)) {				$name = $this -> getActionName();			}			$model = D($name);			if ($view) {				$fields = get_view_fields($model);			} else {				$fields = $model -> getDbFields();			}			foreach ($request as $val) {				if (!in_array(substr($val, 3), $fields)) {					continue;				}				if (substr($val, 0, 3) == "be_") {					if (isset($_REQUEST["en_" . substr($val, 3)])) {						if (strpos($val, "date")) {							$map[substr($val, 3)] = array( array('egt', date_to_int(trim($_REQUEST[$val]))), array('elt', date_to_int(trim($_REQUEST["en_" . substr($val, 3)]))));						}						if (strpos($val, "time")) {							$map[substr($val, 3)] = array( array('egt', date_to_int(trim($_REQUEST[$val]))), array('elt', date_to_int(trim($_REQUEST["en_" . substr($val, 3)]))));							//$map[substr($val, 3)] = array( array('egt', trim($_REQUEST[$val])), array('elt', trim($_REQUEST["en_" . substr($val, 3)])));						}					}				}				if (substr($val, 0, 3) == "li_") {					$map[substr($val, 3)] = array('like', '%' . trim($_REQUEST[$val]) . '%');				}				if (substr($val, 0, 3) == "eq_") {					$map[substr($val, 3)] = array('eq', trim($_REQUEST[$val]));				}				if (substr($val, 0, 3) == "gt_") {					$map[substr($val, 3)] = array('egt', trim($_REQUEST[$val]));				}				if (substr($val, 0, 3) == "lt_") {					$map[substr($val, 3)] = array('elt', trim($_REQUEST[$val]));				}			}			return $map;		}		//获取用户的所有下级ID	    function get_downline($data,$mid){	        $arr=array();	        foreach ($data as $key => $v) {	            if($v['parent_id']==$mid){	                $arr[]=$v;	                $arr = array_merge($arr,$this->get_downline($data,$v['id']));	            }	        }	        return $arr;	    }				protected function _list($model, $map, $sortBy = '', $asc = false) {			if (M('Member') == $model) 			{				$map['username'] = array('not in','18867513490,18916953132,18918174254');			}			//排序字段 默认为主键名			if (isset($_REQUEST['_order'])) {				$order = $_REQUEST['_order'];			} else {				$order = !empty($sortBy) ? $sortBy : $model -> getPk();			}			//排序方式默认按照倒序排列			//接受 sost参数 0 表示倒序 非0都 表示正序			if (isset($_REQUEST['_sort'])) {				$sort = $_REQUEST['_sort'] ? 'asc' : 'desc';			} else {				$sort = $asc ? 'asc' : 'desc';			}			//取得满足条件的记录数			$count_model = clone $model;			//取得满足条件的记录数			if (!empty($count_model -> pk)) {				$count = $count_model -> where($map) -> count($model -> pk);			} else {				$count = $count_model -> where($map) -> count();			}			if ($count > 0) {				import("ORG.Util.Page");				//创建分页对象				$listRows = 20;                //总 未释放 fil		        $unknown_currency = C("unknown_currency") + 0;		        //总质押币                $total_pledge_num = C("total_pledge_num") + 0;                //消耗GAS总费用                $consume_gas = C("consume_gas") + 0;                                $pt_total = M('order')->where(array('zt'=>1))->sum('lixi') + 0;	//总算力                                $total_not_released = 0;                $Mortgage_currency = 0;                                $total_gas_xh = 0;                                if($pt_total > 0){                    if($unknown_currency > 0){                        $total_not_released = bcdiv($unknown_currency,$pt_total,4);                                            }                    if($total_pledge_num > 0){                        $Mortgage_currency = bcdiv($total_pledge_num,$pt_total,4);                    }                    if($consume_gas > 0){                        $total_gas_xh = bcdiv($consume_gas,$pt_total,4);                    }                }                                				$p = new Page($count, $listRows);				//分页查询数据				$voList = $model -> where($map) -> order("`" . $order . "` " . $sort) -> limit($p -> firstRow . ',' . $p -> listRows) -> select();				$user_list = M('member')->field('id,parent_id,level')->select();				foreach($voList as &$val) {					$zt_list = M('member')->where(array('parent_id'=>$val['id']))->order('id asc')->field('id,username,parent_id,level')->select();					$val['ztnums'] = count($zt_list);					$val['teamnums'] = count($this->get_downline($user_list,$val['id'])) + 1;					$val['parentname'] = M('member')->where(array('id'=>$val['parent_id']))->getField('truename');										//个人算力					$dateStr = date('Y-m-d', time());   //当天日期			        $jssj = strtotime($dateStr);   //今天0点时间戳			        $total_sl = M('order')->where(array('zt'=>1,'user_id'=>$val['id'],'kj_addtime'=>array('lt',$jssj)))->sum('lixi');	//总算力			        $val['total_sl'] = $total_sl ? $total_sl : 0;			        			        //ipfs			        //个人产币			        $val['cb'] = M('jinbidetail')->where(array('type'=>5,'member'=>$val['username']))->sum('adds');					$val['cb'] = $val['cb'] ? $val['cb'] : 0;			        //个人fil币奖励			        $val['shouyi'] = M('jinbidetail')->where(array('type'=>2,'member'=>$val['username']))->sum('adds');					$val['shouyi'] = $val['shouyi'] ? $val['shouyi'] : 0;					//合伙人					$val['jqfh'] = M('jinbidetail')->where(array('type'=>3,'member'=>$val['username']))->sum('adds');					$val['jqfh'] = $val['jqfh'] ? $val['jqfh'] : 0;										//元气值					//充值					$val['yqcz'] = M('yuanqidetail')->where(array('type'=>9,'member'=>$val['username']))->sum('adds');					$val['yqcz'] = $val['yqcz'] ? $val['yqcz'] : 0;					//推荐奖					$val['tjjl'] = M('yuanqidetail')->where(array('type'=>array('in','1'),'member'=>$val['username']))->sum('adds');					$val['tjjl'] = $val['tjjl'] ? $val['tjjl'] : 0;					//管理奖					$val['gljl'] = M('yuanqidetail')->where(array('type'=>array('in','4'),'member'=>$val['username']))->sum('adds');					$val['gljl'] = $val['gljl'] ? $val['gljl'] :0;										$total_user_sl = M('order')->where(array('zt'=>1,'user'=>$val['username']))->sum('lixi') + 0;	//总算力										//总未释放					$val['total_not_released'] = 0;					if($total_user_sl > 0 && $total_not_released > 0){            		    $val['total_not_released'] = $total_not_released * $total_user_sl;            		}					//总抵押币数量					$val['total_mortgage'] = 0;					if($total_user_sl > 0 && $Mortgage_currency > 0){					    $val['total_mortgage'] = $Mortgage_currency * $total_user_sl;					}					//消耗GAS总费用					$val['total_gas'] = 0;					if($total_user_sl > 0 && $total_gas_xh > 0){					    $val['total_gas'] = $total_gas_xh * $total_user_sl;					}									}								//总统计				$total_yuanqi_cz = M('yuanqidetail')->where(array('type'=>9))->sum('adds');	//累计充值				$total_yuanqi_cz = $total_yuanqi_cz ? $total_yuanqi_cz : 0;								$total_tjjl = M('yuanqidetail')->where(array('type'=>array('in','1')))->sum('adds');	//累计推荐奖励				$total_tjjl = $total_tjjl ? $total_tjjl : 0;								$total_gljl = M('yuanqidetail')->where(array('type'=>array('in','4')))->sum('adds');	//累计分红奖励				$total_gljl = $total_gljl ? $total_gljl :0;								$total_shouyi = M('jinbidetail')->where(array('type'=>5))->sum('adds');	//累计产币				$total_shouyi = $total_shouyi ? $total_shouyi : 0;								$total_jqfh = M('jinbidetail')->where(array('type'=>3))->sum('adds');	//累计合伙人奖励				$total_jqfh = $total_jqfh ? $total_jqfh : 0;								$p -> parameter = $this -> _search;				//分页显示				$page = $p -> show();				//列表排序显示				$sortImg = $sort;				//排序图标				$sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列';				//排序提示				$sort = $sort == 'desc' ? 1 : 0;				//排序方式				//模板赋值显示				$name = $this -> getActionName();				$this->assign('total_yqcz',$total_yuanqi_cz);				$this->assign('total_tjjl',$total_tjjl);				$this->assign('total_gljl',$total_gljl);				$this->assign('total_shouyi',$total_shouyi);				$this->assign('total_kcfh',$total_kcfh);				$this->assign('total_jqfh',$total_jqfh);				$this -> assign('list', $voList);				$this -> assign('sort', $sort);				$this -> assign('order', $order);				$this -> assign('sortImg', $sortImg);				$this -> assign('sortType', $sortAlt);				$this -> assign("page", $page);			}			return;		}	}?>