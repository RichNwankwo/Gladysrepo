var app = angular.module('app', []).controller('FactController', function($scope,$http){

    $scope.addFact = function(){
        var Fact = {
            user_id: Math.floor((Math.random()*100)+1),
            fact: $scope.newFact
        }

        $http.post("api/v1/fact",Fact)
            .success(function(){
               $scope.newFact = "";
            });
    }
});
