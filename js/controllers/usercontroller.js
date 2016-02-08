
angular.module("myapp").controller("userController", ['$scope','$rootScope','$state','$stateParams','$uibModal','commonService','States',function($scope,$rootScope,$state,$stateParams,$uibModal,commonService,States) {
 //console.log("sarath:::",$scope.response_user);
 $scope.relations= ['Father','Mother','Son','Daughter','others'];
 $scope.havedependants = [{name:'Yes',status:2},{name:'No',status:1}];
 $scope.healthInsurance = ['No','Yes'];
 $scope.dependantData= ['Yes','No'];
 $scope.filing_status_type =['Single','Married Filing Jointly','Married Filing Seperately','Head Of Household','Qualified Widow/er with Dependent Child'];

 $scope.formats = ['dd-MMMM-yyyy', 'MM/dd/yyyy', 'dd.MM.yyyy', 'shortDate'];
 $scope.Countries =['INDIA','US','OTHER'];
 $scope.format = $scope.formats[1];
 $scope.status = {
  opened: false
};
$scope.maxDate = new Date(2020, 5, 22);
$scope.dateOptions = {
  formatYear: 'yyyy',
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
$scope.Countries=['INDIA','US','OTHER'];


function getUserData(){
  commonService.getData('GET','taxpayer-page/'+$scope.response_user.id).then(function(resp){
   // console.log("SpouseInfo",resp);
    commonService.stopSpinner();
    $scope.user = resp.data.data;
    $scope.oldData=angular.copy($scope.user);
    if($scope.user.dob!=""){
      var x= $scope.user.dob.split('-');
      if(x[1].length==1){
        x[1]="0"+parseInt(x[1]-1)
      }
      else{
        x[1]=parseInt(x[1]-1)
      }
      $scope.user.dob=new Date(x[2],x[1],x[0]);

    }

    $scope.user.dependent=Number($scope.user.dependent)
    $rootScope.userData= resp.data.data;
    $scope.states = States;

    

    angular.forEach($scope.states,function(val,key){
      if(val.id==$rootScope.userData.ps_state){
        $rootScope.userData.FilingStatusCode = val.text;
      }
    })



  });
}
getUserData();
$scope.update = function(form,user){
  if(form.$invalid==true){
    alert('Please Fill the Form');
    return false;
  }
  //console.info(user);
  if(user.dob)
    var date_to_send=user.dob.getDate().toString()+"-"+(user.dob.getMonth()+1).toString()+"-"+user.dob.getFullYear().toString();
  else
    date_to_send="";
  //console.log(date_to_send);

  var data ={
    user_name:user.first_name,
    inputLastname:user.last_name,
    dob:date_to_send,
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
    tax_id:user.tax_id_type,
    cLocation:user.c_location,
    country_name:user.country_name,
    ssnitin:user.ssnitin
  }
  commonService.getData('PUT','taxpayer-page/'+$scope.response_user.id,data).then(function(resp){
   //console.log("User updated:::",resp);
   alert("You Info has been Updated!");
   commonService.stopSpinner();
   //$scope.editMode = true;
   getUserData();
 });
}
$scope.editMode = /*true*/false;
$scope.editProfile =function(){
  $scope.editMode = false;
}
$scope.reset = function(){
  //$scope.editMode = true;
 getUserData();
   //$scope.user=$scope.oldData;
}
}]);