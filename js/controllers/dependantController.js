angular.module("myapp").controller("dependantController", ['$scope','$rootScope','$state','$stateParams','$uibModal','commonService',function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 $scope.relations= ['Aunt','Brother','Daughter','Father','Mother','Nephew','Niece','Son','Sister','Uncle','others'];

function createDependant(){
  var new_dependant = {
    first_name:'',
    last_name:'',
    occupation:'',
    dob:'',
    address:'',
    phone:'',
    mail_id:''
  };
  return new_dependant;

}

$scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];

$scope.format = $scope.formats[0];

$scope.maxDate = new Date(2020, 5, 22);
$scope.dateOptions = {
  formatYear: 'yy',
  startingDay: 1
};
$scope.open = function($event,ind) {
  
  $scope.status[ind].opened = true;
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



$scope.getDependants = function(){
 commonService.getData('GET','dependent-page/'+$scope.response_user.id).then(function(resp){
   
   commonService.stopSpinner();
   if(resp.data.dep.length==0){
    $scope.dependants=[];
    var new_one = createDependant();
    $scope.status=[];
    $scope.dependants.push(new_one);
    $scope.status.push({opened: false});
    }
    else{
$scope.status=[];
       $scope.dependants = resp.data.dep;
       angular.forEach($scope.dependants,function(val,key){
        
        $scope.status.push({opened: false});
              if(val.dob!=""){
      var x= val.dob.split('-');
      if(x[1].length==1){
        x[1]="0"+parseInt(x[1]-1)
      }
      else{
        x[1]=parseInt(x[1]-1)
      }
      val.dob=new Date(x[2],x[1],x[0]);

      }
       });
    }
 
});
}
$scope.getDependants();


$scope.UpdateDependants = function(){
 
  angular.forEach($scope.dependants,function(val,key){
              if(val.dob!=""){
  if(val.dob)
var date_to_send=val.dob.getDate().toString()+"-"+(val.dob.getMonth()+1).toString()+"-"+val.dob.getFullYear().toString();
  else
    date_to_send="";
   
   val.dob=date_to_send;
 }
 });

 

  commonService.getData('POST','dependent-page',{dep:$scope.dependants}).then(function(resp){
   
   alert("You Info has been Updated!");
   commonService.stopSpinner();
  // $scope.editMode = true;
   $scope.getDependants();
 });
}

$scope.DeleteDependant = function(item,index){
  if(item.dependent_id=='' || !item.dependent_id){
$scope.dependants.splice(index,1);
  }
  else{
    commonService.getData('DELETE','dependent-page/'+item.dependent_id).then(function(resp){
    
    commonService.stopSpinner();
    $scope.getDependants();
   
    });
  }
    
}
$scope.addMore = function(){
  var new_one = createDependant();
  $scope.dependants.push(new_one);
}

$scope.editMode = /*true*/false;
$scope.editProfile =function(){
$scope.editMode = false;
}
$scope.reset = function(){
  //$scope.editMode = true;
  $scope.getDependants();
}
}]);