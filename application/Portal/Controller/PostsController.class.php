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

     /**
     * 资讯默认列表
     * @Author   YHX
     * @DateTime 2016-05-03T17:07:05+0800
     * @return   [type]                   [description]
     */
    public function news(){
        $post = json_decode(file_get_contents("php://input"));
        //分类列表
        $terms_obj = M('Terms');
        $order = "listorder ASC";
        $terms=$terms_obj->where("taxonomy='article' AND parent=1")->order($order)->field('term_id,name as title')->select();

        if($id = $post->termid){
            $map['term_id']= $id;
             $map['post_status']  = 1;


            //最新资讯

            $startLimit = $post->limit?:0;
            $endLimit = ($post->limit?:0)+10;
            //dump($startLimit."====".$endLimit);
            $term_relationships_model = M('TermRelationships');
            $posts=$term_relationships_model
                ->alias("a")
                ->join(C ( 'DB_PREFIX' )."posts b ON a.object_id = b.id")
                ->limit($startLimit,$endLimit)
                ->where($map)
                ->field('term_id,post_title as title,post_keywords as content,id,post_hits,smeta,post_modified')
                ->order("a.listorder ASC,b.post_modified DESC")->select();
            foreach($posts as $k => $v){
                $posts[$k]["content"] = mb_substr($v["content"],0,30,'utf-8');
                $posts[$k]["post_modified"] =  number_format(((time() - strtotime($v["post_modified"]))/86400),1,'.','');
                $tmp =json_decode($v["smeta"]);
                if($tmp->thumb==null || $tmp->thumb==""){
                    $posts[$k]["thumb"]=C("TMPL_PARSE_STRING.__UPLOAD__")."nopic.gif";
                }else{
                    $posts[$k]["thumb"]=C("TMPL_PARSE_STRING.__UPLOAD__").$tmp->thumb;
                }
            }
            // dump($posts);
           $this->myAjaxReturn($posts);
            exit;
        }

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
        ->field('term_id,post_title as title,post_keywords as content,id,post_hits,smeta,post_modified')
        ->order("a.listorder ASC,b.post_modified DESC")->select();
		foreach($posts as $k => $v){
            $posts[$k]["content"] = mb_substr($v["content"],0,100,'utf-8');
            $posts[$k]["post_modified"] =  number_format(((time() - strtotime($v["post_modified"]))/86400),1,'.','');
            $tmp =json_decode($v["smeta"]);
            if($tmp->thumb==null || $tmp->thumb==""){
                $posts[$k]["thumb"]=C("TMPL_PARSE_STRING.__UPLOAD__")."nopic.gif";
            }else{
                $posts[$k]["thumb"]=C("TMPL_PARSE_STRING.__UPLOAD__").$tmp->thumb;
            }
        }
       // dump($terms);die();
        $this->assign('terms',$terms);
        $this->assign('posts',$posts);
        // dump($posts);die();
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
    public function newsinfo(){
        $term_relationships_model = M('TermRelationships');
        $id = intval($_GET['newsid']);  //获取请求的id
        $posts_model = M('Posts');
        $posts = $term_relationships_model
            ->alias("a")
            ->join(C ( 'DB_PREFIX' )."posts b ON a.object_id = b.id")
            ->where(array("id"=>$id))->find();

        $posts_model->where(array("id"=>$id))->setInc('post_hits'); 

        //相关资讯(相同栏目的资讯)
        $posts_clo=$term_relationships_model
            ->alias("a")
            ->join(C ( 'DB_PREFIX' )."posts b ON a.object_id = b.id")
            ->limit('0,5')
            ->where("term_id=".$posts['term_id']." AND id !=".$id)
//            ->field('term_id,post_title as title,post_keywords as content,id,post_hits,smeta,post_modified')
            ->order("a.listorder ASC,b.post_modified DESC")->select();

        //推荐资讯
        $posts_tuijian = $posts_model->where(array("recommended"=>1))->order('post_date DESC')->find();
        // $posts_tuijian['thumb'] = $posts_tuijian['smeta']['thumb'];
        // $tmp =json_decode($posts_tuijian['thumb']);
        //     if($tmp->thumb==null || $tmp->thumb==""){
        //         $posts_tuijian["thumb"]=C("TMPL_PARSE_STRING.__UPLOAD__")."nopic.gif";
        //     }else{
        //         $posts_tuijian["thumb"]=C("TMPL_PARSE_STRING.__UPLOAD__").$tmp->thumb;
        //     }

//        //底部广告
//        $slide_obj= M("Slide");
//        $order = "listorder ASC";
//        $limit = 5;
//        $sides=$slide_obj->where("slide_status=1 and slide_cid=2")->order($order)->limit('0,'.$limit)->select();
        // echo $tmp;
       // dump($posts_tuijian);die();


//        $this->assign('sides',$sides);
        $this->assign('posts',$posts);
        $this->assign('posts_clo',$posts_clo);
        $this->assign('posts_tuijian',$posts_tuijian);

        $this->display(":newsinfo");
    }







}


