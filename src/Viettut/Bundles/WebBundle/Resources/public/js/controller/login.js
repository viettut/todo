/**
 * Created by giang on 8/23/15.
 */
(function() {
    'use strict';

    /**
     * @ngdoc function
     * @name viettut.controller:LoginController
     * @description
     * # LoginController
     * Controller of the viettut
     */
    angular
        .module('viettut')
        .controller('LoginController', LoginController);

    function LoginController($auth, $scope, $localStorage, $window) {
        $scope.$storage = $localStorage;
        $scope.laddaLoading = false;
        $scope.error = '';
        $scope.showError = false;

        $scope.login = function() {
            // start progress
            $scope.laddaLoading = true;

            var credentials = {
                username: $scope.username,
                password: $scope.password
            };

            $auth.login(credentials).then(function(response) {
                $localStorage.username = response.data.username;
                $localStorage.name = response.data.username;

                $window.location.href = '/app_dev.php/';
                $scope.laddaLoading = false;
            }).catch(function(data) {
                $scope.error = 'Invalid credentials';
                $scope.showError = true;
                $scope.laddaLoading = false;
            });
        };

        $scope.logout = function() {
            if(!$auth.isAuthenticated()) {
                return;
            }

            $auth.logout().then(function() {
                $window.location.href = '/app_dev.php/';
            });
        };

        $scope.register = function() {
            $window.location.href = '/app_dev.php/register';
        };

        $scope.socialLogin = function(provider) {
            $auth.authenticate(provider);
        };
    };
})();
