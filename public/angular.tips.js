'use strict';

var scriptsLen = document.getElementsByTagName("script").length;
var ng_Module = document.getElementsByTagName("script")[scriptsLen-1].getAttribute("module");
//var ng_App = document.getElementsByTagName("script")[scriptsLen-1].getAttribute("app");
//console.log(document.getElementsByTagName("script")[scriptsLen-1]);
if(!document.getElementById("WMNGSTYLECSS")) { //先检查要建立的样式表ID是否存在，防止重复添加  
    var wmcsstyle = document.createElement("style");
    document.head.appendChild(wmcsstyle);
    wmcsstyle.setAttribute("id", "WMNGSTYLECSS");
    wmcsstyle.innerHTML = '.wm-ngTips{-webkit-border-radius:.2rem;border-radius:.2rem;position:fixed;background:rgba(10,10,10,.5);top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);padding:.8rem 1.2rem;max-width:6rem;font-size:.8rem;color:#fff;word-wrap: break-word;box-sizing: content-box;z-index:9999999;display:none;} .wm-ngTipShade{height:100%;width:100%;position:fixed;z-index:9999998;top:0;left:0;display:none;}'  ;
    var tib = document.createElement("div");
    var shade = document.createElement("div");
    document.body.appendChild(tib);
    document.body.appendChild(shade);
    shade.setAttribute("class", "wm-ngTipShade");
    tib.setAttribute("class", "wm-ngTips"); 
}
/*
* @obj {content,time}
*/
function ngFunTips(obj,callback){
    if(angular.isObject(obj)){
        tib.innerHTML = obj.content;
        tib.style.display = "block";
        shade.style.display = 'block';
        var removeTips = setTimeout(function(){
            tib.style.display = "none";
            shade.style.display = 'none';  
            //回调函数
            if (typeof obj.success === "function") {
                obj.success();
            }
        }, obj.time*1000 || 2000);
        shade.onclick = function(){
            clearTimeout(removeTips);
            //回调函数
            if (typeof obj.success === "function") {
                obj.success();
            }
            tib.style.display = "none";
            shade.style.display = 'none';   
        }           
    }
}   
if(typeof(app)==="undefined"){
   var app = angular.module(ng_Module,[]);
}

app.directive("ajaxGet",function($http){
    return {
        restrict : "EA",
        scope : {
        },
        template:'',
        replace : false,
        controller:function($scope, $element, $attrs, $transclude){
            /*******
            * $scope，与指令元素相关联的作用域
            * $element，当前指令对应的 元素
            * $attrs，由当前元素的属性组成的对象
            * $transclude，嵌入链接函数，实际被执行用来克隆元素和操作DOM的函数****/
            /*参数说明 
            * method 提交方式
            * action 提交地址
            * redirect 指定跳转地址
            * html 提交成功后显示的html
            */
            //console.log($attrs)    
            $scope.submit = function(){
                $http({
                    method:$attrs.method || "get",
                    data:{},
                    headers:{"Content-Type":"application/x-www-form-urlencoded"},
                    url:$attrs.action || ""
                }).success(function(msg){
                    if(!angular.isObject(msg) && $attrs.action)
                        window.location.href = $attrs.action;
                    //是否返回提示信息并处理
                    if(msg.info){
                        //返回提示信息则有提示时间 msg.time || 2
                        //提示时间结束后，是否执行跳转动作
                        $scope.ngTips({
                            content:msg.info,
                            time:msg.time || 2,  
                            success:function(){  
                                //如果没有设置 redirect="false" 那么程序默认执行跳转
                                var u = $attrs.redirect || msg.url;
                                if($attrs.redirect!="false" && u)
                                    window.location.href = u;
                            }
                        })
                    }else{        
                        if(msg.url)
                            window.location.href = msg.url;
                            //window.location.href = obj.redirect || msg.url;
                    }   
                    if(msg.status==1 && $attrs.html){
                        $element[0].innerHTML = $attrs.html ;
                    }   
                })
            } 
            $scope.ngTips = ngFunTips;
        },
        link:function($scope, $element, $attrs){
            $element.bind("click",function(){
                $scope.submit();
            })  
            
        }
    }
})
app.directive("ajaxForm",function($http){
    return{
        restrict:"EA",
        template:"",
        scope:{},
        replace:false,
        controller:function($scope,$element,$attrs){
            var f=$element[0];  
            var eleSubmit;  
            angular.forEach(f.getElementsByTagName("button"),function(data){
                if(data.type=="submit"){
                    eleSubmit = data;
                }
            })
            $scope.submit = function(){
                var defHtml = eleSubmit.innerHTML;  
                eleSubmit.innerHTML = "正在提交……";
                var str = [];
                for(var i=0;i<f.length;i++){
                    if(f[i].name)
                        str.push(encodeURIComponent(f[i].name)+"="+encodeURIComponent(f[i].value))
                }
                $http({
                    method : $attrs.method || "get",
                    url : $attrs.action || "",
                    data:str,
                    headers:{'Content-Type': ($attrs.enctype || 'application/x-www-form-urlencoded') },
                    transformRequest:function(obj){
                        return (obj.join("&"));
                    }
                }).success(function(data){
                    eleSubmit.innerHTML = defHtml;
                    if(data.status == 1 && data.url){
                        console.log(data)
                        //if(data.time){
                            $scope.ngTips({
                                content:data.info || "提交成功",
                                time:data.time || 2 ,
                                success:function(){
                                     window.location.href = data.url;
                                }
                            });
                        //}else{
                           
                        //}
                        return true;
                    }
                    if(data.info){
                        $scope.ngTips({
                            content:data.info,
                            time:data.time || 2
                        });
                    }   
                }).error(function(err){
                
                })
            };
            $scope.ngTips = ngFunTips;

        },
        link:function($scope,$element,$attrs){
            //$element.bind("click",$scope.submit)
            $element.bind("submit",$scope.submit);
        }
    }
});
/*apps.directive("typeSubmit",function($http){
    return {
        restrict:"EA",
        replace:false,
        scope:true,
        require:"^ajaxForm",
        controller:function($scope){
            return "123545"
        },
        link:function($scope,$element,$attrs,$supDom){
            console.log($supDom)
            $scope.submit = function(){
                console.log($element)
            }
        }
    }
})*/
app.directive("validate",function($http){
    return{
        restrict:"EA",
        template:"",
        replace:false,
        scope:{
            tp:"@ngType",    //内容验证类型
            min:"@ngMin",
            max:"@ngMax",
            suc:"@ngTrue",
            err:"@ngFalse"        
        },
        controller:function($scope,$element,$attrs){ 
            $scope.checked = function(){
               if($scope.check($scope.tp)){

               }else{
                    $scope.ngTips({
                        content:$scope.err
                    })
               }
            }
            $scope.ngTips = ngFunTips;
        },
        link:function($scope,$element,$attrs){
            $scope.check = function(exp){
                switch (exp) {
                    case "url":
                        return!!$element[0].value.match(/(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/g);
                        break;
                    case "m":
                        return!!$element[0].value.match(/^(13[0-9]|14[7]|15[0-9]|18[0-9])\d{8}$/);
                        break;
                    case "email":
                        break;
                    default: 
                        if($scope.min && $scope.max){
                            var per = new RegExp('^([A-Za-z0-9]|[!@#$%\^&\*\(\)-\+]){'+$scope.min+','+ $scope.max+'}$');
                            return per.test($element[0].value);
                        }
                        if($scope.min){
                            var per = new RegExp('^([A-Za-z0-9]|[!@#$%\^&\*\(\)-\+]){'+$scope.min+',}$');
                            return per.test($element[0].value);
                        }
                        if($scope.max){
                            var per = new RegExp('^([A-Za-z0-9]|[!@#$%\^&\*\(\)-\+]){'+ $scope.max+'}$');
                            return per.test($element[0].value);
                        }
                        return true;
                        //return!!$element[0].value.match(/(*)/);
                        // statements_def
                        break;
                } 
            }
            $element.bind("blur",$scope.checked)
        }
    }
})


/***
* 上传插件
**/
app.directive("ajaxUpload",function($http){
    return {
        restrict : "EA",
        template : "",
        replace : false,
        scope : {},
        controller:function($scope,$element,$attrs){
            console.log($scope.info)
        },
        link:function($scope,$element,$attrs){
            var def = {
                action : $attrs.action || "",
                method : $attrs.method || "post",
                enctype : "multipart/form-data",
                accept : $attrs.accept || "*/*",
                name : $attrs.name || "file",
                auto : $attrs.auto || true
            }

            var iframeName = "WMupload"+Date.now();
            //表单
            var frm = document.createElement('form');
                frm.target=iframeName;
                frm.action= def.action;
                frm.method="post";
                frm.enctype=def.enctype;
            //框架
            var ifr = document.createElement('iframe');
                ifr.name=iframeName;
                ifr.id=iframeName;
                ifr.style.display = 'none';
            //Input file
            var fin = document.createElement('input');
                fin.type="file";
                fin.name=def.name;
                frm.appendChild(fin);
            //创建预览区
            var pre = document.createElement("div");

            //生成上传所需元素
            $element[0].appendChild(frm);
            $element[0].appendChild(ifr);
            $element[0].appendChild(pre);
            //console.log(document.getElementById(iframeName));
            //自动提交上传动作
            fin.addEventListener("change", function(){
                var reader = new FileReader();
                    reader.readAsDataURL(this.files[0]);
                    reader.onload = function(){
                        pre.innerHTML = '<img src="'+reader.result+'" style="height:200px" />';
                    }
                //frm.submit();
            },false)
            ifr.addEventListener("load",function(){
                var status = 200;
                var html = '';
                try {
                    // fixed angular.contents() for iframes
                    html = ifr.contentDocument.body.innerHTML;
                } catch (e) {
                    // in case we run into the access-is-denied error or we have another error on the server side
                    // (intentional 500,40... errors), we at least say 'something went wrong' -> 500
                    status = 500;
                }
                try {
                    var rsJson = JSON.parse(html);
                    // statements
                } catch(e) {
                    // statements
                    status = 900;
                }
                $scope.info =rsJson || {status:90};
            })
        }
 
    }  
})


/***touch**/
/*var TouCh = {
    // 判断设备是否支持touch事件
    touch: ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch,
    // 事件
    events: {                          
        TouCh: this.TouCh,         
        handleEvent: function(event) {
            // this指events对象
            var self = this;
           
            if (event.type == 'touchstart') {
                self.start(event);
            } else if(event.type == 'touchmove') {
                self.move(event);
            } else if(event.type == 'touchend') {
                self.end(event);
            }
        },

        // 滑动开始
        start: function(event) {
            event.preventDefault();                      // 阻止触摸事件的默认动作,即阻止滚屏
            this.imgScale.addEventListener('touchmove', this, false);
            this.imgScale.addEventListener('touchend', this, false);
        },

        // 移动
        move: function(event) {
            event.preventDefault();                      // 阻止触摸事件的默认行为，即阻止滚屏
            //innerHTML=event.touches[0].pageY +"=="+event.touches[1].pageY;        
        },

        // 滑动释放
        end: function(event) {
            // 解绑事件
            this.imgScale.removeEventListener('touchmove', this, false);
            this.imgScale.removeEventListener('touchend', this, false);
        }
    },

    // 初始化
    init: function() {
        // this指slider对象
        var self = this;

        // addEventListener第二个参数可以传一个对象，会调用该对象的handleEvent属性
        if(!!self.touch) self.imgScale.addEventListener('touchstart', self.events, false);
    }
};
TouCh.init();*/