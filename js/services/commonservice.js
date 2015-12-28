appinstal.factory("commonService", function($http,$rootScope,$timeout,$state) {
	var webServiceUrl="http://umpiretaxsolutions.com/services/";
	var user_data = {};
	

	return {
		getData : function(method,url,data){
           this.showProgress();
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
		},
		sessionStart:function(id){
        localStorage.setItem('user',id);
        
         },
		sessionEnd:function(id){
      
        localStorage.removeItem('user');
		}
	}
});