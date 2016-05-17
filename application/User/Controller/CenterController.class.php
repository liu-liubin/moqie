<?php

/**
 * 会员中心
 */
namespace User\Controller;
use Common\Controller\MemberbaseController;
class CenterController extends MemberbaseController {
	
	protected $users_model;
	function _initialize(){
		parent::_initialize();
		$this->users_model=D("Common/Users");
	}

    //会员空间  YHX
	public function index() {
        //判断登录
        if(!sp_is_user_login()) {
            $this->error("请先登录","/user/login/index");
        }
		$userid=sp_get_current_userid();
		$user=$this->users_model->where(array("id"=>$userid))->find();

        if($user['avatar']==null || $user['avatar']==""){
            $user['avatar']=C("TMPL_PARSE_STRING.__UPLOAD__")."nopic.gif";
        }
        else{
            $user['avatar']=C("TMPL_PARSE_STRING.__UPLOAD__").$user['avatar'];
        }

        switch ($user['company_status'])
        {
            case 1:
                $user['company_status']="未认证";
                break;
            case 2:
                $user['company_status']="正在认证";
                break;
            case 3:
                $user['company_status']="认证失败";
                break;
            case 4:
                $user['company_status']="已认证";
                break;
            default:
                $user['company_status']="未认证";
        }
//dump($user);die();
		$order = "post_modified Desc";
        $limit = 2;
		//供应历史
        $map['post_author'] = $userid;
        $map['ds'] = 1;
        $term_relationships_model = M('TermRelationships');
        $dslist=$term_relationships_model
        ->alias("a")
        ->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
        ->limit('0,'.$limit)
        ->where($map)
        ->order("a.listorder ASC,b.post_modified DESC")->select();

		//需求历史
        $map['post_author'] = $userid;
        $map['ds'] = 2;
        $term_relationships_model = M('TermRelationships');
        $dslist1=$term_relationships_model
        ->alias("a")
        ->join(C ( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
        ->limit('0,'.$limit)
        ->where($map)
        ->order("a.listorder ASC,b.post_modified DESC")->select();


        $this->assign('supply',$dslist);
        $this->assign('demand',$dslist1);
		$this->assign('user',$user);
        //yhx20160510
    	$this->display(':m_zone');
    }

    //YHX20160510 个人信息
    public function m_info(){
        //判断登录
        if(!sp_is_user_login()) {
            $this->error("请先登录","/user/login/index");
        }
        $uid = sp_get_current_userid();
        $user_model = M("Users");
        $user = $user_model->where(array("id"=>$uid))->find();
        //包装性别数据
        if($user['sex']==1){
            $user['sex'] = "男";
        }
        elseif($user['sex']==2){
            $user['sex'] = "女";
        }
        else{
            $user['sex'] = "保密";
        }
        //包装头像数据
        if($user['avatar']==null || $user['avatar']==""){
            $user['avatar']=C("TMPL_PARSE_STRING.__UPLOAD__")."nopic.gif";
        }
        else{
            $user['avatar']=C("TMPL_PARSE_STRING.__UPLOAD__").$user['avatar'];
        }

//        dump($user);die();
        $this->assign("user",$user);
        $this->display(":m_info");
    }

    //YHX20160510 企业信息
    public function c_info(){
        //判断登录
        if(!sp_is_user_login()) {
            $this->error("请先登录","/user/login/index");
        }
        $uid = sp_get_current_userid();
        $user_model = M("Users");
        $user = $user_model->where(array("id"=>$uid))->find();
        $this->assign("user",$user);
        $this->display(":m_company");
    }

    //YHX20160510 我的需求
    public function m_need(){
        //判断登录
        if(!sp_is_user_login()) {
            $this->error("请先登录","/user/login/index");
        }
        $uid = sp_get_current_userid();
        $dslist_model = M("Dslist");
        $dslist = $dslist_model
            ->alias("a")
            ->join(C( 'DB_PREFIX' )."users b ON a.post_author = b.id")
            ->where(array("post_author"=>$uid,"ds"=>2))
            ->field('post_title as title,post_keywords as content,b.id,post_modified,tag,ds,post_author,price,unit,img1,img2,b.companyname,b.mobile')
            ->order("post_modified DESC")
            ->select();

        //处理数据
        foreach($dslist as $k => $v){
            if($v["img1"]==null || $v["img1"]==""){
                $dslist[$k]["img1"]=C("TMPL_PARSE_STRING.__UPLOAD__")."nopic.gif";
            }else{
                $dslist[$k]["img1"]=C("TMPL_PARSE_STRING.__UPLOAD__"). $v["img1"];
            }
            $dslist[$k]["ds"]= $v["ds"]==1?"供":"需";//供需标签
            $dslist[$k]['url']=U("portal/dslist/dslist_detail",array('id'=>$v["id"]));
            //tag处理
            $tags = explode(',',$v['tag']);
            foreach($tags as $k1 => $v1){
                if($v1){
                    $dslist[$k]["tags"][$k1]["title"] = $v1;
                }
            }
        }
//        dump($dslist);die();

        $this->assign("dslist",$dslist);
        $this->display(":m_need");
    }

    //YHX20160510 我的供应
    public function m_feed(){
        //判断登录
        if(!sp_is_user_login()) {
            $this->error("请先登录","/user/login/index");
        }
        $uid = sp_get_current_userid();
        $dslist_model = M("Dslist");
        $dslist = $dslist_model
            ->alias("a")
            ->join(C( 'DB_PREFIX' )."users b ON a.post_author = b.id")
            ->where(array("post_author"=>$uid,"ds"=>1))
            ->field('post_title as title,post_keywords as content,b.id,post_modified,tag,ds,post_author,price,unit,img1,img2,b.companyname,b.mobile')
            ->order("post_modified DESC")
            ->select();

        //处理数据
        foreach($dslist as $k => $v){
            if($v["img1"]==null || $v["img1"]==""){
                $dslist[$k]["img1"]=C("TMPL_PARSE_STRING.__UPLOAD__")."nopic.gif";
            }else{
                $dslist[$k]["img1"]=C("TMPL_PARSE_STRING.__UPLOAD__"). $v["img1"];
            }
            $dslist[$k]["ds"]= $v["ds"]==1?"供":"需";//供需标签
            $dslist[$k]['url']=U("portal/dslist/dslist_detail",array('id'=>$v["id"]));
            //tag处理
            $tags = explode(',',$v['tag']);
            foreach($tags as $k1 => $v1){
                if($v1){
                    $dslist[$k]["tags"][$k1]["title"] = $v1;
                }
            }
        }
        $this->assign("dslist",$dslist);
        $this->display(":m_feed");
    }

    //YHX 完善个人信息页面
    function reg_info(){
        $uid = sp_get_current_userid();
        $user_model = M('Users');
        $user =$user_model->where(array("id"=>$uid))->find();
//        dump($user);die();
        switch ($user['sex'])
        {
            case 1:
                $user['sex']="男";
                break;
            case 2:
                $user['sex']="女";
                break;
            default:
                $user['sex']="保密";
        }

        $this->assign("user",$user);
        $this->display(":reg_info");
    }

    //YHX 完善企业信息页面
    function reg_company(){
        $uid = sp_get_current_userid();
        $user_model = M('Users');
        $user =$user_model->where(array("id"=>$uid))->find();
        $this->assign("user",$user);
        $this->display(":reg_company");
    }

    //YHX 完善个人信息
    function do_reg_info(){
        $user_model = M('Users');

        $uid = sp_get_current_userid();//当前用户id
        $avatar = $_POST['avatar'];//头像
        $nicename = $_POST['nicename'];//昵称
        $truename = $_POST['truename'];//真实姓名
        $sex = $_POST['sex'];//性别
        $address = $_POST['address'];//联系地址
        $companyname = $_POST['companyname'];//所属公司
        $position = $_POST['position'];//职务
        $mobile = $_POST['mobile'];//电话

        if($mobile != null || $mobile != ""){

        }
        if($avatar!=null || $avatar!=""){
            $data['avatar']=$avatar;
        }
        if($nicename!=null || $nicename!=""){
            $data['nicename']=$nicename;
        }
        if($truename!=null || $truename!=""){
            $data['truename']=$truename;
        }
        if($sex!=null || $sex!=""){
            switch ($sex)
            {
                case '男':
                    $data['sex']="1";
                    break;
                case '女':
                    $data['sex']="2";
                    break;
                default:
                    $data['sex']="0";
            }
        }
        if($address!=null || $address!=""){
            $data['address']=$address;
        }
        if($companyname!=null || $companyname!=""){
            $data['companyname']=$companyname;
        }
        if($position!=null || $position!=""){
            $data['position']=$position;
        }
//        dump($data);die();
        $user = $user_model->where(array('id'=>$uid))->save($data);
        if($user){
            $this->success('更新成功！',U("user/center/reg_info"),1);
        }else{
            $this->error('更新失败！',U("user/center/do_reg_info"),1);
        }



    }


    //YHX 完善企业信息
    function do_reg_company(){
        $user_model = M('Users');

        $uid = sp_get_current_userid();//当前用户id
        $logo = $_POST['logo'];//logo
        $company_add = $_POST['company_add'];//公司地址
        $primarybusiness = $_POST['primarybusiness'];//主营业务
        $customer_groups = $_POST['customer_groups'];//客户群体
        $customer_email = $_POST['customer_email'];//邮箱
        $company_jianjie = $_POST['company_jianjie'];//简介

        $data['logo'] = $logo;
        $data['company_add'] = $company_add;
        $data['primarybusiness'] = $primarybusiness;
        $data['customer_groups'] = $customer_groups;
        $data['customer_email'] = $customer_email;
        $data['company_jianjie'] = $company_jianjie;
//        dump($uid);die();
        $user = $user_model->where(array('id'=>$uid))->save($data);
        if($user){
            $this->success('更新成功！',"/");
        }else{
            $this->error('更新失败！',U("user/center/do_reg_company"),1);
        }
    }



}