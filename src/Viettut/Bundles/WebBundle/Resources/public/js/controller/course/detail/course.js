angular
    .module('viettut')
    .controller('CourseController', function ($auth, $http, $scope, $window, Upload, $timeout, $state, CourseService, AuthenService,  config) {
        $scope.introduce = $('textarea#introduce').html();
        $scope.isAuthenticated = $auth.isAuthenticated();
    });


