<?php
// +----------------------------------------------------------------------
// | TIGO 
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2016 http://www.tigonetwork.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yhx <346682825@qq.com>
// +----------------------------------------------------------------------
namespace Portal\Controller;
use Common\Controller\AdminbaseController;
class AdminDslistController extends AdminbaseController {
	protected $dslist_model;

	/**
	 * [初始化]
	 * @Author   YHX
	 * @DateTime 2016-04-29T10:06:58+0800
	 */
	function _initialize() {
		parent::_initialize();
		$this->dslist_model =D("Dslist");
		$this->terms_model = D("Portal/Terms");
		$this->term_relationships_model = D("Portal/TermRelationships");
	}
	/**
	 * 供需列表首页
	 * @Author   YHX
	 * @DateTime 2016-04-29T10:08:12+0800
	 * @return   [type]                   [description]
	 */
	function index(){
		
    	// $count= $this->dslist_model->count();
    	// $page = $this->page($count, 20);
    	// $lists = $this->dslist_model
    	// ->order("post_date DESC")
    	// ->limit($page->firstRow . ',' . $page->listRows)
    	// ->select();

		$count=$this->term_relationships_model
		->alias("a")
		->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
		->count();

		$lists=$this->term_relationships_model
		->alias("a")
		->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
		->limit($page->firstRow . ',' . $page->listRows)
		->order("a.listorder ASC,b.post_modified DESC")->select();
			
		$page = $this->page($count, 20);

    	$users_obj = M("Users");
		$users_data=$users_obj->field("id,user_login")->where("user_status=1")->select();
		$users=array();
		foreach ($users_data as $u){
			$users[$u['id']]=$u;
		}
		$this->assign("users",$users);
    	$terms = $this->terms_model->getField("term_id,name",true);
    	$this->assign('lists', $lists);
    	$this->assign("page", $page->show('Admin'));
    	$this->assign("terms",$terms);
    	
    	
    	$this->display();
	}

	/**
	 * 供需信息详情
	 * @Author   YHX
	 * @DateTime 2016-04-29T10:19:50+0800
	 * @return   [type]                   [description]
	 */
	function detail(){

		$id=intval($_GET['id']);



        if ($id) {
            $rst = $this->dslist_model->where(array("id"=>$id))->find();
            if ($rst) {
            	$term_relationship = M('TermRelationships')->where(array("object_id"=>$id,"status"=>1))->getField("term_id",true);
				$term=$this->terms_model->where(array("id"=>$term_relationship['term_id']))->find();
				$users_obj = M("Users");
				$users_data=$users_obj->field("id,user_login")->where("user_status=1")->select();
				$users=array();
				foreach ($users_data as $u){
					$users[$u['id']]=$u;
				}
				// $this->assign("terms",$terms);
				$this->assign("term",$term);
				$this->assign("users",$users);
                $this->assign('dslist', $rst);
                //var_dump($term_relationship);die();
                $this->display("detail");
            } else {
                $this->error('数据错误！', U("AdminDslist/index"));
            }
        } else {
            $this->error('数据传入失败！', U("AdminDslist/index"));
        }
	}

	/**
	 * 审核供需信息
	 * @Author   YHX
	 * @DateTime 2016-04-29T10:22:55+0800
	 * @return   [type]                   [description]
	 */
	function adjust(){
    	$id=intval($_GET['id']);
    	if ($id) {
    		$rst = $this->dslist_model->where(array("id"=>$id))->setField('post_status','1');
    		if ($rst) {
    			$this->success("审核成功！", U("AdminDslist/index"));
    		} else {
    			$this->error('审核失败！', U("AdminDslist/index"));
    		}
    	} else {
    		$this->error('数据传入失败！', U("AdminDslist/index"));
    	}
    }

    /**
	 * 取消审核供需信息
	 * @Author   YHX
	 * @DateTime 2016-04-29T10:22:55+0800
	 * @return   [type]                   [description]
	 */
	function cancel(){
    	$id=intval($_GET['id']);
    	if ($id) {
    		$rst = $this->dslist_model->where(array("id"=>$id))->setField('post_status','0');
    		if ($rst) {
    			$this->success("取消审核成功！", U("AdminDslist/index"));
    		} else {
    			$this->error('取消审核失败！', U("AdminDslist/index"));
    		}
    	} else {
    		$this->error('数据传入失败！', U("AdminDslist/index"));
    	}
    }

     /**
	 * 删除审核供需信息
	 * @Author   YHX
	 * @DateTime 2016-04-29T10:22:55+0800
	 * @return   [type]                   [description]
	 */
	function delete(){
    	$id=intval($_GET['id']);
    	$tid=intval($_GET['tid']);
    	if ($tid) {
    		$rst = $this->term_relationships_model->where(array("tid"=>$tid))->delete();
    		if ($rst!==false) {
    			$rst1 = $this->dslist_model->where(array("id"=>$id))->delete();
    			if ($rst1!==false) {
    				$this->success("删除成功！", U("AdminDslist/index"));
    			}
    		} else {
    			$this->error('删除失败！', U("AdminDslist/index"));
    		}
    	} else {
    		$this->error('数据传入失败！', U("AdminDslist/index"));
    	}
    }



}