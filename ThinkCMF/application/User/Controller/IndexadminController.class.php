<?php

/**
 * 会员
 */
namespace User\Controller;
use Common\Controller\AdminbaseController;
class IndexadminController extends AdminbaseController {
    function index(){
    	$users_model=M("Users");
    	$count=$users_model->where(array("user_type"=>2))->count();
    	$page = $this->page($count, 20);
    	$lists = $users_model
    	->where(array("user_type"=>2))
    	->order("create_time DESC")
    	->limit($page->firstRow . ',' . $page->listRows)
    	->select();
    	$this->assign('lists', $lists);
    	$this->assign("page", $page->show('Admin'));
    	
    	$this->display(":index");
    }
    
    function ban(){
    	$id=intval($_GET['id']);
    	if ($id) {
    		$rst = M("Users")->where(array("id"=>$id,"user_type"=>2))->setField('user_status','0');
    		if ($rst) {
    			$this->success("会员拉黑成功！", U("indexadmin/index"));
    		} else {
    			$this->error('会员拉黑失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
    
    function cancelban(){
    	$id=intval($_GET['id']);
    	if ($id) {
    		$rst = M("Users")->where(array("id"=>$id,"user_type"=>2))->setField('user_status','1');
    		if ($rst) {
    			$this->success("会员启用成功！", U("indexadmin/index"));
    		} else {
    			$this->error('会员启用失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }

    /**
     * 查看会员详情信息
     * @Author   YHX
     * @DateTime 2016-04-28T17:05:40+0800
     * @return   [type]                   [description]
     */
    function userinfo(){
        $id=intval($_GET['id']);
        if ($id) {
            $rst = M("Users")->where(array("id"=>$id,"user_type"=>2))->find();
            if ($rst) {
               $this->assign('user', $rst);
               $this->display(":userinfo");
            } else {
                $this->error('数据错误！');
            }
        } else {
            $this->error('数据传入失败！');
        }
    }

    /**
     * 审核会员，升级为企业会员，状态4，审核后无法修改
     * @Author   YHX
     * @DateTime 2016-04-28T17:11:31+0800
     * @return   [type]                   [description]
     */
    function adjust(){
        $id=intval($_GET['id']);
        if ($id) {
            $rst = M("Users")->where(array("id"=>$id,"user_type"=>2))->setField('company_status','4');
            if ($rst) {
                $this->success("审核成功！", U("indexadmin/index"));
            } else {
                $this->error('审核失败！');
            }
        } else {
            $this->error('数据传入失败！');
        }
    }

    /**
     * 审核失败，失败后会员可以重新填写资料，状态3
     * @Author   YHX
     * @DateTime 2016-04-28T17:11:31+0800
     * @return   [type]                   [description]
     */
    function adjustfail(){
        $id=intval($_GET['id']);
        if ($id) {
            $rst = M("Users")->where(array("id"=>$id,"user_type"=>2))->setField('company_status','3');
            if ($rst) {
                $this->success("审核成功！", U("indexadmin/index"));
            } else {
                $this->error('审核失败！');
            }
        } else {
            $this->error('数据传入失败！');
        }
    }
}
