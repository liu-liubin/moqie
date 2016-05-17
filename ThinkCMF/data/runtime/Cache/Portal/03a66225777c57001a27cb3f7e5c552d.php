<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/",
    JS_ROOT: "public/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body>
	<div class="wrap">
		
		<form class="form-horizontal js-ajax-form" method="post" action="">
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="input-post_title">标题</label>
					<div class="controls">
						<input type="hidden" name="id" value="<?php echo ($dslist["id"]); ?>">
						<input type="text" id="input-post_title" name="post_title" value="<?php echo ($dslist["post_title"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-avatar">公司名称</label>
					<div class="controls">
						<input type="text" id="input-companyname"  name="companyname" value="<?php echo ($dslist["companyname"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-term">分类</label>
					<div class="controls">
						<input type="text" id="input-term"  name="term" value="<?php echo ($term['name']); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-user">会员</label>
					<div class="controls">
						<input type="text" id="input-user"  name="user" value="<?php echo ($users[$dslist['post_author']]['user_login']); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-num">数量</label>
					<div class="controls">
						 <input type="text" id="input-num"  name="num" value="<?php echo ($dslist["num"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-price">价格</label>
					<div class="controls">
						<input type="text" id="input-price"  name="mobile" value="<?php echo ($dslist["price"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-tag">标签</label>
					<div class="controls">
						<input type="text" id="input-tag"  name="tag" value="<?php echo ($dslist["tag"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-specification">产品参数</label>
					<div class="controls">
						<input type="text" id="input-specification"  name="specification" value="<?php echo ($dslist["specification"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-description">产品描述</label>
					<div class="controls">
						<input type="text" id="input-description"  name="description" value="<?php echo ($dslist["description"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-img1">图片1</label>
					<div class="controls">
						<img width="50" height="50" src="<?php echo U('user/public/avatar',array('id'=>$user['id']));?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-img2">图片2</label>
					<div class="controls">
						<img width="50" height="50" src="<?php echo U('user/public/avatar',array('id'=>$user['id']));?>" />
					</div>
				</div>
				
				<div class="form-actions">
					<button  class="btn btn-primary "><a href="<?php echo U('AdminDslist/adjust',array('id'=>$dslist['id']));?>"  >审核</a></button>
					<button  class="btn btn-primary "><a href="<?php echo U('AdminDslist/cacel',array('id'=>$dslist['id']));?>"  >审核不通过</a></button>
				</div>
				
			</fieldset>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
</body>
</html>