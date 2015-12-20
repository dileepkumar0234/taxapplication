var appinstal = angular.module("myapp", ['ngRoute']);




appinstal.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'templates/home.html',
                controller: 'RouteController'
            }).

            when('/home', {
                templateUrl: 'templates/home.html',
                controller: 'RouteController'
            }).

            when('/firmProfile', {
                templateUrl: 'templates/firmProfile.html',
                controller: 'firmProfileCtrl'
            }).
            when('/Service', {
                templateUrl: 'templates/services.html',
                controller: 'servicesCtrl'
            }).
            when('/tax_center', {
                templateUrl: 'templates/tax_center.html',
                controller: 'taxCenterCtrl'
            }).
            when('/carriers', {
                templateUrl: 'templates/carriers.html',
                controller: 'carriersCtrl'
            }).
            when('/contactUs', {
                templateUrl: 'templates/contact.html',
                controller: 'carriersCtrl'
            }).
            otherwise({
                redirectTo: '/'
            });
    }]);




appinstal.controller("RouteController", function($scope) {

    var theme_slider = $("#owl-demo");

    setTimeout(function(){
        console.log(theme_slider);
        $("#owl-demo").owlCarousel({
            navigation: false,
            slideSpeed: 300,
            paginationSpeed: 400,
            autoPlay: 6000,
            addClassActive: true,
            // transitionStyle: "fade",
            singleItem: true
        });
        $("#owl-demo2").owlCarousel({
            slideSpeed: 300,
            autoPlay: true,
            navigation: true,
            navigationText: ["&#xf007","&#xf006"],
            pagination: false,
            singleItem: true
        });
    },100);
    $(".next-arrow").click(function() {
        theme_slider.trigger('owl.next');
    })
    $(".prev-arrow").click(function() {
        theme_slider.trigger('owl.prev');
    })

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




appinstal.controller("servicesCtrl", function($scope) {

    $('a').click(function(){
        $('html, body').animate({
            scrollTop: $( $(this).attr('href') ).offset().top
        }, 500);
        return false;
    });

    $(window).scroll(function() {
        st=$(window).scrollTop();



        if(st>100){
            $('.top').show();
        }else{
            $('.top').hide();
        }




    });
    $('.top').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });


});