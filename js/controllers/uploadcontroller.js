
appinstal.controller("uploadController", function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 $scope.uploadDocuments = function(){
   console.log("upload Documents:::",$scope.upload);
 }
 function getUploads(){
  commonService.getData('GET','uploadPdfs-page?id='+$scope.response_user.id).then(function(resp){
    console.log("uploads Are::",resp);
    commonService.stopSpinner();
    
  });
}
getUploads();

});
