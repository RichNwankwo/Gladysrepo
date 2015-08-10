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

    // TODO rn refactor
    $scope.submit = function(){
        if($scope.newFact){
           var newFact = {
                'newFact': $scope.newFact,
                'user_id': $scope.user.user_id
            }
            var currentFact = $scope.currentFact
            if( currentFact  == undefined ) {
                $http.post('api/v1/fact/', newFact).success(function (response) {
                    var insertedFact = {
                        id: null,
                        fact: newFact.newFact
                    }
                    insertedFact.id = response.metadata.last_inserted_id;
                    if($scope.tags)
                    {
                        $scope.tags.forEach(function(newTag){
                            $http.post('api/v1/fact/' + insertedFact.id  + '/tag', newTag).then(function (response)
                            {
                                $scope.tags = [];
                            });
                        });
                    }
                    $scope.facts.push(insertedFact);
                });
            }
            else
            {
                var factID = currentFact.id;
                $http.post('api/v1/fact/' + factID, newFact).success(function () {
                    var currentKey = "";
                    $scope.facts.forEach(function(fact, key){
                        if(fact.id == currentFact.id){
                            fact.fact = newFact.newFact;
                        }

                    });
                    $scope.tags = [];
                });
            }
            $scope.newFact = '';
            $scope.currentFact = undefined;
        }
    }

   $scope.addTag = function()
    {
        var newTag ={
            id: null,
            tag_name:  $scope.newTag
        }

        var fact =  $scope.currentFact;
        if(fact)
        {
            $http.post('api/v1/fact/' + fact.id + '/tag', newTag).then(function (response) {
                newTag.id = response.data.metadata.tag_id
                $scope.tags.push(newTag);
                $scope.newTag = "";
            });
        }
        else
        {
            $scope.newTag = "";
            $scope.tags == undefined ? $scope.tags = [] : "";
            $scope.tags.push(newTag);
        }
    }

    // TODO Finish creating this function
    $scope.removeTag = function()
    {

    }

    var throwJsonError = function(response){
        $scope.error = response.data.error.message;
    }

    var getUserTags = function(fact_id){
        $http.get('api/v1/fact/'+fact_id+'/tag').then(loadUserTags, throwJsonError)
    }

    var loadUserTags = function(response){
        $scope.tags = response.data.data;
    }

    $scope.editFact = function(fact){
        $scope.currentFact = fact;
        var fact = fact;
        $scope.newFact = fact.fact;
        $scope.tags = getUserTags(fact.id);

    }

    $scope.enterNewFact = function(){
        $scope.newFact = '';
        $scope.tags = [];
        $scope.currentFactKey =  undefined;
    }

    $scope.deleteTag = function(selectedTag)
    {

        var currentFact  = $scope.currentFact
        $http.delete('api/v1/fact/' + currentFact.id+ '/tag/'+ selectedTag.id)
        var currentTagId = "";
        $scope.tags.forEach(function(tag, index){
            if(tag.id == selectedTag.id){
              $scope.tags.splice(index, 1);
            }
        });


    }
    $scope.deleteFact = function()
    {
        var currentFact  = $scope.currentFact
        if(currentFact != undefined)
        {

            $http.delete('api/v1/fact/' + currentFact.id).success(function(){
                $scope.newFact = '';
                $scope.tags = [];
                var currentKey = "";
                $scope.facts.forEach(function(fact, key){
                    if(fact.id == currentFact.id){
                        currentKey = key;
                    }
                });
                $scope.facts.splice($scope.facts.indexOf($scope.facts[currentKey]), 1);
                $scope.currentFact = undefined;
            });

        }
    }




});