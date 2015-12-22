
appinstal.controller("spouseController", function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 
function getSpouseInfo(){
  commonService.getData('GET','spouse-page?id='+$scope.response_user.id).then(function(resp){
    console.log("SpouseInfo",resp);
    commonService.stopSpinner();
    if(resp.data.data==''){
     $scope.spouse = {};
   }
   else{
    $scope.spouse = resp.data.data;
  }

});
}
$scope.updatespouse = function(){
  console.info($scope.spouse,"spouse Details");
  commonService.getData('POST','spouse-page',$scope.spouse).then(function(resp){
   console.log("Spouse updated:::",resp);
   getSpouseInfo();
   $scope.editMode = true;
   commonService.stopSpinner();
 });
}
getSpouseInfo();
$scope.editMode = /*true*/false;
$scope.editProfile =function(){
$scope.editMode = false;
}
$scope.reset = function(){
  $scope.editMode = true;
}
});