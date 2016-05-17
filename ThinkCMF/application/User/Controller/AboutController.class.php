<?php
// +----------------------------------------------------------------------
// | TIGO [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.tigonetwork.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace User\Controller;
use Common\Controller\HomebaseController; 
/**
 * 前端控制器
 */
class AboutController extends HomebaseController {

	
    /**
     * 首页
     * @Author   YHX
     * @DateTime 2016-05-03T17:06:50+0800
     * @return   [type]                   [description]
     */
	public function index() {

		//轮播
		$about_obj= M("Aboutus");
		
		$about=$about_obj->where("id=1")->find();

		$this->assign('about',$about);
    	$this->display(":index");
    }


}


