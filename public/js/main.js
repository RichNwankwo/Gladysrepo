var FactController = function($scope, $http){
    //$scope.facts = [
    //    {body: 'Willpower is finite and infinite!', checked: true},
    //    {body: 'Working Memory is very important!', checked: true}
    //];

    $http.get('api/v1/answer').success(function(answers){
        $scope.facts = answers.data;
    });


    $scope.answered = function (){
        var answered = 0
        angular.forEach($scope.facts, function(fact){
            answered += fact.checked? 1 :  0;
        });
        return answered
    }

    $scope.addAnswer = function(){
        var answer = {
           answer: $scope.newAnswerText,
           question_id: 1,
           checked: 1
        };
        $scope.facts.push(answer)

        $http.post('api/v1/answer', answer);
    }

}