<?php  



	/**

	* 会员管理控制器

	*/

	class MemberAction extends CommonAction{



		//会员列表

		public function check(){

	
			$map = $this -> _search();
            // dump($map);die;
			$pid=I('get.pid',0,'intval');

			$datas = I('get.');

			$id = $datas['id'];

			$status = $datas['status'];

			// if($id&&$status=='2'){

			// 	M('member')->where(array('id'=>$id))->save(array('status'=>'1'));
			
			// $this->success('修改重新上传收款码成功！',U(GROUP_NAME.'/Member/check'));

			// }

			if(!empty($pid)){

				$map['parent_id'] = array('eq',$pid);	

			}



			$type=$_POST['type'];

			$typename=$_POST['typename'];
			

	        if (!empty($type) && !empty($typename)) {

	        	//$map['type'] = array("eq",$_POST['type']); 

				if($type ==1){

					$map['id']=	$typename;

				}elseif($type ==2){

					$map['truename']=$typename;	

				}elseif($type ==3){

					$map['mobile']=	$typename;	

				}elseif($type ==4){

					$map['username']=	$typename;	

				}

				

				

	        }			

			if (method_exists($this, '_search_filter')) {

				$this -> _search_filter($map);

			}

			$name = $this -> getActionName();



			$model = D($name);

			$infos = M('team_level_group')->field('level,name')->select();

			foreach($infos as $k=>$v){

				$group[$v['level']] = $v['name'];

			}

			$this->assign('group',$group);	

			if (!empty($model)) {

				$this -> _list($model, $map);

			}


			$this->display();

		}

		

		



		



		

		public function award(){

			

				//会员级别



				$product=M('product')->where("is_on=0")->select();

				$this->assign('product',$product);

				$this->display();

			

	    }

		

		

		public function awardpost(){



				$username=$_POST['username'];

				$num=I('post.num',0,'intval');

				$is_include=I('post.is_include',0,'intval');

				if(empty($username)){

					$this->error('请输入会员编号');

				}

				$user_id = M('member')->where(array('username'=>$username))->getField('id');

            $product = M("product");

            $id =  $num;

            //查询矿机信息

            $data = $product -> find($id);

            if(empty($data)){

                $this->error('矿机不存在');

            }



                $map = array();

                $map['kjbh'] = 'ZS' . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));

                $map['user'] = $username;

                $map['user_id'] = $user_id;

                $map['project']= $data['title'];

                $map['sid'] = $data['id'];

                $map['yxzq'] = $data['yszq'];

                $map['sumprice'] = $data['price'];

                $map['addtime'] = date('Y-m-d H:i:s');

                $map['imagepath'] = $data['thumb'];

                $map['lixi']	= $data['gonglv'];

                $map['kjsl'] =  $data['shouyi'];

                $map['zt'] =  1;

                $map['UG_getTime'] =  time();

                M('order')->add($map);

                jinbi($username,0,'平台赠'.$data['title'],1,2);

                $product->where(array("id"=>$id))->setDec("stock");



				$this->success("执行成功！");



	    }

		

		

		

		

		public function awardlist(){

				

				

			$Data = M('jinbidetail'); // 实例化Data数据对象

			import("@.ORG.Util.Page");// 导入分页类

			$map = array();

			if (isset($_POST['id']) && $_POST['id']!='') {

				$map['member'] = array("eq",$_POST['id']);

			}

            $map['type'] = 2;

			$count      = $Data->where($map)->count();// 查询满足要求的总记录数

	        $Page       = new Page($count,30);// 实例化分页类 传入总记录数

	        

	        

	        $list = $Data->where($map)->order('addtime desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();



	        $show       = $Page->show();// 分页显示输出

	        $this->assign('page',$show);// 赋值分页输出

	        $this->assign('list',$list);// 赋值数据集



	        $this->display(); // 输出模板

			

		}



        public function qianbaolist(){





            $Data = M('jinbidetail'); // 实例化Data数据对象

            import("@.ORG.Util.Page");// 导入分页类

            $map = array();

            if (isset($_POST['id']) && $_POST['id']!='') {

                $map['member'] = array("eq",$_POST['id']);

            }

            $map['type'] = 1;

            $count      = $Data->where($map)->count();// 查询满足要求的总记录数

            $Page       = new Page($count,30);// 实例化分页类 传入总记录数





            $list = $Data->where($map)->order('addtime desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();



            $show       = $Page->show();// 分页显示输出

            $this->assign('page',$show);// 赋值分页输出

            $this->assign('list',$list);// 赋值数据集

            $this->display(); // 输出模板



        }



        public function zichanlist(){





            $Data = M('zichandetail'); // 实例化Data数据对象

            import("@.ORG.Util.Page");// 导入分页类

            $map = array();

            if (isset($_POST['id']) && $_POST['id']!='') {

                $map['member'] = array("eq",$_POST['id']);

            }

            $map['type'] = 1;

            $count      = $Data->where($map)->count();// 查询满足要求的总记录数

            $Page       = new Page($count,30);// 实例化分页类 传入总记录数





            $list = $Data->where($map)->order('addtime desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();



            $show       = $Page->show();// 分页显示输出

            $this->assign('page',$show);// 赋值分页输出

            $this->assign('list',$list);// 赋值数据集

            $this->display(); // 输出模板



        }



        public function yuelist(){





            $Data = M('keshoudetail'); // 实例化Data数据对象

            import("@.ORG.Util.Page");// 导入分页类

            $map = array();

            if (isset($_POST['id']) && $_POST['id']!='') {

                $map['member'] = array("eq",$_POST['id']);

            }

            $map['type'] = 1;

            $count      = $Data->where($map)->count();// 查询满足要求的总记录数

            $Page       = new Page($count,30);// 实例化分页类 传入总记录数





            $list = $Data->where($map)->order('addtime desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();



            $show       = $Page->show();// 分页显示输出

            $this->assign('page',$show);// 赋值分页输出

            $this->assign('list',$list);// 赋值数据集

            $this->display(); // 输出模板



        }



		//封号解封处理

		public function editFeng(){

			$lock = I('get.lock',0,'intval');

			$id = I('get.id',0,'intval');

			M('member')->where(array('id'=>$id))->save(array("lock"=>$lock));

            $this->success('设置成功！',U(GROUP_NAME.'/Member/check'));



		}



		/**

		 * 金币充值

		 * @return [type] [description]

		 */

		public function addJinbi(){

			$member = M('member')->where(array('id'=>I('get.id',0,'intval')))->find();

			

			$map['desc'] = '平台充值';

			$map['member'] = $member['username'];

			$list = M("jinbidetail")->where($map)->order("id desc")->select();

			$this->assign('list',$list);	

            $this->assign('member',$member);			

			$this->display();

		}



		/**

		 * 充值处理函数

		 * @return [type] [description]

		 */

		public function addJinbiHandle(){

			$userid = I('post.id',0,'intval');

			 $jinbi  = I('post.jinbi',0,'intval');

			 $type  = I('post.type',0,'intval');

			if($type == 0){

			    $this->error('请选择充值类型！',U(GROUP_NAME.'/Member/addJinbi'));

            }

			$member = M('member')->where(array('id'=>$userid))->find();

			if($jinbi>0){

			    if($type == 1){



                    M('member')->where(array('id'=>$userid))->setInc('jinbi',$jinbi);

                    jinbi($member['username'],$jinbi,'平台充值',1,1);

                    $this->success('充值矿池钱包成功！',U(GROUP_NAME.'/Member/addJinbi'));

                }elseif ($type == 2){



                    M('member')->where(array('id'=>$userid))->setInc('kczc',$jinbi);

                    zichan($member['username'],$jinbi,'平台充值',1,1);

                    $this->success('充值矿池资产成功！',U(GROUP_NAME.'/Member/addJinbi'));





                }elseif ($type == 3){

                    M('member')->where(array('id'=>$userid))->setInc('ksed',$jinbi);

                    $this->success('充值可售额度成功！',U(GROUP_NAME.'/Member/addJinbi'));





                }elseif ($type == 4){



                    M('member')->where(array('id'=>$userid))->setInc('ksye',$jinbi);

                    keshou($member['username'],$jinbi,'平台充值',1,1);

                    $this->success('充值可售余额成功！',U(GROUP_NAME.'/Member/addJinbi'));



                }

			}elseif($jinbi<0){

                if($type == 1){



                    M('member')->where(array('id'=>$userid))->setInc('jinbi',$jinbi);

                    jinbi($member['username'],$jinbi,'平台充值',0,1);

                    $this->success('充值矿池钱包成功！',U(GROUP_NAME.'/Member/addJinbi'));

                }elseif ($type == 2){



                    M('member')->where(array('id'=>$userid))->setInc('kczc',$jinbi);

                    zichan($member['username'],$jinbi,'平台充值',0,1);

                    $this->success('充值矿池资产成功！',U(GROUP_NAME.'/Member/addJinbi'));





                }elseif ($type == 3){

                    M('member')->where(array('id'=>$userid))->setInc('ksed',$jinbi);

                    $this->success('充值可售额度成功！',U(GROUP_NAME.'/Member/addJinbi'));





                }elseif ($type == 4){



                    M('member')->where(array('id'=>$userid))->setInc('ksye',$jinbi);

                    keshou($member['username'],$jinbi,'平台充值',0,1);

                    $this->success('充值可售余额成功！',U(GROUP_NAME.'/Member/addJinbi'));



                }

			}

			

		}

		

//删除会员

	public function delete(){

			$member = M('member');

			$minfo = $member->where(array('id'=>I('get.id',0,'intval')))->find();

			if ($member->where(array('id'=>$_GET['id']))->delete()) {

				$member->where(array('parent_id'=>$minfo['id']))->save(['parent'=>'','parent_id'=>0]);

				

				M('members_sign')->where(array('user_id'=>$minfo['id']))->delete();

				M('order')->where(array('user_id'=>$minfo['id']))->delete();

				M('jinbidetail')->where(array('member'=>$minfo['username']))->delete();

				M('qjinbidetail')->where(array('member'=>$minfo['username']))->delete();

				M('zichandetail')->where(array('member'=>$minfo['username']))->delete();

				M('tousu')->where(array('user'=>$minfo['username']))->delete();

				M('shequn')->where(array('member'=>$minfo['username']))->delete();

				M('keshoudetail')->where(array('member'=>$minfo['username']))->delete();

				M('dongjiedetail')->where(array('member'=>$minfo['username']))->delete();

				

				 $this->success('删除成功！',U(GROUP_NAME.'/Member/check'));

			}else{

				 $this->error('删除失败！',U(GROUP_NAME.'/Member/check'));

			}			

		}



		//编辑会员

		public function editMember(){

			$member = M('member')->where(array('id'=>I('id')))->find();

			$list = M('team_level_group')->select();

			$this->assign('list',$list);

			$this->assign('member',$member);

			$this->display();

		}



		//编辑会员处理函数

		public function editMemberHandle(){

			$password = I('password');

			$password2 = I('password2');

			$level = I('level');

			$truename = I('truename');

			$shenfen = I('shenfen');
			$is_partner = I('is_partner');



			$id = I('id');

			unset($_POST['id']);

			if ($password!= '') {

				$_POST['password'] = md5($password);

			}else{

				unset($_POST['password']);

			}

			if ($password2 != '') {

				$_POST['password2'] = md5($password2);

			}else{

				unset($_POST['password2']);

			}

			if ($level != '') {
				
				$_POST['level'] = $level;

			}else{

				unset($_POST['level']);

			}

			if ($truename != '') {

				$_POST['truename'] = $truename;

			}else{

				unset($_POST['truename']);

			}

			if ($is_partner != '') {
				if($is_partner == 1) {
					$limit_number = M('partner_limit')->where(array('id'=>1))->getField('partner_limit');
					$realnums = M('member')->where(array('is_partner'=>1))->count();
					if($realnums >= $limit_number){
						$this->error('设置失败，合伙人人数超限！');
					}
				}
				
				$_POST['is_partner'] = $is_partner;

			}else{

				unset($_POST['is_partner']);

			}

            if ($shenfen != '') {

                $_POST['shenfen'] = $shenfen;

            }else{

                unset($_POST['shenfen']);

            }

			if (M('member')->where(array('id'=>$id))->save($_POST)) {

				$this->success('编辑成功！',U(GROUP_NAME.'/Member/check'));

			}else{

				$this->error('数据没有更改！',U(GROUP_NAME.'/Member/check'));

			}

		}

		//
		public function partnerLimit() {
			$number = M('partner_limit')->where(array('id'=>1))->getField('partner_limit');
			$this->assign('limit',$number);
			$this->display();
		}
		
		public function partnerLimitHandle() {
			$number = $_POST['partner_limit'];
			if($number == '' || $number < 0) {
				$this->error('设置有误');
			}
			if(session('adminusername') != 'admin') {
				$this->error('对不起，您没有权限更改此设置');
			}
			$data['partner_limit'] = $number;
			$data['edittime'] = time();
			$rst = M('partner_limit')->where(array('id'=>1))->save($data);
			if($rst) {
				$this->success('设置成功');
			}
		}


		/**

		 * 后台直接跳转到会员前台

		 * @return [type] [description]

		 */

		public function inMember(){

			$username = I('get.u');

			$uid = M('member')->where(array('username'=>$username))->getField('id');

			session('mid',$uid);

			session('username',$username);

			session('usersecondlogin','1');

			session('member','adminlogin');

			$this->redirect('Index/Index/index');

		}



		//删除会员

/*		public function deleteMember(){

			$member = M('member');

			$minfo = $member->where(array('id'=>I('get.id',0,'intval')))->find();

			if ($member->where(array('id'=>$_GET['id'],'status'=>0))->delete()) {

				//更新安置人左右区信息

				if ($minfo['my_jd'] == 'left') {

					$data['left'] = array('exp','null');

					$member->where(array('username'=>$minfo['fparent']))->save($data);

				}else if($minfo['my_jd'] == 'right'){

					$data['right'] = array('exp','null');

					$member->where(array('username'=>$minfo['fparent']))->save($data);

				}

				alert('删除成功！',U(GROUP_NAME.'/Member/uncheck'));

			}else{

				alert('删除失败！',U(GROUP_NAME.'/Member/uncheck'));

			}			

		}*/

		

	    //树形图

		public function shu_list(){

			Vendor('Tree.tree');

			$menu = new tree;

				$menu->icon = array('│ ','├─ ','└─ ');

				$menu->nbsp = '&nbsp;&nbsp;&nbsp;';

				$result = M('member')->field('id,username,parentcount,parent')->select();

				foreach($result as $k=>$v){

					 

					 $arr[$v['username']] = $v;

					 $arr[$v['username']]['parentid_node'] = ($v['parent'])? ' class="child-of-node-'.$v['parent'].'"' : '';

				}

				$str  = "<tr id='node-\$username' \$parentid_node>

							<td style='padding-left:30px;'>\$spacer 会员编号：\$username (直推人数：\$parentcount)</td>

						</tr>";

			     

				$menu->init($arr);

				$categorys = $menu->get_tree(NULL, $str);		

                $this->assign('categorys',$categorys);					

			    $this->display();

		}	   
		
		//树状图列表
		public function treetable(){
			$first_member = M('member')->order('id asc')->find();
			$uid = $_GET['uid'] ? $_GET['uid'] : $first_member['id'];
			$list = M('member')->order('id asc')->field('id,is_partner,username,level,parent_id as pid')->select();
			$self = M('member')->where(array('id'=>$uid))->field('id,is_partner,username,level,parent_id as pid')->find();
			$list2 = $this->m_GetTeamMember($list,$uid);
			$list2[] = $self;
			foreach($list2 as &$val) {
				$val_count = $this->m_GetTeamMember($list, $val['id']);
		        $val['nums'] = count($val_count) + 1;
		        $str = '';
		        if($val['is_partner'] == 1) {
		        	$str = '（合伙人）';
		        }
		        $val['level'] = M('team_level_group')->where(["level"=>$val['level']])->getField("name") . $str;
			}
			$res = array('code'=>"0",'msg'=>'ok','data'=>$list2);
			$json = json_encode($res);
			$myfile = fopen("./APP/Modules/Systemlogined/Tpl/Member/tree.json", "w") or die("Unable to open file!");
			fwrite($myfile, $json);
			$this->assign('pid',$self['pid']);
			$this->display();
		}
	
		//团队树状图
		public function teamlist() {
	
	        $uid = $_GET['uid'];
	        $all_list = M('member')->field("id,parent_id as pid,username as name,level")->order('id asc')->select();
	        $members_id_data = M('member')->field("id,parent_id as pid,username as name,level")->where(["id"=>$uid])->find();
	        $array = $this->m_GetTeamMember($all_list, $uid);

	        $members_id_data['pid'] = 0;
	        $tree = array();
	        $array[]= $members_id_data;

	        foreach($array as $key=>&$val){
	            $cnam = M('team_level_group')->where(["level"=>$val['level']])->field("name")->find();
	            $val_count = $this->m_GetTeamMember($all_list, $val['id']);
	            $val_count = count($val_count);

//	            if(!$cnam['name'] || $cnam['name'] == '') {
//	                $cnam['name'] = '无';
//                }
	            $val['name'] = $val['name'].'('.$cnam['name'].')团队人数('.$val_count.')';
	        }
	
	        // die;
	        //第一步，将分类id作为数组key,并创建children单元
	        foreach ($array as $category) {
	            $tree[$category['id']] = $category;
	            $tree[$category['id']]['children'] = array();
	        }
	        //第二部，利用引用，将每个分类添加到父类children数组中，这样一次遍历即可形成树形结构。
	        foreach ($tree as $k => $item) {
	            if ($item['pid'] != 0) {
	                $tree[$item['pid']]['children'][] = &$tree[$k];
	            }
	        }
	        ////第三步，删除无用的非根节点数据  
	        foreach ($tree as $key => $category) {
	            if ($category['pid'] != 0) {
	                unset($tree[$key]);
	            }
	        }
	
	        // var_dump($uid);
	        // var_dump($tree);
	        // die;
	        // echo "<pre>";
	        $asdf = json_encode(array_values($tree), true);
	        $asdf = substr($asdf, 1);
	        $asdf = substr($asdf, 0, -1);
	        // $asdf = 1;

	        $myfile = fopen("./APP/Modules/Systemlogined/Tpl/Member/tree2.json", "w") or die("Unable to open file!");
			fwrite($myfile, $asdf);
			
	        // var_dump($asdf);
	
	       
	        $this->display();
	    }
	    
	    // 无限下级
	    public function m_GetTeamMember($members, $mid)
	    {
	        $Teams = array(); //最终结果
	        $Teams[] = $mid;
	        $array = array();
	        foreach ($members as $k => $v) {
	            if (in_array($v['pid'], $Teams, true)) {

                    $Teams[] = $v['id'];
	                $array[] = $v;

	                unset($members[$k]);
	            } else {
	                unset($members[$k]);
	            }
	        }
	        return $array;
	    }

		//会员组列表

		public function member_group(){

			$list = M('member_group')->select();

			$this->assign('list',$list);			

			$this->display('member_group_list');

		}



		//添加会员组

		public function add_member_group(){

			$list = M('member_group')->select();

			$count = count($list)+1;

			$this->assign('level',$count);

			$this->display('add_member_group');

		}

		

		//添加会员组表单处理

		public function addGroupHandle(){

			for($i=0;$i<count($_POST['dai_content']);$i++){

				if(empty($_POST['dai_content'][$i])){

					$this->error('代奖参数不能为空');

				}				 

			}



			$_POST['dai_content'] = implode(",",$_POST['dai_content']);

			$_POST['addtime'] = NOW_TIME;

			if (M('member_group')->add($_POST)) {

				//添加日志操作

				$desc = '添加一个新的会员组';

				write_log(session('username'),'admin',$desc);

               $this->success('添加成功',U(GROUP_NAME.'/Member/member_group'));

			}else{

				$this->error('添加失败');

			}

		}	

        //修改会员组

      	public function	editMemberGroup(){

      		// dump($_SESSION);

			$member_group = M('member_group')->where(array('groupid'=>I('groupid')))->find();

			$member_group['dai_content'] = explode(",",$member_group['dai_content']);

			// 矿机

			$product = M('product')->getField('id,title');

// dump($product);

			$this->assign('product1358',$product);

			$this->assign('member_group',$member_group);			

			$this->display('editMemberGroup');

		}

		//修改会员组处理

		public function editGroupHandle(){

			$groupid = I('groupid',0,'intval');

			unset($_POST['groupid']);

			$_POST['dai_content'] = implode(",",$_POST['dai_content']);

			M('member_group')->where(array('groupid'=>$groupid))->save($_POST);

			//添加日志

			$desc = '修改ID为'. $groupid .'的会员组';

			write_log(session('username'),'admin',$desc);



			$this->success('会员组修改成功!',U(GROUP_NAME.'/Member/member_group'));



		}

//↓=====================会员等级列表=============================↓

    //会员等级列表页面

    public function team_level_group(){

        $list = M('team_level_group')->select();

        $partner_level = C("partner_level");

        $this->assign('list',$list);

        $this->assign('partner_level',$partner_level);

        $this->display('team_level_group_list');

    }
	//会员签到记录
	public function sign_in_log(){
		// dump($_POST);
		import("@.ORG.Util.Page");// 导入分页类
		if(!$_POST['content'] and !$_POST['start_time'] and !$_POST['end_time']){
		$list = M('kly_sign_log')->order('id desc')->select();
		foreach($list as $key =>$val){
			$truename = M('member')->where(['id'=>$val['user_id']])->getField('truename');
			$list[$key]['sign_time'] = date('Y-m-d H:i:s',$val['sign_time']);
			$list[$key]['truename'] = $truename;
		}
	}else{
		if(!$_POST['start_time'] and !$_POST['end_time']){
			$list = M('kly_sign_log')->where(['user_id'=>$_POST['content']])->order('id desc')->select();
			foreach($list as $key =>$val){
				$truename = M('member')->where(['id'=>$val['user_id']])->getField('truename');
				$list[$key]['sign_time'] = date('Y-m-d H:i:s',$val['sign_time']);
				$list[$key]['truename'] = $truename;
			}
		}else{
			$start_time = strtotime($_POST['start_time']);
			$end_time = strtotime($_POST['end_time']);
			if(!$_POST['start_time']){
				$this->error('请选择开始日期','',3);
			}
			if(!$_POST['end_time']){
				$end_time = strtotime(date('Ymd H:i:s',time()));
			}
			if($_POST['content']){
			$list = M('kly_sign_log')->where(['user_id'=>$_POST['content'],'sign_time'=>['between',[$start_time,$end_time]]])->order('id desc')->select();
			}else{
			$list = M('kly_sign_log')->where(['sign_time'=>['between',[$start_time,$end_time]]])->order('id desc')->select();
			}
			// dump($list);die;
			foreach($list as $key =>$val){
				$truename = M('member')->where(['id'=>$val['user_id']])->getField('truename');
				$list[$key]['sign_time'] = date('Y-m-d H:i:s',$val['sign_time']);
				$list[$key]['truename'] = $truename;
			}
		}
	}
		$all_count = count($list);// 查询满足要求的总记录数
		$all_Page  = new Page($all_count,10);// 实例化分页类 传入总记录数
		if(empty($Page -> listRows)) $Page -> listRows=10;


		if(!empty($typename)){
			// $list = array_slice($select_member, $select_Page ->firstRow,$Page -> listRows,true);
			// $show = $select_Page->show();// 分页显示输出
		}else{
			$list = array_slice($list, $all_Page ->firstRow,$Page -> listRows,true);
			$show = $all_Page->show();// 分页显示输出
		}

		
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('list',$list);
		$this->display();
	}
	//会员今日签到
	public function today_sign(){
		// $user_id = where('user_id',$_POST['user_id']);
		// dump($_POST);
		import("@.ORG.Util.Page");// 导入分页类
		if($_POST['sign']==0){
			if(!$_POST['user_id']){
				$list = M('member')->order('id desc')->field('id,truename')->select();
			}else{
				$list = M('member')->where(['id'=>$_POST['user_id']])->order('id desc')->field('id,truename')->select();
			}
		// dump($list);die;
		foreach($list as $key =>$val){
			$complete = M('kly_sign_log')->where(['user_id'=>$val['id']])->order('sign_time desc')->find();
			$nowtime = strtotime(date('Ymd'));  //今日零点时间戳
			if($complete['sign_time']>$nowtime){
			$reward = M('kly_sign_reward_log')->where(['addtime'=>$complete['sign_time']])->getField('reward');
			$list[$key]['sign_time'] = date('Y-m-d H:i:s',$complete['sign_time']);
			$list[$key]['reward'] = $reward.'积分';
			$list[$key]['sign_number'] = $complete['sign_number'];
			$list[$key]['complete'] = '完成';
			}else{
			$list[$key]['complete'] = '未完成';
			}
		}
	}else{
		if($_POST['sign']==1){
			if(!$_POST['user_id']){
				$lists = M('member')->order('id desc')->field('id,truename')->select();
			}else{
				$lists = M('member')->where(['id'=>$_POST['user_id']])->order('id desc')->field('id,truename')->select();
			}
		$nowtime = strtotime(date('Ymd'));  //今日零点时间戳
		foreach($lists as $key=>$val){
			$complete = M('kly_sign_log')->where(['user_id'=>$val['id']])->order('sign_time desc')->find();
			if($complete['sign_time']>$nowtime){
				$reward = M('kly_sign_reward_log')->where(['addtime'=>$complete['sign_time']])->getField('reward');
				$list[$key]['id'] = $lists[$key]['id'];
				$list[$key]['reward'] = $reward.'积分';
				$list[$key]['sign_number'] = $complete['sign_number'];
				$list[$key]['truename'] = $lists[$key]['truename']; 
				$list[$key]['sign_time'] = date('Y-m-d H:i:s',$complete['sign_time']);
				$list[$key]['complete'] = '完成';
			}
		}
		}
		if($_POST['sign']==2){
			if(!$_POST['user_id']){
				$lists = M('member')->order('id desc')->field('id,truename')->select();
			}else{
				$lists = M('member')->where(['id'=>$_POST['user_id']])->order('id desc')->field('id,truename')->select();
			}
			$nowtime = strtotime(date('Ymd'));  //今日零点时间戳
			foreach($lists as $key=>$val){
				$complete = M('kly_sign_log')->where(['user_id'=>$val['id']])->order('sign_time desc')->find();
				if($complete){
				}
				if($complete['sign_time']<$nowtime){
					$list[$key]['id'] = $lists[$key]['id'];
					$list[$key]['truename'] = $lists[$key]['truename']; 
					$list[$key]['complete'] = '未完成';
				}
			}
		}
	}
		$all_count = count($list);// 查询满足要求的总记录数

		$all_Page  = new Page($all_count,10);// 实例化分页类 传入总记录数
		if(empty($Page -> listRows)) $Page -> listRows=10;

		$list = array_slice($list, $all_Page ->firstRow,$Page -> listRows,true);
		$show = $all_Page->show();// 分页显示输出

		$this->assign('page',$show);// 赋值分页输出
		$this->assign('list',$list);
		$this->display();
	}
	//签到奖励设置
	public function sign_reward_set(){

		if($_POST['reward1']){
		$list = M('kly_sign_reward')->where(['id'=>1])->save(['reward'=>$_POST['reward1'],'updatetime'=>time()]);
		}
		if($_POST['reward2']){
			$list = M('kly_sign_reward')->where(['id'=>2])->save(['reward'=>$_POST['reward2'],'updatetime'=>time()]);
		}
		if($_POST['reward3']){
			$list = M('kly_sign_reward')->where(['id'=>3])->save(['reward'=>$_POST['reward3'],'updatetime'=>time()]);
		}
		$reward1 = M('kly_sign_reward')->where(['id'=>1])->getField('reward');
		$reward2 = M('kly_sign_reward')->where(['id'=>2])->getField('reward');
		$reward3 = M('kly_sign_reward')->where(['id'=>3])->getField('reward');
		$this->assign('reward1',$reward1);
		$this->assign('reward2',$reward2);
		$this->assign('reward3',$reward3);
		$this->display();
	}
    //添加会员等级的页面
    public function add_team_level_group(){

        $list = M('team_level_group')->select();

		// $gifts = M('gift')->select();

		// $this->assign('gifts',$gifts);

        $this->display('add_team_level_group');

    }

    //添加团队表单处理

    public function addTeamGroupHandle(){


        if (M('team_level_group')->add($_POST)) {

            //添加日志操作

            $desc = '添加一个新的会员等级';

            write_log(session('username'),'admin',$desc);

            $this->success('添加成功',U(GROUP_NAME.'/Member/team_level_group'));

        }else{

            $this->error('添加失败');

        }

    }

    //修改会员等级的页面

    public function	edit_team_level_group(){

        // dump($_SESSION);

        $team_level_group = M('team_level_group')->where(array('id'=>I('id')))->find();

        $gifts = M('gift')->select();

        $this->assign('team_level_group',$team_level_group);

        $this->assign('gifts',$gifts);

        $this->display('edit_team_level_group');

    }

    //修改会员等级的处理

    public function editTeamLevelGroupHandle(){

        $id = I('id',0,'intval');

        unset($_POST['id']);

        M('team_level_group')->where(array('id'=>$id))->save($_POST);

        //添加日志

        // $desc = '修改ID为'. id .'的会员等级';

        // write_log(session('username'),'admin',$desc);



        $this->success('会员等级修改成功!',U(GROUP_NAME.'/Member/team_level_group'));



    }

    public function del_team_level_group(){

		$id = I('id');

		$team_level_group = M("team_level_group");

		$map['id'] = array('in',$id);

		if($team_level_group -> where($map) -> delete($id)){

				//添加日志操作

				$desc = '删除一个会员等级';

			    write_log(session('username'),'admin',$desc);

				$this->success('删除会员等级成功',U(GROUP_NAME .'/Member/team_level_group'));

		}else{

			$this -> error("删除失败");

		}

	}




		//获取用户的所有下级ID
		function get_downline($members,$mid){
		    $arr=array();
		    foreach ($members as $v) {
		        if($v['parent_id']==$mid){  //pid为0的是顶级分类
		            $arr[]=$v;
		            $arr = array_merge($arr,$this->get_downline($members,$v['id']));
		        }
		    }
		    return $arr;
		}
		//获取最顶级ID
		function get_f_parent_id($id){
			$user_info = M('member')->field('id,username,mobile,level,parent_id')->where(array('id'=>$id))->find();
			if($user_info['parent_id']!=0){
				$leader_info = M('member')->field('id,truename,mobile,is_partner,level,parent_id')->where(array('id'=>$user_info['parent_id']))->find();
				if($leader_info['is_partner']==1){
					return array(
						'user_id'=>$leader_info['id'],
						'truename'=>$leader_info['truename'],
						'mobile'=>$leader_info['mobile']
					);
				}
				$this->get_f_parent_id($user_info['parent_id']);
			}

			return NULL;
		}

	    /**
	     * 列表
	     * @param  $type              		   搜索类型
	     * @param  $typename                   搜索内容
	     * @param  $start_time                 开始时间
	     * @param  $end_time               	   结束时间
	     * @return $all_member				   全部会员的信息
	     * @return $all_member2				   全部会员的信息,包含id,上级id
	     * @return $count				       团队人数
	     * @return $get_f_parent_name		   合伙人姓名
	     * @return $suanli_where			   找到自己购买矿机的条件
	     * @return $suanli			   		   自己的算力
	     * @return $reward_suanli_where		   找到自己奖励的算力的条件
	     * @return $reward_suanli			   找到自己奖励的算力
	     * @return $integral_where			   找到自己积分的条件
	     * @return $integral			       找到自己的积分
	     * @return $fil_where 			       找到自己的节点代币奖励的条件
	     * @return $fil			               找到自己的节点代币奖励	     
	     * @return $node_reward_where 		   找到自己的节点分红的条件
	     * @return $node_reward			       找到自己的节点分红
	     */
	    public function member_detail()
	    {
	    	// echo "<pre>";

	    	$Data = M('jinbidetail'); // 实例化Data数据对象
	    	
	    	import("@.ORG.Util.Page");// 导入分页类

			$type = $_GET['type'];
			$typename = trim($_GET['typename']);
			$start_time = !empty($_GET['start_time'])?$_GET['start_time']:0;
			$end_time = !empty($_GET['end_time'])?strtotime("+1day",$_GET['end_time']):time();

	    	$all_member = M('member')->alias('a')->join('ds_team_level_group as b on a.level = b.level')->field('a.id,a.level,a.is_partner,a.truename,a.username,a.mobile,a.ipfs,a.yuanqi,b.name as level_name')->group('a.level desc,a.id asc')->select();
	    	$all_member2 = M('member')->field('id,parent_id')->select();

	    	// echo "<pre>";
	    	// var_dump($all_member);die;

	    	foreach ($all_member as &$value) {
	    		//级别
	    		$value['level_name'] = !empty($value['level_name'])?$value['level_name']:'普通会员';
	    		//是否合伙人
	    		if($value['is_partner']==1){
	    			$value['is_partner'] = '是';
	    		}else{
	    			$value['is_partner'] = '否';
	    		}
	    		//所属合伙人
	    		$get_f_parent_name = $this->get_f_parent_id($value['id']);
	    		if($get_f_parent_name!=NULL){
	    			$value['partner__id'] = '用户ID:'.$get_f_parent_name['user_id'];
	    			$value['partner_truename'] = '姓名:'.$get_f_parent_name['truename'];
	    			$value['partner_mobile'] = '手机:'.$get_f_parent_name['mobile'];
	    		}else{
	    			$value['partner__id'] = '无';
	    			$value['partner_truename'] = '';
	    			$value['partner_mobile'] = '';
	    		}
	    		//直推人数
	    		$value['push_num'] = M("member")->where(array('parent_id'=>$value['id']))->count();
	    		//团队人数
	    		$count = count($this->get_downline($all_member2,$value['id']))+1;
	    		$value['team_num'] = $count;
	    		//算力
	    		$suanli_where['user_id'] = array('eq',$value['id']);
	    		$suanli_where['zt'] = array('eq',1);
	    		$suanli_where['kj_addtime'] = array(
					array('egt',$start_time),
					array('lt',$end_time)
				);
	    		$suanli = M("order")->where($suanli_where)->sum('lixi');
	    		$value['suanli'] = !empty($suanli)?$suanli:0;
	    		//产币
	    		$jackpot_reward_where['member'] = array('eq',$value['username']);
	    		$jackpot_reward_where['type'] = array('eq',2);
	    		$jackpot_reward_where['addtime'] = array(
	    			array('egt',$start_time),
	    			array('lt',$end_time)
	    		);
	    		$jackpot_reward = M("jinbidetail")->where($jackpot_reward_where)->sum('adds');
	    		$value['jackpot_reward'] = !empty($jackpot_reward)?$jackpot_reward:0;
	    		//代币奖励
	    		$fil_where['member'] = array('eq',$value['username']);
	    		$fil_where['type'] = array('eq',3);
	    		$fil_where['addtime'] = array(
	    			array('egt',$start_time),
	    			array('lt',$end_time)
	    		);
	    		$fil = M("jinbidetail")->where($fil_where)->sum('adds');
	    		$value['fil'] = !empty($fil)?$fil:0;
	    		//管理代币奖励
	    		$partner_fil_where['member'] = array('eq',$value['username']);
	    		$partner_fil_where['type'] = array('eq',21);
	    		$partner_fil_where['addtime'] = array(
	    			array('egt',$start_time),
	    			array('lt',$end_time)
	    		);
	    		$partner_fil = M("jinbidetail")->where($partner_fil_where)->sum('adds');
	    		$value['partner_fil'] = !empty($partner_fil)?$partner_fil:0;
	    		//推荐奖
				$tjj_where['member'] = array('eq',$value['username']);
				$tjj_where['type'] = array('eq',1);
				$tjj_where['addtime'] = array(
					array('egt',$start_time),
					array('lt',$end_time)
				);
	    		$tjj = M("yuanqidetail")->where($tjj_where)->sum('adds');
	    		$value['tjj'] = !empty($tjj)?$tjj:0;
	    		//积分分红奖
				$jffh_where['member'] = array('eq',$value['username']);
				$jffh_where['type'] = array('eq',4);
				$jffh_where['addtime'] = array(
					array('egt',$start_time), 
					array('lt',$end_time)
				);
	    		$jffh = M("yuanqidetail")->where($jffh_where)->sum('adds');
	    		$value['jffh'] = !empty($jffh)?$jffh:0;
	    		//管理积分奖
				$partner_integral_where['member'] = array('eq',$value['username']);
				$partner_integral_where['type'] = array('eq',20);
				$partner_integral_where['addtime'] = array(
					array('egt',$start_time),
					array('lt',$end_time)
				);
	    		$partner_integral = M("yuanqidetail")->where($partner_integral_where)->sum('adds');
	    		$value['partner_integral'] = !empty($partner_integral)?$partner_integral:0;
	    		//管理代币奖
				$partner_fil_where['member'] = array('eq',$value['username']);
				$partner_fil_where['type'] = array('eq',21);
				$partner_fil_where['addtime'] = array(
					array('egt',$start_time),
					array('lt',$end_time)
				);
	    		$partner_fil = M("jinbidetail")->where($partner_fil_where)->sum('adds');
	    		$value['partner_fil'] = !empty($partner_fil)?$partner_fil:0;



	    		//查询的数据
	    		if(!empty($typename)){
	    			if($type ==1){
	    				if($value["id"]==$typename){
	    					$select_member[] = $value;
	    				}
	    			}elseif($type ==2){
	    				if($value["truename"]==$typename){
	    					$select_member[] = $value;
	    				}
	    			}elseif($type ==3){
	    				if($value["mobile"]==$typename){
	    					$select_member[] = $value;
	    				}
	    			}elseif($type ==4){
	    				if($value["level_name"]==$typename){
	    					$select_member[] = $value;
	    				}
	    			}elseif($type ==5){
	    				if($value["partner_name"]==$typename){
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


	    	if(!empty($typename)){
	    		$list = array_slice($select_member, $select_Page ->firstRow,$Page -> listRows,true);
	    		$show = $select_Page->show();// 分页显示输出
	    	}else{
	    		$list = array_slice($all_member, $all_Page ->firstRow,$Page -> listRows,true);
	    		$show = $all_Page->show();// 分页显示输出
	    	}

	    	
	    	$this->assign('page',$show);// 赋值分页输出
	      	$this->assign('type',$type);
	      	$this->assign('list',$list);

	        $this->display();
	    }












//↑=====================会员等级列表=============================↑
	    //导出全部/excel
        public function excel() {

        	$Data = M('jinbidetail'); // 实例化Data数据对象
        	
        	import("@.ORG.Util.Page");// 导入分页类
        	
			$type = $_GET['type'];
			$typename = $_GET['typename'];
			$start_time = !empty($_GET['start_time'])?$_GET['start_time']:0;
			$end_time = !empty($_GET['end_time'])?strtotime("+1day",$_GET['end_time']):time();

	    	$all_member = M('member')->select();
	    	$all_member2 = M('member')->field('id,parent_id')->select();

	    	foreach ($all_member as &$value) {
	    		//级别
	    		$value['level_name'] = !empty($value['level_name'])?$value['level_name']:'普通会员';
	    		//是否合伙人
	    		if($value['is_partner']==1){
	    			$value['is_partner'] = '是';
	    		}else{
	    			$value['is_partner'] = '否';
	    		}
	    		//所属合伙人
	    		$get_f_parent_name = $this->get_f_parent_id($value['id']);
	    		if($get_f_parent_name!=NULL){
	    			$value['partner__id'] = '用户ID:'.$get_f_parent_name['user_id'];
	    			$value['partner_truename'] = '姓名:'.$get_f_parent_name['truename'];
	    			$value['partner_mobile'] = '手机:'.$get_f_parent_name['mobile'];
	    		}else{
	    			$value['partner__id'] = '无';
	    			$value['partner_truename'] = '';
	    			$value['partner_mobile'] = '';
	    		}
	    		//直推人数
	    		$value['push_num'] = M("member")->where(array('parent_id'=>$value['id']))->count();
	    		//团队人数
	    		$count = count($this->get_downline($all_member2,$value['id']))+1;
	    		$value['team_num'] = $count;
	    		//算力
	    		$suanli_where['user_id'] = array('eq',$value['id']);
	    		$suanli_where['zt'] = array('eq',1);
	    		$suanli_where['kj_addtime'] = array(
					array('egt',$start_time),
					array('lt',$end_time)
				);
	    		$suanli = M("order")->where($suanli_where)->sum('lixi');
	    		$value['suanli'] = !empty($suanli)?$suanli:0;
	    		//产币
	    		$jackpot_reward_where['member'] = array('eq',$value['username']);
	    		$jackpot_reward_where['type'] = array('eq',2);
	    		$jackpot_reward_where['addtime'] = array(
	    			array('egt',$start_time),
	    			array('lt',$end_time)
	    		);
	    		$jackpot_reward = M("jinbidetail")->where($jackpot_reward_where)->sum('adds');
	    		$value['jackpot_reward'] = !empty($jackpot_reward)?$jackpot_reward:0;
	    		//代币奖励
	    		$fil_where['member'] = array('eq',$value['username']);
	    		$fil_where['type'] = array('eq',3);
	    		$fil_where['addtime'] = array(
	    			array('egt',$start_time),
	    			array('lt',$end_time)
	    		);
	    		$fil = M("jinbidetail")->where($fil_where)->sum('adds');
	    		$value['fil'] = !empty($fil)?$fil:0;
	    		//管理代币奖励
	    		$partner_fil_where['member'] = array('eq',$value['username']);
	    		$partner_fil_where['type'] = array('eq',21);
	    		$partner_fil_where['addtime'] = array(
	    			array('egt',$start_time),
	    			array('lt',$end_time)
	    		);
	    		$partner_fil = M("jinbidetail")->where($partner_fil_where)->sum('adds');
	    		$value['partner_fil'] = !empty($partner_fil)?$partner_fil:0;
	    		//推荐奖
				$tjj_where['member'] = array('eq',$value['username']);
				$tjj_where['type'] = array('eq',1);
				$tjj_where['addtime'] = array(
					array('egt',$start_time),
					array('lt',$end_time)
				);
	    		$tjj = M("yuanqidetail")->where($tjj_where)->sum('adds');
	    		$value['tjj'] = !empty($tjj)?$tjj:0;
	    		//积分分红奖
				$jffh_where['member'] = array('eq',$value['username']);
				$jffh_where['type'] = array('eq',4);
				$jffh_where['addtime'] = array(
					array('egt',$start_time), 
					array('lt',$end_time)
				);
	    		$jffh = M("yuanqidetail")->where($jffh_where)->sum('adds');
	    		$value['jffh'] = !empty($jffh)?$jffh:0;
	    		//管理积分奖
				$partner_integral_where['member'] = array('eq',$value['username']);
				$partner_integral_where['type'] = array('eq',20);
				$partner_integral_where['addtime'] = array(
					array('egt',$start_time),
					array('lt',$end_time)
				);
	    		$partner_integral = M("yuanqidetail")->where($partner_integral_where)->sum('adds');
	    		$value['partner_integral'] = !empty($partner_integral)?$partner_integral:0;
	    		//管理代币奖
				$partner_fil_where['member'] = array('eq',$value['username']);
				$partner_fil_where['type'] = array('eq',21);
				$partner_fil_where['addtime'] = array(
					array('egt',$start_time),
					array('lt',$end_time)
				);
	    		$partner_fil = M("jinbidetail")->where($partner_fil_where)->sum('adds');
	    		$value['partner_fil'] = !empty($partner_fil)?$partner_fil:0;

	    		//查询的数据
	    		if(!empty($typename)){
	    			if($type ==1){
	    				if($value["id"]==$typename){
	    					$select_member[] = $value;
	    				}
	    			}elseif($type ==2){
	    				if($value["truename"]==$typename){
	    					$select_member[] = $value;
	    				}
	    			}elseif($type ==3){
	    				if($value["mobile"]==$typename){
	    					$select_member[] = $value;
	    				}
	    			}elseif($type ==4){
	    				if($value["level"]==$typename){
	    					$select_member[] = $value;
	    				}
	    			}elseif($type ==5){
	    				if($value["partner_name"]==$typename){
	    					$select_member[] = $value;
	    				}
	    			}
	    		}

	    	}
	    	
	    	if(!empty($typename)){
	    		$list = $select_member;
	    	}else{
	    		$list = $all_member;
	    	}
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
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);

            //根据excel坐标，添加数据
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', '编号')
                ->setCellValue('B1', '姓名')
                ->setCellValue('C1', '手机号/邮箱')
                ->setCellValue('D1', '级别')
                ->setCellValue('E1', '是否合伙人')
                ->setCellValue('F1', '所属合伙人')
                ->setCellValue('G1', '直推人数')
                ->setCellValue('H1', '团队人数')
                ->setCellValue('I1', '算力')
                ->setCellValue('J1', 'FIL余额(FIL)')
                ->setCellValue('K1', '产币(FIL)')
                ->setCellValue('L1', '代币奖(FIL)')
                ->setCellValue('M1', '管理代币奖(FIL)')
                ->setCellValue('N1', '积分余额')
                ->setCellValue('O1', '推荐奖')
                ->setCellValue('P1', '积分分红奖')
                ->setCellValue('Q1', '管理积分奖')
     			;

            foreach($list as $key=>$val){
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
                $L = 'L'.$num;
                $M = 'M'.$num;
                $N = 'N'.$num;
                $O = 'O'.$num;
                $P = 'P'.$num;
                $Q = 'Q'.$num;


                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue($A,$val['id'])
                    ->setCellValue($B,$val['truename'])
                    ->setCellValue($C,$val['mobile'] ? $val['mobile'] : $val['email'])
                    ->setCellValue($D,$val['level_name'])
                    ->setCellValue($E,$val['is_partner'])
                    ->setCellValue($F,$val['partner__id'].$val['partner_truename'].$val['mobile'])
                    ->setCellValue($G,$val['push_num'])
                    ->setCellValue($H,$val['team_num'])
                    ->setCellValue($I,$val['suanli'])
                    ->setCellValue($J,$val['ipfs'])
                    ->setCellValue($K,$val['jackpot_reward'])
                    ->setCellValue($L,$val['fil'])
                    ->setCellValue($M,$val['partner_fil'])
                    ->setCellValue($N,$val['yuanqi'])
                    ->setCellValue($O,$val['tjj'])
                    ->setCellValue($P,$val['jffh'])
                    ->setCellValue($Q,$val['partner_integral'])

                    ;
            }

            $showtime = date('Ymdhis');
            $file_name = '会员明细列表'.$showtime.'.xlsx';

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

        	    //导出全部/excel
        public function excel2() {

			$user_list = M('member')->alias('a')->join('ds_team_level_group as b on a.level = b.level')->field('a.id,a.is_partner,a.regdate,a.truename,a.username,a.mobile,a.email,a.parent_id,a.ipfs,a.fil,a.yuanqi,a.tgm,b.name as level_name')->order('id')->select();

			foreach($user_list as &$val) {
				$zt_list = M('member')->where(array('parent_id'=>$val['id']))->order('id asc')->field('id,username,parent_id,level')->select();
				$val['ztnums'] = count($zt_list);//直推人数
				$val['teamnums'] = count($this->get_downline($user_list,$val['id'])) + 1;//团队人数
				$val['is_partner'] = $val['is_partner']?'是':'否';
				$val['regdate'] = date('Y-m-d H:i',$val['regdate']);
				$val['level_name'] = !empty($val['level_name'])?$val['level_name']:'普通会员';

				$parent_info = M('member')->field('truename,mobile')->where(array('id'=>$val['parent_id']))->find();
				$val['parent_name'] = $parent_info ['truename'];
				$val['parent_mobile'] = $parent_info ['username'];
				
				//个人算力
				$dateStr = date('Y-m-d', time());   //当天日期
		        $jssj = strtotime($dateStr);   //今天0点时间戳
		        $total_sl = M('order')->where(array('zt'=>1,'user_id'=>$val['id'],'kj_addtime'=>array('lt',$jssj)))->sum('lixi');	
		        $val['total_sl'] = $total_sl ? $total_sl : 0;//个人算力
		        
		        //ipfs
		        //个人产币
		        $val['cb'] = M('jinbidetail')->where(array('type'=>2,'member'=>$val['username']))->sum('adds');
				$val['cb'] = $val['cb'] ? $val['cb'] : 0;

				//节点代币奖励
		        $val['level_reward'] = M('jinbidetail')->where(array('type'=>3,'member'=>$val['username']))->sum('adds');
				$val['level_reward'] = $val['level_reward'] ? $val['level_reward'] : 0;

						


				//直推奖
				$val['tjjl'] = M('yuanqidetail')->where(array('type'=>array('in','1'),'member'=>$val['username']))->sum('adds');
				$val['tjjl'] = $val['tjjl'] ? $val['tjjl'] : 0;
				//节点分红
				$val['jffh'] = M('yuanqidetail')->where(array('type'=>array('in','4'),'member'=>$val['username']))->sum('adds');
				$val['jffh'] = $val['jffh'] ? $val['jffh'] :0;

				//管理积分奖
		        $val['partner_integral'] = M('yuanqidetail')->where(array('type'=>20,'member'=>$val['username']))->sum('adds');
				$val['partner_integral'] = $val['partner_integral'] ? $val['partner_integral'] : 0;

				//管理代币奖
		        $val['partner_fil'] = M('jinbidetail')->where(array('type'=>21,'member'=>$val['username']))->sum('adds');
				$val['partner_fil'] = $val['partner_fil'] ? $val['partner_fil'] : 0;
				
				// 可提币
				$val['canw_fil'] = M('fildetail')->where(array('type'=>2,'member'=>$val['username']))->sum('adds') + 0;   // 可提现产币
			}
			


	   
	    	require_once ROOT_PATH . '/extend/lib/PHPExcel/Classes/PHPExcel.php';
            $objPHPExcel = new \PHPExcel();
            //列宽 自适应
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);

            //根据excel坐标，添加数据
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', '用户ID')
                ->setCellValue('B1', '姓名')
                ->setCellValue('C1', '手机号/邮箱')
                ->setCellValue('D1', '级别')
                ->setCellValue('E1', '是否合伙人')
                ->setCellValue('F1', '推荐人ID')
                ->setCellValue('G1', '推荐人姓名')
                ->setCellValue('H1', '推荐人账号')
                ->setCellValue('I1', '推广码')
                ->setCellValue('J1', '直推人数')
                ->setCellValue('K1', '团队人数')
                ->setCellValue('L1', 'fil余额')
                ->setCellValue('M1', '累计可提fil')
                ->setCellValue('N1', '可提FIL余额')
                ->setCellValue('O1', '产币')
                ->setCellValue('P1', '代币奖励')
                ->setCellValue('Q1', '积分余额')
                ->setCellValue('R1', '推荐奖')
                ->setCellValue('S1', '积分分红奖')
                ->setCellValue('T1', '管理积分奖')
                ->setCellValue('U1', '管理代币奖')
                ->setCellValue('V1', '注册时间')
                ;

            foreach($user_list as $key=>$value){
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
                $L = 'L'.$num;
                $M = 'M'.$num;
                $N = 'N'.$num;
                $O = 'O'.$num;
                $P = 'P'.$num;
                $Q = 'Q'.$num;
                $R = 'R'.$num;
                $S = 'S'.$num;
                $T = 'T'.$num;
                $U = 'U'.$num;
                $V = 'V'.$num;


                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue($A,$value['id'])
                    ->setCellValue($B,$value['truename'])
                    ->setCellValue($C,$value['mobile'] ? $value['mobile'] : $value['email'])
                    ->setCellValue($D,$value['level_name'])
                    ->setCellValue($E,$value['is_partner'])
                    ->setCellValue($F,$value['parent_id'])
                    ->setCellValue($G,$value['parent_name'])
                    ->setCellValue($H,$value['parent_mobile'])
                    ->setCellValue($I,$value['tgm'])
                    ->setCellValue($J,$value['ztnums'])
                    ->setCellValue($K,$value['teamnums'])
                    ->setCellValue($L,$value['ipfs'])
                    ->setCellValue($M,$value['canw_fil'])
                    ->setCellValue($N,$value['fil'])
                    ->setCellValue($O,$value['cb'])
                    ->setCellValue($P,$value['level_reward'])
                    ->setCellValue($Q,$value['yuanqi'])
                    ->setCellValue($R,$value['tjjl'])
                    ->setCellValue($S,$value['jffh'])
                    ->setCellValue($T,$value['partner_integral'])
                    ->setCellValue($U,$value['partner_fil'])
                    ->setCellValue($V,$value['regdate'])
                    ;
            }

            $showtime = date('Ymdhis');
            $file_name = '会员列表'.$showtime.'.xlsx';

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


        //社群

        public function shequn(){

            $list = M('shequn')->select();

            $this->assign('list',$list);

            $this->display();



        }





        //社群通过

        public function sqtg(){



            $id = I('get.id',0,'intval');

            $shequn = M('shequn')->where(array('id'=>$id))->find();

            $zichan = C('sq_zc');

            $kj_id = C('sq_id');

            $kj_num = C('sqkj_num');

            $qianbao = C('qianbao');

            if($qianbao > 0){

                M('member') ->where(array('username'=>$shequn['member']))->setInc('jinbi',$qianbao);

                jinbi($shequn['member'],$qianbao,'社群奖励赠',1,5);



            }

            if($zichan > 0){

                M('member') ->where(array('username'=>$shequn['member']))->setInc('kczc',$zichan);

                zichan($shequn['member'],$zichan,'社群奖励赠',1,5);



            }

            if($kj_num > 0){

                //查询矿机信息

                $data = M('product') -> find($kj_id);

                if(!empty($data)){

                    for($i=1;$i<=$kj_num;$i++){

                        $map = array();

                        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'Q', 'Q', 'I', 'J');

                        $map['kjbh'] = $yCode[intval(date('Y')) - 2011] . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));

                        $map['user'] = session('username');

                        $map['user_id'] = $shequn['member'];

                        $map['project']= $data['title'];

                        $map['sid'] = $data['id'];

                        $map['yxzq'] = $data['yszq'];

                        $map['sumprice'] = $data['price'];

                        $map['addtime'] = date('Y-m-d H:i:s');

                        $map['imagepath'] = $data['thumb'];

                        $map['lixi']	= $data['gonglv'];

                        $map['kjsl'] =  $data['shouyi'];

                        $map['zt'] =  1;

                        $map['UG_getTime'] =  time();

                        M('order')->add($map);

                        jinbi($shequn['member'],0,'社群奖励赠'.$data['title'],1,5);

                        M('product')->where(array("id"=>$kj_id))->setDec("stock");

                    }

                }

            }





            $datas['status'] = 1;

             M('shequn')->where(array('id'=>$id))->save($datas);



            $this->success('设置成功！',U(GROUP_NAME.'/Member/shequn'));



        }



        //社群拒绝

        public function sqjj(){



            $id = I('get.id',0,'intval');

            $shequn = M('shequn')->where(array('id'=>$id))->find();

            if($shequn['status'] > 0){

                  $this->success('该申请已经审核，不可再次进行操作！',U(GROUP_NAME.'/Member/shequn'));



            }



            M('member')->where(array('id'=>$shequn['member']))->save(array("lock"=>1));



            M('shequn')->where(array('id'=>$id))->save(array("status"=>2));

            $this->success('设置成功！',U(GROUP_NAME.'/Member/shequn'));



        }

        //异步验证用户组是否存在

		public function checkGroupName(){

			//判断是否异步提交

			IS_AJAX or halt('对不起，页面不存在');



			if (M('member_group')->where(array('name'=>I('name')))->getField('groupid')) {

				echo 'false';

			}else{

				echo 'true';

			}

		}	
		
		/**
		 * 实名认证后台审核页面
		 * time 2020-07-17 
		 * author minilev
		 * */
		public function certification() {
			$id = $_GET['id'];
			if(!$id) {
				$this->error('信息不存在！','',1000);
			}
			$info = M('member')->where(array('id'=>$id))->field('id,username,status,truename,shenfen,image')->find();
			if(!$info) {
				$this->error('信息不存在！');
			}
			if($info['status'] == 0) {
				$info['status_im'] = '未提交实名认证';
			}
			if($info['status'] == 1) {
				$info['status_im'] = '等待审核';
			}
			if($info['status'] == 2) {
				$info['status_im'] = '审核已通过';
			}
			if($info['status'] == 3) {
				$info['status_im'] = '审核未通过';
			}
			$this->assign('info',$info);
			$this->display();
		}
	
		
		/**
		 * 实名审核操作
		 * author minilev
		 * 2020-07-20
		 * */
		public function certificationPass() {
			if(!IS_POST) {
				exit;
			}
			$res = array('success'=>0,'msg'=>'');
			$user_id = $_POST['id'];
			$type = $_POST['type'];
			if($type == 2) {
				$msg = '审核已通过';
			}elseif($type == 3) {
				$msg = '审核未通过';
			} else{
				$res['msg'] = '操作失败！';
				echo json_encode($res);exit;
			}
			$data = [
				'status' => $type
			];
			$rst = M('member')->where(array('id'=>$user_id))->save($data);
			if(!$rst) {
				$res['msg'] = '操作失败，请重试！';
				echo json_encode($res);exit;
			}
			$res['success'] = 1;
			$res['data']['msg'] = $msg;
			$res['msg'] = '操作成功';
			echo json_encode($res);exit;
		}
	
	
		
	}



?>