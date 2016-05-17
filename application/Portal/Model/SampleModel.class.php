<?php
namespace Common\Model;
use Common\Model\CommonModel;
/**
 * @Author   YHX
 * @DateTime 2016-04-28T09:57:30+0800
 * 供需表model
 */
class SampleModel extends CommonModel {


	
	protected $_auto = array (
		array ('addtime', 'mGetDate', 1, 'callback' ), 	// 增加的时候调用回调函数
		//array ('post_modified', 'mGetDate', 2, 'callback' ) 
	);
	// 获取当前时间
	function mGetDate() {
		return date ( 'Y-m-d H:i:s' );
	}
	
	protected function _before_write(&$data) {
		parent::_before_write($data);
	}
}