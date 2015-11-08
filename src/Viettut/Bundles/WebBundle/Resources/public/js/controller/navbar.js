/**
 * Created by giang on 8/23/15.
 */
(function(){
    'use strict';

    /**
     * @ngdoc function
     * @name viettut.controller:NavBarController
     * @description
     * # NavBarController
     * Controller of the viettut
     */
    angular
        .module('viettut')
        .controller('NavBarController', NavBarController);

        function NavBarController($scope, $auth, $window, $localStorage) {
            //console.log('isAuthenticated -> ' + )
            $scope.username = $localStorage.username;
            $scope.name = $localStorage.name;
            $scope.register = function() {
                $window.location.href = '/app_dev.php/register';
            };

            $scope.login = function() {
                $window.location.href = '/app_dev.php/login';
            };

            $scope.logout = function(){
                if (!$auth.isAuthenticated()) { return; }
                $auth
                    .logout()
                    .then(function() {
                        $window.location.href = '/app_dev.php/';
                    });
            };

            $scope.isAuthenticated = function() {
                return $auth.isAuthenticated();
            };

            $scope.isOnUserPage = function(){
                return ($window.location.href.toString().match('/\/register') || $window.location.href.toString().match('/\/login'));
            };
        }
})();
