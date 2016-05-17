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
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="/public/css/wm-ui.css" />
    <link type="text/css" rel="stylesheet" href="/public/css/style.css" />
    <style>
        /*body{font-family: "Microsoft YaHei"}
        .text-right{text-align: right ;}.text-left{text-align: left}
        .bar-nav .publish{color: #df9153;padding: 0 .62rem;font-size: .7rem;border: solid 0.05rem #df9153;  }
        .bar-nav .back{ color: rgb(226,36,46); }
        .bar-nav{ border-bottom: solid 0.05rem #DDDDDD;   }
        .mfeed-img{  width: 4.5rem;  }
        .mfeed-img img{  width: 3.5rem; margin-top: .5rem;  }
        .mfeed-cont{  padding-top: .5rem ;  font-size: .71rem; }
        .mfeed-cont .tit{ border-bottom:dashed 0.05rem #999;   margin-bottom: .5rem;  }
        .mfeed-cont .tag{ margin-bottom: .3rem;font-size: .65rem }
        .mfeed-cont .tag span{ border: solid 0.05rem #ec6941;color: #ec6941;padding: 0 .25rem;margin-right: .5rem; }
        .mfeed-cont .other{ color:#ed6941; }
        .mfeed-btn {padding-left: .9rem}
        .mfeed-btn .button{width: 100%;margin-top: .6rem;height: 1.62rem;}
        .mfeed-info{font-size: .71rem;color: #aaa; }
        .mfeed-list{background: #fff; margin: 0; padding: .3rem .5rem; border-bottom:solid  .6rem #eee;}
        .mfeed-list-box{display: flex; -webkit-justify-content: space-between; -moz-justify-content: space-between; -ms-justify-content: space-between;  -o-justify-content: space-between;justify-content: space-between;}*/
        .pro-list li{padding: .5rem .6rem;font-size: .75rem;border-bottom: solid .6rem #eee;}
        .pro-left .img{
            width: 3rem;
            height:3rem;
            float:left;
            position: relative;
        }
        .pro-left .title{
            position: relative;
            padding-left: 1rem;
            margin-left: 3.4rem;
            margin-bottom: .3rem; 
            border-bottom: dashed 1px #aaa;
        }
        .pro-left .title .type{    position: absolute;
    font-size: .7rem;
    width: 1rem;
    left: 0;
    bottom: .08rem;
    height: 1rem;
    border-radius: 50%;
    background: rgb(120,163,102);;
    text-align: center;
    color: #fff;}
        .pro-right{
            width: 4rem;
            text-align: right;
        }
        .pro-left{
            position: relative;
            margin-right: 4.25rem;
            padding-top: .4rem;
        }
        .pro-left .tags{ margin-bottom: .3rem;font-size: .65rem;margin-left: 3.4rem;}
        .pro-left .tags span{ border: solid 0.05rem #ec6941;color: #ec6941;padding: 0 .25rem;margin-right: .5rem; }
        .pro-left .price{ color:#ed6941; margin-left: 3.4rem;}
        .btn-gz{
            height: 1.5rem;
            padding: 0 .2rem;
            border: solid 0.05rem #df9153;
            background: transparent;
            -webkit-border-radius: .2rem;
            -moz-border-radius: .2rem;
            border-radius: .2rem;
            color: #df9153;
            width: 3.3rem;
            margin-bottom: .2rem;
        }
    </style>
</head>
<body>
<header class="wm-head">
    <a href="javascript:history.back();" class="back"></a>
    <h1>我的关注</h1>
</header>
<div class="content">
    <ul class="pro-list">
    <?php if(is_array($dslist)): foreach($dslist as $key=>$vo): ?><li class="clearfix  ng-scope" ng-repeat="x in productList">
                <div class="pro-right pull-right">
                    <a href="user/favorite/delete_favorite?id=<?php echo ($vo["id"]); ?>"><button type="button" class="btn-gz">取消关注</button></a>
                    <a href="tel:<?php echo ($vo["mobile"]); ?>"><button type="button" class="btn-gz" style="margin-top: .3rem;"><i class="fa fa-phone "></i> </button></a>
                </div>
                <div class="pro-left ">
                    <img class="img" src="<?php echo ($vo["img1"]); ?>">
                    <h3 class="title"><span class="type"><?php echo ($vo["ds"]); ?></span><?php echo ($vo["title"]); ?></h3>
    
                    <h5 class="tags"><?php if(is_array($vo['tags'])): foreach($vo['tags'] as $key=>$v): ?><span><?php echo ($v["title"]); ?></span><?php endforeach; endif; ?></h5>
                    <h5 class="price"><span ng-bind="x.price" class="ng-binding">0</span>/<span ng-bind="x.unit" class="ng-binding"></span></h5>
                </div>
                <h5 class="other flex-between"><div ng-bind="x.companyname" class="ng-binding"></div>  <div ng-bind="x.post_modified" class="ng-binding">2016-05-13 21:04:26</div></h5>
            </li><?php endforeach; endif; ?>
        </ul>
    <!-- <fodreach name="dslist" item="vo">
        <div class="content-padded grid-demo mfeed-list">
            <div class="clearfix mfeed-list-box">
                <div class="mfeed-img pull-left">
                    <img src="<?php echo ($vo["img1"]); ?>" />
                </div>
                <div class="mfeed-cont pull-left">
                    <div class="tit"><span class="type"><?php echo ($vo["ds"]); ?></span><?php echo ($vo["title"]); ?></div>
                    <div class="tag" ><?php if(is_array($vo['tags'])): foreach($vo['tags'] as $key=>$v): ?><span><?php echo ($v["title"]); ?></span><?php endforeach; endif; ?></div>
                    <div class="other"><?php echo ($vo["price"]); ?>/<?php echo ($vo["unit"]); ?></div>
                </div>
                <div class="mfeed-btn pull-left">
                    <a href="user/favorite/delete_favorite?id=<?php echo ($vo["id"]); ?>"><button type="button" class="wm-btn ">取消关注</button></a>
                    <a href="tel:<?php echo ($vo["mobile"]); ?>"><button type="button" class="button button-warning" ><span class="icon icon-phone"></span></button></a>
                </div>
            </div>
            <div class="row mfeed-info">
                <div class="col-50"><?php echo ($vo["companyname"]); ?></div>
                <div class="col-50 text-right"><?php echo ($vo["post_modified"]); ?></div>
            </div>
        </div>
    </fodreach> -->
</div>
<footer class="footer">
    <dl class="nav-list ">
        <a href="<?php echo UU('portal/index/index');?>">
        <dd data-nav-home><!--<img src="/public/images/nav_01.png" />--> </dd>
        <dt>首页</dt>
        </a>
    </dl>
    <dl class="nav-list">
        <a href="<?php echo UU('portal/dslist/dslist');?>" >
        <dd data-nav-market><!--<img src="/public/images/nav_02.png" /> --></dd>
        <dt>商城</dt>
        </a>
    </dl>
    <dl class="nav-list">
        <a href="<?php echo UU('portal/posts/news');?>" >
        <dd data-nav-news></dd>
        <dt>资讯</dt>
        </a>
    </dl>
    <dl class="nav-list active">
        <a href="<?php echo UU('portal/mine/index');?>" >
        <dd data-nav-my></dd>
        <dt>我的</dt>
        </a>
    </dl>
</footer>
</body>
</html>