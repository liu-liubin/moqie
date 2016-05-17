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
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/??sm.min.css,sm-extend.min.css">
    <style>
        body{font-family: "Microsoft YaHei"}
        .text-right{text-align: right ;}.text-left{text-align: left}
        .bar-nav .publish{
            color: #df9153;
            padding: 0 .62rem;
            font-size: .7rem;
            border: solid 0.05rem #df9153;
        }
        .bar-nav .back{
            color: rgb(226,36,46);;
        }
        .bar-nav{
            border-bottom: solid 0.05rem #DDDDDD;
        }
        .mfeed-img{
            width: 4.5rem;
        }
        .mfeed-img img{
            width: 3.5rem;
            margin-top: .5rem;
        }
        .mfeed-cont{
            padding-top: .5rem ;
            font-size: .71rem;
        }
        .mfeed-cont .tit{
            border-bottom:dashed 0.05rem #999;
            margin-bottom: .5rem;
        }
        .mfeed-cont .tag{
            margin-bottom: .3rem;
        }
        .mfeed-cont .tag span{
            border: solid 0.05rem #ec6941;
            color: #ec6941;
            padding: 0 .3rem;
            margin-right: .5rem;
        }
        .mfeed-cont .other{
            color:#ed6941;
        }
        .mfeed-info{
            font-size: .71rem;
            color: #aaa;
        }
        .mfeed-list{
            background: #fff;
            margin: 0;
            padding: .3rem .5rem;
            border-bottom:solid  .6rem #eee;
        }
    </style>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/??sm.min.js,sm-extend.min.js' charset='utf-8'></script>
</head>
<body>
<header class="bar bar-nav">
    <button onclick="history.back()" class="button button-link button-nav pull-left">
        <span class="icon icon-left back"></span>
    </button>
    <a href="<?php echo UU('portal/dslist/publish');?>">
        <button class="button pull-right publish">
            +发布
        </button>
    </a>
    <h1 class="title">我的需求</h1>
</header>
<div class="content">

    <?php if(is_array($dslist)): foreach($dslist as $key=>$vo): ?><div class="content-padded grid-demo mfeed-list">
            <div class="clearfix">
                <div class="mfeed-img pull-left">
                    <img src="<?php echo ($vo["img1"]); ?>" />
                </div>
                <div class="mfeed-cont pull-left">
                    <div class="tit"><span class="type"><?php echo ($vo["ds"]); ?></span><?php echo ($vo["title"]); ?></div>
                    <div class="tag" ><?php if(is_array($vo['tags'])): foreach($vo['tags'] as $key=>$v): ?><span><?php echo ($v["title"]); ?></span><?php endforeach; endif; ?></div>
                    <div class="other"><?php echo ($vo["price"]); ?>/<?php echo ($vo["unit"]); ?></div>
                </div>
            </div>
            <div class="row mfeed-info">
                <div class="col-50"><?php echo ($vo["companyname"]); ?></div>
                <div class="col-50 text-right"><?php echo ($vo["post_modified"]); ?></div>
            </div>
        </div><?php endforeach; endif; ?>
</div>
<!--<section class="container mfeed">
    <ul class="mfeed-list">
        <li class="clearfix">
            <div class="mfeed-img pull-left">
                <img src="images/menu_02.png" />
            </div>
            <div class="mfeed-cont pull-left" >
                <h3 class="tit"><a href="proinfo.html" ><span class="type">供</span>韩国裕屋UY-935保护膜0.25MM</a></h3>
                <div class="tags">
                    <span>透明</span>
                    <span>单层</span>
                    <span>高效</span>
                    <span>耐用</span>
                </div>
                <h3 class="price">450/卷</h3>
            </div>
        </li>
        <h3 class="other" style="width: 100%;display: flex;justify-content: space-between"><span>东莞市模切之家有限公司</span>  <span>2016-01-01</span></h3>
    </ul>
</section>-->
</body>
</html>