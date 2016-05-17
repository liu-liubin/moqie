<?php
namespace Portal\Controller;
use Think\Controller;
class TestController extends Controller {
	public function index(){
		//dump(file_get_contents("php://input"));
		$this->ajaxReturn(array("info"=>"545646546"));
	}
}