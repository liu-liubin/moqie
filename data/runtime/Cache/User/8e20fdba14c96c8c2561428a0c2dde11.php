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
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/wm-ui.css" type="text/css" />
    <style>
        .wm-panel{font-size: .7rem;padding:0 .6rem;}
        .wm-panel > .title{font-weight: 600;padding: .5rem 0rem;margin: 0;}
        .wm-panel > .title > .small{font-size: .45rem;color:#999;}
        .wm-panel > .panel-body > .panel-item{padding: .6rem 0;border-bottom: solid 1px #ddd;}
        .history{display: block;height: 2rem;width: 2rem; position: absolute;top:0;left:0;}
        .his-tit{
            padding: .6rem .6rem;
            font-size: .8rem;
            border-top:solid .6rem #e9e9e9;
            border-bottom: solid 1px #eee;
            margin-top: -1px;
        }
        .history-list{font-size: .7rem;}
        .history-list li{position:relative;padding: 0 .6rem;}
        .history-list li .his-cont{padding:.8rem 0 0rem 3.8rem;}
        .history-list li .title{padding-left:.1rem;margin-bottom: .4rem;border-bottom:dashed 1px #AAA;background: url("images/circle.png") no-repeat;background-size: contain;}
        .history-list li .img{width: 3.2rem;position:absolute;top:.7rem;}
        .history-list li .tags{color:#F18869;margin: .25rem 0;}
        .history-list li .tags span{border:solid 1px #F18869;line-height: .8rem;display: inline-block;padding: 0 .33rem;}
        .history-list li .price{color:#F18869;}
        .history-list li .other{position:relative;padding: .6rem 0;color:#aaa;}
        .history-list li .other .txt{position:absolute;}
        .history-list li .other .txt:first-child{top:0;left: 0;}
        .history-list li .other .txt:last-child{top:0;right: 0;}
    </style>
</head>
<body>
<a class="history" href="javascript:history.back();"></a>
<img src="/public/images/zone-bg.jpg" />
<div class="wm-panel">
    <h3 class="title">基本信息 <span class="small"  >0人看过</span></h3>
    <div class="panel-body">
        <div class="panel-item"><span style="color: #999" >公司：</span>广东省东莞市模切之家有限公司</div>
        <div class="panel-item"><span style="color: #999" >位置：</span>广东省东莞市东城区</div>
        <div class="panel-item"><span style="color: #999" >认证：</span>已认证</div>
    </div>
</div>

<h3 class="his-tit">供应历史</h3>
<ul class="history-list">
    <li class="clearfix ">
        <a href="<?php echo UU('dslist/dslist_detail');?>">
            <img class="img" src="/public/images/menu_02.png" />
        </a>
        <div class="his-cont">
            <h3 class="title" ><span style="color: #fff;"> 供 </span> 广东省东莞市模切之家有限公司</h3>
            <h5 class="tags"><span>透明</span>&nbsp;&nbsp;<span>单层</span>&nbsp;&nbsp;<span>高效</span>&nbsp;&nbsp;<span>耐用</span></h5>
            <h5 class="price">450/卷</h5>
        </div>
        <h5 class="other"><div class="txt">东莞市模切之家有限公司</div>  <div class="txt">2016-01-01</div></h5>
    </li>
</ul>
<h3 class="his-tit">需求历史</h3>
<ul class="history-list">
    <li class="clearfix ">
        <a href="<?php echo UU('dslist/dslist_detail');?>">
            <img class="img" src="images/menu_02.png" />
        </a>
        <div class="his-cont">
            <h3 class="title" ><span style="color: #fff;"> 需 </span> 广东省东莞市模切之家有限公司</h3>
            <h5 class="tags"><span>透明</span>&nbsp;&nbsp;<span>单层</span>&nbsp;&nbsp;<span>高效</span>&nbsp;&nbsp;<span>耐用</span></h5>
            <h5 class="price">450/卷</h5>
        </div>
        <h5 class="other"><div class="txt">东莞市模切之家有限公司</div>  <div class="txt">2016-01-01</div></h5>
    </li>
</ul>
</body>
</html>