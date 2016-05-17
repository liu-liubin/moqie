function tips(o){
	var len = o.length;
	console.log(o)
	/*for(var i=0;i<len;i++){

	}*/
}
var ngReg = angular.module("ngReg",[]);
ngReg.directive("input",tips);
ngReg.controller("ngRegCtrl",function($scope,$http,$interval){
        $scope.mobile = /^(13[0-9]|14[7]|15[0-9]|18[0-9])\d{8}$/;
        /*//$scope.regPwd = /^[a-zA-Z0-9!@#\$%\^&\*,\.\-\+]$/;
        //$scope.regForm.mobile.$error;
        $scope.codeTip = "获取验证码";
        $scope.codeDisabled = false;
*/
        //手机验证码
        $scope.checkPhone = function($event){
            $http.post('/user/register/check_reg_moblie',{mobile:$event.target.value}).success(function(data){
                if($data.status==1){
                    layer.open({
                        content: "手机号码已被注册",
                        style: 'background-color:#EEE; color:#666; border:none;',
                        time: 2
                    });
                }
            })
            //console.log($event.target.value);
            //console.log($scope.ngPhone);
        }
        $scope.submitTips = tips; 
        $scope.submitTipss = function(o){
        	//console.log(o);
        	/*var forms = document.getElementById(form).getElementsByTagName('input');
        	console.log(forms[0].value)
        	var len = forms.length;*/
        	
            if($scope.ngPhone == undefined){
                layer.open({
                    content: "手机号码有误",
                    style: 'background-color:#EEE; color:#666; border:none;',
                    time: 2
                });
            }else if($scope.ngPwd==undefined){
                layer.open({
                    content: "密码长度不正确",
                    style: 'background-color:#EEE; color:#666; border:none;',
                    time: 2
                });
            }else if(!$scope.ngCode){
                layer.open({
                    content: "验证码不正确",
                    style: 'background-color:#EEE; color:#666; border:none;',
                    time: 2
                });
            }else {
                document.getElementById("regForm").submit();
            }
        }
/*
        //提交表单验证
        $scope.submit = function(){
            if($scope.ngPhone == undefined){
                layer.open({
                    content: "手机号码有误",
                    style: 'background-color:#EEE; color:#666; border:none;',
                    time: 2
                });
            }else if($scope.ngPwd==undefined){
                layer.open({
                    content: "密码长度不正确",
                    style: 'background-color:#EEE; color:#666; border:none;',
                    time: 2
                });
            }else if(!$scope.ngCode){
                layer.open({
                    content: "验证码不正确",
                    style: 'background-color:#EEE; color:#666; border:none;',
                    time: 2
                });
            }else {
                document.getElementById("regForm").submit();
            }
        }
        $scope.getCode = function(){
            if($scope.ngPhone){
                $http.get('{:UU("user/register/mobile_code")}&mobile='+$scope.ngPhone);
                $scope.codeDisabled = true;
                $scope.t = 60;
                var timePromise = $interval(function(){
                    $scope.t -= 1;
                    if($scope.t < 1){
                        $interval.cancel(timePromise);
                        timePromise = undefined;
                        $scope.t = "";
                        $scope.codeTip = "获取验证码";
                        $scope.codeDisabled = false;
                    }
                }, 1000, 100);
                /*console.log(timePromise);
                if($scope.t < 1){
                    $interval.cancel(timePromise);
                    timePromise = undefined;
                }*
                $scope.codeTip = "秒后再次发送";
            }else{
                alert("手机号码有误");
            }
        }*/
    })