angular.module("myapp").controller("UmprireTaxController",['$scope','$rootScope','$state','$uibModal','commonService','$timeout','$window',function($scope,$rootScope,$state,$uibModal,commonService,$timeout,$window) {
  $scope.oneAtATime = true;


  $scope.status = {
    isFirstOpen: false,
    isFirstDisabled: false
  };
 
   $scope.mainmodalInstance = $uibModal.open({
     // animation: $scope.animationsEnabled,
      templateUrl: 'myModalContent.html',
      scope:$scope,
      windowClass:'mainpop'
     // controller: 'ModalInstanceCtrl',
      //size: size,
      
    });

    $scope.ok = function () {
    $scope.mainmodalInstance.close();
  };

  $scope.cancel = function () {
    $scope.mainmodalInstance.dismiss('cancel');
  };



  $timeout(function(){
    $rootScope.shownow=true;
  },1000);
  $scope.service_list= false;
  $scope.friend ={};
  if (localStorage.getItem("user") === null) {
    $rootScope.userExist = false;
  }
  else{
    $rootScope.userExist = true;
    $rootScope.user_exist_id=localStorage.getItem('user');
  }
  $scope.goToDashboard = function(){
    $state.go('user.user',{id:$rootScope.user_exist_id});
  }
  
  $rootScope.userbody ='';
  
  $scope.checkemail = function(email){
    
    
  }

  $scope.contactform ={};
  $scope.contactusService = function(form,data){
    if(form.$invalid){
      return false;
    }
    commonService.getData('POST','contact-us',data).then(function(resp){
      
     $scope.contactform ={};
     $scope.willcontact=true;
     $timeout(function(){
      alert('We Will Reach you Shortly!');
      $scope.willcontact=false;
    },5000);
   });

  };


/*$scope.forgotPassword = function(){
  
  $scope.modalInstance .close();
  var referalmodalInstance1 = $uibModal.open({
    templateUrl: 'templates/forgot.html',
    scope:$scope,
         //   controller:'logInCtrl',
         size:'sm',
         windowClass:'animated rotateIn forg'
       }); 
}*/


$scope.referals= function(){
  if(localStorage.getItem('user')==null){
    alert('Please login to Refer!');
    return false;
  }
    
  $scope.referalmodalInstance = $uibModal.open({
    templateUrl: 'templates/referafriend.html',
    
    controller:'logInCtrl',
    size:'md',
    windowClass:'animated  top_view reference'
  }); 
}

$scope.scrollIt = function(e,id){
  e.preventDefault();
  
  $('html, body').animate({
    scrollTop: $('#'+id).offset().top
  }, 500);
  return false;
};



$(window).scroll(function() {
  st=$(window).scrollTop();



  if(st>100){
    $('.top').show();
  }else{
    $('.top').hide();
  }




});
$scope.moveTop = function(){
 $("html, body").animate({ scrollTop: 0 }, 600);
 return false;
}


$scope.current=$state.current.name;

$rootScope.$on('$stateChangeSuccess', 
  function(event, toState, toParams, fromState, fromParams){ 
   
    $scope.current=$state.current.name;
  });

$scope.OpenLogin=function($event){
      //  $event.preventDefault();
      $scope.modalInstance = $uibModal.open({
        templateUrl: 'templates/login.html',
        controller:'logInCtrl',
        size:'lg',
        windowClass:'animated  top_view'
      }); 
    }

    
    $('.popup_main  ul li:first-child').click(function(){
      $('.signup').show();
      $('.login').hide();
      $('.popup_main  ul li').removeClass('active')
      $(this).addClass('active');

      $('.popup_main').css({'height':'500px'});

    });
    $('.popup_main  ul li:last-child').click(function(){
      $('.signup').hide();
      $('.login').show();
      $('.popup_main  ul li').removeClass('active')
      $(this).addClass('active');

      $('.popup_main').css({'height':'280px'});
    });



    var wind_ht= $(window).height()+800;

    $('.alpha').click(function(){

      $(this).animate({top: -wind_ht},'fast');
      $('.popup_main').animate({top: -wind_ht},'fast');


    });
    $('.login_btn').click(function(){

      $('.alpha').animate({top: 0},'fast');
      $('.popup_main').animate({top: 0},'fast');


    });
    $scope.stateDetails=[
    {"state":"","value":"Select an option","refLink":""},
    {"state":"AL","value":"Alabama","refLink":"https://myalabamataxes.alabama.gov/_/#1"},
    {"state":"AR","value":"Arkansas","refLink":"https://atap.arkansas.gov/_/#1"},
    {"state":"Ak","value":"Alaska","refLink":""},
    {"state":"AZ","value":"Arizona","refLink":"https://www.aztaxes.gov/Home"},
    {"state":"CA","value":"California","refLink":"https://www.ftb.ca.gov/online/refund/index.asp"},
    {"state":"CO","value":"Colorado","refLink":"https://www.colorado.gov/revenueonline/_/#2"},
    {"state":"CT","value":"Connecticut","refLink":"www.ct.gov/drs/myrefund"},
    {"state":"DE","value":"Delaware","refLink":"https://dorweb.revenue.delaware.gov/scripts/refinq/refinq.dll"},
    {"state":"FL","value":"Florida","refLink":"https://taxapps.state.fl.us/Refunds/"},
    {"state":"GA","value":"Georgia","refLink":"https://gtc.dor.ga.gov/_/#1"},
    {"state":"HI","value":"Hawaii","refLink":"https://tax.ehawaii.gov/hoihoi/refund.html"},
    {"state":"IA","value":"Iowa","refLink":"https://www.idr.iowa.gov/wheresmyrefund/"},
    {"state":"ID","value":"Idaho","refLink":"https://idahotap.gentax.com/TAP/_/"},
    {"state":"IL","value":"Illinois","refLink":"https://www.revenue.state.il.us/app/refund/index.html"},
    {"state":"IN","value":"Indiana","refLink":"https://secure.in.gov/apps/dor/tax/refund/"},
    {"state":"KS","value":"Kansas","refLink":"https://www.kdor.org/refundstatus/default.asp"},
    {"state":"LA","value":"Louisiana","refLink":"https://esweb.revenue.louisiana.gov/wheresmyrefund/"},
    {"state":"ME","value":"Maine","refLink":"https://portal.maine.gov/refundstatus/Registration.do;jsessionid=ede81f8754d50f0856586ac0f9904b3bba7df40ef2ffffea115761afbf73105c.e34Mb38PchyPbi0Lah90"},
    {"state":"MD","value":"Maryland","refLink":"https://interactive.marylandtaxes.com/INDIV/refundstatus/home.aspx"},
    {"state":"MA","value":"Massachusetts","refLink":"https://wfb.dor.state.ma.us/webfile/wsi/"},
    {"state":"MI","value":"Michigan","refLink":"http://www.michigan.gov/taxes/0,1607,7-238-43513-157514--,00.html"},
    {"state":"MN","value":"Minnesota","refLink":"https://www.mndor.state.mn.us/tp/refund/_/"},
    {"state":"MS","value":"Mississippi","refLink":"www.dor.ms.gov/inquiry"},
    {"state":"MO","value":"Missouri","refLink":"https://dors.mo.gov/tax/taxinq/welcome.jsp"},
    {"state":"MT","value":"Montana","refLink":"https://tap.dor.mt.gov/mt_xwTapRfn.aspx"},
    {"state":"NE","value":"Nebraska","refLink":""},
    {"state":"NV","value":"Nevada","refLink":"https://www.nevadatax.nv.gov/web/"},
    {"state":"NJ","value":"New Jersey","refLink":"https://www16.state.nj.us/TYTR_TGI_INQ/jsp/prompt.jsp"},
    {"state":"NM","value":"New Mexico","refLink":"http://www.tax.newmexico.gov/Individuals/individuals-where-is-my-refund.aspx"},
    {"state":"NY","value":"New York","refLink":"https://www8.tax.ny.gov/PRIS/prisStart"},
    {"state":"NC","value":"North Carolina","refLink":"https://eservices.dor.nc.gov/wheresmyrefund/SelectionServlet"},
    {"state":"ND","value":"North Dakota","refLink":"https://apps.nd.gov/tax/tap/_/"},
    {"state":"OH","value":"Ohio","refLink":"http://www.tax.ohio.gov/ohio_individual/individual/filefaster.aspx"},
    {"state":"OK","value":"Oklahoma","refLink":"http://www.ok.gov/tax/Individuals/Income_Tax/Filing_Information/How_to_Check_on_a_Refund/"},
    {"state":"PA","value":"Pennsylvania","refLink":"https://www.doreservices.state.pa.us/pitservices/wheresmyrefund.aspx"},
    {"state":"RI","value":"Rhode Island","refLink":"https://www.ri.gov/taxation/refund/"},
    {"state":"SC","value":"South Carolina","refLink":"https://www3.sctax.org/refundstatus/refund.aspx"},
    {"state":"UT","value":"Utah","refLink":"http://incometax.utah.gov/refunds/wheres-my-refund"},
    {"state":"VT","value":"Vermont","refLink":"https://secure.vermont.gov/TAX/refund/"},
    {"state":"VA","value":"Virginia","refLink":"https://www.individual.tax.virginia.gov/VTOL/IndRefundStatus.seam?CFID=10172687&CFTOKEN=24426951"},
    {"state":"WI","value":"Wisconsin","refLink":"https://ww2.revenue.wi.gov/RefundInquiry/request.html"}];
    
//$scope.selectedState=$scope.stateDetails[0];
$scope.viewPage=function(currentState){
  if(currentState.refLink!='')
    $window.open(currentState.refLink,'_blank');
}
}]);