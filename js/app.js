var appinstal = angular.module("myapp", ['ui.router','ui.bootstrap','ngGrid','oc.lazyLoad']);


// UTSXXXX


appinstal.config(function($stateProvider, $urlRouterProvider,$ocLazyLoadProvider)
{
  $stateProvider
  .state('main', {
    url: '/home',
    abstract: true,
    templateUrl:'templates/main.html',
    controller:'UmprireTaxController',
     resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load({
                    files: [
                            //TODO add all the required css and js

                            'js/controllers/maincontroller.js',
                            'js/controllers/login.js',
                            'js/services/commonservice.js',
                            'js/commondirective.js'
                        ]
                });
            }]
        }
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
    templateUrl:'templates/header.html',
     resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load({
                    files: [
                            //TODO add all the required css and js
      
                            'js/controllers/userdashboard.js',
                      
                            'js/services/commonservice.js',
                            'js/commondirective.js'

                        ]
                });
            }]
        }
  })
  .state('user.user', {
    url: '/',
    controller:'userController',
    templateUrl:'templates/user.html',
    resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load({
                    files: [
                            //TODO add all the required css and js
      
                            'js/controllers/usercontroller.js'

                        ]
                });
            }]
        }
  })
  .state('user.spouse', {
    url: '/spouse',
    controller:'spouseController',
    templateUrl:'templates/spouse.html',
    resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load({
                    files: [
                            //TODO add all the required css and js
      
                            'js/controllers/spousecontroller.js'

                        ]
                });
            }]
        }
  })
  .state('user.dependants', {
    url: '/dependants',
controller:'dependantController',
    templateUrl:'templates/dependents.html',
    resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load({
                    files: [
                            //TODO add all the required css and js
      
                            'js/controllers/dependantController.js'

                        ]
                });
            }]
        }
  })
  .state('user.upload', {
    url: '/upload',
controller:'uploadController',
    templateUrl:'templates/uploadTaxDoc.html',
    resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load({
                    files: [
                            //TODO add all the required css and js
      
                            'js/controllers/uploadcontroller.js'

                        ]
                });
            }]
        }
  })
  .state('user.schedule', {
    url: '/schedule',

controller:'scheduleController',
    templateUrl:'templates/schedule.html',
    resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load({
                    files: [
                            //TODO add all the required css and js
      
                            'js/controllers/schedulecontroller.js'

                        ]
                });
            }]
        }
  })
  .state('user.change', {
    url: '/change',

    templateUrl:'templates/changepassword.html',
  })
  .state('user.referals', {
    url: '/referals',
  controller:'referalController',
    templateUrl:'templates/viewReferals.html',
     resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load({
                    files: [
                            //TODO add all the required css and js
      
                            'js/controllers/ReferalController.js'

                        ]
                });
            }]
        }
  })
  .state('admin', {
    url: '/admin',
    abstract: true,
      controller:'admin',
    templateUrl:'templates/header1.html',
     resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load({
                    files: [
                            //TODO add all the required css and js
       'js/services/commonservice.js',
                            'js/controllers/admin.js'

                        ]
                });
            }]
        }
  })
  .state('admin.user', {
    url: '/',
  
    templateUrl:'templates/admin.html'
  })
  .state('Agent', {
    url: '/Agent',
    abstract: true,
      controller:'AgentController',
    templateUrl:'templates/AgentMain.html',
    resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                return $ocLazyLoad.load({
                    files: [
                            //TODO add all the required css and js
      
                            'js/controllers/AgentController.js'

                        ]
                });
            }]
        }
  })
  .state('Agent.user', {
    url: '/',
  
    templateUrl:'templates/Agent.html'
  })
  
  $urlRouterProvider.otherwise('/home');
  $ocLazyLoadProvider.config({
      debug: true,
      events: true
    });

});


 







