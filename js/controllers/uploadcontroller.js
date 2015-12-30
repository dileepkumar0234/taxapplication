
angular.module("myapp").controller("uploadController",['$scope','$rootScope','$state','$stateParams','$uibModal','commonService',function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 $scope.uploadDocuments = function(){
   //console.log("upload Documents:::",$scope.upload);
 }
 function getUploads(){
  commonService.getData('GET','uploadPdfs-page/'+$scope.response_user.id).then(function(resp){
    //console.log("uploads Are::",resp);
    $scope.uploads = resp.data.data;
    $scope.file_path= resp.data.file_path;
    commonService.stopSpinner();
    
  });
}
getUploads();

$scope.editMode = true;
$scope.editProfile =function(){
$scope.editMode = false;
}
$scope.reset = function(){
  $scope.editMode = true;
}

}]);
