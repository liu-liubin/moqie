<?php
namespace User\Controller;
use Common\Controller\MemberbaseController;
class FavoriteController extends MemberbaseController{
	
	function index(){
		$uid=sp_get_current_userid();
		$user_favorites_model=M("UserFavorites");
//		$favorites=$user_favorites_model->where("uid=$uid")->select();

        //查询条件
        $map['post_status']  = 1;
       	$map['uid']=$uid;
        $limit1 = 10;

        $dslist=$user_favorites_model
            ->alias("a")
            ->join(C( 'DB_PREFIX' )."dslist b ON a.object_id = b.id")
            ->join(C( 'DB_PREFIX' )."users c ON a.uid = c.id")
            ->limit('0,'.$limit1)
            ->where($map)
            ->field('post_title as title,post_keywords as content,b.id,post_modified,tag,ds,post_author,price,unit,img1,img2,c.companyname,c.mobile')
            ->order("b.post_modified DESC")->select();

        //处理数据
        foreach($dslist as $k => $v){
            if($v["img1"]==null || $v["img1"]==""){
                $dslist[$k]["img1"]=C("TMPL_PARSE_STRING.__UPLOAD__")."nopic.gif";
            }else{
                $dslist[$k]["img1"]="/". $v["img1"];
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

     // dump($dslist);die();
        $this->assign("dslist",$dslist);
		$this->display(":m_attention");
	}
	
	function do_favorite(){
		$key=sp_authcode($_POST['key']);
		if($key){
			$authkey=C("AUTHCODE");
			$key=explode(" ", $key);
			$authcode=$key[0];
			if($authcode==C("AUTHCODE")){
				$table=$key[1];
				$object_id=$key[2];
				$post=I("post.");
				unset($post['key']);
				$post['table']=$table;
				$post['object_id']=$object_id;
				
				$uid=sp_get_current_userid();
				$post['uid']=$uid;
				$user_favorites_model=M("UserFavorites");
				$find_favorite=$user_favorites_model->where(array('table'=>$table,'object_id'=>$object_id,'uid'=>$uid))->find();
				if($find_favorite){
					$this->error("亲，您已收藏过啦！");
				}else {
					$post['createtime']=time();
					$result=$user_favorites_model->add($post);
					if($result){
						$this->success("收藏成功！");
					}else {
						$this->error("收藏失败！");
					}
				}
			}else{
				$this->error("非法操作，无合法密钥！");
			}
		}else{
			$this->error("非法操作，无密钥！");
		}
		$this->error(sp_authcode($_POST['key']));
	}

    //YHX
    function do_dsfav(){
//        $post = json_decode(file_get_contents("php://input"));
        $dsid=$_GET['id'];
        $uid=sp_get_current_userid();
        if($uid==null || $uid==""){
//            $this->ajaxReturn(array("status"=>9));
            $this->error("亲，请登录！");
        }
//        dump($uid);die();
        $dslist_model = M('Dslist');
        $dslist=$dslist_model->where(array("id" => $dsid))->find();

        $data['uid']=$uid;
        $data['title']=$dslist['post_title'];
        $data['table']="dslist";
        $data['object_id']=$dsid;
        $data['createtime']=time();
//dump($dsid);die();
        $user_favorites_model=M("UserFavorites");
        $find_favorite=$user_favorites_model->where(array('table'=>"dslist",'object_id'=>$dsid,'uid'=>$uid))->find();
        if($find_favorite){
            $this->error("亲，您已关注过啦！");
        }else {
            $result=$user_favorites_model->add($data);
            if($result){
                $this->success("关注成功！");
            }else {
                $this->error("关注失败！");
            }
        }

    }
	
	function delete_favorite(){
		$id=I("get.id",0,"intval");

		$uid=sp_get_current_userid();
		$post['uid']=$uid;
		// dump($id);die();
		$user_favorites_model=M("UserFavorites");
		$result=$user_favorites_model->where(array('object_id'=>$id,'uid'=>$uid,'table'=>'dslist'))->delete();
		if($result){
			$this->success("取消关注成功！");
		}else {
			$this->error("取消关注失败！");
		}
	}
}