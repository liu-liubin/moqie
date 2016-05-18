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
    <link rel="stylesheet" href="/public/css/wm-ui.css" type="text/css" />
    <link rel="stylesheet" href="/public/css/person.css" type="text/css" />
    <style>
        .m-head{
            background: url("/public/images/person.jpg") no-repeat;
            background-size: 100%;
            height:8rem;
            padding: 0 .6rem;
        }
        .m-preview{
            font-size: .8rem;
            height: 5rem;
            padding-top: 3rem;
            display: flex;
            -webkit-justify-content: space-between;
            -moz-justify-content: space-between;
            -ms-justify-content: space-between;
            -o-justify-content: space-between;
            justify-content: space-between;
        }
        .m-preview .pre-left *{display: inline-block;}
        .m-preview .pre-left .img{
            width: 3.2rem;
            height: 3.2rem;
            margin-top: -.4rem;
            border-radius: 3.2rem;
            background: #fff;
            float: left;
            margin-right: .5rem;
        }
        .m-preview .pre-left{
            float: left;
            color: #fff;
        }
        .m-preview .pre-right{
            float:left;
            color: #fff;
        }
        
        .m-menu ul{background: #fff;margin-top: .6rem;}
        .m-menu ul li hr{margin-top: .3rem;margin-left: 1.6rem;height: 1px;border: none;background: #ddd;margin-right: -.6rem;}
        .wm-list li{padding: .5rem .6rem .3rem .6rem;}
        .wm-list [icon]{width: 1.6rem;height: initial;display: inline-block;vertical-align: middle;}
        .wm-list [icon=title]{width: auto;}
    </style>
</head>
<body data-bg ng-app="myApp">
<header class="m-head">
    <div class="m-preview" >
        <div class="pre-left">
            <div class="img" style="background: url('<?php echo ($user["avatar"]); ?>') no-repeat center center;background-size: contain;"></div>
            <div class="htxt"><?php echo ($user["mobile"]); ?><br/><?php echo ($user["user_nicename"]); ?></div>
        </div>
        <?php if($user): ?><div class="pre-right"><a href="<?php echo UU('user/center/index');?>" >查看空间 &gt;</a></div>
            <?php else: ?><div class="pre-right"><a href="" > </a></div><?php endif; ?>

    </div>
</header>
<div class="m-menu" style="padding-bottom: 2.8rem;">
    <ul class="wm-list ">
        <a href="<?php echo UU('user/center/m_info');?>">
            <li>
                <img icon src="/public/images/person_01.png"/> &nbsp;
                <div icon="title">个人信息</div>
                <img src="/public/images/prev2.png" style="width: .6rem;float: right;">
                <hr />
            </li>
        </a>
        <a ajax-get data-action="<?php echo UU('user/center/c_info');?>">
            <li>
                <img icon src="/public/images/person_02.png"/> &nbsp;
                <div icon="title">企业信息</div>
                <img src="/public/images/prev2.png" style="width: .6rem;float: right;">
            </li>
        </a>
    </ul>
    <ul class="wm-list ">
        <a href="<?php echo UU('user/favorite/index');?>">
            <li>
                <img icon src="/public/images/person_03.png"/> &nbsp;
                <div icon="title">我的关注</div>
                <img src="/public/images/prev2.png" style="width: .6rem;float: right;">
                <hr />
            </li>
        </a>
        <a href="<?php echo UU('user/center/m_need');?>">
            <li>
                <img icon src="/public/images/person_04.png"/> &nbsp;
                <div icon="title">我的需求</div>
                <img src="/public/images/prev2.png" style="width: .6rem;float: right;">
                <hr />
            </li>
        </a>
        <a href="<?php echo UU('user/center/m_feed');?>">
            <li>
                <img icon src="/public/images/person_05.png"/> &nbsp;
                <div icon="title">我的供给</div>
                <img src="/public/images/prev2.png" style="width: .6rem;float: right;">
            </li>
        </a>
    </ul>
    <ul class="wm-list ">
        <a href="<?php echo UU('user/login/password_reset');?>">
            <li>
                <img icon src="/public/images/person_06.png"/> &nbsp;
                <div icon="title">修改密码</div>
                <img src="/public/images/prev2.png" style="width: .6rem;float: right;">
                <hr />
            </li>
        </a>
        <a href="">
            <li>
                <img icon src="/public/images/person_07.png"/> &nbsp;
                <div icon="title">操作指南</div>
                <img src="/public/images/prev2.png" style="width: .6rem;float: right;">
                <hr />
            </li>
        </a>
        <a href="javascript:;">
            <li>
                <img icon src="/public/images/person_08.png"/> &nbsp;
                <div icon="title">关于我们</div>
                <span style="float: right;padding-top:.3rem;">0769-5821564</span>
                <hr />
            </li>
        </a>
        <a href="<?php echo UU('user/index/logout');?>">
            <li>
                <img icon src="/public/images/person_09.png"/> &nbsp;
                <div icon="title">退出登录</div>
            </li>
        </a>
    </ul>
	<p>&nbsp;</p>
</div>
<footer class="footer">
    <dl class="nav-list ">
        <a href="<?php echo UU('index/index');?>">
            <dd data-nav-home><!--<img src="/public/images/nav_01.png" />--> </dd>
            <dt>首页</dt>
        </a>
    </dl>
    <dl class="nav-list">
        <a href="<?php echo UU('dslist/dslist');?>" >
            <dd data-nav-market><!--<img src="/public/images/nav_02.png" /> --></dd>
            <dt>商城</dt>
        </a>
    </dl>
    <dl class="nav-list">
        <a href="<?php echo UU('posts/news');?>" >
            <dd data-nav-news></dd>
            <dt>资讯</dt>
        </a>
    </dl>
    <dl class="nav-list active">
        <a href="<?php echo UU('mine/index');?>" >
            <dd data-nav-my></dd>
            <dt>我的</dt>
        </a>
    </dl>
</footer>
</body>
<script type="text/javascript" module="myApp"  src="/public/angular.tips.js"></script>
</html>