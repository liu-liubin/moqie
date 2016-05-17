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
class AdminAboutusController extends AdminbaseController {
	protected $aboutus_model;
	/**
	 * [初始化]
	 * @Author   YHX
	 * @DateTime 2016-04-28T14:39:52+0800
	 * 
	 */
	function _initialize() {
		parent::_initialize();
		$this->aboutus_model =D("Aboutus");
	}
	/**
	 * [关于我们首页]
	 * @Author   YHX
	 * @DateTime 2016-04-28T14:53:02+0800
	 */
	function index(){
		$aboutus = $this->aboutus_model->where('id=1')->find();

    	if($aboutus!==null)
    	{
    		$this->assign('aboutus', $aboutus);
    	}
    	else{

    	}
    	
    	$this->display("index");
	}

	/**
	 * 保存按钮的处理
	 * @Author   YHX
	 * @DateTime 2016-04-28T14:59:17+0800
	 */
	function post_aboutus(){
		if(IS_POST){
			$aboutus = $this->aboutus_model->where('id=1')->find();
			//修改
			if($aboutus){
				if ($this->aboutus_model->create()) {
					if ($this->aboutus_model->where('id=1')->save()!==false) {
						$this->success("保存成功！", U("AdminAboutus/index"));
					} else {
						$this->error("保存失败！");
					}
				} else {
					$this->error($this->aboutus_model->getError());
				}
			//添加
			}else{
				if ($this->aboutus_model->create()) {

					if ($this->aboutus_model->add()!==false) {
						$this->success("添加成功！", U("AdminAboutus/aboutus"));
					} else {
						$this->error("添加失败！");
					}
				} else {
					$this->error($this->aboutus_model->getError());
				}
			}
		}
	}


}