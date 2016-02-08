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
	$scope.uploading={};
	$scope.pagingOptions = {
		pageSizes: [10,20,50],
		pageSize: 20,
		currentPage: 1
	};
	$scope.getTotalReferals = function(e){	
		
		e.preventDefault();
		$scope.home_banner = true;
		$scope.userSelected = false;
		commonService.getData('GET','get-referral').then(function(resp){
			$scope.coldefs=[
			{displayName:'S.NO', width:50,cellTemplate: '<div class="ngCellText" data-ng-class="col.colIndex()"><span>{{row.rowIndex + 1}}</span></div>'},
			
			{field: 'rf_name', width:200,displayName: 'Client Name',resizable:true},
			{field:'rf_email', width:200,displayName:'Client Email id',resizable:true},
			{field:'rf_phone', width:'*', displayName:'Phone Number',resizable:true},
			{field:'rf_on_name', width:'*', displayName:'Refered Name',resizable:true},
			{field:'rf_on_email', width:'*', displayName:'Refered Email id',resizable:true},
			{field:'rf_on_phone',width:'*', displayName:'Refered Phone',resizable:true},
			{field:'rf_comment', width:'**',displayName:'Description',resizable:true}
			];
			$scope.allUsers = resp.data.refferalContacts;
			$scope.pagingOptions.currentPage= 1;
			if(!$scope.$$phase)
				$scope.$apply();
			$scope.backupCopy = angular.copy($scope.allUsers);
			$scope.setPagingData($scope.allUsers,$scope.pagingOptions.currentPage,$scope.pagingOptions.pageSize);
			
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
$scope.cols=['first_name','last_name','email','phone','unique_code'];
$scope.selectedCol=$scope.cols[2];
$scope.getSortMethod = function(val){
	
	$scope.selectedCol=val;
}
$scope.$watch('searchColText.search',function(val){
	
	$scope.searchColText.search = val;
},true);
$scope.SearchCategory = function(){
	$scope.home_banner = true;
	$scope.userSelected = false;
	$scope.sortedList=[];
	var count=0;
	angular.forEach($scope.orgData,function(item,i){
			//console.info(item,$scope.selectedCol);
			if(item[$scope.selectedCol]!=null){
				if($scope.selectedCol=='ssnitin'){
					if(item[$scope.selectedCol].toLowerCase().indexOf('-'+$scope.searchColText.search.toLowerCase())>-1 ){
						$scope.sortedList.push($scope.orgData[i]);
					} 
					else{
						count=count+1;
					}
				}
				else{
					if(item[$scope.selectedCol].toLowerCase()==$scope.searchColText.search.toLowerCase() ){
						$scope.sortedList.push($scope.orgData[i]);
					} 
					else{
						count=count+1;
					}
				}
				
				
			}


		});
	
	if(count==$scope.orgData.length)
		$scope.allUsers=[];
	else
		$scope.allUsers=$scope.sortedList;
	//console.log($scope.allUsers);
}
$scope.setPagingData = function(data, page, pageSize){
	var data = $scope.backupCopy;
	var pagedData = data.slice((page - 1) * pageSize, page * pageSize);
	$scope.allUsers = pagedData;
	$scope.totalServerItems = $scope.backupCopy.length;
	if (!$scope.$$phase) {
		$scope.$apply();
	}
};

$scope.$watch('pagingOptions', function (newVal, oldVal) {
	if (newVal !== oldVal || newVal.currentPage !== oldVal.currentPage) {
		$scope.setPagingData($scope.allUsers,$scope.pagingOptions.currentPage,$scope.pagingOptions.pageSize);
	}
}, true);

//$scope.getPagedDataAsync($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage); 
$scope.gridOptions = { 
	enableFiltering: true,
	data: 'allUsers',
	multiSelect:false,
	showFooter: true,
	enablePaging:true,
	enableColumnResize:true,
	totalServerItems: 'totalServerItems',
	footerTemplate:'templates/footerTemplate.html',
	pagingOptions: $scope.pagingOptions,
		//	jqueryUITheme: true,
			columnDefs: 'coldefs'//,
			//filterOptions:  $scope.filterOptions
		};
		$scope.filterOptions= {
			filterText: '',
			externalFilter: 'searchText',
			useExternalFilter: true
		}


        $scope.allUsers = [];
		commonService.getData('GET','user-list').then(function(resp){

			$scope.totalCount= resp.data.success.length;
			$scope.allUsers=resp.data.success;
			$scope.orgData=angular.copy($scope.allUsers);
			$scope.backupCopy = angular.copy($scope.allUsers);
			$scope.setPagingData($scope.allUsers,$scope.pagingOptions.currentPage,$scope.pagingOptions.pageSize);
			
			commonService.stopSpinner();
		});
		$scope.getCount = function(){
			commonService.getData('GET','count-each-stages').then(function(resp){

				$scope.count= resp.data;
				commonService.stopSpinner();
			});
		}
		$scope.getCount();
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
			
			
			$scope.pagingOptions.currentPage= 1;
			if(!$scope.$$phase)
				$scope.$apply();
			$scope.backupCopy = angular.copy($scope.allUsers);
			$scope.setPagingData($scope.allUsers,$scope.pagingOptions.currentPage,$scope.pagingOptions.pageSize);
			
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
	$scope.fileNumber=resp.entity.unique_code;
	$scope.getComments();
	$scope.getCurrentInfo(0);
}
$scope.userstatus ={};

$scope.getCurrentInfo = function(index){
	$scope.currentTab = index;

	angular.forEach($scope.user_details_tabs,function(val,key){
		if(key==index){

			val.show = true;
			if(index==0){
				commonService.getData('GET','taxpayer-page/'+$scope.user_id).then(function(resp){
					
					$scope.PayerInfo= resp.data.data;
					angular.forEach($scope.states,function(val,key){
						if(val.id==Number($scope.PayerInfo.ps_state)){
							$scope.PayerInfo.ps_state=val;	
						}


					});
					
					if($scope.PayerInfo.dob!=null&&$scope.PayerInfo.dob!=''){
						var x= $scope.PayerInfo.dob.split('-');
						if(x[1].length==1){
							x[1]="0"+parseInt(x[1])
						}
						else{
							x[1]=parseInt(x[1])
						}
						$scope.PayerInfo.dob=x[1]+"/"+x[0]+"/"+x[2];

					}
					commonService.stopSpinner();

				});	
			}
			else if(index==1){
				commonService.getData('GET','spouse-page?id='+$scope.user_id).then(function(resp){
					
					$scope.SpouseInfo= resp.data.data;
					commonService.stopSpinner();
					if($scope.SpouseInfo.dob!=null&&$scope.SpouseInfo.dob!=''){
						var x= $scope.SpouseInfo.dob.split('-');
						if(x[1].length==1){
							x[1]="0"+parseInt(x[1])
						}
						else{
							x[1]=parseInt(x[1])
						}
						$scope.SpouseInfo.dob=x[1]+"/"+x[0]+"/"+x[2];

					}


				});
				commonService.getData('GET','dependent-page?id='+$scope.user_id).then(function(resp){
					
					$scope.dependants= resp.data.dep;
					commonService.stopSpinner();
					angular.forEach($scope.dependants,function(val,key){
						if(val.dob!=null&&val.dob!=''){
							var x= val.dob.split('-');
							if(x[1].length==1){
								x[1]="0"+parseInt(x[1])
							}
							else{
								x[1]=parseInt(x[1])
							}
							val.dob=x[1]+"/"+x[0]+"/"+x[2];

						}
					});


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
					if(resp.data.data=='No Data Found'){
						$scope.noData = false;
					}
					else{
						$scope.noData = true;
						$scope.file_path=resp.data.file_path;
						$scope.uploads=resp.data.data;
						commonService.stopSpinner();
					}
					
				});
			}
			else if(index==4){
				commonService.getData('GET','get-user-synopsy/'+$scope.user_id).then(function(resp){
					if(resp.data.data!="No Data Found"){
						$scope.synopsys_file=resp.data.data;
						$scope.file_path= resp.data.file_path;
					}
					else{
						$scope.synopsys_file=[];
					}
					



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
	{id: 11, text: 'E-Filing Pending'},
	{id: 12, text: 'Paper-Filing Pending'},
	{id: 13, text: 'E-Filing Complete'},
	{id: 14, text: 'Filing Docs Sent'},
	{id: 15, text: 'Cancel Filing'}
	];
	$scope.changeState = function(index){
		if(index.id!=-1){
			$scope.selectedState = index.id;
		}

	}

	$scope.getComments = function(){
		commonService.getData('GET','comments-list/'+$scope.user_id).then(function(resp){
			$scope.TotalComments = resp.data.data;
			commonService.stopSpinner();
		});
	};

	$scope.updateStatus = function(){
		if(!$scope.selectedState)
			$scope.selectedState = $scope.PayerInfo.ps_state.id;
		commonService.getData('PUT','update-process/'+$scope.user_id,
			{ps_state:$scope.selectedState,comment:$scope.userstatus.comment}).then(function(resp){
				$scope.getComments();
				$scope.userstatus.comment = undefined;

				$scope.getCount();
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
                   $scope.pagingOptions.currentPage= 1;
                   if(!$scope.$$phase)
                   	$scope.$apply();
                   $scope.backupCopy = angular.copy($scope.allUsers);
                   $scope.setPagingData($scope.allUsers,$scope.pagingOptions.currentPage,$scope.pagingOptions.pageSize);


               });
		}
	}]);