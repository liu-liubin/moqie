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
    <link rel="stylesheet" href="/public/css/wm-ui.css" type="text/css" />
    <style>
        .info-wrapper ul li{border-bottom: solid 1px #e1e1e1;}
        .info-wrapper .top{height: 5rem;line-height: 4rem;}
        
        .wm-ng-group{margin-bottom: .6rem;}
        .wm-ng-radio{border:none;padding: .3rem 1rem;border-radius:.2rem;font-size: .8rem;}
        .wm--poper{position: absolute;top:0;height: 100%;width: 100%;background: rgba(10,10,10,.5);display: none;}
        .wm--poper .wm--radio{margin-bottom: .6rem;}
        .wm--poper form{position: absolute; width: 100%; padding: 2rem 10%; bottom: 0; left: 0px;}
        .wm--poper form .radio{border:none;padding: .3rem 1rem;border-radius:.2rem;font-size: .8rem;display:inline-block;background: #eee;margin-right: .3rem}
        .wm--poper form .radio:hover{background: #F78A17;color:#fff;}
        .wm--poper form .radio>[type=radio]{width: 0;}
        .wm--input{border:solid 1px #ddd;border-radius: .2rem;height:2.2rem;background: #fff;font-size:.7rem;width:100%;margin-bottom: .6rem;padding:0 .6rem;display: }
        .wm--submit{border:solid 1px #E71823;border-radius: .2rem;height:2.2rem;background: #E71823;color:#fff;width:100%;font-size:.8rem;}
        .wm--close{position: absolute; left: .4rem;top:.4rem;display: block;width: 1rem;height: 1rem;font-size: 1rem;color:#fff;}
        .wm-list li .rigth-txt{width: 60%;overflow: hidden;text-overflow: ellipsis;word-break: normal;white-space: nowrap;}
    </style>

</head>
<body ng-app="myApp" ng-controller="myCtrl" ng-style="bodyFixed">
<header class="wm-head">
    <a class="back" href="javascript:history.back();">&nbsp;</a>
    <h1>
        完善个人资料
    </h1>
</header>
<div class="info-wrapper">
    <ul class="wm-list">
        <!--li class="top">我的头像<img class="icon pull-right" src="/public/images/prev2.png" style="width:inherit;height: 1.5rem;"/></li-->
        <li ng-click="showInput(0)">昵称<span style="color:rgb(232,119,41);"> * </span> <img class="icon pull-right" src="/public/images/prev2.png"/><div class="pull-right rigth-txt" ><span ng-bind="value0"></span>&nbsp;&nbsp;</div> </li>
        <li>手机<span style="color:rgb(232,119,41);"> * </span> <div class="pull-right"><?php echo ($user["mobile"]); ?>&nbsp;&nbsp;</div></li>
        <li ng-click="showInput(2)">姓名<img class="icon pull-right" src="/public/images/prev2.png"/> <div class="pull-right rigth-txt" ><span ng-bind="value2" ></span>&nbsp;&nbsp;</div></li>
        <li ng-click="showInput(3)">性别 <img class="icon pull-right" src="/public/images/prev2.png"/><div class="pull-right rigth-txt" ><span ng-bind="value3" ></span>&nbsp;&nbsp;</div></li>
        <li ng-click="showInput(4)">联系地址 <img class="icon pull-right" src="/public/images/prev2.png"/><div class="pull-right rigth-txt" ><span ng-bind="value4"></span>&nbsp;&nbsp;</div></li>
        <li ng-click="showInput(5)">所属公司<span style="color:rgb(232,119,41);"> * </span>  <img class="icon pull-right" src="/public/images/prev2.png"/><div class="pull-right rigth-txt"  ><span ng-bind="value5"></span>&nbsp;&nbsp;</div></li>
        <li ng-click="showInput(6)">职务 <img class="icon pull-right" src="/public/images/prev2.png"/><div class="pull-right rigth-txt"  ><span ng-bind="value6"></span>&nbsp;&nbsp;</div></li>
    </ul>
    <div class="wm-container">
    <h5 style="color:red;text-align:center;font-size:.65rem;padding:.6rem 0;" ng-bind="formError"></h5>
    <a class="wm-btn btn-danger"  href="<?php echo U('user/center/reg_company');?>" style="color:#fff;" onclick="return false;" ng-click="turnNext($event)">继续完善企业信息</a>
    <a class="wm-btn btn-danger" onclick="return false;" ng-click="turnNext($event)" href="<?php echo U('portal/mine/index');?>" style="margin-top: .6rem;background: #fff;border: solid 1px #E9000D;color:#E9000D;">跳过企业信息完善</a>
    </div>

</div>
<div class="wm--poper" ng-style="popStyle" ng-click="popStyle={'display':'none'}">
    <div style="" >
    <form method="post" ng-click='$event.stopPropagation()' >
       <span ng-bind-html="formHtml|to_trusted"></span>
       <button class="wm--submit" type="button" ng-click="checkForm()" >确定提交</button>
    </form>
    </div>
    <a id="closeForm" class="wm--close" ng-click="popStyle={'display':'none'};bodyFixed={'overflow':'auto'}">X</a>
</div>
</body>
<script>
    
    var app = angular.module("myApp",[]);
    app.filter('to_trusted', ['$sce', function ($sce) {
        return function (text) {
            return $sce.trustAsHtml(text);
        };
    }]);
    app.controller("myCtrl",function($scope,$http,$timeout){
        //form表单属性
        var formMethod = "post",formAction = '<?php echo U("user/center/do_reg_info");?>';
    
        //form表单
        var forms = [];
        forms[0] = '<input type="text" name="nickname" placeholder="请输入您的昵称" class="wm--input" />';
        forms[1] = '<input type="text" placeholder="请输入您的手机" class="wm--input" />';
        forms[2] = '<input type="text" name="truename" placeholder="请输入您的姓名" class="wm--input" />';
        forms[3] = '<div class="wm--radio flex-center" ><label class="radio"><input type="radio" name="sex" value="男" />男</label><label class="radio" ><input name="sex" type="radio" value="女"/ >女</label><label class="radio"><input name="sex" type="radio" value="保密" />保密</label>';
        forms[4] = '<input type="text" name="address" placeholder="请输入联系地址" class="wm--input" />';
        forms[5] = '<input type="text" name="companyname" placeholder="请输入所属公司" class="wm--input" />';
        forms[6] = '<input type="text" name="position" placeholder="请输入职务" class="wm--input" />';

        
        //弹出修改表单事件
        $scope.showInput = function(i){
            $scope.bodyFixed = {"overflow":"hidden"}
            $scope.popStyle = {"display":"block"}
            $scope.formHtml = forms[i];
            //表单提交验证
        
            $scope.checkForm = function($event){

                switch(i){
                    case 0:
                        $scope.formData = {nickname:document.forms[0].nickname.value}
                        $scope.value0 = document.forms[0].nickname.value;
                    break;
                    case 1:
                       // $scope.formData = {truename:document.forms[0].nickname.value}
                    break;
                    case 2:
                        $scope.formData = {truename:document.forms[0].truename.value}
                        $scope.value2 = document.forms[0].truename.value;
                    break;
                    case 3:
                        $scope.formData = {sex:document.forms[0].sex.value}
                        $scope.value3 = document.forms[0].sex.value;
                    break;
                    case 4:
                        $scope.formData = {address:document.forms[0].address.value}
                        $scope.value4 = document.forms[0].address.value;
                    break;
                    case 5:
                        $scope.formData = {companyname:document.forms[0].companyname.value}
                        $scope.value5 = document.forms[0].companyname.value;
                    break;
                    case 6:
                        $scope.formData = {position:document.forms[0].position.value}
                        $scope.value6 = document.forms[0].position.value;
                    break;
                }
                $http.post(formAction,$scope.formData).success(function(data){

                })
                $scope.popStyle  = {"display":"none"}
                //return false;
                //return false;
            }
        }

        //校验是否允许进入到下一步
        $scope.turnNext =  function($event){
            //console.log($event.target.href);
            if(!$scope.value0){
                 $scope.formError = "请输入您的昵称";
                     $timeout(function(){
                     $scope.formError = "";
                },2000)
                 return false;
            }else if(!$scope.value5){
                $scope.formError = "请输入所属公司";
                $timeout(function(){
                     $scope.formError = "";
                },2000)
                return false;
            }else{
                location.href=$event.target.href;
            }

        }
        /* document.body.onclick = function(){
         div.style.bottom = "-50%";
         }*/
    })

</script>
</html>