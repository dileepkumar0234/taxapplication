appinstal.factory("commonService", function($http,$rootScope) {
	var webServiceUrl="http://localhost/14-12-2015/umpire-tax-filler/ustaxfilerapis/";
	var user_data = {};

	return {
		getData : function(method,url,data){
console.log(this);
			return $http({
				method: method,
				url: webServiceUrl+url,
				data:data
			})
		},
		setuserData: function(data){
            user_data = data;
		},
		getUserData: function(){
             return user_data;
		},
		showProgress:function(){

             $rootScope.processing = 'inprogress'; 
		},
		stopSpinner: function(){
			$rootScope.processing = ''; 
		}
	}
});