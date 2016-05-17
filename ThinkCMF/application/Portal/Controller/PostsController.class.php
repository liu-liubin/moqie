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
 * 资讯控制器
 */
class PostsController extends HomebaseController {

    // public function test(){
    //     $category = array(
    //         array("id"=>1,"title"=>"技术"),
    //         array("id"=>2,"title"=>"活动")
    //     );

    //     $newsList =  array(
    //             array("category_id"=>1,"title"=>"技术新闻111111","content"=>"新闻内容"),
    //             array("category_id"=>1,"title"=>"技术新闻2222222","content"=>"新闻内容"),
    //             array("category_id"=>2,"title"=>"活动新闻111111","content"=>"新闻内容"),
    //             array("category_id"=>2,"title"=>"活动新闻2222222","content"=>"新闻内容"),
    //         );

    //     $testArr = array();


    //     foreach ($newsList as $key => $value) {
    //         foreach($category as $ck => $cv){
    //             if($value["category_id"] == $cv["id"]){
    //                 var_dump($cv["title"]);
    //                 $value["category_name"].push() = $cv["title"];
    //                 $testArr.merge($value,$cv["title"]);
    //             }
    //         }
    //     }


    //     var_dump($newsList);

    //     // foreach($category as $k => $v ){
    //     //     foreach($newsList as $nk=>$nv){
    //     //         if($v["id"]==$nv["category_id"]){
    //     //             $category[$k]["contents"]=$nv;
    //     //         }
    //     //     }
    //     // }
    //     //dump($newList);
    //     // dump($newsList);

    // }

    /**
      * 分类递归
      * @Author   YHX
      * @DateTime 2016-05-04T15:15:55+0800
      * @param    [type]                   $array [description]
      * @param    integer                  $pid   [description]
      * @return   [type]                          [description]
      */
    // function myorder ($array,$pid=0){
    // $arr = array();
        
    // foreach($array as $v){
    //     if($v['parent']==$pid){
    //         $arr[] = $v;
    //         $arr = array_merge($arr,$this->myorder($array,$v['term_id']));
    //     }
    // }
    // return $arr;
    // }
    

     /**
     * 资讯默认列表
     * @Author   YHX
     * @DateTime 2016-05-03T17:07:05+0800
     * @return   [type]                   [description]
     */
    public function posts(){
        //分类列表
        $terms_obj = M('Terms');
        $order = "listorder ASC";
        $terms=$terms_obj->where("taxonomy='article' AND parent=1")->order($order)->field('term_id,name as title')->select();
        

        //查询条件
        $map['post_status']  = 1;
        $where_name =$_GET['name'] ? $map['post_title']=array('like','%'.$_GET['name'].'%') : "";
        $where_termid =$_GET['termid'] ? $map['term_id']=$_GET['termid'] : ""; 

        //最新资讯
        
        $limit1 = 10;

        $term_relationships_model = M('TermRelationships');
        $posts=$term_relationships_model
        ->alias("a")
        ->join(C ( 'DB_PREFIX' )."posts b ON a.object_id = b.id")
        ->limit('0,'.$limit1)
        ->where($map)
        ->field('term_id,post_title as title,post_content as content')
        ->order("a.listorder ASC,b.post_modified DESC")->select();

        // foreach($terms as $k => $v ){
        //     foreach($posts as $nk=>$nv){
        //         if($v["term_id"]==$nv["term_id"]){
        //             $terms[$k]["contents"]=$nv;
        //         }
        //     }
        // }
        // dump($posts);die();
        // $data =json_encode($terms);


        // $this->assign('data',$data);
        $this->assign('terms',$terms);
        $this->assign('posts',$posts);
        $this->display(":news");

    }

    /**
     * 资讯默认列表上拉加载
     * @Author   YHX
     * @DateTime 2016-05-03T18:16:09+0800
     * @return   [type]                   [description]
     */
    public function posts_getauto(){

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
        $posts=$term_relationships_model
        ->alias("a")
        ->join(C ( 'DB_PREFIX' )."posts b ON a.object_id = b.id")
        ->limit($start,$limit)
        ->where($map)
        ->order("a.listorder ASC,b.post_modified DESC")->select();

        // $posts=$posts_obj->where("post_status=1")->order($order)->limit($start,$limit)->select();
        echo json_encode($posts);  //转换为json数据输出
    }

    /**
     * 资讯详情页
     * @Author   YHX
     * @DateTime 2016-05-04T15:46:53+0800
     * @return   [type]                   [description]
     */
    public function posts_detail(){
        $id = intval($_GET['id']);  //获取请求的id
        $posts_model = M('Posts');
        $posts = $posts_model->where(array("id"=>$id))->find();


        //底部广告
        $slide_obj= M("Slide");
        $order = "listorder ASC";
        $limit = 5;
        $sides=$slide_obj->where("slide_status=1 and slide_cid=2")->order($order)->limit('0,'.$limit)->select();

        $this->assign('sides',$sides);
        $this->assign('posts',$posts);
        $this->display();
    }





}


