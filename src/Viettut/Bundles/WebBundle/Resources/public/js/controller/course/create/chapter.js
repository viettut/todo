/**
 * Created by giang on 8/23/15.
 */
(function() {
    'use strict';

    /**
     * @ngdoc function
     * @name viettut.controller:ChapterController
     * @description
     * # ChapterController
     * Controller of the viettut
     */
    angular
        .module('viettut')
        .controller('ChapterController', ChapterController);

    function ChapterController($auth, $http, $scope, $stateParams, $window, initialCourse) {
        $scope.courseId = $stateParams.cid;
        $scope.course = initialCourse;
        $scope.previewText = 'Show Preview';
        $scope.showPreview = false;
        $scope.header = '';
        $scope.content = '';
        $scope.laddaLoading = false;

        $scope.add = function(){
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            var data = {
                header: $scope.header,
                content: $scope.content,
                course: $scope.course.id
            };

            // start progress
            $scope.laddaLoading = true;

            $http.post('/app_dev.php/api/v1/chapters', data).
                then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $window.location.reload();
                    }
                },
                function(response){
                    if(response.status == 401) {
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        $window.location.href = '/app_dev.php/login';
                    }

                    $scope.laddaLoading = false;
                    $scope.error = response.data;
                    $scope.showError = true;
                });
        };

        $scope.preview = function(){
            $scope.showPreview = !$scope.showPreview;

            if($scope.showPreview) {
                $scope.previewText = 'Hide Preview';
            }
            else $scope.previewText = 'Show Preview';
        };

        $scope.isAuthenticated = $auth.isAuthenticated();
    }
})();
