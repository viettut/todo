angular
    .module('viettut')
    .controller('ChapterController', function ($auth, $http, $scope, $window, Upload, $timeout, $state, CourseService, AuthenService,  config) {
        $scope.content = $('textarea#content').html();
        $scope.isAuthenticated = $auth.isAuthenticated();
    });


