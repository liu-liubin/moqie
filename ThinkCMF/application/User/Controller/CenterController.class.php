<?php

/**
 * 会员中心
 */
namespace User\Controller;
use Common\Controller\MemberbaseController;
class CenterController extends MemberbaseController {
	
	protected $users_model;
	function _initialize(){
		parent::_initialize();
		$this->users_model=D("Common/Users");
	}

    //会员中心  YHX
	public function index() {
		$userid=sp_get_current_userid();
		$user=$this->users_model->where(array("id"=>$userid))->find();

		$order = "post_modified Desc";
        $limit = 2;


		//供应历史
        $map['post_author'] = $userid;
        $map['path'] = array('like','0-2-6%');
        $term_relationships_model = M('TermRelationships');
        $dslist=$term_relationships_model
        ->alias("a")
        ->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
        ->limit('0,'.$limit)
        ->where($map)
        ->order("a.listorder ASC,b.post_modified DESC")->select();

		//需求历史
        $map['post_author'] = $userid;
        $map['path'] = array('like','0-2-7%');
        $term_relationships_model = M('TermRelationships');
        $dslist1=$term_relationships_model
        ->alias("a")
        ->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
        ->limit('0,'.$limit)
        ->where($map)
        ->order("a.listorder ASC,b.post_modified DESC")->select();


        $this->assign('supply',$dslist);
        $this->assign('demand',$dslist1);
		$this->assign('user',$user);
    	$this->display(':center');
    }
}
