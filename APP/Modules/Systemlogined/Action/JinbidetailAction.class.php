<?php

class JinbidetailAction extends CommonAction {



    public function csdd(){

        $User = M ( 'jyzx' ); // 實例化User對象

        $data = I ( 'post.user' );



        if($data){

            $map['mc_user']=$data;



        }

    

        $map['zt']=0;

        $map['datatype']="qgcbt";



        import("@.ORG.Util.Page");// 导入分页类

        $count = $User->where ( $map )->where('mc_user is NULL or (mc_user is not NULL AND mc_user <> "18916953132" AND mc_user <> "18918174254")')->count (); // 查詢滿足要求的總記錄數

        $p = new Page($count,12);



        $list = $User->where ( $map )->where('mc_user is NULL or (mc_user is not NULL AND mc_user <> "18916953132" AND mc_user <> "18918174254")')->order ( 'id desc' )->limit ( $p->firstRow, $p->listRows )->select ();

        $show       = $p->show();// 分页显示输出

        $this->assign('page',$show);// 赋值分页输出



        $this->assign ( 'list', $list ); // 賦值數據集

        $this->display();

    }

    public function csdddel(){

        $id=$_GET['id'];

        $result=M('jyzx')->where(array('id'=>$id))->find();

        $users=M('member')->where(array('username'=>$result['mc_user']))->find();

        $shouxu = M('member_group')->where(array('level'=>$users['level']))->getField('shouxu');

        $tui =  $users['qjinbi'] + $users['qjinbi'] * $shouxu;

        if($users['qjinbi'] >= $tui){

            $user1=M('member')->where(array('username'=>$result['mc_user']))->setInc('ksye',$tui);

            $user=M('member')->where(array('username'=>$result['mc_user']))->setDec('qjinbi',$tui);

            $ppdd=M('jyzx')->where(array('id'=>$id))->delete();

            if($ppdd){

                $this->success("删除成功");

            }

        }else{

            $this->error("删除失败");

        }



    }













    //toushu

    public function report_order(){



        $ppdd_id=I('get.ppdd_id',0,'intval');

        $where="1=1";



        if(!empty($ppdd_id)){

            $where.=" and a.pid = ".$ppdd_id;

        }

        import("ORG.Util.Page");// 导入分页类

        $count = M('tousu')->alias('a')->where ($where)->count (); // 查詢滿足要求的總記錄數

        $p = new Page($count,30);





        $list=M('tousu')->alias('a')

            ->field("a.*,b.id as user_id,c.id as buser_id")

            ->join("ds_member as b on a.user=b.username")

            ->join("ds_member as c on a.buser=c.username")

            ->where($where)->order("a.id desc")->limit ( $p->firstRow, $p->listRows )->select();

        $show = $p->show();// 分页显示输出

        $this->assign('page',$show);// 赋值分页输出



        $this->assign ( 'list', $list ); // 賦值數據集

        $this->display();





    }



    public function qiugou(){



        $User = M ( 'jyzx' ); // 實例化User對象

        $data = I ( 'post.user' );



        if($data){

            $map['mr_user']=$data;

        }

        // $map['mc_user'] =array('not in',[18867513490,18916953132,18918174254]);





        $map['zt']=0;

        $map['datatype']="qgcbt";

        import("@.ORG.Util.Page");// 导入分页类

        $count = $User->where ( $map )->where('mc_user is NULL or (mc_user is not NULL AND mc_user <> "18916953132" AND mc_user <> "18918174254")')->count (); // 查詢滿足要求的總記錄數

        $p = new Page($count,12);



        $list = $User->where ( $map )->where('mc_user is NULL or (mc_user is not NULL AND mc_user <> "18916953132" AND mc_user <> "18918174254")')->order ( 'id desc' )->limit ( $p->firstRow, $p->listRows )->select ();

        $show       = $p->show();// 分页显示输出

        $this->assign('page',$show);// 赋值分页输出



        $this->assign ( 'list', $list ); // 賦值數據集

        $this->display();

    }

    public function qiugoudel(){



        $id=$_GET['id'];

        $ppdd=M('jyzx')->where(array('id'=>$id))->delete();

        if($ppdd){

            $this->success("删除成功");

        }

    }



    public function jiaoyi(){



        $User = M ( 'jyzx' ); // 實例化User對象

        $data = I ( 'post.user' );

        $user =I('post.type');

        



        if($user=='mr_user'){

            $map['mr_user']=$data;

        }

        if($user=='mc_user'){

             $map['mc_user']=$data;

            

        }





        $gname=$data;

        if($data){

            $map['_string']="(mr_user = '$gname' or mc_user = '$gname')";

        }

        



        $map['zt']=1;



        $id=I('get.id','0','intval');



        if(!empty($id)){

            $map['id']=$id;

    

    }

        // $map['mc_user'] = array('not in',C('mySelf'));



        import("@.ORG.Util.Page");// 导入分页类

        $count = $User->where ( $map )->where('mc_user is NULL or (mc_user is not NULL AND mc_user <> "18916953132" AND mc_user <> "18918174254")')->count (); // 查詢滿足要求的總記錄數

        $p = new Page($count,50);



        $list = $User->where ( $map )->where('mc_user is NULL or (mc_user is not NULL AND mc_user <> "18916953132" AND mc_user <> "18918174254")')->order ( 'jydate desc' )->limit ( $p->firstRow, $p->listRows )->select ();





        $show       = $p->show();// 分页显示输出

        $this->assign('page',$show);// 赋值分页输出



        $this->assign ( 'list', $list ); // 賦值數據集

        $this->display();

    }





    // 删除

    public function qxjy(){

        $id = $_GET['id'];



        $map['id']=$id;



        $result=M('jyzx')->where($map)->find();//出售人信息

        if (!$result['mc_user']) 

        {

            $this->error('无卖出人信息');

            exit;

        }

        $oobs = M('member')->where(array('username'=>$result['mc_user']))->find();



        if (!$oobs) 

        {

            $this->error('无卖出人信息');

            exit;

        }



        // 退费

        $shouxu = M('member_group')->where(array('level'=>$oobs['level']))->getField('shouxu');

        $tui = $result['cbt'] * $shouxu + $result['cbt'];



        $oob=M('member')->where(array('username'=>$result['mc_user']))->setInc('ksye',$tui);

        $obs=M('member')->where(array('username'=>$result['mc_user']))->setInc('ksed',$result['cbt']);



        // 记录可售余额

        keshou($result['mc_user'],$tui,'交易取消退款',1);

        // 可售额度

        dongjie($result['mc_user'],$result['cbt'],'交易取消退款',1);



        if($oob && $obs)

        {

            $re=M('jyzx')->where(array('id'=>$id))->save(array('zt'=>0,'jydate'=>'','mc_user'=>'','mc_level'=>'','mc_id'=>''));

            if($re){

                $this->success('订单删除成功');

            }



        }else{

            $this->error('订单删除失败');

        }



    }



    public function jywc(){





        $User = M ( 'jyzx'); // 實例化User對象



        $gname=I ( 'post.user' );



        if ($gname) {

            $map['_string'] = "(mr_user = '$gname' or mc_user = '$gname')";

        }

    

        $map['zt']=2;

        $map['datatype']="qgcbt";

        // $map['mc_user'] = array('not in',C('mySelf'));



        import("@.ORG.Util.Page");// 导入分页类

        $count = $User->where ( $map )->where('mc_user is NULL or (mc_user is not NULL AND mc_user <> "18916953132" AND mc_user <> "18918174254")')->count (); // 查詢滿足要求的總記錄數

        $p = new Page($count,50);



        $list = $User->where ( $map )->where('mc_user is NULL or (mc_user is not NULL AND mc_user <> "18916953132" AND mc_user <> "18918174254")')->order ( 'jydate  desc' )->limit ( $p->firstRow, $p->listRows )->select ();



        $show       = $p->show();// 分页显示输出

        $this->assign('page',$show);// 赋值分页输出



        $this->assign ( 'list', $list ); // 賦值數據集

        $this->display();

    }

    // 钱包流水明细
    public function fildetail(){

        import("@.ORG.Util.Page");// 导入分页类

        $map = array();

        if (isset($_GET['account']) && $_GET['account']!='') {

            $map['member'] = array("eq",trim($_GET['account']));

        }

        if ($_GET['start_time'] != '' && $_GET['end_time'] == '') {
            $map['addtime'] = array("egt",strtotime($_GET['start_time']));
        }elseif ($_GET['start_time'] == '' && $_GET['end_time'] != '') {
            $map['addtime'] = array("elt",strtotime($_GET['end_time']) + 86400);
        }elseif ($_GET['start_time'] != '' && $_GET['end_time'] != '') {
        	$map['addtime'] = array("between",array(strtotime($_GET['start_time']),strtotime($_GET['end_time']) + 86400));
        }

        // $map['member'] = array('not in',C('mySelf'));

        $count      = M('kly_income_log')->where($map)->count();// 查询满足要求的总记录数

        $Page       = new Page($count,10);// 实例化分页类 传入总记录数

        $list = M('kly_income_log')->where($map)->limit($Page ->firstRow.',30')->order("addtime desc")->select();

        foreach ($list as  &$value) {
            $member_info = M('member')->field('truename')->where(array("id"=>$value['user_id']))->find();
            $value['truename'] = $member_info['truename'];
        }


        $show = $Page->show();// 分页显示输出

        $this->assign('page',$show);// 赋值分页输出

        $this->assign('list',$list);// 赋值数据集

        $this->display(); // 输出模板

    }


    public function qianbaodetail(){

        $Data = M('jinbidetail'); // 实例化Data数据对象

        import("@.ORG.Util.Page");// 导入分页类

        $map = array();

        if (isset($_GET['account']) && $_GET['account']!='') {

            $map['member'] = array("eq",trim($_GET['account']));

        }

        if ($_GET['start_time'] != '' && $_GET['end_time'] == '') {
            $map['addtime'] = array("egt",strtotime($_GET['start_time']));
        }elseif ($_GET['start_time'] == '' && $_GET['end_time'] != '') {
            $map['addtime'] = array("elt",strtotime($_GET['end_time']) + 86400);
        }elseif ($_GET['start_time'] != '' && $_GET['end_time'] != '') {
        	$map['addtime'] = array("between",array(strtotime($_GET['start_time']),strtotime($_GET['end_time']) + 86400));
        }

        // $map['member'] = array('not in',C('mySelf'));

        $count      = $Data->where($map)->count();// 查询满足要求的总记录数

        $Page       = new Page($count,30);// 实例化分页类 传入总记录数

        $list = M('jinbidetail')->where($map)->limit($Page ->firstRow.',30')->order("addtime desc")->select();

        foreach ($list as  &$value) {
            $member_info = M('member')->field('id,truename,mobile')->where(array("username"=>$value['member']))->find();
            $value['user_id'] =  $member_info['id'];
            $value['truename'] = $member_info['truename'];
            $value['mobile'] = $member_info['mobile'];
        }


        $show       = $Page->show();// 分页显示输出

        $this->assign('page',$show);// 赋值分页输出

        $this->assign('list',$list);// 赋值数据集

        $this->display(); // 输出模板

    }

    public function yuanqidetail(){

         $Data = M('yuanqidetail'); // 实例化Data数据对象

        import("@.ORG.Util.Page");// 导入分页类

        $map = array();

        if (isset($_GET['account']) && $_GET['account']!='') {

            $map['member'] = array("eq",trim($_GET['account']));

        }

        if ($_GET['start_time'] != '' && $_GET['end_time'] == '') {
            $map['addtime'] = array("egt",strtotime($_GET['start_time']));
        }elseif ($_GET['start_time'] == '' && $_GET['end_time'] != '') {
            $map['addtime'] = array("elt",strtotime($_GET['end_time']) + 86400);
        }elseif ($_GET['start_time'] != '' && $_GET['end_time'] != '') {
            $map['addtime'] = array("between",array(strtotime($_GET['start_time']),strtotime($_GET['end_time']) + 86400));
        }

        // $map['member'] = array('not in',C('mySelf'));

        $count      = $Data->where($map)->count();// 查询满足要求的总记录数

        $Page       = new Page($count,30);// 实例化分页类 传入总记录数

        $list = M('yuanqidetail')->where($map)->limit($Page ->firstRow.',30')->order("addtime desc")->select();

        foreach ($list as  &$value) {
            $member_info = M('member')->field('id,truename,mobile')->where(array("username"=>$value['member']))->find();
            $value['user_id'] =  $member_info['id'];
            $value['truename'] = $member_info['truename'];
            $value['mobile'] = $member_info['mobile'];
        }


        $show       = $Page->show();// 分页显示输出

        $this->assign('page',$show);// 赋值分页输出

        $this->assign('list',$list);// 赋值数据集

        $this->display(); // 输出模板

    }

    //导出元气值流水
	public function excelYq() {
		$member = $_GET['account'];
		$start_time = !empty($_GET['start_time'])?strtotime($_GET['start_time']):0;
		$end_time = !empty($_GET['end_time'])?strtotime("+1 day",strtotime($_GET['end_time'])):time();
		$where['a.addtime'] = array(
			array('egt',$start_time),
			array('lt',$end_time)
		);
		if($member != '' && $member != NULL) {
			$where['a.member'] = array('eq',$member);
		}
	
		$list = M('yuanqidetail as a')->where($where)->join('ds_member as b on a.member = b.username')->order('a.id desc')->field('a.*,b.id as userid,b.truename')->select();
		// dump($list);die;

		// foreach($list as &$val) {
			
		// }
		
   
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);

        //根据excel坐标，添加数据
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '流水ID')
            ->setCellValue('B1', '用户ID')
            ->setCellValue('C1', '账号')
            ->setCellValue('D1', '姓名')
            ->setCellValue('E1', '增加')
            ->setCellValue('F1', '减少')
            ->setCellValue('G1', '结余')
            ->setCellValue('H1', '时间')
            ->setCellValue('I1', '说明')
            ->setCellValue('J1', '来源')
			;

        foreach($list as $key=>$value){
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


            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($A,$value['id'])
                ->setCellValue($B,$value['userid'])
                ->setCellValue($C,$value['member'])
                ->setCellValue($D,$value['truename'])
                ->setCellValue($E,$value['adds'])
                ->setCellValue($F,$value['reduce'])
                ->setCellValue($G,$value['balance'])
                ->setCellValue($H,date('Y-m-d H:i:s',$value['addtime']))
                ->setCellValue($I,$value['desc'])
                ->setCellValue($J,$value['source'])
                ;
        }

        $showtime = date('Ymdhis');
        $file_name = '元气值流水'.$showtime.'.xlsx';

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
        $desc = '导出元气值流水';
		write_log(session('adminusername'),'admin',$desc);
    }
    
    //导出FIL币流水
	public function excelIpfs() {
		$member = $_GET['account'];
		$start_time = !empty($_GET['start_time'])?strtotime($_GET['start_time']):0;
		$end_time = !empty($_GET['end_time'])?strtotime("+1 day",strtotime($_GET['end_time'])):time();
		$where['a.addtime'] = array(
			array('egt',$start_time),
			array('lt',$end_time)
		);
		if($member != '' && $member != NULL) {
			$where['a.member'] = array('eq',$member);
		}
	
		$list = M('jinbidetail as a')->where($where)->join('ds_member as b on a.member = b.username')->order('a.id desc')->field('a.*,b.id as userid,b.truename')->select();
// 		dump($list);die;

		// foreach($list as &$val) {
			
		// }
		
   
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);

        //根据excel坐标，添加数据
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '流水ID')
            ->setCellValue('B1', '用户ID')
            ->setCellValue('C1', '账号')
            ->setCellValue('D1', '姓名')
            ->setCellValue('E1', '增加')
            ->setCellValue('F1', '减少')
            ->setCellValue('G1', '结余')
            ->setCellValue('H1', '时间')
            ->setCellValue('I1', '说明')
            ->setCellValue('J1', '来源')
			;

        foreach($list as $key=>$value){
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


            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($A,$value['id'])
                ->setCellValue($B,$value['userid'])
                ->setCellValue($C,$value['member'])
                ->setCellValue($D,$value['truename'])
                ->setCellValue($E,$value['adds'])
                ->setCellValue($F,$value['reduce'])
                ->setCellValue($G,$value['balance'])
                ->setCellValue($H,date('Y-m-d H:i:s',$value['addtime']))
                ->setCellValue($I,$value['desc'])
                ->setCellValue($J,$value['source'])
                ;
        }

        $showtime = date('Ymdhis');
        $file_name = 'FIL币流水'.$showtime.'.xlsx';

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
        $desc = '导出fil币流水';
		write_log(session('adminusername'),'admin',$desc);
    }
    //导出FIL币流水
	public function excelFil() {
		$member = $_GET['account'];
		$start_time = !empty($_GET['start_time'])?strtotime($_GET['start_time']):0;
		$end_time = !empty($_GET['end_time'])?strtotime("+1 day",strtotime($_GET['end_time'])):time();
		$where['a.addtime'] = array(
			array('egt',$start_time),
			array('lt',$end_time)
		);
		if($member != '' && $member != NULL) {
			$where['a.member'] = array('eq',$member);
		}
		
		$list = M('fildetail as a')->where($where)->join('ds_member as b on a.member = b.username')->order('a.id desc')->field('a.*,b.id as userid,b.truename')->select();
		// dump($list);die;

		// foreach($list as &$val) {
			
		// }
		
   
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);

        //根据excel坐标，添加数据
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '流水ID')
            ->setCellValue('B1', '用户ID')
            ->setCellValue('C1', '账号')
            ->setCellValue('D1', '姓名')
            ->setCellValue('E1', '增加')
            ->setCellValue('F1', '减少')
            ->setCellValue('G1', '结余')
            ->setCellValue('H1', '时间')
            ->setCellValue('I1', '说明')
            ->setCellValue('J1', '来源')
			;

        foreach($list as $key=>$value){
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


            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($A,$value['id'])
                ->setCellValue($B,$value['userid'])
                ->setCellValue($C,$value['member'])
                ->setCellValue($D,$value['truename'])
                ->setCellValue($E,$value['adds'])
                ->setCellValue($F,$value['reduce'])
                ->setCellValue($G,$value['balance'])
                ->setCellValue($H,date('Y-m-d H:i:s',$value['addtime']))
                ->setCellValue($I,$value['desc'])
                ->setCellValue($J,$value['source'])
                ;
        }

        $showtime = date('Ymdhis');
        $file_name = '可提FIL币流水'.$showtime.'.xlsx';

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
        $desc = '导出可提fil币流水';
		write_log(session('adminusername'),'admin',$desc);
    }

    public function dongjiedetail(){

        $Data = M('qjinbidetail'); // 实例化Data数据对象

        import("@.ORG.Util.Page");// 导入分页类

        $map = array();

        if (isset($_POST['account']) && $_POST['account']!='') {

            $map['member'] = array("eq",$_POST['account']);

        }

        if (isset($_POST['start_time']) && $_POST['start_time']!='') {

            $map['addtime'] = array("egt",strtotime($_POST['start_time']));

        }

        if (isset($_POST['end_time']) && $_POST['end_time']!='') {

            $map['addtime'] = array("elt",strtotime($_POST['end_time']));

        }

        // $map['member'] = array('not in',C('mySelf'));

        $count      = $Data->where($map)->where('member is NULL or (member is not NULL AND member <> "18916953132" AND member <> "18918174254")')->count();// 查询满足要求的总记录数

        $Page       = new Page($count,10);// 实例化分页类 传入总记录数





        $list = $Data->where($map)->where('member is NULL or (member is not NULL AND member <> "18916953132" AND member <> "18918174254")')->order('id desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();

        $show       = $Page->show();// 分页显示输出

        $this->assign('page',$show);// 赋值分页输出

        $this->assign('list',$list);// 赋值数据集

        $this->display(); // 输出模板

    }



    public function ksyedetail(){

        $Data = M('keshoudetail'); // 实例化Data数据对象

        import("@.ORG.Util.Page");// 导入分页类

        $map = array();

        if (isset($_POST['account']) && $_POST['account']!='') {

            $map['member'] = array("eq",$_POST['account']);

        }

        if (isset($_POST['start_time']) && $_POST['start_time']!='') {

            $map['addtime'] = array("egt",strtotime($_POST['start_time']));

        }

        if (isset($_POST['end_time']) && $_POST['end_time']!='') {

            $map['addtime'] = array("elt",strtotime($_POST['end_time']));

        }

        // $map['member'] = array('not in',C('mySelf'));



        $count      = $Data->where($map)->where('member is NULL or (member is not NULL AND member <> "18916953132" AND member <> "18918174254")')->count();// 查询满足要求的总记录数

        $Page       = new Page($count,10);// 实例化分页类 传入总记录数





        $list = $Data->where($map)->where('member is NULL or (member is not NULL AND member <> "18916953132" AND member <> "18918174254")')->order('id desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();

        $show       = $Page->show();// 分页显示输出

        $this->assign('page',$show);// 赋值分页输出

        $this->assign('list',$list);// 赋值数据集

        $this->display(); // 输出模板

    }

    public function zichandetail(){

        $Data = M('zichandetail'); // 实例化Data数据对象

        import("@.ORG.Util.Page");// 导入分页类

        $map = array();

        if (isset($_POST['account']) && $_POST['account']!='') {

            $map['member'] = array("eq",$_POST['account']);

        }

        if (isset($_POST['start_time']) && $_POST['start_time']!='') {

            $map['addtime'] = array("egt",strtotime($_POST['start_time']));

        }

        if (isset($_POST['end_time']) && $_POST['end_time']!='') {

            $map['addtime'] = array("elt",strtotime($_POST['end_time']));

        }



        // $map['member'] = array('not in',C('mySelf'));

        $count      = $Data->where($map)->where('member is NULL or (member is not NULL AND member <> "18916953132" AND member <> "18918174254")')->count();// 查询满足要求的总记录数

        $Page       = new Page($count,10);// 实例化分页类 传入总记录数





        $list = $Data->where($map)->where('member is NULL or (member is not NULL AND member <> "18916953132" AND member <> "18918174254")')->order('id desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();

        $show       = $Page->show();// 分页显示输出

        $this->assign('page',$show);// 赋值分页输出

        $this->assign('list',$list);// 赋值数据集

        $this->display(); // 输出模板

    }
    
    //收款地址管理
	public function address_manage(){
		$id = session("id");
		$address = M("address")->where(array("id"=>$id))->find();
		$address["isshow"] = json_decode($address['isshow'],true);
		$this->assign("address",$address);
		$this->display();
	}
	
	// public function getnewprice(){
	// 	$get = I("get.market");
	// 	$g = file_get_contents("https://www.gatecn.io/api2/1/ticker/usdt_cny");
	// 	$usdt_cny = json_decode($g,true)['last'];
		
	// 	if ($get == "btc"){
	// 		$btc_usdt = file_get_contents("https://www.gatecn.io/api2/1/ticker/btc_usdt");
	// 		$btc_usdt = json_decode($btc_usdt,true)['last'];
	// 		$price = $btc_usdt * $usdt_cny / C("rate");
	// 	}elseif ($get == "ltc"){
	// 		$ltc_usdt = file_get_contents("https://www.gatecn.io/api2/1/ticker/ltc_usdt");
	// 		$ltc_usdt = json_decode($ltc_usdt,true)['last'];
	// 		$price = $ltc_usdt * $usdt_cny / C("rate");
	// 	}
	// 	echo round($price,2);
	// }
	
	//充值记录管理
	public function charge_manage(){
		$get = I("get.");
		$map = array();
		
		if ($get['start_time'] != "" && $get['end_time'] == ""){
			$map['addtime'] = array("egt",strtotime($get['start_time']));
		}else if ($get['start_time'] == "" && $get['end_time'] != ""){
			$map['addtime'] = array("elt",strtotime($get['endtime']) + 86400);
		}else if ($get['start_time'] != "" && $get['end_time'] != ""){
			$map['addtime'] = array("between",array(strtotime($get['start_time']),strtotime($get['end_time']) + 86400));
		}

		import("@.ORG.Util.Page");// 导入分页类
        $count      = M("kly_up_log")->where($map)->where(['type'=>1])->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);// 实例化分页类 传入总记录数
        $show = $Page->show();
        $list = M("kly_up_log")->where($map)->where(['type'=>1])->order("addtime desc")->limit($Page ->firstRow.','.$Page -> listRows)->select();
        foreach ($list as &$v){
			$v['username'] = M('member')->where(array('id'=>$v['user_id']))->getField('username');
		}
// 		dump(	$v['username']);
        $this->assign("page",$show);
        $this->assign("list",$list);
		$this->display();
	}
	
	public function withdrawal_manage(){
		$get = I("get.");
		$map = array();
		$map['status'] = array("neq",3);
		$map['bi'] = "yuanqi";
		if ($get['typename'] != ""){
			switch($get['type']){
				case 1: $map['user_id'] = $get['typename'];break;
				case 2: $map['username'] = $get['typename'];break;
			}
		}
		if ($get['tix'] != ""){
			$map['type'] = $get['tix'];
		}
		
		if ($get['start_time'] != "" && $get['end_time'] == ""){
			$map['addtime'] = array("egt",strtotime($get['start_time']));
		}else if ($get['start_time'] == "" && $get['end_time'] != ""){
			$map['addtime'] = array("elt",strtotime($get['endtime']) + 86400);
		}else if ($get['start_time'] != "" && $get['end_time'] != ""){
			$map['addtime'] = array("between",array(strtotime($get['start_time']),strtotime($get['end_time']) + 86400));
		}
		
		import("@.ORG.Util.Page");// 导入分页类
        $count      = M("kly_withdrawal")->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);// 实例化分页类 传入总记录数
        $show = $Page->show();
        $list = M("kly_withdrawal")->where($map)->order("addtime desc")->limit($Page ->firstRow.','.$Page -> listRows)->select();
        // dump($list);
        $this->assign("page",$show);
        $this->assign("list",$list);
		$this->display();
	}
	
	public function withdrawal_manage2(){
		$get = I("get.");
		$map = array();
		$map['status'] = array("neq",3);
		$map['bi'] = "ipfs";
		if ($get['typename'] != ""){
			switch($get['type']){
				case 1: $map['user_id'] = $get['typename'];break;
				case 2: $map['username'] = $get['typename'];break;
			}
		}
		if ($get['tix'] != ""){
			$map['type'] = $get['tix'];
		}
		
		if ($get['start_time'] != "" && $get['end_time'] == ""){
			$map['addtime'] = array("egt",strtotime($get['start_time']));
		}else if ($get['start_time'] == "" && $get['end_time'] != ""){
			$map['addtime'] = array("elt",strtotime($get['endtime']) + 86400);
		}else if ($get['start_time'] != "" && $get['end_time'] != ""){
			$map['addtime'] = array("between",array(strtotime($get['start_time']),strtotime($get['end_time']) + 86400));
		}
		
		import("@.ORG.Util.Page");// 导入分页类
        $count      = M("withdrawal")->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,15);// 实例化分页类 传入总记录数
        $show = $Page->show();
        $list = M("withdrawal")->where($map)->order("addtime desc")->limit($Page ->firstRow.','.$Page -> listRows)->select();

        $this->assign("page",$show);
        $this->assign("list",$list);
		$this->display();
	}
	
	public function withdrawal_manage3(){
		$get = I("get.");
		$map = array();
		$map['status'] = array("neq",3);
		$map['bi'] = "usdt";
		if ($get['typename'] != ""){
			switch($get['type']){
				case 1: $map['user_id'] = $get['typename'];break;
				case 2: $map['username'] = $get['typename'];break;
			}
		}
		
		if ($get['start_time'] != "" && $get['end_time'] == ""){
			$map['addtime'] = array("egt",strtotime($get['start_time']));
		}else if ($get['start_time'] == "" && $get['end_time'] != ""){
			$map['addtime'] = array("elt",strtotime($get['endtime']) + 86400);
		}else if ($get['start_time'] != "" && $get['end_time'] != ""){
			$map['addtime'] = array("between",array(strtotime($get['start_time']),strtotime($get['end_time']) + 86400));
		}
		
		import("@.ORG.Util.Page");// 导入分页类
        $count      = M("withdrawal")->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,15);// 实例化分页类 传入总记录数
        $show = $Page->show();
        $list = M("withdrawal")->where($map)->order("addtime desc")->limit($Page ->firstRow.','.$Page -> listRows)->select();

        $this->assign("page",$show);
        $this->assign("list",$list);
		$this->display();
	}

    //导出全部/excel
    public function excel() {

        $Data = M('jinbidetail'); // 实例化Data数据对象
        
        import("@.ORG.Util.Page");// 导入分页类
        
        $get = I("get.");
        $map = array();
        $map['status'] = array("neq",3);
        if($get['cion'] == 2) {
            $map['bi'] = array("eq",'ipfs');
        } else {
            $map['bi'] = array("eq",'yuanqi');
        }
        if ($get['typename'] != ""){
            switch($get['type']){
                case 1: $map['user_id'] = $get['typename'];break;
                case 2: $map['username'] = $get['typename'];break;
            }
        }
        if ($get['tix'] != ""){
            $map['type'] = $get['tix'];
        }
        
        if ($get['start_time'] != "" && $get['end_time'] == ""){
            $map['addtime'] = array("egt",strtotime($get['start_time']));
        }else if ($get['start_time'] == "" && $get['end_time'] != ""){
            $map['addtime'] = array("elt",strtotime($get['endtime']) + 86400);
        }else if ($get['start_time'] != "" && $get['end_time'] != ""){
            $map['addtime'] = array("between",array(strtotime($get['start_time']),strtotime($get['end_time']) + 86400));
        }
        
        import("@.ORG.Util.Page");// 导入分页类
        $count      = M("withdrawal")->where($map)->count();// 查询满足要求的总记录数
        
        $list = M("withdrawal")->where($map)->order("addtime desc")->select();
        // foreach ($list as &$v){
        //  $v['username'] = M("member")->where(array("id"=>$v['user_id']))->getField("username");
        // }
        
        // if($_GET['type']==1){
            // if(!empty($get['typename'])){
                $list = $list = M("withdrawal")->where($map)->order("addtime desc")->select();
            // }else{
            //     $list = M("withdrawal")->order("addtime desc")->select();
            // }
        // }else{
        //     $list = M("withdrawal")->order("addtime desc")->select();
        // }


        require_once ROOT_PATH . '/extend/lib/PHPExcel/Classes/PHPExcel.php';
        $objPHPExcel = new \PHPExcel();
        //列宽 自适应
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(15);

        //根据excel坐标，添加数据
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '序号')
            ->setCellValue('B1', '会员编号')
            ->setCellValue('C1', '用户名')
            ->setCellValue('D1', '时间')
            ->setCellValue('E1', '币种')
            ->setCellValue('F1', '提现数量')
            ->setCellValue('G1', '汇率')
            ->setCellValue('H1', '手续费率')
            ->setCellValue('I1', '总额')
            ->setCellValue('J1', '提现方式')
            ->setCellValue('K1', '状态');

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
            
            switch($val["status"] ){
                case 0: $val["status"] = "待审核";break;
                case 1: $val["status"] = "已转账";break;
                case 2: $val["status"] = "已拒绝";break;
                case 4: $val["status"] = "申诉中";break;
                case 5: $val["status"] = "已处理申诉";break;
            }
            switch($val["type"] ){
                case "wechat": $val["type"] = "微信";break;
                case "alipay": $val["type"] = "支付宝";break;
                case "bank": $val["type"] = "银行卡";break;
                case "address": $val["type"] = "钱包地址";break;
            }
            switch($val["bi"] ){
                case "ipfs": $val["bi"] = "FIL";break;
                case "yuanqi": $val["bi"] = "元气值";break;
            }
            $val['rate'] = $val['rate']."%";


            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($A,$val['id'])
                ->setCellValue($B,$val['user_id'])
                ->setCellValue($C,$val['username'])
                ->setCellValue($D,$val['addtime'])
                ->setCellValue($E,$val['bi'])
                ->setCellValue($F,$val['number'])
                ->setCellValue($G,$val['rate'])
                ->setCellValue($H,$val['sxf'])
                ->setCellValue($I,$val['total'])
                ->setCellValue($J,$val['type'])
                ->setCellValue($K,$val['status'])
                ;
        }

        $showtime = date('Ymdhis');
        $file_name = 'FIL提现管理列表'.$showtime.'.xlsx';

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
	
	public function withdrawal($id){
		$get = M("kly_withdrawal")->where(array("id"=>$id))->find();
// 		dump($get);die;
		$this->assign("bank",$get);
		$this->display();
	}
	
	//上传管理员收款截图
	public function upload_address(){
		$type = I("post.type");
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Public/Uploads/skm/';// 设置附件上传目录
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			$path = $info[0]['savepath'].$info[0]['savename'];
			$path = substr($path,1);
		}
		
		// 保存表单数据 包括附件数据
		switch ($type) {
			case 'wechat':
				$typename = "wechat";
				break;
			case 'alipay':
				$typename = "alipay";
				break;
			case 'usdt':
				$typename = "usdt_paycode";
				break;
		}
// 		dump(array($typename=>$path));die;
		$ret = M("address")->where(array("admin_id"=>session("id")))->save(array($typename=>$path));
		if ($ret){
		    $this->ajaxReturn(array("path"=>$path));
		}else{
		    $this->error("上传失败",M()->getLastSql());
		}
		
	}
	
	public function upload_fkm(){
		$id = I("post.id");
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Public/Uploads/skm/';// 设置附件上传目录
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			$path = $info[0]['savepath'].$info[0]['savename'];
			$path = substr($path,1);
		}

		$ret = M("withdrawal")->where(array("id"=>$id))->save(array("image"=>$path));
		$this->ajaxReturn(array("path"=>$path));
	}
	
	public function upload_fkm2(){
		$id = I("post.id");
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Public/Uploads/skm/';// 设置附件上传目录
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			$path = $info[0]['savepath'].$info[0]['savename'];
			$path = substr($path,1);
		}

		$ret = M("exchange")->where(array("id"=>$id))->save(array("image"=>$path));
		$this->ajaxReturn(array("path"=>$path));
	}
	
	//保存收款信息
	public function address_post(){
		$get = I("post.");
		$data = [
			"alipay_name"	=> $get['alipay_name'],
			"bank"			=> $get['bank'],
			"bank_name"		=> $get['bank_name'],
			"bank_num"		=> $get['bank_num'],
			"bank_branch"	=> $get['bank_branch'],
			"bank2"			=> $get['bank2'],
			"bank_name2"	=> $get['bank_name2'],
			"bank_num2"		=> $get['bank_num2'],
			"bank_branch2"	=> $get['bank_branch2'],
			"usdt_address"	=> $get['usdt_address'],
			"isshow"		=> json_encode($get['isshow'])
		];
// 		dump($data);die;
		$ret = M("address")->where(array("id"=>session("id")))->save($data);
		if ($ret || $get['isupload'] == 1){
			$this->success("修改成功！");
		}else{
			$this->error("修改失败，没有修改");
		}
	}
	
	//允许或拒绝用户充值请求
	public function adopt_charge(){
		$get = $_POST;
		$charge = M("charge")->where(array("id"=>$get['id']))->find();
		//判断是否已处理，或是否存在
		if ($charge['status'] != 0 && $charge['status'] != 4){
			$this->error("对不起，该充值记录已处理");
		}
		if (empty($charge)){
			$this->error("对不起，该充值记录不存在");
		}
		
		switch ($get['isa']){
			//拒绝
			case 0:
				$data = [
					"status"	=> 2,
					"confirmtime"	=> time(),
					"confirmadmin"	=> session("adminusername"),
				];
				$ret = M("charge")->where(array("id"=>$get['id']))->save($data);
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
					"confirmcharge"	=> $charge['charge'],
				];
				$ret = M("charge")->where(array("id"=>$get['id']))->save($data);
				$setinc = M("member")->where(array("id"=>$charge['user_id']))->setInc("yuanqi",$charge['charge']);
				//记录充值日志
				
				$log = jinbi($charge['username'],$charge['charge'],"元气值充值",1,9,"yuanqi");
				if($ret && $setinc && $log){
					M()->commit();
					$this->success("操作成功：已通过");
				}else{
					M()->rollback();
					$this->error("操作失败");
				}
				break;
			case 2:
				M()->startTrans();
				$data = [
					"status"	=> 1,
					"confirmtime"	=> time(),
					"confirmadmin"	=> session("adminusername"),
					"confirmcharge"	=> $get['chargenum'],
				];
				$ret = M("charge")->where(array("id"=>$get['id']))->save($data);
				$setinc = M("member")->where(array("id"=>$charge['user_id']))->setInc("yuanqi",$data['confirmcharge']);
				
				$log = jinbi($charge['username'],$data['confirmcharge'],"元气值充值",1,9,"yuanqi");
				if($ret && $setinc && $log){
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
				$ret = M("charge")->where(array("id"=>$get['id']))->save($data);
				if($ret){
					$this->success("操作成功：已处理");
				}else{
					$this->error("操作失败");
				}
				break;
		}
	}
	
	public function adopt_withdrawal(){
		$get = $_POST;
		$withdrawal = M("withdrawal")->where(array("id"=>$get['id']))->find();
		if ($withdrawal['status'] != 0 && $withdrawal['status'] != 4){
			$this->error("对不起，该提现记录已处理");
		}
		if (empty($withdrawal)){
			$this->error("对不起，该提现记录不存在");
		}
		switch ($get['isa']) {
			//拒绝
			case 0:
				$balance = M("member")->where(array("username"=>$withdrawal['username']))->getField($withdrawal['bi']);
				$data = [
					"status"		=> 2,
					"endtime"		=> time(),
					"confirmadmin"	=> session("adminusername"),
					"remark"		=> $get['remark']
				];
				if ($withdrawal['bitype'] == "ipfs"){
		    		$bitype = "FIL";
		    	}elseif ($withdrawal['bitype'] == "yuanqi"){
		    		$bitype = "元气值";
		    	}
				M()->startTrans();
				$ret = M("withdrawal")->where(array("id"=>$get['id']))->save($data);
			
				if ($withdrawal['bi'] == "ipfs"){
				    $ret2 = M("member")->where(array("id"=>$withdrawal['user_id']))->setInc('fil',floatval($withdrawal['number']));
					$log = jinbi($withdrawal["username"],$withdrawal['number'],$bitype."FIL提币驳回",1,12,'fil');
				}else if ($withdrawal['bi'] == "yuanqi"){
				    $ret2 = M("member")->where(array("id"=>$withdrawal['user_id']))->setInc($withdrawal['bi'],floatval($withdrawal['number']));
					$log = jinbi($withdrawal["username"],$withdrawal['number'],$bitype."提现驳回",1,12,$withdrawal['bi']);
				}
				
				if($ret && $ret2 && $log){
				    //添加日志操作
            		write_log(session('adminusername'),'member','拒绝提币');
					M()->commit();
					$this->success("操作成功：已拒绝");
				}else{
					M()->rollback();
					$this->error("操作失败");
				}
				break;
			
			//允许
			case 1:
				//记录充值状态
				$data = [
					"status"		=> 1,
					"endtime"		=> time(),
					"confirmadmin"	=> session("adminusername"),
					"withdrawal"	=> $withdrawal['number'],
					"remark"		=> $get['remark']
				];
				$ret = M("withdrawal")->where(array("id"=>$get['id']))->save($data);
				//记录充值日志
				
				if($ret){
				    //添加日志操作
            		write_log(session('adminusername'),'member','同意提币');
					$this->success("操作成功：已转账");
				}else{
					$this->error("操作失败");
				}
				break;
			
			case 5:
				//记录提现状态
				$data = [
					"status"		=> 5,
					"endtime"		=> time(),
					"confirmadmin"	=> session("adminusername"),
				];
				$ret = M("withdrawal")->where(array("id"=>$get['id']))->save($data);
				//记录充值日志
				
				if($ret){
					$this->success("操作成功：已处理");
				}else{
					$this->error("操作失败");
				}
				break;
				
		}
	}
	
	public function adopt_exchange(){
		$get = $_POST;
		$exchange = M("exchange")->where(array("id"=>$get['id']))->find();
		if ($exchange['status'] != 0 && $exchange['status'] != 4){
			$this->error("对不起，该提现记录已处理");
		}
		if (empty($exchange)){
			$this->error("对不起，该提现记录不存在");
		}
		switch ($get['isa']) {
			//拒绝
			case 0:
				$balance = M("member")->where(array("username"=>$exchange['username']))->getField("ipfs");
				$data = [
					"status"		=> 2,
					"endtime"		=> time(),
					"confirmadmin"	=> session("adminusername"),
					"remark"		=> $get['remark']
				];
				$data2 = [
					'type'		=> 13,
					'member'	=> $exchange['username'],
					'adds'		=> $exchange['number'],
					'reduce'	=> 0,
					'balance'	=> $balance + $exchange['number'],
					'addtime'	=> time(),
					'desc'		=> "ipfs转换驳回"
				];
				M()->startTrans();
				$ret = M("exchange")->where(array("id"=>$get['id']))->save($data);	//记录
				$ret2 = M("member")->where(array("id"=>$exchange['user_id']))->setInc("ipfs",floatval($exchange['number']));	//把货币退回到用户钱包里
				
				$log = M("jinbidetail")->add($data2);	//记录流水
				if($ret && $ret2 && $log){
					M()->commit();
					$this->success("操作成功：已拒绝");
				}else{
					M()->rollback();
					$this->error("操作失败");
				}
				break;
			
			//允许
			case 1:
				//记录货币转换状态
				$data = [
					"status"		=> 1,
					"endtime"		=> time(),
					"confirmadmin"	=> session("adminusername"),
					"confirmcharge"	=> $exchange['ipfs'],
					"remark"		=> $get['remark']
				];
				$ret = M("exchange")->where(array("id"=>$get['id']))->save($data);
				//记录充值日志
				
				if($ret){
					$this->success("操作成功：已转账");
				}else{
					$this->error("操作失败");
				}
				break;
		}
	}
	
	public function exchange_manage(){
		$get = I("get.");
		$map = array();
		$map['status'] = array("neq",3);
		if ($get['typename'] != ""){
			switch($get['type']){
				case 1: $map['id'] = $get['typename'];break;
				case 2: $map['truename'] = $get['typename'];break;
				case 3: $map['mobile'] = $get['typename'];break;
				case 4: $map['username'] = $get['typename'];break;
			}
		}
		
		if ($get['start_time'] != "" && $get['end_time'] == ""){
			$map['addtime'] = array("egt",strtotime($get['start_time']));
		}else if ($get['start_time'] == "" && $get['end_time'] != ""){
			$map['addtime'] = array("elt",strtotime($get['endtime']) + 86400);
		}else if ($get['start_time'] != "" && $get['end_time'] != ""){
			$map['addtime'] = array("between",array(strtotime($get['start_time']),strtotime($get['end_time']) + 86400));
		}
		
		import("@.ORG.Util.Page");// 导入分页类
        $count      = M("withdrawal")->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,15);// 实例化分页类 传入总记录数
        $show = $Page->show();;
        $list = M("exchange")->where($map)->order("addtime desc")->limit($Page ->firstRow.','.$Page -> listRows)->select();
        foreach ($list as &$v){
        	$v['username'] = M("member")->where(array("id"=>$v['user_id']))->getField("username");
        	if ($v['type'] != "usdt"){
        		$v['unit'] = "rmb";
        	}else{
        		$v['unit'] = "usdt";
        	}
        }
        $this->assign("page",$show);
        $this->assign("list",$list);
		$this->display();
	}
	
	public function exchange($id){
		$get = M("exchange")->where(array("id"=>$id))->find();
		$this->assign("info",$get);
		$this->display();
	}
	
	public function charge_set(){
		if (IS_POST){
			$get = $_POST;
			$get['selection'] = json_encode($get['selection']);
			$ret = M("charge_config")->where(array("id"=>1))->save($get);
			if ($ret){
				$this->success("修改成功！");
			}else{
				$this->error("修改失败！");
			}
		}else{
			$get = M("charge_config")->find();
			$get['selection'] = json_decode($get['selection'],true);
			$this->assign("get",$get);
			$this->display();
		}
		
	}

}

