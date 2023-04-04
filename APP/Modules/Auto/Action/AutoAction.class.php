<?php

class AutoAction extends Action
{
    /**
     * 每日释放fil币
     * 20201022
     * */
    public function releaseFil() {
        die;
        $today = strtotime(date('Ymd'));
        $now_time = time();
        if($today < $now_time && $now_time < $today + 600) {
            $last_release_date = M('fil_record')->order('id desc')->getField('adddate');
            if(strtotime($last_release_date) >= strtotime(date('Y-m-d'))) {
                exit('今日已释放！');
            }
            M('fil_record')->add(array('adddate'=>date('Ymd')));
            $where = [
                'expire_time' => array('gt',$now_time),
                'last_get_time' => array('lt',$today),
                'add_time'  => array('lt',$today)
            ];
            $fil_list = M('fil')->where($where)->select();
            if(!$fil_list || $fil_list == '') {
                exit('无可发放记录！');
            }
            foreach ($fil_list as $val) {
                if($now_time > $val['expire_time'] - 86400) {
                    //最后一天
                    $rst = M('member')->where(array('id'=>$val['user_id']))->setInc('ipfs',$val['last_day_get']);
                    jinbi($val['username'],$val['last_day_get'],'产币',1,2,'ipfs');
                    if($rst) {
                        M('fil')->where(array('id'=>$val['id']))->setInc('already_get',$val['last_day_get']);
                        M('fil')->where(array('id'=>$val['id']))->save(array('last_get_time'=>$now_time,'status'=>1));
                    }
                } else {
                    $rst = M('member')->where(array('id'=>$val['user_id']))->setInc('ipfs',$val['day_get']);
                    jinbi($val['username'],$val['day_get'],'产币',1,2,'ipfs');
                    if($rst) {
                        M('fil')->where(array('id'=>$val['id']))->setInc('already_get',$val['day_get']);
                        M('fil')->where(array('id'=>$val['id']))->save(array('last_get_time'=>$now_time));
                    }
                }
            }
            echo '发放成功！';exit;
        } else {
            echo '失败，不在时间段！';exit;
        }
        
    }
    
    // 自动过期任务
	public function autoExpire(){
	    $count = 0;
		$now_time = time();
		$map['zt'] = array('neq',2);
		$active_kj = M('order')->where($map)->select();
		foreach($active_kj as $val) {
			$dateStrs = date('Y-m-d', strtotime($val['addtime']));
            $first_day = strtotime($dateStrs) + 86400;  //购买矿机当天的24点整，即第二天00:00
            $expiry_time = $first_day + $val['yxzq'] * 86400;   // 到期时间
            if ($now_time >= $expiry_time) {
                //已过期
                $rst = M('order')->where(array('id'=>$val['id']))->save(array('zt'=>2,'expiry_time'=>$now_time)); //设置矿机为失效
                if($rst) $count++;
            }
		}
		echo '今天过期了'.$count.'个矿机';exit;
	}
	
	public function test() {
		$count = 0;die;
		$list = M('order')->select();
		foreach ($list as $val) {
			$time = strtotime($val['addtime']);
			$rst = M('order')->where(array('id'=>$val['id']))->save(array('kj_addtime'=>$time));
			if($rst) {
				$count++;
			}
		}
		echo $count;
	}
	
	public function upprice(){
		$usdt_cny = file_get_contents("https://www.gatecn.io/api2/1/ticker/usdt_cny");
		$usdt_cny = json_decode($usdt_cny,true)['last'];
		$btc_usdt = file_get_contents("https://www.gatecn.io/api2/1/ticker/btc_usdt");
		$btc_usdt = json_decode($btc_usdt,true)['last'];
		$btc_ipfs = $btc_usdt * $usdt_cny / C("rate");
		$ltc_usdt = file_get_contents("https://www.gatecn.io/api2/1/ticker/ltc_usdt");
		$ltc_usdt = json_decode($ltc_usdt,true)['last'];
		$ltc_ipfs = $ltc_usdt * $usdt_cny / C("rate");
		
		$path = './APP/Conf/system.php';
		$config = include $path;
		
		$config['btc_ipfs'] = $btc_ipfs;
		$config['ltc_ipfs'] = $ltc_ipfs;
		$data = "<?php\r\nreturn " . var_export($config, true) . ";\r\n?>";
		if (file_put_contents($path, $data)) {
			echo "更新成功";
		} else {
			echo "更新失败";
		}
	}
	
	//随机生成用户账号
    public function userRand() {
        $name = 'user'.rand(100000,999999);
        $rst = M('member')->where(array('username'=>$name))->find();
        if ($rst) {
            $this->userRand();
        } else {
            return $name;
        }
    }
	
	//导入用户
	public function readexcel() {
		echo '危险操作！请联系开发工程师';exit;
		require_once ROOT_PATH . '/extend/lib/PHPExcel/Classes/PHPExcel/IOFactory.php';

		//elsx文件路径
		$inputFileName = dirname(__FILE__)."/星际元会员统计表0526.xlsx";
		date_default_timezone_set('PRC');
		if (!file_exists($inputFileName)) {
		    exit("文件".$inputFileName."不存在");
		}
		// 读取excel文件
		try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {
		
		}
		dump(111);
		// 确定要读取的sheet，什么是sheet，看excel的右下角，真的不懂去百度吧
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		// $totaldata = [];
		// 获取excel文件的数据，$row=2代表从第二行开始获取数据
		for ($row = 2; $row <= $highestRow; $row++){
		// Read a row of data into an array
		    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $highestRow, NULL, TRUE, FALSE);
		//这里得到的rowData都是一行的数据，得到数据后自行处理，我们这里只打出来看看效果
		    // echo '<pre>';

		    $totaldata[] = $rowData[0];
		    
		    // dump($rowData);die;
		    // echo "<br>";
		}
		// dump($totaldata);die;
		$success=[];
		// dump($totaldata);die;
		$lasttime = M('exceltest')->order('id desc')->getField('addtime');
		if($lasttime>strtotime(date('Y-m-d'))) {
			echo '今天已经操作过一次了哦！';exit;
		}
		dump($totaldata);
		die;
		
		foreach ($totaldata as &$val) {
			// if(intval($val[2]) == 29925 || intval($val[2]) == 29926) {
			// 	echo intval($val[2]);
			// 	unset($val);
			// 	continue;
			// }
			
			$d = 25569;
			$t = 24 * 60 * 60;
			$val['regdate'] = strtotime(gmdate("Y-m-d H:i:s",($val[1]-$d) * $t));
			$val['id'] = intval($val[2]);
			$val['mobile'] = intval($val[3]);
			$val['truename'] = $val[4];
			
			//这样处理就能打印了
			$string = iconv('utf-8','gbk',$val[5]);
			$substr = substr($string,0,5);
			$str = iconv('gbk','utf-8',$substr);

			$val['pid'] = intval($str) ? intval($str) : 0;
			$val['level'] = intval($val[8]) ? intval($val[8]) : 0;
			if($val['pid'] == 0 && $val['id'] != 29924){
				$val['pid'] = 29924;
			}
			// if($val['pid'] == 0) {
			// 	echo $val['id'].'<br>';
			// }
			unset($val[0]);unset($val[1]);unset($val[2]);unset($val[3]);unset($val[4]);unset($val[5]);unset($val[6]);unset($val[7]);unset($val[8]);unset($val[9]);unset($val[10]);unset($val[11]);
		}
		// dump($totaldata);die;
		//排序
		$last_names = array_column($totaldata,'id');
		array_multisort($last_names,SORT_ASC,$totaldata);
		dump($totaldata);die;
		$tgms = [];
		$usernames = [];
		foreach($totaldata as &$val) {
			$data = [];
			$tgm = '';
			$data['id']= $val['id'];
			$data['level'] = $val['level'];
			$data['username'] = $val['mobile'];
			$data['mobile'] = $val['mobile'];
			$data['truename'] = $val['truename'];
			// $data['password'] = md5(123456);	//默认密码
			$data['regdate'] = $val['regdate'];
			$data['parent_id'] = $val['pid'];
			
			foreach($totaldata as $value){
				if($value['id'] == $data['parent_id']) {
					$data['parent'] = $value['mobile'];
					break;
				}
			}
			$data['tgm'] = $tgm = getRandChar();
	        while(in_array($tgm, $tgms)){
				$data['tgm'] = $tgm = getRandChar();
			}
			$tgms[] = $tgm;
			// $data['username'] = $username = $this->userRand();
			// while(in_array($username, $usernames)){
			// 	$data['username'] = $username = $this->userRand();
			// }
			// $usernames[] = $username;
			// dump($data);
			M('member')->add($data);
		}
		
		// M('member')->where(array('id'=>array('gt',100)))->delete();
		// dump($success);
		// $success = json_encode($success);
		// M('ordertest_test')->add(array('addtime'=>time(),'data'=>$success));exit;
	}
	
	//导入矿机订单
	public function readKj() {
		echo '危险操作！请联系开发工程师';exit;
		require_once ROOT_PATH . '/extend/lib/PHPExcel/Classes/PHPExcel/IOFactory.php';

		//elsx文件路径
		$inputFileName = dirname(__FILE__)."/矿机统计新0527.xlsx";
		date_default_timezone_set('PRC');
		if (!file_exists($inputFileName)) {
		    exit("文件".$inputFileName."不存在");
		}
		// 读取excel文件
		try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {
		
		}
		
		// 确定要读取的sheet，什么是sheet，看excel的右下角，真的不懂去百度吧
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		// $totaldata = [];
		// 获取excel文件的数据，$row=2代表从第二行开始获取数据
		for ($row = 2; $row <= $highestRow; $row++){
		// Read a row of data into an array
		    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $highestRow, NULL, TRUE, FALSE);
		//这里得到的rowData都是一行的数据，得到数据后自行处理，我们这里只打出来看看效果
		    // echo '<pre>';

		    $totaldata[] = $rowData[0];
		    
		    // dump($rowData);die;
		    // echo "<br>";
		}
		// dump($totaldata);die;
		$success=[];
		// dump($totaldata);die;
		$lasttime = M('exceltest')->order('id desc')->getField('addtime');
		if($lasttime>strtotime(date('Y-m-d'))) {
			echo '今天已经操作过一次了哦！';exit;
		}
		// die;
		
		foreach ($totaldata as &$val) {
			$d = 25569;
			$t = 24 * 60 * 60;
			$val['addtime'] = gmdate("Y-m-d H:i:s",($val[6]-$d) * $t);
			$val['kj_id'] = intval($val[11]);
			$val['user_id'] = intval($val[1]);
			$val['number'] = intval($val[8]);
			
			unset($val[0]);unset($val[1]);unset($val[2]);unset($val[3]);unset($val[4]);unset($val[5]);unset($val[6]);unset($val[7]);unset($val[8]);unset($val[9]);unset($val[10]);unset($val[11]);
		}
		// dump($totaldata);die;
		//排序
		$last_names = array_column($totaldata,'id');
		array_multisort($last_names,SORT_ASC,$totaldata);
		dump($totaldata);die;
		$count = 0;	//计数
		$number = 0;	//实际数量
		foreach($totaldata as $value) {
			$number += $value['number'];
			for( $i = 0; $i < $value['number']; $i++ ) {
				$rst = $this->onlyBuy($value['user_id'],$value['kj_id'],$value['addtime']);
				if($rst) {
					$count++;
				}
			}
			
		}
		dump('共新增' . $count . '个矿机订单，实际有' . $number .'个订单。');
		
		// M('member')->where(array('id'=>array('gt',100)))->delete();
		// dump($success);
		// $success = json_encode($success);
		// M('ordertest_test')->add(array('addtime'=>time(),'data'=>$success));exit;
	}
	
	//仅仅增加矿机
	public function onlyBuy($user_id,$kj_id,$addtime){
		$res = array('success'=>0,'msg'=>'','data'=>'');
	    $userinfo = M("member")->field('id,username')->where(array("id"=>$user_id))->find();
	    $product = M("product");

		$id =  $kj_id;
		//查询矿机信息
		$data = $product->where(array('id'=>$id))->find();
		if(empty($data)){
			$res['msg'] = '矿机不存在';
			echo json_encode($res);exit;
		}
	    
		$map = array();

		$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'Q', 'Q', 'I', 'J');

		$map['kjbh'] = $yCode[intval(date('Y')) - 2011] . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));

		  $map['user'] = $userinfo['username'];

		  $map['user_id'] = $user_id;

		  $map['project']= $data['title'];

		  $map['sid'] = $data['id'];

		  $map['yxzq'] = $data['yszq'];		

          $map['sumprice'] = $data['price'];

		  $map['addtime'] = $addtime;	

          $map['imagepath'] = $data['thumb'];

		  $map['lixi']	= $data['gonglv'];

		  $map['kjsl'] =  $data['shouyi'];

          $map['zt'] =  1;	
          $map['payway'] = '原H5转';

          $map['UG_getTime'] =  time();	
          $map['kj_addtime'] = strtotime($addtime);

		  $rst = M('order')->add($map);
		  if($rst) {
		  	return true;
		  } else {
		  	return false;
		  }
    }
    
    //升级
    public function levelTest() {
        die;
        $memberlist = M('member')->select();
        foreach ($memberlist as $val) {
            $id = $val['id'];
            $suanli = M("order")->where(array("user_id"=>$id))->sum('lixi');
            $suanli = $suanli ? $suanli : 0;     
            $level_array = M("team_level_group")->order('id desc')->select();
            $user_level = $val['level'];
            foreach ($level_array as  $vv) {
                if($suanli>=$vv['condition']&&$user_level['level']<$vv['level']){
                  M('member')->where(array("id"=>$id))->save(array('level'=>$vv['level']));
                  dump('success');
                  break;
                }
            }
        }
        
    }
    
    
}