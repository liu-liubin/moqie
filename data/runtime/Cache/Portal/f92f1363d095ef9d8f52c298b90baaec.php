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
    <script src="js/layer/layer.js" ></script>
    <link rel="stylesheet" href="/public/css/wm-ui.css" type="text/css" />
    <style>
        .pro-wrapper .wm-input{font-size: .8rem;border-bottom: solid 1px #ddd;padding: 0 .6rem;}
    </style>
</head>
<body data-bg>
<header class="wm-head container">
    <a class="back"></a>
    <h1>
        免费拿样
    </h1>
</header>
<section class="pro-wrapper ">
   <form method="post" action="<?php echo U("portal/dslist/do_sample");?>">
      <input type="hidden" name="object_id" value="<?php echo ($object_id); ?>"></input>
       <div class="wm-input">
            <label for="p1">拿货人</label> <input id="p1" class="input-item" type="text" name="picker" value="<?php echo ($user["truename"]); ?>"></div>
       </div>
       <div class="wm-input">
           <label for="p2">公司</label> <input id="p2" class="input-item" type="text" name="companyname" value="<?php echo ($user["companyname"]); ?>">
       </div>
       <div class="wm-input">
           <label for="p3">电话</label> <input id="p3" class="input-item" type="text" name="mobile" value="<?php echo ($user["mobile"]); ?>" >
       </div>
       <!-- <div class="wm-input">
           <label for="p4">收货地址</label></div>
       </div>
       <div class="wm-input">
           <label for="p5">街道</label>  </div>
       </div> -->
       <div class="wm-input">
           <label for="p6">收货地址</label> <input id="p6" class="input-item" type="text" name="address" value="<?php echo ($user["address"]); ?>" >
       </div>
       <h5 style="height: 3rem"></h5>
       <button type="submit" class="wm-btn btn-danger">确定</button>

   </form>
</section>

</body>
</html>