<?php
// +----------------------------------------------------------------------
// | TIGO [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.tigonetwork.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace Portal\Controller;
use Common\Controller\HomebaseController; 
/**
 * 前端控制器
 */
class IndexController extends HomebaseController {

	
    /**
     * 首页
     * @Author   YHX
     * @DateTime 2016-05-03T17:06:50+0800
     * @return   [type]                   [description]
     */
	public function index() {

		//轮播
		$slide_obj= M("Slide");
		$order = "listorder ASC";
		$limit = 5;
		$sides=$slide_obj->where("slide_status=1 and slide_cid=1")->order($order)->limit('0,'.$limit)->select();

		//最新供需
		$dslist_obj = M('Dslist');
		$order1 = "post_modified Desc";
		$limit1 = 5;
		$dslist=$dslist_obj->where("post_status=1")->order($order1)->limit('0,'.$limit1)->select();

		$this->assign('sides',$sides);
		$this->assign('dslist',$dslist);
    	$this->display(":index");
    }


}


