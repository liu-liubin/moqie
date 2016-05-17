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
    <link rel="stylesheet" href="css/wm-ui.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />

</head>
<body ng-app="myApp">
<header class="wm-head wm-container">
    <a href="javascript:history.back();" class="back" ></a>
    <h1>
        资讯
    </h1>
</header>
<section class="news-wrapper" ng-controller="tabCtrl">
    <nav class="news-nav">
        <ul>
            <li ng-click="getNews($index,x.contents)" class="{{x.active}}" ng-repeat="x in tabMenu" ><span ng-bind="x.title"></span><label class="label {{x.color}}">hot</label></li>
            <!--<li  ng-click="getNews()">活动<label class="label label-ah">hot</label></li>
            <li  ng-click="getNews()">行业<label class="label">hot</label></li>-->
        </ul>
    </nav>
    <article class="container">
        <ul class="news-list">
            <li ng-repeat="x in content"><a href="newsinfo.html">
                <h3 ng-bind="x.title"></h3>
                <div class="news-content clearfix" >
                    <div class="text" >这是内容！这是内容！这是内容！这是内容！这是内容！
                        <h5 class="clearfix"><span class="pull-left">56次</span> <span class="pull-right">10分钟前</span></h5>
                    </div>
                    <div class="img">
                        <img src="images/news.jpg"  />
                    </div>
                </div></a>
            </li>
           <!-- <li>
                <h3>这是标题，这是标题，这是标题，这是标题，这是标题，这是标题</h3>
                <div class="news-content clearfix" >
                    <div class="text" >这是内容！这是内容！这是内容！这是内容！这是内容！
                        <h5 class="clearfix"><span class="pull-left">56次</span> <span class="pull-right">10分钟前</span></h5>
                    </div>
                    <div class="img">
                        <img src="images/news.jpg"  />
                    </div>
                </div>
            </li>
            <li>
                <h3>这是标题，这是标题，这是标题，这是标题，这是标题，这是标题</h3>
                <div class="news-content clearfix" >
                    <div class="text" >这是内容！这是内容！这是内容！这是内容！这是内容！
                        <h5 class="clearfix"><span class="pull-left">56次</span> <span class="pull-right">10分钟前</span></h5>
                    </div>
                    <div class="img">
                        <img src="images/news.jpg"  />
                    </div>
                </div>
            </li>
            <li>
                <h3>这是标题，这是标题，这是标题，这是标题，这是标题，这是标题</h3>
                <div class="news-content clearfix" >
                    <div class="text" >这是内容！这是内容！这是内容！这是内容！这是内容！
                        <h5 class="clearfix"><span class="pull-left">56次</span> <span class="pull-right">10分钟前</span></h5>
                    </div>
                    <div class="img">
                        <img src="images/news.jpg"  />
                    </div>
                </div>
            </li>-->
        </ul>
    </article>
</section>
<footer class="footer">
    <dl class="nav-list">
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
    <dl class="nav-list active">
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
    var app = angular.module("myApp",[]);
        app.controller("tabCtrl",function($scope){
            $scope.tabMenu = [
                {title:'技术',color:'',active:"active",contents:[{title:"技术新闻技术新闻技术新闻技术新闻技术新闻。",content:"这是内容111111111"},{title:"技术新闻2技术新闻2技术新闻2技术新闻技2术新闻。",content:"这是内容22222"}]},
                {title:"活动",color:'label-ah',active:"",contents:[{title:"活动新闻活动新闻活动新闻活动新闻活动新闻。",content:"这是内容111111111"}]},
                {title:"行业",color:'',active:"",contents:[{title:"行业新闻行业新闻行业新闻行业新闻行业新闻",content:"这是内容22222"}]}
            ]
            $scope.content = $scope.tabMenu[0].contents;
            $scope.getNews = function(n,content){
                angular.forEach($scope.tabMenu,function(v,k){
                    $scope.tabMenu[k].active = "";
                })
                $scope.tabMenu[n].active = 'active';
                $scope.content = content;
            }
        });
</script>
</body>
</html>