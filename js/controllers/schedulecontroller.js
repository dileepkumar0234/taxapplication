
angular.module("myapp").controller("scheduleController",['$scope','$rootScope','$state','$stateParams','$uibModal','commonService',function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 

$scope.formats = ['dd-MMMM-yyyy', 'MM/dd/yyyy', 'dd.MM.yyyy', 'shortDate'];

$scope.format = $scope.formats[1];
$scope.status = {
  opened: false
};
$scope.maxDate = new Date(2020, 5, 22);
$scope.dateOptions = {
  formatYear: 'yyyy',
  startingDay: 1
};

$scope.scheduling={};
$scope.scheduletimings =['select an option','9:00 am','9:30 am','10:00 am',
'10:30 am','11:00 am','11:30 am',
'12:00 pm','12:30 pm','1:00 pm',
'1:30 pm','2:00 pm','2:30 pm',
'3:00 pm','3:30 pm','4:00 pm','4:30 pm','5:00 pm','5:30 pm','6:00 pm','6:30 pm'
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

function getSchedule(val){
  commonService.getData('GET','schedules-page/'+$scope.response_user.id).then(function(resp){
    //console.log("schedule::",resp);

if(resp.data.data==""&&!val){
$scope.editMode = true;
$scope.scheduleInfo={};
  return false;

}
else if(val){
  $scope.editMode = true;
}
else{
  $scope.editMode = false;
}


    $scope.scheduleInfo= resp.data.data;
    if($scope.scheduleInfo!='' && $scope.scheduleInfo.schedule_dt!=""){
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

$scope.Edit = function(){
 // console.log('im in');
  getSchedule('s');
  $scope.editMode = true;
}
$scope.newDate = function(dt){
//console.log($scope.dt,dt);
$scope.dt=dt;
}
$scope.ScheduleDT = function(){
//console.log($scope.scheduling.schedule_period);

  var x= new Date($scope.dt);
  var month = x.getMonth()+1;
  var date= x.getDate();
  var year = x.getFullYear();
  var final_date= date+"-"+month+"-"+year;
  //console.log(final_date,$scope.scheduleInfo);
  commonService.getData('POST','schedules-page',{schedule_dt:final_date,schedule_period:$scope.scheduleInfo.schedule_period}).then(function(resp){
    //console.log("schedule::",resp);
    getSchedule();
   // $scope.editMode = false;
    alert("You Info has been Updated!");

    commonService.stopSpinner();
  });
}
getSchedule();


//$scope.editMode = true;
$scope.editProfile =function(){
$scope.editMode = false;
}

$scope.setTime = function(ind){
  if(ind.indexOf('select')>-1){
     $scope.scheduleInfo.schedule_period = '';
  }
  else{
    $scope.scheduleInfo.schedule_period =ind;
  }
 
}

}]);