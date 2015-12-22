appinstal.controller("dependantController", function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 $scope.relations= ['Father','Mother','Son','Daughter','others'];

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



$scope.getDependants = function(){
 commonService.getData('GET','dependent-page?id='+$scope.response_user.id).then(function(resp){
   console.log("Dependants are::::",resp);
   commonService.stopSpinner();
   if(resp.data.dep.length==0){
    $scope.dependants=[];
    var new_one = createDependant();
    $scope.dependants.push(new_one);
  }
  $scope.dependants = resp.data.dep;
});
}
$scope.getDependants();


$scope.UpdateDependants = function(){
  console.log($scope.dependants);

  commonService.getData('POST','dependent-page',{dep:$scope.dependants}).then(function(resp){
   console.log("post",resp);
   commonService.stopSpinner();
   $scope.editMode = true;
   $scope.getDependants();
 });
}

$scope.DeleteDependant = function(item,index){
  if(item.dependent_id==''){
$scope.dependants.splice(index,1);
  }
  else{
    commonService.getData('DELETE','dependent-page/'+item.dependent_id).then(function(resp){
    console.log("Dependant deleted:::",resp);
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
  $scope.editMode = true;
}
});