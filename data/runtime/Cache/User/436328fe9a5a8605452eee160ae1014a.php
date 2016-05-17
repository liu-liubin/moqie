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
					<label class="control-label" for="input-user_nicename">昵称</label>
					<div class="controls">
						<input type="hidden" name="id" value="<?php echo ($user["id"]); ?>">
						<input type="text" id="input-user_nicename" name="user_nicename" value="<?php echo ($user["user_nicename"]); ?>" readonly="readonly">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="input-avatar">头像</label>
					<div class="controls">
						<img width="50" height="50" src="<?php echo U('user/public/avatar',array('id'=>$user['id']));?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-mobile">手机</label>
					<div class="controls">
						<input type="text" id="input-mobile"  name="mobile" value="<?php echo ($user["mobile"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-mobile">真实姓名</label>
					<div class="controls">
						<input type="text" id="input-mobile"  name="mobile" value="<?php echo ($user["mobile"]); ?>" readonly="readonly">
					</div>
				</div>
				<!-- <div class="control-group">
					<label class="control-label" for="input-sex">性别</label>
					<div class="controls">
						<?php if($user['sex'] == 1): ?><input type="text" id="input-sex"  name="sex" value="男" readonly="readonly">
						<?php elseif($user['sex'] == 2): ?><input type="text" id="input-sex"  name="sex" value="女" readonly="readonly">
						<?php else: ?> <input type="text" id="input-sex"  name="sex" value="保密" readonly="readonly"><?php endif; ?>
					</div>
				</div> -->
				<?php $sexs=array("1"=>'男',"2"=>'女',"0"=>'保密'); ?>
				<div class="control-group">
					<label class="control-label" for="input-sex">性别</label>
					<div class="controls">
						 <input type="text" id="input-sex"  name="sex" value="<?php echo ($sexs[$user['sex']]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-address">联系地址</label>
					<div class="controls">
						<input type="text" id="input-address"  name="mobile" value="<?php echo ($user["address"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-companyname">公司名称</label>
					<div class="controls">
						<input type="text" id="input-companyname"  name="mobile" value="<?php echo ($user["companyname"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-company_add">公司地址</label>
					<div class="controls">
						<input type="text" id="input-company_add"  name="company_add" value="<?php echo ($user["company_add"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-primarybusiness">主营业务</label>
					<div class="controls">
						<input type="text" id="input-primarybusiness"  name="primarybusiness" value="<?php echo ($user["primarybusiness"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-customer_groups">客户群体</label>
					<div class="controls">
						<input type="text" id="input-customer_groups"  name="customer_groups" value="<?php echo ($user["customer_groups"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-customer_email">公司邮箱</label>
					<div class="controls">
						<input type="text" id="input-customer_email"  name="customer_email" value="<?php echo ($user["customer_email"]); ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-company_jianjie">公司简介</label>
					<div class="controls">
						<textarea name="company_jianjie" id="company_jianjie" style='width: 98%; height: 200px;' readonly="readonly"><?php echo ($user["company_jianjie"]); ?></textarea>
					</div>
				</div>
				<div class="form-actions">
					<button  class="btn btn-primary "><a href="<?php echo U('indexadmin/adjust',array('id'=>$user['id']));?>"  >审核</a></button>
					<button  class="btn btn-primary "><a href="<?php echo U('indexadmin/adjustfail',array('id'=>$user['id']));?>"  >审核不通过</a></button>
				</div>
				
			</fieldset>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
</body>
</html>