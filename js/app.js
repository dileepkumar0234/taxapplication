var appinstal = angular.module("myapp", ['ui.router','ui.bootstrap','ngGrid']);


// UTSXXXX

appinstal.config(function($stateProvider, $urlRouterProvider)
{
  $stateProvider
  .state('main', {
    url: '/home',
    abstract: true,
    templateUrl:'templates/main.html',
    controller:'UmprireTaxController'
  })
  .state('main.home', {
    url: '',
    templateUrl:'templates/home.html'
  })
   .state('main.referalProgram', {
    url: '/referalProgram',
    templateUrl:'templates/ReferalProgram.html'
  })
  .state('main.firmProfile', {
    url: '/firmProfile',
    templateUrl:'templates/firmProfile.html'
  })
  .state('main.Service', {
    url: '/Service',
    templateUrl:'templates/services.html'
  })
  .state('main.tax_center', {
    url: '/tax_center',
    templateUrl:'templates/tax_center.html'
  })
  .state('main.carriers', {
    url: '/carriers',
    templateUrl:'templates/carriers.html'
  })
  .state('main.contactUs', {
    url: '/contactUs',
    templateUrl:'templates/contact.html'
  })
  .state('user', {
    url: '/user/:id',
    abstract: true,
    controller:'userdashboard',
    templateUrl:'templates/header.html'
  })
  .state('user.user', {
    url: '/',
    controller:'userController',
    templateUrl:'templates/user.html',
  })
  .state('user.spouse', {
    url: '/spouse',
    controller:'spouseController',
    templateUrl:'templates/spouse.html',
  })
  .state('user.dependants', {
    url: '/dependants',
controller:'dependantController',
    templateUrl:'templates/dependents.html',
  })
  .state('user.upload', {
    url: '/upload',
controller:'uploadController',
    templateUrl:'templates/uploadTaxDoc.html',
  })
  .state('user.schedule', {
    url: '/schedule',

controller:'scheduleController',
    templateUrl:'templates/schedule.html',
  })
  .state('user.change', {
    url: '/change',

    templateUrl:'templates/changepassword.html',
  })
  .state('admin', {
    url: '/admin',
    abstract: true,
      controller:'admin',
    templateUrl:'templates/header1.html'
  })
  .state('admin.user', {
    url: '/',
  
    templateUrl:'templates/admin.html'
  })
  .state('Agent', {
    url: '/Agent',
    abstract: true,
      controller:'AgentController',
    templateUrl:'templates/AgentMain.html'
  })
  .state('Agent.user', {
    url: '/',
  
    templateUrl:'templates/Agent.html'
  })
  
  $urlRouterProvider.otherwise('/home');
});











