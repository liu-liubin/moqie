<?php
/**
 * 会员注册
 */
namespace User\Controller;
use Common\Controller\HomebaseController;
class RegisterController extends HomebaseController {
	
	function index(){
	    if(sp_is_user_login()){ //已经登录时直接跳到首页
	        redirect(__ROOT__."/");
	    }else{
	        $this->display(":register");
	    }
	}
	
	function doregister(){
    	
    	if(isset($_POST['email'])){
    	    
    	    //邮箱注册
    	    $this->_do_email_register();
    	    
    	}elseif(isset($_POST['mobile'])){
    	    
    	    //手机号注册
    	    $this->_do_mobile_register();
    	    
    	}else{
    	    $this->error("注册方式不存在！");
    	}
    	
	}
	function check_reg_moblie(){
		$post = json_decode(file_get_contents("php://input"));

		$where['mobile']=$post->mobile;
	    $users_model=M("Users");
	    $result = $users_model->where($where)->find();
	    //dump($users_model);
	    if($result){
	        $this->ajaxReturn(array("status"=>1));
	    }else{
	    	$this->ajaxReturn(array("status"=>0));
	    }
	}	
	private function _do_mobile_register(){
	     
	    if($this->check_mcode()==0){
	             // $this->error("手机验证码错误！");
	            $tips['status']=0;//0为失败，1为成功
	            $tips['info']="手机验证码错误！";//错误信息
	            // $tips['url'] = "http://".$_SERVER['HTTP_HOST'].U('user/login/index');//跳转地址,发生错误不需要地址
	            $this->ajaxReturn($tips);
        }
        $rules = array(
            //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
            array('mobile', 'require', '手机号不能为空！', 1 ),
            array('password','require','密码不能为空！',1),
        );
        	

	    $users_model=M("Users");
	     
	    if($users_model->validate($rules)->create()===false){
	        // $this->error($users_model->getError());
	        $tips['status']=0;//0为失败，1为成功
            $tips['info']=$users_model->getError();//错误信息
            // $tips['url'] = "http://".$_SERVER['HTTP_HOST'].U('user/login/index');//跳转地址,发生错误不需要地址
            $this->ajaxReturn($tips);
	    }
	     
	    $password=$_POST['password'];
	    $mobile=$_POST['mobile'];
	     
	    if(strlen($password) < 5 || strlen($password) > 20){
	        // $this->error("密码长度至少5位，最多20位！");
	        $tips['status']=0;//0为失败，1为成功
            $tips['info']="密码长度至少5位，最多20位！";//错误信息
            // $tips['url'] = "http://".$_SERVER['HTTP_HOST'].U('user/login/index');//跳转地址,发生错误不需要地址
            $this->ajaxReturn($tips);
	    }
	     
	    
	    $where['mobile']=$mobile;
	     
	    $users_model=M("Users");
	    $result = $users_model->where($where)->count();
	    if($result){
	        // $this->error("手机号已被注册！");
	        $tips['status']=0;//0为失败，1为成功
            $tips['info']="手机号已被注册！";//错误信息
            // $tips['url'] = "http://".$_SERVER['HTTP_HOST'].U('user/login/index');//跳转地址,发生错误不需要地址
            $this->ajaxReturn($tips);
	    }else{

	        $data=array(
	            'user_login' => $_POST['mobile'],
	            'user_email' => '',
	            'mobile' =>$_POST['mobile'],
	            'user_nicename' =>$_POST['mobile'],
	            'user_pass' => sp_password($password),
	            'last_login_ip' => get_client_ip(0,true),
	            'create_time' => date("Y-m-d H:i:s"),
	            'last_login_time' => date("Y-m-d H:i:s"),
	            'user_status' => 1,
	            "user_type"=>2,//会员
	        );
	        $rst = $users_model->add($data);
	        if($rst){
	            //登入成功页面跳转
	            $data['id']=$rst;
	            $_SESSION['user']=$data;
	            // $this->success("注册成功！",U("user/center/reg_info"));
	            $tips['status']=1;//0为失败，1为成功
	            $tips['info']="注册成功！";//错误信息
	            $tips['url'] = "http://".$_SERVER['HTTP_HOST'].U('user/center/reg_info');//跳转地址,发生错误不需要地址
	            $this->ajaxReturn($tips);
	        
	        }else{
	            // $this->error("注册失败！",U("user/register/index"));
	            $tips['status']=0;//0为失败，1为成功
	            $tips['info']="注册失败！";//错误信息
	            // $tips['url'] = "http://".$_SERVER['HTTP_HOST'].U('user/login/index');//跳转地址,发生错误不需要地址
	            $this->ajaxReturn($tips);
	        }
	         
	    }
	}
	
	private function _do_email_register(){
	   
        if(!sp_check_verify_code()){
            $this->error("验证码错误！");
        }
        
        $rules = array(
            //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
            array('email', 'require', '邮箱不能为空！', 1 ),
            array('password','require','密码不能为空！',1),
            array('repassword', 'require', '重复密码不能为空！', 1 ),
            array('repassword','password','确认密码不正确',0,'confirm'),
            array('email','email','邮箱格式不正确！',1), // 验证email字段格式是否正确
            	
        );
	    
	     
	    $users_model=M("Users");
	     
	    if($users_model->validate($rules)->create()===false){
	        $this->error($users_model->getError());
	    }
	     
	    $password=$_POST['password'];
	    $email=$_POST['email'];
	    $username=str_replace(array(".","@"), "_",$email);
	    //用户名需过滤的字符的正则
	    $stripChar = '?<*.>\'"';
	    if(preg_match('/['.$stripChar.']/is', $username)==1){
	        $this->error('用户名中包含'.$stripChar.'等非法字符！');
	    }
	     
// 	    $banned_usernames=explode(",", sp_get_cmf_settings("banned_usernames"));
	     
// 	    if(in_array($username, $banned_usernames)){
// 	        $this->error("此用户名禁止使用！");
// 	    }
	     
	    if(strlen($password) < 5 || strlen($password) > 20){
	        $this->error("密码长度至少5位，最多20位！");
	    }
	    
	    $where['user_login']=$username;
	    $where['user_email']=$email;
	    $where['_logic'] = 'OR';
	    
	    $ucenter_syn=C("UCENTER_ENABLED");
	    $uc_checkemail=1;
	    $uc_checkusername=1;
	    if($ucenter_syn){
	        include UC_CLIENT_ROOT."client.php";
	        $uc_checkemail=uc_user_checkemail($email);
	        $uc_checkusername=uc_user_checkname($username);
	    }
	     
	    $users_model=M("Users");
	    $result = $users_model->where($where)->count();
	    if($result || $uc_checkemail<0 || $uc_checkusername<0){
	        $this->error("用户名或者该邮箱已经存在！");
	    }else{
	        $uc_register=true;
	        if($ucenter_syn){
	             
	            $uc_uid=uc_user_register($username,$password,$email);
	            //exit($uc_uid);
	            if($uc_uid<0){
	                $uc_register=false;
	            }
	        }
	        if($uc_register){
	            $need_email_active=C("SP_MEMBER_EMAIL_ACTIVE");
	            $data=array(
	                'user_login' => $username,
	                'user_email' => $email,
	                'user_nicename' =>$username,
	                'user_pass' => sp_password($password),
	                'last_login_ip' => get_client_ip(0,true),
	                'create_time' => date("Y-m-d H:i:s"),
	                'last_login_time' => date("Y-m-d H:i:s"),
	                'user_status' => $need_email_active?2:1,
	                "user_type"=>2,//会员
	            );
	            $rst = $users_model->add($data);
	            if($rst){
	                //登入成功页面跳转
	                $data['id']=$rst;
	                $_SESSION['user']=$data;
	                	
	                //发送激活邮件
	                if($need_email_active){
	                    $this->_send_to_active();
	                    unset($_SESSION['user']);
	                    $this->success("注册成功，激活后才能使用！",U("user/login/index"));
	                }else {
	                    $this->success("注册成功！",__ROOT__."/");
	                }
	                	
	            }else{
	                $this->error("注册失败！",U("user/register/index"));
	            }
	             
	        }else{
	            $this->error("注册失败！",U("user/register/index"));
	        }
	         
	    }
	}
	
	function active(){
		$hash=I("get.hash","");
		if(empty($hash)){
			$this->error("激活码不存在");
		}
		
		$users_model=M("Users");
		$find_user=$users_model->where(array("user_activation_key"=>$hash))->find();
		
		if($find_user){
			$result=$users_model->where(array("user_activation_key"=>$hash))->save(array("user_activation_key"=>"","user_status"=>1));
			
			if($result){
				$find_user['user_status']=1;
				$_SESSION['user']=$find_user;
				$this->success("用户激活成功，正在登录中...",__ROOT__."/");
			}else{
				$this->error("用户激活失败!",U("user/login/index"));
			}
		}else{
			$this->error("用户激活失败，激活码无效！",U("user/login/index"));
		}
		
		
	}

	//YHX20160511 获取手机验证码
    function mobile_code(){


        $mobile =$_GET['mobile'];

        //判断是否是电话号码
        if(sp_is_mobile($mobile)){
            //生成手机验证码
            $mcode= rand(1000,9999);
            //判断是否发送成功
            if($this->send_mcode($mobile,$mcode)>0){
                //发送验证码到手机
                //将手机验证码跟申请时间存入session
                session_destroy();//销毁session
                session_start();//开启缓存
                $_SESSION['time']=date("Y-m-d H:i:s");
                $_SESSION['mcode']=$mcode;
            }
            else{
                // $this->error("验证码发送错误",U("user/register/index"));
                $tips['status']=0;//0为失败，1为成功
	            $tips['info']="验证码发送错误";//错误信息
	            // $tips['url'] = "http://".$_SERVER['HTTP_HOST'].U('user/login/index');//跳转地址,发生错误不需要地址
	            $this->ajaxReturn($tips);
            }
        }
        else{
            // $this->error("手机号码格式错误",U("user/register/index"));
            $tips['status']=0;//0为失败，1为成功
            $tips['info']="手机号码格式错误";//错误信息
            // $tips['url'] = "http://".$_SERVER['HTTP_HOST'].U('user/login/index');//跳转地址,发生错误不需要地址
            $this->ajaxReturn($tips);
        }
    }

    //YHX20160511 发送手机验证码
    function send_mcode($mobile,$mcode){
        $username = "clymumo";
        $pwd = "hyx75tr8";
        $password = md5($username."".md5($pwd));
        $mobile = "$mobile";
        $content = "您的验证码是："."$mcode"."【模切之家】";
        $url = "http://sms-cly.cn/smsSend.do?";

        $param = http_build_query(
            array(
                'username'=>$username,
                'password'=>$password,
                'mobile'=>$mobile,
                'content'=>$content //YHX

            )
        );
//        dump($param);die();
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$param);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    //YHX 校验手机验证码
    function check_mcode(){
        //将获取的缓存时间转换成时间戳加上180秒后与当前时间比较，小于当前时间即为过期
        if((strtotime($_SESSION['time'])+180)<time()) {
            session_destroy();
            unset($_SESSION);
            //header('content-type:text/html; charset=utf-8;');
            //echo '<script>alert("验证码已过期，请重新获取！");</script>';
            return 0;
        }
        elseif($_SESSION['mcode']!=$_POST['mcode']){
            //echo '<script>alert("验证码错误，请重新获取！");</script>';
            return 0;
        }
        else{
            return 1;
        }
    }


}