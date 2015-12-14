/**
 * Created by giang on 8/23/15.
 */
(function() {
    'use strict';

    /**
     * @ngdoc function
     * @name viettut.controller:GuideController
     * @description
     * # GuideController
     * Controller of the viettut
     */
    angular
        .module('viettut')
        .controller('CourseController', CourseController);

    function CourseController($auth, $http, $scope, $window, Upload, $timeout, $state, myCourses) {
        $scope.myCourses = myCourses;

        $scope.getFirstParagraph = function(str) {
            return str.substring(0, str.indexOf("\n"));
        };

        $scope.buildViewLink = function(course) {
            return '/app_dev.php/' + course.author.username + '/courses/' + course.hashTag;
        };

        $scope.isAuthenticated = $auth.isAuthenticated();
    }
})();
