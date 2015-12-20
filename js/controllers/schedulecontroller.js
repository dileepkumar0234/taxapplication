
appinstal.controller("scheduleController", function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 

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

$scope.scheduling={};
$scope.scheduletimings =['10:00 Am - 10:30 Am','10:30 Am - 11:00 Am','11:00 Am - 11:30 Am'];

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

function getSchedule(){
  commonService.getData('GET','schedules-page?id='+$scope.response_user.id).then(function(resp){
    console.log("schedule::",resp);
    commonService.stopSpinner();
  });
}
$scope.ScheduleDT = function(){

  var x= new Date($scope.dt);
  var month = x.getMonth()+1;
  var date= x.getDate();
  var year = x.getFullYear();
  var final_date= date+"/"+month+"/"+year;
  console.log(final_date,$scope.scheduling);
  commonService.getData('POST','schedules-page',{schedule_dt:final_date,schedule_period:$scope.scheduling.schedule_period}).then(function(resp){
    console.log("schedule::",resp);
    getSchedule();
    commonService.stopSpinner();
  });
}
getSchedule();

});