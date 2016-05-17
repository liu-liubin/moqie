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
    <script src="//cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/angular.js/1.4.9/angular.min.js"></script>
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/tigo-ui.css" type="text/css" />
    <link rel="stylesheet" href="/public/css/style.css" type="text/css" />
</head>
<body data-bg>
<header class="tigo-head container">
    <div class="top-left">
        <a href="javascript:history.back();" ><i class="fa fa-angle-left icon-back"></i></a>
    </div>
    <div class="top-title text-center">
        需求详情页
    </div>
</header>
<section class="pro-wrapper">
    <div class="xq-top clearfix container" >
        <img src="<?php echo ($dslist["avatar"]); ?>" class="pull-left xq-pic">
        <div class="pull-left xq-txt">
            <p><?php echo ($dslist["truename"]); ?></p>
            <p><?php echo ($dslist["companyname"]); ?></p>
        </div>
        <div class=" business-list ">
        <div class="pull-right business-btn">
            <button type="button" class="tigo-btn gz">+关注</button>
            <button type="button" class="tigo-btn phone"><i class="fa fa-phone "></i> </button>
        </div>
        </div>
    </div>
    <div class="xq-info container" style="background: #fff;margin-top: .6rem;padding-bottom: 60px">
        <h5 style="padding: .5rem 0;"><?php echo ($dslist["post_title"]); ?></h5>
        <?php echo ($dslist["content"]); ?>
        <div class="xq-tag">
            <span class="tags">求购<?php echo ($dslist["num"]); echo ($dslist["unit"]); ?></span>
            <p style="font-size: .68rem;color: #999">地址：<?php echo ($dslist["address"]); ?></p>
        </div>
    </div>
</section>

</body>
</html>