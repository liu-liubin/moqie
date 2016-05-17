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
    <link rel="stylesheet" href="/public/css/wm-ui.css">
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
    </style>
</head>
<body>
<header class="wm-head">
    <a class="back" onclick="javascript:history.back();">  </a>
    <h1 >企业资料</h1>
</header>
<div class="content">
    <form name="cForm" onsubmit="return submitForm()" action='<?php echo U("user/center/reg_company");?>' method="post">
        <div class="wm-input" >
            <div class="title">
                <h2 class="item-title">公司名称</h2>
                <h3 class="item-after">&nbsp;<?php echo ($user["company_name"]); ?></h3>
                <img class="pic" src="/public/images/circle.png" style="width: 3rem;height: 3rem;" />
            </div>
        </div>
        <div  class="wm-input">
            <label>公司地址</label>
            <div class="input">
                <input disabled="disabled" type="text" class="text-right" name="company_add" value="<?php echo ($user["company_add"]); ?>" />
                <img src="/public/images/prev2.png" style="width: .6rem" />
            </div>
        </div>
        <div class="wm-input">
            <label>主营业务</label>
            <div class="input">
                <input type="text" disabled="disabled" class="text-right" name="primarybusiness" value="<?php echo ($user["primarybusiness"]); ?>"/>
                <img src="/public/images/prev2.png" style="width: .6rem" />
            </div>
        </div>
        <div class="wm-input">
            <label>客户群体</label>
            <div class="input">
                <input type="text" disabled="disabled" class="text-right" name="customer_groups" value="<?php echo ($user["customer_groups"]); ?>"/>
                <img src="/public/images/prev2.png" style="width: .6rem" />
            </div>
        </div>
        <div class="wm-input">
            <label>邮箱</label>
            <div class="input">
                <input type="text" disabled="disabled" class="text-right" name="customer_email" value="<?php echo ($user["customer_email"]); ?>"/>
                <img src="/public/images/prev2.png" style="width: .6rem" />
            </div>
        </div>
        <div class="wm-input" style="border:none;padding-top: 1rem">
            <textarea  disabled="disabled" style="width: 100%;background: #fafafa;border-color:#eee;height: 7rem;padding: .6rem" placeholder="请填写您的企业简介" name="company_jianjie"><?php echo ($user["company_jianjie"]); ?></textarea>
        </div>
        <div id="submitBtn" style="padding: 1rem .6rem;display: none;">
            <button class="wm-btn btn-danger">确定</button>
        </div>
    </form>
</div>
</body>
<script type="text/javascript" src="/public/js/layer/layer.js"></script>
<script type="text/javascript">
    /*(function(){
        var q;
        window.addEventListener("focus", function(e){
            var p;

            e = e || window.event;
            p = e.target;
            //console.log(p.nodeName);
            if (p.nodeName === "INPUT" || p.nodeName === "TEXTAREA") {
                document.getElementById("submitBtn").style.display="block"
            }

        }, true)
    }())*/
    /*function submitForm(){
        var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        mail = document.cForm.customer_email.value;
        jianjie = document.cForm.company_jianjie.value;
        if(!filter.test(mail)){
            layer.open({
                content: "邮箱输入有误！",
                style: 'background-color:#EEE; color:#666; border:none;',
                time: 2
            });
            return false;
        }else if(!jianjie){
            layer.open({
                content: "请填写您的企业简介",
                style: 'background-color:#EEE; color:#666; border:none;',
                time: 2
            });
            return false;
        }else{
            return true;
        }
    }*/
</script>
</html>