appinstal.factory("commonService", function($http,$rootScope,$timeout,$state) {
	var webServiceUrl="http://localhost/taxapplication/trunk/ustaxfilerapis/";
	var user_data = {};
	var idleTimer;

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
        var totalIdleTime = 5*60*1000;  
        var x=this;
         idleTimer = $timeout(function () {

        //   x.sessionEnd(); 
        //   alert('Your Session Expired');
         //  x.getData('GET','logout/logout');
         // $state.go('main.home');
          }, totalIdleTime);
         },
		sessionEnd:function(id){
        $timeout.cancel(idleTimer);
        localStorage.removeItem('user');
		}
	}
});