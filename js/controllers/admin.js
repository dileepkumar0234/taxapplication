angular.module("myapp").controller("admin",['$scope','$rootScope','$state','$uibModal','commonService','$timeout','$http',function($scope,$rootScope,$state,$uibModal,commonService,$timeout,$http) {
	
	$timeout(function(){
		$rootScope.shownow=true;
	},1000);
	if(Object.keys(localStorage).indexOf('admin')==-1)
	{
		$state.go('main.home');
		return false;
	}
	$scope.cols=[];
	$scope.searchColText={};
    $scope.getTotalReferals = function(e){
      e.preventDefault();
      commonService.getData('GET','get-referral').then(function(resp){

			//console.info(resp.data.refferalContacts);
	$scope.coldefs=[{field: 'rf_name', displayName: 'Client Name'},
	{field:'rf_email', width:200,displayName:'Client Email id'},
	{field:'rf_phone', displayName:'Phone Number'},
	{field:'rf_on_name', displayName:'Refered Name'},
	{field:'rf_on_email', displayName:'Refered Email id'},
	{field:'rf_on_phone', displayName:'Refered Phone'},
	{field:'rf_comment', displayName:'Description'}
	];
	$scope.allUsers = resp.data.refferalContacts;
			commonService.stopSpinner();
		});
    };
	$scope.AlreadyAssigned = true;
	$scope.coldefs=[{field: 'user_name', displayName: 'Client Name'},
	{field:'email', width:200,displayName:'Email id',cellTemplate: '<div  ng-click="foo(row)" ng-bind="row.getProperty(col.field)"></div>'},
	{field:'ssnitin', displayName:'SSN'},
	{field:'user_id', displayName:'File Number'},
	{field:'user_id', displayName:'Payment Info'},
	{field:'client_name', displayName:'Assigned'}
	];
	$scope.cols=['user_name','email','ssnitin','user_id'];
	$scope.selectedCol=$scope.cols[2];
	$scope.getSortMethod = function(val){
		
		$scope.selectedCol=val;
	}
	$scope.$watch('searchColText.search',function(val){
		
$scope.searchColText.search = val;
	},true);
	$scope.SearchCategory = function(){
		$scope.sortedList=[];
		var count=0;
		angular.forEach($scope.orgData,function(item,i){
			//console.info(item,$scope.selectedCol);
			if(item[$scope.selectedCol]!=null){
				
				if(item[$scope.selectedCol].toLowerCase()==$scope.searchColText.search.toLowerCase() ){
					$scope.sortedList.push($scope.orgData[i]);
				} 
				else{
					count=count+1;
				}
			}


		});
		
		if(count==$scope.orgData.length)
			$scope.allUsers=$scope.orgData;
		else
		$scope.allUsers=$scope.sortedList;
	}

	$scope.gridOptions = { 
		enableFiltering: true,
		data: 'allUsers',
		multiSelect:false,
		//	jqueryUITheme: true,
			columnDefs: 'coldefs'//,
			//filterOptions:  $scope.filterOptions
		};
		$scope.filterOptions= {
			filterText: '',
			externalFilter: 'searchText',
			useExternalFilter: true
		}



		commonService.getData('GET','user-list').then(function(resp){

			$scope.totalCount= resp.data.success.length;
			$scope.allUsers=resp.data.success;
			$scope.orgData=angular.copy($scope.allUsers);
			commonService.stopSpinner();
		});

		commonService.getData('GET','count-each-stages').then(function(resp){

			$scope.count= resp.data;
			commonService.stopSpinner();
		});
		commonService.getData('GET','get-unlists/1').then(function(resp){

			$scope.UnListMembers = resp.data.UnListUser;
		});


		$scope.logout = function(){
			commonService.adminSessionEnd();
			commonService.getData('GET','admin-logout/something').then(function(resp){
				$state.go('main.home');
			});
		}


		$scope.assignedChange = function(item,row){

			$scope.optionSelected = item;
			$scope.user_id_selected=row.entity.user_id;


		}
		$scope.assignConfirm = function(){

			commonService.getData('POST','assign-user',{unlists_u_id:$scope.optionSelected.user_id,client_id:$scope.user_id_selected}).then(function(resp){

				$state.reload();

			});
		}

		

		$scope.RefreshGrid = function(e,i){

			e.preventDefault();
			if(i=='total'){
				$state.reload();
				return false;
			}
			$scope.home_banner = true;
			$scope.userSelected = false;
			commonService.getData('GET','get-processing-info/'+i).then(function(resp){

				if(i==0){
					$scope.x=[];
					$scope.allUsers=resp.data.list;
					angular.forEach($scope.allUsers,function(val,key){
						if(val.client_name!=null){
							angular.forEach($scope.UnListMembers,function(v,k){
								if(v.user_name==val.client_name)
									$scope.x[key]=v;
							})

						}

					});
					$scope.coldefs=[{field: 'user_name', displayName: 'Client Name'},
					{field:'email', width:200,displayName:'Email id',cellTemplate: '<div  ng-click="foo(row)" ng-bind="row.getProperty(col.field)"></div>'},
					{field:'ssnitin', displayName:'SSN'},
					{field:'user_id', displayName:'File Number'},
					{field:'user_id', displayName:'Payment Info'},
					{field:'client_name', displayName:'Assigned',cellTemplate:"<select ng-change='assignedChange(x[row.rowIndex],row)' ng-model='x[row.rowIndex]' ng-options='item.user_name  for item in UnListMembers'></select><button ng-click='assignConfirm();'>Assign</button>"
				}
				];
				

			}
			else{
				$scope.allUsers=resp.data.list;
				$scope.coldefs=[{field: 'user_name', displayName: 'Client Name'},
				{field:'email', width:200,displayName:'Email id',cellTemplate: '<div  ng-click="foo(row)" ng-bind="row.getProperty(col.field)"></div>'},
				{field:'ssnitin', displayName:'SSN'},
				{field:'user_id', displayName:'File Number'},
				{field:'user_id', displayName:'Payment Info'},
				{field:'client_name', displayName:'Assigned'}
				];
			}
			
			commonService.stopSpinner();
		});

}

$scope.foo = function(resp){

	if(resp.client_name!=null){
		$scope.AlreadyAssigned = false;
	}
	else{
		$scope.AlreadyAssigned = true;
	}
	$scope.userSelected = true;
	$scope.home_banner = true;
	$scope.user_id=resp.entity.user_id;
	$scope.getComments();
	$scope.getCurrentInfo(0);
}
$scope.userstatus ={};

$scope.getCurrentInfo = function(index){

	angular.forEach($scope.user_details_tabs,function(val,key){
		if(key==index){

			val.show = true;
			if(index==0){
				commonService.getData('GET','taxpayer-page/'+$scope.user_id).then(function(resp){
					
					$scope.PayerInfo= resp.data.data;
					$scope.PayerInfo.ps_state=$scope.states[Number($scope.PayerInfo.ps_state)];
					
					if($scope.PayerInfo.dob!=null&&$scope.PayerInfo.dob!=''){
						var x= $scope.PayerInfo.dob.split('-');
						if(x[1].length==1){
							x[1]="0"+parseInt(x[1]-1)
						}
						else{
							x[1]=parseInt(x[1]-1)
						}
						$scope.PayerInfo.dob=x[0]+"/"+x[1]+"/"+x[2];

					}
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
			else if(index==7){

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
{label:'Schedule Time',show:false},
{label:'Download documents',show:false},
{label:'Upload documents',show:false},
{label:'File Status',show:false},
	{label:'Payment info',show:false}//,
	//{label:'Assigned To',show:false}
	];
	$scope.states = [
	{id: -1, text: 'Select an option'},
	{id: 0, text: 'To Be Assigned'},
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
	$scope.changeState = function(index){
		if(index.id!=-1){
			$scope.selectedState = index.id;
		}
	/*if($scope.states[index].checked==true)
	$scope.selectedState = $scope.states[index].id+1;*/
}

$scope.getComments = function(){
 commonService.getData('GET','comments-list/'+$scope.user_id).then(function(resp){
		$scope.TotalComments = resp.data.data;
		commonService.stopSpinner();
	});
};

$scope.updateStatus = function(){
	commonService.getData('PUT','update-process/'+$scope.user_id,
		{ps_state:$scope.selectedState,comment:$scope.userstatus.comment}).then(function(resp){
		$state.reload();

		commonService.stopSpinner();
	});
}

$scope.inquires = function(e){
	e.preventDefault();
	commonService.getData('GET','get-all-reach').then(function(resp){
		$scope.userSelected = false;
                   //console.log(resp);                   
                   commonService.stopSpinner();
                   $scope.allUsers=resp.data.allContacts;
                   $scope.coldefs=[{field: 'c_name', displayName: 'Client Name'},

                   {field:'c_phone', displayName:'Phone Number'},
                   {field:'c_email', displayName:'E-Mail'},
                   {field:'c_message', displayName:'Message'}
                   ];


               });
}
}]);