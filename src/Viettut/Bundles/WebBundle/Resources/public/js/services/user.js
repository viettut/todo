/**
 * Created by giang on 8/23/15.
 */
'use strict';

angular
    .module('ask2code')
    .factory('UserService', function($auth, $http) {
        return {
            getProfile: function() {
                $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
                return $http.get('/api/app_dev.php/api/v1/questions');
            },
            updateProfile: function(id) {
                $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
                return $http.get('/api/app_dev.php/api/v1/questions/' + id);
            }
        };
    });