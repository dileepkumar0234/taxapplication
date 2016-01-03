angular.module("myapp").controller("referalController", ['$scope','commonService',function($scope,commonService) {

$scope.gridOptions = { 
		enableFiltering: true,
		data: 'referalsList',
		multiSelect:false,
		//	jqueryUITheme: true,
			columnDefs: 'coldefs'//,
			//filterOptions:  $scope.filterOptions 
		};

$scope.coldefs=[
    {displayName:'S.NO', cellTemplate: '<div class="ngCellText" data-ng-class="col.colIndex()"><span>{{row.rowIndex + 1}}</span></div>'},
	{field:'rf_name', displayName:'Name'},
	{field:'rf_email', displayName:'Email id'},
	{field:'rf_phone', displayName:'Phone Number'},
	{field:'rf_comment', displayName:'Comment'}
	];
    

commonService.getData('GET','get-friends/'+$scope.response_user.id).then(function(resp){
    
    
    if(resp.data.reFFeral==''){
    $scope.notfound = true;
    }
    else{
    	
    	$scope.notfound = false;
    	$scope.referalsList=resp.data.reFFeral;
    }
		
    
   
  });
}]);