angular.module("myapp").controller("referalController", ['$scope','commonService',function($scope,commonService) {
commonService.getData('GET','get-friends/'+$scope.response_user.id).then(function(resp){
    console.log("Referals",resp);
    $scope.referalsList=resp.data.reFFeral;
   
  });
}]);