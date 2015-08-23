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
  </head>
  <body ng-controller="UserInformation" class="container">
    <section id="header" class="row"></section>
    <section id="mainApp" class="row">
      <section id="sidebar" class="col-xs-2">
        <form id="factCardSearch">
          <input type="text" placeholder="search" ng-model="search" class="form-control">
        </form>
        <div ng-repeat="(key, fact) in facts | filter:search" ng-click="editFact(fact)" class="factCards">
          <p><i class="fa fa-sticky-note-o"></i>   {{fact.fact}}</p>
        </div>
      </section>
      <section id="app" class="col-xs-10">
        <section id="factTextArea">
          <form ng-submit="submit()">
            <textarea rows="22" cols="100" name="newFact" ng-model="newFact" class="col-md-8">{{newFact}}</textarea>
            <input type="hidden" ng-model="currentFactKey" value="{{currentFactKey}}">
          </form>
          <section id="factPanel" class="col-md-2">
            <section id="factOperations" class="row"><i ng-click="enterNewFact()" class="fa fa-sticky-note-o fa-2x"> New</i><i ng-click="submit()" class="fa fa-floppy-o fa-2x"> Save</i><i ng-click="deleteFact()" class="fa fa-trash-o fa-2x"> Delete</i></section>
            <section id="factTags" class="row"></section>
            <section id="tags" class="row">
              <div ng-repeat="tag in tags" class="row factTag"><span class="label label-default">{{ tag.tag_name }} <i ng-click="PinTag(tag)" class="fa fa-thumb-tack"></i> <i class="fa fa-search"></i> <a ng-href="/gladys_learning/{{ tag.id }}"><i class="fa fa-play"></i> </a> <i ng-click="deleteTag(tag)" class="fa fa-trash-o removeTagButton"></i></span></div>
            </section>
            <section id="addTags" class="row">
              <form></form>
              <input placeholder="Tag fact" type="text" ng-model="newTag" class="form-control form-group-sm">
              <button ng-click="addTag()" class="button"><i class="fa fa-plus"></i></button>
            </section>
            <section id="practice" class="row"><a href="/gladys_learning"><i class="fa fa-play-circle-o fa-4x"></i></a></section>
          </section>
        </section>
      </section>
    </section>
    <section id="footer" class="row"></section>
  </body>
</html>