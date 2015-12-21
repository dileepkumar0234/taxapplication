appinstal.controller("UmprireTaxController",function($scope,$rootScope,$state,$uibModal,commonService) {

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
 $scope.referRegister = function (friend) {
  console.log("friend",friend);


}

$scope.checkemail = function(email){
  console.log("checkemail",email);
  
}


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
  $scope.referalmodalInstance = $uibModal.open({
    templateUrl: 'templates/referafriend.html',
    
     controller:'logInCtrl',
         size:'lg',
         windowClass:'animated rotateIn reference'
       }); 
}

$scope.scrollIt = function(e,id){
  e.preventDefault();
  console.log(e.target.getAttribute('href'),id);
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


console.log($state.current.name);
$scope.current=$state.current.name;

$rootScope.$on('$stateChangeSuccess', 
  function(event, toState, toParams, fromState, fromParams){ 
    console.log($state.current.name);
    $scope.current=$state.current.name;
  });

$scope.OpenLogin=function($event){
      //  $event.preventDefault();
      $scope.modalInstance = $uibModal.open({
        templateUrl: 'templates/login.html',
          controller:'logInCtrl',
         size:'lg',
         windowClass:'animated rotateIn top_view'
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

  });