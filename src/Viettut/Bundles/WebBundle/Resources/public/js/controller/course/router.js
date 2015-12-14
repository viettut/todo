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
                .state('add-chapter', {
                    url: '/{cid}/add-chapter',
                    templateUrl: '/bundles/viettutweb/js/views/add-chapter.html',
                    controller: 'ChapterController',
                    params: {
                        cid: null
                    },
                    resolve: {
                        initialCourse: function (CourseService, $stateParams) {
                            return CourseService.getCourse($stateParams.cid);
                        },
                        loginRequired: loginRequired
                    }
                })
                .state('create-course', {
                    url: '/',
                    templateUrl: '/bundles/viettutweb/js/views/create-course.html',
                    controller: 'CourseController',
                    resolve: {
                        loginRequired: loginRequired
                    }

                })
                .state('my-course', {
                    url: '/my-course',
                    templateUrl: '/bundles/viettutweb/js/views/my-course.html',
                    controller: 'CourseController',
                    resolve: {
                        myCourses: function(CourseService) {
                            return CourseService.myCourses();
                        },
                        loginRequired: loginRequired
                    }
                });

            function loginRequired($q, $location, $auth) {
                var deferred = $q.defer();
                if ($auth.isAuthenticated()) {
                    deferred.resolve();
                } else {
                    $location.path('/app_dev.php/login');
                }
                return deferred.promise;
            }
        });

})();
