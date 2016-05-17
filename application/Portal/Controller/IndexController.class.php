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

        $user_model = M("Users");

        //查询条件
        $map['post_status']  = 1;
        $map['term_id']=array('gt','5');

        //最新供需
        $limit1 = 5;
        $term_relationships_model = M('TermRelationships');
        $dslist=$term_relationships_model
            ->alias("a")
            ->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
            ->limit('0,'.$limit1)
            ->where($map)
            ->field('term_id,post_title as title,post_keywords as content,id,post_hits,smeta,post_modified,tag,ds,post_author,price,unit,img1,img2,num,companyname,switch')
            ->order("id DESC")->select();

        //关注列表
        $uid= sp_get_current_user();
        $fav_model = M("UserFavorites");
        $favlist = $fav_model->where(array("uid"=>$uid['id'],"table"=>"dslist"))->select();

        //处理数据
        foreach($dslist as $k => $v){
            $dslist[$k]["content"] = mb_substr($v["content"],0,100,'utf-8');
//            $dslist[$k]["post_modified"] =  number_format(((time() - strtotime($v["post_modified"]))/86400),1,'.','');
//            $tmp =json_decode($v["smeta"]);
            if($v["img1"]==null || $v["img1"]==""){
                $dslist[$k]["img1"]=C("TMPL_PARSE_STRING.__UPLOAD__")."nopic.gif";
            }else{
                $dslist[$k]["img1"]="/". $v["img1"];
            }
            $user = $user_model->where("id=".$v['post_author'])->find();
            //$dslist[$k]["companyname"]=$user['companyname'];
            $dslist[$k]["mobile"]=$user['mobile'];
            $dslist[$k]["ds"]= $v["ds"]==1?"供":"需";//供需标签
            $dslist[$k]['url']=U("portal/dslist/dslist_detail",array('id'=>$v["id"]));
            //tag处理
            //$tt = explode(',',strtr($v['tag'],"，",","));
            $tt = explode(',',str_replace("，",",",$v['tag']));
            $ttt = array();
            $tags = array();
            // var_dump($tags);
            foreach($tt as $k1 => $v1){
                array_push($ttt,$tt[$k1]);
            }

            if(count($ttt)>4){
                for($i=0;$i<4;$i++){
                    array_push($tags,$ttt[$i]);
                }
            }else{
                $tags = $ttt;
            }

            

            $dslist[$k]["tags"] = $tags;


            $dslist[$k]['isfav'] = 0;//未关注返回0
            //处理是否已经关注
            if($favlist){
                foreach($favlist as $k2 => $v2){
                    if($v['id']==$v2['object_id']){
                        $dslist[$k]['isfav'] = 1;//已关注返回1
                    }
//                    else{
//                        $dslist[$k]['isfav'] = 0;//未关注返回0
//                    }
                }
            }


        }
//       dump($sides);die();

        // dump($dslist);die();

		$this->assign('sides',$sides);
		$this->assign('dslist',$dslist);
    	$this->display(":index");
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
		$terms=$terms_obj->where("taxonomy='dslist'")->order($order)->field('term_id,name,parent,path')->select();
        $tmp = $this->myorder($terms);
        // echo json_encode($tmp);die();
        echo "<pre>";
        print_r($tmp);die();

        //查询条件
        $where_name =$_GET['name'] ? $_GET['name'] : "";
        $where_termid =$_GET['termid'] ? $_GET['termid'] : "";

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
        ->where(array("post_status"=>"1","post_title"=>$where_name,"term_id"=>$where_termid))
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
        $where_name =$_GET['name'] ? $_GET['name'] : "";
        $where_termid =$_GET['termid'] ? $_GET['termid'] : "";

        $start =$page*10;//偏移量


		// $dslist_obj = M('Dslist');
		// $order = "post_modified Desc";
		$limit = 10;

        $term_relationships_model = M('TermRelationships');
        $dslist=$term_relationships_model
        ->alias("a")
        ->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
        ->limit($start,$limit)
        ->where(array("post_status"=>"1","post_title"=>$where_name,"term_id"=>$where_termid))
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
     * 资讯默认列表
     * @Author   YHX
     * @DateTime 2016-05-03T17:07:05+0800
     * @return   [type]                   [description]
     */
    public function posts(){
        //分类列表
        $terms_obj = M('Terms');
        $order = "listorder ASC";
        $terms=$terms_obj->where("taxonomy='article'")->order($order)->field('term_id,name,parent,path')->select();
        $tmp = $this->myorder($terms);
        // echo json_encode($tmp);die();
        // echo "<pre>";
        // print_r($tmp);die();

        //查询条件
        $where_name =$_GET['name'] ? $_GET['name'] : "";
        $where_termid =$_GET['termid'] ? $_GET['termid'] : "";

        //最新资讯
        
        $limit1 = 10;

        $term_relationships_model = M('TermRelationships');
        $posts=$term_relationships_model
        ->alias("a")
        ->join(C ( 'DB_PREFIX' )."posts b ON a.object_id = b.id")
        ->limit('0,'.$limit1)
        ->where(array("post_status"=>"1","post_title"=>$where_name,"term_id"=>$where_termid))
        ->order("a.listorder ASC,b.post_modified DESC")->select();


        $this->assign('terms',$terms);
        $this->assign('posts',$posts);
        $this->display();

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
        $where_name =$_GET['name'] ? $_GET['name'] : "";
        $where_termid =$_GET['termid'] ? $_GET['termid'] : "";

        $start =$page*10;//偏移量


        // $dslist_obj = M('Dslist');
        // $order = "post_modified Desc";
        $limit = 10;

        $term_relationships_model = M('TermRelationships');
        $posts=$term_relationships_model
        ->alias("a")
        ->join(C ( 'DB_PREFIX' )."posts b ON a.object_id = b.id")
        ->limit($start,$limit)
        ->where(array("post_status"=>"1","post_title"=>$where_name,"term_id"=>$where_termid))
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


