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

        function NavBarController($scope, $auth, $window, $localStorage, AuthenService) {
            $scope.username = $localStorage.username;
            $scope.name = $localStorage.name;
            $scope.avatar = $localStorage.avatar;
            $scope.professional = '';
            console.log('avatar -> ' + $scope.avatar);
            $scope.register = function() {
                AuthenService.register();
            };

            $scope.login = function() {
                AuthenService.login();
            };

            $scope.logout = function(){
                if (!$auth.isAuthenticated()) { return; }
                $auth
                    .logout()
                    .then(function() {
                        AuthenService.goHome();
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
