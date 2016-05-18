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
        <a href="javascript:history.go(-2);" ><i class="fa fa-angle-left icon-back"></i></a>
    </div>
    <div class="top-title text-center">
        <?php echo ($dslist["post_title"]); ?>
    </div>
   
</header>
<section class="pro-wrapper">
    <figure class="pro-title">
        <img src="<?php echo ($dslist["img1"]); ?>" />
        <?php if($dslist["img2"] =='/data/upload/nopic.gif'): else: ?><img src="<?php echo ($dslist["img2"]); ?>" /><?php endif; ?>
        <figcaption class="cap1 container"><?php echo ($dslist["post_title"]); ?></figcaption>
        <figcaption class="cap2 container" text-yellow style="font-size:.8rem;position:relative;"><?php if( $dslist["price"] == '面议' ): echo ($dslist["price"]); else: echo ($dslist["price"]); ?>元/<?php echo ($dslist["unit"]); endif; ?><a class="tigo-btn gz pull-right" href='<?php echo U("user/favorite/do_dsfav");?>&id=<?php echo ($dslist["id"]); ?>' style="position:absolute;bottom:0;font-size:.7rem;right:0.6rem;"><?php echo ($dslist["isfav"]); ?></a> </figcaption>
    </figure>
    <div class="pro-param container">
        <h3 class="title">产品参数</h3>
        <?php echo ($dslist["specification"]); ?>
    </div>
    <div class="pro-describe container">
        <h3 class="title">产品描述</h3>
        <?php echo ($dslist["post_content"]); ?>
    </div>
</section>
<footer class="pro-footer">
    <a href="tel:<?php echo ($dslist["mobile"]); ?>"><button class="tigo-btn" type="button"><i class="fa fa-phone"></i> </button></a>
    <a href="<?php echo U("portal/dslist/sample");?>&id=<?php echo ($dslist["id"]); ?>"><button class="tigo-btn" type="button"> +拿样</button></a>
</footer>
</body>
</html>