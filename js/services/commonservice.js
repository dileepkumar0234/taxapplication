appinstal.factory("commonService", function($http,$rootScope,$timeout,$state,webServiceUrl) {
	
	var user_data = {};
	

	return {
		getData : function(method,url,data,headers){
           this.showProgress();
           // console.log('sarath:::',url,localStorage.getItem('user'),url,$state.current.name);
            if(localStorage.getItem('type')=='Admin'){

            }

            else if(url.indexOf('logout')==-1&&method=='GET'&&$state.current.name.indexOf('user')>-1&&url.indexOf(localStorage.getItem('user'))==-1){
            alert('Service Not Available!');
            this.sessionEnd();
            $state.go('main.home');
           	return false;	
            }
           
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
		sessionStart:function(id,type){
			$rootScope.loggedIn = true;
        localStorage.setItem('user',id);
        localStorage.setItem('type',type);
        
         },
         adminSession:function(id,type){
         	localStorage.setItem('admin',id);
         	localStorage.setItem('type',type);

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