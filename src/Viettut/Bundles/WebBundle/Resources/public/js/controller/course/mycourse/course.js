angular
    .module('viettut')
    .controller('CourseController', function ($auth, $http, $scope, $window, Upload, $timeout, $state, AuthenService, config) {
        $scope.myCourses = [];
        $scope.loading = true;

        $scope.getFirstParagraph = function(str) {
            return str.substring(0, str.indexOf("\n"));
        };

        $scope.buildViewLink = function(course) {
            return config.BASE_URL + course.author.username + '/courses/' + course.hashTag;
        };

        $scope.isAuthenticated = $auth.isAuthenticated();

        $scope.loadCourses = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            $http.get(config.API_URL + 'mycourses').
            then(
                function(response){
                    $scope.loading = false;
                    if(response.status == 200) {
                        $scope.myCourses = response.data;
                    }
                },
                function(response){
                    $scope.loading = false;
                    if(response.status == 401) {
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        AuthenService.login();
                    }
                });
        };

        $scope.loadCourses();
    });


