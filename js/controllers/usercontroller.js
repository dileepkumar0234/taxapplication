
appinstal.controller("userController", function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 console.log("sarath:::",$scope.response_user);
 $scope.relations= ['Father','Mother','Son','Daughter','others'];
  function getUserData(){
    commonService.getData('GET','taxpayer-page?id='+$scope.response_user.id).then(function(resp){
      console.log("SpouseInfo",resp);
      commonService.stopSpinner();
      $scope.user = resp.data.data;
    });
  }
  getUserData();
  $scope.update = function(user){
  var data ={
    user_name:user.first_name,
    inputLastname:user.last_name,
    dob:user.dob,
    occupation:user.occupation,
    filling_status:user.filling_status,
    dependent:user.dependent,
    addr:user.address,
    apt_no:user.apt_no,
    city_name:'',
    state_name:user.state_name,
    zipcode:user.zip,
    inputTelephone:user.phone,
    work_phone:user.alterphone,
    mail_id:user.email,
    c_e:user.current_emp,
    tax_id:'',
    cLocation:user.c_location,
  }
  commonService.getData('PUT','taxpayer-page/'+$scope.response_user.id,data).then(function(resp){
   console.log("User updated:::",resp);
   commonService.stopSpinner();
   $scope.editMode = true;
   getUserData();
 });
}
$scope.editMode = true;
$scope.editProfile =function(){
$scope.editMode = false;
}
$scope.reset = function(){
  $scope.editMode = true;
}
});