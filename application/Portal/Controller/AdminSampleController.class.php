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
class AdminSampleController extends AdminbaseController {
	protected $sample_model;
    protected $term_relationships_model;
    protected $terms_model;

	/**
	 * [初始化]
	 * @Author   YHX
	 * @DateTime 2016-04-29T10:06:58+0800
	 */
	function _initialize() {
		parent::_initialize();
        $this->sample_model =D("Sample");
		$this->dslist_model =D("Dslist");
		$this->terms_model = D("Portal/Terms");
		$this->term_relationships_model = D("Portal/TermRelationships");
	}
	/**
	 * 拿样列表首页
	 * @Author   YHX
	 * @DateTime 2016-04-29T10:08:12+0800
	 * @return   [type]                   [description]
	 */
	function index(){
        $count = $this->sample_model
            ->alias("a")
            ->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
            ->join(C ( 'DB_PREFIX' )."users c ON a.uid = c.id")
            ->count();

        $page = $this->page($count, 10);

        $sample = $this->sample_model
            ->alias("a")
            ->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
            ->join(C ( 'DB_PREFIX' )."users c ON a.uid = c.id")
            ->limit($page->firstRow . ',' . $page->listRows)
            ->select();

        $this->assign("Page", $page->show('Admin'));
        $this->assign("sample",$sample);
    	
//    	dump($sample);die();
    	$this->display();
	}

}