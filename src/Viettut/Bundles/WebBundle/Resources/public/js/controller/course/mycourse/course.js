angular
    .module('viettut')
    .controller('CourseController', function ($auth, $http, $scope, $window, Upload, $timeout, $state, myCourses, config) {
        $scope.myCourses = myCourses;

        $scope.getFirstParagraph = function(str) {
            return str.substring(0, str.indexOf("\n"));
        };

        $scope.buildViewLink = function(course) {
            return config.BASE_URL + course.author.username + '/courses/' + course.hashTag;
        };

        $scope.isAuthenticated = $auth.isAuthenticated();
    });


