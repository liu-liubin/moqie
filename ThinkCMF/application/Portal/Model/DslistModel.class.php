<?php
namespace Common\Model;
use Common\Model\CommonModel;
/**
 * @Author   YHX
 * @DateTime 2016-04-28T09:57:30+0800
 * 供需表model
 */
class DsModel extends CommonModel {
	/*
	 * 表结构
	 * id
	 * post_author:发表者id
	 * post_keywords:seo keywords
	 * post_source:转载文章的来源
	 * post_date:post创建日期，永久不变，一般不显示给用户
	 * post_content:post内容
	 * post_title:post标题
	 * post_excerpt:post摘要
	 * post_status:post状态，1已审核，0未审核
	 * comment_status:评论状态，1允许，0不允许
	 * post_modified:post更新时间，可在前台修改，显示给用户
	 * post_content_filtered:
	 * post_parent:post的父级post id,表示post层级关系
	 * post_type:
	 * post_mime_type:
	 * comment_count:
	 * smeta:post的扩展字段，保存相关扩展属性，如缩略图；格式为json
	 * post_hits:post点击数，查看数
	 * post_like:post赞数
	 * istop:置顶 1置顶； 0不置顶
	 * recommended:推荐 1推荐 0不推荐
	 * companyname:公司名称
	 * price:价格
	 * specification:产品参数
	 * description:产品描述
	 * num:数量
	 * switch:是否显示公司名称 1显示0不显示 默认1
	 * tag:标签
	 * img1:图片1
	 * img2:图片2
	 * ds:供需标签 1.供2.需
	 */

	
	protected $_auto = array (
		array ('post_date', 'mGetDate', 1, 'callback' ), 	// 增加的时候调用回调函数
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