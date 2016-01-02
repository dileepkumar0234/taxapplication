appinstal.directive('fileChange', function ($http,commonService) {

  var linker = function ($scope, element, attributes) {
    $scope.x={};
    element.parents('form').find('button').bind('click',function(event){
      //var files = event.target.files;
      //console.log("Files:::",$scope.x);
      commonService.getData('PUT','uploadPdfs-page/'+$scope.uid,$scope.x).then(function(resp){
        //console.log("success",resp);
        $scope.editMode = true;
        if(!$scope.$$phase){
          $scope.$apply();
        }
      })
     // uploadPdfs-page
   });
    element.bind('change', function (event) {
      //console.log(attributes.ngModel);
      var key="hid_"+attributes.ngModel;
      var files = event.target.files[0];
      var form_data= new FormData();           
      form_data.append("file", files) ;
      //http://localhost/taxapplication/trunk/ustaxfilerapis
      //
      $http.post('http://umpiretaxsolutions.com/services/uploadPdfs-page', form_data, {

        transformRequest: angular.identity,

        headers: {'Content-Type': undefined}
      })

      .success(function(resp){
        //console.log("Uploaded FIles",resp.file_name);
        $scope.x[key]=resp.file_name;
    //file was uploaded
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



appinstal.directive('fileModel', ['$parse','$http', function ($parse,$http) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
          console.log(scope);
          element.bind('change', function (event) {
           // var key="hid_"+attributes.ngModel;
            var files = event.target.files[0];
             scope.form_data= new FormData(); 
             scope.form_data.append("uid", scope.user_id);          
            scope.form_data.append("file", files) ;

        });
          angular.element('#uploadsynopsys').bind('click', function (event) {
          	//http://localhost/taxapplication/trunk/ustaxfilerapis
          $http.post('http://umpiretaxsolutions.com/services/upload-synopsys', scope.form_data, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        })
        .success(function(resp){
          //console.log(resp);
          alert('File Uploaded Successfully!');
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