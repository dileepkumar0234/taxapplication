var appinstal = angular.module("myapp", ['ui.router','ui.bootstrap','ngGrid','oc.lazyLoad']);

var webServiceUrl="http://localhost/taxapplication/trunk/ustaxfilerapis/";
// var webServiceUrl="https://www.umpiretaxsolutions.com/services/";
appinstal.constant('webServiceUrl',webServiceUrl);
appinstal.constant('States',[
  {id: -1, text: 'Select an option'},
  {id: 0, text: 'To Be Assigned'},
  {id: 1, text: 'Basic Info Pending'},
  {id: 2, text: 'Scheduling Pending'},
  {id: 3, text: 'Interview Pending'},
  {id: 4, text: 'Docs Upload Pending'},
  {id: 5, text: 'Other Docs Upload Pending'},
  {id: 6, text: 'Preparation Pending'},
  {id: 7, text: 'Synopsys Pending'},
  {id: 8, text: 'Payment Pending'},
  {id: 9, text: 'Review Pending'},
  {id: 10, text: 'Confirmation Pending'},
  {id: 11, text: 'E-Filing Pending'},
  {id: 12, text: 'Paper-Filing Pending'},
  {id: 13, text: 'E-Filing Complete'},
  {id: 14, text: 'Filing Docs Sent'},
  {id: 15, text: 'Cancel Filing'}
  ]);
appinstal.constant('ColDefs',{
  'Referals':[{displayName:'S.NO', width:50,cellTemplate: '<div class="ngCellText" data-ng-class="col.colIndex()"><span>{{row.rowIndex + 1}}</span></div>'},
  {field: 'rf_name', width:200,displayName: 'Client Name',resizable:true},
  {field:'rf_email', width:200,displayName:'Client Email id',resizable:true},
  {field:'rf_phone', width:'*', displayName:'Phone Number',resizable:true},
  {field:'rf_on_name', width:'*', displayName:'Refered Name',resizable:true},
  {field:'rf_on_email', width:'*', displayName:'Refered Email id',resizable:true},
  {field:'rf_on_phone',width:'*', displayName:'Refered Phone',resizable:true},
  {field:'rf_comment', width:'**',displayName:'Description',resizable:true}
  ],
  "Basic":[{field: 'user_name', displayName: 'Client Name'},
  {field:'email', width:200,displayName:'Email id',cellTemplate: '<div  ng-click="foo(row)" ng-bind="row.getProperty(col.field)"></div>'},
  {field:'ssnitin', displayName:'SSN'},
  {field:'user_id', displayName:'File Number'},
  {field:'user_id', displayName:'Payment Info'},
  {field:'client_name', displayName:'Assigned'}
  ],
  'SelectAssigned':[{field: 'user_name', displayName: 'Client Name'},
  {field:'email', width:200,displayName:'Email id',cellTemplate: '<div  ng-click="foo(row)" ng-bind="row.getProperty(col.field)"></div>'},
  {field:'ssnitin', displayName:'SSN'},
  {field:'user_id', displayName:'File Number'},
  {field:'user_id', displayName:'Payment Info'},
  {field:'client_name', displayName:'Assigned',cellTemplate:"<select ng-change='assignedChange(x[row.rowIndex],row)' ng-model='x[row.rowIndex]' ng-options='item.user_name  for item in UnListMembers'></select><button ng-click='assignConfirm();'>Assign</button>"}
  ],
  'Assigned': [{field: 'user_name', displayName: 'Client Name'},
  {field:'email', width:200,displayName:'Email id',cellTemplate: '<div  ng-click="foo(row)" ng-bind="row.getProperty(col.field)"></div>'},
  {field:'ssnitin', displayName:'SSN'},
  {field:'user_id', displayName:'File Number'},
  {field:'user_id', displayName:'Payment Info'},
  {field:'client_name', displayName:'Assigned'}
  ],
  'inquires':[{field: 'c_name', displayName: 'Client Name'},
  {field:'c_phone', displayName:'Phone Number'},
  {field:'c_email', displayName:'E-Mail'},
  {field:'c_message', displayName:'Message'}
  ]

});

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
                            'js/controllers/usercontroller.js',
                            'js/services/commonservice.js',
                            'js/commondirective.js'

                            ]
                          });
      }]
    }
  })
.state('user.home', {
  url: '/',
  controller:'userController',
  templateUrl:'templates/userhome.html'
})
.state('user.user', {
  url: '/main',
  controller:'userController',
  templateUrl:'templates/user.html',
  resolve: {
    deps: ['$ocLazyLoad', function ($ocLazyLoad) {
      return $ocLazyLoad.load({
        files: [
                            'js/controllers/usercontroller.js'

                            ]
                          });
    }]
  } })
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
.state('user.Summary', {
  url: '/Summary',

  templateUrl:'templates/Summary.html',
})
.state('user.payment', {
  url: '/payment',

  templateUrl:'templates/payment.html',
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
                            'js/controllers/admin.js',
                            'js/commondirective.js'

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

                            'js/controllers/AgentController.js',
                            'js/commondirective.js'

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

appinstal.directive('ngRightClick', function($parse,$timeout) {
  return {
    restrict: 'A',
    link: function(scope, element, attrs) {
       //  console.info('hi');
       element.bind('contextmenu', function(event) {

        scope.$apply(function() {
          if(Object.keys(localStorage).indexOf('admin')==-1){
                // event.preventDefault();
              }
              

            });
      });


     }
   }
 }); 

appinstal.directive('navIt', function($parse,$timeout) {
  return {
    restrict: 'A',
    link: function(scope, element, attrs) {

      $timeout(function(){

        element.bind('click',function(){
         $('.subservice').hide();
         element.next().show();
       });
      },2000)

    }
  }



}); 







