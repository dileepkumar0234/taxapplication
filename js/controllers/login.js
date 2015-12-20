 appinstal.controller("logInCtrl",function($scope,$rootScope,$state,$uibModalInstance,commonService) {
  console.log("hi");
  $scope.loginuser = {};
  $scope.signupuser = {};
  $scope.signup=false;
  $scope.emailExist = false;
  $scope.successRegistr = false;
  $scope.showforgot = false;

  $scope.toggleForgot = function(e){
    console.log(e);
    e.preventDefault();
    $scope.showforgot = true;
  }

  $scope.getBack = function(userEmail){
    commonService.getData('POST','forgetpassword',{email:userEmail}).then(function(resp){
      console.log(resp,"forgetpassword:::");
      commonService.stopSpinner();
      if(resp.data){
        $scope.showforgot = false;
        $scope.resetdone = true;

      }

    });

  }


  $scope.userlogin=function(loginuser){
    console.log("login",loginuser);
    $scope.invalidCredentials = false;
    commonService.getData('POST','login',loginuser).then(function(resp){
     console.log("resp",resp);
     commonService.stopSpinner();
     if(resp.data.status=='sucess'){
      $scope.invalidCredentials = false;
      $scope.resetdone = false;
      $scope.successRegistr = false;
      //commonService.setuserData(resp.data);
      $state.go('user.user',{id:resp.data.uid});
      $uibModalInstance.dismiss('close');
      
    }
    else{
      $scope.invalidCredentials = true;
    }
  });
    
  }
$scope.signupform = {};
  
  $scope.signupClient = function(signupuser,signupform){
if(signupform.$valid==false)
  return false;
  
  
if(signupuser.inputEmail){
  commonService.getData('POST','email-verified',{user_email:signupuser.inputEmail}).then(function(resp){
     console.log("resp",resp);
     commonService.stopSpinner();
     if(resp.data.output == 'exists'){
      $scope.emailExist = true;
      if(!$scope.$$phase){
        $scope.$apply();
      }
    }
    else{
      commonService.getData('POST','registration',signupuser).then(function(resp){
        console.log("resp",resp);
        commonService.stopSpinner();
        if(resp.data.Success == 'Registration Success'){
          $uibModalInstance.dismiss('close');
          $scope.signupuser = {};
          $scope.successRegistr = true;
         // $scope.signupform.$setPristine();
        }

        else
          $scope.successRegistr = false;

      });
      $scope.emailExist = false;
    }

  });
}
   


   
 }
});