<!DOCTYPE html>
<html lang="en" ng-app="gladysApp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gladys Fact App</title>
    <meta name="description" content="">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="/">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/app.css">
    <script src="../js/gladys/userInformation.js"></script>
    <script src="../js/gladys/angular-route.js"></script>
    <body ng-controller="QuestionController" id="mainApp" class="container">
      <section class="col-md-12">
        <section id="fact" class="row">
          <section class="col-md-8">
            <textarea rows="1" cols="100">{{currentMaterial.question_title}}</textarea>
          </section>
        </section>
        <section id="factReveal" class="row"><i ng-click="check=true" class="fa fa-check-square-o fa-2x">Show Fact</i>
          <div ng-show="check" class="ng-hide">
            <textarea rows="5" cols="100" ng-model="currentMaterial.fact">{{currentMaterial.fact}}</textarea>
          </div>
        </section>
        <section id="question" class="row">
          <section class="col-md-8">
            <textarea rows="5" cols="100" ng-model="questionAnswer"></textarea>
          </section>
          <section class="col-md-3"><i ng-click="SubmitAnswer()" class="fa fa-gg fa-2x"> Submit Answer</i></section>
        </section>
        <section id="options" class="row">
          <select ng_model="filteredTag">
            <option ng-repeat="tag in usersTags" value="{{tag.id}}">{{tag.tag_name}}</option>
          </select>
          <button ng-click="addToTagList()" class="btn-sm">Add Preferred Topic</button>
        </section>
      </section>
    </body>
  </head>
</html>