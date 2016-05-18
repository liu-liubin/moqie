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
class MineController extends HomebaseController {

    /**
     * 我的页面
     * @Author   YHX
     * @DateTime 2016-05-10T15:15:55+0800
     * @param    [type]                   $array [description]
     * @param    integer                  $pid   [description]
     * @return   [type]                          [description]
     */
    public function index(){
        $uid= sp_get_current_userid();
        $user_model= M('Users');
        $user = $user_model->where(array("id"=>$uid))->find();
        if($user){
            if($user['avatar']==null || $user['avatar']=="")
            {
                $user['avatar']="/"."nopic.gif";
            }
            else{
            	$user['avatar']="/".$user['avatar'];
            }
        //dump($user);die();
        $this->assign('user',$user);
        $this->display(":member");
        }
        else{
            $this->error("请先登录！",U("user/login/index"));
            // $tips['status']=0;//0为失败，1为成功
            // $tips['info']="请先登录！";//错误信息
            // $tips['url'] = "http://".$_SERVER['HTTP_HOST'].U('user/login/index');//跳转地址,发生错误不需要地址
            // $this->ajaxReturn($tips);
        }
    }

}


