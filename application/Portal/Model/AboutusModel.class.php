<?php
namespace Common\Model;
use Common\Model\CommonModel;
/**
 * @Author   YHX
 * @DateTime 2016-04-28T09:57:30+0800
 * 关于我们model
 */
class AboutusModel extends CommonModel {
	/*
	 * 表结构
	 * id:自增id
	 * companyname:公司名
	 * company_url:企业网站
	 * logo:公司logo，相对于upload/avatar目录
	 * company_description:公司描述
	 * mobile:电话
	 */
	
	
	// 获取当前时间
	function mGetDate() {
		return date ( 'Y-m-d H:i:s' );
	}
	
	protected function _before_write(&$data) {
		parent::_before_write($data);
	}
}