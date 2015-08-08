var app = angular.module('gladysApp', []);

// TODO move view related code to seperate file
// TODO move user data into it's own service
// TODO CLEAN UP!!!!
// TODO I'm thinking facts controller, tags controller or something like that
// TODO Create TESTS
app.controller('UserInformation', function($scope, $http){

    var returnUserInfo = function(response){
        var user = response.data.data[0];
        $scope.user = user;
        return $http.get('api/v1/user/'+ user.user_id + '/fact');
    };

    var returnFactInfo = function(response){
        $scope.facts = response.data.data;
    }

    var returnTagInfo = function(response){

    }

    // Check if our user is logged in
    $http.get('api/v1/user')
        .then(returnUserInfo)
        .then(returnFactInfo)

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

   $scope.addTag = function()
    {
        var newTag ={
            tag_name:  $scope.newTag
        }

        var fact =  $scope.facts[$scope.currentFactKey];
        $http.post('api/v1/fact/'+fact.id+'/tag', newTag).then(function(response){
            $scope.tags.push(newTag);
            $scope.newTag = "";
        });

    }

    // TODO Finish creating this function
    $scope.removeTag = function()
    {

    }

    var throwJsonError = function(response){
        console.log(response)
        $scope.error = response.data.error.message;
    }

    var getUserTags = function(fact_id){
        $http.get('api/v1/fact/'+fact_id+'/tag').then(loadUserTags, throwJsonError)
    }

    var loadUserTags = function(response){
        $scope.tags = response.data.data;
    }

    $scope.editFact = function(key){
        var fact = $scope.facts[key];
        $scope.newFact = fact.fact;
        $scope.currentFactKey = key;
        $scope.tags = getUserTags(fact.id);
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