<!DOCTYPE html>
<html lang="en" ng-app>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gladys</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="/">
    <link rel="stylesheet" href="css/app.css">
  </head>
  <body ng-controller="FactController">
    <section class="jumbotron">
      <h1>Facts</h1><small ng-if="answered()">{{ answered() }} Correct</small>
    </section>
    <section>
      <input type="text" placeholder="Filter Answered" ng-model="search">
      <ul>
        <li ng-repeat="fact in facts | filter:search">{{ fact.answer }}
          <input type="checkbox" ng-model="fact.checked">
        </li>
      </ul>
      <form ng-submit="addAnswer()">
        <input type="text" placeholder="add new answer" ng-model="newAnswerText">
        <button type="submit">Add new Answer</button>
      </form>
    </section>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.5/angular.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>