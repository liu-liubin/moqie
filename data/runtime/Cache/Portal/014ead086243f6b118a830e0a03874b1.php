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
    <script src="//cdn.bootcss.com/angular.js/1.5.0/angular.js"></script>
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="/public/js/ng-file-upload-shim.js"></script>
    <script src="/public/js/ng-file-upload.js"></script>
	<script src="/public/js/layer/layer.js"></script>
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/tigo-ui.css" type="text/css" />
    <link rel="stylesheet" href="/public/css/style.css" type="text/css" />
    <style>
.thumb {
    width: 50px;
    height: 50px;
    float:left;
}

form .progress {
    line-height: 15px;
}
}

.progress {
    display: inline-block;
    width: 100px;
    border: 3px groove #CCC;
}

.progress div {
    font-size: smaller;
    background: orange;
    width: 0;
}
.thumbContainer{
    margin: 10px;
    height:50px;
    display: block;
    clear: both;
    position: relative;
}
.delIcon {
    text-align: center;
    background-color: red;
    font-size: 10px;
    width: 12px;
    height: 12px;
    line-height: 12px;
    display: inline-block;
    color: #fff;
    border-radius: 12px;
    position: absolute;
    margin-left: -6px;
    margin-top: -4px;
    border: none;
    padding: 0;
}
.uploadContainer{margin-top:0.6rem;width:100%;display:flex; }

.upload_half{box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box; width:50%;float:left;}

.upload_half i{font-size: 0.7rem;color:red;}

.thumbContainer span{font-size: 0.7rem;}

.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}

/*.submit-btn{margin-left:0;margin-right: 0;width:100%;background-color: #ccc;}
.abled{background-color: #dd3333 !important;}*/

    </style>
</head>
<body ng-app="myApp" ng-controller="publishCtrl">
<header class="wm-head container">
    <a class="back" href="javascript:history.back();" ></a>
    <h1>
        我要发布
    </h1>
</header>
<div class="clearfix publish-top" ><h3 class="pull-left text-center {{gy.color}}" ng-click="showSelectTitle='全部';gongyingBtn()" >发供应<i class="fa {{gy.icon}}"></i> </h3><h3 ng-click="showSelectTitle='全部';xuqiuBtn()" class="pull-right text-center {{xq.color}}">发需求<i class="fa {{xq.icon}}"></i></h3></div>
<section class="publish-wrapper container">

	<!------发布供给------>
    <form name="myForm" ng-style="formStyle1"  action="portal/dslist/do_publish" method="post" enctype="multipart/form-data">
        <input type="hidden" ng-model="type" name="type" id="type" value="1" />
        <input type="hidden" name="categoryId" value="123">
        <div class="tigo-input-group publish-input">
            <label>企业名称</label> 
            <input class="input-item" disabled="disabled" style="background:transparent;" type="text" id="cn" name="companyname"  value="<?php echo ($user["companyname"]); ?>">
        </div>
        <div class="tigo-input-group publish-input" onclick="categorySelect(true)">
			
            <!---input type="hidden" name="termid"  value="{{categoryId}}">
            <select class="category-select" ng-style="childStyle"  ng-model="resId" ng-change="childSelect()">
                <option ng-repeat="a in childOption" name="termid" value="{{a.id}}">{{a.title}}</option>
            </select>
            <select class="category-select" ng-style="parentStyle"  ng-model="cid" ng-change="selectChange()">
                <option value=""></option>
                <option ng-repeat="x in categoryList" ng-bind="x.title" name="termid" ng-value="x.id" ></option>
            </select------>
            <label>选择类别</label>  <div class="input-item text-right" > <span class="showSelectTitle">全部</span>&nbsp;<i class="fa fa-angle-right" ></i>&nbsp;&nbsp;</div>
        </div>
        <div class="tigo-input-group publish-input">
            <label>标题</label> <input class="input-item" name="title" ng-model="title" type="text" placeholder="请输入标题" required="required">
        </div>
        <div class="tigo-input-group publish-input">
            <label>价格</label> <input class="input-item" name="price" type="text" ng-model="price" placeholder="请输入价格,默认单位元" required="required">
        </div>
        <div class="tigo-input-group publish-input">
            <label>单位</label> <input class="input-item" name="unit" type="text" ng-model="unit" placeholder="请输入单位" required="required">
        </div>
        <div class="tigo-input-group publish-input">
            <label>标签</label> <input class="input-item" name="tag" ng-model="tag" type="text" placeholder="请输入标签，请用逗号分隔标签" required="required">
        </div>
        <div class="tigo-input-group publish-input">
            <!-- <div id="uploadPicker" style="right:5rem;">
                <input type="file" ng-model="img1" name="img1">
            </div>
            <div id="uploadPicker">
                <input type="file" name="img2">
            </div> -->
            <textarea class="input-item" name="content" ng-model="content" style="border: solid 0.05rem #ddd;background: #eee;height: 4rem" placeholder="请在这里添加您的描述!" required="required"></textarea>
        </div>
        <div class="tigo-input-group publish-input">
            <textarea class="input-item" name="specification" ng-model="specification" style="border: solid 0.05rem #ddd;background: #eee;height: 4rem" placeholder="请在这里描述您的产品参数!" required="required"></textarea>
        </div>

        <div class="uploadContainer">
            <!-- <div class="upload_half"> -->
                <input type="file" style="display:none;" id="file1" ngf-select ng-model="picFile1" name="file1"    
                 accept="image/*" ngf-max-size="1MB"
                 ngf-model-invalid="errorFile" />
                 <label for="file1" class="custom-file-upload">
                    <i class="fa fa-image"></i> 图片1
                </label>
                
            <!-- </div>
            <div class="upload_half">-->
                <input type="file" style="display:none;" id="file2" ngf-select ng-model="picFile2" name="file2"    
                 accept="image/*" ngf-max-size="1MB"
                 ngf-model-invalid="errorFile" />
                <label for="file2" class="custom-file-upload">
                    <i class="fa fa-image"></i> 图片2
                </label>

            <!-- </div> -->
        </div>

        <div class="uploadContainer">
            <div class="thumbContainer" ngf-thumbnail="picFile1">
                <img ng-show="myForm.file1.$valid" ngf-thumbnail="picFile1" class="thumb">
                <button class="delIcon" onclick="return false;" ng-click="picFile1 = null" ng-show="picFile1">X</button>
                <span style="margin-left: 20px;" ng-show="picFile1.result">文件上传成功</span>
                <span style="margin-left: 20px;" class="err" ng-show="errorMsg">{{errorMsg}}</span>
            </div>

            <div class="thumbContainer" ngf-thumbnail="picFile2">
                <img ng-show="myForm.file2.$valid" ngf-thumbnail="picFile2" class="thumb">
                <button class="delIcon" onclick="return false;" ng-click="picFile2 = null" ng-show="picFile2">X</button>
                <span style="margin-left: 20px;" ng-show="picFile2.result">文件上传成功</span>
                <span style="margin-left: 20px;" class="err" ng-show="errorMsg">{{errorMsg}}</span>
            </div>
        </div>
        <div style="clear:both;font-size: 0.7rem">
            <i ng-show="myForm.file1.$error.maxSize">文件太大无法上传,最大1M</i>
            <br />
            <i ng-show="myForm.file2.$error.maxSize">文件太大无法上传,最大1M</i>
        </div>

        <div ng-if="formError">
            <p ng-bind="tips" style="color:red;font-size: 0.8rem;text-align: center;"></p>
        </div>
        <div ng-if="rsOk">
            <p ng-bind="rs" style="color:red;font-size: 0.8rem;text-align: center;"></p>
        </div>



        <div class="tigo-input-group publish-input">
            <input type="hidden" name="type" value="feed" />
            <button type="button" onclick="return false;" class="submit-btn" ng-click="submitGY(picFile1,picFile2,$event)">确定</button>
        </div>
    </form>

	<!--------发布供给---------->

    <form style="display:none" name="myForm2" ng-style="formStyle2" action="portal/dslist/do_publish" method="post" enctype="multipart/form-data">
        <input type="hidden" ng-model="type" name="type" id="type" value="2" />
        <div class="tigo-input-group publish-input">
            <label>企业名称</label> <input class="input-item" disabled="disabled" style="background:transparent;" type="text" id="cn" name="companyname"  value="<?php echo ($user["companyname"]); ?>">
            <div class="tigo-turn-circle publish-circle" ng-style="changeOff" ng-click="pubSwitch()">
                <div class="tigo-turn" name="turn" ng-style="switchStyle"></div>
                <input type="hidden" name="switch" ng-model="switchVal" value="{{switchVal}}" />
            </div>
        </div>
        <div class="tigo-input-group publish-input" onclick="categorySelect(true)">
			
           <!---input type="hidden" name="termid"  value="{{categoryId}}">
            <select class="category-select" ng-style="childStyle"  ng-model="resId" ng-change="childSelect()">
                <option ng-repeat="a in childOption" name="termid" value="{{a.id}}">{{a.title}}</option>
            </select>
            <select class="category-select" ng-style="parentStyle"  ng-model="cid" ng-change="selectChange()">
                <option value=""></option>
                <option ng-repeat="x in categoryList" ng-bind="x.title" name="termid" ng-value="x.id" ></option>
            </select---->
            <label>选择类别</label>  <div class="input-item text-right" > <span class="showSelectTitle" >全部</span>&nbsp;<i class="fa fa-angle-right" ></i>&nbsp;&nbsp;</div>
        </div>
        <div class="tigo-input-group publish-input">
            <label>标题</label> <input class="input-item" name="title" ng-model="title" type="text" placeholder="请输入标题" required="required">
        </div>
        <div class="tigo-input-group publish-input">
            <label>数量</label> <input class="input-item" name="num" ng-model="num"  type="text" placeholder="请输入数量" required="required">
        </div>
        <div class="tigo-input-group publish-input">
            <label>单位</label> <input class="input-item" name="unit" ng-model="unit" type="text" placeholder="请输入单位" required="required">
        </div>
        <div class="tigo-input-group publish-input">
            <label>标签</label> <input class="input-item" name="tag" ng-model="tag" type="text" ng-model="tag" placeholder="请输入标签" required="required">
        </div>

        <div class="tigo-input-group publish-input">
<!------           <div id="uploadPicker" style="right:5rem;"><input type="file" name="img1" onchange="avatar_upload(this)"></div>
            <div id="uploadPicker"><input type="file" name="img2" onchange="avatar_upload(this)"></div> -->
            <textarea class="input-item" name="content" ng-model="content" style="border: solid 0.05rem #ddd;background: #eee;height: 6.5rem" placeholder="请在这里描述您的需求!" required="required"></textarea>
        </div>

        <div class="uploadContainer">
            <!-- <div class="upload_half"> -->
                <input type="file" style="display:none;" id="file1" ngf-select ng-model="picFile1" name="file1"    
                 accept="image/*" ngf-max-size="1MB"
                 ngf-model-invalid="errorFile" />
                 <label for="file1" class="custom-file-upload">
                    <i class="fa fa-image"></i> 图片1
                </label>
                
            <!-- </div>
            <div class="upload_half">-->
                <input type="file" style="display:none;" id="file2" ngf-select ng-model="picFile2" name="file2"    
                 accept="image/*" ngf-max-size="1MB"
                 ngf-model-invalid="errorFile" />
                <label for="file2" class="custom-file-upload">
                    <i class="fa fa-image"></i> 图片2
                </label>

            <!-- </div> -->
        </div>

        <div class="uploadContainer">
            <div class="thumbContainer" ngf-thumbnail="picFile1">
                <img ng-show="myForm2.file1.$valid" ngf-thumbnail="picFile1" class="thumb">
                <button class="delIcon" onclick="return false;" ng-click="picFile1 = null" ng-show="picFile1">X</button>
                <span style="margin-left: 20px;" ng-show="picFile1.result">文件上传成功</span>
                <span style="margin-left: 20px;" class="err" ng-show="errorMsg">{{errorMsg}}</span>
            </div>

            <div class="thumbContainer" ngf-thumbnail="picFile2">
                <img ng-show="myForm2.file2.$valid" ngf-thumbnail="picFile2" class="thumb">
                <button class="delIcon" onclick="return false;" ng-click="picFile2 = null" ng-show="picFile2">X</button>
                <span style="margin-left: 20px;" ng-show="picFile2.result">文件上传成功</span>
                <span style="margin-left: 20px;" class="err" ng-show="errorMsg">{{errorMsg}}</span>
            </div>
        </div>
        <div style="clear:both;font-size: 0.7rem">
            <i ng-show="myForm2.file1.$error.maxSize">文件太大无法上传,最大1M</i>
            <br />
            <i ng-show="myForm2.file2.$error.maxSize">文件太大无法上传,最大1M</i>
        </div>

        <div ng-if="formError">
            <p ng-bind="tips" style="color:red;font-size: 0.8rem;text-align: center;"></p>
        </div>
        <div ng-if="rsOk">
            <p ng-bind="rs" style="color:red;font-size: 0.8rem;text-align: center;"></p>
        </div>


        <!--****************************************-->
<!-- 
      <br>图1:
      <input type="file" ngf-select ng-model="picFile1" name="file1"    
             accept="image/*" ngf-max-size="1MB"
             ngf-model-invalid="errorFile" />
      <i ng-show="myForm.file1.$error.required" style="color:red;">*</i><br>
      <i ng-show="myForm.file1.$error.maxSize">文件太大无法上传,最大1M</i>
      <div class="thumbContainer" ngf-thumbnail="picFile1">
        <img ng-show="myForm.file1.$valid" ngf-thumbnail="picFile1" class="thumb">
        <button class="delIcon" ng-click="picFile1 = null" ng-show="picFile1">X</button>
        <span style="margin-left: 20px;" ng-show="picFile1.result">文件上传成功</span>
        <span style="margin-left: 20px;" class="err" ng-show="errorMsg">{{errorMsg}}</span>
      </div>
      <br>图2:
      <input type="file" ngf-select ng-model="picFile2" name="file2"    
             accept="image/*" ngf-max-size="1MB"
             ngf-model-invalid="errorFile" />
      <i ng-show="myForm.file2.$error.required" style="color:red;">*</i><br>
      <i ng-show="myForm.file2.$error.maxSize">文件太大无法上传,最大1M</i>
      <div class="thumbContainer" ngf-thumbnail="picFile2">
        <img ng-show="myForm.file2.$valid" ngf-thumbnail="picFile2" class="thumb">
        <button class="delIcon" ng-click="picFile2 = null" ng-show="picFile2">X</button>
        <span style="margin-left: 20px;" ng-show="picFile2.result">文件上传成功</span>
        <span style="margin-left: 20px;" class="err" ng-show="errorMsg">{{errorMsg}}</span>
      </div>
 -->

        <!--****************************************-->




        <div class="tigo-input-group publish-input">
            <input type="hidden" name="type" value="need" />
            <button type="button" class="submit-btn" ng-click="submitXQ(picFile1,picFile2)" >确定</button>
        </div>
    </form>
<!--     <form action="portal/dslist/upload" enctype="multipart/form-data" method="post" >
        <input type='file'  name='img1'>
        <input type='file'  name='img2'>
        <input type="submit" value="提交" >
    </form> -->
</section>
<footer class="footer">
    <dl class="nav-list">
        <a href="<?php echo UU('index/index');?>">
            <dd data-nav-home><!--<img src="images/nav_01.png" />--> </dd>
            <dt>首页</dt>
        </a>
    </dl>
    <dl class="nav-list active">
        <a href="<?php echo UU('dslist/dslist');?>" >
            <dd data-nav-market><!--<img src="images/nav_02.png" /> --></dd>
            <dt>商城</dt>
        </a>
    </dl>
    <dl class="nav-list">
        <a href="<?php echo UU('posts/news');?>" >
            <dd data-nav-news></dd>
            <dt>资讯</dt>
        </a>
    </dl>
    <!-- yhx 20160510 -->
    <dl class="nav-list">
        <a href="<?php echo UU('mine/index');?>" >
            <dd data-nav-my></dd>
            <dt>我的</dt>
        </a>
    </dl>
</footer>
</body>
<script>
	var categoryLists = angular.fromJson('<?php echo (json_encode($terms)); ?>');
	var categoryList = [];   //分类初始化
	var categoryHTML = '';		//初始化分类列表元素
    angular.forEach(categoryLists,function(data){
            if(data.parent_id==0){
                categoryList.push(data);
            }
    })
	
	/*****选择分类****/
	function categorySelect(id){
		document.getElementsByClassName("showSelectTitle")[0].innerHTML = '全部';
		document.getElementsByClassName("showSelectTitle")[1].innerHTML = '全部';
		if(id && id!=0 && id!==true){
			//categoryList = [];
			categoryHTML = '';
			var prevText = '' //返回上一级
			var newCateList = [];
			angular.forEach(categoryLists,function(data){
					if(data.parent_id==id){
						newCateList.push(data);
					}
					if(data.id == id){
						//console.log(data);
						document.getElementsByClassName("showSelectTitle")[0].innerHTML = data.title+'<input type="hidden" name="termid" value="'+data.id+'" />';
						document.getElementsByClassName("showSelectTitle")[1].innerHTML = data.title+'<input type="hidden" name="termid" value="'+data.id+'" />';
					}
			})		
			if(newCateList.length<1){
				return false;
			}
			oldCategoryList = categoryList;  //作用于返回上一级
			categoryList = newCateList;
			//oldCategoryList = categoryList;
			prevText='<li style="padding:.2rem 0" onclick="categorySelect(0)">返回上一级<li>';
			layer.closeAll();
		}

		//如果ID为0就表示返回上一级菜单 
		if(id == 0){
			categoryHTML = '';
			categoryList = oldCategoryList;
			layer.closeAll();
		}
		if(id===true){
			categoryList = [];
			angular.forEach(categoryLists,function(data){
					if(data.parent_id==0){
						categoryList.push(data);
					}
			})
		}
		categoryHTML += '<ul id="ulTabmenu" style="font-size:.68rem;padding:.5rem .6rem;overflow-y:auto;">'+(prevText?prevText:'');
				angular.forEach(categoryList,function(v,k){
					categoryHTML += '<li style="padding:.2rem 0" onclick="categorySelect('+v.id+')">'+v.title+'<li>';
				})
		categoryHTML += '</ul>'		
		var pageii = layer.open({
					shadeClose:true,
					type: 1,
					content: categoryHTML,
					style: 'position:fixed; left:0; bottom:0; width:100%; height:50%; border:none;overflow:auto;z-index:999999;',
					end:function(){
						
					},success:function(obj){
						document.getElementById("ulTabmenu")
					}
		});
	}


    var app = angular.module("myApp",['ngFileUpload']);
    
    app.controller("publishCtrl",function($scope,$http,$timeout,Upload){


        var type = document.getElementById("type");
        
        $scope.gy = {
            hide:false,
            icon:"fa-angle-up",
            color:"text-red"
        }
        $scope.xq  = {
            hide:true,
            icon:"fa-angle-down",
            color:""
        }
        $scope.gongyingBtn = function(){
			$scope.showSelectTitle='全部';
            $scope.xq = {
              
                icon:"fa-angle-down",
                color:""
            };
            $scope.gy = {
                icon:"fa-angle-up",
                color:"text-red"
            };
            type.value = 1;
			$scope.formStyle1 = {"display":"block"};
			$scope.formStyle2 = {"display":"none"};
        }
        $scope.xuqiuBtn = function(){
			$scope.showSelectTitle='全部';
            $scope.gy = {
                hide:true,
                icon:"fa-angle-down",
                color:""
            };
            $scope.xq = {
                hide:false,
                icon:"fa-angle-up",
                color:"text-red"
            };
            type.value = 2;
			$scope.formStyle1 = {"display":"none"};
			$scope.formStyle2 = {"display":"block"};
        }
        $scope.turnCircle = false;
        $scope.circle = function(a,c){
            $scope.turnCircle = !$scope.turnCircle;
            $scope.input = '<input type="turn" value="'+($scope.turnCircle?a:c)+'" />'
        }
        var categoryLists = angular.fromJson('<?php echo (json_encode($terms)); ?>');
            /* [
            {title:"一级分类1",id:1,parent_id:0},
            {title:"一级分类2",id:2,parent_id:0},
            {title:"一级分类3",id:3,parent_id:0},
            {title:"一级分类4",id:4,parent_id:0},
            {title:"一级分类5",id:5,parent_id:0},
            {title:"一级分类6",id:6,parent_id:0},
            {title:"二级分类7",id:7,parent_id:0},
            {title:"二级分类8",id:8,parent_id:1},
            {title:"二级分类9",id:9,parent_id:2},
            {title:"二级分类10",id:10,parent_id:3},
            {title:"二级分类11",id:11,parent_id:4},
            {title:"二级分类12",id:12,parent_id:1}
        ]*/
        //分类初始化
        var initCate = [];
        angular.forEach(categoryLists,function(data){
            if(data.parent_id==0){
                initCate.push(data);
            }
        })
        $scope.categoryList = initCate;

        $scope.selectChange = function(){
            $scope.categoryId = $scope.cid;   //获得父分类ID
            var cates = [] ;
            $scope.childStyle = {"z-index":"999"}
            $scope.parentStyle = {"z-index":"888"}
            cates.push({title:"上一级",id:$scope.cid});
            angular.forEach(categoryLists,function(data){
                if($scope.cid==data.id){
                    $scope.categoryTitle = data.title;
                }
                if($scope.cid == data.parent_id){
                    cates.push(data);
                }
            })
            $scope.childOption = cates;
            //console.log($scope.categoryChild);
        }
        $scope.childSelect = function(){
            /*if($scope.categoryId == $scope.resId){
            }else {*/

                $scope.childStyle = {"z-index":"888"}
                $scope.parentStyle = {"z-index":"999"}
                $scope.categoryId = $scope.resId;   //获得子分类ID
            //}
            angular.forEach(categoryLists,function(data){
                if($scope.resId==data.id){
                    $scope.categoryTitle = data.title;
                }

            })
        }

        //发布需求是否显示公司名称
        var switchT = true;
        $scope.switchVal = 1;
        $scope.pubSwitch =  function(){
            switchT = !switchT;
            if(switchT) {
                $scope.changeOff = {"background-color":"#DE1C1C"};
                $scope.switchStyle = {"float": "left"};
                $scope.switchVal = 1;
            }else{
                $scope.changeOff = {"background-color":"#DDD"};
                $scope.switchStyle = {"float": "right"};
                $scope.switchVal = 0;
            }
        }

        $scope.test = function(){
            var type = document.getElementById("type");
        }

        $scope.submitGY = function(file1,file2,$event){

			$scope.category = document.myForm.categoryId.value || "";
            $event.preventDefault();

            if($scope.cid){
              //  $scope.category = $scope.cid;
            }else{
               // $scope.category = $scope.resId;
            }

            var type = document.getElementById("type");
            $scope.type = type.value;
            // console.log($scope.type);

            $scope.username = document.getElementById("cn").value;

            // var request = $http({
            //     method: "POST",
            //     url: "http://moqie.tigonetwork.com/index.php?g=&m=dslist&a=do_publish",
            //     data: {
            //         companyname: $scope.companyname,
            //         title: $scope.title,
            //         price: $scope.price,
            //         term_id: $scope.category,
            //         tag: $scope.tag,
            //         post_content: $scope.post_content
            //     },
            //     headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            // });

            // request.success(function (data) {
            //     console.log('ok');
            //     console.log(data);
            // });

            // request.error(function(data){
            //     console.log('no');
            //     console.log(data);
            // })

            
				//&& $scope.specification
            if($scope.category && $scope.title && $scope.price && $scope.tag && $scope.content && $scope.specification ){

                Upload.upload({
                    url: '<?php echo U("portal/dslist/do_publish");?>',
                    data: {
                        companyname: $scope.username,
                        title: $scope.title, 
                        // switch:$scope.switchVal,
                        price: $scope.price,
                        term_id: $scope.category,
                        tag: $scope.tag,
                        // num: $scope.num,
                        unit: $scope.unit,
                        type: $scope.type,
                        file1: file1, 
                        file2: file2,
                        content:$scope.content,
                        specification:$scope.specification
                    },
                })
                .then(function (response) {
                    $timeout(function () {
                        console.log('ok');
                        console.log(response);
                        // file1.result = response.data;
                        // file2.result = response.data;
                        $scope.rsOk = true;
                        $scope.rs = "供应发布成功!";
                        $scope.cid = null;
                        $scope.category = null;
                        $scope.title = '';
                        $scope.tag = '';
                        $scope.unit = '';
                        $scope.price = '';
                        $scope.content = '';
                        $scope.specification = '';
                    });
                }, function (response) {
                    console.log('no');
                    console.log(response);
                    if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
                    $scope.rsOk = false;
                    $scope.rs = "供应发布失败!";
                });

            }else{
                $scope.formError = true;
                $scope.tips = "请填写完整正确的信息！";

                var timer = $timeout(
                    function(){
                        $scope.tips = '';
                    },2000
                );
            }

        }


        $scope.submitXQ = function(file1,file2){    
			$scope.category = document.myForm.categoryId.value || "";
            if($scope.cid){
             //   $scope.category = $scope.cid;
            }else{
               // $scope.category = $scope.resId;
            }

            var type = document.getElementById("type");
            $scope.type = type.value;

            $scope.username = document.getElementById("cn").value;
            
            if($scope.category && $scope.title && $scope.num && $scope.tag && $scope.content && $scope.unit && !isNaN($scope.num)){

                Upload.upload({
                    url: '<?php echo U("portal/dslist/do_publish");?>',
                    data: {
                        companyname: $scope.username,
                        title: $scope.title, 
                        switch:$scope.switchVal,
                        // price: $scope.price,
                        term_id: $scope.category,
                        tag: $scope.tag,
                        num: $scope.num,
                        unit: $scope.unit,
                        type: $scope.type,
                        file1: file1, 
                        file2: file2,
                        content:$scope.content,
                        // specification:$scope.specification
                    },
                })
                .then(function (response) {
                    $timeout(function () {
                        console.log('ok');
                        console.log(response);
                        // file1.result = response.data;
                        // file2.result = response.data;
                        $scope.rsOk = true;
                        $scope.rs = "需求发布成功!";
                        $scope.cid = null;
                        $scope.category = null;
                        $scope.title = '';
                        $scope.tag = '';
                        $scope.num = '';
                        $scope.unit = '';
                        $scope.content = '';
                    });
                }, function (response) {
                    console.log('no');
                    console.log(response);
                    if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
                    $scope.rsOk = false;
                    $scope.rs = "需求发布失败!";
                });

            }else{
                $scope.formError = true;
                $scope.tips = "请填写完整正确的信息！";

                var timer = $timeout(
                    function(){
                        $scope.tips = '';
                    },2000
                );
            }

        }



        /*
        $scope.submitXQ = function(file1,file2){
            if($scope.cid){
                $scope.category = $scope.cid;
            }else{
                $scope.category = $scope.resId;
            }

            var type = document.getElementById("type");
            $scope.type = type.value;

            $scope.username = document.getElementById("cn").value;

            Upload.upload({
                url: 'http://moqie.tigonetwork.com/index.php?g=&m=dslist&a=do_publish',
                data: {
                    companyname: $scope.username,
                    title: $scope.title, 
                    switch:$scope.switchVal,
                    // price: $scope.price,
                    term_id: $scope.category,
                    tag: $scope.tag,
                    num: $scope.num,
                    unit: $scope.unit,
                    type: $scope.type,
                    file1: file1, 
                    file2:file2,
                    content:$scope.content
                },
            })
            .then(function (response) {
                $timeout(function () {
                    console.log('ok');
                    console.log(response);
                    file1.result = response.data;
                    file2.result = response.data;
                });
            }, function (response) {
                console.log('no');
                console.log(response);
                if (response.status > 0)
                $scope.errorMsg = response.status + ': ' + response.data;
            });
        }
        */



    })
</script>
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
    <script src="/themes/simplebootx/Public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
    <script src="/public/js/frontend.js"></script>
	<script>
	$(function(){
		$('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
		
		$("#main-menu li.dropdown").hover(function(){
			$(this).addClass("open");
		},function(){
			$(this).removeClass("open");
		});
		
		$.post("<?php echo U('user/index/is_login');?>",{},function(data){
			if(data.status==1){
				if(data.user.avatar){
					$("#main-menu-user .headicon").attr("src",data.user.avatar.indexOf("http")==0?data.user.avatar:"/data/upload/avatar/"+data.user.avatar);
				}
				
				$("#main-menu-user .user-nicename").text(data.user.user_nicename!=""?data.user.user_nicename:data.user.user_login);
				$("#main-menu-user li.login").show();
				
			}
			if(data.status==0){
				$("#main-menu-user li.offline").show();
			}
			
		});	
		;(function($){
			$.fn.totop=function(opt){
				var scrolling=false;
				return this.each(function(){
					var $this=$(this);
					$(window).scroll(function(){
						if(!scrolling){
							var sd=$(window).scrollTop();
							if(sd>100){
								$this.fadeIn();
							}else{
								$this.fadeOut();
							}
						}
					});
					
					$this.click(function(){
						scrolling=true;
						$('html, body').animate({
							scrollTop : 0
						}, 500,function(){
							scrolling=false;
							$this.fadeOut();
						});
					});
				});
			};
		})(jQuery); 
		
		$("#backtotop").totop();
		
		
	});
	</script>


<script type="text/javascript">
    function update_avatar(){
        var area=$(".uploaded_avatar_area img").data("area");
        $.post("<?php echo U('profile/avatar_update');?>",area,
                function(data){
                    if(data.status==1){
                        reloadPage(window);
                    }

                },"json");

    }
    function avatar_upload(obj){
        var $fileinput=$(obj);
        /* $(obj)
         .show()
         .ajaxComplete(function(){
         $(this).hide();
         }); */
        Wind.css("jcrop");
        Wind.use("ajaxfileupload","jcrop","noty",function(){
            $.ajaxFileUpload({
                url:"<?php echo U('profile/avatar_upload');?>",
                secureuri:false,
                fileElementId:"avatar_uploder",
                dataType: 'json',
                data:{},
                success: function (data, status){
                    if(data.status==1){
                        $("#avatar_uploder").hide();
                        var $uploaded_area=$(".uploaded_avatar_area");
                        $uploaded_area.find("img").remove();
                        var $img=$("<img/>").attr("src","/data/upload/avatar/"+data.data.file);
                        $img.prependTo($uploaded_area);
                        $(".uploaded_avatar_btns").show();
                        $img.Jcrop({
                            aspectRatio:1/1,
                            setSelect: [ 0, 0, 100, 100 ],
                            onSelect: function(c){
                                $img.data("area",c);
                            }
                        });

                    }else{
                        noty({text: data.info,
                            type:'error',
                            layout:'center'
                        });
                    }

                },
                error: function (data, status, e){}
            });
        });



        return false;
    }
</script>
</html>