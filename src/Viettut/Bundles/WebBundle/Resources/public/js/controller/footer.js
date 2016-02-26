angular
    .module('viettut')
    .controller('FooterController', function ($scope, $http, config) {
        $scope.email = '';
        $scope.subscribeFail = false;
        $scope.subscribeSuccess = false;

        $scope.subscribe = function() {
            // start progress
            angular.element('#subscribeButton').button('loading');
            var data = {
                email: $scope.email
            };

            $http.post(config.PUBLIC_API_URL + 'subscribe', data).
                then(
                function(response){
                    angular.element('#subscribeButton').button('reset');
                    if(response.status == 200) {
                        $scope.subscribeSuccess = true;
                    }
                },
                function(response){
                    $scope.subscribeFail = true;
                    angular.element('#subscribeButton').button('reset');
                });
        };
    });

