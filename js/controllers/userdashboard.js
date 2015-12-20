
appinstal.controller("userdashboard", function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
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
    console.log("logout",resp);
    commonService.stopSpinner();
    $state.go('main.home');
  });
 }
 

$scope.referRegister = function(){
  var user_data= {rf_on_name:$scope.user.first_name,rf_on_email:$scope.user.email,rf_on_phone:$scope.user.phone};
  var referal_data= angular.extend(user_data,$scope.friend);
  commonService.getData('POST','referral-friend',referal_data).then(function(resp){
   console.log("Refered:::",resp);
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
   console.log("reset",resp);
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
$scope.setTime = function(ind){
  $scope.scheduling.schedule_period = $scope.scheduletimings[ind];
}


});
