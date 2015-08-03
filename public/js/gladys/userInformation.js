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

    $scope.submit = function(){
        if($scope.newFact){
           var newFact = {
                'newFact': $scope.newFact,
                'user_id': $scope.user.user_id
            }
            var currentKey = $scope.currentFactKey
            console.log(currentKey);

            if( currentKey  == undefined ) {
                $http.post('api/v1/fact/', newFact).success(function (response) {
                    var insertedFact = {
                        id: null,
                        fact: newFact.newFact
                    }
                    insertedFact.id = response.metadata.last_inserted_id;
                    $scope.facts.push(insertedFact);
                });
            }
            else {
                var factID = $scope.facts[currentKey].id;
                $http.post('api/v1/fact/' + factID, newFact).success(function () {
                    $scope.facts[currentKey].fact = newFact.newFact;
                });
            }
            $scope.newFact = '';
            $scope.currentFactKey = undefined;
        }
    }

    $scope.editFact = function(key){
        var fact = $scope.facts[key];
        $scope.newFact = fact.fact;
        $scope.currentFactKey = key;
    }

    $scope.enterNewFact = function(){
        $scope.newFact = '';
        $scope.currentFactKey =  undefined;
    }

    $scope.deleteFact = function()
    {
        var currentKey  = $scope.currentFactKey
        if(currentKey  != undefined)
        {
            var factID = $scope.facts[currentKey].id;
            $http.delete('api/v1/fact/' + factID).success(function(){
                $scope.newFact = '';
                $scope.facts.splice($scope.facts.indexOf($scope.facts[currentKey]), 1);
            });


        }

    }




});