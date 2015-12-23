angular.module("myapp").controller("admin",['$scope','$rootScope','$state','$uibModal','commonService',function($scope,$rootScope,$state,$uibModal,commonService) {
	$scope.AlreadyAssigned = true;
	$scope.coldefs=[{field: 'user_name', displayName: 'Client Name'},
			{field:'email', width:200,displayName:'Email id',cellTemplate: '<div  ng-click="foo(row)" ng-bind="row.getProperty(col.field)"></div>'},
		{field:'phone', displayName:'Phone num'},
		{field:'user_id', displayName:'File Number'},
		{field:'user_id', displayName:'Payment Info'},
		{field:'client_name', displayName:'Assigned'}
		];
	$scope.gridOptions = { 
			data: 'allUsers',
			multiSelect:false,
		//	jqueryUITheme: true,
			columnDefs: 'coldefs'
	};

	commonService.getData('GET','user-list').then(function(resp){
		console.log("user Data::",resp);
		$scope.totalCount= resp.data.success.length;
		$scope.allUsers=resp.data.success;
		
	commonService.stopSpinner();
});

	commonService.getData('GET','count-each-stages').then(function(resp){
		console.log("count Data::",resp);
		$scope.count= resp.data;
		commonService.stopSpinner();
	});
	commonService.getData('GET','get-unlists/1').then(function(resp){
		console.log("Unlist Members::",resp);
		$scope.UnListMembers = resp.data.UnListUser;
	});




	
	$scope.assignedChange = function(item,row){
console.info("Unlist Change:",item,row);
$scope.optionSelected = item;
$scope.user_id_selected=row.entity.user_id;


	}
	$scope.assignConfirm = function(){

		commonService.getData('POST','assign-user',{unlists_u_id:$scope.optionSelected.user_id,client_id:$scope.user_id_selected}).then(function(resp){
		console.log("Assign check::",resp);
		$state.reload();
		
	       });
	}

	$scope.uploadSynopsys = function(event){
			console.log(event);
	var files = event.target.files[0];
      var form_data= new FormData();           
      form_data.append("file", files) ;
      commonService.getData('PUT','uploadPdfs-page/'+$scope.user_id,form_data).then(function(resp){
        console.log("Synopsys",resp);
      })
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
			console.log("To Be assigned::",resp);
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
		{field:'phone', displayName:'Phone num'},
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
		{field:'phone', displayName:'Phone num'},
		{field:'user_id', displayName:'File Number'},
		{field:'user_id', displayName:'Payment Info'},
		{field:'client_name', displayName:'Assigned'}
		];
			}
			
		commonService.stopSpinner();
	     });

	}

	$scope.foo = function(resp){
		console.log(resp);
		if(resp.client_name!=null){
			$scope.AlreadyAssigned = false;
		}
		else{
			$scope.AlreadyAssigned = true;
		}
		$scope.userSelected = true;
		$scope.home_banner = true;
		$scope.user_id=resp.entity.user_id;
		$scope.getCurrentInfo(0);
	}

	$scope.getCurrentInfo = function(index){
		console.log(index);
		angular.forEach($scope.user_details_tabs,function(val,key){
			if(key==index){
				console.log(val);
				val.show = true;
				if(index==0){
				commonService.getData('GET','taxpayer-page/'+$scope.user_id).then(function(resp){
					console.log("Tax payer",resp.data.data);
					$scope.PayerInfo= resp.data.data;
					if($scope.PayerInfo.dob!=""){
      var x= $scope.PayerInfo.dob.split('-');
      if(x[1].length==1){
        x[1]="0"+parseInt(x[1]-1)
      }
      else{
        x[1]=parseInt(x[1]-1)
      }
      $scope.PayerInfo.dob=new Date(x[2],x[1],x[0]);

      }
					commonService.stopSpinner();

				});	
				}
				else if(index==1){
					commonService.getData('GET','spouse-page?id='+$scope.user_id).then(function(resp){
					console.log("Spouse Info payer",resp.data.data);
					$scope.SpouseInfo= resp.data.data;
					commonService.stopSpinner();

				    });
				    commonService.getData('GET','dependent-page?id='+$scope.user_id).then(function(resp){
					console.log("Dependants Info payer",resp.data.dep);
					$scope.dependants= resp.data.dep;
					commonService.stopSpinner();

				    });	
				}
				else if(index==2){
					commonService.getData('GET','schedules-page?id='+$scope.user_id).then(function(resp){
                    console.log("schedule::",resp);
                    $scope.scheduleInfo=resp.data.data;
                    commonService.stopSpinner();
                     });
				}
				else if(index==3){
					commonService.getData('GET','uploadPdfs-page?id='+$scope.user_id).then(function(resp){
                    console.log("Uploads::",resp);
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
		console.info($scope.user_details_tabs);
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
	{label:'Payment info',show:false},
	{label:'Assigned To',show:false}
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
	console.info($scope.states[index]);
	if($scope.states[index].checked==true)
		$scope.selectedState = $scope.states[index].id+1;
}
$scope.updateStatus = function(){
            commonService.getData('PUT','update-process/'+$scope.user_id,{ps_state:$scope.selectedState}).then(function(resp){
                    console.log("status::",resp);
                    /*$scope.file_path=resp.data.file_path;
                    $scope.uploads=resp.data.data;*/
                    commonService.stopSpinner();
                     });
}
}]);