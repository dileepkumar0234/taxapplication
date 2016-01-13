
angular.module("myapp").controller("uploadController",['$scope','$rootScope','$state','$stateParams','$uibModal','commonService',function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 
$scope.x={};
$scope.uploading={};
$scope.uploading.update = false;

 $scope.uploadDocuments = function(){
   commonService.getData('PUT','uploadPdfs-page/'+$scope.response_user.id,$scope.x).then(function(resp){
        //console.log("success",resp);
        $scope.editMode = true;
        $scope.submitted = false;
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
