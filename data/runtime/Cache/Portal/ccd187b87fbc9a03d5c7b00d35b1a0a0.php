<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0,minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>模切之家</title>
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="renderer" content="webkit" />
    <script src="//cdn.bootcss.com/angular.js/1.4.9/angular.min.js"></script>
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/tigo-ui.css" type="text/css" />
    <link rel="stylesheet" href="/public/css/style.css" type="text/css" />
</head>
<body >
<header class="wm-head" style="z-index:0">
    
        <a href="javascript:history.back();"  class="back"></a>
    <h1>
        需求详情页
    </h1>
</header>
<section class="pro-wrapper">
    <div class="xq-top clearfix container" >
        <img src="<?php echo ($dslist["avatar"]); ?>" class="pull-left xq-pic">
        <div class="pull-left xq-txt">
            <p><?php echo ($dslist["user_nicename"]); ?></p>
            <p><?php echo ($dslist["companyname"]); ?></p>
        </div>
        <div class=" business-list ">
        <div class="pull-right business-btn" style="width:3rem;">
            <a href='<?php echo U("user/favorite/do_dsfav");?>&id=<?php echo ($dslist["id"]); ?>'><button type="button" class="tigo-btn gz" style="width:3rem;margin-top:.3rem"><?php echo ($dslist["isfav"]); ?></button></a>
            <a href="tel:<?php echo ($dslist["mobile"]); ?>"><button type="button" class="tigo-btn phone" style="width:3rem;margin-top:.35rem;"><i class="fa fa-phone "></i> </button></a>
        </div>
        </div>
    </div>
    <div class="xq-info container" style="background: #fff;border-top:solid .6rem #eee;padding-bottom: 60px">
        <h5 style="padding: .5rem 0;"><?php echo ($dslist["post_title"]); ?></h5>
        <p style="font-size: .65rem;color: #999;"><?php echo ($dslist["post_content"]); ?></p>
        <div class="clearfix" style="padding: .6rem 0">
            <img src="<?php echo ($dslist["img1"]); ?>" style="width: 5rem" class="pull-left"/>
            <?php if($dslist["img2"] =='/data/upload/nopic.gif'): else: ?><img src="<?php echo ($dslist["img2"]); ?>" style="width: 5rem" class="pull-left" /><?php endif; ?>
        </div>
        <div class="xq-tag" style="display:flex;flex-wrap: wrap;">
            <span class="tags">求购<?php echo ($dslist["num"]); echo ($dslist["unit"]); ?></span><?php if(is_array($dslist['tags'])): foreach($dslist['tags'] as $key=>$v): ?><span class="tags"><?php echo ($v["title"]); ?></span>&nbsp;<?php endforeach; endif; ?>
            <p style="font-size: .68rem;color: #999">地址：<?php echo ($dslist["address"]); ?></p>
        </div>
    </div>
</section>

</body>
</html>