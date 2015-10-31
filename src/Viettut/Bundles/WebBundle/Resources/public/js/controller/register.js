/**
 * Created by giang on 8/23/15.
 */
(function() {
    'use strict';

    /**
     * @ngdoc function
     * @name viettut.controller:RegisterController
     * @description
     * # RegisterController
     * Controller of the viettut
     */
    angular
        .module('viettut')
        .controller('RegisterController', RegisterController);

    function RegisterController($scope, $auth) {
        $scope.laddaLoading = false;
        $scope.error = '';
        $scope.showError = false;
        $scope.signup = function() {

            var credentials = {
                name: $scope.name,
                email: $scope.email,
                username: $scope.username,
                password: $scope.password
            };
            $scope.laddaLoading = true;
            // Use Satellizer's $auth service to sign up
            $auth.signup(credentials).then(function(data) {
                $scope.laddaLoading = false;
                $scope.login();
            }).catch(function(data) {
                $scope.error = 'Invalid submitted data';
                $scope.showError = true;
                $scope.laddaLoading = false;
            });
        };

        $scope.login = function(){
            $window.location.href = '/app_dev.php/login';
        }
    };
})();

