angular
    .module('viettut')
    .controller('CommentController', function ($auth, $http, $scope, $window) {
        $scope.comments = [];
        $scope.content = '';
        $scope.laddaLoading = false;
        $scope.error = '';
        $scope.showError = false;
        $scope.commentToggle = false;

        $scope.showReplyForm = function() {

        };

        $scope.reply = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();
            var data = {
                header: $scope.header,
                content: $scope.content,
                course: $scope.course.id
            };

            // start progress
            $scope.laddaLoading = true;

            $http.post('/app_dev.php/api/v1/chapters', data).
                then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $window.location.reload();
                    }
                },
                function(response){
                    if(response.status == 401) {
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        $window.location.href = '/app_dev.php/login';
                    }

                    $scope.laddaLoading = false;
                    $scope.error = response.data;
                    $scope.showError = true;
                });
        };

        $scope.reloadComment = function() {
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();

            $http({
                method: 'GET',
                url: '/app_dev.php/api/v1/tutorials/' + $scope.currentTutorial + '/comments'
            }).then(function successCallback(response) {
                $scope.comments = response.data;
            }, function errorCallback(response) {
            });
        };

        $scope.reloadComment();

        $scope.addComment = function() {
            // start progress
            $scope.laddaLoading = true;
            $http.defaults.headers.common.Authorization = "Bearer " + $auth.getToken();

            var data = {
                content: $scope.content,
                tutorial: $scope.currentTutorial
            };

            $http.post('/app_dev.php/api/v1/comments', data).
                then(
                function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.reloadComment();
                        $scope.commentToggle = true;
                        $scope.content = '';
                    }
                },
                function(response){
                    if(response.status == 401) {
                        if($auth.isAuthenticated()) {
                            $auth.logout();
                        }
                        // re-login
                        $window.location.href = '/app_dev.php/login';
                    }

                    $scope.laddaLoading = false;
                    $scope.error = response.data;
                    $scope.showError = true;
                });
        };

        $scope.isAuthenticated = $auth.isAuthenticated();
    });


