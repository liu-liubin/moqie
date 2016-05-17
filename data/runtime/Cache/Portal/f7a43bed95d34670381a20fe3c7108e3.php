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
    <![endif]-->
    <link rel="stylesheet" href="/public/css/tigo-ui.css" type="text/css" />
    <link rel="stylesheet" href="/public/css/style.css" type="text/css" />

</head>
<body >
<header class="wm-head container">
    <a href="javascript:history.back();" class="back" ></a>

    <h1>
        资讯详情
    </h1>
</header>
<section class="">
    <article class="news-detail">
        <h1><?php echo ($posts["post_title"]); ?></h1>
        <time class="time"><?php echo ($posts["post_date"]); ?></time>
        <hr />
        <div class="news-info">
            <?php echo ($posts["post_content"]); ?>
        </div>
    </article>
    <section class="news-related">
        <h3>相关资讯</h3>
        <ul class="related-list">
            <?php if(is_array($posts_clo)): foreach($posts_clo as $key=>$vo): ?><li><a href=""><?php echo ($vo["post_title"]); ?></a></li><?php endforeach; endif; ?>
        </ul>
    </section>
</section>
<?php $smeta=json_decode($posts_tuijian['smeta'],true); ?>
<?php if(!empty($smeta['thumb'])): ?><a href="/portal/posts/newsinfo?newsid=<?php echo ($posts_tuijian["id"]); ?>"><img src="<?php echo sp_get_asset_upload_path($smeta['thumb']);?>"/></a>
    <!-- <a href="<?php echo sp_get_asset_upload_path($smeta['thumb']);?>" target='_blank'>查看</a> --><?php endif; ?>
<!-- <a href='<?php echo U("portal/posts/userinfo");?>?newsid=<?php echo ($posts_tuijian["id"]); ?>'><img src="<?php echo ($posts_tuijian["thumb"]); ?>"/></a> -->
<!-- <a href="/portal/posts/newsinfo?newsid=<?php echo ($posts_tuijian["id"]); ?>"><img src="<?php echo ($posts_tuijian["thumb"]); ?>"/></a> -->
</body>
</html>