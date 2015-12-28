
angular.module("myapp").controller("userdashboard",['$scope','$rootScope','$state','$stateParams','$uibModal','commonService',function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
  if(localStorage.getItem('user')==null){
     $state.go('main.home');
    return false;
  }

  if($state.current.url!='/'){
    $state.go('user.user');
  }
$scope.showProfile = false;
    $scope.openProfile = function(){
      $scope.showProfile = !$scope.showProfile;
    }



  $scope.response_user = $stateParams;
  $scope.upload ={};
  $scope.friend = {};
  $scope.change ={};
  $scope.wrong= false;
  $scope.resetOK=false;
  $scope.uid=$scope.response_user.id;
  $rootScope.userbody ='userbody';
  $scope.$on('destroy',function(){
    $rootScope.userbody ='';
  });
  $scope.logout = function(){
   commonService.getData('GET','logout/logout').then(function(resp){
    commonService.sessionEnd();
    commonService.stopSpinner();
    $state.go('main.home');
  });
 }
 

$scope.referRegister = function(){
  var user_data= {rf_on_name:$scope.userData.first_name,rf_on_email:$scope.userData.email,rf_on_phone:$scope.userData.phone};
  var referal_data= angular.extend(user_data,$scope.friend);
  commonService.getData('POST','referral-friend',referal_data).then(function(resp){
      alert("Changes Been Saved");
   commonService.stopSpinner();

   $scope.referalmodalInstance.dismiss('close');
 });
}
$scope.referals= function(){
  $scope.referalmodalInstance = $uibModal.open({
    templateUrl: 'templates/referafriend.html',
    scope:$scope,
         //   controller:'logInCtrl',
         size:'lg',
         windowClass:'animated rotateIn reference'
       }); 
}
$scope.changePassword = function(){
  commonService.getData('POST','changepassword',$scope.change).then(function(resp){
      alert("Changes Been Saved");
   commonService.stopSpinner();
   if(resp.data.status.indexOf('Updated')>-1){
    $scope.wrong= false;
    $scope.resetOK=true;
  }
  else{
    $scope.resetOK=false;
    $scope.wrong= true;
  }
});
}



}]);
