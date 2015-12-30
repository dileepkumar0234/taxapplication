angular.module("myapp").controller("AgentController",['$scope','$rootScope','$state','$uibModal','commonService',function($scope,$rootScope,$state,$uibModal,commonService) {
	
	$scope.gridOptions = { 
		data: 'allUsers',
		multiSelect:false,
		//	jqueryUITheme: true,
		columnDefs: [{field: 'user_name', displayName: 'Client Name'},
		{field:'email', width:200,displayName:'Email id',cellTemplate: '<div  ng-click="foo(row)" ng-bind="row.getProperty(col.field)"></div>'},
		{field:'phone', displayName:'Phone num'},
		{field:'user_id', displayName:'File Number'},
		{field:'user_id', displayName:'Payment Info'},
		{field:'user_id', displayName:'Assigned'}
		]
	};

	commonService.getData('GET','user-list').then(function(resp){
		
		$scope.totalCount= resp.data.success.length;
		$scope.allUsers=resp.data.success;
		
		commonService.stopSpinner();
	});

	commonService.getData('GET','count-each-stages').then(function(resp){
		
		$scope.count= resp.data;
		commonService.stopSpinner();
	});



	$scope.RefreshGrid = function(e,i){

		e.preventDefault();
		if(i=='total'){
			$state.reload();
			return false;
		}
		$scope.home_banner = true;
		$scope.userSelected = false;
		commonService.getData('GET','get-processing-info/'+i).then(function(resp){
			$scope.allUsers=resp.data.list;
			commonService.stopSpinner();
		});

	}

	$scope.foo = function(resp){
		
		$scope.userSelected = true;
		$scope.home_banner = true;
		$scope.user_id=resp.entity.user_id;
		$scope.getCurrentInfo(0);
	}

	$scope.getCurrentInfo = function(index){
		
		angular.forEach($scope.user_details_tabs,function(val,key){
			if(key==index){
			
				val.show = true;
				if(index==0){
					commonService.getData('GET','taxpayer-page?id='+$scope.user_id).then(function(resp){
						
						$scope.PayerInfo= resp.data.data;
						commonService.stopSpinner();

					});	
				}
				else if(index==1){
					commonService.getData('GET','spouse-page?id='+$scope.user_id).then(function(resp){
						
						$scope.SpouseInfo= resp.data.data;
						commonService.stopSpinner();

					});
					commonService.getData('GET','dependent-page?id='+$scope.user_id).then(function(resp){
						
						$scope.dependants= resp.data.dep;
						commonService.stopSpinner();

					});	
				}
				else if(index==2){
					commonService.getData('GET','schedules-page?id='+$scope.user_id).then(function(resp){
						
						$scope.scheduleInfo=resp.data.data;
						commonService.stopSpinner();
					});
				}
				else if(index==3){
					commonService.getData('GET','uploadPdfs-page?id='+$scope.user_id).then(function(resp){
						
						$scope.file_path=resp.data.file_path;
						$scope.uploads=resp.data.data;
						commonService.stopSpinner();
					});
				}
				else if(index==5){
					
				}
				

			}
			else{
				val.show = false;
			}

		});
}

$scope.home_banner = true;
$scope.userSelected = false;

$scope.user_details_tabs =[
{label:'Basic Info',show:false},
{label:'Other info',show:false},
{label:'Scheduling Time',show:false},
{label:'Download documents',show:false},
{label:'Upload documents',show:false},
{label:'File no',show:false},
{label:'Payment info',show:false}
];
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
$scope.changeState = function(index){
	
	if($scope.states[index].checked==true)
		$scope.selectedState = $scope.states[index].id+1;
}
$scope.updateStatus = function(){
	commonService.getData('PUT','update-process/'+$scope.user_id,{ps_state:$scope.selectedState}).then(function(resp){
		
                    /*$scope.file_path=resp.data.file_path;
                    $scope.uploads=resp.data.data;*/
                    commonService.stopSpinner();
                });
}
}]);