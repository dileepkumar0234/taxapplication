
angular.module("myapp").controller("uploadController",['$scope','$rootScope','$state','$stateParams','$uibModal','commonService',function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 
$scope.x={};
$scope.uploading={};
$scope.uploading.update = false;

 $scope.uploadDocuments = function(){
  console.log($scope.x);
  if(!$scope.x.hid_Hsa){
    $scope.x.hid_Hsa =$scope.x.hsa;
    }
    if(!$scope.x.hid_Ira){
    $scope.x.hid_Ira =$scope.x.ira;
    }
    if(!$scope.x.hid_p1099int){
    $scope.x.hid_p1099int =$scope.x.p1099Int;
    }
    if(!$scope.x.hid_w_2){
    $scope.x.hid_w_2 =$scope.x.w2pdf;
    }
    if(!$scope.x.hid_health_card){
    $scope.x.hid_health_card =$scope.x.healthcard;
    }
   commonService.getData('PUT','uploadPdfs-page/'+$scope.response_user.id,$scope.x).then(function(resp){
        //console.log("success",resp);
        $scope.editMode = true;
        $scope.submitted = true;
        alert('Your Files has been uploaded!');
        $state.reload();
        if(!$scope.$$phase){
          $scope.$apply();
        }
      })
  
     
 }
 function getUploads(){
  commonService.getData('GET','uploadPdfs-page/'+$scope.response_user.id).then(function(resp){
    //console.log("uploads Are::",resp);
    if(resp.data.data=='No Data Found'){
          $scope.editProfile();
          $scope.submitted = true;
    }
    else{
      $scope.reset();
      $scope.x = resp.data.data;
    $scope.file_path= resp.data.file_path;
    }
    
    commonService.stopSpinner();
    
  });
}
getUploads();


$scope.editProfile =function(){
$scope.editMode = false;
//$scope.submitted = false;
}
$scope.reset = function(){
  $scope.editMode = true;
}
 



}]);
