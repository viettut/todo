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
        .module('viettut', ['ui.router', 'ngTagsInput', 'ngSanitize', 'ngFileUpload', 'wiz.markdown', 'ladda', 'ngStorage', 'satellizer', 'ngAnimate', 'ui.bootstrap'])
        .constant('config', {
            'API_URL' : '/app_dev.php/api/v1/',
            'BASE_URL' : '/app_dev.php/',
            'SIGN_UP_URL' : '/app_dev.php/api/user/v1/users',
            'SIGN_UP_REDIRECT' : '/app_dev.php/login'
        })
        .config(function ($authProvider, $interpolateProvider, config) {
            $interpolateProvider.startSymbol('<{');
            $interpolateProvider.endSymbol('}>');

            // Satellizer configuration that specifies which API
            // route the JWT should be retrieved from
            $authProvider.loginUrl = config.API_URL + 'getToken';
            $authProvider.signupUrl = config.BASE_URL + 'api/user/v1/users';
            $authProvider.signupRedirect = config.BASE_URL + 'login';

            // Social login
            $authProvider.facebook({
                clientId: '529276757135612'
            });
        });
})();