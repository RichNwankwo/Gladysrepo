var app = angular.module('app', []);

app.controller('FactController', function($scope,$http){

    $scope.submitForm = function(isValid){
        if(isValid){
            alert('Fact submitted');
        }
    }

    $scope.selectedFact = 1;

    $scope.addFact = function(){
        var newFact = {
            user_id: Math.floor((Math.random()*100)+1),
            fact: $scope.newFact
        }

        $http.post("api/v1/fact",newFact)
            .success(function(){
               $scope.newFact = "";
               $scope.facts.push(newFact);
            });
    }

    $http.get("api/v1/fact/616/tag", {cache: true}).success(
        function(tags){
            $scope.tags = tags.data;
        }
    )

    $http.get("api/v1/fact/665", {cache: true}).success(function(facts){
        $scope.facts = facts.data});

});

