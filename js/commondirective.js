appinstal.directive('fileChange', function ($http,commonService) {

    var linker = function ($scope, element, attributes) {
      $scope.x={};
      element.parents('form').find('button').bind('click',function(event){
      //var files = event.target.files;
      console.log("Files:::",$scope.x);
      commonService.getData('PUT','uploadPdfs-page/'+$scope.uid,$scope.x).then(function(resp){
console.log("success",resp);
      })
     // uploadPdfs-page
      });
       element.bind('change', function (event) {
        console.log(attributes.ngModel);
        var key="hid_"+attributes.ngModel;
            var files = event.target.files[0];
            var form_data= new FormData();           
      form_data.append("file", files) ;
      $http.post('http://localhost/umpire-tax-filler/trunk/ustaxfilerapis/uploadPdfs-page', form_data, {
 
    transformRequest: angular.identity,
 
    headers: {'Content-Type': undefined}
})

.success(function(resp){
  console.log("Uploaded FIles",resp.file_name);
  $scope.x[key]=resp.file_name;
    //file was uploaded
})

.error(function(){
    //something went wrong 
});
      
            
                   });

        // onChange, push the files to $scope.files.
       /* element.bind('change', function (event) {
            var files = event.target.files;
            $scope.$apply(function () {
                for (var i = 0, length = files.length; i < length; i++) {
                    $scope.files.push(files[i]);
                }
            });
        });*/
    };

    return {
        restrict: 'A',
        link: linker
    };

});




appinstal.directive('carouselDirective',function(){
 return {
   restrict:'A',
   link:function(scope,elm,attr){

     $("#"+attr.id).owlCarousel({
       navigation: false,
       slideSpeed: 300,
       paginationSpeed: 400,
       autoPlay: 150000,
       addClassActive: true,
       pagination:true,
       paginationNumbers: true,
    // transitionStyle: "fade",
    singleItem: true
  });
     var totalItems = $('.item').length;

     $('.prev').on("click",function(){
      console.log($(this).index());
      var currentIndex = $(this).index();
      $("#"+attr.id).trigger('owl.goTo',currentIndex);
    });


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
     console.log(viewValue);
     if(viewValue!=''){

      if(attr.validateForm!=''){
        console.log(ctrl[1].password.$viewValue,ctrl[0].$viewValue)
        if(ctrl[1].password.$viewValue!=ctrl[0].$viewValue){
          console.log('Yes');
          ctrl[0].$setValidity('validateForm',false);
        }
        else{
          console.log('no');
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
      console.log(ctrl[1].password.$viewValue)
      if(ctrl[1].password.$viewValue!=ctrl[0].$viewValue){
       ctrl[0].$setValidity('validateForm',true);
     }
     else{
       ctrl[0].$setValidity('validateForm',false);
     }
   }
   elm.parents('form').find('input[type="submit"]').bind("click",function(){
    console.log('In',ctrl);
    if(!ctrl[0].$viewValue){
      ctrl[0].$setValidity('validateForm',false);
    }
  });
 }
}
});