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
  </head>
  <body ng-controller="UserInformation">
    <section id="header" class="row"></section>
    <section id="mainApp" class="row">
      <section id="sidebar" class="col-xs-2">
        <form id="factCardSearch">
          <input type="text" placeholder="search" ng-model="search" class="form-control">
        </form>
        <div ng-repeat="fact in facts | filter:search" class="factCards">
          <p><i class="fa fa-sticky-note-o"></i>   {{fact.fact}}</p>
        </div>
      </section>
      <section style="background-color:green" id="app" class="col-xs-10">
        <h1>App</h1>
      </section>
    </section>
    <section id="footer" class="row"></section>
  </body>
</html>