<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en" ng-app="myApp">
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
    <link rel="stylesheet" href="/public/css/wm-ui.css">
    <link rel="stylesheet" href="/public/css/ng-img-crop.css" type="text/css" />
    <style>
        /*body{font-family: "Microsoft YaHei";background: #fff;}
        .text-right{text-align: right ;}.text-left{text-align: left}
        .bar-nav .publish{color: #df9153;padding: 0 .62rem;font-size: .7rem;border: solid 0.05rem #df9153;  }
        .bar-nav .back{ color: rgb(226,36,46); }
        .bar-nav{ border-bottom: solid 0.05rem #DDDDDD;   }
        .list-block .item-link{padding-left: 0;}
        .list-block .item-link .item-inner{padding-left: .5rem;margin-left: 0;}
        .textarea{margin: 0 .5rem;background: #f1f1f1;height: 5rem;}*/
        .wm-input>label{line-height: 2rem}
        .wm-input>input{text-align: right;}
        .wm-input{padding: .2rem .6rem;border-bottom:solid 1px #eee;}
        .item-title{margin: .6rem 0;font-size: 1rem;}
        .item-after{margin-bottom: .6rem;font-size: .8rem;}
        .title img.pic{position: absolute;top:50%;right: .6rem;transform:translateY(-50%);}
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
<body ng-controller="myCtrl">
<header class="wm-head">
    <a class="back" href="<?php echo U('portal/index/index');?>">  </a>
    <h1 >完善企业资料</h1>
</header>
<div class="content">
    
        <div class="wm-input" >
            <div class="title">
                <h2 class="item-title">公司名称</h2>
                <h3 class="item-after"><input type="text" form="form22" name="companyname" style="background:transparent;border:none;" value="<?php echo ((isset($user["companyname"]) && ($user["companyname"] !== ""))?($user["companyname"]):''); ?>" placeholder="请填写公司名称" /></h3>
                <img ng-click="editTx()" class="pic" src="<?php echo ($user["logo"]); ?>" style="width: 3rem;height: 3rem;" />
            </div>
        </div>
        <div style="padding:0.5rem;height:16rem;" ng-show="showEditTx">
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
        </div>
    <form ajax-form id="form22" name="form22" onsubmit="return false" action='<?php echo U("user/center/do_reg_company");?>' method="post">
        <div  class="wm-input">
            <label>公司地址</label>
            <div class="input">
                <input type="text" class="text-right" placeholder="请填写公司地址" name="company_add" value="<?php echo ($user["company_add"]); ?>" />
                <img src="/public/images/prev2.png" style="width: .6rem" />
            </div>
        </div>
        <div class="wm-input">
            <label>主营业务</label>
            <div class="input">
                <input type="text" class="text-right" placeholder="请填写主营业务" name="primarybusiness" value="<?php echo ($user["primarybusiness"]); ?>"/>
                <img src="/public/images/prev2.png" style="width: .6rem" />
            </div>
        </div>
        <div class="wm-input">
            <label>客户群体</label>
            <div class="input">
                <input type="text" class="text-right" placeholder="请填写客户群体" name="customer_groups" value="<?php echo ($user["customer_groups"]); ?>"/>
                <img src="/public/images/prev2.png" style="width: .6rem" />
            </div>
        </div>
        <div class="wm-input">
            <label>邮箱</label>
            <div class="input">
                <input type="text" class="text-right" placeholder="请填写邮箱" name="customer_email" value="<?php echo ($user["customer_email"]); ?>"/>
                <img src="/public/images/prev2.png" style="width: .6rem" />
            </div>
        </div>
        <div class="wm-input" style="border:none;padding-top: 1rem">
            <textarea style="width: 100%;background: #fafafa;border-color:#eee;height: 7rem;padding: .6rem" placeholder="请填写您的企业简介" name="company_jianjie"><?php echo ($user["company_jianjie"]); ?></textarea>
        </div>
        <div style="padding: 1rem .6rem;">
            <button class="wm-btn btn-danger">确定</button>
        </div>
    </form>
</div>
<script>
    var app = angular.module("myApp",['ngFileUpload','ngImgCrop']);
    app.controller("myCtrl",function($scope, Upload, $timeout, $http){

         $scope.showEditTx = false;
         $scope.editTx = function(){
            $scope.showEditTx = !$scope.showEditTx;
         }

        $scope.upload = function (dataUrl, picFile) {
            Upload.upload({
                url: '<?php echo U("user/center/reg_company");?>',
                data: {
                    test:'testword',
                    status:true,
                    pic: picFile,
                    file: Upload.dataUrltoBlob(dataUrl, picFile.name)
                },
            }).then(function (response) {
                $timeout(function () {
                    $scope.result = response.data;
                });
                window.location.reload();
                // console.log('ok');
                // console.log(response);
            }, function (response) {
                if (response.status > 0) $scope.errorMsg = response.status 
                    + ': ' + response.data;
            }, function (evt) {
                $scope.progress = parseInt(100.0 * evt.loaded / evt.total);
            });
        }
    })

</script>
<script type="text/javascript" module="myApp" src="/public/angular.tips.js"></script>
</body>
</html>