<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0,minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />  
    <title>模切之家</title>
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="renderer" content="webkit" />
    <script src="//cdn.bootcss.com/angular.js/1.4.9/angular.js"></script>
    <link rel="stylesheet" href="/public/css/wm-ui-v1.2.css" type="text/css" />
    <style>
        .get-code{
            position: absolute;
            z-index: 11;
            top: .4rem;
            right: .6rem;
            background: #E9000D;
            border: none;
            color: #fff;
            height: 1.7rem;
            font-size: .8rem;
            padding: 0 .5rem;
            border-radius: .2rem;
        }
        form .wm-input{
            border-bottom:solid 1px #eee;padding: .6rem 0;
        }
    </style>
</head>
<body ng-app="ngReg">
<header class="wm-head container" style="background: #fff">
    <div class="col-flex-between">
    <a href="javascript:history.back();" class="back" ></a>
    </div>
    <h1>
        新用户注册
    </h1>
</header>
<a href="/"><img src="/public/images/logo.png" /></a>
<section class="reg-wrapper" >
    <form ajax-form  method="post" onsubmit="return false" action="<?php echo U(user/register/doregister);?>">
        <div class="wm-input">
            <input validate required="false" ng-false="手机号码输入有误" ng-type="m" type="text" ng-model="ngPhone" name="mobile"  placeholder="请输入您的手机号码" />
        </div>
        <div class="wm-input" ng-controller="codeCtrl">
            <input  type="text"  name="mcode" placeholder="请输入验证码"  />
            <button class="get-code"  ng-click="getCode()"  ng-disabled="codeDisabled" type="button"><span ng-bind="t"></span><span ng-model="codeTip" ng-bind="codeTip='获取验证码'">获取验证码</span></button>
        </div>
        <div class="wm-input">
            <input validate ng-false="密码格式正确" ng-min="6" ng-max="16" type="password" name="password" placeholder="请设置您的密码" />
        </div>
        <div style="margin-top: 1.8rem;padding:0 .6rem;">
        <button  class="wm-btn btn-danger" type="submit"  >确定</button>
        </div>
    </form>
</section>
</body>
<script>
var app = angular.module("ngReg",[]);
app.controller("codeCtrl",function($scope,$interval,$http){
     $scope.getCode = function(){
        if($scope.ngPhone){
            $http.get('/index.php?g=user&m=register&a=mobile_code&mobile='+$scope.ngPhone);
            $scope.codeDisabled = true;
            $scope.t = 60;
            var timePromise = $interval(function(){
                $scope.t -= 1;
                if($scope.t < 1){
                    $interval.cancel(timePromise);
                    timePromise = undefined;
                    $scope.t = "";
                    $scope.codeTip = "获取验证码";
                    $scope.codeDisabled = false;
                }
            }, 1000, 100);
            /*console.log(timePromise);
            if($scope.t < 1){
                $interval.cancel(timePromise);
                timePromise = undefined;
            }*/
            $scope.codeTip = "秒后再次发送";
        }
    }
})
</script>
<script type="text/javascript" module="ngReg"  src="/public/angular.tips.js"></script>
</html>