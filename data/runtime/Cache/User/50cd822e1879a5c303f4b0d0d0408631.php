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
        .reg-form .wm-input{
            border-bottom:solid 1px #eee;padding: .6rem 0;
        }
    </style>
</head>
<body ng-app="ngReg" ng-controller="ngRegCtrl">
<header class="wm-head container" style="background: #fff">
    <div class="rol-flex-between">
    <a href="javascript:history.back();" class="back" ></a>
    </div>
    <h1>
        新用户注册
    </h1>
</header>
<a href="/"><img src="/public/images/logo.png" /></a>
<section class="reg-wrapper" >
    <form id="regForm" name="regForm" class="reg-form" ng-init="" method="post" action="/user/register/doregister">
        <div class="wm-input">
            <input type="text" ng-blur="checkPhone($event)" name="mobile"  ng-model="f.mobile" ng-pattern="mobile" placeholder="请输入您的手机号码" />
        </div>
        <div class="wm-input">
            <input type="text"  name="mcode" placeholder="请输入短信验证码" ng-model="f.smscode"  required />
            <button class="get-code"  ng-click="getCode()"  ng-disabled="codeDisabled" type="button"><span ng-bind="t"></span><span ng-bind="codeTip">获取验证码</span></button>
        </div>
        <div class="wm-input">
            <input type="password" name="password" ng-model="f.password" ng-minlength="6" ng-maxlength="16" placeholder="请设置您的密码" />
        </div>
        <div style="margin-top: 1.8rem;padding:0 .6rem;">
        <button class="wm-btn btn-danger" type="button" ng-click="submitTips({f:[{mobile:''},{smscode:''},{password:''}]})">确定</button>
        </div>
    </form>
</section>
</body>
<script type="text/javascript" src="/public/js/layer/layer.js"></script>
<script src="/public/js/wm-js.js"></script>
</html>