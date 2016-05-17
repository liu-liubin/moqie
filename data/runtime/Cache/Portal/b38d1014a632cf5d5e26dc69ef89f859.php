<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0,minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="browsermode" content="application">
    <title>模切之家</title>
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="renderer" content="webkit" />
    <script src="//cdn.bootcss.com/angular.js/1.4.9/angular.js"></script>
    <script src="//cdn.bootcss.com/angular.js/1.5.0/angular-touch.js"></script>

    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/tigo-ui.css" type="text/css" />
    <link rel="stylesheet" href="/public/css/style.css?555" type="text/css" />
    <style>
        /* Swipe 2 required styles */
        .swipe {
            overflow: hidden;
            visibility: hidden;
            position: relative;
            height:7.5rem;
        }
        .swipe-wrap {
            overflow: hidden;
            position: relative;
        }
        .swipe-wrap > div {
            float:left;
            width:100%;
            position: relative;
        }
        .swipe-wrap img{
            height: 7.5rem;
        }

        /* END required styles */
    </style>
</head>
<body ng-app="myApp" ng-controller="myCtrl"  >
<header class="header container">
    <span class="home-title pull-left" ><span>搜索产品</span>

    <!-- <span ng-bind="choiceVal">搜索产品 </span> -->

    <!-- <i class="fa fa-angle-down"> </i> <ul ng-hide="xc"><li ng-click="choice('产品')">产品</li><li ng-click="choice('企业')">企业</li></ul> -->

    </span>

    <div class="search pull-right">
        <form  action="/portal/dslist/dslist" method="get">
            <input type="text" name="name" style="width: 13rem;" />
            <input type="submit" value="">
        </form>
    </div>
</header>
    <div id='mySwipe' style='margin:0 auto' class='swipe'>
        <div class='swipe-wrap'>
            <?php if(is_array($sides)): foreach($sides as $key=>$vo): ?><div> <a href="<?php echo ($vo["slide_url"]); ?>"><img src="<?php echo ($vo["slide_pic"]); ?>" /></a></div><?php endforeach; endif; ?>

        </div>
    </div>
<nav class="menu clearfix">
    <dl class="menu-item"><a href="<?php echo UU('dslist/dslist?ds=need');?>##need">
        <dd><img src="/public/images/menu_01.png" /></dd>
        <dt>最新需求</dt>
        </a>
    </dl>
    <dl class="menu-item">
        <a href="<?php echo UU('dslist/dslist');?>">
        <dd><img src="/public/images/menu_02.png" /></dd>
        <dt>最新供应</dt>
            </a>
    </dl>
    <dl class="menu-item">
        <a href="<?php echo UU('posts/news');?>">
        <dd><img src="/public/images/menu_03.png" /></dd>
        <dt>行业资讯</dt>
        </a>
    </dl>
    <!-- yhx 20160510 -->
    <dl class="menu-item">
        <a href="<?php echo UU('user/favorite/index');?>">
        <dd><img src="/public/images/menu_04.png" /></dd>
        <dt>我的关注</dt>
        </a>
    </dl>
    <!--<ul class="menu-list">
        <li>
            <figure>

                <figcaption></figcaption>
            </figure>
            </li>
        <li><img src="/public/images/menu_02.png" /> <h3>最新供应</h3></li>
        <li><img src="/public/images/menu_03.png" /> <h3>行业资讯</h3></li>
        <li><img src="/public/images/menu_04.png" /> <h3>我的关注</h3></li>
    </ul>-->
</nav>
<div class="clip" style="background: #f8f8f8;height: .6rem"></div>
<section class="body container">
    <div class="flex-between" style="margin: 0 -.6rem;">
    <ul class="body-list ">
        <li><div class="list-cont-01"><a href="<?php echo UU('dslist/publish');?>"><h3 class="cont-tit">发布需求</h3><h3 class="cont-des">我们帮你找材料</h3></a></div> </li>
        <li><div class="list-cont-03"><a href="<?php echo UU('dslist/publish');?>"><h3 class="cont-tit">发布供应</h3><h3 class="cont-des">我们只推好产品</h3></a></div> </li>
    </ul>
    <ul class="body-list">
        <li><div class="list-cont-02"><a href="<?php echo UU('posts/news');?>"><h3 class="cont-tit">一键学习</h3><h3 class="cont-des">模切技术大搜罗</h3></a></div> </li>
        <li><div class="list-cont-04"><a href="<?php echo UU('posts/news##4');?>"><h3 class="cont-tit">最新活动</h3><h3 class="cont-des">峰会沙龙多不停</h3></a></div> </li>
    </ul>
    </div>
    <h2 >最新商机</h2>
    <ul class="product-list" ng-controller="newCtrl">
        <li class="clearfix " ng-repeat="x in newList">
            <div class="pro-right pull-right">
                <button type="button" class="tigo-btn gz" data-url='<?php echo U("user/favorite/do_dsfav");?>&id={{x.id}}' data-html="已关注" ng-click="tips($event)" ng-bind="x.attention"></button>
                <a href="{{x.mobile}}"><button type="button" class="tigo-btn phone"><i class="fa fa-phone "></i> </button></a>
            </div>
            <div class="pro-left ">
                <a href="{{x.url}}">
                <img class="img" src="{{x.img1}}" />
                <h3 class="title" ><span class="type">{{x.ds}}</span> <span ng-bind="x.title"></span></h3>
                <h5 class="tags" ><span ng-repeat="a in x.tags track by $index" ng-bind="a"></span></h5>
                <h5 class="price" ng-if="x.ds == '需'">{{x.num}}{{x.unit}}</h5>
                <h5 class="price" ng-if="x.ds == '供' && x.price != '面议'">{{x.price}}元/{{x.unit}}</h5>
                <h5 class="price" ng-if="x.ds == '供' && x.price == '面议'">{{x.price}}</h5>
				</a>
            </div>
            <h5 class="other flex-between"><div ng-if=" x.ds == '供'">{{x.companyname}}</div><div ng-if="x.switch == 1 && x.ds == '需'">{{x.companyname}}</div> <div ng-if="x.switch == 0 && x.ds == '需'">&nbsp;</div> <div>{{x.post_modified}}</div></h5>
        </li>
		<li><a href="<?php echo U('portal/dslist/dslist');?>" style="padding: .6rem; display: block; text-align: center; font-size: .8rem;">查看更多</a></li>
    </ul>
</section>
<footer class="footer">
    <dl class="nav-list active">
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
    <dl class="nav-list">
        <a href="<?php echo UU('mine/index');?>" >
        <dd data-nav-my></dd>
        <dt>我的</dt>
        </a>
    </dl>
</footer>
<script src='/public/js/swipe.js'></script>
<script>
        // pure JS
        var elem = document.getElementById('mySwipe');
        window.mySwipe = Swipe(elem, {
            startSlide: 0,
            auto: 3000,
            continuous: true,
            disableScroll: true,
            stopPropagation: true,
            callback: function(index, element) {},
            transitionEnd: function(index, element) {}
        });
</script>
<script type="text/javascript" ng-module="myApp" ng-ctrl="newCtrl" src="/public/angular.tips.js"></script>
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

    //var app = angular.module("myApp",[]);
    app.controller("myCtrl",function($scope,$http){
        $scope.yincang = true;
        //$scope.xc ={"display":"none"};
        $scope.selected = function($event){
            $event.stopPropagation();
            $scope.yincang = !$scope.yincang ;
            if(!$scope.yincang){
                $scope.xc ={"display":"block"};
            }else{
                $scope.xc ={"display":"none"};
            }

        }
        $scope.choiceVal = "产品";
        $scope.choice = function(val){
            $scope.choiceVal = val;
        }
   // })
    //app.controller("newCtrl",function($scope,$http){
        $scope.newList = angular.fromJson('<?php echo (json_encode($dslist)); ?>');
        angular.forEach($scope.newList,function(v,k){
            if(v.isfav==1){
                $scope.newList[k].attention = "已关注";
            }else{
                $scope.newList[k].attention = "+关注";
            }
            if(v.mobile){
                $scope.newList[k].mobile = "tel:"+ v.mobile;
            }else{
                $scope.newList[k].mobile = "javascript:;";
            }
        })
        //var url = '<?php echo U("user/favorite/do_dsfav");?>';
        $scope.attentionVal = "+关注";
    })
</script>
</body>
</html>