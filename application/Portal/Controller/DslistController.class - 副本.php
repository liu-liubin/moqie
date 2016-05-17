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
        $user_model = M("Users");

        //分类列表
        $terms_obj = M('Terms');
        $order = "listorder ASC";
        $terms=$terms_obj->where("taxonomy='dslist' AND path like '0-2-6-%'")->order($order)->field('term_id as id,name as title ,parent as parent_id')->select();
        foreach ($terms as $k => $v) {
            if($v['parent_id']==6){
                $terms[$k]['parent_id']=0;
            }
        }
        //查询条件 供应
        $map['post_status']  = 1;
        $_GET['name'] ? $map['post_title']=array('like','%'.$_GET['name'].'%') : "";
        $_GET['termid'] ? $map['term_id']=$_GET['termid'] : "";
        $map['ds']=1;//判断供需
//        dump($_GET);die();

        //最新供应
        $limit1 = 4;
        $term_relationships_model = M('TermRelationships');
        $dslist=$term_relationships_model
            ->alias("a")
            ->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
            ->limit('0,'.$limit1)
            ->where($map)
            // ->field('post_title as title,post_keywords as content,post_modified as time,price,unit as prefix,img1 as cover')
            ->field('term_id,post_title as title,post_keywords as content,id,post_hits,smeta,post_modified,tag,ds,post_author,price,unit,img1,img2')
            ->order("a.listorder ASC,b.post_modified DESC")->select();

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
                $dslist[$k]["img1"]=C("TMPL_PARSE_STRING.__UPLOAD__"). $v["img1"];
            }
            $user = $user_model->where("id=".$v['post_author'])->find();
            $dslist[$k]["companyname"]=$user['companyname'];
            $dslist[$k]["mobile"]=$user['mobile'];
            $dslist[$k]["ds"]= $v["ds"]==1?"供":"需";//供需标签
            $dslist[$k]['url']=U("portal/dslist/dslist_detail",array('id'=>$v["id"]));
            //tag处理
            $tags = explode(',',$v['tag']);
            foreach($tags as $k1 => $v1){
                if($v1){
                    $dslist[$k]["tags"][$k1]["title"] = $v1;
                }
            }
            $dslist[$k]['isfav'] = 0;//未关注返回0
            //处理是否已经关注
            if($favlist){
                foreach($favlist as $k2 => $v2){
                    if($v['id']==$v2['object_id']){
                        $dslist[$k]['isfav'] = 1;//已关注返回1
                    }
                }
            }
        }

        //查询条件 需求
        $map1['post_status']  = 1;
        $_GET['name'] ? $map1['post_title']=array('like','%'.$_GET['name'].'%') : "";
        $_GET['termid'] ? $map1['term_id']=$_GET['termid'] : "";
        $map1['ds']=2;//判断供需

        //最新需求
        // $limit1 = 10;
        $term_relationships_model = M('TermRelationships');
        $dslist1=$term_relationships_model
            ->alias("a")
            ->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
            ->limit('0,'.$limit1)
            ->where($map1)
            // ->field('post_title as title,post_keywords as content,post_modified as time,price,unit as prefix,img1 as cover')
            ->field('term_id,post_title as title,post_keywords as content,id,post_hits,smeta,post_modified,tag,ds,post_author,price,unit,img1,img2')
            ->order("a.listorder ASC,b.post_modified DESC")->select();

        //关注列表
        $uid= sp_get_current_user();
        $fav_model = M("UserFavorites");
        $favlist = $fav_model->where(array("uid"=>$uid['id'],"table"=>"dslist1"))->select();

        //处理数据
        foreach($dslist1 as $k => $v){
            $dslist1[$k]["content"] = mb_substr($v["content"],0,100,'utf-8');
//            $dslist1[$k]["post_modified"] =  number_format(((time() - strtotime($v["post_modified"]))/86400),1,'.','');
//            $tmp =json_decode($v["smeta"]);
            if($v["img1"]==null || $v["img1"]==""){
                $dslist1[$k]["img1"]=C("TMPL_PARSE_STRING.__UPLOAD__")."nopic.gif";
            }else{
                $dslist1[$k]["img1"]=C("TMPL_PARSE_STRING.__UPLOAD__"). $v["img1"];
            }
            $user = $user_model->where("id=".$v['post_author'])->find();
            $dslist1[$k]["companyname"]=$user['companyname'];
            $dslist1[$k]["mobile"]=$user['mobile'];
            $dslist1[$k]["ds"]= $v["ds"]==1?"供":"需";//供需标签
            $dslist1[$k]['url']=U("portal/dslist/dslist_detail",array('id'=>$v["id"]));
            //tag处理
            $tags = explode(',',$v['tag']);
            foreach($tags as $k1 => $v1){
                if($v1){
                    $dslist1[$k]["tags"][$k1]["title"] = $v1;
                }
            }
            $dslist1[$k]['isfav'] = 0;//未关注返回0
            //处理是否已经关注
            if($favlist){
                foreach($favlist as $k2 => $v2){
                    if($v['id']==$v2['object_id']){
                        $dslist1[$k]['isfav'] = 1;//已关注返回1
                    }
                }
            }
        }



        //组装数组并转化为json格式
        $tmp = array($dslist,$dslist1);
        $ds_json = json_encode($tmp);
        $terms = json_encode($terms);
        // dump($tmp);die();
        // echo $tmp ;die();

        $this->assign('terms',$terms);
        $this->assign('dslist',$ds_json);
        $this->display(":market");

    }

    /**
     * 供需默认列表上拉加载
     * @Author   YHX
     * @DateTime 2016-05-03T18:16:09+0800
     * @return   [type]                   [description]
     */
    public function dslist_getauto(){

        

        //查询条件
        $map['post_status']  = 1;
        $where_name =$_GET['name'] ? $map['post_title']=array('like','%'.$_GET['name'].'%') : "";
        $where_termid =$_GET['termid'] ? $map['term_id']=$_GET['termid'] : "";

        $page = intval($_GET['page']);  //获取请求的页数
        $start =$page*10;//偏移量
        $limit = 10;
        // $dslist_obj = M('Dslist');
        // $order = "post_modified Desc";
        

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
        $dslist = $dslist_model
        ->alias("a")
        ->join(C ( 'DB_PREFIX' )."users b ON a.post_author = b.id")
        ->field('a.id,avatar,post_title,post_content,a.companyname,specification,description,num,switch,img1,ds,unit,truename,mobile')
        ->where(array("a.id"=>$id))->find();
        if($dslist['avatar']==null || $dslist['avatar']==""){
            $dslist['avatar']=C("TMPL_PARSE_STRING.__UPLOAD__")."nopic.gif";
        }else{
            $dslist['avatar']=C("TMPL_PARSE_STRING.__UPLOAD__").$dslist['avatar'];
        }
        // dump($dslist);die();

        $this->assign('dslist',$dslist);
        if($dslist['ds']==1){
            $this->display(":proinfo");
        }
        elseif ($dslist['ds']==2) {
            $this->display(":proinfo2");
        }
        
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
        //未登录不能操作
        if(sp_get_current_user()==0 || sp_get_current_user()==null){
            $this->error("请先登录！");
        }
        if(IS_POST){
            $data['companyname'] = $_POST["companyname"];
            $data['post_title'] = $_POST["title"];
            $data['switch'] = $_POST["switch"];
            $data['term_id'] = $_POST["termid"];
            $data['price'] = $_POST["price"];
            $data['num'] = $_POST["num"];
            $data['unit'] = $_POST["unit"];
            $data['tag'] = $_POST["tag"];
            $data['specification'] = $_POST["specification"];
            $data['post_content'] = htmlspecialchars_decode($_POST["content"]);
            $data['ds'] = $_POST["type"]=="feed"?1:2;
            $data['img1'] = $_POST["img1"];
            $data['img2'] = $_POST["img2"];
            $data['post_date'] =date ( 'Y-m-d H:i:s' );
            $data['post_modified'] =date ( 'Y-m-d H:i:s' );
            $data['post_author']=sp_get_current_userid();
            $data['post_status'] = 0;

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
                $this->success("添加成功");
                // var_dump($data);
                // echo '------------------------------------';
                // var_dump($_FILES);
            } else {
                $this->error("添加失败");
            }
        }
    }



    public function upload(){
        $upload = new \Think\Upload();
        $upload->maxSize   =     3145728 ;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =     './dslist/'; 
        $upload->savePath  =     ''; 
        // 上传文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            $this->success('上传成功！');
        }
    }

    //YHX 20160513 拿样页面
    public function sample(){
        $object_id =$_GET['id'];
        if($object_id==null ||$object_id==""){
            $this->error("非法数据");
        }
        $uid=sp_get_current_userid();
        $user_model = M("Users");
        $user = $user_model->where(array("id"=>$uid))->find();
        $this->assign("object_id",$object_id);
        $this->assign("user",$user);
        $this->display(":proneed");
    }

    //YHX 20160513 拿样
    public function do_sample(){
        if(IS_POST){
            // dump($_POST);die();
            $picker = $_POST['picker'];
            $companyname = $_POST['companyname'];
            $mobile = $_POST['mobile'];
            $address = $_POST['address'];
            $uid = sp_get_current_userid();
            $now = date ( 'Y-m-d H:i:s' );
            $object_id = $_POST['object_id'];

            $data['picker'] = $picker;
            $data['companyname'] = $companyname;
            $data['mobile'] = $mobile;
            $data['re_address'] = $address;
            $data['uid'] = $uid;
            $data['addtime'] = $now;
            $data['object_id'] = $object_id;
            //数据不能为空
            if($picker=="" || $picker==null || $companyname=="" || $companyname==null || $mobile=="" || $mobile==null || $address=="" || $address==null){
                $this->error("数据不能为空");
            }
            else{
                $sample_model = M("sample");
                $sample = $sample_model->add($data);
                if($sample){
                    $this->success("申请拿样成功");
                }
                else{
                    $this->error("申请失败");
                }
            }

        }
        else{
            $this->error("非法请求");
        }
    }

    /**
     * 筛选供需列表
     * @Author   jewey
     * @DateTime 2016-05-13T14:07:05+0800
     * @return   [type]                   [description]
     *
     * get讲求传入的数据有
     * 1、page 页数，从1开始
     * 2、name 产品标题
     * 3、termid 分类id
     * 4、ds为供需类型，1为供，2为需
     */
    public function filter_dslist()
    {
        
        $user_model = M("Users");

        //查询条件 供应
        if (isset($_GET['page']) && trim($_GET['page']) != '') {
            $page = intval($_GET['page'])-1;  //获取请求的页数,
        }else{
            $page = 0;
        }

        $limit = 4;//偏移量
        $start =$page*$limit;
        
        $map['post_status']  = 1;//已审核才显示
        if (isset($_GET['name']) && trim($_GET['name']!='')) {
            $map['post_title']=array('like','%'.$_GET['name'].'%');
        }
        if (isset($_GET['termid']) && trim($_GET['termid']!='')) {
            $map['term_id']=$_GET['termid'];
        }
        if (isset($_GET['ds']) && trim($_GET['ds']!='')) {
            $map['ds']=$_GET['ds'];//获取供或需
        }
        
        // dump($start);
        // dump($map);
        // die();        
       // dump($_GET);
       // die();

        //最新供应

        $term_relationships_model = M('TermRelationships');
        $dslist=$term_relationships_model
            ->alias("a")
            ->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
            ->limit($start,$limit)
            ->where($map)
            // ->field('post_title as title,post_keywords as content,post_modified as time,price,unit as prefix,img1 as cover')
            ->field('term_id,post_title as title,post_keywords as content,id,post_hits,smeta,post_modified,tag,ds,post_author,price,unit,img1,img2')
            ->order("a.listorder ASC,b.post_modified DESC")->select();

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
                $dslist[$k]["img1"]=C("TMPL_PARSE_STRING.__UPLOAD__"). $v["img1"];
            }
            $user = $user_model->where("id=".$v['post_author'])->find();
            $dslist[$k]["companyname"]=$user['companyname'];
            $dslist[$k]["mobile"]=$user['mobile'];
            $dslist[$k]["ds"]= $v["ds"]==1?"供":"需";//供需标签
            $dslist[$k]['url']=U("portal/dslist/dslist_detail",array('id'=>$v["id"]));
            //tag处理
            $tags = explode(',',$v['tag']);
            foreach($tags as $k1 => $v1){
                if($v1){
                    $dslist[$k]["tags"][$k1]["title"] = $v1;
                }
            }
            $dslist[$k]['isfav'] = 0;//未关注返回0
            //处理是否已经关注
            if($favlist){
                foreach($favlist as $k2 => $v2){
                    if($v['id']==$v2['object_id']){
                        $dslist[$k]['isfav'] = 1;//已关注返回1
                    }
                }
            }
        }
        echo json_encode(($dslist));
        exit();
    }






    //YHX
//     public function upload(){
// //        echo "123";die();
//         dump($_POST);
//         die();
//         $upload = new \Think\Upload();// 实例化上传类
//         $upload->maxSize   =     3145728 ;// 设置附件上传大小
//         $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
//         $upload->savePath  =      './dslist/'; // 设置附件上传目录
// //        $upload->saveName = time().'_'.mt_rand();
//         // 上传文件
//         $info   =   $upload->upload();
//         if(!$info) {// 上传错误提示错误信息
//             $this->error($upload->getError());
//         }else{// 上传成功
//             $this->success('上传成功！');
//         }
//     }

}


