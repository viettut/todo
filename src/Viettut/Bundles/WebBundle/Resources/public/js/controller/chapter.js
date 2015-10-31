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

    function ChapterController($auth, $http, $scope, $stateParams) {
        $scope.gId = $stateParams.gId;
        console.log('guide id -> ' + $scope.gId );
        $scope.laddaLoading = false;
        $scope.header = '';
        $scope.content = '';
        $scope.titleValid = $scope.title.length < 15;
        $scope.introduceValid = $scope.introduce < 32;


        $scope.add = function(){
            // start progress
            $scope.laddaLoading = true;
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            $http.patch('/api/app_dev.php/api/v1/questions').then(function(data){
                $scope.progressbar.complete();
                $scope.questions = data.data;
            }).catch(function(data){
                $scope.progressbar.stop();
            });
        };

        $scope.isAuthenticated = $auth.isAuthenticated();
    };
})();
