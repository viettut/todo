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
            'API_URL' : '/api/v1/',
            'BASE_URL' : '/',
            'SIGN_UP_URL' : '/api/user/v1/users',
            'SIGN_UP_REDIRECT' : '/login'
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
                name: 'facebook',
                clientId: '529276757135612',
                url: '/facebook/login',
                authorizationEndpoint: 'https://www.facebook.com/v2.5/dialog/oauth',
                redirectUri: window.location.origin + '/',
                requiredUrlParams: ['display', 'scope'],
                scope: ['email'],
                scopeDelimiter: ',',
                display: 'popup',
                type: '2.0',
                popupOptions: { width: 580, height: 400 }
            });

            $authProvider.google({
                clientId: '355171488116-rml9h7b9ivdn8ub5sgu6r6eh1vkluvav.apps.googleusercontent.com',
                url: '/google/login',
                authorizationEndpoint: 'https://accounts.google.com/o/oauth2/auth',
                redirectUri: window.location.origin + '/app_dev.php',
                requiredUrlParams: ['scope'],
                optionalUrlParams: ['display'],
                scope: ['profile', 'email'],
                scopePrefix: 'openid',
                scopeDelimiter: ' ',
                display: 'popup',
                type: '2.0',
                popupOptions: { width: 452, height: 633 }
            });

            $authProvider.github({
                url: '/github/login',
                clientId: '13f81c8b888c1b57cc86',
                authorizationEndpoint: 'https://github.com/login/oauth/authorize',
                redirectUri: window.location.origin,
                optionalUrlParams: ['scope'],
                scope: ['user:email'],
                scopeDelimiter: ' ',
                type: '2.0',
                popupOptions: { width: 1020, height: 618 }
            });
        });
})();