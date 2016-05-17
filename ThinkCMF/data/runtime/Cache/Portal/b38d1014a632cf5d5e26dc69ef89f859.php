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
    <link rel="stylesheet" href="/public/tigo-ui.css" type="text/css" />
    <link rel="stylesheet" href="/public/style.css?555" type="text/css" />
</head>
<body ng-app="myApp">
<script>

    //document.write(window.screen.width);
</script>
<header class="header container" ng-controller="headCtrl">
    <span class="home-title pull-left" ng-click="selected()"><span ng-bind="choiceVal">产品 </span><i class="fa fa-angle-down"> </i> <ul ng-hide="xc"><li ng-click="choice('产品')">产品</li><li ng-click="choice('企业')">企业</li></ul></span>
    <div class="search pull-right">
        <form action="">
            <input type="text" name="keyword" />
            <input type="submit" value="">
        </form>
    </div>
</header>
<section class="banner">
    <img src="images/banner_01.jpg" />
</section>
<nav class="menu clearfix">
    <dl class="menu-item"><a href="market.html?##need">
        <dd><img src="images/menu_01.png" /></dd>
        <dt>最新需求</dt>
        </a>
    </dl>
    <dl class="menu-item">
        <a href="market.html">
        <dd><img src="images/menu_02.png" /></dd>
        <dt>最新供应</dt>
            </a>
    </dl>
    <dl class="menu-item">
        <dd><img src="images/menu_03.png" /></dd>
        <dt>行业资讯</dt>
    </dl>
    <dl class="menu-item">
        <dd><img src="images/menu_04.png" /></dd>
        <dt>我的关注</dt>
    </dl>
    <!--<ul class="menu-list">
        <li>
            <figure>

                <figcaption></figcaption>
            </figure>
            </li>
        <li><img src="images/menu_02.png" /> <h3>最新供应</h3></li>
        <li><img src="images/menu_03.png" /> <h3>行业资讯</h3></li>
        <li><img src="images/menu_04.png" /> <h3>我的关注</h3></li>
    </ul>-->
</nav>
<div class="clip" style="background: #f8f8f8;height: .6rem"></div>
<section class="body container">
    <div class="flex-between" style="margin: 0 -.6rem;">
    <ul class="body-list ">
        <li><div class="list-cont-01"><a href=""><h3 class="cont-tit">发布需求</h3><h3 class="cont-des">我们帮你找材料</h3></a></div> </li>
        <li><div class="list-cont-03"><h3 class="cont-tit">发布供应</h3><h3 class="cont-des">我们只推好产品</h3></div> </li>
    </ul>
    <ul class="body-list">
        <li><div class="list-cont-02"><h3 class="cont-tit">一键学习</h3><h3 class="cont-des">模切技术大搜罗</h3></div> </li>
        <li><div class="list-cont-04"><h3 class="cont-tit">最新活动</h3><h3 class="cont-des">峰值沙龙多不停</h3></div> </li>
    </ul>
    </div>
    <h2 >最新商机</h2>
    <ul class="product-list">
        <li class="clearfix ">
            <div class="pro-right pull-right">
                <button type="button" class="tigo-btn gz">+关注</button>
                <button type="button" class="tigo-btn phone"><i class="fa fa-phone "></i> </button>
            </div>
            <div class="pro-left ">
                <img class="img" src="images/menu_02.png" />
                <h3 class="title" ><span class="type">供</span> 韩国裕屋UY-935保护膜0.25MM</h3>
                <h5 class="tags"><span>透明</span><span>单层</span><span>高效</span><span>耐用</span></h5>
                <h5 class="price">450/卷</h5>
            </div>
            <h5 class="other flex-between"><div>东莞市模切之家有限公司</div>  <div>2016-01-01</div></h5>
            <!--<div class="business-img">

            </div>
            <div class="business-cont">
                <h3 class="tit"><span class="type">供</span>韩国裕屋UY-935保护膜0.25MM</h3>
                <div class="tags">
                    <span>透明</span>
                    <span>单层</span>
                    <span>高效</span>
                    <span>耐用</span>
                </div>
                <h3 class="price">450/卷</h3>
            </div>
            <div class="business-btn">
                <button type="button" class="tigo-btn gz">+关注</button>
                <button type="button" class="tigo-btn phone"><i class="fa fa-phone "></i> </button>
            </div>-->
        </li>

    </ul>
</section>
<footer class="footer">
    <dl class="nav-list active">
        <a href="index.html">
        <dd data-nav-home><!--<img src="images/nav_01.png" />--> </dd>
        <dt>首页</dt>
        </a>
    </dl>
    <dl class="nav-list">
        <a href="market.html" >
        <dd data-nav-market><!--<img src="images/nav_02.png" /> --></dd>
        <dt>商场</dt>
        </a>
    </dl>
    <dl class="nav-list">
        <a href="news.html" >
        <dd data-nav-news></dd>
        <dt>资讯</dt>
        </a>
    </dl>
    <dl class="nav-list">
        <a href="member.html" >
        <dd data-nav-my></dd>
        <dt>我的</dt>
        </a>
    </dl>
</footer>
<script>
    function getVendorPrefix() {
        // 使用body是为了避免在还需要传入元素
        var body = document.body || document.documentElement,
                style = body.style,
                vendor = ['webkit', 'khtml', 'moz', 'ms', 'o'],
                i = 0;

        while (i < vendor.length) {
            // 此处进行判断是否有对应的内核前缀
            if (typeof style[vendor[i] + 'Transition'] === 'string') {
                return vendor[i];
            }
            i++;
        }
    }

    var app = angular.module("myApp",[]);
    app.controller("headCtrl",function($scope){
        $scope.xc =true;
        $scope.selected = function(){
            $scope.xc = !$scope.xc;
        }
        $scope.choiceVal = "产品";
        $scope.choice = function(val){
            $scope.choiceVal = val;
        }
    })
</script>
</body>
</html>