appinstal.factory("commonService", function($http,$rootScope,$timeout,$state,webServiceUrl) {
	
	var user_data = {};
	

	return {
		getData : function(method,url,data,headers){
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
			$rootScope.loggedIn = true;
        localStorage.setItem('user',id);
        
         },
         adminSession:function(id){
         	localStorage.setItem('admin',id);

         },
         adminSessionEnd:function(){
           localStorage.removeItem('admin');
         },
		sessionEnd:function(id){
      $rootScope.loggedIn = false;
        localStorage.removeItem('user');
		}
	}
});