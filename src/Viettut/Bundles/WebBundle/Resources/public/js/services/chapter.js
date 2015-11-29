/**
 * Created by giang on 8/23/15.
 */
'use strict';

angular
    .module('viettut')
    .factory('ChapterService', function($auth, $http, $q) {
        return {
            getChaptersByCourse: function(cid) {
                var deferred = $q.defer();

                $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
                $http({
                    method: 'GET',
                    url: '/app_dev.php/api/v1/courses/' + cid + '/chapters'
                }).success(function (data) {
                    deferred.resolve(data);
                }).error(function (msg) {
                    deferred.reject(msg);
                });

                return deferred.promise;
            }
        };
    });