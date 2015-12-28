
angular.module("myapp").controller("scheduleController",['$scope','$rootScope','$state','$stateParams','$uibModal','commonService',function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 

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
$scope.scheduletimings =['10:00 Am - 10:30 Am','10:30 Am - 11:00 Am','11:00 Am - 11:30 Am',
'11:30 Am - 12:00 pm','12:00 pm - 1:00 pm','1:00 pm - 2:00 pm',
'2:00 pm - 2:30 pm','2:30 pm - 3:00 pm','3:00 pm - 3:30 pm',
'3:30 pm - 4:00 pm','4:00 pm - 4:30 pm','4:30 pm - 5:30 pm',
'5:30 pm - 6:00 pm'
];

$scope.open = function($event) {
  $scope.status.opened = true;
};
$scope.today = function() {
  //$scope.dt = new Date();
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
  commonService.getData('GET','schedules-page/'+$scope.response_user.id).then(function(resp){
       $scope.scheduleInfo= resp.data.data;
    if($scope.scheduleInfo.schedule_dt!=""){
      var x= $scope.scheduleInfo.schedule_dt.split('-');
      if(x[1].length==1){
        x[1]="0"+parseInt(x[1]-1)
      }
      else{
        x[1]=parseInt(x[1]-1)
      }
      $scope.dt=new Date(x[2],x[1],x[0]);

      }
    commonService.stopSpinner();
  });
}
$scope.ScheduleDT = function(){


  var x= new Date($scope.dt);
  var month = x.getMonth()+1;
  var date= x.getDate();
  var year = x.getFullYear();
  var final_date= date+"-"+month+"-"+year;

  commonService.getData('POST','schedules-page',{schedule_dt:final_date,schedule_period:$scope.scheduling.schedule_period}).then(function(resp){
      alert("Changes Been Saved");
    getSchedule();
    $scope.editMode = true;

    commonService.stopSpinner();
  });
}
getSchedule();


$scope.editMode = true;
$scope.editProfile =function(){
$scope.editMode = false;
}
$scope.reset = function(){
  $scope.editMode = true;
}
$scope.setTime = function(ind){
  $scope.scheduling.schedule_period = $scope.scheduletimings[ind];
}

}]);