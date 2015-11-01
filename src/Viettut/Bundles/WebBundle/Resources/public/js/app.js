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
        .module('viettut', ['ngTagsInput', 'ngSanitize', 'ngFileUpload', 'wiz.markdown', 'ladda', 'ngStorage', 'ngUpload', 'satellizer', 'ngProgress', 'ngAnimate', 'toastr', 'angularUtils.directives.dirPagination', 'hc.marked', 'iso.directives', 'ui.bootstrap'])
        .config(function ($authProvider, markedProvider, $interpolateProvider) {
            $interpolateProvider.startSymbol('<{');
            $interpolateProvider.endSymbol('}>');
            markedProvider.setOptions({
                gfm: true,
                tables: true,
                highlight: function (code) {
                    return hljs.highlightAuto(code).value;
                }
            });
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