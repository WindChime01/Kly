<?php  



	/**

	* 会员管理控制器

	*/

	class ShopAction extends CommonAction{

		

		//商品列表

		public function lists(){
		    
// 			$count = M('kly_goods')->count();

// 			$Page  = new Page($count,10);

// 			$show = $Page -> show();

			$goods = M('kly_goods')->order('id')->select();

			foreach($goods as $key=>$val){

				 if($val['status'] == 1) {
				     $goods[$key]['status'] = '已下架';
				 } else{
				     $goods[$key]['status'] = '上架';
				 }
					$goods[$key]['addtime'] = date("Y-m-d H:i",$val['addtime']);

			}

            // $this -> assign("page",$show);

			$this -> assign("goods",$goods);

			$this -> display(); 			

				

			

		}

		public function banner(){

			$user = M("banner");

			$banner = $user ->order('id asc') -> select();

			$this -> assign("banner",$banner);

			$this -> display(); 			
				
		}
		
		public function tgmbg(){

			$user = M("tgmbg");

			$tgmbg = $user ->order('sort asc') -> select();

			$this -> assign("tgmbg",$tgmbg);

			$this -> display(); 			
				
		}
		
		//添加推广码背景图片
		public function addtgmbg(){
			$this->display();
		}
		
		public function addtgmbgHandel(){

			$tmgbg = M('tgmbg');

			$data['id']=$_POST['id'];

			$data['sort']=$_POST['sort'];

			$_POST['path'] = $this -> upload();
				if($tmgbg ->create()){
					if($tmgbg -> add()){
					    $this->success('添加成功',U(GROUP_NAME .'/Shop/tgmbg'));
					}else{
						$this -> error('添加失败');
					}
				}			
		}
		
		public function deltgmbg() {
			$id = I('id');

			$tgmbg = M("tgmbg");
	
			$map['id'] = array('in',$id);
	
			if($tgmbg -> where($map) -> delete($id)){
	
					$this->success('删除成功',U(GROUP_NAME .'/Shop/tgmbg'));
	
			}else{
	
				$this -> error("删除失败");
	
			}
		}
		
		public function changeStatus() {
			$res = array('success'=>0,'msg'=>'');
			$id = $_POST['id'];
			$status = $_POST['status'];
			if($status == 1) {
				M('tgmbg')->where(array('is_on'=>1))->save(array('is_on'=>0));
				// $count = M('tgmbg')->where(array('is_on'=>1))->count();
				// if($count >= 1) {
				// 	$res['msg'] = '至多只能设置一个背景图为显示';
				// 	echo json_encode($res);exit;
				// }
			}
			$rst = M('tgmbg')->where(array('id'=>$id))->save(array('is_on'=>$status));
			if($rst){
				$res['success'] = 1;
				$res['msg'] = '设置成功';
				echo json_encode($res);exit;
			} else{
				$res['msg'] = '设置失败';
				echo json_encode($res);exit;
			}
		}

		//添加商品

		public function add_product(){

			$type = M('type');

			$types = $type ->select();

			$this->assign('types',$types);			

			$this->display();

		}

		//添加商户等级

		public function shop_group(){

			$shop_group = M('shop_group');

			$list = $shop_group->select();



			$this->assign('list',$list);			

			$this->display();

		}

        //修改商户等级

      	public function	editshop_group(){

			$shop_group = M('shop_group')->where(array('groupid'=>I('groupid')))->find();

			$this->assign('shop_group',$shop_group);			

			$this->display();

		}

		//修改商户等级处理

		public function editshop_groupHandle(){

			$groupid = I('groupid',0,'intval');

			unset($_POST['groupid']);

			M('shop_group')->where(array('groupid'=>$groupid))->save($_POST);

			//添加日志

			$desc = '修改ID为'. $groupid .'的商户等级';

			write_log(session('username'),'admin',$desc);



			$this->success('商户等级修改成功!',U(GROUP_NAME.'/Shop/shop_group'));



		}			

		//添加广告

		public function addbanner(){

			$banner = M('banner');

			$data['id']=$_POST['id'];

			$data['sort']=$_POST['sort'];

			$_POST['path'] = $this -> upload();

				if($banner ->create()){

					if($banner -> add()){

					    $this->success('添加成功',U(GROUP_NAME .'/Shop/banner'));

					}else{

						$this -> error('添加失败');

					}

				}			



		}

		//添加商品表单处理

		public function addProductHandle(){

			$product = M('product');

			$type = M('type');

			$data['id']=$_POST['tid'];

			

			$d = $type->where($data)->field("pid")->find();

			$_POST['pid']= $d['pid'];
			

			$_POST['inputtime']= NOW_TIME;

			$_POST['thumb'] = $this -> upload();

		

				if($product ->create()){

					if($product -> add()){

					    $this->success('添加成功',U(GROUP_NAME .'/Shop/lists'));

					}else{

						$this -> error('添加失败');

					}

				}			



		}

		

			//修改商品

		public function editProduct(){
            $id = I('id');
            // dump($id);die;
            $goods = M('kly_goods')->where(['id'=>$id])->find();
            $this -> assign('goods',$goods);
    		$this -> display();

		}

		

			//修改guanggao 

		public function editbanner(){

			$banner = M('banner');

	        $id = $_GET['id'];

			$banners = $banner -> find($id);				

			$this->assign('banners',$banners);			

			$this->display();

		}

		

			//修改商品表单处理

		public function editProductHandle(){

			

			$product = M("product");

			$type = M('type');

			$id = I('id',0,'intval');

			unset($_POST['id']);

			$data['id']=$_POST['tid'];

			

			$d = $type->where($data)->field("pid")->find();

			$_POST['pid']= $d['pid'];	

            if(!empty($_FILES['thumb']['tmp_name'])){

                   $_POST['thumb'] = $this -> upload();

            }			

			 

		

			$product->where(array('id'=>$id))->save($_POST);

			$this->success('修改成功!',U(GROUP_NAME .'/Shop/lists'));			

		

		}		

		

	public function delbanner(){

		$id = I('id');

		$banner = M("banner");

		$map['id'] = array('in',$id);

		if($banner -> where($map) -> delete($id)){

				$this->success('删除商品成功',U(GROUP_NAME .'/Shop/banner'));

		}else{

			$this -> error("删除失败");

		}

	}

		

	/**

	*	del() 删除商品

	*

	*/

	public function delProduct(){

		$id = I('id');

		$product = M("product");

		$map['id'] = array('in',$id);

		if($product -> where($map) -> delete($id)){

				//添加日志操作

				$desc = '删除一个商品';

			    write_log(session('username'),'admin',$desc);

				$this->success('删除商品成功',U(GROUP_NAME .'/Shop/lists'));

		}else{

			$this -> error("删除失败");

		}

	}

	

	//商品分类列表

	public function type_list(){

			$type = M('type');

			$types = $type -> field("*,concat(path,'-',id) tpath") -> order("tpath") ->select();

		     foreach($types as &$t){

				if($t['pid'] == 0){

					$data1 = $type -> field("path,pid") -> where("pid = '{$t['id']}'&& path = '0-{$t['id']}'") -> select(); 

					if(!$data1){

						$t['son'] = "0";

					}

				}else{

					  $video = M('video');

					  $data2 = $video -> field("tid")-> where("tid = {$t['id']}") -> select();

					  if(!$data2){

						 $t['video'] = "0";

					  }

				}

			 }



              $this -> assign("types",$types);

			  $this -> display();

		}



		//添加商品分类

		public function add_type(){

			

			$this->display();

		}

		

		//商品分类表单处理

		public function addTypeHandle(){

			$type = M('type');

		



					if($type -> add($_POST)){

						//添加日志操作

						$desc = '添加一个新的商品分类';

						write_log(session('username'),'admin',$desc);

					   $this->success('添加成功',U(GROUP_NAME .'/Shop/type_list'));

					}else{

						

						$this -> error('添加失败');

					}		

		}

		//添加子模块

		public function addSon(){

			$this -> display();

		}

		//添加子模块表单处理

		public function addSonHandle(){

			$type = M('type');

			$pid = $_POST['pid'];

			$_POST['path'] = "0-{$pid}"; 

				 

			if($type -> create()){

					if($type -> add()){

					  //添加日志操作

						$desc = '添加一个商品分类子类';

						write_log(session('username'),'admin',$desc);

					   $this->success('添加成功',U(GROUP_NAME .'/Shop/type_list'));

					}else{

						

						$this -> error('添加失败');

					}

			}

		}		

		

		//删除类型

		public function delType(){

			$id = I('id');

			$type = M('type');

			$map['id'] = array('in',$id);

			if($type -> where($map) -> delete($id)){

				//添加日志操作

				$desc = '删除一个商品分类';

			    write_log(session('username'),'admin',$desc);

				$this->success('删除分类成功',U(GROUP_NAME .'/Shop/type_list'));

			}else{

				$this -> error('删除失败');

			}



		}		

        //修改分类

      	public function	editType(){

			$type = M('type')->where(array('id'=>I('id')))->find();

			$this->assign('type',$type);			

			$this->display();

		}

		//修改分类处理

		public function editTypeHandle(){

			$id = I('id',0,'intval');

			unset($_POST['id']);

			M('type')->where(array('id'=>$id))->save($_POST);

			//添加日志

			$desc = '修改ID为'. $id .'商品分类';

			write_log(session('username'),'admin',$desc);



			$this->success('商品分类修改成功!',U(GROUP_NAME .'/Shop/type_list'));



		}		

		

		//异步验证分类是否存在

		public function checkTypeName(){

			//判断是否异步提交

			IS_AJAX or halt('对不起，页面不存在');



			if (M('type')->where(array('name'=>I('name')))->getField('id')) {

				echo 'false';

			}else{

				echo 'true';

			}

		}	



      Public function upload(){

		  import('ORG.Net.UploadFile');

		  $upload = new UploadFile();// 实例化上传类

		  $upload->maxSize  = 1000000 ;// 设置附件上传大小

		  $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

		  $upload->savePath =  './Public/Uploads/'.date("Ymd",NOW_TIME)."/";// 设置附件上传目录

		 if(!$upload->upload()) {// 上传错误提示错误信息

		     $this->error($upload->getErrorMsg());

		 }else{// 上传成功 获取上传文件信息

		      $info =  $upload->getUploadFileInfo();

		 }

			if($info){

				$savepath = str_replace(".","",$info[0]['savepath']);

				$filePath = $savepath.$info[0]['savename'];



				return $filePath;

			}else{

				$this -> error($upload -> getError());

			}

      }	

      //订单管理

      public function orderlist(){
			$type = $_POST['type'];
			$typename = $_POST['typename'];
			$start_time = !empty($_POST['start_time'])?strtotime($_POST['start_time']):0;
			$end_time = !empty($_POST['end_time'])?strtotime("+1day",$_POST['end_time']):time();
			
			//查询的数据
    		if(!empty($typename)){
    			if($type == 1){
    				$map['a.id'] = $typename;
    			} elseif ($type == 2) {
    				$map['a.user'] = $typename;
    			}
    		}
    		$map['a.createtime'] = array(array('egt',$start_time),array('lt',$end_time));
		  
		    import("@.ORG.Util.Page");

			$count = M('kly_gy')->where($map) ->count();

			$Page       = new Page($count,20);

			$show = $Page -> show();

			$orders = M('kly_gy as a')->where($map)->join('ds_member as c on a.user_id = c.id')->join('ds_kly_goods as g on a.goods_id = g.id')->limit($Page->firstRow.','.$Page->listRows)->field('a.*,c.truename,g.goods_name')->order('a.id desc')->select();
// 			dump($orders);die;
            $this -> assign("page",$show);

			$this->assign('type',$type);
			$this -> assign("orders",$orders);

			$this -> display(); 		  

		}
		
		
		//导出已购矿机
		public function excelorder() {
			$orders = M('order as a')->join('ds_agreement as b on a.id = b.order_id')->field('a.*,b.path,b.addtime as xytime')->order('id desc')->select();
			// dump($orders);die;
        	
	    	require_once ROOT_PATH . '/extend/lib/PHPExcel/Classes/PHPExcel.php';
            $objPHPExcel = new \PHPExcel();
            //列宽 自适应
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);

            //根据excel坐标，添加数据
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ID ')
                ->setCellValue('B1', '矿机编号')
                ->setCellValue('C1', '会员ID')
                ->setCellValue('D1', '会员账号')
                ->setCellValue('E1', '矿机名称')
                ->setCellValue('F1', '购买价格')
                ->setCellValue('G1', '购买时间')
                ->setCellValue('H1', '购买方式')
                ->setCellValue('I1', '状态')
                ->setCellValue('J1', '签署协议')
                ->setCellValue('K1', '签署协议时间')
     			;

            foreach($orders as $key=>$val){
                $num = $key +2;
                $A = 'A'.$num;
                $B = 'B'.$num;
                $C = 'C'.$num;
                $D = 'D'.$num;
                $E = 'E'.$num;
                $F = 'F'.$num;
                $G = 'G'.$num;
                $H = 'H'.$num;
                $I = 'I'.$num;
                $J = 'J'.$num;
                $K = 'K'.$num;
	
				if(!$val['xytime']) {
					$val['xytime'] = '';
				} else {
					$val['xytime'] = date('Y-m-d H:i:s',$val['xytime']);
				}
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue($A,$val['id'])
                    ->setCellValue($B,$val['kjbh'])
                    ->setCellValue($C,$val['user_id'])
                    ->setCellValue($D,$val['user'])
                    ->setCellValue($E,$val['project'])
                    ->setCellValue($F,$val['sumprice'])
                    ->setCellValue($G,$val['addtime'])
                    ->setCellValue($H,$val['payway'])
                    ->setCellValue($I,$val['zt'] == 1 ? '运行中' : '已到期')
                    ->setCellValue($J,$val['path'] ? '是' : '否')
                    ->setCellValue($K,$val['xytime'])

                    ;
            }

            $showtime = date('Ymdhis');
            $file_name = '已购矿机列表'.$showtime.'.xlsx';

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
            $desc = '导出已购矿机';
			write_log(session('adminusername'),'admin',$desc);
        }



		//删除订单

		public function delOrder(){

			$id = I('id');

			$order = M('order');

			$map['id'] = array('in',$id);

			if($order -> where($map) -> delete($id)){

				//添加日志操作

				$desc = '删除订单';

			    write_log(session('username'),'admin',$desc);

				$this->success('删除订单成功',U(GROUP_NAME .'/Shop/orderlist'));

			}else{

				$this -> error('删除失败');

			}



		}

       //订单详情

       public function 	editOrder(){

			$order = M('order')->where(array('id'=>I('id')))->find();

			$this->assign('order',$order);			

			$this->display();		   

	   }

	   

      //订单发货操作

	  

       public function editOrderHandle(){

		   

			$id = I('id',0,'intval');

			unset($_POST['id']);

			if($_POST['status']==2){

				

				$jinbidetail = M('jinbidetail');

				//订单信息

				$orderinfo = M('order')->where(array('id'=>$id))->find();



			    //订单状态更新	

				M('order')->where(array('id'=>$id))->save($_POST);



				//添加日志

				$desc = 'ID为'. $id .'订单发货';

				write_log(session('username'),'admin',$desc);



			}

			$this->success('订单操作成功!',U(GROUP_NAME .'/Shop/orderlist'));		   

		   

	   }

        //活动管理

        public function 	hdgl(){

            $order = M("hdjl");



            import("@.ORG.Util.Page");

            $count = $order ->count();

            $Page       = new Page($count,20);

            $show = $Page -> show();

            $list = $order -> limit($Page ->firstRow.','.$Page -> listRows)->order('id desc') -> select();

            foreach($list as $k=>$v){

                $list[$k]['kjname'] = M('product')->where(array('id'=>$v['kj_id']))->getField('title');

            }

            $this -> assign("page",$show);



            $this->assign('list',$list);

            $this->display();

        }

        public function 	addhuodong(){

	        $list = M('product')->select();

            $this->assign('list',$list);

            $this->display();

        }



        public function 	hdpost(){

            //  var_dump($_POST);die();

            $type = M('hdjl');

            $data['name'] = $_POST['name'];

            $data['num'] = $_POST['num'];

            $data['zszc'] = $_POST['zszc'];

            $data['kj_id'] = $_POST['kj_id'];

            $data['kj_num'] = $_POST['kj_num'];

            $data['addtime'] = strtotime($_POST['addtime']);

            $data['endtime'] = strtotime($_POST['endtime']);

            if($type -> add($data)){

                //添加日志操作

                $desc = '添加活动';

                write_log(session('username'),'admin',$desc);

                $this->success('添加活动成功',U(GROUP_NAME .'/Shop/hdgl'));

            }else{



                $this -> error('添加失败');

            }

        }



        public function edithd(){



            $list = M('hdjl') -> where(array('id'=>$_GET['id'])) -> find();

            $product = M('product') -> select();

            $this->assign('product',$product);

            $this->assign('list',$list);

            $this->display();

        }

        public function edithdpost(){

            $id = I('id');

            unset($_POST['id']);

            $data['name'] = $_POST['name'];

            $data['num'] = $_POST['num'];

            $data['zszc'] = $_POST['zszc'];

            $data['kj_id'] = $_POST['kj_id'];

            $data['kj_num'] = $_POST['kj_num'];

            $data['addtime'] = strtotime($_POST['addtime']);

            $data['endtime'] = strtotime($_POST['endtime']);



            if (M('hdjl')->where(array('id'=>$id))->save($data)) {

                $this->success('编辑成功！',U(GROUP_NAME.'/Shop/hdgl'));

            }else{

                $this->error('数据没有更改！',U(GROUP_NAME.'/Shop/hdgl'));

            }}

        //删除活动

        public function delhd(){

            $id = I('id');

            $hdjl = M('hdjl');

            $map['id'] = array('in',$id);

            if($hdjl -> where($map) -> delete($id)){

                //添加日志操作

                $desc = '删除活动';

                write_log(session('username'),'admin',$desc);

                $this->success('删除活动成功',U(GROUP_NAME .'/Shop/hdgl'));

            }else{

                $this -> error('删除失败');

            }



        }
        
        public function order_list(){
			$order_list = M("order_list");
	
			$map['title'] = array("LIKE","%{$_GET['title']}%");
			
			$map['status'] = array("neq",3);
			
			$map['paytype'] = "erwei";
			
			if ($_GET['type'] == 1){
				$map['user_id'] = $_GET['typename'];
			}else if($_GET['type'] == 2){
				$map['username'] = $_GET['typename'];
			}
	
		    import("@.ORG.Util.Page");
	
			$count = $order_list -> where($map)->count();
	
			$Page       = new Page($count,10);
	
			$show = $Page -> show();
	
			$order_lists = $order_list -> where($map) -> limit($Page ->firstRow.','.$Page -> listRows)->order('id desc') -> select();
			
			foreach ($order_lists as &$v){
				$v['truename'] = M('member')->where(array('id'=>$v['user_id']))->getField('truename');
			}
	
	        $this -> assign("page",$show);
	
	
	
			$this -> assign("order_list",$order_lists);
	
			$this -> display(); 
		}
		
		public function adopt_order(){
			$get = $_POST;
			$order_list = M("order_list")->where(array("id"=>$get['id']))->find();
			//判断是否已处理，或是否存在
			if ($order_list['status'] != 0 && $order_list['status'] != 4){
				$this->error("对不起，该购买记录已处理");
			}
			if (empty($order_list)){
				$this->error("对不起，该购买记录不存在");
			}
			
			switch ($get['isa']){
				//拒绝
				case 0:
					$data = [
						"status"	=> 2,
						"confirmtime"	=> time(),
						"confirmadmin"	=> session("adminusername"),
					];
					$ret = M("order_list")->where(array("id"=>$get['id']))->save($data);
					if($ret){
						$this->success("操作成功：已拒绝");
					}else{
						$this->error("操作失败");
					}
					break;
				//允许
				case 1:
					M()->startTrans();
					//记录充值状态
					$data = [
						"status"	=> 1,
						"confirmtime"	=> time(),
						"confirmadmin"	=> session("adminusername"),
					];
					$ret = M("order_list")->where(array("id"=>$get['id']))->save($data);
					//记录充值日志
					$data = M("product")->where(array('id'=>$order_list['kjid']))->find();
					if (empty($data)){
						$this->error("矿机不存在");
						return;
					}
					if($ret){
						$this->getbuy($order_list['kjid'],$data,$order_list['user_id'],$order_list['username']);
						M()->commit();
						$this->success("操作成功：已通过");
					}else{
						M()->rollback();
						$this->error("操作失败");
					}
					break;
					
				case 5:
					$data = [
						"status"	=> 5,
						"confirmtime"	=> time(),
						"confirmadmin"	=> session("adminusername"),
					];
					$ret = M("order_list")->where(array("id"=>$get['id']))->save($data);
					if($ret){
						$this->success("操作成功：已处理");
					}else{
						$this->error("操作失败");
					}
					break;
			}
		}
		
		private function getbuy($id,$data,$userid,$username){			
			$map = array();
	
			$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'Q', 'Q', 'I', 'J');
	
			$map['kjbh'] = $yCode[intval(date('Y')) - 2011] . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
	
			  $map['user'] = $username;
	
			  $map['user_id'] = $userid;
	
			  $map['project']= $data['title'];
	
			  $map['sid'] = $data['id'];
	
			  $map['yxzq'] = $data['yszq'];		
	
	          $map['sumprice'] = $data['price'];
	
			  $map['addtime'] = date('Y-m-d H:i:s');	
	
	          $map['imagepath'] = $data['thumb'];
	
			  $map['lixi']	= $data['gonglv'];
	
			  $map['kjsl'] =  $data['shouyi'];
	
	          $map['zt'] =  1;
	          $map['payway'] = '现金';
	
	          $map['UG_getTime'] =  time();	
	          $map['kj_addtime'] = time();
	
			  M('order')->add($map);		
	
			  M("product")->where(array("id"=>$id))->setDec("stock");
	
			  //写入上级团队算力
	
			$parentpath = M("member")->where(array("username"=>$username))->getField("parentpath");
	
			$path2 = explode('|', $parentpath);
	
	        array_pop($path2);
	
		    $parentpath = array_reverse($path2);
	
	        foreach($parentpath as $k=>$v){
	
				 M("member")->where(array('id'=>$v))->setInc("teamgonglv",$map['lixi']);
	
	        }	
	        
	        //算力升级
	      $suanli = M("order")->where(array("user_id"=>$userid))->sum('lixi');
	      $suanli = $suanli ? $suanli : 0;
	      $level_array = M("team_level_group")->order('id desc')->select();
	      $user_level = M('member')->where(array("id"=>$userid))->getField('level');

	      foreach ($level_array as  $vv) {
	        if($suanli>=$vv['condition']&&$user_level['level']<$vv['level']){
	          M('member')->where(array("id"=>$userid))->save(array('level'=>$vv['level']));
	          break;
	        }
	      }


			$userinfo = M("member")->field('id,username,level,parent_id,yuanqi,suanli,ipfs')->where(array("id"=>$userid))->find();
	//团队结算===================================↓
		   // M('member')->where(array('id'=>$userinfo['id']))->setInc('achievement',$data['gonglv']);
	       // $list = M('member')->field('id,username,parent_id,achievement')->select();
	       //无限上级同时增加总业绩(算力)
	
	       // $this->achievement($list,$userinfo['id'],$data['gonglv']);
	       //奖励结算
	        $this->reward($userinfo,$data['price'],$data['gonglv']);
	//团队结算===================================↑
	
	
			   //写入个人算力
	
			  M("member")->where(array("username"=>$username))->setInc("mygonglv",$map['lixi']);
	
		            //写入个人矿机数量
	
			  M("member")->where(array("username"=>$username))->setInc('kjnum');
	
	
	       $p_id=M('member')->where("id = {$userid}")->getField('parent_id');
	
			//统计
	
	       if(!empty($p_id)){
	
	           for($i=1;$i<=6;$i++){
	
	               $p_userinfo=M('member')->where("id = {$p_id}")->find();
	
	               if($p_userinfo){//$p_userinfo['level']
	
	                   $group=M("member_group")->where(array("level"=>$p_userinfo['level']))->find();
	
	                   if($group['ldj'] >=$i){//判断是否可以分到代数
	
	                       $fl_bi=C('tjj_'.$i);
	
	                       $p_shouyi=$data['price']*$fl_bi;
	
	                       M('member')->where("id = {$p_id}")->setInc("jinbi",$p_shouyi);
	
	                       jinbi($p_userinfo['username'],$p_shouyi,$i.'代/ID：'.$user_id,1);
	                   }
	
	                   $p_id=$p_userinfo['parent_id'];
	                   if(empty($p_id)){
	                       break;
	                   }
	               }else{
	                   break;
	               }
	           }
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
	   // public function suanli_reward($userinfo,$suanli){
	   //    $user_id = $userinfo['id'];
	   //    $user_rate_info = M('level_reward_set')->where(array('level'=>$userinfo['level']))->find();
	   //    $user_rate = $user_rate_info['rate'];
	   //    $suanli_reward = $suanli*$user_rate/100;
	      
	   //    if($suanli_reward > 0) {
	   //    	$leader_info = M("member")->where(array('id'=>$userinfo['parent_id']))->find(); 
	      
	   //  	 M("member")->where(array('id'=>$leader_info['id']))->setInc('my_sl',$suanli_reward);
	   //  	jinbi($leader_info['username'],$suanli_reward,'节点代币奖励',1,2,'my_sl',$userinfo['username']);
	   //    }
	      
	   // }  
	
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
		   
		//协议列表
		public function agreementlist() {
			$type = $_POST['type'];
			$typename = $_POST['typename'];
			$map = [];
			//查询的数据
    		if(!empty($typename)){
    			if($type == 1){
    				$user_id = $typename;
    				$map['order_id'] = M('order')->where(array('user_id'=>$user_id))->getField('id');
    				$map['order_id'] = $typename;
    			} elseif ($type == 2) {
    				$username = $typename;
    				$map['order_id'] = M('order')->where(array('username'=>$username))->getField('id');
    				$map['user'] = $typename;
    			}
    		}
			$list = M('agreement')->where($map)->order('id desc')->select();
			// dump($list);
			// $this->assign('list',$list);
			// $this->display();
		}

	}
	
	



?>