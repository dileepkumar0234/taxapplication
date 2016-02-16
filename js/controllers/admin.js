angular.module("myapp").controller("admin",['$scope','$rootScope','$state','$uibModal','commonService','$timeout','$http','ColDefs','States',function($scope,$rootScope,$state,$uibModal,commonService,$timeout,$http,ColDefs,States) {
	
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

	$scope.AlreadyAssigned = true;
	$scope.coldefs=ColDefs.Basic;
	$scope.states = States;
	$scope.cols=['first_name','last_name','email','phone','unique_code'];
	$scope.selectedCol=$scope.cols[2];
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
		columnDefs: 'coldefs'
	};
	
	$scope.allUsers = [];
	$scope.userstatus ={};

	

	$scope.user_details_tabs =[
	{label:'Basic Info',show:false},
	{label:'Other info',show:false},
	{label:'Schedule Time',show:false},
	{label:'Download documents',show:false},
	{label:'Upload documents',show:false},
	{label:'File Status',show:false},
	{label:'Payment info',show:false}
	];

	function HomeBanner(){
		$scope.home_banner = true;
		$scope.userSelected = false;
	}

	function SetPagination(){
		console.info('Hi:::',$scope.allUsers);
		$scope.pagingOptions = {
			pageSize: 20,
			currentPage: 1
		};
		//$scope.pagingOptions.currentPage= 1;
		if(!$scope.$$phase)
			$scope.$apply();
		$scope.backupCopy = angular.copy($scope.allUsers);
		$scope.setPagingData($scope.backupCopy,$scope.pagingOptions.currentPage,$scope.pagingOptions.pageSize);

	}
	HomeBanner();
    $scope.pageSize = 20;
	$scope.setPagingData = function(data, page){
		console.log(data,page);
		$scope.ActiveIndex = page;
		var data = $scope.backupCopy;

		var pagedData = data.slice((page - 1) * $scope.pageSize, page * $scope.pageSize);
		$scope.allUsers = pagedData;
		$scope.totalServerItems = $scope.backupCopy.length;
		$scope.pages = Math.ceil($scope.totalServerItems / $scope.pageSize);
		$scope.EachPage = [];
		for(var i=0;i<$scope.pages;i++)
		$scope.EachPage.push(i);
		//console.log($scope.pages,$scope.totalServerItems);
		$scope.maxSize = 5;
		if (!$scope.$$phase) {
			$scope.$apply();
		}
	};

	$scope.selectPage = function(index,e){
		console.log("CLicked:::",index,e);
		$scope.setPagingData($scope.backupCopy,index);

	}
	
	$scope.getTotalReferals = function(e){	
		
		e.preventDefault();
		HomeBanner();
		commonService.getData('GET','get-referral').then(function(resp){
			$scope.coldefs= ColDefs.Referals;
			$scope.allUsers = resp.data.refferalContacts;
			SetPagination();
			commonService.stopSpinner();
		});
	};

	$scope.getSortMethod = function(val){

		$scope.selectedCol=val;
	}
	$scope.$watch('searchColText.search',function(val){

		$scope.searchColText.search = val;
	},true);
	$scope.SearchCategory = function(){
		HomeBanner();
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
	}
	

	/*$scope.$watch('pagingOptions.currentPage', function (newVal, oldVal) {
		console.log(newVal,oldVal);
		if(newVal)
			if (newVal !== oldVal) {
				$scope.setPagingData($scope.allUsers,$scope.pagingOptions.currentPage,$scope.pagingOptions.pageSize);
			}
		}, true);
*/

	commonService.getData('GET','user-list').then(function(resp){

		$scope.totalCount= resp.data.success.length;
		$scope.allUsers=resp.data.success;
		$scope.orgData=angular.copy($scope.allUsers);
		SetPagination();
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
		HomeBanner();
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
				$scope.coldefs=ColDefs.SelectAssigned;


			}
			else{
				$scope.allUsers=resp.data.list;

				$scope.coldefs=ColDefs.Assigned;
			}

			commonService.stopSpinner();


			SetPagination();
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
			commonService.stopSpinner();
			$scope.allUsers=resp.data.allContacts;
			$scope.coldefs=ColDefs.inquires;
			SetPagination();

		});
	}
}]);