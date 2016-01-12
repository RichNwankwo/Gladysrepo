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
    <body ng-controller="QuestionController" class="container">
      <section class="row col-lg-12">
        <section id="mainApp" class="col-md-12">
          <section id="fact" class="row">
            <section class="col-md-8 col-md-offset-2">
              <textarea rows="1" cols="100">{{currentMaterial.question_title}}</textarea>
            </section>
          </section>
          <section id="factReveal" class="row">
            <section id="Reveal" class="col-md-8 col-md-offset-2"><i ng-click="check=true" class="fa fa-check-square-o fa-2x">Show Fact</i>
              <div ng-show="check" class="ng-hide">
                <textarea rows="5" cols="100" ng-model="currentMaterial.fact">{{currentMaterial.fact}}</textarea>
                <section id="tags" class="row"></section>
                <div ng-repeat="tag in tags" class="row factTag"></div><span class="label label-default">{{ tag.tag_name }} <i ng-click="PinTag(tag)" class="fa fa-thumb-tack"></i> <i class="fa fa-search"></i> <a ng-href="/gladys_learning/{{ tag.id }}"><i class="fa fa-play"></i> </a> <i ng-click="deleteTag(tag)" class="fa fa-trash-o removeTagButton"></i></span>
                <section id="addTags" class="row">
                  <form></form>
                  <input placeholder="Tag fact" type="text" ng-model="newTag" class="col-md-1">
                  <button ng-click="addTag()" class="button"><i class="fa fa-plus"></i></button>
                </section>
              </div>
            </section>
          </section>
          <section id="question" class="row">
            <section class="col-md-8 col-md-offset-2">
              <textarea rows="5" cols="100" ng-model="questionAnswer"></textarea>
            </section>
          </section>
          <section class="row">
            <section class="col-md-8 col-md-offset-2">
              <button ng-click="SubmitAnswer()" class="btn-lg">Submit Answer</button>
              <button ng-click="SkipQuestion()" class="btn-lg">Skip</button>
            </section>
          </section>
          <section id="options" class="row">
            <section class="col-md-8 col-md-offset-2">
              <select ng_model="filteredTag">
                <option ng-repeat="tag in usersTags" value="{{tag.id}}">{{tag.tag_name}}</option>
              </select>
              <button ng-click="addToTagList()" class="btn-sm">Add Preferred Topic</button>
              <div ng-repeat="tag in preferredTags" class="row factTag"><span class="label label-default">{{ tag.tag_name }} <i ng-click="PinTag(tag)" class="fa fa-thumb-tack"></i> <i class="fa fa-search"></i> <a ng-href="/gladys_learning/{{ tag.id }}"><i class="fa fa-play"></i> </a> <i ng-click="deleteTag(tag)" class="fa fa-trash-o removeTagButton"></i></span></div>
              <select ng_model="sessionType">
                <option value="1">Random</option>
                <option value="2">Random All</option>
              </select>
              <button ng-click="setSessionType()" class="btn-sm">Change Session Type</button>
            </section>
          </section>
        </section>
      </section>
    </body>
  </head>
</html>