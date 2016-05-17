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
    <script src="//cdn.bootcss.com/angular.js/1.4.9/angular.js"></script>
    <script src="/public/js/ng-file-upload-shim.js"></script>
    <script src="/public/js/ng-file-upload.js"></script>
    <script src="/public/js/ng-img-crop.js"></script>
    <link rel="stylesheet" href="/public/css/wm-ui.css" type="text/css" />
    <link rel="stylesheet" href="/public/css/ng-img-crop.css" type="text/css" />
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

        /*上传样式*/
        .cropArea {
            box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box; 
            background: #E4E4E4;
            overflow: hidden;
            width:100%;
            height:12rem;
        }
        form .progress {
            line-height: 15px;
        }
        .progress {
            display: inline-block;
            width: 100px;
            border: 3px groove #CCC;
        }
        .progress div {
            font-size: smaller;
            background: orange;
            width: 0;
        }
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>

</head>
<body ng-app="myApp" ng-controller="myCtrl">
<header class="wm-head">
    <a class="back" href="javascript:history.back();">&nbsp;</a>
    <h1>
        个人资料
    </h1>
</header>
<div class="info-wrapper">
    <ul class="wm-list">
       <li class="top" ng-click="editTx()">我的头像<div class="icon pull-right" style="background: url('<?php echo ($user["avatar"]); ?>') no-repeat center center;background-size: contain;width: 3.5rem;height:3.5rem;border-radius: 3.5rem;"> </div>
        </li>
        <li style="height:16rem;" ng-show="showEditTx">
            <form name="myForm" method="post" enctype="multipart/form-data">
            <div style="display:flex;flex-direction:column;width:100%;">
                <div ngf-drop ng-model="picFile" ngf-pattern="image/*" class="cropArea">
                    <img-crop image="picFile  | ngfDataUrl" result-image="croppedDataUrl" ng-init="croppedDataUrl=''">
                    </img-crop>
                </div>

                <div style="margin-bottom: 0.5rem;margin-top: 0.5rem;">
                    <button style="background:none;padding:6px 12px;border:1px solid #ccc;font-size: 0.7rem;font-family: '微软雅黑';" ngf-select ng-model="picFile" accept="image/*">选择头像</button>
                    <button style="background:none;padding:6px 12px;border:1px solid #ccc;font-size: 0.7rem;font-family: '微软雅黑';" ng-click="upload(croppedDataUrl, picFile)">上传头像</button> 
                    <span ng-show="result">上传成功</span>
                    <span class="err" ng-show="errorMsg">{{errorMsg}}</span>
                </div>

            </div>
            </form>
        </li>
        <li ng-click="showInput(0)">昵称<span style="color:rgb(232,119,41);">（必填）</span> <img class="icon pull-right" src="/public/images/prev2.png"/><div class="pull-right "><span ng-bind="value0"></span>&nbsp;&nbsp;</div> </li>
        <li>手机<span style="color:rgb(232,119,41);">（必填）</span> <div class="pull-right"><?php echo ($user["mobile"]); ?>&nbsp;&nbsp;</div></li>
        <li ng-click="showInput(2)">姓名<img class="icon pull-right" src="/public/images/prev2.png"/> <div class="pull-right"><span ng-bind="value2"></span>&nbsp;&nbsp;</div></li>
        <li ng-click="showInput(3)">性别 <img class="icon pull-right" src="/public/images/prev2.png"/><div class="pull-right"><span ng-bind="value3"></span>&nbsp;&nbsp;</div></li>
        <li ng-click="showInput(4)">联系地址 <img class="icon pull-right" src="/public/images/prev2.png"/><div class="pull-right"><span ng-bind="value4"></span>&nbsp;&nbsp;</div></li>
        <li ng-click="showInput(5)">所属公司  <img class="icon pull-right" src="/public/images/prev2.png"/><div class="pull-right"><span ng-bind="value5"></span>&nbsp;&nbsp;</div></li>
        <li ng-click="showInput(6)">职务 <img class="icon pull-right" src="/public/images/prev2.png"/><div class="pull-right"><span ng-bind="value6"></span>&nbsp;&nbsp;</div></li>
    </ul>
</div><div class="wm--poper" ng-style="popStyle" ng-click="popStyle={'display':'none'}">
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
        /*var pdiv = document.createElement("div");
        pdiv.style = 'position:fixed;height:100%;width:100%;background:rgba(40,40,40,.5);bottom:-110%;';
        var form = document.createElement("div");
        form.style = 'position:absolute;width:100%;padding:2rem 10%;bottom:0;left:0;';
        var close = document.createElement("a");
        close.setAttribute("id","closeForm");
        close.setAttribute("class","wm--close");
        close.innerHTML = "X";
        pdiv.appendChild(form);//form+close;
        pdiv.appendChild(close);*/
        /*document.body.appendChild(pdiv);
        document.getElementById("closeForm").onclick = function(){
            pdiv.style.bottom = "-100%";
        }*/
        //form表单
        var forms = [];
        forms[0] = '<input type="text" name="nickname" placeholder="请输入您的昵称" class="wm--input" />';
        forms[1] = '<input type="text" placeholder="请输入您的手机" class="wm--input" />';
        forms[2] = '<input type="text" name="truename" placeholder="请输入您的姓名" class="wm--input" />';
        forms[3] = '<div class="wm--radio" ><label class="radio"><input type="radio" name="sex" value="男" />男</label><label class="radio" ><input name="sex" type="radio" value="女"/ >女</label><label class="radio"><input name="sex" type="radio" value="保密" />保密</label>';
        forms[4] = '<input type="text" name="address" placeholder="请输入联系地址" class="wm--input" />';
        forms[5] = '<input type="text" name="companyname" placeholder="请输入所属公司" class="wm--input" />';
        forms[6] = '<input type="text" name="position" placeholder="请输入职务" class="wm--input" />';

        $scope.value0 = '<?php echo ($user["nickname"]); ?>';
        $scope.value1 = '<?php echo ($user["mobile"]); ?>';
        $scope.value2 = '<?php echo ($user["truename"]); ?>';
        $scope.value3 = '<?php echo ($user["sex"]); ?>';
        $scope.value4 = '<?php echo ($user["address"]); ?>';
        $scope.value5 = '<?php echo ($user["companyname"]); ?>';
        $scope.value6 = '<?php echo ($user["position"]); ?>';
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
        /* document.body.onclick = function(){
         div.style.bottom = "-50%";
         }*/

         /**上传插件**/
         $scope.showEditTx = false;
         $scope.editTx = function(){
            $scope.showEditTx = !$scope.showEditTx;
         }

        
        $scope.upload = function (dataUrl, picFile) {
            Upload.upload({
                url: '<?php echo U("user/center/do_reg_info");?>',
                data: {
                    test:'test word',
                    pic: picFile,
                    file: Upload.dataUrltoBlob(dataUrl, picFile.name)
                },
            }).then(function (response) {
                $timeout(function () {
                    $scope.result = response.data;
                });
                window.location.reload();
                // console.log(response);
            }, function (response) {
                if (response.status > 0) $scope.errorMsg = response.status 
                    + ': ' + response.data;
            }, function (evt) {
                $scope.progress = parseInt(100.0 * evt.loaded / evt.total);
            });
    })
</script>
</html>