<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0,minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <meta name="browsermode" content="application">
    <title>模切之家</title>
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="renderer" content="webkit" />
    <script src="//cdn.bootcss.com/angular.js/1.4.9/angular.min.js"></script>
    <!--[if lt IE 9]>
    <![endif]-->
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/styles.css" type="text/css" />
    <link rel="stylesheet" href="/public/css/wm-ui.css" type="text/css" />
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
        .reg-form .wm-input{
            border-bottom:solid 1px #eee;padding: .6rem 0;
        }
    </style>

</head>
<body class="reg" ng-app="myApp" ng-controller="myCtrl">
<header class="wm-head container" style="background: #fff">
    <a href="javascript:history.back();" class="back"></a>
    <h1>
        找回密码
    </h1>

</header>
<div class="logo" style="padding:1rem 0;">
    <a href="/"><img src="/public/images/logo.png" /></a>
</div>
<section class="reg-wrapper" >
    <form id="regForm" name="regForm" class="reg-form" method="post" action="/user/login/myforgot_password">
        <div class="wm-input">
            <input type="text" name="mobile" ng-model="ngPhone" ng-pattern="regPhone" required placeholder="请输入您的手机号码" />
        </div>
        <div class="wm-input">
            <input type="text"  name="mcode" placeholder="请输入短信验证码" ng-model="ngCode" required />
            <button class="get-code"  ng-click="getCode()"  ng-disabled="codeDisabled" type="button"><span ng-bind="t"></span><span ng-bind="codeTip">获取验证码</span></button>
        </div>
        <div class="wm-input">
            <input type="password" name="password" ng-model="ngPwd" ng-minlength="6" ng-maxlength="16" placeholder="请设置您的密码" />
        </div>
        <div style="margin-top: 2rem;padding:0 .6rem;">
        <button class="wm-btn btn-danger" type="button" ng-click="submit()">确定</button>
        </div>
    </form>
</section>
</body>
<script>
var app=angular.module("myApp",[]);
    app.controller("myCtrl",function($scope,$http,$interval){
        $scope.regPhone = /^(13[0-9]|15[0|3|6|7|8|9]|18[8|9])\d{8}$/;
        //$scope.regPwd = /^[a-zA-Z0-9!@#\$%\^&\*,\.\-\+]$/;
        //$scope.regForm.mobile.$error;
        $scope.codeTip = "获取验证码";
        $scope.codeDisabled = false;
        //提交表单验证
        $scope.submit = function(){
            if($scope.ngPhone == undefined){
                alert("手机错误");
            }else if($scope.ngPwd==undefined){
                alert("密码长度不够");
            }else if(!$scope.ngCode){
                alert("请输入验证码");
            }else {
                document.getElementById("regForm").submit();
            }
        }
        $scope.getCode = function(){
            if($scope.ngPhone){
                $http.get('<?php echo UU("user/register/mobile_code");?>&mobile='+$scope.ngPhone);
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
            }else{
                alert("手机号码有误");
            }
        }
    })
</script>
</html>