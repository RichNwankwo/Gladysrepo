var app = angular.module('gladysApp', []);

// TODO move view related code to seperate file
// TODO CLEAN UP!!!!
// TODO I'm thinking facts controller, tags controller or something like that
// TODO Create TESTS
app.controller('UserInformation', function($scope, $http, UserApiService){

    // Get the needed data for this controller

    var LoggedInUserID;
    UserApiService.UserData().then(function(response) {
        console.log(response);
        $scope.user = response;
        LoggedInUserID = $scope.user.user_id;


            UserApiService.FactData($scope.user.user_id).then(function(response){
            console.log(response);
            $scope.facts = response;
        });
    });


    $scope.submit = function(){
        if($scope.newFact){
           var newFact = {
                'newFact': $scope.newFact,
                'user_id': $scope.user.user_id
            }
            var currentFact = $scope.currentFact
            if( currentFact  == undefined ) {
                $http.post('api/v1/user/'+ $scope.user.user_id + '/fact/', newFact).success(function (response) {
                    var insertedFact = {
                        id: null,
                        fact: newFact.newFact
                    }
                    insertedFact.id = response.metadata.last_inserted_id;
                    if($scope.tags)
                    {
                        $scope.tags.forEach(function(newTag){
                            $http.post('api/v1/user/'+ $scope.user.user_id + '/fact/' + insertedFact.id  + '/tag', newTag).then(function (response)
                            {
                                if($scope.pinnedTags){
                                    $scope.tags = $scope.pinnedTags;
                                }
                                else{
                                    if($scope.pinnedTags){
                                        $scope.tags = $scope.pinnedTags;
                                    }
                                    else{
                                        $scope.tags = [];
                                    }
                                }
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
                    if($scope.pinnedTags){
                        $scope.tags = $scope.pinnedTags;
                    }
                    else{
                        $scope.tags = [];
                    }
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
            $http.post('api/v1/user/'+LoggedInUserID+'/fact/' + fact.id + '/tag', newTag).then(function (response) {
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
        if($scope.pinnedTags){
            $scope.tags = $scope.pinnedTags;
        }
        else{
            $scope.tags = [];
        }
        $scope.currentFact = undefined;
    }

    $scope.deleteTag = function(selectedTag)
    {
        $scope.tags.forEach(function(tag, index){
            if(tag.id == selectedTag.id){
              $scope.tags.splice(index, 1);
            }
        });
        var currentFact  = $scope.currentFact
        if(currentFact){
            $http.delete('api/v1/fact/' + currentFact.id+ '/tag/'+ selectedTag.id);
        }

    }

    $scope.PinTag = function(selectedTag)
    {
        if($scope.pinnedTags){
            $scope.pinnedTags.forEach(function(pinTag, index){
                if(selectedTag.tag_name == pinTag.tag_name){
                    $scope.pinnedTags.splice(index,1);
                }
                else{
                    $scope.pinnedTags.push(selectedTag)
                }
            });
        }
        else {
            $scope.pinnedTags = [];
            $scope.pinnedTags.push(selectedTag);
        }
    }


    $scope.deleteFact = function()
    {
        var currentFact  = $scope.currentFact
        if(currentFact != undefined)
        {

            $http.delete('api/v1/fact/' + currentFact.id).success(function(){
                $scope.newFact = '';
                if($scope.pinnedTags){
                    $scope.tags = $scope.pinnedTags;
                }
                else{
                    $scope.tags = [];
                }
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

app.factory('UserApiService', function($http){

    var userPromise;
    var UserApiService = {
        UserData: function(){
            if(!userPromise)
                var userPromise = $http.get('api/v1/user').then(function(response){
                return response.data.data[0];
        });
            return userPromise;
        },

        FactData: function(user_id){
            var promise = $http.get('api/v1/user/'+user_id+'/fact').then(function(response){
                return response.data.data;
            });
            return promise
        }
    };

    return UserApiService;


});

//app.directive('FactInsertConsole', function(){
//    return {
//        restrict: 'EA',
//        scope:{
//            fact:'@'
//        },
//        template: '<textarea rows="22" cols="100" name="newFact" class="col-md-8">{{newFact}}</textarea>',
//        templateURL: factInserConsole.html,
//        controller: FactController,
//        link: function($scope, element, attrs){
//        }
//    }
//});