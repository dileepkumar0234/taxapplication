
angular.module("myapp").controller("spouseController", ['$scope','$rootScope','$state','$stateParams','$uibModal','commonService',function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];

$scope.format = $scope.formats[0];
$scope.status = {
  opened: false
};
$scope.maxDate = new Date(2020, 5, 22);
$scope.dateOptions = {
  formatYear: 'yy',
  startingDay: 1
};
$scope.open = function($event) {
  $scope.status.opened = true;
};
$scope.today = function() {
  $scope.dt = new Date();
};
$scope.today();

$scope.toggleMin = function() {
  $scope.minDate = $scope.minDate ? null : new Date();
};
$scope.toggleMin();

$scope.disabled = function(date, mode) {
  return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
};

function getSpouseInfo(){
  commonService.getData('GET','spouse-page/'+$scope.response_user.id).then(function(resp){
    //console.log("SpouseInfo",resp);
    commonService.stopSpinner();
    if(resp.data.data==''){
     $scope.spouse = {};
   }
   else{
    $scope.spouse = resp.data.data;
    if($scope.spouse.dob!=""){
      var x= $scope.spouse.dob.split('-');
      if(x[1].length==1){
        x[1]="0"+parseInt(x[1]-1)
      }
      else{
        x[1]=parseInt(x[1]-1)
      }
      $scope.spouse.dob=new Date(x[2],x[1],x[0]);

      }
  }

});
}
$scope.updatespouse = function(){
  //console.info($scope.spouse,"spouse Details");
  if($scope.spouse.dob)
var date_to_send=$scope.spouse.dob.getDate().toString()+"-"+($scope.spouse.dob.getMonth()+1).toString()+"-"+$scope.spouse.dob.getFullYear().toString();
  else
    date_to_send="";
  $scope.spouse.dob=date_to_send;
   //console.log(date_to_send);

  commonService.getData('POST','spouse-page',$scope.spouse).then(function(resp){
   //console.log("Spouse updated:::",resp);
   alert("You Info has been Updated!");
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
}]);