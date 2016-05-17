var scriptsLen = document.getElementsByTagName("script").length;
var ngModule = document.getElementsByTagName("script")[scriptsLen-1].getAttribute("ng-module");
var ngCtrl = document.getElementsByTagName("script")[scriptsLen-1].getAttribute("ng-ctrl");
//console.log(document.getElementsByTagName("script")[scriptsLen-1]);
if(!document.getElementById("WMNGSTYLECSS")) { //先检查要建立的样式表ID是否存在，防止重复添加  
    var wmcsstyle = document.createElement("style");
    document.head.appendChild(wmcsstyle);
    wmcsstyle.setAttribute("id", "WMNGSTYLECSS");
    wmcsstyle.innerHTML = '.wm-ngTips{-webkit-border-radius:.2rem;border-radius:.2rem;position:fixed;background:rgba(10,10,10,.5);top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);padding:.8rem 1.2rem;max-width:6rem;font-size:.7rem;color:#fff;word-wrap: break-word;box-sizing: content-box;z-index:9999999;display:none;} .wm-ngTipShade{height:100%;width:100%;position:absolute;z-index:9999998;top:0;left:0;display:none;}'  ;
}   
var app = angular.module(ngModule,[]);
app.controller(ngCtrl,function($scope,$http){    
    var tib = document.createElement("div");
    var shade = document.createElement("div");
    document.body.appendChild(tib);
    document.body.appendChild(shade);
    shade.setAttribute("class", "wm-ngTipShade");
    tib.setAttribute("class", "wm-ngTips");   
    $scope.ngTips=function(obj,callback){
        if(angular.isObject(obj)){
            tib.innerHTML = obj.content;
            tib.style.display = "block";
            shade.style.display = 'block';
            document.body.style = "overflow:hidden;";
            var removeTips = setTimeout(function(){
                document.body.style = "overflow:auto;";
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
                document.body.style = "overflow:auto;";
                tib.style.display = "none";
                shade.style.display = 'none';   
            }           
        }
    }
    $scope.tips = function($event){
        var obj = $event.target;
        $http({
            method:obj.dataset.method || "get",
            data:{},
            headers:{"Content-Type":"application/x-www-form-urlencoded"},
            url:obj.dataset.url || ""
        }).success(function(msg){
            if(!angular.isObject(msg) && obj.dataset.url)
                window.location.href = obj.dataset.url;
            //是否返回提示信息并处理
            if(msg.info){
                //返回提示信息则有提示时间 msg.time || 2
                //提示时间结束后，是否执行跳转动作
                $scope.ngTips({
                    content:msg.info,
                    time:msg.time || 2,  
                    success:function(){  
                        //如果没有设置 redirect="false" 那么程序默认执行跳转
                        var u = obj.redirect || msg.url;
                        if(obj.redirect!="false" && u)
                            window.location.href = u;
                    }
                })
            }else{        
                if(msg.url)
                    window.location.href = msg.url;
                    //window.location.href = obj.redirect || msg.url;
            }   
            if(msg.status==1){
                obj.innerHTML = obj.dataset.html;
            }   
        })
    }
    $scope.submit = function(form){
        var f =document.getElementById(form);   //获取表单对象
        var fd = new FormData();                //初始化表单数据
        var url = f.getAttribute("action");     //获取提交表单地址
        var str = [];
        for(var i=0;i<f.length;i++){
            if(f[i].name)
                str.push(encodeURIComponent(f[i].name)+"="+encodeURIComponent(f[i].value))
        }
        $http({
            method : "post",
            url : url || "",
            data:str,
            headers:{'Content-Type': 'application/x-www-form-urlencoded'},
            transformRequest:function(obj){
                return (obj.join("&"));
            }
        }).success(function(data){
            if(data.status == 1 && data.url){
                window.location.href = data.url;
            }
            if(data.info){
                $scope.ngTips({
                    content:data.info,
                    time:data.time || 2
                });
            }   
        }).error(function(err){
        
        })
    }
})