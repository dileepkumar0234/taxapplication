
appinstal.controller("userController", function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 console.log("sarath:::",$scope.response_user);
 $scope.relations= ['Father','Mother','Son','Daughter','others'];
 $scope.havedependants = [{name:'Yes',status:2},{name:'No',status:1}];
 $scope.dependantData= ['Yes','No'];
  function getUserData(){
    commonService.getData('GET','taxpayer-page?id='+$scope.response_user.id).then(function(resp){
      console.log("SpouseInfo",resp);
      commonService.stopSpinner();
      $scope.user = resp.data.data;
      $scope.user.dependent=Number($scope.user.dependent)
      $rootScope.userData= resp.data.data;
      $scope.states = [
    {id: 0, text: 'Basic Info Pending'},
    {id: 1, text: 'Scheduling Pending'},
    {id: 2, text: 'Interview Pending'},
    {id: 3, text: 'Docs Upload Pending'},
    {id: 4, text: 'Other Docs Upload Pending'},
    {id: 5, text: 'Preparation Pending'},
    {id: 6, text: 'Synopsys Pending'},
    {id: 7, text: 'Payment Pending'},
    {id: 8, text: 'Review Pending'},
    {id: 9, text: 'Confirmation Pending'},
    {id: 10, text: 'Filing Pending'},
    {id: 11, text: 'E-Filing Complete'},
    {id: 12, text: 'Filing Docs Sent'}
    ];

    

    angular.forEach($scope.states,function(val,key){
      if(val.id+1==$rootScope.userData.filling_status){
        $rootScope.userData.FilingStatusCode = val.text;
      }
    })
      
    });
  }
  getUserData();
  $scope.update = function(user){
console.info(user);
    
  var data ={
    user_name:user.first_name,
    inputLastname:user.last_name,
    dob:user.dob,
    occupation:user.occupation,
    filling_status:user.filling_status,
    dependent:user.dependent.toString(),
    addr:/*user.address*/user.apt_no+","+user.city_name+","+user.zip+","+user.state_name,
    apt_no:user.apt_no,
    city_name:user.city_name,
    state_name:user.state_name,
    zipcode:user.zip,
    inputTelephone:user.phone,
    work_phone:user.alterphone,
    mail_id:user.email,
    c_e:user.current_emp,
    tax_id:'',
    cLocation:user.c_location,
  }
  commonService.getData('PUT','taxpayer-page/'+$scope.response_user.id,data).then(function(resp){
   console.log("User updated:::",resp);
   commonService.stopSpinner();
   $scope.editMode = true;
   getUserData();
 });
}
$scope.editMode = true;
$scope.editProfile =function(){
$scope.editMode = false;
}
$scope.reset = function(){
  $scope.editMode = true;
}
});