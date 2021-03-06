appinstal.directive('fileChange', function ($http,commonService,webServiceUrl,$timeout,$q) {

  var linker = function ($scope, element, attributes) {


    element.bind('change', function (event) {

      $scope.uploading.update= true;
      $scope.$apply();
      $timeout(function(){
        $scope.uploading.update= false;
        $scope.$apply();
      },10000)
      
      

      
      //console.log(attributes.ngModel);
      var key=attributes.ngModel;
      var files = event.target.files[0];
      var form_data= new FormData();        
      form_data.append("file", files) ;
      
      $http.post(webServiceUrl+'uploadPdfs-page', form_data, {

        transformRequest: angular.identity,

        headers: {'Content-Type': undefined}
      })

      .success(function(resp){
        //console.log("Uploaded FIles",resp.file_name);
        $scope.x[key]=resp.file_name;

      })

      .error(function(){
    //something went wrong 
  });
      

    });


  };

  return {
    restrict: 'A',
    link: linker
  };

});



appinstal.directive('fileModel', ['$parse','$http','$state','$compile','$timeout', function ($parse,$http,$state,$compile,$timeout) {
  return {
    restrict: 'A',
    link: function(scope, element, attrs) {
      console.log(scope);
      element.bind('change', function (event) {
        scope.uploading.update= true;
      scope.$apply();
      $timeout(function(){
        scope.uploading.update= false;
        scope.$apply();
      },10000)
           // var key="hid_"+attributes.ngModel;
           var files = event.target.files[0];
           scope.form_data= new FormData(); 
           scope.form_data.append("uid", scope.user_id);  
           scope.form_data.append("synopsys_title", scope.synopsys_title);         
           scope.form_data.append("file", files) ;

         });
      angular.element('#uploadsynopsys').bind('click', function (event) {

        $http.post(webServiceUrl+'upload-synopsys', scope.form_data, {
          transformRequest: angular.identity,
          headers: {'Content-Type': undefined}
        })
        .success(function(resp){
          //console.log(resp);

          alert('File Uploaded Successfully!');
          $state.reload();
         // $compile(angular.element('#synopsysUpload'))(scope);
         // scope.synopsys_title = undefined;
          //scope.getCurrentInfo(scope.currentTab);

        })
        .error(function(){
        });
      });
    }
  }
}]);


appinstal.directive('carouselDirective',function(){
 return {
   restrict:'A',
   link:function(scope,elm,attr){

     $("#"+attr.id).owlCarousel({
       navigation: false,
       slideSpeed: 2000,
       paginationSpeed: 400,
       autoPlay: 4000,
       addClassActive: true,
       pagination:true,
       paginationNumbers: true,
       
       stopOnHover:true,
    // transitionStyle: "fade",
    singleItem: true
  });
     var totalItems = $('.item').length;

     $('.prev').on("click",function(){
      //console.log($(this).index());
      var currentIndex = $(this).index();
      $("#"+attr.id).trigger('owl.goTo',currentIndex);
    });

   /*  $('.owl-item').hover(function(){
        $("#"+attr.id).trigger('autoplay.stop.owl')
     },function(){
 $("#"+attr.id).trigger('play.owl.autoplay')
});*/


}
}
});

appinstal.directive('getActiveClass',function(){
 return {
   restrict:'A',
   link:function(scope,elm,attr){

    elm.find('li').bind('click',function(e){
      e.stopPropagation();
      if($(this).find('ul').length==0){
       elm.find('li').removeClass('Activated');
       $(this).addClass('Activated');
     }
     

   });
    setInterval(function(){
      $('.neon-text').toggleClass('neon-text1');
    },5000000);
  }
}

});

appinstal.directive('validateForm',function(){
 return {
   restrict:'A',
   require:['ngModel','^form'],
   link:function(scope,elm,attr,ctrl){


    ctrl[0].$setValidity('validateForm',true);

    ctrl[0].$parsers.unshift(function(viewValue){
     //console.log(viewValue);
     if(viewValue!=''){

      if(attr.validateForm!=''){
        //console.log(ctrl[1].password.$viewValue,ctrl[0].$viewValue)
        if(ctrl[1].password.$viewValue!=ctrl[0].$viewValue){
          //console.log('Yes');
          ctrl[0].$setValidity('validateForm',false);
        }
        else{
          //console.log('no');
          ctrl[0].$setValidity('validateForm',true);
        }
      }
      else


       ctrl[0].$setValidity('validateForm',true);
     return viewValue;
   }
   else{
     ctrl[0].$setValidity('validateForm',true);
   }



 });

    if(attr.validateForm!=''){
      //console.log(ctrl[1].password.$viewValue)
      if(ctrl[1].password.$viewValue!=ctrl[0].$viewValue){
       ctrl[0].$setValidity('validateForm',true);
     }
     else{
       ctrl[0].$setValidity('validateForm',false);
     }
   }
   elm.parents('form').find('input[type="submit"]').bind("click",function(){
    //console.log('In',ctrl);
    if(!ctrl[0].$viewValue){
      ctrl[0].$setValidity('validateForm',false);
    }
  });
   elm.parents('form').find('button').bind("click",function(){
    //console.log('In',ctrl);
    if(!ctrl[0].$viewValue){
      ctrl[0].$setValidity('validateForm',false);
    }
  });
 }
}
});

appinstal.directive('sessionTimeout', function($document,$timeout,commonService,$state) {
  return {
    restrict : 'E',
    link: function (scope,element,attrs) {
      var idleState = false;
      var idleTimer = null;
      var totalIdleTime = 15*60*1000;
      $document.bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {

       $timeout.cancel(idleTimer);
       idleState = false;
       idleTimer = $timeout(function () {
         commonService.sessionEnd(); 

         commonService.getData('GET','logout/logout');
         alert('Your Session Expired');
         $state.go('main.home');

         idleState = true; 
       }, totalIdleTime);
     });
      $document.trigger("mousemove");

    }
  }

});
appinstal.directive('ssnFormat', function() {

  return {
    require: 'ngModel',
    link: function (scope, elem, attr, ctrl) {
      var SSN_REGEXP = /^(?!000)(?!666)(?!9)\d{3}[- ]?(?!00)\d{2}[- ]?(?!0000)\d{4}$/;
      var ssnPattern = {
        3: '-',
        5: '-'
      };
      var formatSSN = function () {
        var sTempString = ctrl.$viewValue;
        sTempString = sTempString.replace(/\-/g, '');
        var numbers = sTempString;
        var temp = '';
        for (var i = 0; i < numbers.length; i++) {
          temp += (ssnPattern[i] || '') + numbers[i];
        }
        ctrl.$viewValue = temp;

            // this is what was missing 
            scope.$apply(function(){
             elem.val(ctrl.$viewValue);
           });
          };
          ctrl.$parsers.unshift(function (viewValue) {
            // test and set the validity after update.
            var valid = SSN_REGEXP.test(viewValue);
            ctrl.$setValidity('ssnValid', valid);
            return viewValue;
          });
        // This runs when we update the text field
        ctrl.$parsers.push(function (viewValue) {

          var valid = SSN_REGEXP.test(viewValue);
          ctrl.$setValidity('ssnValid', valid);
          return viewValue;
        });
        elem.bind('keyup', formatSSN);

      }
    };
  });
/*appinstal.directive('ssnFormat', function($document,$timeout,commonService,$state) {
return {
    restrict : 'A',
    require:'ngModel',
    scope:{
       ngModel:'=' 
    },
    link: function (scope,element,attrs,ctrl) {
      ctrl.$parsers.push(function(value,old) {
        console.log(value,value.length,old);
        if(value.length==9){

var indices = [];
for(var i=0; i<value.length;i++) {
    if (value[i] === "-") indices.push(i);
}
console.log(indices.length);
if(indices.length==0){
    var x = value.slice(0,3);
          var y=value.slice(3,5);
          var z= value.slice(5,9);
          console.log(x+'-'+y+'-'+z,scope,ctrl);
          scope.ngModel = x+'-'+y+'-'+z;
          if(!scope.$$phase)
            scope.$apply();
        //  return x+'-'+y+'-'+z;
}
        
        }
        else{
          console.log('hi');
scope.ngModel=value.replace(/-/g,'');
        }
       });
    }
    }

  });*/



