<?php
Class AddAction extends CommonAction{
        //添加商品
        public function addgoods(){
            $data = I('post.');
            $data['addtime'] = time();
            $add = M('kly_goods')->add($data);
            
            if($add){
                 $this->success('添加成功',U(GROUP_NAME .'/Shop/lists'));
    
    			}else{
    
    				$this -> error('添加失败');
    			}
        }
        //删除商品
        public function delgoods(){
            $id = I('id');
            // dump($id);die;
            $delgoods = M('kly_goods')->where(['id'=>$id])->delete();
            // dump($delgoods);die;
    
            if($delgoods){
                
    			    write_log(session('username'),'admin','删除商品');
    
    				$this->success('删除商品成功',U(GROUP_NAME .'/Shop/lists'));
    				}else{
    				$this->error('删除商品失败');
    				}
        }
        //修改商品
        public function editgoods(){
        $id = I('id');
    	$data = I('post.');
    	$data['createtime'] = time(); 
    	$savegoods = M('kly_goods')->where(['id'=>$id])->save($data);
        if($savegoods){
            
        write_log(session('username'),'admin','修改商品信息');
    
    	$this->success('修改商品成功',U(GROUP_NAME .'/Shop/lists'));
    	}else{
    	$this->error('修改商品失败');
    	}
    }
        //审核提现
        public function update_withdrawal(){
    	$post = I('post.');
    // 		dump($post);die;
    	switch ($post['isa']) {
    	    case '1':
    	        $data = [
    	            'status' => 1,
    	            'createtime' => time(),
    	            'remark' => $post['remark'],
    	            ];
                $save = M('kly_withdrawal')->where(['id'=>$post['id']])->save($data);
    			if($save){
                    $this->ajaxReturn(array("msg"=>"操作成功：已确认打款","success"=>1));
    			}else{
                    $this->ajaxReturn(array("msg"=>"操作失败","success"=>-1));
    			}
    	        break;
    	    case '0':
    	        $data = [
    	            'status' => 2,
    	            'createtime' => time(),
    	            'remark' => $post['remark'],
    	            ];
                $save = M('kly_withdrawal')->where(['id'=>$post['id']])->save($data);
    			if($save){
                    $this->ajaxReturn(array("msg"=>"操作成功：已确认驳回","success"=>1));
    			}else{
                    $this->ajaxReturn(array("msg"=>"操作失败","success"=>-1));
    			}
    	        break;
    
    	}
        }
        
}