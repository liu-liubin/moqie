<?php
// +----------------------------------------------------------------------
// | TIGO [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.tigonetwork.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: YHX
// +----------------------------------------------------------------------
namespace Portal\Controller;
use Common\Controller\HomebaseController; 
/**
 * 供需控制器
 */
class DslistController extends HomebaseController {

    /**
      * 分类递归
      * @Author   YHX
      * @DateTime 2016-05-04T15:15:55+0800
      * @param    [type]                   $array [description]
      * @param    integer                  $pid   [description]
      * @return   [type]                          [description]
      */
    function myorder ($array,$pid=0){
    $arr = array();
        
    foreach($array as $v){
        if($v['parent']==$pid){
            $arr[] = $v;
            $arr = array_merge($arr,$this->myorder($array,$v['term_id']));
        }
    }
    return $arr;
    }
	


    /**
     * 供需默认列表
     * @Author   YHX
     * @DateTime 2016-05-03T17:07:05+0800
     * @return   [type]                   [description]
     */
    public function dslist(){
    	//分类列表
		$terms_obj = M('Terms');
		$order = "listorder ASC";
		$terms=$terms_obj->where("taxonomy='dslist' AND path like '0-2%'")->order($order)->field('term_id,name,parent,path')->select();
        // $tmp = $this->myorder($terms);
        // echo json_encode($tmp);die();
        // echo "<pre>";
        // print_r($tmp);die();

        //查询条件
        $map['post_status']  = 1;
        $where_name =$_GET['name'] ? $map['post_title']=array('like','%'.$_GET['name'].'%') : "";
        $where_termid =$_GET['termid'] ? $map['term_id']=$_GET['termid'] : ""; 
        

		//最新供需
        
		// $dslist_obj = M('Dslist');
        // $join = "".C('DB_PREFIX').'posts as b on a.object_id =b.id';
		// $order1 = "post_modified Desc";
		$limit1 = 10;

        $term_relationships_model = M('TermRelationships');
        $dslist=$term_relationships_model
        ->alias("a")
        ->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
        ->limit('0,'.$limit1)
        ->where($map)
        ->order("a.listorder ASC,b.post_modified DESC")->select();

		// $dslist=$dslist_obj->where(array("post_status"=>"1","post_title"=>$where_name,""))->order($order1)->limit('0,'.$limit1)->select();

        $this->assign('terms',$terms);
        $this->assign('dslist',$dslist);
    	$this->display();

    }

    /**
     * 供需默认列表上拉加载
     * @Author   YHX
     * @DateTime 2016-05-03T18:16:09+0800
     * @return   [type]                   [description]
     */
    public function dslist_getauto(){

    	$page = intval($_GET['page']);  //获取请求的页数

        //查询条件
        $map['post_status']  = 1;
        $where_name =$_GET['name'] ? $map['post_title']=array('like','%'.$_GET['name'].'%') : "";
        $where_termid =$_GET['termid'] ? $map['term_id']=$_GET['termid'] : ""; 
        

        $start =$page*10;//偏移量


		// $dslist_obj = M('Dslist');
		// $order = "post_modified Desc";
		$limit = 10;

        $term_relationships_model = M('TermRelationships');
        $dslist=$term_relationships_model
        ->alias("a")
        ->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
        ->limit($start,$limit)
        ->where($map)
        ->order("a.listorder ASC,b.post_modified DESC")->select();

		// $dslist=$dslist_obj->where("post_status=1")->order($order)->limit($start,$limit)->select();
        echo json_encode($dslist);  //转换为json数据输出
    }


    /**
     * 需求详情页
     * @Author   YHX
     * @DateTime 2016-05-04T15:46:53+0800
     * @return   [type]                   [description]
     */
    public function dslist_detail(){
        $id = intval($_GET['id']);  //获取请求的id
        $dslist_model = M('Dslist');
        $dslist = $dslist_model->where(array("id"=>$id))->find();

        $this->assign('dslist',$dslist);
        $this->display();
    }

    /**
     * 发布页
     * @Author   YHX
     * @DateTime 2016-05-06T14:45:21+0800
     * @return   [type]                   [description]
     */
    public function publish(){
        //分类列表
        $terms_obj = M('Terms');
        $order = "listorder ASC";
        $terms=$terms_obj->where("taxonomy='dslist' AND path like '0-2-6-%'")->order($order)->field('term_id as id,name as title ,parent as parent_id')->select();
        foreach ($terms as $k => $v) {
            if($v['parent_id']==6){
                $terms[$k]['parent_id']=0;
            }
        }
        // dump($terms);die();
        $uid=sp_get_current_userid();
        $user_obj = M('Users'); 
        $user = $user_obj->where(array("id"=>$uid))->field("companyname")->find();
        

        $this->assign("terms",$terms);
        $this->assign("user",$user);
        $this->display(":publish");
    }

    /**
     * 发布信息
     * @Author   YHX
     * @DateTime 2016-05-06T18:00:39+0800
     * @return   [type]                   [description]
     */
   public function do_publish(){
      if(IS_POST){
        $data['companyname'] = $_POST["companyname"];
        $data['switch'] = $_POST["switch"];
        $data['term_id'] = $_POST["termid"];
        $data['price'] = $_POST["price"];
        $data['num'] = $_POST["num"];
        $data['unit'] = $_POST["unit"];
        $data['tag'] = $_POST["tag"];
        $data['post_content'] = htmlspecialchars_decode($_POST["content"]);
        $data['ds'] = $_POST["type"]=="feed"?1:2;
        $data['img1'] = $_POST["img1"];
        $data['img2'] = $_POST["img2"];
        $data['post_date'] =date ( 'Y-m-d H:i:s' );
        $data['post_modified'] =date ( 'Y-m-d H:i:s' );

        if(empty($_POST['termid'])){
          $this->error("请至少选择一个分类栏目！");
        }

        $dslist_model = M('Dslist');
        $term_relationships_model = M('TermRelationships');
        $result=$dslist_model->add($data);
        if ($result) {
          // foreach ($_POST['term'] as $mterm_id){
          //   $this->term_relationships_model->add(array("term_id"=>intval($mterm_id),"object_id"=>$result));
          // }
          $term_relationships_model->add(array("term_id"=>intval($data['term_id']),"object_id"=>$result));
          $this->success("添加成功！");
        } else {
          $this->error("添加失败！");
        }
        

      }
   }
     
}


