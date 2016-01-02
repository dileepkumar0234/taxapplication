 angular.module("myapp").controller("logInCtrl",['$scope','$rootScope','$state','$uibModalInstance','commonService','$timeout',function($scope,$rootScope,$state,$uibModalInstance,commonService,$timeout) {
  
  $scope.loginuser = {};
  $scope.signupuser = {};
  $scope.signup=false;
  $scope.emailExist = false;
  $scope.successRegistr = false;
  $scope.showforgot = false;

  $scope.toggleForgot = function(e){
    
    e.preventDefault();
    $scope.showforgot = true;
  }

  $scope.getBack = function(userEmail){
    commonService.getData('POST','forgetpassword',{email:userEmail}).then(function(resp){
      
      commonService.stopSpinner();
      if(resp.data){
        if(resp.data.output=='No Data Found'){
          alert('wrong E-mail');
          return false;
        }
        $scope.showforgot = false;
        $scope.resetdone = true;

      }

    });

  }
  $scope.close=function(){
    $uibModalInstance.dismiss('close');
  }
  $scope.friend={};
 
  $rootScope.userData={};
  var id=localStorage.getItem('user');
  commonService.getData('GET','taxpayer-page/'+id).then(function(resp){
    $rootScope.userData= resp.data.data;
    });
 $scope.referRegister = function (friend) {
  
  

     
   var user_data= {rf_on_name:$scope.userData.first_name,rf_on_email:$scope.userData.email,rf_on_phone:$scope.userData.phone};
  var referal_data= angular.extend(user_data,$scope.friend);
  commonService.getData('POST','referral-friend',referal_data).then(function(resp){
  
   commonService.stopSpinner();
   $timeout(function(){
 alert("Your Firend has been Refered");
$uibModalInstance.dismiss('close');
},2000);
  
  
 });


}

  $scope.userlogin=function(loginuser){
   
    $scope.invalidCredentials = false;
    commonService.getData('POST','login',loginuser).then(function(resp){
    
     commonService.stopSpinner();
     if(resp.data.status=='sucess'){
      $scope.invalidCredentials = false;
      $scope.resetdone = false;
      $scope.successRegistr = false;
      if(resp.data.UserType=="Admin"){
        $state.go('admin.user');
        commonService.adminSession(resp.data.uid);
      }
      else if(resp.data.UserType=="Agent"){
        $state.go('Agent.user');
        commonService.adminSession(resp.data.uid);
      }
      else{
        commonService.sessionStart(resp.data.uid);
       // $state.go('user.user',{id:resp.data.uid});
        $state.go('user.home',{id:resp.data.uid});
      }
      

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
       
       commonService.stopSpinner();
       if(resp.data.output == 'exists'){
        $scope.emailExist = true;
        if(!$scope.$$phase){
          $scope.$apply();
        }
      }
      else{
        commonService.getData('POST','registration',signupuser).then(function(resp){
         
          commonService.stopSpinner();
          if(resp.data.Success == 'Registration Success'){
            alert("You Have successfully Regisered!");
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
}]);