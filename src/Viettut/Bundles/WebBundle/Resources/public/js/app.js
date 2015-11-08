(function() {
    'use strict';

    /**
     * @ngdoc overview
     * @name viettut
     * @description
     * # viettut
     *
     * Main module of the application.
     */
    angular
        .module('viettut', ['ui.router', 'ngTagsInput', 'ngSanitize', 'ngFileUpload', 'wiz.markdown', 'ladda', 'ngStorage', 'satellizer', 'ngAnimate', 'angularUtils.directives.dirPagination', 'iso.directives', 'ui.bootstrap'])
        .config(function ($authProvider, $interpolateProvider) {
            $interpolateProvider.startSymbol('<{');
            $interpolateProvider.endSymbol('}>');

            // Satellizer configuration that specifies which API
            // route the JWT should be retrieved from
            $authProvider.loginUrl = '/app_dev.php/api/v1/getToken';
            $authProvider.signupUrl = '/app_dev.php/api/user/v1/users';
            $authProvider.signupRedirect = '/login';

            // Social login
            $authProvider.facebook({
                clientId: '529276757135612'
            });
        });
})();