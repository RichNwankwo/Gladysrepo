var app = angular.module('app', ['ngTagsInput']);

app.controller('FactController', function($scope,$http){

    $scope.loadCountries = function($query) {
        return $http.get('countries.json', { cache: true}).then(function(response) {
            var countries = response.data;
            return countries.filter(function(country) {
                return country.tag_name.toLowerCase().indexOf($query.toLowerCase()) != -1;
            });
        });
    };
});
