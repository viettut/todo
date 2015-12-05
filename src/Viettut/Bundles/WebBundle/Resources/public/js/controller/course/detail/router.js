/**
 * Created by giang on 8/23/15.
 */
(function() {
    'use strict';

    /**
     * @ngdoc function
     * @name viettut.controller:GuideController
     * @description
     * # GuideController
     * Controller of the viettut
     */
    angular
        .module('viettut')
        .config(function ($stateProvider, $urlRouterProvider) {
            $urlRouterProvider.otherwise('/');

            $stateProvider
                .state('chapter-detail', {
                    url: '/{hash}',
                    templateUrl: '/bundles/viettutweb/js/views/add-chapter.html',
                    controller: 'CourseController',
                    params: {
                        cid: null
                    },
                    resolve: {
                        initialCourse: function (CourseService, $stateParams) {
                            return CourseService.getCourse($stateParams.cid);
                        }
                    }
                })
                .state('course-introduce', {
                    url: '/',
                    templateUrl: '/bundles/viettutweb/js/views/course-introduce.html',
                    controller: 'CourseController'
                });
        });

})();
