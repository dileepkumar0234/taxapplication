
angular.module("myapp").controller("userController", ['$scope','$rootScope','$state','$stateParams','$uibModal','commonService',function($scope,$rootScope,$state,$stateParams,$uibModal,commonService) {
 //console.log("sarath:::",$scope.response_user);
 $scope.relations= ['Father','Mother','Son','Daughter','others'];
 $scope.havedependants = [{name:'Yes',status:2},{name:'No',status:1}];
 $scope.healthInsurance = ['Yes','No'];
 $scope.dependantData= ['Yes','No'];
 $scope.filing_status_type =['Single','Married  Jointly','Married Seperately'];

 $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
 $scope.Countries =['INDIA','US','OTHER'];
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
$scope.Countries=['INDIA','US','OTHER'];


function getUserData(){
  commonService.getData('GET','taxpayer-page/'+$scope.response_user.id).then(function(resp){
    //console.log("SpouseInfo",resp);
    commonService.stopSpinner();
    $scope.user = resp.data.data;
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
    $scope.states = [
    {id: 0, text: 'To be assigned'},
    {id: 1, text: 'Basic Info Pending'},
    {id: 2, text: 'Scheduling Pending'},
    {id: 3, text: 'Interview Pending'},
    {id: 4, text: 'Docs Upload Pending'},
    {id: 5, text: 'Other Docs Upload Pending'},
    {id: 6, text: 'Preparation Pending'},
    {id: 7, text: 'Synopsys Pending'},
    {id: 8, text: 'Payment Pending'},
    {id: 9, text: 'Review Pending'},
    {id: 10, text: 'Confirmation Pending'},
    {id: 11, text: 'Filing Pending'},
    {id: 12, text: 'E-Filing Complete'},
    {id: 13, text: 'Filing Docs Sent'}
    ];

    

    angular.forEach($scope.states,function(val,key){
      if(val.id==$rootScope.userData.ps_state){
        $rootScope.userData.FilingStatusCode = val.text;
      }
    })

  });
}
getUserData();
$scope.update = function(user){
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
  $scope.editMode = true;
}
}]);