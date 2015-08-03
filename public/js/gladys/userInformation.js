var app = angular.module('gladysApp', []);

app.controller('UserInformation', function($scope, $http){

    // Check if our user is logged in
    $http.get('api/v1/user').success(function(user){
        $scope.user = user.data[0];
        var user_id;
        user_id = user.data[0].user_id;

        $http.get('api/v1/user/'+ user_id + '/fact').success(function(facts) {
            $scope.facts = facts.data;
            console.log($scope.facts);
        });

    });




});